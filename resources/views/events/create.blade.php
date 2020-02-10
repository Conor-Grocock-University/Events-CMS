@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('events.store') }}">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name">
    <label for="start-time">Start Time</label>
    <input type="datetime-local" id="start-time" name="start-time" value="{{ \Carbon\Carbon::now() }}">

    <textarea name="description">Next, use our Get Started docs to setup Tiny!</textarea>

    <input type="submit" value="Create new event">
</form>

@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/y2m6ffwzu04ijs5vyy5zaxztv56m122l975zblfk61k3omqv/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
    <script>tinymce.init({
        selector:'textarea',
        height: 400,
        plugins: 'a11ychecker advcode formatpainter linkchecker lists checklist powerpaste table tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter table'
      });</script>
@endsection
