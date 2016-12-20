<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CommonController;
use App\Http\Requests;
use Illuminate\Http\Request;


class PostController extends Controller
{
    #创建投稿
    public function create(Request $request){

        if ($request->isMethod('post')) {
            dd($request->all());
            $image_arr = $request->get('image_arr');
            foreach($image_arr as $key=>$value){
                echo $value;
            }

        }else{
            return view('user.test')->with('page_title','ceshi');
        }
    }

    #投稿列表
    public function lists(){

    }



}
