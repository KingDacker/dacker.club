<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

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

}
