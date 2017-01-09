<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonController;
use App\Http\Requests;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostController extends CommonController
{
    #创建投稿
    public function create(Request $request){

        if ($request->isMethod('post')) {
            #TODO 权限认证
            #检测
            $rules = [
                'title' => 'required|between:5,15',
                'type' => 'required|in:1,2,3,4,5',
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
            #dd($validator->errors()->all());
            if($validator->fails()){
                return Controller::echoJson(400,'投稿失败,请稍后再试');
            }
            $user_info = session('user');
            $data['user_id'] = $user_info['id'];
            $data['title'] = $request->get('title');
            $data['content'] = $request->get('content');
            $data['type'] = $request->get('type');
            $data['payments'] = $request->get('payments');
            $post_id = Post::insertGetId($data);
            if(!$post_id){
                return Controller::echoJson(401,'投稿失败,请稍后再试');
            }
            $image_arr = $request->get('image_arr');
            foreach($image_arr as $key=>$value){
                PostImage::insert(['post_id'=>$post_id ,'image' => $value]);
            }
            return Controller::echoJson(200,'投稿成功');
        }else{
            $data = [
                'page_title'=>'申请投稿',
                'user'=>session('user'),
                'checked_menu'  =>  ['level1'=>'投稿列表','level2'=>'开始投稿'],
            ];
            #dd($data['user']);
            return view('post.create')->with('data',$data);
        }
    }

    #投稿列表
    public function lists(Request $request){
        $post_list = Post::where('user_id',session('user')['id'])
            ->where(function ($query) use ($request){
                if($request->get('status')){
                    $query->where('status',$request->get('status'));
                }
            })->orderBy('updated_at', 'desc')->paginate(10);
        foreach($post_list as $key=>$value){
            $post_list[$key]['status_str'] = Controller::postStatus($value['status']);
            $post_list[$key]['status_color'] = Controller::postStatusColor($value['status']);
            $post_list[$key]['type_str'] = Controller::postType($value['type']);
        }
        $condition = [
            'status'=>$request->get('status'),
        ];
        $data = [
            'page_title'    =>  '投稿列表',
            'checked_menu'  =>  ['level1'=>'投稿列表','level2'=>'投稿状态'],
            'post_list' =>  $post_list,
            'condition' =>  $condition
        ];
        return view('post.list')->with('data',$data);

    }

    #投稿详情
    public function detail(){
        $data = [
            'page_title'    =>  '投稿列表',
            'checked_menu'  =>  ['level1'=>'投稿列表','level2'=>'投稿状态'],
        ];
        return view('post.list')->with('data',$data);
        $post_detail = Post::leftjoin('post_images','posts.id','=','post_images.post_id')
            ->where('posts.user_id',session('user')['id'])
            ->where('posts.status',1)
            ->select('posts.*','post_images.*')->get();

        dd($post_detail);
    }

}
