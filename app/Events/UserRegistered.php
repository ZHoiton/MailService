<?php

namespace MailService\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $activation_link;

    public $user_email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $activation_link)
    {
        $this->activation_link = $activation_link;
        $this->user_email = $email;
    }
}
