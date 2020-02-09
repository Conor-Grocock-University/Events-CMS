@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('events.store') }}">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name">
    <input type="submit" value="Create new event">
</form>

@endsection
