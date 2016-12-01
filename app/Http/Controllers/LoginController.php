<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    #登录
    public function signin(Request $request)
    {
        return view('login/signin');
    }

    #注册
    public function signup(Request $request)
    {

        if($data = Input::all()){
            #dd(strlen($data['nick_name']));
            $rules = [
                'nick_name'=> 'required|between:2,8',
                'email' => 'required|email',
                'password' => 'required|between:6,20'
            ];
            $messages = [
                'nick_name.required' => '请输入昵称',
                'nick_name.between' => '昵称长度为2-8',
                'email.required' => '请输入正确的邮箱',
                'password.required' => '请输入密码',
                'password.between'=> '密码长度为6-20'
            ];
            $validator = Validator::make($data,$rules,$messages);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput($request->all());
            }
            #昵称唯一性
            $rs = User::where('nick_name',$data['nick_name'])->first();
            if($rs){
                return back()->with('errors','昵称已经被占用')->withInput($request->all());
            }
            #邮箱唯一性
            $rs = User::where('email',$data['email'])->first();
            if($rs){
                return back()->with('errors','邮箱已经被注册')->withInput($request->all());
            }
            #name_id唯一性
            $data['name_id'] = $this->getRollBack();
            $id = User::insertGetId($data);
            if(!$id){
                return back()->with('errors','注册失败,请联系站长')->withInput($request->all());
            }

        }
        return view('login/signup');
    }

    #name_id 随机算法
    #生成验证码
    #length 随机字符长度
    #mode 随机字符类型
    #0为大小写英文和数字,1为数字,2为小写字母,3为大写字母,4为大小写字母,5为大写字母和数字,6为小写字母和数字
    public function getNameId($length=9,$mode=1){

        switch ($mode)
        {
            case '1':
                $str='123456789';
                break;
            case '2':
                $str='abcdefghijklmnopqrstuvwxyz';
                break;
            case '3':
                $str='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case '4':
                $str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                break;
            case '5':
                $str='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                break;
            case '6':
                $str='abcdefghijklmnopqrstuvwxyz1234567890';
                break;
            default:
                $str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
                break;
        }
        $number = '0123456789';
        $code='';
        $len=strlen($str)-1;
        for ($i=0;$i<$length;$i++)
        {
            $num=mt_rand(0,$len);//产生一个0到$len之间的随机数
            if($i==0){
                $code.=$str[$num];
            }else{
                $code.=$number[$num];
            }

        }
        return $code;
    }

    #回调生成name_id
    public function getRollBack(){
        $name_id = $this->getNameId();
        $rs = User::where('name_id',$name_id)->first();
        if($rs){
            $this->getRollBack();
        }else{
            return $name_id;
        }
    }



}
