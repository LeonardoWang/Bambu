<?php

namespace App\Listeners;

use App\Events\NotifEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifEventListener
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
     * @param  NotifEvent  $event
     * @return void
     */
    public function handle(NotifEvent $event)
    {
        //
    }
}
