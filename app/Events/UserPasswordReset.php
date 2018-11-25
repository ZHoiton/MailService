<?php

namespace MailService\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserPasswordReset
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reset_code;

    public $user_email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $reset_code)
    {
        $this->reset_code = $reset_code;
        $this->user_email = $email;
    }
}
