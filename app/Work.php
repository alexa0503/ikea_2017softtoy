<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\WechatUser');
    }
}
