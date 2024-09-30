<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
Route::get('/', \App\Livewire\Home::class)->name('home');

Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');
Route::post('/logout', \App\http\Controllers\LogoutController::class)->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', \App\Livewire\Admin\Dashboard::class)->middleware('auth', 'role:admin')->name('admin.dashboard');
    Route::get('users', \App\Livewire\Admin\Users\Users::class)->middleware('auth', 'role:admin')->name('admin.users');
        Route::get('products', \App\Livewire\Admin\Products::class)->middleware('auth', 'role:admin')->name('admin.products');


});

Route::prefix('seller')->group(function () {
    Route::get('/dashboard', \App\Livewire\Seller\Dashboard::class)->middleware('auth', 'role:seller|admin')->name('seller.dashboard');
});

Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

Route::get('/products', \App\Livewire\Product\Index::class)->name('products');
Route::get('/products/{id}', \App\Livewire\Product\Detile::class)->name('products.detile');
Route::get('/categories/{id}', \App\Livewire\Product\CategoryProduct::class)->name('products.category');
Route::get('/cart', \App\Livewire\Cart::class)->name('cart');
Route::get('/checkout', \App\Livewire\Checkout::class)->name('checkout');
Route::get('/history', \App\Livewire\history::class)->name('history');
Route::get('/paymentSuccess/{id}', \App\Livewire\PaymentSuccess::class)->name('payment.success');

Route::post('/midtrans/notification', [PaymentController::class, 'midtransNotification']);

