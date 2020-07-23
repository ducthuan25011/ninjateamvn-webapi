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

Route::get('clearcache', function() {
    Artisan::call('cache:clear');
    echo "Cache is cleared";
});
Route::group(['middleware' => 'checklogin'], function() {
	Route::get('/', function () {
        return redirect(route('customer'));
    })->name("home");
	//login
    Route::get("login","LoginController@adminlogin")->name("login");
    Route::post("Login","LoginController@login")->name("Login");
    Route::get('logout', function () {
        Session::forget('email');
        Session::forget('password');
        Session::forget('is_admin');
        return redirect()->route("login");
    })->name("logout");

    Route::get('/customer', function () {
        return view('customer');
    })->name("customer");
    Route::post("Customer","CustomerController@Customer")->name("Customer");

    Route::get('/package', function () {
        return view('package');
    })->name("package");
    Route::post("Package","PackageController@Package")->name("Package");

    Route::get('/coupon', function () {
        return view('coupon');
    })->name("coupon");
    Route::post("Coupon","CouponController@Coupon")->name("Coupon");

    Route::get('/sale', function () {
        return view('sale');
    })->name("sale");
    Route::post("Sale","SaleController@Sale")->name("Sale");

    Route::get('/account', function () {
        return view('account');
    })->name("account");
    Route::post("Account","AccountController@Account")->name("Account");
});