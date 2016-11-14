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
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return redirect()->back()->withInput($request->all())->withErrors(array('email' => '用户名或密码不正确'));
        }
        //dd(Crypt::encrypt('123456'));
        //dd($user->password);
        //dd(Crypt::decrypt($user->password));
        if(Crypt::decrypt($user->password) != $request->password ){
            dd($user);
            return redirect()->back()->withInput($request->all())->withErrors(array('email' => '用户名或密码不正确'));
        }

        session(['user'=>$user]);
        return redirect('admin/home');
    }

    public function logout()
    {
        session(['user'=>null]);
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
