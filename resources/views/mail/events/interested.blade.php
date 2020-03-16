@component('mail::message')
# Thanks for registering your interest in {{ $event->name }}

We'll send you an email nearer the time to remind you

@component('mail::button', ['url' => route('events.show', ['event' => $event->id]) ])
View Event
@endcomponent

Thanks, <br>
{{ config('app.name') }}
@endcomponent
