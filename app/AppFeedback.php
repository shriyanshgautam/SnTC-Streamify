<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppFeedback extends Model
{
    public function appUser()
    {
        return $this->belongsTo('App\AppUser');
    }
}
