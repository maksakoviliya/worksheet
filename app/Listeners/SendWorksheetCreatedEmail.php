<?php

namespace App\Listeners;

use App\Events\WorksheetCreated;
use App\Jobs\SendEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWorksheetCreatedEmail
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
     * @param  WorksheetCreated  $event
     * @return void
     */
    public function handle(WorksheetCreated $event)
    {
        SendEmail::dispatch(['type' => 'create', 'worksheet' =>$event->worksheet]);
    }
}
