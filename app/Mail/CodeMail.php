<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    public $code;

    /**
     * Create a new message instance.
     *
     * @param $participant
     * @param $code
     */
    public function __construct($participant, $code)
    {
        $this->participant = $participant;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails/code')->subject('Игровой код');
    }
}
