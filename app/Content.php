<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function notification()
    {
        return $this->belongsTo('App\Notification');
    }
}
