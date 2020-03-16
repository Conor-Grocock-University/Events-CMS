<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function events()
    {
        return $this->belongsToMany('App\Event', 'event_tag')->withTimestamps();
    }
    public function toSearchableArray()
    {
        return $this->toArray();
    }
}
