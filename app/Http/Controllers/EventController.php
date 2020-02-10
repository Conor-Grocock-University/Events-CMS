<?php

namespace App\Http\Controllers;

use Auth;
use Carbon;

use \App\Event;
use \App\Events\EventInterested;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('start_date', 'desc')->get();
        return view('events/list', ["events" => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $user = Auth::user();

        $event->name = $request->name;
        $event->description = $request->description;
        $event->start_date = $request->input('start-date', \Carbon\Carbon::now());
        $event->creator_id = $user->id;

        $event->save();

        event(new EventInterested($event, $user));
        return redirect()->route('events.show', ["event"=>$event->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events/show', ["event" => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function interest(int $id)
    {
        $user = Auth::user();
        $event = Event::find($id);

        $event->interested()->attach($user->id);
        event(new EventInterested($event, $user));

        return redirect()->back();
    }
}
