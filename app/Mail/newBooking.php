<?php

namespace App\Mail;

use App\Models\CompanyCredential;
use App\Models\Location;
use App\Models\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newBooking extends Mailable
{
    use Queueable, SerializesModels;
    public $booking;
    public $location;
    public $services;
    public $status;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking)
    {
        //
        $this->booking = $booking;

        $location = Location::findOrFail($this->booking->location_id);
        $this->location = $location;

        $status = Status::findOrFail($this->booking->status_id);
        $this->status = $status;

        $services = $this->booking->services()->get()->pluck('name')->toArray();
        $this->services = $services;

        $company = CompanyCredential::first();
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newBooking');
    }
}
