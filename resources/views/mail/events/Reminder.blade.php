@component('mail::message')
# You've got an event comming up

{{ $event->name }} is coming up tommorrow. We didn't want you to forget.

@include('partials.event', ["event" => $event])

Hope to see you there,<br>
{{ config('app.name') }}
@endcomponent
