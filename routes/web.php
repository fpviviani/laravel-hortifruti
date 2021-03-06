<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/store', ["as"=>"store.index", "uses"=>"HomeController@storeFront"]);

Auth::routes(['verify' => false]);

// Carts
Route::group(["prefix" => "cart"], function () {
    Route::post("/{user_id}/modify-cart", ["as"=>"cart.modify", "uses"=>"CartController@storeOrUpdate"]);
});
Route::get('/{user_id}/cart', ["as"=>"cart.index", "uses"=>"HomeController@cartFront"]);

Route::group(["middleware" => ["auth"]], function () {
    Route::group(["prefix" => "buys"], function () {
        Route::post("/store/{user_id}", ["as"=>"buys.store", "uses"=>"BuyController@store"]);
    });
});

Route::group(["middleware" => ["auth", "super"]], function () {

    // Buys
    Route::group(["prefix" => "buys"], function () {
        Route::get("/delivered", ["as"=>"buys.delivered", "uses"=>"BuyController@index"]);
        Route::get("/not-delivered", ["as"=>"buys.not_delivered", "uses"=>"BuyController@index"]);
        Route::get("/{buy_id}", ["as"=>"buys.show", "uses"=>"BuyController@show"]);
        Route::get("/{buy_id}/devliver", ["as"=>"buys.deliver", "uses"=>"BuyController@deliver"]);
    });

    // Products
    Route::group(["prefix" => "products"], function () {
        Route::get("/", ["as"=>"products.index", "uses"=>"ProductController@index"]);
        Route::get("/create", ["as"=>"products.create", "uses"=>"ProductController@create"]);
        Route::post("/", ["as"=>"products.store", "uses"=>"ProductController@store"]);
        Route::get("/{product_id}", ["as"=>"products.show", "uses"=>"ProductController@show"]);
        Route::match(["put", "patch"], "/{debt_id}", ["as"=>"products.update", "uses"=>"ProductController@update"]);
        Route::delete("/{product_id}", ["as"=>"products.destroy", "uses"=>"ProductController@destroy"]);
        Route::get("/{product_id}/edit", ["as"=>"products.edit", "uses"=>"ProductController@edit"]);
    });
});