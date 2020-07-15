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
Route::group(['prefix'=>'app/v1/'],function(){
	Route::post('Login','Api\ApiLoginController@Login');
	Route::post('Customer','Api\ApiCustomerController@Customer');
	Route::post('Package','Api\ApiPackageController@Package');
	Route::post('Coupon','Api\ApiCouponController@Coupon');
	Route::post('Sale','Api\ApiSaleController@Sale');
	Route::post('Account','Api\ApiAccountController@Account');
});