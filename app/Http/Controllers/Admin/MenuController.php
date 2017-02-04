<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Requests;


class MenuController extends CommonController
{
    #帖子列表
    public function index(){
        view()->share('page_title','菜单管理');
        $data = ['data'=>''];
        return view('admin/menu/index');
    }




}
