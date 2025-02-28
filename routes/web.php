<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;

Route::get('/', [AppController::class,'home'])->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class,'register']);


Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware(RedirectIfAuthenticated::class);

Route::post('/login', [AuthController::class,'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', function () {
    return redirect('/dashboard/profile');
})->middleware(RedirectIfNotAuthenticated::class);
Route::get('/dashboard/profile', function () {
    return view('dashboard.profile');
})->middleware(RedirectIfNotAuthenticated::class);


Route::get('/product/create', [ProductController::class,'create'])->name('product.create');
Route::post('/product/create', [ProductController::class,'store'])->name('product.store');
Route::get('/product/category/{name}', [ProductController::class,'getProductsByCategory'])->name('product.productsByCategory');
Route::get('/product/{id}', [ProductController::class,'getSingleProduct'])->name('product.singleProduct');


Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});