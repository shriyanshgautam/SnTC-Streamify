<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    public function streams()
    {
        return $this->hasMany('App\Stream');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
}
