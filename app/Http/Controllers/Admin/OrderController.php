<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CommonController;
use App\Models\Address;
use App\Models\Applications;
use App\Models\Order;
use App\Models\OrderPost;
use App\Models\Post;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Mockery\Tests\React_WritableStreamInterface;
use DB;
class OrderController extends CommonController
{
    #订单列表
    public function lists(Request $request){

        $user = User::where('name_id',$request->get('name_id'))->orwhere('email',$request->get('email'))->first();
        $order_list = Order::where(function ($query) use ($request,$user){
            if($request->get('id')){
                $query->where('id',$request->get('id'));
            }
            if($request->get('oid')){
                $query->where('oid',$request->get('oid'));
            }
            if($user){
                $query->where('user_id',$user['id']);
            }
            if($request->get('start_time')){
                $query->where('created_at','>=',$request->get('start_time'));
            }
            if($request->get('end_time')){
                $query->where('created_at','<',$request->get('end_time'));
            }
        })->orderBy('updated_at', 'desc')->paginate(10);
        //dd($order_list);
        foreach($order_list as $key=>$value){
            #订单状态,投稿标题,订单类型
            $order_list[$key]['order_status_str'] = $this->orderStatus($value['order_status']);
            $order_post = OrderPost::where('order_id',$value['id'])->first();
            $order_list[$key]['post_title'] = $order_post['post_title'];
            $order_list[$key]['order_type_str'] = $this->orderType($value['order_type']);

        }

        $condition = [
            'name_id'=>$request->get('name_id'),
            'email'=>$request->get('email'),
            'id'=>$request->get('id'),
            'oid'=>$request->get('oid'),
            'start_time'=>$request->get('start_time'),
            'end_time'=>$request->get('end_time'),
        ];


        $data = [
            'page_title'    =>  '订单列表',
            'checked_menu'  =>  ['level1'=>'','level2'=>''],
            'order_list'    =>  $order_list,
            'condition'    =>  $condition
        ];
        return view('admin.order.list')->with('data',$data);
    }

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
            $address = UserAddress::find($request->get('address_id'));
            if($post['type'] == 1){
                $order_type = 1;
                #实物 地址必填
                if(!$address){
                    return back()->with('errors','请先添加一个正确的收货地址');
                }
            }else{
                #写真
                $order_type = 2;
                $address['name'] = '';
                $address['mobile'] = '';
                $address['province'] = '';
                $address['city'] = '';
                $address['area'] = '';
                $address['detail'] = '';
            }
            #投稿者
            $from_user = UserInfo::where('user_id',$post['user_id'])->first();
            #dd($from_user['point_scale']);
            #生成订单
            $order_arr = [
                'oid'        =>  Controller::orderId(),
                'user_id'   =>  session('user')['id'],
                'from_user_id'  =>  $post['user_id'],
                'price'     =>  $post['payments'],
                'discount_price'=>  0,
                'actual_price'  =>  $post['payments'],
                'point_scale'   =>  $from_user['point_scale'],
                'pay_price'     =>  $post['payments']*$from_user['point_scale'],
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
                'user_id'  =>  session('user')['id'],
                'order_id'  =>  $order_id,
                'post_id'   =>  $post_id,
                'post_title'=>  $post['title'],
                'post_type'=>  $post['type'],
            ];
            #订单扩展表
            $order_post_id = OrderPost::insertGetId($order_post_arr);
            if(!$order_post_id){
                return back()->with('errors','下单失败了,请稍后再试');
            }
            $rs = UserInfo::where('user_id',session('user')['id'])->where('point','>=',$post['payments'])->decrement('point',$order_arr['actual_price']);
            if(!$rs){
                return back()->with('errors','支付失败或者金额不足,请稍后再试');
            }
            #鸡鸡币缓存
            #$user = User::find($post['user_id']);
            #CommonController::perfectUser($user,false);
            $rs = Order::where('id',$order_id)->update(['order_status'=>4]);
            if(!$rs){
                return back()->with('errors','支付失败,请联系客服人员');
            }
            #虚拟物品,不减少库存
            if($post['type'] == 1){
                $rs = Post::where('id',$post_id)->decrement('stock_num');
                if(!$rs){
                    return back()->with('errors','库存减少失败');
                }

            }
            return redirect('user/post/detail/'.$request->get('post_id'))->with('success','购买成功');


        }
    }

    #订单详情
    public function detail(Request $request,$order_post_id){
        $order_post = OrderPost::find($order_post_id);
        if(!$order_post){
            return view('errors.404');
        }
        #订单
        $order = Order::where('user_id',session('user')['id'])->where('id',$order_post['order_id'])->first();

        $province = Address::find($order['province']);
        $city = Address::find($order['city']);
        $area = Address::find($order['area']);
        $order['address'] =$province['name'].$city['name'].$area['name'].$order['detail'];
        #投稿
        $data = [
            'page_title'    =>  '订单详情',
            'checked_menu'  =>  ['level1'=>'财务收支','level2'=>''],
            'order'  =>  $order,
            'order_post' =>  $order_post
        ];
        return view('order.detail')->with('data',$data);
    }

    #消费记录
    public function out(){
        #总支出
        $total_pay = Order::where('user_id',session('user')['id'])->where('order_status','>',1)->sum('actual_price');
        #付款完成的记录
        $order_list = Order::where('user_id',session('user')['id'])->where('order_status','>',1)->orderby('id','desc')->paginate(10);
        foreach($order_list as $key=>$value){
            $post_list = OrderPost::where('order_id',$value['id'])->get();
            foreach($post_list as $k=>$v){
                $post_list[$k]['post_type']= Controller::postType($v['post_type']);
            }
            $order_list[$key]['post_list'] =$post_list;
        }
        $data = [
            'page_title'    =>  '支出记录',
            'checked_menu'  =>  ['level1'=>'财务收支','level2'=>'支出记录'],
            'order_list'  =>  $order_list,
            'total_pay' =>  $total_pay
        ];
        return view('order.out')->with('data',$data);
    }

    #收益记录
    public function in(){
        #总收益
        $total_pay = Order::where('from_user_id',session('user')['id'])->where('order_status','>',1)->sum('pay_price');
        #收益的列表
        $order_list = Order::where('from_user_id',session('user')['id'])->where('order_status','>',1)->orderby('id','desc')->paginate(10);
        foreach($order_list as $key=>$value){
            $nick_name = User::find($value['user_id']);
            $order_list[$key]['nick_name'] = $nick_name['nick_name'];
            $post_list = OrderPost::where('order_id',$value['id'])->get();
            foreach($post_list as $k=>$v){
                $post_list[$k]['post_type']= Controller::postType($v['post_type']);
            }
            $order_list[$key]['post_list'] =$post_list;
        }
        $data = [
            'page_title'    =>  '收入记录',
            'checked_menu'  =>  ['level1'=>'财务收支','level2'=>'收入记录'],
            'order_list'  =>  $order_list,
            'total_pay' =>  $total_pay
        ];
        return view('order.in')->with('data',$data);
    }

    #提现记录
    public function cash(Request $request){
        if($request->isMethod('post')){
            #dd($request->all());
            #检测
            $rules = [
                'ali_account' => 'required|between:1,55',
                'ali_name' => 'required|between:1,55',
                'cash' => 'required|numeric|between:100,100000',
            ];
            $messages = [
                'ali_account.required' => '请填写支付宝账号',
                'ali_account.between' => '支付宝账号长度不能超过55字符',
                'ali_name.required' => '请填写支付宝昵称',
                'ali_name.between' => '支付宝昵称长度不能超过55字符',
                'cash.required' =>  '请填写提现金额',
                'cash.numeric' => '请填写正确的数字提现金额',
                'cash.between' => '提现金额为100-10w',
            ];
            $validator = Validator::make($request->all(),$rules,$messages);
            if($validator->fails()){
                return back()->withErrors($validator);
            }
            #金额验证
            $cash = (int)$request->get('cash');
            if($cash%100 != 0){
                return back()->with('errors','提现金额必须为100的整数倍哦');
            }
            $user_info = UserInfo::where('user_id',session('user')['id'])->first();
            if($cash>$user_info['point']){
                return back()->with('errors','提现金额不足');
            }
            #更新支付宝账号信息
            $user_info->ali_account = $request->get('ali_account');
            $user_info->ali_name = $request->get('ali_name');
            $user_info->save();
            #提现记录
            $rs = Applications::insertGetId(
                [
                    'user_id'   =>  session('user')['id'],
                    'number'    =>  $cash,
                    'type'      =>  1,#1提现
                ]
            );
            if(!$rs){
                return back()->with('errors','申请提现失败,请联系客服');
            }
            #冻结申请金额
            UserInfo::where('user_id',session('user')['id'])->decrement('point', $cash);
            return back()->with('success','申请提现成功,请耐心等待处理');
        }

        $user_info = UserInfo::where('user_id',session('user')['id'])->first();
        #提现记录
        $applications_list = Applications::where('user_id',session('user')['id'])->where('type',1)->paginate(10);
        foreach($applications_list as $key => $value){
            $applications_list[$key]['status_str'] = Controller::applicationStatus($value['status']);
        }
        $data = [
            'page_title'    =>  '提现记录',
            'checked_menu'  =>  ['level1'=>'财务收支','level2'=>'提现记录'],
            'applications_list'  =>  $applications_list,
            'user_info' =>  $user_info
        ];
        return view('order.cash')->with('data',$data);
    }


}
