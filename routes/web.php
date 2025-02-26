<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;

Route::get('/', function () {
    return view('home');
});

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
    return view('dashboard.pages.profile');
})->middleware(RedirectIfNotAuthenticated::class);

