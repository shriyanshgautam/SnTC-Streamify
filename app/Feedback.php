<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public function stream()
    {
        return $this->belongsTo('App\Stream');
    }

    public function appUser()
    {
        return $this->belongsTo('App\AppUser');
    }
}
