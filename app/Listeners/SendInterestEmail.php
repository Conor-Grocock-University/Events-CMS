<?php

namespace App\Listeners;

use App\Events\EventInterested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInterestEmail
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
        $event->user->notify(new \App\Notifications\EventInterested($event->event));
    }
}
