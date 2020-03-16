@extends('layouts.app')

@section('content')

<h1 id="title">Upcomming Events</h1>

@forelse ($events as $event)
    <div class="event">
        <img  class="event-image" src="https://picsum.photos/200" alt="An image representing  {{ $event->name }}">
        <div class="event-info">
            <a href="{{ route('events.show', $event) }}">
            <span class="event-name">{{$event->name}}</span></a>
            <span class="event-time">{{ \Carbon\Carbon::parse($event->start_date)->toDateTimeString() }}</span>
        </div>
    </div>
@empty
    You haven't shown interest in any events yet. Why not have a <a href="{{ route('events.index') }}">look around</a>
@endforelse

@endsection

@section('styles')
<link href="{{ asset('css/event/list.css') }}" rel="stylesheet">
<link href="{{ asset('/css/events/interests.css ') }}" rel="stylesheet">


@endsection
