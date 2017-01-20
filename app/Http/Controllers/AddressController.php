<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\UserAddress;
use Illuminate\Http\Request;

use App\Http\Requests;

class AddressController extends CommonController
{
    #获取省市区
    public function addressOption(Request $request){
        $pid = $request->get('pid');
        if($pid){
            $option = Address::where('pid',$pid)->get();
            return CommonController::echoJson(200,'成功',$option);
        }else{
            $option = Address::where('level',1)->get();
            return CommonController::echoJson(200,'成功',$option);
        }
    }

    #新增用户地址
    public function addressCreate(Request $request){
        $data['user_id'] = session('user')['id'];
        $data['name'] = $request->get('name');
        $data['mobile'] = $request->get('mobile');
        $data['postcode'] = $request->get('postcode');
        $data['province'] = $request->get('province');
        $data['city'] = $request->get('city');
        $data['area'] = $request->get('area');
        $data['detail'] = $request->get('detail');
        if(!$data['name']||!$data['mobile']||!$data['postcode']||!$data['province']||!$data['city']||! $data['area']||!$data['detail']){
            return CommonController::echoJson(400,'服务器忙,请稍后再试');
        }
        if(UserAddress::insertGetId($data)){
           return CommonController::echoJson(200,'成功');
        }
        return CommonController::echoJson(401,'服务器忙,请稍后再试');

    }
}
