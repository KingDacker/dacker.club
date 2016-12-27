<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CommonController;
use App\Http\Requests;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    #创建投稿
    public function create(Request $request){

        if ($request->isMethod('post')) {
            #检测
            $rules = [
                'title' => 'required|between:5,15',
                'type' => 'required|in:1,2,3',
                'payments' => 'numeric|between:0.00,100000',
                'image_arr' => 'required'
            ];
            $messages = [
                'title.required' => '错误的请求1',
                'title.between' => '错误的请求2',
                'type.required' => '错误的请求3',
                'type.in' => '错误的请求4',
                'payments.numeric' => '错误的请求5',
                'payments.between' => '错误的请求6',
                'image_arr.required' => '错误的请求7'
            ];
            $validator = Validator::make($request->all(),$rules,$messages);
            if($validator->fails()){
                return CommonController::echoJson(400,'投稿失败,请稍后再试');
            }
            $user_info = session('user');
            $data['user_id'] = $user_info['id'];
            $data['title'] = $request->get('title');
            $data['content'] = $request->get('content');
            $data['type'] = $request->get('type');
            $data['payments'] = $request->get('payments');
            $post_id = Post::insertGetId($data);
            if(!$post_id){
                return CommonController::echoJson(401,'投稿失败,请稍后再试');
            }
            $image_arr = $request->get('image_arr');
            foreach($image_arr as $key=>$value){
                PostImage::insert(['post_id'=>$post_id ,'image' => $value]);
            }
            return CommonController::echoJson(200,'投稿成功');
        }else{
            $data = ['page_title'=>'申请投稿','user'=>session('user')];
            #dd($data['user']);
            return view('post.create')->with('data',$data);
        }
    }

    #投稿列表
    public function lists(){
        $user_info = session('user');
        $post_list = Post::where('user_id',$user_info['id'])->where('status',1)->get();
    }

    #投稿详情
    public function detail(){
        $user_info = session('user');
        $post_detail = Post::leftjoin('post_images','posts.id','=','post_images.post_id')
            ->where('posts.user_id',$user_info['id'])
            ->where('posts.status',1)
            ->select('posts.*','post_images.*')->get();

        dd($post_detail);
    }

}
