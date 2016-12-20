<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Crypt;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends CommonController
{

    public function index(){
        #dd(Crypt::decrypt('eyJpdiI6IlwvNDdESjBsdnpNdG5zRlVkdUNXN3NBPT0iLCJ2YWx1ZSI6IlpOQmFhVVJDZThaSjFwdStqazRcL2cxT3BtbjcybGh1V2hWVXhWblpoTWtJPSIsIm1hYyI6IjliY2VkMzRjODg5ZWJmNmRjZjA4Y2JjNWJhZTdiMjIyMjBmYTI3NDhjOWNlNmEyYzUyNzdmMzUxYTc3OTg5MjYifQ=='));
        return view('admin.login.login');
    }

    #登录
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password'             => 'required',
            'captcha'              => 'required'
        ], [
            'email.required' => '请输入邮箱或用户名称',
            'password.required'                  => '请输入用户密码',
            'captcha.required'                   => '请输入验证码'
        ]);
        if (Session::get('phrase') != $request->captcha) {
            return redirect()->back()->withInput($request->all())->withErrors(array('captcha' => '验证码不正确'));
        }
        #管理员
        $user = User::where('email',$request->email)->where('user_type',99)->first();
        if(!$user){
            return redirect()->back()->withInput($request->all())->withErrors(array('email' => '用户名或密码不正确'));
        }
        if(Crypt::decrypt($user->password) != $request->password ){
            return redirect()->back()->withInput($request->all())->withErrors(array('email' => '用户名或密码不正确'));
        }
        session(['admin_dacker'=>$user]);
        return redirect('admin/home');
    }

    public function logout()
    {
        session(['admin_dacker'=>null]);
        return redirect('admin/index');
    }

    public function code()
    {
        $builder = new CaptchaBuilder();
        $builder->build();
        Session::put('phrase', $builder->getPhrase());
        #$builder->inline();
        #生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
