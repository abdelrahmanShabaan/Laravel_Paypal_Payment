<?php

use App\Http\Controllers\Paypal\paypalController;
use Illuminate\Support\Facades\Route;
use Srmklive\PayPal\Services\ExpressCheckout;

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

Route::get('/', function () {
    return view('welcome');
});

/**
 * Here is all payments of paypal
 */
Route::get('payment', [paypalController::class, 'payment'])->name('payment');
Route::get('cancel', [paypalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [paypalController::class, 'success'])->name('payment.success');
