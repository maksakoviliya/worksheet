<?php

namespace App\Mail;

use App\Worksheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailEditedWorksheet extends Mailable
{
    use Queueable, SerializesModels;

    public $worksheet;

    /**
     * Create a new message instance.
     *
     * @param Worksheet $worksheet
     */
    public function __construct(Worksheet $worksheet)
    {
        $this->worksheet = $worksheet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Анкета изменена')->view('mails.worksheet');
    }
}
