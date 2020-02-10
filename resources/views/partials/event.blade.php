@php
$time = \Carbon\Carbon::parse($event->start_date)->toDateTimeString()
@endphp

@component('mail::table')
| Time         |
| :----------: |
| {{ $time }}  |
@endcomponent


