<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    // plural used for many to many relationship
    public function appUsers()
    {
        return $this->belongsToMany('App\AppUser');
    }

    // plural used for many to many relationship
    public function contents()
    {
        return $this->belongsToMany('App\Content');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }

    public function stream()
    {
        return $this->belongsTo('App\Stream');
    }

}
