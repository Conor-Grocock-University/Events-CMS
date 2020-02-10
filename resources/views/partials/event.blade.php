@php
$time = \Carbon\Carbon::parse($event->start_date)->toDateTimeString()
@endphp

<h2><a href={{ route('events.show', [ "event" => $event ]) }}>{{ $event->name }}</a></h2>
<table style="width: 100%; text-align:center">
    <thead>
        <th>Time</th>
    </thead>
    <tbody>
        <tr>
            <td>{{ $time }}</td>
        </tr>
    </tbody>
</table>


