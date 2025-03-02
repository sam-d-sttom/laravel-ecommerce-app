<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;

Route::get('/', [AppController::class, 'home'])->name('home');

// Register new user
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [UserController::class, 'register']);

// Login user
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);

// Logout user
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


// For admin
Route::prefix('/admin')->group(function () {
    // Register new admin
    Route::get('/register', function () {
        return view('admin.register');
    })->name('admin.register');
    Route::post('/register', [AdminController::class, 'register']);
    
    // Login admin
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    
    Route::middleware('auth:admin')->group(
        function () {

            // Logout admin
            Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

            // Admin dashboard
            Route::get('/dashboard', function () {
                return redirect('/admin/dashboard/profile');
            });
            Route::get('/dashboard/profile', function () {
                return view('admin.dashboard.profile');
            });

            Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
        }
    );
});

Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories']);



Route::middleware(['auth:web'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect('/dashboard/profile');
    });
    Route::get('/dashboard/profile', function () {
        return view('dashboard.profile');
    });

    Route::get('/product/category/{name}', [ProductController::class, 'getProductsByCategory'])->name('product.productsByCategory');
    Route::get('/product/{id}', [ProductController::class, 'getSingleProduct'])->name('product.singleProduct');

    Route::get('/dashboard/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    Route::get('/dashboard/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/dashboard/checkout', [AppController::class, 'checkout'])->name('checkout');
    Route::get('/dashboard/orders', [AppController::class, 'orders'])->name('orders');
    Route::get('/dashboard/orders/{orderId}', [AppController::class, 'order'])->name('order');
});
