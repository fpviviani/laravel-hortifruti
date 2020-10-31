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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

// Buys
Route::group(["prefix" => "buys"], function () {
    Route::get("/delivered", ["as"=>"buys.index", "uses"=>"BuyController@index"]);
    Route::get("/not-delivered", ["as"=>"buys.index", "uses"=>"BuyController@index"]);
    Route::post("/", ["as"=>"buys.store",   "uses"=>"BuyController@store"]);
    Route::get("/{buy_id}", ["as"=>"buys.show", "uses"=>"BuyController@show"]);
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