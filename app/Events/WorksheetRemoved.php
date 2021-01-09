<?php

namespace App\Events;

use App\Worksheet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WorksheetRemoved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $worksheet;

    /**
     * Create a new event instance.
     *
     * @param Worksheet $worksheet
     */
    public function __construct(Worksheet $worksheet)
    {
        $this->worksheet = $worksheet;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
