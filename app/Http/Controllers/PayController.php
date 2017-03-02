<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PayController extends CommonController
{

    public function sponsor(){
        $data = [
            'page_title'    =>  '欢迎赞助',
            'checked_menu'  =>  ['level1'=>'欢迎赞助','level2'=>''],
            'list'  =>  1,
        ];
        return view('help.pay')->with('data',$data);
    }


}
