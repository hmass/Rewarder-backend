<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('forgotpassword', 'App\Http\Controllers\ForgotPasswordController@forgotPassword');
Route::post('reset', 'App\Http\Controllers\ForgotPasswordController@reset');

Route::get('user', 'App\Http\Controllers\AuthController@user')->middleware('auth:api');

Route::middleware('auth:api')->group( function () {
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    // Route::resource('customers', CustomerController::class);
    Route::get('/vouchers/generate', 'App\Http\Controllers\VoucherController@generateVoucher');
    Route::apiResource('customers', 'App\Http\Controllers\CustomerController');
    Route::apiResource('vouchers', 'App\Http\Controllers\VoucherController');

});
