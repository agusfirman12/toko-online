<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Transactions\Cart;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Transactions\addToCart;
use App\Http\Controllers\API\Products\ProdcutsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('/products', ProdcutsController::class)->middleware('auth:sanctum');
Route::post('/addtocart/{id}', [addToCart::class, 'store'])->middleware('auth:sanctum');
Route::get('/cart', [Cart::class, 'index'])->middleware('auth:sanctum');
Route::get('/payment', [Cart::class, 'payment'])->middleware('auth:sanctum');
Route::get('/payment-success', [Cart::class, 'paymentSuccess'])->middleware('auth:sanctum');
