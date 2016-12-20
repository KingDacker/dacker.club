<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\CommonController;
use Closure;
use App\Http\Requests;
use App\Http\Requests\Request;


class UserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #ajax判断
        if($request->ajax()){
            if(!session('user')){
                return CommonController::echoJson(199,'please login first','/login/signin');
            }
        }else{
            if(!session('user')){
                return redirect('login/signin');
            }
        }

        return $next($request);
    }
}
