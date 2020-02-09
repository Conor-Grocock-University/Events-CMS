<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function interested()
    {
        return $this->belongsToMany('App\User', 'interests')->withTimestamps();
    }
}
