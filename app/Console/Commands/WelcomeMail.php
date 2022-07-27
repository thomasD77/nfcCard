<?php

namespace App\Console\Commands;

use App\Mail\WelcomeMailPlatform;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class WelcomeMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:welcome';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customers = User::query()
            ->whereNotNull('email_verified_at')
            ->where('needs_welcome', 1)
            ->get();

        if (!$customers->isEmpty()) {
            $customer = $customers->random();
        } else {
            return "All customers are handled";
        }

        Mail::to($customer->email)->send(new WelcomeMailPlatform());

        $customer->needs_welcome = 0;
        $customer->update();
    }
}
