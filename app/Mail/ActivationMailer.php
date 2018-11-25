<?php

namespace MailService\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationMailer extends Mailable
{
    use Queueable, SerializesModels;

    private $activation_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->activation_code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.activate_user')
            ->with([
                'activation_code' => $this->activation_code,
            ]);
    }
}
