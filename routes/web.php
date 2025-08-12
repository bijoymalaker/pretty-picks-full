<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('shop', function () {
    $products = \App\Models\Product::latest()->get();
    return Inertia::render('Shop', [
        'products' => $products
    ]);
})->name('shop');

Route::get('about', function () {
    return Inertia::render('AboutUs');
})->name('about');

Route::get('contact', function () {
    return Inertia::render('ContactUs');
})->name('contact');

Route::get('blog', function () {
    $blogs = \App\Models\Blog::published()->latest()->get();
    return Inertia::render('BlogPage', [
        'blogs' => $blogs
    ]);
})->name('blog');

Route::resource('products', ProductController::class);
Route::resource('blogs', BlogController::class);
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');

// Route::get('/login', function () {
//     return Inertia::render('Login');
// })->name('login');

// Route::get('/register', function () {
//     return Inertia::render('Register');
// })->name('register');

Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

Route::get('/product/{id}', function ($id) {
    return Inertia::render('ProductPage', ['id' => $id]);
})->name('productPage');

Route::get('/api/products/{id}', function ($id) {
    $product = \App\Models\Product::find($id);
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }
    return response()->json($product);
});

Route::get('/checkout', function () {
    return Inertia::render('Checkout');
})->name('checkout');

Route::get('/pro', function () {
    return Inertia::render('ProductDetails');
})->name('productDetails');

Route::get('/pm', function () {
    return Inertia::render('ProductManager');
})->name('productManager');

// Optionally, handle not found (fallback) route
Route::fallback(function () {
    return redirect('/');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
