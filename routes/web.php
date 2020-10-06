<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'MainController@index');
Route::get('/search', 'MainController@search');

Route::get('/genres/{genre}', 'GenreController@show');

Route::get('/authors/{author}', 'AuthorController@show');

Route::get('/products/{product}', 'ProductController@show');


Route::post('/cart/add/{product}', 'CartController@add');
Route::get('/cart/increase/{code_product}', 'CartController@increase'); //Post?
Route::get('/cart/decrease/{code_product}', 'CartController@decrease'); //Post?
Route::get('/cart/delete/{code_product}', 'CartController@delete'); //Post?
Route::post('/cart/confirm_order', 'CartController@confirm');
Route::get('/cart', 'CartController@index');


Route::middleware(['is_admin','auth'])->group(function (){

    Route::get('/admin', function(){
        return view('admin.index');
    });

    Route::prefix('admin')->group(function(){
        Route::resource('genres', 'Admin\GenreController');
        Route::resource('products', 'Admin\ProductController');
        Route::resource('authors', 'Admin\AuthorController');
    });
});

Route::get('/orders', 'OrderController@index')->middleware('auth');