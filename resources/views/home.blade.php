@extends('layouts.app')

@section('content')

@foreach ($tags as $tag)
<div class="tag-row">
    <h2 class="row-heading">
        {{ $tag->name }}
    </h2>
    <div class="events">
        @forelse ($tag->events as $event)
            <div class="event">
                <img  class="event-image" src="https://picsum.photos/200" alt="An image representing  {{ $event->name }}">
                <a href="{{ route('events.show', $event->id) }}">
                    <span class="event-name">{{$event->name}}</span>
                </a>
                <span class="event-time">{{ \Carbon\Carbon::parse($event->start_date)->toDateTimeString() }}</span>
            </div>
            @empty
        <span class="empty">Looks like theres space here for an event. <a href="{{ route('events.create') }}">Why not be the one to make it?</a></span>
        @endforelse

    </div>
</div>
@endforeach


@endsection

@section('styles')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

