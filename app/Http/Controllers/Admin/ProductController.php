<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Author;
use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $genres;
    private $authors;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->genres = Genre::pluck('name','id')->all();
        $this->authors = Author::pluck('name','id')->all();
    }

    public function index()
    {
        $products = Product::all();
        $genres = $this->genres;
        $authors = $this->authors;
        return view('admin.product.index', compact('products', 'genres','authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
        $product = Product::create($request->all());
        $product->genres()->attach($request->genres);
        $product->authors()->sync($request->authors);
        if (!(is_null($request->image)))
        {
            $path = $request->file('image')->store('/public/pictures');
            $product->image = $path;
            $product->save();
        }
        session()->flash('result_product', 'Товар успешно добавлен');
        return \redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return ['product'=>$product, 'genres'=>$product->genres, 'author'=>$product->authors];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $genres = $this->genres;
        $authors = $this->authors;
        $genreProduct = $product->genres->pluck('name', 'id')->all();
        $authorProduct = $product->authors->pluck('name', 'id')->all();
        return view('admin.product.edit', compact('product','genres', 'genreProduct','authorProduct','authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->genres()->sync($request->genres);
        $product->authors()->sync($request->authors);
        if (!(is_null($request->image)))
        {
            Storage::delete($product->image);
            $path = $request->file('image')->store('/public/pictures');
            $product->image = $path;
            $product->save();
        }
        session()->flash('result_product', 'Товар успешно обновлен');
        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
