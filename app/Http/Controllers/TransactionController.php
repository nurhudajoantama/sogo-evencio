<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())->get();
        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function checkout(Product $product)
    {
        $services = null;
        if (!$product->is_service) {
            $services = Product::where('is_service', true)->where('is_active', true)->get();
        }
        return view('transactions.checkout', compact('product', 'services'));
    }

    public function buy(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'service_id' => 'nullable|exists:products,id',
            'payment_method' => 'required|exists:payment_methods,id',
            'destination' => 'required|numeric',
            'destination_name' => 'required|string',
            'shipment_price' => 'required|numeric',
        ]);

        $payment_code = rand(1, 999);
        $product = Product::find($request->product_id);

        $total = $product->price + $request->shipment_price + $payment_code;

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'payment_id' => $request->payment_method,
            'status_id' => 1,
            'total' => $total,
            'destination' => $request->destination,
            'destination_name' => $request->destination_name,
        ]);

        return redirect()->route('transactions.show', $transaction->id);
    }
}
