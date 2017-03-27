<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonController;
use App\Http\Requests;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Order;
use App\Models\OrderPost;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostController extends CommonController
{
    #创建投稿
    public function create(Request $request){
        $num = Post::where('user_id',session('user')['id'])->where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<',date('Y-m-d 23:59:59'))->count();

        if ($request->isMethod('post')) {
            #每天限制10条投稿
            if($num>10){
                return Controller::echoJson(400,'投稿失败,每天的只能投稿10此');
            }
            #检测
            $rules = [
                'title' => 'required|between:5,15',
                #'type' => 'required|in:1,2,3,4,5',
                'payments' => 'numeric|between:0.00,100000',
                'image_arr' => 'required'
            ];
            $messages = [
                'title.required' => '错误的请求1',
                'title.between' => '错误的请求2',
                #'type.required' => '错误的请求3',
                #'type.in' => '错误的请求4',
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
            #权限认证
            if($data['type'] == 1 && session('user')['user_type']<2){
                return Controller::echoJson(400,'投稿失败,您的权限不够,请先申请成为中级会员');
            }
            #随机点赞数
            $data['like_num'] = rand(19,99);
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
                'disable' => false
            ];
            if($num>10){
                $data['disable'] = true;
            }
            return view('post.create')->with('data',$data);
        }
    }

    #用户自己的投稿记录
    public function lists(Request $request){
        $post_list = Post::where('user_id',session('user')['id'])
            ->where(function ($query) use ($request){
                if($request->get('status')){
                    $query->where('status',$request->get('status'));
                }
            })->orderBy('id', 'desc')->paginate(10);
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
            'checked_menu'  =>  ['level1'=>'投稿列表','level2'=>'投稿记录'],
            'post_list' =>  $post_list,
            'condition' =>  $condition
        ];
        return view('post.list')->with('data',$data);

    }

    #投稿详情
    public function detail(Request $request,$id){
        #查看自己未通过审核的投稿
        $post = Post::where('id',$id)->where('user_id',session('user')['id'])->where('status','<>',2)->first();
        if($post){
            #选择导航菜单
            $type_str = Controller::postType($post['type']);
            #投稿图片
            $post_image = $post->postImage;
            foreach($post_image as $key=>$value){
                $post_image[$key]['image'] = Controller::showImage($value['image']);
            }
            #投稿作者
            $create_user = User::find($post['user_id']);
            $create_user = CommonController::perfectUser($create_user,true);
            $data = [
                'page_title'    =>  '投稿详情',
                'checked_menu'  =>  ['level1'=>$type_str,'level2'=>''],
                'post'  =>  $post,
                'post_image'    =>  $post_image,
                'user'  =>  $create_user,
            ];
            return view('post.pre_detail')->with('data',$data);
        }

        #审核通过的投稿
        $post = Post::where('id',$id)->where('status',2)->first();
        if(!$post){
            return view('errors.404');
        }
        #是否点赞了投稿
        $like = Like::where('user_id',session('user')['id'])->where('obj_id',$id)->where('type',1)->where('status',1)->first();
        $post['like_status'] = false;
        if($like){
            $post['like_status'] = true;
        }
        #是否关注了此作者
        $like = Like::where('user_id',session('user')['id'])->where('obj_id',$id)->where('type',2)->where('status',1)->first();
        $post['followers_status'] = false;
        if($like){
            $post['followers_status'] = true;
        }
        #投稿图片
        $post_image = $post->postImage;
        foreach($post_image as $key=>$value){
            $post_image[$key]['image'] = Controller::showImage($value['image']);
        }
        $create_user = User::find($post['user_id']);
        $create_user = CommonController::perfectUser($create_user,true);
        #选择导航菜单
        $type_str = Controller::postType($post['type']);
        #评论(每楼详细)
        $comments = Comment::where('post_id',$id)->where('reply_id',0)->where('status',1)->orderBy('created_at', 'asc')->paginate(10);
        #评论(每楼的回复详细)
        foreach($comments as $key=>$value){
            $user = User::find($value['user_id']);
            $comments[$key]['nick_name'] = $user['nick_name'];
            $comments[$key]['avatar_str'] = Controller::showAvatar($user['avatar']);
            #会员阶级,身份
            $comments[$key]['user_type_str'] = '初级会员';
            if($user['user_type']){
                $comments[$key]['user_type_str'] = Controller::userType($user['user_type']);
            }
            $comments[$key]['identity_str'] = '玩家';
            if($user->userInfo['identity']){
                $comments[$key]['identity_str'] = Controller::userIdentity($user->userInfo['identity']);
            }

            $reply_comment = Comment::where('post_id',$id)->where('reply_id',$value['id'])->where('status',1)->orderBy('created_at', 'asc')->get();
            foreach($reply_comment as $k=>$v){
                $user = User::find($v['user_id']);
                $reply_comment[$k]['nick_name'] = $user['nick_name'];
                $reply_comment[$k]['avatar_str'] = Controller::showAvatar($user['avatar']);
                #会员阶级,身份
                $reply_comment[$k]['user_type_str'] = is_array(Controller::userType($user['user_type'])) ? '初级会员' : Controller::userType($user['user_type']);
                $reply_comment[$k]['identity_str'] = is_array(Controller::userIdentity($user->userInfo['identity'])) ? '玩家' : Controller::userIdentity($user->userInfo['identity']);
                $user = User::find($v['to_user_id']);
                $reply_comment[$k]['to_nick_name'] = $user['nick_name'];
            }
            $comments[$key]['reply'] = $reply_comment;
        }
        #dd($comments);
        #其他最新作品
        $other_post = Post::where('id','<>',$id)->where('user_id',$post['user_id'])->where('status',2)->orderby('created_at','desc')->limit(3)->get();
        if($other_post){
            foreach( $other_post as $key=>$value){
                $image = PostImage::where('post_id',$value['id'])->orderby('id')->first();
                $other_post[$key]['image'] = Controller::showImage($image['image']);
            }
        }
        #是否购买了此投稿
        $order_post = OrderPost::where('post_id',$id)->where('user_id',session('user')['id'])->first();
        #$order = Order::where('user_id',session('user')['id'])->where('order_status','>',1)->first();
        $order_status = false;
        #购买了此投稿 || 自己的投稿 || 售价为0
        if(($order_post) || ($post['user_id']==session('user')['id']) || $post['payments'] == 0){
            #显示图片
            $order_status = true;
        }
        $data = [
            'page_title'    =>  '投稿详情',
            'checked_menu'  =>  ['level1'=>$type_str,'level2'=>''],
            'post'  =>  $post,
            'post_image'    =>  $post_image,
            'user'  =>  $create_user,
            'comments'  =>  $comments,
            'other_post'    =>  $other_post,
            'order_status'  =>  $order_status
        ];
        return view('post.detail')->with('data',$data);
    }

    #回复留言
    public function replyComment(Request $request){
        if (!$request->isMethod('post')) {
            return Controller::echoJson(400,'请求失败,请稍后再试');
        }
        $rs = Post::find((int)$request->get('post_id'));
        if(!$rs){
            return Controller::echoJson(400,'回复失败,请稍后再试');
        }
        if(mb_strlen($request->get('content'))>500 || !$request->get('content')){
            return Controller::echoJson(402,'回复失败,请稍后再试');
        }
        $comment_id = Comment::insertGetId(
            [
                'reply_id' => (int)$request->get('reply_id'),
                'post_id' => (int)$request->get('post_id'),
                'user_id' => session('user')['id'],
                'to_user_id' => (int)$request->get('to_user_id'),
                'content' => $request->get('content'),
            ]
        );
        if(!$comment_id){
            return Controller::echoJson(404,'回复失败,请稍后再试');
        }
        return Controller::echoJson(200,'成功');
    }

    #赞,取消攒投稿
    public function likes(Request $request){
        $post_id = (int)$request->get('post_id');
        if(!$post_id){
            return Controller::echoJson(400,'点赞失败,请稍后再试');
        }
        $post = Post::find($post_id);
        if(!$post){
            return Controller::echoJson(401,'点赞失败,请稍后再试');
        }
        $like = Like::where('user_id',session('user')['id'])->where('obj_id',$post_id)->where('type',1)->first();
        if(!$like){
            #新增
            Like::insert(
                [
                    'user_id'   =>  session('user')['id'],
                    'type'      =>  1,
                    'obj_id'    =>  $post_id,
                ]
            );
            Post::where('id',$post_id)->increment('like_num');
        }else{
            #更新
            if($like['status']==1){
                $like->status = 2;
                Post::where('id',$post_id)->decrement('like_num');
            }else{
                $like->status = 1;
                Post::where('id',$post_id)->increment('like_num');
            }
            $like->save();
        }
        $post = Post::find($post_id);
        return Controller::echoJson(200,'成功',$post->like_num);
    }

}
