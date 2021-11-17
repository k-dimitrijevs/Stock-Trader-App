<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Mail\TestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFired implements ShouldQueue
{
    use Queueable;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\SendMail $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        Mail::to($event->getEmail())->send(new TestMail());
    }
}
