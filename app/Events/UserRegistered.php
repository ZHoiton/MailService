<?php

namespace MailService\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $activation_code;

    public $user_email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $activation_code)
    {
        $this->activation_code = $activation_code;
        $this->user_email = $email;
    }
}
