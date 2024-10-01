<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('products');
})->name('product');


Route::get('/cart', function () {
    return view('cart');
})->name('cart');


Route::get('/order', function () {
    return view('order');
});
