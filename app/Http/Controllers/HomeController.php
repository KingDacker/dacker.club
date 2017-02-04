<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonController;
use App\Http\Requests;
use App\Models\Post;
use App\Models\Top;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use zgldh\QiniuStorage\QiniuStorage;

class HomeController extends CommonController
{
    #首页推荐
    public function index()
    {

        $list = Top::where('status',1)->get();
        foreach($list as $key=>$value){
            $list[$key]['post_image'] = Controller::showImage($value['post_image']);
        }
        $data = [
            'page_title'    =>  'dacker俱乐部',
            'checked_menu'  =>  ['level1'=>'','level2'=>''],
            'list'  =>  $list,
        ];
        return view('home.index')->with('data',$data);

    }

    #写真列表
    public function lists($type){
        $list = post::where('status',2)->where('type',$type)->paginate(12);
        foreach($list as $key=>$value){
            $user = User::find($value['user_id']);
            $post_image = $value->postImage;
            $list[$key]['post_image'] = Controller::showImage($post_image[0]['image']);
            $list[$key]['nick_name'] = $user['nick_name'];
        }
        $level1 = is_array(Controller::postType($type)) ? '' : Controller::postType($type);

        $data = [
            'page_title'    =>  'dacker俱乐部',
            'checked_menu'  =>  ['level1'=>$level1,'level2'=>''],
            'list'  =>  $list,
        ];
        return view('home.list')->with('data',$data);
    }
    #添加首页top
    public function topAdd(Request $request){
        $post_id = $request->get('post_id');
        $post = Post::find($post_id);
        $post_image = $post->postImage;
        $user = User::find($post['user_id']);
        $detail = [
            'post_id'   =>  $post_id,
            'post_image'=>  $post_image[0],
            'post_title'=>  $post['title'],
            'user_id'   =>  $post['user_id'],
            'nick_name' =>  $user['nick_name'],
        ];
        Top::insertGetId($detail);
    }


    public function upTest(Request $request){
        if ($request->isMethod('post')) {
            $file = $request->file();
            dd($file);
            // 文件是否上传成功
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                var_dump($bool);

            }

        }
        dd(1111);
        $disk = QiniuStorage::disk('qiniu');
        dd($disk->get('14759839382149.jpg'));
    }

}
