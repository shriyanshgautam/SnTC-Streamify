<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionHolder extends Model
{
    // plural used for many to many relationship
    public function streams()
    {
        return $this->belongsToMany('App\Stream');
    }
}
