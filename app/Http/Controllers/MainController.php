<?php

namespace App\Http\Controllers;


use Exception;
use App\Product;
use Illuminate\Http\Request;
use App\Service\ProductFilter;

class MainController extends Controller
{
    public function index(Request $request, ProductFilter $filter)
    {
        $products = Product::filter($filter)->paginate(3);
        return view('index', compact('products'));
    }
}
