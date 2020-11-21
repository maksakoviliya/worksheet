<?php

namespace App\Mail;

use App\Filial;
use App\User;
use App\Worksheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailCreatedWorksheet extends Mailable
{
    use Queueable, SerializesModels;

    public $worksheet;
    public $users;
    public $filials;

    /**
     * Create a new message instance.
     *
     * @param Worksheet $worksheet
     */
    public function __construct(Worksheet $worksheet)
    {
        $this->worksheet = $worksheet;
        $this->users = User::all();
        $this->filials = Filial::all();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Новая анкета добавлена')->view('mails.worksheet');
    }
}
