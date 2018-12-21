<?php

namespace MailService\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMailer extends Mailable
{
    use Queueable, SerializesModels;

    private $reset_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link)
    {
        $this->reset_link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.reset_password')
            ->with([
                'reset_link' => $this->reset_link,
            ]);
    }
}
