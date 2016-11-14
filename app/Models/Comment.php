<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    #获取拥有此评论的文章。
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    #获取拥有此评论的用户
    public function userInfo()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
