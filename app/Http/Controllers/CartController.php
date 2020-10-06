<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{

    public function index()
    {
        $products = Cart::getProductsInCart();
        $infOrder['total_price'] = Cart::getTotalPrice();
        $infOrder['total_count'] = Cart::getTotalCount();
        return view('cart', compact('products', 'infOrder'));
    }

    public function add(Product $product)
    {
        Cart::AddToCart($product);
        return redirect()->back();
    }

    public function increase($product_code)
    {
        Cart::IncreaseProductCount($product_code);
        return redirect('/cart');
    }

    public function decrease($product_code)
    {
        Cart::DecreaseProductCount($product_code);
        return redirect('/cart');
    }

    public function delete($product_code)
    {
        $product_name = Cart::getProductsInCart($product_code)['name'];
        Cart::DeleteProduct($product_code);
        session()->flash('DeleteFromCart'.'Товар: '. $product_name . 'удален');
        return redirect('/cart');
    }

    public function confirm(Request $request)
    {
        if(Auth::check())
        {
            return Cart::UserSaveOrder(Auth::user());
        }
        else
        {
            $validatedData = $request->validate([
                'name' => 'required||min:4',
                'phone' => 'required|min:2',
                ]);
            return Cart::SaveOrderGuest($request);
        }
    }
}
