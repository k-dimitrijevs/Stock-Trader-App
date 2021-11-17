<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $email;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
