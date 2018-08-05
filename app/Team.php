<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Team extends Model
{
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function members()
    {
        return $this->belongsToMany('App\AppUser');
    }
}