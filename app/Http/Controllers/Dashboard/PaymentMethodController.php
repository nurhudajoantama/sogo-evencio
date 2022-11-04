<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethodCategory;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethodsCategories = PaymentMethodCategory::with('paymentMethods')->get();
        return view('dashboard.paymentmethod.index', compact('paymentMethodsCategories'));
    }

    public function create()
    {
        $paymentMethodCategories = PaymentMethodCategory::all();
        $method = request('method');
        return view('dashboard.paymentmethod.create', compact('paymentMethodCategories', 'method'));
    }

    public function store(Request $request)
    {
        $validation = [
            'name' => 'required',
            'method' => 'required',
            'account_name' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'payment_method_category_id' => 'required',
        ];
        switch ($request->method) {
            case 'Bank':
                $request->merge(['payment_method_category_id' => 1,]);
                $validation['account_number'] = 'required';
                break;

            case 'E-Wallet':
                $request->merge(['payment_method_category_id' => 2,]);
                $validation['phone_number'] = 'required';
                break;

            case 'QR Code':
                $request->merge(['payment_method_category_id' => 3,]);
                $validation['qr_code'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
                break;
            default:
                return redirect()->back()->with('error', 'Payment method not found');
        }
        $validatedData = $request->validate($validation);
        $validatedData['logo'] = $request->file('logo')->store('payment-methods-logo');
        if ($request->file('qr_code')) {
            $validatedData['qr_code'] = $request->file('qr_code')->store('payment-methods-qr-code');
        }
        PaymentMethod::create($validatedData);
        return redirect()->route('dashboard.paymentmethods.index')->with('success', 'Payment method created successfully.');
    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::with('category')->findOrFail($id);
        return view('dashboard.paymentmethod.edit', compact('paymentMethod'));
    }

    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $validation = [
            'name' => 'required',
            'account_name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        switch ($paymentMethod->payment_method_category_id) {
            case 1:
                $validation['account_number'] = 'required';
                break;

            case 2:
                $validation['phone_number'] = 'required';
                break;

            case 3:
                $validation['qr_code'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
                break;
            default:
                return redirect()->back()->with('error', 'Payment method not found');
        }
        $validatedData = $request->validate($validation);
        if ($request->file('logo')) {
            Storage::delete($paymentMethod->logo);
            $validatedData['logo'] = $request->file('logo')->store('payment-methods-logo');
        }
        if ($request->file('qr_code')) {
            if ($paymentMethod->qr_code) {
                Storage::delete($paymentMethod->qr_code);
            }
            $validatedData['qr_code'] = $request->file('qr_code')->store('payment-methods-qr-code');
        }
        $paymentMethod->update($validatedData);
        return redirect()->route('dashboard.paymentmethods.index')->with('success', 'Payment method updated successfully.');
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        Storage::delete($paymentMethod->logo);
        if ($paymentMethod->qr_code) {
            Storage::delete($paymentMethod->qr_code);
        }
        $paymentMethod->delete();
        return redirect()->route('dashboard.paymentmethods.index')->with('success', 'Payment method deleted successfully.');
    }
}
