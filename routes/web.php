<?php

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

/*Route::get('/', function () {
    return view('HomeController@index');
});*/

Route::middleware(['access-log', 'web'])->group(function () {

	Route::any('/', 'HomeController@index');
	Route::any('/comingsoon', 'HomeController@comingsoon');
	Route::any('/search', 'HomeController@search');

	Route::any('/account', 'AccountController@index');
	Route::any('/account/login', 'AccountController@login');
	Route::post('/account/doLogin', 'AccountController@doLogin');
	Route::any('/account/register', 'AccountController@register');
	Route::post('/account/doRegister', 'AccountController@doRegister');
	Route::any('/account/verification', 'AccountController@verification');
	Route::post('/account/doEmailVerification', 'AccountController@doEmailVerification');
	Route::get('/account/verifyEmail', 'AccountController@verifyEmail');
	Route::any('/account/doPhoneVerification', 'AccountController@doPhoneVerification');
	Route::any('/account/doUploadID', 'AccountController@doUploadID');
	Route::any('/account/doUploadDP', 'AccountController@doUploadDP');
	Route::get('/account/update', 'AccountController@index');
	Route::post('/account/update', 'AccountController@doUpdate');
	Route::any('/account/profile', 'AccountController@profile');
	Route::any('/account/checkOTP', 'AccountController@checkOTP');
	Route::any('/account/getAddrArea', 'AccountController@getAddrArea');
	Route::any('/account/forgetCookie', 'AccountController@forgetCookie');
	Route::any('/account/logout', 'AccountController@logout');
	Route::get('/account/googleAuthSuccess', 'AccountController@googleAuthSuccess');
	Route::get('/account/doFBAuth', 'AccountController@doFBAuth');
	Route::get('/account/doFBCallback', 'AccountController@doFBCallback');

	Route::any('/product', 'ProductController@index');
	Route::any('/product/upload', 'ProductController@details');
	Route::any('/product/details', 'ProductController@details');
	Route::any('/product/doUploadImage', 'ProductController@doUploadImage');
	Route::any('/product/deleteImage', 'ProductController@deleteImage');
	Route::any('/product/countPrice', 'ProductController@countPrice')->name('countPrice');
	Route::any('/product/doProductUpload', 'ProductController@doProductUpload');
	Route::any('/product/catalog', 'ProductController@catalog');

	Route::any('/transaction/addToCartPage', 'TransactionController@addToCartPage')->name('addToCartPage');
	Route::any('/transaction/doAddToCart', 'TransactionController@doAddToCart');
	Route::any('/transaction/cart', 'TransactionController@cart');
	Route::any('/transaction/countCartPrice', 'TransactionController@countCartPrice');
	Route::any('/transaction/deleteCartProduct', 'TransactionController@deleteCartProduct');
	Route::any('/transaction/cekCheckoutPrice', 'TransactionController@cekCheckoutPrice');
	Route::any('/transaction/payRent', 'TransactionController@payRent');
	Route::any('/transaction/finishPayment', 'TransactionController@finishPayment');
	Route::any('/transaction/details', 'TransactionController@details');
	Route::any('/transaction/myRents', 'TransactionController@myRents');
	Route::any('/transaction/myRentedStuffs', 'TransactionController@myRentedStuffs');
	Route::any('/transaction/updateStatus', 'TransactionController@updateStatus');
	Route::post('/transaction/checkout', 'TransactionController@checkout');
	Route::get('/transaction/checkout', 'TransactionController@showCheckout');
	Route::any('/transaction/addReviewPage', 'TransactionController@addReviewPage');

	Route::any('/faq','HomeController@faq');
	Route::any('/tnc','HomeController@tnc');
	Route::any('/contact_us','HomeController@contact_us');
	Route::any('/privacy','HomeController@privacy');
	Route::any('/about','HomeController@about');

	Route::get('/clear-cache', function() {
	    Artisan::call('cache:clear');
	    return "Cache is cleared";
	});

});
