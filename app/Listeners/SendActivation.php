<?php

namespace MailService\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use MailService\Mail\ActivationMailer;
use Log;

class SendActivation implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->user_email)
        ->send(new ActivationMailer($event->activation_link));

        Log::info('SendActivation', ["activation_link" => $event->activation_link, "email" => $event->user_email]);
    }
}
