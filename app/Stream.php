<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    //Sungular form is used due to many to one relationship from this side
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    // pivot defined for using extra attribute for pivot relation
    // plural used for many to many relationship
    public function positionHolders()
    {
        return $this->belongsToMany('App\PositionHolder');
    }

    public function bodies()
    {
        return $this->belongsToMany('App\Body');
    }

    public function appUsers()
    {
        return $this->belongsToMany('App\AppUser');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }
}
