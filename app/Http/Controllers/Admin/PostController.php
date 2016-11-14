<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostImage;
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
        $data = Post::paginate(10);
        foreach($data as $key=>$value){
            #发帖类型,收费类型,帖子状态
            $data[$key]['type_str'] = $this->postType($value['type']);
            $data[$key]['pay_type_str'] = $this->postPayType($value['pay_type']);
            $data[$key]['status_str'] = $this->postStatus($value['status']);
            $user = User::find($value['user_id']);
            $data[$key]['name_id'] = $user['name_id'];
            $data[$key]['nick_name'] = $user['nick_name'];
        }
        $condition = [
            'name_id'=>$request->get('name_id'),
            'email'=>$request->get('email'),
            'nick_name'=>$request->get('nick_name'),
            'user_type'=>$request->get('user_type'),
            'status'=>$request->get('status'),
            'pay_status'=>$request->get('pay_status'),
        ];
        return view('admin/post/index')->with(['data'=>$data,'condition'=>$condition]);
    }

    #查看
    public function edit(Request $request,$id)
    {
        view()->share('page_title','帖子编辑');
        $post = Post::find($id);
        #图片
        $images = PostImage::where('post_id',$id)->get();
        #评论(每楼详细)
        $comments = Comment::where('post_id',$id)->where('reply_id',0)->where('status',1)->orderBy('created_at', 'asc')->paginate(3);
        #评论(每楼的回复详细)
        foreach($comments as $key=>$value){
            $user = User::find($value['user_id']);
            $comments[$key]['nick_name'] = $user['nick_name'];
            $reply_comment = Comment::where('post_id',$id)->where('reply_id',$value['id'])->where('status',1)->orderBy('created_at', 'asc')->get();
            foreach($reply_comment as $k=>$v){
                $user = User::find($v['user_id']);
                $reply_comment[$k]['nick_name'] = $user['nick_name'];
                $user = User::find($v['to_user_id']);
                $reply_comment[$k]['to_nick_name'] = $user['nick_name'];
            }
            $comments[$key]['reply'] = $reply_comment;
        }
        return view('admin/post/edit')->with(['data'=>$post,'images'=>$images,'comments'=>$comments]);

    }

    #更新,审核帖子
    public function update($id)
    {
        $rules = [
            'user_id'   =>  'required|numeric',
            'title'     =>  'required|between:1,20',
            'type'      =>  'required',
            'pay_type'  =>  'required',
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
            return CommonController::echoJson(400,'parameter error');
        }
        $rs_comment = Comment::where('id',$id)->update(['status'=>2]);
        $rs_reply = Comment::where('reply_id',$id)->update(['status'=>2]);
        if(!$rs_comment){
            return CommonController::echoJson(401,'del error');
        }
        return CommonController::echoJson(200,'成功');
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
