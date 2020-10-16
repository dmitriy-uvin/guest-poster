<?php

namespace App\Events;

use App\Models\Platform;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlatformImportCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ?Platform $platform;

    public string $type;
    public string $message;

    public function __construct(
        string $type = 'error',
        string $message = '',
        Platform $platform = null
    ) {
        $this->type = $type;
        $this->message = $message;
        $this->platform = $platform;
    }

    public function broadcastAs()
    {
        return 'platform-import-created';
    }

    public function broadcastOn()
    {
        return new Channel('platform-import');
    }
}
