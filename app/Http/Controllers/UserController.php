<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Post;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use zgldh\QiniuStorage\QiniuStorage;

class UserController extends CommonController
{

    #个人资料
    public function info($id=null){

        if($id){
            #查看其它用户
            $user_id = $id;
            $user = User::find($user_id);
            $user = CommonController::perfectUser($user,true);
            $user_info = $user['user_info'];
        }else{
            #查看自己
            $user_id = session('user')['id'];
            $user = session('user');
            $user_info = $user['user_info'];
        }
        $user['post_num'] = Post::where('status',2)->where('user_id',$user_id)->count();
        $post_list = Post::where('status',2)->where('user_id',$user_id)->select('id','title','content','created_at')->get();
        if($post_list->count()>0){
            foreach($post_list as $key=>$value){
                if(strlen($value['content'])>30){
                    $post_list[$key]['content'] = mb_substr($value['content'],0,30  ,'utf-8').'...';
                }
            }
        }
        $data = [
            'page_title'    =>  '个人资料',
            'checked_menu'  =>  ['level1'=>'用户信息','level2'=>'个人资料'],
            'user'  =>  $user,
            'user_info' =>  $user_info,
            'post_list' =>  $post_list,
        ];
        return view('user.info')->with('data',$data);
    }
    #修改详细信息
    public function infoUpdate(Request $request){
        $user = session('user');
        $user_info = $user['user_info'];
        #更新
        if($request->isMethod('post')){
            $user = User::find($user['id']);
            $user->avatar = $request->get('avatar');
            $user->save();
            $user->userinfo->height = $request->get('height');
            $user->userinfo->weight = $request->get('weight');
            $user->userinfo->gender = $request->get('gender');
            $user->userinfo->mobile = $request->get('mobile');
            $user->userinfo->we_chat = $request->get('we_chat');
            $user->userinfo->introduce = $request->get('introduce');
            $user->userinfo->save();
            CommonController::perfectUser($user);
            return redirect('user/info')->with('success','成功');
        }
        $data = [
            'page_title'    =>  '修改个人资料',
            'checked_menu'  =>  ['level1'=>'用户信息','level2'=>'个人资料'],
            'user'  =>  $user,
            'user_info' =>  $user_info,
        ];
        return view('user.edit')->with('data',$data);
    }

    #修改密码
    public function password(Request $request){
        #更新
        if($request->isMethod('post')){
            $rules = [
                'password' => 'required',
                'new_password' => 'required|between:6,20',
                'new_password_com' => 'same:new_password'
            ];
            $messages = [
                'password.required' => '旧密码不能为空',
                'new_password.required' => '新密码不能为空',
                'new_password.between' => '新密码为6-20位',
                'new_password_com.same' => '新密码不一致',
            ];

            $validator = Validator::make($request->all(),$rules,$messages);
            if($validator->fails()){
                return back()->withErrors($validator);
            }
            #旧密码验证
            if(Crypt::decrypt(session('user')['password']) != $request->get('password') ){
                return back()->withErrors(array('旧密码不正确'));
            }
            #密码加密
            $new_password = Crypt::encrypt($request->get('new_password'));
            $rs = User::where('id',session('user')['id'])->update(['password'=>$new_password]);
            if(!$rs){
                return back()->with('errors','修改密码失败,请稍后再试');
            }
            session()->forget('user');
            #首页跳转
            return redirect('/')->with('success','修改密码成功,请去重新登录');
        }
        $data = [
            'page_title'    =>  '修改密码',
            'checked_menu'  =>  ['level1'=>'用户信息','level2'=>'修改密码'],
        ];
        return view('user.password')->with('data',$data);
    }







}
