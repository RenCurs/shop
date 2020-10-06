<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        dd(count($product->authors->all()));
        return view('product.show', compact('product'));
    }
}
