@extends('layouts.app')

@section('content')

<h2 id="title">{{ $event->name }}</h2>

<div class="description">
    {!! $event->description !!}
</div>

<div class="side_panel">
    @auth
    <div class="interested">
            <form method="post" action="{{ route('events.interested', $event->id) }}">
                @csrf
                <input type="submit" value="Show Interest"
                @if (Auth::user()->interests->contains($event->id))
                    disabled
                @endif>
            </form>
        </div>
        @if (Auth::user()->id == $event->creator_id)
            <div class="creator">
                <a href="{{ route('events.edit', $event->id) }}">Edit Event</a>
            </div>
        @endif
    @endauth

<div class="tags">
@foreach ($event->tags as $tag)
<a class="tag" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
@endforeach
</div>


<iframe frameborder="0" style="border:0" class="map"
src="https://www.google.com/maps/embed/v1/view?zoom=15&center={{ $event->longitude }},{{ $event->latitude }}&key=AIzaSyBkLGoWEiu2GicrgPCEJi2_S53JN6-Xm2Q" allowfullscreen></iframe>

</div>

<div class="recommendations">
    <h3>Recommendations</h3>
    <div class="events">
    @foreach ($event->recommendations() as $recommendation)
        <div class="event">
            <img  class="event-image" src="https://picsum.photos/200" alt="An image representing  {{ $recommendation->name }}">
            <a href="{{ route('events.show', $event->id) }}">
                <span class="event-name">{{$recommendation->name}}</span>
            </a>
            <span class="event-time">{{ \Carbon\Carbon::parse($recommendation->start_date)->toDateTimeString() }}</span>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('styles')
<link href="{{ asset('css/event/show.css') }}" rel="stylesheet">
@endsection
