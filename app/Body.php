<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    public function streams()
    {
        return $this->belongsToMany('App\Stream');
    }
}
