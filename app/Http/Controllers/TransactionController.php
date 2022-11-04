<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\PaymentMethodCategory;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with([
            'user',
            'product',
            'service',
            'payment',
            'status'
        ])->where('user_id', auth()->id())->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function checkout(Product $product)
    {
        $services = null;
        if (!$product->is_service) {
            $services = Product::where('is_service', true)->where('is_active', true)->get();
        }
        $payment_methods = PaymentMethodCategory::with('paymentMethods')->has('paymentMethods')->get();
        return view('transactions.checkout', compact('product', 'services', 'payment_methods'));
    }

    public function buy(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_id' => 'nullable',
            'service_id' => 'nullable',
            'payment_method' => 'required|exists:payment_methods,id',
            'destination' => 'required|numeric',
            'detail_destination' => 'required|string',
            'destination_name' => 'required|string',
            'destination_phone' => 'required|string',
            'shipment_method' => 'required|string',
            'shipment_price' => 'required|numeric',
        ]);

        $payment_code = rand(1, 999);
        $total = $request->shipment_price + $payment_code;
        if ($request->product_id) {
            $product = Product::find($request->product_id);
            $total += $product->price;
        }
        if ($request->service_id) {
            $service = Product::find($request->service_id);
            $total += $service->price;
        }

        Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id ?? null,
            'service_id' => $service->id ?? null,
            'payment_id' => $request->payment_method,
            'status_id' => 1,
            'total' => $total,
            'destination' => $request->destination,
            'detail_destination' => $request->detail_destination,
            'destination_name' => $request->destination_name,
            'destination_phone' => $request->destination_phone,
            'shipment_method' => $request->shipment_method,
        ]);

        return redirect()->route('transactions.index');
    }

    public function uploadPaymentProof($id, Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $transaction = Transaction::find($id);
        if ($transaction->user_id != auth()->id()) {
            return redirect()->back();
        }
        if ($transaction->payment_proof) {
            Storage::delete($transaction->payment_proof);
        }
        $transaction->payment_proof = $request->file('payment_proof')->store('payment_proofs');
        $transaction->save();
        return redirect()->route('transactions.index');
    }
}
