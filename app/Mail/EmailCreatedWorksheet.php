<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailCreatedWorksheet extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->from('mail@example.com', 'Mailtrap')->subject('Создана новая анкета')->view('mails.worksheet-created');
        return $this->from('mail@example.com', 'Mailtrap')
            ->subject('Test Queued Email')
            ->view('mails.worksheet-created');
    }
}
