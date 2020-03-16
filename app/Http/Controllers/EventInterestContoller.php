<?php

namespace App\Http\Controllers;

use Auth;
use \App\Event;
use \App\Events\EventInterested;
use Illuminate\Http\Request;

class EventInterestContoller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $events = $user->interests;
        return view('events.interests', ["events" => $events]);
    }

    public function create(int $id)
    {
        $user = Auth::user();
        $event = Event::find($id);

        $event->interested()->attach($user->id);
        event(new EventInterested($event, $user));

        return redirect()->back();
    }

}
