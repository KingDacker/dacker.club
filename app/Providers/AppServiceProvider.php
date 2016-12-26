<?php

namespace App\Providers;

use App\Http\Controllers\Admin\CommonController;
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
        view()->share('user_type',CommonController::userType());
        view()->share('status',CommonController::userStatus());
        view()->share('pay_status',CommonController::payStatus());
        #帖子
        view()->share('post_type',CommonController::postType());
        view()->share('post_pay_type',CommonController::postPayType());
        view()->share('post_status',CommonController::postStatus());

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
