<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlainTextEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $customFrom, $customSubject, $customBody;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from, $subject, $body)
    {
        $this->customFrom = $from;
        $this->customSubject = $subject;
        $this->customBody = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('emails.rawbody')
            ->from($this->customFrom)
            ->subject($this->customSubject);
    }
}
