<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
//    /**
//     * 处理类型数据
//     * @param $array
//     * @param $key
//     * @return array
//     */
//    public static function _initType($array, $key)
//    {
//        if ($key) {
//            if (isset($array[$key])) {
//                return $array[$key];
//            } else {
//                return '';
//            }
//        } else {
//            return $array;
//        }
//    }
//
//    #用户类型
//    public static function userType($key = 0){
//
//        $array = array(
//            '1' => '初级会员',
//            '2' => '中级会员',
//            '3' => '高级会员',
//        );
//        return self::_initType($array, $key);
//    }
//    #用户身份
//    public static function userIdentity($key = 0){
//        $array = array(
//            '1' => '玩家',
//            '2' => '摄影师',
//            '3' => '傻白甜',
//        );
//        return self::_initType($array, $key);
//    }
//
//    #用户状态
//    public static function userStatus($key = 0){
//        $array = array(
//            '1' => '正常',
//            '2' => '禁言',
//            '3' => '注销',
//        );
//        return self::_initType($array, $key);
//    }
//
//    #付费状态
//    public static function payStatus($key = 0){
//        $array = array(
//            '1' => '已付费',
//            '2' => '未付费',
//        );
//        return self::_initType($array, $key);
//    }
//
//    #帖子类型
//    public static function postType($key = 0){
//        $array = array(
//            '1' => '私属物品投稿',//最终用户权限
//            '2' => '网友玩家投稿',
//            '3' => '性感御姐投稿',
//            '4' => '高贵女王投稿',
//            '5' => '萌萌萝莉投稿',
//        );
//        return self::_initType($array, $key);
//    }
//
//    #帖子是否收费
//    public static function postPayType($key = 0){
//        $array = array(
//            '1' => '免费',
//            '2' => '收费',
//        );
//        return self::_initType($array, $key);
//    }
//
//    #帖子状态
//    public static function postStatus($key=0){
//        $array = array(
//            '1' => '审核中',
//            '2' => '审核通过',
//            '3' => '审核未通过',
//            '4' => '删除',
//        );
//        return self::_initType($array, $key);
//    }
//
//    #统一json形式
//    public static function echoJson($status, $msg = '', $data = '')
//    {
//        if($status==200){
//            $result = ['status'=>$status,'msg'=>$msg,'data'=>$data];
//        }else{
//            $result = ['status'=>$status,'msg'=>$msg,'data'=>$data,'error'=>$msg];
//        }
//        return response()->json($result);
//
//    }



}
