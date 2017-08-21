<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppPost extends Model
{
    //
    public function appUserId()
    {
        return $this->belongsTo('App\AppUser');
    }
}
