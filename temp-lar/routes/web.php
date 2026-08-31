<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'products' => Product::all()
    ]);
});

Route::get('/prod-orders', function () {
    return view('production.production-orders');
});

Route::get('/production-results', function () {
    return view('production.create');
});
