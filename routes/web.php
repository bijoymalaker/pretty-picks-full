<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SslCommerzPaymentController;

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

Route::post('/order', [SslCommerzPaymentController::class, 'store'])->name('order.store');
Route::get('/order-confirmed/{order}', [SslCommerzPaymentController::class, 'show'])->name('order.confirmed');

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

        // Admin-specific routes (products and blogs are already defined globally)
        Route::get('users', function () {
            $users = \App\Models\User::all();
            return Inertia::render('admin/Users', [
                'users' => $users
            ]);
        })->name('users');

        Route::get('product-list', function () {
            $products = \App\Models\Product::all();
            return Inertia::render('admin/Products', [
                'products' => $products
            ]);
        })->name('products.list');

        Route::get('blog-list', function () {
            $blogs = \App\Models\Blog::all();
            return Inertia::render('admin/Blogs', [
                'blogs' => $blogs
            ]);
        })->name('blogs.list');

        // Resource routes for admin management
        Route::resource('products', ProductController::class);
        Route::resource('blogs', BlogController::class);
    });
});



// SSLCOMMERZ Start

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

// Payment Status Pages
Route::get('/success', function (Request $request) {
    $tran_id = $request->query('tran_id');
    $order_details = null;

    if ($tran_id) {
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'name', 'email')
            ->first();
    }

    return Inertia::render('payment/PaymentSuccess', [
        'order_details' => $order_details
    ]);
})->name('payment.success');

Route::get('/fail', function (Request $request) {
    $tran_id = $request->query('tran_id');
    $order_details = null;

    if ($tran_id) {
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'name', 'email')
            ->first();
    }

    return Inertia::render('payment/PaymentFail', [
        'order_details' => $order_details
    ]);
})->name('payment.fail');

Route::get('/cancel', function (Request $request) {
    $tran_id = $request->query('tran_id');
    $order_details = null;

    if ($tran_id) {
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'name', 'email')
            ->first();
    }

    return Inertia::render('payment/PaymentCancel', [
        'order_details' => $order_details
    ]);
})->name('payment.cancel');

//SSLCOMMERZ END

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
