<?php

namespace MailService\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationMailer extends Mailable
{
    use Queueable, SerializesModels;

    private $activation_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link)
    {
        $this->activation_link = $link;
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
                'activation_link' => $this->activation_link,
            ]);
    }
}
