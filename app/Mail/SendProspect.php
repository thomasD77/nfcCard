<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendProspect extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $member;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact, $member)
    {
        //
        $this->contact = $contact;
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Yes! A new connection is waiting for you")
            ->from($this->member->email)
            ->markdown('emails.prospect');
    }
}
