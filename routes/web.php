<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('shop', function () {
    return Inertia::render('Shop');
})->name('shop');

Route::get('about', function () {
    return Inertia::render('AboutUs');
})->name('about');

Route::get('contact', function () {
    return Inertia::render('ContactUs');
})->name('contact');

Route::get('blog', function () {
    return Inertia::render('BlogPage');
})->name('blog');

use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);


// Route::get('/login', function () {
//     return Inertia::render('Login');
// })->name('login');

// Route::get('/register', function () {
//     return Inertia::render('Register');
// })->name('register');

Route::get('/blog/{id}', function ($id) {
    return Inertia::render('BlogPost', ['id' => $id]);
})->name('blogPost');

Route::get('/product/{id}', function ($id) {
    return Inertia::render('ProductPage', ['id' => $id]);
})->name('productPage');

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
