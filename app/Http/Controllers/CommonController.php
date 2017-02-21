<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\News;
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
        $post_type = Controller::postType();

        $top_menu = [
            '1' => ['image_color'=>'icon-diamond icon text-danger','url'=>'/list/1','title'=>'用户中心','name'=>$post_type[1],'menu'=>['level1'=>$post_type[1]]],
            '2' => ['image_color'=>'fa-camera fa text-primary',  'url'=>'/list/2','title'=>'用户中心','name'=>$post_type[2], 'menu'=>['level1'=>$post_type[2]]],
            '3' => ['image_color'=>'fa-camera fa text-info',     'url'=>'/list/3','title'=>'用户中心','name'=>$post_type[3],'menu'=>['level1'=>$post_type[3]]],
            '4' => ['image_color'=>'fa-camera fa text-warning',  'url'=>'/list/4','title'=>'用户中心','name'=>$post_type[4],'menu'=>['level1'=>$post_type[4]]],
            '5' => ['image_color'=>'fa-camera fa text-success',  'url'=>'/list/5','title'=>'用户中心','name'=>$post_type[5],'menu'=>['level1'=>$post_type[5]]],
        ];

        $user_menu = [
            '1' => ['image_color'=>'icon-user icon','url'=>'/','name'=>'用户信息','menu'=>['level1'=>'用户信息'],
                'list'=>[
                    ['image_color'=>'',  'url'=>'/user/info','name'=>'个人资料','menu'=>['level2'=>'个人资料']],
                    ['image_color'=>'',  'url'=>'/user/address/list','name'=>'收货地址','menu'=>['level2'=>'收货地址']],
                    ['image_color'=>'',  'url'=>'/user/password','name'=>'修改密码','menu'=>['level2'=>'修改密码']]
                ]
            ],
            '2' => ['image_color'=>'fa-folder-open-o fa','url'=>'/','name'=>'投稿列表','menu'=>['level1'=>'投稿列表'],
                'list'=>[
                    ['image_color'=>'',  'url'=>'/user/post/create','name'=>'开始投稿','menu'=>['level2'=>'开始投稿']],
                    ['image_color'=>'',  'url'=>'/user/post/list','name'=>'投稿记录','menu'=>['level2'=>'投稿记录']],
                ]
            ],
            '3' => ['image_color'=>'fa-money fa','url'=>'','name'=>'财务收支','menu'=>['level1'=>'财务收支'],
                'list'=>[
                    ['image_color'=>'',  'url'=>'/user/order/out','name'=>'支出记录','menu'=>['level2'=>'支出记录']],
                    ['image_color'=>'',  'url'=>'/user/order/in','name'=>'收入记录','menu'=>['level2'=>'收入记录']],
                    ['image_color'=>'',  'url'=>'/user/order/cash','name'=>'提现记录','menu'=>['level2'=>'提现记录']],
                ]
            ],
            '4' => ['image_color'=>'icon-envelope icon', 'url'=>'','name'=>'消息中心','menu'=>['level1'=>'消息中心'],
                'list'=>[
                    ['image_color'=>'',  'url'=>'/user/news/system/list','name'=>'系统消息','menu'=>['level2'=>'系统消息']],
                    ['image_color'=>'',  'url'=>'/user/news/chat/list','name'=>'私密消息','menu'=>['level2'=>'私密消息']],
                ]
            ],
            '5' => ['image_color'=>'icon-question icon','url'=>'/user/help','name'=>'常见问题','menu'=>['level1'=>'常见问题'],'list'=>[]],
            '6' => ['image_color'=>'fa-bug fa','url'=>'/user/pay','name'=>'欢迎赞助','menu'=>['level1'=>'欢迎赞助'],'list'=>[]],

        ];
        $menu_list = [
            'top_menu'  => $top_menu,
            'user_menu' => $user_menu,
        ];
        view()->share('menu_list',$menu_list);

        $point = 0;
        $unread_num =0;
        if(session('user')){
            #鸡鸡币数量
            $user_info = UserInfo::where('user_id',session('user')['id'])->first();
            $point = $user_info['point'];
            #未读消息数量
            $unread_num = News::where('to_user_id',session('user')['id'])->where('status',1)->where('type',2)->where('check',0)->count();
        }
        view()->share(
            [
                'point' => $point,
                'unread_num' => $unread_num
            ]
        );

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
