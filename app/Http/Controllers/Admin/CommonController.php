<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
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
            '1' => '注册会员',
            '2' => '发帖会员',
            '3' => '高级会员',
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
            '1' => '玩家投稿',
            '2' => '模特投稿',
            '3' => '模特私属',
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

    #统一json形式
    public static function echoJson($status, $msg = '', $data = '')
    {
        $result = ['status'=>$status,'msg'=>$msg,'data'=>$data];
        return response()->json($result);

    }



}
