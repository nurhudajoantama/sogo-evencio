<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->latest()->get();
        return view('index', compact('products'));
    }
}
