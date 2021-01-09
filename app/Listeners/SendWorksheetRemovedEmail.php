<?php

namespace App\Listeners;

use App\Events\WorksheetRemoved;
use App\Jobs\SendEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWorksheetRemovedEmail
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
     * @param WorksheetRemoved $event
     * @return void
     */
    public function handle(WorksheetRemoved $event)
    {
        SendEmail::dispatch(['type' => 'remove', 'worksheet' =>$event->worksheet]);
    }
}
