<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
