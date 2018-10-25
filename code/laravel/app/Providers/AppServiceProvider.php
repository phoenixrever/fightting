<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer("*",function($view){
            $data =array(
                'user_1' => asset("admin_doc/assets/img/user/user-1.jpg"),
                'user_2' => asset("admin_doc/assets/img/user/user-2.jpg"),
                'user_3' => asset("admin_doc/assets/img/user/user-3.jpg"),
                'user_4' => asset("admin_doc/assets/img/user/user-4.jpg"),
                'user_5' => asset("admin_doc/assets/img/user/user-5.jpg"),
                'user_6' => asset("admin_doc/assets/img/user/user-6.jpg"),
                'user_7' => asset("admin_doc/assets/img/user/user-7.jpg"),
                'user_8' => asset("admin_doc/assets/img/user/user-8.jpg"),
                'user_9' => asset("admin_doc/assets/img/user/user-9.jpg"),
                'user_13' => asset("admin_doc/assets/img/user/user-13.jpg"),
                'logo_bs4' => asset("admin_doc/assets/img/logo/logo-bs4.png"),
                'gallery_1' => asset("admin_doc/assets/img/gallery/gallery-1.jpg"),
                'gallery_10' => asset("admin_doc/assets/img/gallery/gallery-10.jpg"),
                'gallery_7' => asset("admin_doc/assets/img/gallery/gallery-7.jpg"),
                'gallery_8' => asset("admin_doc/assets/img/gallery/gallery-8.jpg"),
                'product_1' => asset("admin_doc/assets/img/product/product-1.png"),
                'product_2' => asset("admin_doc/assets/img/product/product-2.png"),
                'product_3' => asset("admin_doc/assets/img/product/product-3.png"),
                'product_4' => asset("admin_doc/assets/img/product/product-4.png"),
                'product_5' => asset("admin_doc/assets/img/product/product-5.png"),
            );
            $view->with($data);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
