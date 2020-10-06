<?php

namespace App\Service;

use App\Order;
use App\Product;
use Illuminate\Support\Arr;


class Cart 
{
    private $token;

    public function __construct()
    {
        $this->token = session()->get('_token');
    }

    public function AddToCart(Product $product)
    {
        $token = $this->token;

        if (!(Arr::has(session()->get($token), $product->code)))
        {
         session()->put("$token.$product->code", ['id'=>$product->id,
                                                'name'=> $product->name, 'count'=> 1, 
                                                'price'=>$product->price,'cost'=>$product->price * 1]);
        session()->flash('AddToCart','Товар добавлен в корзину');   
        }
    }

    public function getProductsInCart($code = null)
    {
        $products = session()->get($this->token);
        return ($code) ? $products[$code] : $products;
    }

    public function IncreaseProductCount($product_code)
    {
        $product = $this->getProductsInCart($product_code);
        $product['count']++;
        $product['cost'] = $product['count'] * $product['price'];
        session()->put("$this->token.$product_code",  $product);
    }

    public function DecreaseProductCount($product_code)
    {
        $product = $this->getProductsInCart($product_code);
        if($product['count'] >= 2)
        {
            $product['count']--;
            $product['cost'] = $product['count'] * $product['price'];
            session()->put("$this->token.$product_code",  $product);

        }
        else
        {
            session()->forget("$this->token.$product_code");
        }
    }

    public function DeleteProduct($product_code)
    {
        session()->forget("$this->token.$product_code");
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;
        $products = $this->getProductsInCart();
        if(!empty($products))
        {
            foreach($products as $product)
            {   
                $totalPrice += $product['cost'];
            }
        }
        return $totalPrice;
    }

    public function getTotalCount()
    {
        $count = 0;
        $products = $this->getProductsInCart();
        if(!empty($products))
        {
            foreach($products as $product)
            {
                $count += $product['count'];
            }
        }
        return $count;
    }


    public function SaveOrderGuest($request) // доработать pivot!
    {
        $products = $this->getProductsInCart();
        $order = Order::create(['name'=>$request->name, 'phone'=>$request->phone, 'total_price'=>$this->getTotalPrice()]);
        foreach($products as $product)
        {
            $order->products()->attach($product['id']);
        
            $orderPivot =  $order->products()->where('product_id', $product['id'])->first()->pivot;
            $orderPivot->count = $product['count'];
            $orderPivot->cost = $product['cost'];
            $orderPivot->update();
        }
        session()->forget($this->token);
        return 'Заказ успешно офомлен';
    } 

    public function UserSaveOrder($user)
    {
        $products = $this->getProductsInCart();
        $order = Order::create(['name'=>$user->name, 'total_price'=>$this->getTotalPrice()]);
        $user->orders()->save($order);

        foreach($products as $product)
        {
            $order->products()->attach($product['id']);

            $orderPivot =  $order->products()->where('product_id', $product['id'])->first()->pivot;
            $orderPivot->count = $product['count'];
            $orderPivot->cost = $product['cost'];
            $orderPivot->update();
        }
        session()->forget($this->token);
        session()->flash('result_order', 'Заказ успешно оформлен');
        return redirect('/cart');
    }
}

