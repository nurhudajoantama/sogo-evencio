<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $informations = Information::where('is_status', true)->latest()->get();
        $products = Product::where('is_active', true)->latest()->get();
        return view('index', compact('products', 'informations'));
    }
}
