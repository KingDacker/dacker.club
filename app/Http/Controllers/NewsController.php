<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends CommonController
{
    public function systemList(){
        #type 1系统消息 2私密消息
        $type = 1;
        $list = News::where('status',1)->where('type',$type)->simplePaginate(15);
        $data = [
            'page_title'    =>  '网站公告',
            'checked_menu'  =>  ['level1'=>'网站公告','level2'=>''],
            'list'  =>  $list,
        ];
        return view('news.sys_list')->with('data',$data);
    }

    public function chatList(){
        #type 1系统消息 2私密消息
        $type = 2;
        #分组发件人
        $list = News::where('status',1)->where('type',$type)->where('to_user_id',session('user')['id'])->groupby('user_id')->orderby('check','desc')->get();
        #检查发件人的信息 是否有未读
        foreach($list as $key=>$value){
            $check = News::where('user_id',$value['user_id'])->where('to_user_id',session('user')['id'])->where('status',1)->where('check',0)->first();
            $list[$key]['new_msg'] = false;
            if($check){
                $list[$key]['new_msg'] = true;
            }
            #发件人的头像,昵称
            $send_user = User::find($value['user_id']);
            $list[$key]['send_user'] = CommonController::perfectUser($send_user,true);
        }

        $data = [
            'page_title'    =>  '私密消息',
            'checked_menu'  =>  ['level1'=>'消息中心','level2'=>'私密消息'],
            'list'  =>  $list,
        ];
        return view('news.chat_list')->with('data',$data);
    }

    public function chatDetail($id){
        #$list = News::whereIn('user_id',[$id,session('user')['id']])->whereIn('to_user_id',[$id,session('user')['id']])->where('type',2)->where('status',1)->orderby('id','desc')->paginate(15);
        $list = News::where('user_id',$id)->where('to_user_id',session('user')['id'])->orwhere('user_id',session('user')['id'])->where('to_user_id',$id)
            ->where('type',2)->where('status',1)->orderby('id','desc')
            ->paginate(15);
        #检查发件人的信息 是否有未读
        foreach($list as $key=>$value){
            #发件人的头像,昵称
            $user = User::find($value['user_id']);
            $list[$key]['avatar_str'] = Controller::showAvatar($user['avatar']);
            #position 1左边 别人 2右边 自己
            $list[$key]['position'] = 2;
            if($value['user_id'] == $id){
                $list[$key]['position'] = 1;
            }
        }
        $list = array_reverse($list->items());
        $data = [
            'page_title'    =>  '私密消息详情',
            'checked_menu'  =>  ['level1'=>'消息中心','level2'=>'私密消息'],
            'list'  =>  $list,
            'user_id'   =>  $id
        ];
        News::where('user_id',$id)->where('to_user_id',session('user')['id'])->where('type',2)->where('status',1)->update(
            ['check' => 1]
        );

        return view('news.chat_detail')->with('data',$data);
    }

    #回复私密消息
    public function chatReply(Request $request){
        #检测回复对象
        $content = $request->get('content');
        if(!$content){
            return back()->with('errors','回复内容不能为空');
        }
        $to_user_id = (int)$request->get('to_user_id');
        $user = User::find($to_user_id);
        if(!$user){
            return view('errors.404');
        }
        #回复
        $news_id = News::insertGetId([
            'user_id'   =>  session('user')['id'],
            'to_user_id'=>  $to_user_id,
            'content'   =>  $content,
            'type'      =>  2,#私密消息
        ]);
        if(!$news_id){
            return back()->with('errors','回复失败,请稍后再试');
        }
        return redirect('user/news/chat/detail/'.$to_user_id)->with('success','回复成功');

    }

}
