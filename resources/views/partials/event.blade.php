<div class="event">
    <img  class="event-image" src="https://picsum.photos/200" alt="An image representing  {{ $event->name }}">
    <span class="event-name">{{$event->name}}</span>
    <span class="event-time">{{ \Carbon\Carbon::parse($event->start_date)->toDateTimeString() }}</span>
</div>

