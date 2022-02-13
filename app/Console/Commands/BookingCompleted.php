<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BookingCompleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:completed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync all the Booking statuses and update them if they are completed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateNow = Carbon::now()->format('Y-m-d H:i:s');
        $bookings = Booking::all();


        foreach ($bookings as $booking)
        {
            if($booking->date . " " . $booking->endTime < $dateNow)
            {
                $booking->status_id = 4;
                $booking->update();
            }
        }
    }
}
