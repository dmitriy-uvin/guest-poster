<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlatformImportUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $type;
    public string $message;

    public function __construct(string $type = 'error', string $message = '')
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function broadcastAs()
    {
        return 'platform-import-updated';
    }

    public function broadcastOn()
    {
        return new Channel('platform-import');
    }
}
