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


Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

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

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin auth routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', function () {
            return Inertia::render('auth/AdminLogin');
        })->name('login');
        
        Route::get('register', function () {
            return Inertia::render('auth/AdminRegister');
        })->name('register');
        
        Route::post('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'storeAdmin'])
            ->name('register.store');
    });

    // Admin protected routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', function () {
            $stats = [
                'totalUsers' => \App\Models\User::count(),
                'totalProducts' => \App\Models\Product::count(),
                'totalBlogs' => \App\Models\Blog::count(),
                'adminUsers' => \App\Models\User::where('role', 'admin')->orWhere('is_admin', true)->count(),
            ];
            
            return Inertia::render('admin/Dashboard', [
                'stats' => $stats
            ]);
        })->name('dashboard');
        
        // Add resource routes for managing products and blogs
        Route::resource('products', ProductController::class);
        Route::resource('blogs', BlogController::class);
        Route::get('users', function () {
            $users = \App\Models\User::all();
            return Inertia::render('admin/Users', [
                'users' => $users
            ]);
        })->name('users');
        
        Route::get('products', function () {
            $products = \App\Models\Product::all();
            return Inertia::render('admin/Products', [
                'products' => $products
            ]);
        })->name('products');
        
        Route::get('blogs', function () {
            $blogs = \App\Models\Blog::all();
            return Inertia::render('admin/Blogs', [
                'blogs' => $blogs
            ]);
        })->name('blogs');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
