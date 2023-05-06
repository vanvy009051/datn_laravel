<?php

use App\Http\Controllers\HomesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});

// Forgot Password

Route::view('forgot_password', 'auth.passwords.reset')->name('password.reset');

// Frontend routes
Route::get('/', 'HomesController@index');
Route::get('/user-login', 'HomesController@login');
Route::get('/sign-up', 'HomesController@signup');
Route::get('/contact', 'HomesController@contact');
Route::get('/shop', 'HomesController@shop');
Route::post('/search', 'HomesController@show_search');
Route::get('/layout', 'HomesController@layout');

Route::get('/category/{category_id}', 'CategoryController@show_category_home');
Route::get('/brand/{brand_id}', 'BrandController@show_brand_home');

// Login Facebook Controller
Route::get('/login-facebook/{provider}', 'AdminController@login_facebook');
Route::get('/user-login/callback', 'AdminController@callback_facebook');

// Backend routes
Route::get('/admin-login', 'AdminController@login');
Route::get('/logout', 'AdminController@logout');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::post('/admin-dashboard', 'AdminController@show_dashboard');

// User routes
Route::get('/user-logout', 'UserController@user_logout');
Route::post('/user-sign-up', 'UserController@user_sign_up');
Route::post('/user-dashboard', 'UserController@user_dashboard');

// User routes manager
Route::get('/add-user', 'AdminController@add_user');
Route::get('/edit-user/{user_id}', 'AdminController@edit_user');
Route::get('/delete-user/{user_id}', 'AdminController@delete_user');
Route::get('/all-user', 'AdminController@all_user');

Route::post('/save-user', 'AdminController@save_user');
Route::post('/update-user/{user_id}', 'AdminController@update_user');

// Category routes
Route::get('/add-category', 'CategoryController@add_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');
Route::get('/all-category', 'CategoryController@all_category');

Route::get('/unactive-category/{category_id}', 'CategoryController@unactive_category');
Route::get('/active-category/{category_id}', 'CategoryController@active_category');

Route::post('/save-category', 'CategoryController@save_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');

// Brands routes
Route::get('/add-brand', 'BrandController@add_brand');
Route::get('/edit-brand/{brand_id}', 'BrandController@edit_brand');
Route::get('/delete-brand/{brand_id}', 'BrandController@delete_brand');
Route::get('/all-brand', 'BrandController@all_brand');

Route::get('/unactive-brand/{brand_id}', 'BrandController@unactive_brand');
Route::get('/active-brand/{brand_id}', 'BrandController@active_brand');

Route::post('/save-brand', 'BrandController@save_brand');
Route::post('/update-brand/{brand_id}', 'BrandController@update_brand');

// Product routes
Route::get('/add-product', 'ProductController@add_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@product_detail');

Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');

Route::post('/save-product', 'ProductController@save_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');


// Cart Controller
Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-cart-item/{rowId}', 'CartController@delete_cart_item');
Route::get('/update-cart-item/{rowId}', 'CartController@update_cart_item');
Route::post('/update-cart-qty', 'CartController@update_cart_qty');
Route::post('/update-cart-qty', 'CartController@update_cart_qty');
Route::post('/update-cart-ajax', 'CartController@update_cart_ajax');

// Cart Ajax
Route::post('/add-cart-ajax', 'CartController@add_cart_ajax');
Route::get('/cart', 'CartController@show_cart_ajax');
Route::get('/delete-product-cart-ajax/{session_id}', 'CartController@delete_cart_ajax');
Route::get('/del-all-product-cart-ajax', 'CartController@del_all_product_cart_ajax');

// Checkout 
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::post('/check-customer', 'CheckoutController@check_customer');
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save-checkout', 'CheckoutController@save_checkout');
Route::post('/place-order', 'CheckoutController@place_order');
Route::get('/payment', 'CheckoutController@payment');

// Order Controller
Route::get('/manager-order', 'CheckoutController@manager_order');
Route::get('/view-order/{order_id}', 'CheckoutController@view_order');

// Send email controller
Route::get('/send-mail', 'MailController@send_mail');

// Coupon Controller
Route::get('/add-coupon', 'CouponController@add_coupon');
Route::post('/save-coupon', 'CouponController@add_coupon');


// Routes Policies
Route::get('/term-and-conditions', 'PoliciesController@term_and_conditions');

// Routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
