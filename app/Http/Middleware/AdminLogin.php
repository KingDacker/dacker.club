<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    #后台判定登录
    public function handle($request, Closure $next)
    {
        if(!session('admin_dacker')){
            return redirect('admin/index');
        }
        return $next($request);
    }
}
