<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\Top;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class PostController extends CommonController
{
    #帖子列表
    public function index(Request $request)
    {
        view()->share('page_title','帖子管理');
        $data = Post::leftjoin('users','posts.user_id', '=', 'users.id')
        ->select('posts.*','users.name_id','users.name_id','users.nick_name')
        ->where(function ($query) use ($request){
            #$query->select('users.*,posts.*');
            if($request->get('id')){
                $query->where('posts.id',$request->get('id'));
            }
            if($request->get('user_id')){
                $query->where('posts.user_id',$request->get('user_id'));
            }
            if($request->get('name_id')){
                $query->where('users.name_id',$request->get('name_id'));
            }
            if($request->get('nick_name')){
                $query->where('users.nick_name',$request->get('nick_name'));
            }
            if($request->get('title')){
                $query->where('posts.title','like','%'.$request->get('title').'%');
            }
            if($request->get('type')){
                $query->where('posts.type',$request->get('type'));
            }
            if($request->get('pay_type')){
                if($request->get('pay_type')==1){
                    $query->where('posts.payments',0.00);
                }else{
                    $query->where('posts.payments','>',0.00);
                }
            }
            if($request->get('status')){
                $query->where('posts.status',$request->get('status'));
            }
            if($request->get('start_time')){
                $query->where('posts.created_at','>=',$request->get('start_time'));
            }
            if($request->get('end_time')){
                $query->where('posts.created_at','<',$request->get('end_time'));
            }
        })->orderBy('posts.id', 'desc')->paginate(10);
        foreach($data as $key=>$value){
            #发帖类型,帖子状态
            $data[$key]['type_str'] = $this->postType($value['type']);
            $data[$key]['status_str'] = $this->postStatus($value['status']);
        }
        $condition = [
            'id'=>$request->get('id'),
            'user_id'=>$request->get('user_id'),
            'name_id'=>$request->get('name_id'),
            'nick_name'=>$request->get('nick_name'),
            'title'=>$request->get('title'),
            'type'=>$request->get('type'),
            'pay_type'=>$request->get('pay_type'),
            'status'=>$request->get('status'),
            'start_time'=>$request->get('start_time'),
            'end_time'=>$request->get('end_time'),
        ];
        return view('admin/post/index')->with(['data'=>$data,'condition'=>$condition]);
    }

    #查看
    public function edit(Request $request,$id)
    {
        #$disk = \Storage::disk('qiniu');
        #echo $disk->exists('14759839382149.jpg');die();
        $post = Post::find($id);
        #图片
        $post_image = PostImage::where('post_id',$id)->get();
        foreach($post_image as $key=>$value){
            $post_image[$key]['image'] =  Controller::showImage($value['image']);
        }
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

        #置顶
        $top = Top::where('post_id',$id)->where('status',1)->first();
        $top_status = false;
        if($top){
            $top_status = true;
        }

        $data = [
            'page_title'    =>  '帖子编辑',
            'checked_menu'  =>  ['level1'=>'','level2'=>''],
            'post'  =>  $post,
            'post_image'    =>  $post_image,
            'comments'  =>  $comments,
            'top_status'=>$top_status
        ];
        return view('admin/post/edit')->with('data',$data);
    }

    #更新,审核帖子
    public function update($id)
    {
        $rules = [
            'user_id'   =>  'required|numeric',
            'title'     =>  'required|between:1,20',
            'type'      =>  'required',
            'status'    =>  'required',
            'created_at'=>  'required',
        ];
        $data = Input::all();
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        unset($data['_token']);
        $result = Post::where('id',$id)->update($data);
        if(!$result){
            return back()->with('errors','更新帖子失败');
        }
        return back()->with('success','更新帖子成功');
    }

    #删除评论
    public function delComment(Request $request)
    {
        $id = (int)$request->get('id');
        if(!$id){
            return Controller::echoJson(400,'parameter error');
        }
        $rs_comment = Comment::where('id',$id)->update(['status'=>2]);
        $rs_reply = Comment::where('reply_id',$id)->update(['status'=>2]);
        if(!$rs_comment){
            return Controller::echoJson(401,'del error');
        }
        return Controller::echoJson(200,'成功');
    }

    #新增评论
    public function addComment(Request $request){
        if (!$request->isMethod('post')) {
            return Controller::echoJson(400,'请求失败,请稍后再试');
        }
        $rs = Post::find((int)$request->get('post_id'));
        if(!$rs){
            return Controller::echoJson(400,'回复失败,请稍后再试');
        }
        if(mb_strlen($request->get('content'))>500 || !$request->get('content')){
            return Controller::echoJson(402,'回复内容不能为空或超过500字符');
        }
        $comment_id = Comment::insertGetId(
            [
                'reply_id' => (int)$request->get('reply_id'),
                'post_id' => (int)$request->get('post_id'),
                'user_id' => session('admin_dacker')['id'],
                'to_user_id' => (int)$request->get('to_user_id'),
                'content' => $request->get('content'),
            ]
        );
        if(!$comment_id){
            return Controller::echoJson(404,'回复失败,请稍后再试');
        }
        return Controller::echoJson(200,'成功');
    }
    #置顶,取消置顶
    public function top(Request $request){
        $post_id = $request->get('id');

        #top列表中有,则更新成删除,没有则增加
        $top = Top::where('post_id',$post_id)->first();
        if($top){
            if($top['status'] ==1){
                Top::where('id',$top['id'])->update(['status'=>2]);
            }else{
                Top::where('id',$top['id'])->update(['status'=>1]);
            }
        }else{
            $post = Post::find($post_id);
            $post_image = $post->postImage;
            $user = User::find($post['user_id']);
            $detail = [
                'post_id'   =>  $post_id,
                'post_image'=>  $post_image[0]['image'],
                'post_title'=>  $post['title'],
                'user_id'   =>  $post['user_id'],
                'nick_name' =>  $user['nick_name'],
            ];

            Top::insertGetId($detail);
        }
        return Controller::echoJson(200,'成功');
    }

    public function create()
    {

    }

    public function show()
    {

    }

    public function delete()
    {

    }




}
