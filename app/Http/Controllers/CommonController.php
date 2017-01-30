<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Requests;

class CommonController extends Controller
{
    public function __construct()
    {
        $this->menuList();
    }


    #前端 导航
    public  function menuList(){

        $top_menu = [
            '1' => ['image_color'=>'fa-camera fa text-primary',  'url'=>'/','title'=>'用户中心','name'=>'网友玩家', 'menu'=>['level1'=>'网友玩家']],
            '2' => ['image_color'=>'fa-camera fa text-info',     'url'=>'/','title'=>'用户中心','name'=>'性感御姐','menu'=>['level1'=>'性感御姐']],
            '3' => ['image_color'=>'fa-camera fa text-warning',  'url'=>'/','title'=>'用户中心','name'=>'高贵女王','menu'=>['level1'=>'高贵女王']],
            '4' => ['image_color'=>'fa-camera fa text-success',  'url'=>'/','title'=>'用户中心','name'=>'萌萌萝莉','menu'=>['level1'=>'萌萌萝莉']],
            '5' => ['image_color'=>'icon-diamond icon text-danger','url'=>'/','title'=>'用户中心','name'=>'私属物品','menu'=>['level1'=>'私属物品']],
        ];

        $user_menu = [
            '1' => ['image_color'=>'icon-user icon',  'url'=>'/','title'=>'用户中心','name'=>'用户信息','menu'=>['level1'=>'用户信息'],
                'list'=>[
                    ['image_color'=>'',  'url'=>'/user/info','name'=>'个人资料','menu'=>['level2'=>'个人资料']],
                    ['image_color'=>'',  'url'=>'/user/address/list','name'=>'收货地址','menu'=>['level2'=>'收货地址']],
                    ['image_color'=>'',  'url'=>'/user/password','name'=>'修改密码','menu'=>['level2'=>'修改密码']]
                ]

            ],
            '2' => ['image_color'=>'fa-folder-open-o fa',  'url'=>'/','title'=>'用户中心','name'=>'投稿列表','menu'=>['level1'=>'投稿列表'],
                'list'=>[
                    ['image_color'=>'',  'url'=>'/user/post/create','name'=>'开始投稿','menu'=>['level2'=>'开始投稿']],
                    ['image_color'=>'',  'url'=>'/user/post/list','name'=>'投稿记录','menu'=>['level2'=>'投稿记录']],
                ]
            ],
            '3' => ['image_color'=>'fa-money fa',  'url'=>'','title'=>'用户中心','name'=>'财务收支','menu'=>['level1'=>'财务收支'],
                'list'=>[
                    ['image_color'=>'',  'url'=>'/user/order/out','name'=>'支出记录','menu'=>['level2'=>'支出记录']],
                    ['image_color'=>'',  'url'=>'/user/order/in','name'=>'收入记录','menu'=>['level2'=>'收入记录']],
                    ['image_color'=>'',  'url'=>'/user/order/cash','name'=>'提现记录','menu'=>['level2'=>'提现记录']],

                ]
            ],
            '4' => ['image_color'=>'icon-envelope icon', 'url'=>'/message','name'=>'消息中心','menu'=>['level1'=>'消息中心'],
                'list'=>[
                    ['image_color'=>'',  'url'=>'/user/order/out','name'=>'系统消息','menu'=>['level2'=>'系统消息']],
                    ['image_color'=>'',  'url'=>'/user/order/in','name'=>'私密消息','menu'=>['level2'=>'私密消息']],
                ]
            ],
            '5' => ['image_color'=>'icon-question icon','url'=>'/help','name'=>'常见问题','menu'=>['level1'=>'常见问题'],'list'=>[]],
        ];
        $menu_list = [
            'top_menu'  => $top_menu,
            'user_menu' => $user_menu,
        ];
        view()->share('menu_list',$menu_list);
        #鸡鸡币数量
        $user_info = UserInfo::where('user_id',session('user')['id'])->first();
        view()->share('point',$user_info['point']);
    }

    #用户登录后,整合用户信息
    public function perfectUser($user,$other=false){
        $user_info = $user->userinfo;
        #头像,会员类型,注册天数,投稿数量
        $user['avatar_str'] = Controller::showAvatar($user['avatar']);
        $user['user_type_str'] = Controller::userType($user['user_type']);
        $user['register_at'] = date('Y-m-d',strtotime($user['created_at']) );
        #用户身份,性别
        $user_info['identity_str'] = Controller::userIdentity($user_info['identity']);
        $user_info['gender_str'] = '';
        if($user_info['gender']){
            $user_info['gender_str'] = Controller::gender($user_info['gender']);
        }
        $user['user_info'] = $user_info;
        if($other){
            return $user;
        }
        session(['user'=>$user]);
    }
}
