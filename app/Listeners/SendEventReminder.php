<?php

namespace App\Listeners;

use App\Events\EventInterested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEventReminder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventInterested  $event
     * @return void
     */
    public function handle(EventInterested $event)
    {
        $user  = $event->user;
        $interestedEvent = $event->event;

        $reminder_date = \Carbon\Carbon::parse($interestedEvent->start_date)->subDays(1);
        $user->notify((new \App\Notifications\EventReminder($interestedEvent))->delay($reminder_date));
    }
}
