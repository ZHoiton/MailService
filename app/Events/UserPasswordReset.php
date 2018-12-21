<?php

namespace MailService\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserPasswordReset
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reset_link;

    public $user_email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $reset_link)
    {
        $this->reset_link = $reset_link;
        $this->user_email = $email;
    }
}
