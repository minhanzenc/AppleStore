<?php

namespace App\Providers;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Order;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view) {

            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');

            $min_price_range = $min_price + 500000;
            $max_price_range = $max_price + 10000000;
            
            $app_product = Product::all()->count();
            $app_post = Post::all()->count();
            $app_order = Order::all()->count();
            $app_customer = Customer::all()->count();
            $share_image = '';

            $view->with('min_price', $min_price )->with('max_price', $max_price )->with('min_price_range', $min_price_range )->with('max_price_range', $max_price_range )->with('app_product', $app_product )->with('app_post', $app_post )->with('app_order', $app_order )->with('app_customer', $app_customer )->with('share_image',$share_image);

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
