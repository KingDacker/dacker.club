<?php

namespace App\Http\Controllers\Admin;

use App\Models\Address;
use App\Models\UserAddress;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    #编辑地址 页面
    public function edit(Request $request,$address_id,$user_id){
        $option_list = array();
        $address = UserAddress::where('user_id',$user_id)->where('id',$address_id)->where('status',1)->first();
        if(!$address){
            return view('errors.404');
        }
        #省市区
        $option_list['province_list'] = Address::where('pid',0)->get();
        $option_list['city_list'] = Address::where('pid',$address['province'])->get();
        $option_list['area_list'] = Address::where('pid',$address['city'])->get();
        $data = [
            'page_title'    =>  '收货地址列表',
            'checked_menu'  =>  ['level1'=>'用户信息','level2'=>'收货地址'],
            'address'   =>  $address,
            'option_list'   =>  $option_list,
            'user_id'   => $user_id
        ];
        return view('admin.address.edit')->with('data',$data);
    }

    #新增,更新用户地址
    public function create(Request $request){
        $address_id = $request->get('address_id');
        $method = $request->get('method');
        $data['user_id'] = session('user')['id'];
        $data['name'] = $request->get('name');
        $data['mobile'] = $request->get('mobile');
        $data['postcode'] = $request->get('postcode');
        $data['province'] = $request->get('province');
        $data['city'] = $request->get('city');
        $data['area'] = $request->get('area');
        $data['detail'] = $request->get('detail');
        $data['user_id'] = $request->get('user_id');
        if(!$data['name']||!$data['mobile']||!$data['postcode']||!$data['province']||!$data['city']||! $data['area']||!$data['detail']){
            return CommonController::echoJson(400,'服务器忙,请稍后再试');
        }
        if($method=='update'){
            #更新
            $rs = UserAddress::where('user_id',$data['user_id'])->where('id',$address_id)->update($data);
            if(!$rs){
                return CommonController::echoJson(401,'更新失败,请稍后再试');
            }
        }else{
            #新增
            $rs = UserAddress::insertGetId($data);
            if(!$rs){
                return CommonController::echoJson(402,'新增失败,请稍后再试');
            }
        }
        return CommonController::echoJson(200,'成功');

    }

    #删除地址
    public function del(Request $request){
        $address_id = (int)$request->get('address_id');
        $user_id = (int)$request->get('user_id');
        $rs = UserAddress::where('user_id',$user_id)->where('id',$address_id)->update(['status' => 2]);
        if(!$rs){
            return CommonController::echoJson(401,'删除失败,请稍后再试');
        }
        return CommonController::echoJson(200,'成功');

    }

}
