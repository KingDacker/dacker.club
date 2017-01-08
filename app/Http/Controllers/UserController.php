<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Post;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use zgldh\QiniuStorage\QiniuStorage;

class UserController extends CommonController
{

    #个人资料
    public function info(){
        #dd(session('user')->userinfo);
        $user_id = session('user')['id'];
        $user = session('user');
        $user_info = $user['user_info'];
        #dd($user_info);
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
    public function changePassword(){

    }







}
