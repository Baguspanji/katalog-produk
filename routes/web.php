<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('beranda'));

Route::get('/beranda', fn() => view('home'))->name('home');
Route::get('/produk', function () {
    $categories = \App\Models\Category::select('id', 'name')
        ->where('is_active', true)
        ->withCount('products')
        ->orderByDesc('products_count')
        ->get();

    return view('product', compact('categories'));
})->name('product');
Route::get('/produk-kategori/{id}', function ($id) {
    $category = \App\Models\Category::findOrFail($id);

    return view('product-category', compact('category'));
    })->name('product-category');
Route::get('/produk-affiliate/{id}', function ($id) {
    $affiliateStore = \App\Models\AffiliateStore::findOrFail($id);

    return view('product-affiliate', compact('affiliateStore'));
})->name('product-affiliate');
