<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User');
    }
    /**
     * 获取博客文章的评论。
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
