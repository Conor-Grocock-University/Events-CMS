{{ $event->name }}

<form method="post" action="{{ route('events.interested', $event->id) }}">
    @csrf
    <input type="submit" value="Show Interest"
    @if (Auth::user()->interests->contains($event->id))
        disabled
    @endif>
</form>

{!! $event->description !!}
