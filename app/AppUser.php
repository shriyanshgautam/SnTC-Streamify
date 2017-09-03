<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    //


    // plural used for many to many relationship
    public function streams()
    {
        return $this->belongsToMany('App\Stream');
    }

    // plural used for many to many relationship
    public function events()
    {
        return $this->belongsToMany('App\Event');
    }

    // plural used for many to many relationship
    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }

    public function appPosts()
    {
        return $this->hasMany('App\AppPost');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }

    public function appFeedbacks()
    {
        return $this->hasMany('App\AppFeedback');
    }
}
