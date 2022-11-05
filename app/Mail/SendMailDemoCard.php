<?php

namespace App\Mail;

use App\Models\listUrl;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailDemoCard extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, listUrl $listUrl)
    {
        //
        $this->user = $user;
        $this->date = Carbon::parse($listUrl->trial_date)->format('Y-m-d');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Hi Again. Explore your demo Swap card here!")
            ->markdown('emails.SendMailDemoCard');
    }
}
