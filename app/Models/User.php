<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        #'name', 'email', 'password',
//    ];
//
//    /**
//     * The attributes that should be hidden for arrays.
//     *
//     * @var array
//     */
//    protected $hidden = [
//        #'password', 'remember_token',
//    ];
//    public function postInfo()
//    {
//        return $this->hasOne('App\Models\Post');
//    }

    /**
     * 获取与指定用户详情。
     */
    public function userInfo()
    {
        return $this->hasOne('App\Models\UserInfo');
    }

}
