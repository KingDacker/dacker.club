<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CommonController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use zgldh\QiniuStorage\QiniuStorage;

class UserController extends Controller
{
    #个人资料
    public function info(){

    }
    #修改详细信息
    public function updateInfo(){
        return view('user.test')->with('page_title','ceshi');
    }

    #修改密码
    public function changePassword(){

    }







}
