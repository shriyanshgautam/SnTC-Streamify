<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }
}
