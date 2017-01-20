<?php

namespace App\Http\Controllers;


use App\Http\Controllers\CommonController;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderPost;
use App\Models\Post;
use App\Models\UserAddress;
use App\Models\UserInfo;
use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends CommonController
{
    #创建实物订单
    public function create(Request $request,$id=null){
        #收货地址
        $address_list = UserAddress::where('user_id',session('user')['id'])->get();
        if($address_list){
            foreach($address_list as $key=>$value){
                $province = Address::find($value['province']);
                $city = Address::find($value['city']);
                $area = Address::find($value['area']);
                $address_list[$key]['detail'] = $province['name'].$city['name'].$area['name'].$value['detail'];
            }
        }
        #投稿信息
        $post = Post::where('id',$id)->where('stock_num','>',0)->where('type',1)->where('status',2)->first();
        if(!$post){
            return back()->with('errors','您购买的投稿不存在');
        }
        #实物订单类型
        $post['order_type'] = 1;
        $data = [
            'page_title'    =>  '创建订单',
            'checked_menu'  =>  ['level1'=>'','level2'=>''],
            'address_list'  =>  $address_list,
            'post'  =>  $post,
        ];
        return view('order.create')->with('data',$data);
    }

    #支付
    public function pay(Request $request){
        if($request->isMethod('post')){
            #商品验证
            $post_id = (int)$request->get('post_id');
            $post = Post::where('id',$post_id)->where('stock_num','>',0)->where('status',2)->first();
            if(!$post){
                return back()->with('errors','该投稿目前不可购买');
            }
            #金额验证
            $user_info = UserInfo::where('user_id',session('user')['id'])->first();
            if($user_info['point']<$post['payments']){
                return back()->with('errors','余额不足,请去充值');
            }
            #order_type 1实物 2写真 3打赏 4购买联系方式.........等
            #post['type'] 1私属物品 2玩家 3御姐 4女王 5萝莉
            $address_arr['receiver_mobile'] = '';
            $address_arr['receiver_name'] = '';
            $address_arr['province'] = '';
            $address_arr['city'] = '';
            $address_arr['area'] = '';
            $address_arr['detail'] = '';

            $order_type = (int)$request->get('order_type');
            $address = UserAddress::find($request->get('address_id'));
            #dd($order_type.'--'.$post['type'] );
            if($order_type == 1 && $post['type'] == 1){
                #实物 地址必填
                if(!$address){
                    return back()->with('errors','请先添加一个正确的收货地址');
                }
            }elseif($order_type == 2 ){
                #写真
                $order_type = 2;#订单类型 1实物 2写真 3打赏
            }elseif($order_type == 3){
                #打赏
                #TODO
                return back()->with('errors','此功能还未开放');
            }elseif($order_type == 4){
                #购买联系方式
                #TODO
                return back()->with('errors','此功能还未开放');
            }else{
                return back()->with('errors','服务器繁忙,请稍后再试');
            }
            #生成订单
            $order_arr = [
                'oid'        =>  Controller::orderId(),
                'user_id'   =>  session('user')['id'],
                'from_user_id'  =>  $post['user_id'],
                'price'     =>  $post['payments'],
                'discount_price'=>  0,
                'actual_price'  =>  $post['payments'],
                'order_type'=>  $order_type,#订单类型 1实物 2写真 3打赏
                'receiver_name' =>  $address['name'],
                'receiver_mobile'   =>  $address['mobile'],
                'province'   =>   $address['province'],
                'city'   =>  $address['city'],
                'area'   =>  $address['area'],
                'detail'    =>  $address['detail'],
                'remark'    => $request->get('remark'),
                'order_status'  =>  1 #1待付款 2待发货 3已发货 4完成
                ];
            $order_id = Order::insertGetId($order_arr);
            if(!$order_id){
                return back()->with('errors','下单失败,请稍后再试');
            }
            $order_post_arr = [
                'order_id'  =>  $order_id,
                'post_id'   =>  $post_id,
            ];
            $order_post_id = OrderPost::insertGetId($order_post_arr);
            if(!$order_post_id){
                return back()->with('errors','下单失败了,请稍后再试');
            }
            $rs = UserInfo::where('user_id',session('user')['id'])->where('point','>=',$post['payments'])->decrement('point',$order_arr['actual_price']);
            if(!$rs){
                return back()->with('errors','支付失败或者金额不足,请稍后再试');
            }
            $rs = Order::where('id',$order_id)->update(['order_status'=>4]);
            if(!$rs){
                return back()->with('errors','支付失败,请联系客服人员');
            }
            $rs = Post::where('id',$post_id)->decrement('stock_num');
            if(!$rs){
                return back()->with('errors','库存减少失败');
            }
            return redirect('user/post/detail/'.$request->get('post_id'))->with('success','购买成功');


        }
    }

}
