<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use zgldh\QiniuStorage\QiniuStorage;

class HomeController extends CommonController
{

    public function index()
    {
        $data = ['page_title'=>'首页','checked_menu'=>['level1'=>'私属物品','level2'=>'']];
        return view('home.index')->with('data',$data);
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
