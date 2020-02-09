@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('events.store') }}">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name">
    <label for="start-time">Start Time</label>
    <input type="datetime-local" id="start-time"
           name="start-time" value="{{ \Carbon\Carbon::now() }}">
    <input type="submit" value="Create new event">
</form>

@endsection
