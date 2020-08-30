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

Auth::routes();

// Route::Livewire('/shop', 'livewire.shop-products-controller');

// Route::livewire('/home', 'shop-products-controller');



Route::group(['namespace' => 'shop\page'], function() {

	Route::resource('auth', 'AuthController')->names('shop.pages.auth');

	Route::resource('profile', 'ProfileController')->names('shop.pages.profile');

	Route::resource('orders', 'OrderController')->names('shop.pages.orders');

	Route::resource('/', 'HomePageController')->names('shop.pages.home-page');

	Route::resource('shop', 'ShopController')->names('shop.pages.shop');

	Route::resource('about-us', 'AboutUsController')->names('shop.pages.about-us');

	Route::resource('contacts', 'ContactController')->names('shop.pages.contacts');

	Route::resource('cart', 'CartController')->names('shop.pages.cart');

	Route::get('/checkout', 'CheckoutController@index')->name('checkout');

	Route::post('/checkout/checkMail', 'CheckoutController@checkMail')->name('checkMail');

	Route::post('/checkout/setUserData', 'CheckoutController@setUserData')->name('setUserData');

	Route::get('/checkout/payment', 'PaymentController@index')->name('payment');

	Route::get('/checkout/process', 'ProcessController@index')->name('process');

	Route::post('/checkout/createOrder', 'PaymentController@createOrder')->name('createOrder');

});

Route::group(['middleware' => ['role', 'auth']], function() {

	Route::group(['namespace' => 'shop\admin', 'prefix' => 'admin'], function() {

		Route::resource('dashboard', 'DashboardController')->names('shop.admin.dashboard');

		Route::resource('orders', 'OrderController')->names('shop.admin.orders');

		Route::get('/orders/deleteOrder/{id}', 'OrderController@delete');

		Route::get('/orders/approve/{id}', 'OrderController@approve');

		Route::get('/orders/returnToRevision/{id}', 'OrderController@returnToRevision');

		Route::get('/orders/delivered/{id}', 'OrderController@delivered');

		Route::resource('products', 'ProductController')->names('shop.admin.products');

		Route::post('/products/ajax-image-upload', 'ProductController@uploadImage');

		Route::delete('/products/ajax-remove-image/{type}/{filename}/{key}', 'ProductController@deleteImage');

		Route::get('/products/toggleOn/{id}', 'ProductController@toggleOn');

		Route::get('/products/toggleOff/{id}', 'ProductController@toggleOff');

		Route::get('/products/deleteProduct/{id}/{title}', 'ProductController@delete');

		Route::resource('categories', 'CategoryController')->names('shop.admin.categories');

		Route::get('/categories/deleteCategory/{id}/{title}', 'CategoryController@delete');

		Route::resource('users', 'UserController')->names('shop.admin.users');

	});

});

