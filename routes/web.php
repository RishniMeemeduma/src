<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\Catalogue\Product::class, 'index']);

/** cart routes */
Route::post('/cart/store', [App\Http\Controllers\Cart\CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [App\Http\Controllers\Cart\CartController::class, 'index'])->name('cart.all');

/** order routes */
Route::get('/order/placeOrder', [App\Http\Controllers\Sales\Order::class, 'placeOrder'])->name('order.placeorder');
Route::middleware(['json.response'])->post('/order/save', [App\Http\Controllers\Sales\Order::class, 'saveOrder'])->name('order.save');

/** Login / Registration  */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

