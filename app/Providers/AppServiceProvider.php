<?php

namespace App\Providers;

use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Controller;
use Illuminate\Support\ServiceProvider;
use Illuminate\Session;
use Illuminate\Support\Facades\DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('page_description',' ---- DackerClub ');
        #用户
        view()->share('user_type',Controller::userType());
        view()->share('user_identity',Controller::userIdentity());
        view()->share('status',Controller::userStatus());
        view()->share('pay_status',Controller::payStatus());
        view()->share('user_gender',Controller::gender());
        #帖子
        view()->share('post_type',Controller::postType());
        view()->share('post_pay_type',Controller::postPayType());
        view()->share('post_status',Controller::postStatus());
        DB::listen(function($sql) {
            //dump($sql);
            // echo $sql->sql;
            // dump($sql->bindings);
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
