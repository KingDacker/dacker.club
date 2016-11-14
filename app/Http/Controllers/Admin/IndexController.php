<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index()
    {
        view()->share('page_title','首页');
        $tasks = [
            [
                'name' => '',
                'progress' => '87',
                'color' => 'danger'
            ],
            [
                'name' => 'gaoshanshan',
                'progress' => '76',
                'color' => 'warning'
            ],
            [
                'name' => 'wangyixuan',
                'progress' => '32',
                'color' => 'success'
            ],
            [
                'name' => 'zoujian',
                'progress' => '56',
                'color' => 'info'
            ],
            [
                'name' => 'xiaoluoli',
                'progress' => '10',
                'color' => 'success'
            ]
        ];
        return view('admin.index.index',compact('tasks'));
    }

    #修改密码
    public function password()
    {
        view()->share('page_title','修改密码');
        if($data = Input::all()){
            $rules = [
                'password'=> 'required',
                'new_password' => 'required|between:6,20',
                'new_password_again' => 'same:new_password'
            ];
            $messages = [
                'password.required' => '旧密码不能为空',
                'new_password.between' => '新密码为6-20位',
                'new_password_again.same' => '新密码不一致',
            ];
            $validator = Validator::make($data,$rules,$messages);
            if($validator->fails()){
                return back()->withErrors($validator);
            }
            $user = Session::get('user');
            $password = Crypt::decrypt($user->password);
            if($password != $data['password']){
                return back()->with('errors','原密码错误');
            }
            #更新
            $new_password = Crypt::encrypt($data['new_password']);
            $user->password = $new_password;
            if($user->save()){
                return back()->with('success','密码修改成功');
            }

        }
        return view('admin.index.password');
    }



}
