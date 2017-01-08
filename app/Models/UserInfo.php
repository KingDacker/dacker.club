<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = ['user_id'];
    /**
     * 获取拥有此详情的用户。
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
