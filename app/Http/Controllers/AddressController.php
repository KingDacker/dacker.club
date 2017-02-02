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

    #新增,更新用户地址
    public function addressCreate(Request $request){
        $address_id = $request->get('address_id');
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
        if($address_id){
            #更新
            $rs = UserAddress::where('user_id',session('user')['id'])->where('id',$address_id)->update($data);
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

    #收货地址列表
    public function addressList(){
        $address_list = UserAddress::where('user_id',session('user')['id'])->where('status',1)->get();
        foreach($address_list as $key=>$value){
            $province = Address::find($value['province']);
            $city = Address::find($value['city']);
            $area = Address::find($value['area']);
            $address_list[$key]['detail'] = $province['name'].$city['name'].$area['name'].$value['detail'];
        }
        $data = [
            'page_title'    =>  '收货地址列表',
            'checked_menu'  =>  ['level1'=>'用户信息','level2'=>'收货地址'],
            'address_list'  =>  $address_list,
        ];
        return view('address.list')->with('data',$data);
    }

    #编辑地址 页面
    public function addressEdit(Request $request,$id=null){
        $address = '';
        $option_list = '';
        $is_init = true;
        #更新
        if($id){
            $address = UserAddress::where('user_id',session('user')['id'])->where('id',$id)->where('status',1)->first();
            if(!$address){
                return view('errors.404');
            }
            $is_init = false;
            #省市区
            $option_list['province_list'] = Address::where('pid',0)->get();
            $option_list['city_list'] = Address::where('pid',$address['province'])->get();
            $option_list['area_list'] = Address::where('pid',$address['city'])->get();
        }
        #新增
        $data = [
            'page_title'    =>  '收货地址列表',
            'checked_menu'  =>  ['level1'=>'用户信息','level2'=>'收货地址'],
            'address'   =>  $address,
            'option_list'   =>  $option_list,
            'is_init'   =>  $is_init
        ];
        return view('address.edit')->with('data',$data);
    }

    #删除地址
    public function addressDel(Request $request){
        $address_id = (int)$request->get('address_id');
        $rs = UserAddress::where('user_id',session('user')['id'])->where('id',$address_id)->update(['status' => 2]);
        if(!$rs){
            return CommonController::echoJson(401,'删除失败,请稍后再试');
        }
        return CommonController::echoJson(200,'成功');

    }
}
