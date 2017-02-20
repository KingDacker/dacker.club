<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HelpController extends CommonController
{
    public function lists(){
        $data = [
            'page_title'    =>  '常见问题',
            'checked_menu'  =>  ['level1'=>'常见问题','level2'=>''],
            'list'  =>  1,
        ];
        return view('help.list')->with('data',$data);
    }

    public function pay(){
        $data = [
            'page_title'    =>  '欢迎赞助',
            'checked_menu'  =>  ['level1'=>'欢迎赞助','level2'=>''],
            'list'  =>  1,
        ];
        return view('help.pay')->with('data',$data);
    }
}
