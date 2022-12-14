<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        return view('dashboard.products.create');
    }

    public function store(Request $request)
    {
        $validation = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_service' => 'required|boolean',
            'is_active' => 'boolean',
            'shopee_link' => 'nullable|url',
            'tokopedia_link' => 'nullable|url',
        ];
        if ($request->is_service == 0) {
            $validation['weight'] = 'required|numeric';
        }
        $request->validate($validation);
        if ($request->is_active == null) {
            $request->merge(['is_active' => false]);
        }

        Product::create($request->all());

        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('dashboard.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validation = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_service' => 'required|boolean',
            'is_active' => 'boolean',
            'shopee_link' => 'nullable|url',
            'tokopedia_link' => 'nullable|url',
        ];
        if ($request->is_service == 0) {
            $validation['weight'] = 'required|numeric';
        }
        $request->validate($validation);
        if ($request->is_active == null) {
            $request->merge(['is_active' => false]);
        }

        $product->update($request->all());

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully');
    }
}
