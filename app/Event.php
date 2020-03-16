<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Event extends Model
{
    use Searchable;

    public function interested()
    {
        return $this->belongsToMany('App\User', 'interests')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'event_tag')->withTimestamps();
    }

    public function recommendations() {
        $events = Event::whereHas('tags', function($tagsQuery) {
            $tagsQuery->whereIn('name', $this->tags);
        })->get();

        $filtered = $events->filter(function ($value, $key) {
            return $value->id != $this->id;
        })->take(3);

        return $filtered;
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array["tags"] = array();
        foreach ($this->tags as $tag) {
            array_push($array["tags"], $tag->name);
        }

        return $this->toArray();
    }
}
