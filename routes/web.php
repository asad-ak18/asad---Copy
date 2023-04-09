<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\WebSController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SslCommerzPaymentController;



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

// Route::get('/', function(){
//     return view('welcome');
// });
// category controller
Route::get('Category/category', [CategoryController::class, 'category'])->name('category_home');
Route::post('Category/post', [CategoryController::class, 'category_post'])->name('category_post');
Route::get('Category/delete/{category_id}', [CategoryController::class, 'Category_delete'])->name('Category_delete');
Route::get('Category/category/all/delete', [CategoryController::class,'category_delete_all'])->name('category_delete_all');
Route::get('Category/edit/{category_id}', [CategoryController::class,'category_edit'])->name('category_edit');
Route::post('Category/post/edit', [CategoryController::class,'category_edit_post'])->name('category_edit_post');
Route::get('Category/restore/{deleted_category_id}', [CategoryController::class,'category_restore'])->name('category_restore');
Route::get('Category/all_restore/{deleted_category_id}', [CategoryController::class,'category_all_restore'])->name('category_all_restore');

Route::get('Category/forcedelete/{forcdeleted_category_id}',[CategoryController::class,'category_forcedelete'])->name('category_forcedelete');
Route::post('Category/check/delete',[CategoryController::class,'category_checkdelete'])->name('category_checkdelete');

// sub category
Route::get('subCategory/SubCategory',[SubCategoryController::class,'SubCategory'])->name('SubCategory_home');
Route::post('sub_Category_post',[SubCategoryController::class,'sub_Category_post'])->name('sub_Category_post');

// product controller
Route::get('Product/product', [ProductController::class,'product'])->name('product_home');
Route::post('Product/post', [ProductController::class,'product_post'])->name('product_post');
Route::get('Product/delete/{product_id}', [ProductController::class,'product_delete'])->name('product_delete');
Route::get('Product/product_edit/{product_id}', [ProductController::class,'product_edit'])->name('product_edit');
Route::post('Product/post/product_edit/{product_id}',
[ProductController::class,'product_edit_post'])->name('product_edit_post');
Route::get('Product/all_delete', [ProductController::class,'product_all_delete'])->name('product_all_delete');
Route::get('Product/restore/{product_id}', [ProductController::class,'product_restore'])->name('product_restore');
Route::get('Product/all_restore/{product_id}',[ProductController::class,'product_all_restore'])->name('product_all_restore');
Route::get('Product/forcedelete/{force_delete_product_id}',[ProductController::class,'product_forcedelete'])->name('product_forcedelete');





// home controller
Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('download/invoice/{order_id}', [HomeController::class, 'download_invoice'])->name('download_invoice');
Route::get('give/review/{order_id}', [HomeController::class, 'give_review'])->name('give_review');
Route::post('/review/post/{order_details_id}', [HomeController::class, 'review_post'])->name('review_post');






// FrontendController
Route::get('/', [FrontendController::class, 'tohoney_home'])->name('tohoney_home');
Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('contact/post', [FrontendController::class, 'contact_post'])->name('contact_post');
Route::get('about', [FrontendController::class, 'about'])->name('about');
Route::get('shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('productdetail/{product_id}', [FrontendController::class, 'productdetail'])->name('productdetail');
Route::get('checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('checkout/post', [FrontendController::class, 'checkout_post'])->name('checkout_post');
Route::get('wishlist', [FrontendController::class, 'wishlist'])->name('wishlist');
Route::get('blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('blogdetail', [FrontendController::class, 'blogdetail'])->name('blogdetail');
Route::get('faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('categorywise/shop/{category_id}', [FrontendController::class, 'categorywise'])->name('categorywise');
Route::get('cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('cart/{coupon_name}', [FrontendController::class, 'cart'])->name('cart_coupon');
Route::get('customer_signup', [FrontendController::class, 'customer_register'])->name('customer_register');
Route::post('customer_signup_post', [FrontendController::class,'customer_register_post'])->name('customer_register_post');
Route::get('customer_signin', [FrontendController::class, 'customer_signin'])->name('customer_signin');
Route::post('customer_signin_post', [FrontendController::class,'customer_signin_post'])->name('customer_signin_post');
Route::post('get/city/list', [FrontendController::class,'get_city_list']);
// faq controller
Route::get('faq_form', [FaqController::class, 'faq_form'])->name('faq_form');
Route::post('faq_form/post', [FaqController::class, 'faq_form_post'])->name('faq_form_post');
Route::get('productdetail_faq/{product_id}', [FrontendController::class,
'productdetail_faq'])->name('productdetail_faq');
Route::post('productdetail_faq/post', [FrontendController::class,'productdetail_faq_post'])->name('productdetail_faq_post');
Route::post('update/cart', [FrontendController::class,'update_cart'])->name('update_cart');
Route::get('search', [FrontendController::class,'search'])->name('search');


// web_s controller
Route::get('web_s', [WebSController::class,'web_s'])->name('web_s');
Route::post('settings_post', [WebSController::class,'settings_post'])->name('settings_post');


// cart controller
Route::post('cart_post/{product_id}', [cartController::class, 'cart_post'])->name('cart_post');
Route::get('cart/delete/{cart_id}', [cartController::class, 'cart_delete'])->name('cart_delete');
// coupon controller
Route::resource('coupon',CouponController::class);


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('online/payment', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('sslpay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


