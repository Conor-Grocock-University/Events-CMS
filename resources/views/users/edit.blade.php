@extends('layouts.app')

@section('content')

<form action="{{ route('users.update', ["user"=> $user]) }}" method="post">
    @method('put')
    @csrf
    <div class="details">
        <div class="form-group">
            <label for="name">Your name</label>
            <input type="text" id="name" name="name" autocomplete="off" value={{ $user->name }}>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value={{ $user->email }} disabled>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input type="tel" name="phone_number" id="phone_number" value={{ $user->phone_number }}>
        </div>
    </div>
    <input type="submit" value="Update your profile">
</form>

@endsection

@section('styles')
<link href="{{ asset('css/event/create.css') }}" rel="stylesheet">
<link href="{{ asset('css/partial/form.css') }}" rel="stylesheet">
@endsection
