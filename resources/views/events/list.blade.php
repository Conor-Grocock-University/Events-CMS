@extends('layouts.app')

@section('content')
@each('partials.event', $events, 'event')
@endsection
