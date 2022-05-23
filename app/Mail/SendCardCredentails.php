<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCardCredentails extends Mailable
{
    use Queueable, SerializesModels;

    public $member;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->member = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->subject("Hi Again! I have some information for you. ")
//            ->from($this->member->email)
//            ->view('emails.card-credentails');

        return $this->subject("Hi Again! I have some information for you.")
        ->markdown('emails.card-credentails');
            

    }
}
