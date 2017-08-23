<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    //Sungular form is used due to many to one relationship from this side
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }

    public function stream()
    {
        return $this->belongsTo('App\Stream');
    }

    public function appUsers()
    {
        return $this->belongsToMany('App\AppUser');
    }
}
