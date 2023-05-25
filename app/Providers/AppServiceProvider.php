<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Orders;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $product_donut = Product::all()->count();
            $order_donut = Orders::all()->count();
            $user_donut = User::where('role_id', 2)->count();
            $view->with('product_donut', $product_donut)->with('order_donut', $order_donut)->with('user_donut', $user_donut);
        });
    }
}
