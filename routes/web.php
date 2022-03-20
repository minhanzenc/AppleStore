<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ValidateController;


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

//-------------------------------------------- Frontend --------------------------------------------
Route::get('/','App\Http\Controllers\HomeController@indexpage');
Route::get('/home','App\Http\Controllers\HomeController@index');
Route::get('/store','App\Http\Controllers\HomeController@product');
Route::get('/blog-list','App\Http\Controllers\HomeController@blog_list');
Route::post('/search','App\Http\Controllers\HomeController@search');
Route::post('/autocomplete-ajax','App\Http\Controllers\HomeController@autocomplete_ajax');
Route::get('/wistlist','App\Http\Controllers\HomeController@wistlist');

//Danh muc san pham trang chu
Route::get('/product-list/{category_product_slug}','App\Http\Controllers\CategoryProductController@show_category_home');
Route::get('/product/{product_slug}','App\Http\Controllers\ProductController@details_product');

//Danh muc bai viet
Route::get('/blogs/{post_slug}','App\Http\Controllers\PostController@show_category_post_home');
Route::get('/blog/{post_slug}','App\Http\Controllers\PostController@show_post_home');


//-------------------------------------------- Backend --------------------------------------------
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout','App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');

Route::post('/filter-by-date','App\Http\Controllers\AdminController@filter_by_date');
Route::post('/dashboard-filter','App\Http\Controllers\AdminController@dashboard_filter');
Route::post('/days-order','App\Http\Controllers\AdminController@days_order');

//Customer

//Admin
Route::get('/add-customer-admin','App\Http\Controllers\CustomerController@add_customer_admin');
Route::get('/list-customer','App\Http\Controllers\CustomerController@list_customer');
Route::get('/edit-customer/{customer_id}','App\Http\Controllers\CustomerController@edit_customer');
Route::get('/delete-customer/{customer_id}','App\Http\Controllers\CustomerController@delete_customer');

Route::post('/save-customer','App\Http\Controllers\CustomerController@save_customer');
Route::post('/update-customer/{customer_id}','App\Http\Controllers\CustomerController@update_customer');

//Front End
Route::get('/login-checkout','App\Http\Controllers\CustomerController@login_checkout');
Route::get('/create-customer','App\Http\Controllers\CustomerController@create_customer');
Route::get('/logout-checkout','App\Http\Controllers\CustomerController@logout_checkout');
Route::post('/login-customer','App\Http\Controllers\CustomerController@login_customer');
Route::post('/add-customer','App\Http\Controllers\CustomerController@add_customer');
Route::get('/account-information/{customer_id}','App\Http\Controllers\CustomerController@account_information');
Route::get('/account-settings/{customer_id}','App\Http\Controllers\CustomerController@account_settings');
Route::get('/delete-avata/{customer_id}','App\Http\Controllers\CustomerController@delete_avata');

Route::post('/update-information/{customer_id}','App\Http\Controllers\CustomerController@update_information');


//login customer by google
Route::get('/login-customer-google','App\Http\Controllers\AdminController@login_customer_google');
Route::get('/customer/google/callback','App\Http\Controllers\AdminController@callback_customer_google');

// Producer
Route::get('/add-producer','App\Http\Controllers\ProducerController@add_producer');
Route::get('/list-producer','App\Http\Controllers\ProducerController@list_producer');
Route::get('/edit-producer/{producer_id}','App\Http\Controllers\ProducerController@edit_producer');
Route::get('/delete-producer/{producer_id}','App\Http\Controllers\ProducerController@delete_producer');

Route::get('/active-producer/{producer_id}','App\Http\Controllers\ProducerController@active_producer');
Route::get('/unactive-producer/{producer_id}','App\Http\Controllers\ProducerController@unactive_producer');

Route::post('/save-producer','App\Http\Controllers\ProducerController@save_producer');
Route::post('/update-producer/{producer_id}','App\Http\Controllers\ProducerController@update_producer');


// Category Product
Route::get('/add-category-product','App\Http\Controllers\CategoryProductController@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProductController@all_category_product');
Route::get('/edit-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@delete_category_product');

Route::get('/active-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@active_category_product');
Route::get('/unactive-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@unactive_category_product');

Route::post('/save-category-product','App\Http\Controllers\CategoryProductController@save_category_product');
Route::post('/update-category-product/{category_product_id}','App\Http\Controllers\CategoryProductController@update_category_product');

Route::post('/arrange-category','App\Http\Controllers\CategoryProductController@arrange_category');

//Attributes
Route::get('/add-attribute','App\Http\Controllers\AttributesController@add_attribute');
Route::get('/list-attribute','App\Http\Controllers\AttributesController@list_attribute');
Route::post('/save-attribute','App\Http\Controllers\AttributesController@save_attribute');


// Product
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');
Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');

Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');
Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');

Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');

Route::post('/load-comment','App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment','App\Http\Controllers\ProductController@send_comment');
Route::get('/comment','App\Http\Controllers\ProductController@list_comment');
Route::post('/allow-comment','App\Http\Controllers\ProductController@allow_comment');
Route::post('/reply-comment','App\Http\Controllers\ProductController@reply_comment');
Route::post('/insert-rating','App\Http\Controllers\ProductController@insert_rating');

//Cart
Route::post('/update-cart','App\Http\Controllers\CartController@update_cart');
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::get('/cart','App\Http\Controllers\CartController@gio_hang');
Route::post('/add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/del-product/{session_id}','App\Http\Controllers\CartController@delete_product');
Route::get('/count-cart-products','App\Http\Controllers\CartController@count_cart_products');


//Contact
Route::get('/lien-he','App\Http\Controllers\ContactController@contact');
Route::get('/information','App\Http\Controllers\ContactController@information' );
Route::post('/save-info','App\Http\Controllers\ContactController@save_info' );
Route::post('/update-info/{info_id}','App\Http\Controllers\ContactController@update_info' );


//Coupon
Route::post('/check-coupon','App\Http\Controllers\CartController@check_coupon');

Route::get('/unset-coupon','App\Http\Controllers\CouponController@unset_coupon');
Route::get('/insert-coupon','App\Http\Controllers\CouponController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}','App\Http\Controllers\CouponController@delete_coupon');
Route::get('/list-coupon','App\Http\Controllers\CouponController@list_coupon');
Route::post('/insert-coupon-code','App\Http\Controllers\CouponController@insert_coupon_code');
Route::get('/active-coupon/{coupon_id}','App\Http\Controllers\CouponController@active_coupon');
Route::get('/unactive-coupon/{coupon_id}','App\Http\Controllers\CouponController@unactive_coupon');

//Category Post

Route::get('/add-category-post','App\Http\Controllers\CategoryPostController@add_category_post');
Route::get('/list-category-post','App\Http\Controllers\CategoryPostController@list_category_post');
Route::get('/edit-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@edit_category_post');
Route::get('/delete-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@delete_category_post');

Route::get('/blogs/{category_post_slug}','App\Http\Controllers\CategoryPostController@danh_muc_bai_viet');
Route::get('/active-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@active_category_post');
Route::get('/unactive-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@unactive_category_post');

Route::post('/save-category-post','App\Http\Controllers\CategoryPostController@save_category_post');
Route::post('/update-category-post/{category_post_id}','App\Http\Controllers\CategoryPostController@update_category_post');


//Post

Route::get('/add-post','App\Http\Controllers\PostController@add_post');
Route::get('/list-post','App\Http\Controllers\PostController@list_post');
Route::get('/edit-post/{post_id}','App\Http\Controllers\PostController@edit_post');
Route::get('/delete-post/{post_id}','App\Http\Controllers\PostController@delete_post');

Route::post('/save-post','App\Http\Controllers\PostController@save_post');
Route::post('/update-post/{post_id}','App\Http\Controllers\PostController@update_post');

Route::get('/active-post/{post_id}','App\Http\Controllers\PostController@active_post');
Route::get('/unactive-post/{post_id}','App\Http\Controllers\PostController@unactive_post');


//Checkout

Route::post('/order-place','App\Http\Controllers\CheckoutController@order_place');

Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment','App\Http\Controllers\CheckoutController@payment');
Route::post('/save-checkout-customer','App\Http\Controllers\CheckoutController@save_checkout_customer');

Route::post('/select-delivery-home','App\Http\Controllers\CheckoutController@select_delivery_home');
Route::post('/confirm-order','App\Http\Controllers\CheckoutController@confirm_order');

//Order
Route::get('/manage-order','App\Http\Controllers\OrderController@manage_order');
Route::get('/view-order/{order_code}','App\Http\Controllers\OrderController@view_order');
Route::get('/print-order/{checkout_code}','App\Http\Controllers\OrderController@print_order');
Route::get('/delete-order/{order_code}','App\Http\Controllers\OrderController@delete_order_code');
Route::post('/update-order-qty','App\Http\Controllers\OrderController@update_order_qty');
Route::post('/update-qty','App\Http\Controllers\OrderController@update_qty');

//Delivery
Route::get('/delivery','App\Http\Controllers\DeliveryController@delivery');
Route::post('/select-delivery','App\Http\Controllers\DeliveryController@select_delivery');
Route::post('/insert-delivery','App\Http\Controllers\DeliveryController@insert_delivery');
Route::post('/select-feeship','App\Http\Controllers\DeliveryController@select_feeship');
Route::post('/update-delivery','App\Http\Controllers\DeliveryController@update_delivery');

//Slider
Route::get('/list-slider','App\Http\Controllers\SliderController@list_slider');
Route::get('/add-slider','App\Http\Controllers\SliderController@add_slider');
Route::get('/delete-slider/{slider_id}','App\Http\Controllers\SliderController@delete_slider');
Route::get('/edit-slider/{slider_id}','App\Http\Controllers\SliderController@edit_slider');

Route::post('/insert-slider','App\Http\Controllers\SliderController@insert_slider');
Route::post('/update-slider/{slider_id}','App\Http\Controllers\SliderController@update_slider');

Route::get('/unactive-slider/{slider_id}','App\Http\Controllers\SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}','App\Http\Controllers\SliderController@active_slider');

//Gallery
Route::get('add-gallery/{product_id}','App\Http\Controllers\GalleryController@add_gallery');
Route::post('select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('insert-gallery/{pro_id}','App\Http\Controllers\GalleryController@insert_gallery');
Route::post('update-gallery-name','App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('delete-gallery','App\Http\Controllers\GalleryController@delete_gallery');
Route::post('update-gallery','App\Http\Controllers\GalleryController@update_gallery');


//Document
// Route::get('upload_file','DocumentController@upload_file');
// Route::get('upload_image','DocumentController@upload_image');

//Folder
// Route::get('create_folder','DocumentController@create_folder');
// Route::get('rename_folder','DocumentController@rename_folder');
// Route::get('delete_folder','DocumentController@delete_folder');

// Route::get('list_document','DocumentController@list_document');
// Route::get('read_data','DocumentController@read_data');


//Send Mail 
Route::get('/send-coupon-vip/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','App\Http\Controllers\MailController@send_coupon_vip');
Route::get('/send-coupon-regular/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','App\Http\Controllers\MailController@send_coupon_regular');

Route::get('/mail-example','MailController@mail_example');

Route::get('/send-mail','App\Http\Controllers\MailController@send_mail');
Route::get('/iforgot','App\Http\Controllers\MailController@iforgot');
Route::post('/recover-pass','App\Http\Controllers\MailController@recover_pass');
Route::get('/update-new-pass','App\Http\Controllers\MailController@update_new_pass');
Route::post('/reset-new-pass','App\Http\Controllers\MailController@reset_new_pass');
