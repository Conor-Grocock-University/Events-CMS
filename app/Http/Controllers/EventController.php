<?php

namespace App\Http\Controllers;

use Auth;
use Carbon;

use \App\Event;
use \App\Tag;
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
        $event->latitude = $request->input('latitude');
        $event->longitude = $request->input('longitude');
        $event->creator_id = $user->id;

        $event->save();

        $tags = array_map('trim', explode(',', $request->tags));

        foreach ($tags as $tag) {
            $tagModel = Tag::firstOrCreate(['name' => $tag]);
            $event->tags()->attach($tagModel);
        }

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
        return view('events/edit', ["event" => $event]);
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
        $event->name = $request->name;
        $event->description = $request->description;
        $event->start_date = $request->input('start-date', \Carbon\Carbon::now());
        $event->latitude = $request->input('latitude');
        $event->longitude = $request->input('longitude');

        $event->save();

        $tags = array_map('trim', explode(',', $request->tags));

        foreach ($tags as $tag) {
            $tagModel = Tag::firstOrCreate(['name' => $tag]);
            if(!$event->tags->contains($tagModel)) {
                $event->tags()->attach($tagModel);
            }
        }

        return redirect()->route('events.show', ["event"=>$event->id]);
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
}
