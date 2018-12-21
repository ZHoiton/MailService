<?php

namespace MailService\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use MailService\Mail\ResetPasswordMailer;
use Log;

class SendPassword implements ShouldQueue
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
        ->send(new ResetPasswordMailer($event->reset_link));

        Log::info('SendPassword', ["reset_link" => $event->reset_link, "email" => $event->user_email]);
    }
}
