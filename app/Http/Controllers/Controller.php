<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\File;
use zgldh\QiniuStorage\QiniuStorage;


class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    #name_id 随机算法
    #生成验证码
    #length 随机字符长度
    #mode 随机字符类型
    #0为大小写英文和数字,1为数字,2为小写字母,3为大写字母,4为大小写字母,5为大写字母和数字,6为小写字母和数字
    public static function getNameId($length=9,$mode=1){

        switch ($mode)
        {
            case '1':
                $str='123456789';
                break;
            case '2':
                $str='abcdefghijklmnopqrstuvwxyz';
                break;
            case '3':
                $str='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case '4':
                $str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                break;
            case '5':
                $str='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                break;
            case '6':
                $str='abcdefghijklmnopqrstuvwxyz1234567890';
                break;
            default:
                $str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
                break;
        }
        $number = '0123456789';
        $code='';
        $len=strlen($str)-1;
        for ($i=0;$i<$length;$i++)
        {
            $num=mt_rand(0,$len);//产生一个0到$len之间的随机数
            if($i==0){
                $code.=$str[$num];
            }else{
                $code.=$number[$num];
            }

        }
        return $code;
    }

    # 图片上传方法
    public function uploadImg(Request $request)
    {
        if ($request->isMethod('post')) {
            $file = $_FILES['upload_image'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            #获取扩展名并转成小写
            $file_suffix =  strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            if (!in_array($file_suffix, array('jpg', 'jpeg', 'png', 'gif'))) {
                return CommonController::echoJson(400,'suffix error');
            }
            if (!file_exists($file_tmp)) {
                return CommonController::echoJson(401,'tmp_name error');
            }
            #图片限制小于3mb
            if (filesize($file_tmp) > 3 * 1024 * 1024) {
                return CommonController::echoJson(402,'file size error');
            }
            $content = File::get($file['tmp_name']);
            $disk = QiniuStorage::disk('qiniu');
            #重命名
            $file_name = md5($file_name.time()).'.'.$file_suffix;
            $rs = $disk->put($file_name,$content);
            if(!$rs){
                return CommonController::echoJson(403,'upload failed');
            }
            return CommonController::echoJson(200,'success',array('img_name'=>$file_name));
        }
    }

    #统一json形式
    public static function echoJson($status, $msg = '', $data = '')
    {
        if($status==200){
            $result = ['status'=>$status,'msg'=>$msg,'data'=>$data];
        }else{
            $result = ['status'=>$status,'msg'=>$msg,'data'=>$data,'error'=>$msg];
        }
        return response()->json($result);

    }

    #头像
    public static function showAvatar($img){
        if($img){
            return env('App_IMAGE_URL').$img.'-avatar';
        }else{
            #默认头像
            return asset ("/nose_source/img/avatar.png");
        }
    }

    /**
     * 处理类型数据
     * @param $array
     * @param $key
     * @return array
     */
    public static function _initType($array, $key)
    {
        if ($key) {
            if (isset($array[$key])) {
                return $array[$key];
            } else {
                return '';
            }
        } else {
            return $array;
        }
    }

    #用户类型
    public static function userType($key = 0){

        $array = array(
            '1' => '初级会员',
            '2' => '中级会员',
            '3' => '高级会员',
        );
        return self::_initType($array, $key);
    }
    #用户身份
    public static function userIdentity($key = 0){
        $array = array(
            '1' => '玩家',
            '2' => '摄影师',
            '3' => '傻白甜',
        );
        return self::_initType($array, $key);
    }

    #用户状态
    public static function userStatus($key = 0){
        $array = array(
            '1' => '正常',
            '2' => '禁言',
            '3' => '注销',
        );
        return self::_initType($array, $key);
    }

    #付费状态
    public static function payStatus($key = 0){
        $array = array(
            '1' => '已付费',
            '2' => '未付费',
        );
        return self::_initType($array, $key);
    }

    #帖子类型
    public static function postType($key = 0){
        $array = array(
            '1' => '私属物品投稿',//最终用户权限
            '2' => '网友玩家投稿',
            '3' => '性感御姐投稿',
            '4' => '高贵女王投稿',
            '5' => '萌萌萝莉投稿',
        );
        return self::_initType($array, $key);
    }

    #帖子是否收费
    public static function postPayType($key = 0){
        $array = array(
            '1' => '免费',
            '2' => '收费',
        );
        return self::_initType($array, $key);
    }

    #帖子状态
    public static function postStatus($key=0){
        $array = array(
            '1' => '审核中',
            '2' => '审核通过',
            '3' => '审核未通过',
            '4' => '删除',
        );
        return self::_initType($array, $key);
    }

    #性别
    public static function gender($key=0){
        $array = array(
            '1' => '男',
            '2' => '女',
        );
        return self::_initType($array, $key);
    }


}
