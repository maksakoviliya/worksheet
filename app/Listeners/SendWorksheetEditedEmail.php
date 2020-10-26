<?php

namespace App\Listeners;

use App\Events\WorksheetEdited;
use App\Jobs\SendEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendWorksheetEditedEmail
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
     * @param  WorksheetEdited  $event
     * @return void
     */
    public function handle(WorksheetEdited $event)
    {
        SendEmail::dispatch();
    }
}
