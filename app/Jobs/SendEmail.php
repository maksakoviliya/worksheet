<?php

namespace App\Jobs;

use App\Events\WorksheetEdited;
use App\Mail\EmailCreatedWorksheet;
use App\Mail\EmailEditedWorksheet;
use App\Worksheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $worksheet;
    private $type;

    /**
     * Create a new job instance.
     *
     * @param Worksheet $worksheet
     */
    public function __construct($data)
    {
        $this->worksheet=$data['worksheet'];
        $this->type=$data['type'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type === 'edit') {
            $email = new EmailEditedWorksheet($this->worksheet);
        } else {
            $email = new EmailCreatedWorksheet($this->worksheet);
        }
        try {
            Mail::to(config('mail.to.address'))->send($email);
        } catch (\Exception $exception) {
            Log::info($exception);
        }
    }
}
