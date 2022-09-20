<?php

namespace App\Listeners;

use App\Events\UserSignup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendNewsletter
{
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
     * @param  \App\Events\UserSignup  $event
     * @return void
     */
    public function handle(UserSignup $event)
    {

       Mail::send('eventMail', ['data'=> $event], function($message) use ($event) {
           $message->to($event->result->email_address);
           $message->subject('Newsletter Test');

        });
    }
}
