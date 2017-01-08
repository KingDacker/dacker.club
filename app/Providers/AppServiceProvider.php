<?php

namespace App\Providers;

use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Controller;
use Illuminate\Support\ServiceProvider;
use Illuminate\Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('page_description',' ---- Dacker.club ');
        #用户
        view()->share('user_type',Controller::userType());
        view()->share('status',Controller::userStatus());
        view()->share('pay_status',Controller::payStatus());
        #帖子
        view()->share('post_type',Controller::postType());
        view()->share('post_pay_type',Controller::postPayType());
        view()->share('post_status',Controller::postStatus());

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
