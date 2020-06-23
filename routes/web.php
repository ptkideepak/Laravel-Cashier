<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('add-stripe-customer', 'StripeCustomers@index')->name('add-stripe-customer');
    Route::post('add-stripe-customer', 'StripeCustomers@store')->name('stripe.customer.store');
    Route::get('billing', 'BillingController@index')->name('billing');
    Route::get('checkout/{plan_id}', 'CheckoutController@checkout')->name('checkout');
    Route::post('checkout', 'CheckoutController@postCheckout')->name('checkout.process');
    Route::get('cancel', 'BillingController@cancel')->name('cancel');
    Route::get('resume', 'BillingController@resume')->name('resume');
    Route::get('payment-methods/default/{paymentMethod}', 'PaymentMethodController@markDefault')->name('payment-methods.markDefault');
    Route::resource('payment-methods', 'PaymentMethodController');
});

