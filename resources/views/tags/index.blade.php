@extends('layouts.app')

@section('content')

@foreach ($tags as $tag)
<a href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
@endforeach

@endsection
