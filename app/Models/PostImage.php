<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    #获取拥有此图片的投稿。
    public function post()
    {
        return $this->belongsTo('App\Models\post');
    }
}
