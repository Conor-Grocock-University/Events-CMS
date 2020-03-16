@extends('layouts.app')

@section('content')

{{ $tag->name }}


@each('partials.event', $tag->events, 'event')
@endsection
