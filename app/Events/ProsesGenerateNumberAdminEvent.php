<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProsesGenerateNumberAdminEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $userId;
    public int $total;
    public int $ke;
    public int $campaignId;


    /**
     * Create a new event instance.
     */
    public function __construct(int $userId, int $campaignId, int $total, int $ke)
    {
        Log::info('ProsesGenerateNumberAdminEvent', [$campaignId, $userId, $total, $ke]);
        $this->userId = $userId;
        $this->campaignId = $campaignId;
        $this->total = $total;
        $this->ke = $ke;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, PrivateChannel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('prosesGenerateNumberAdminEvent.' . $this->campaignId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'ProsesGenerateNumberAdminEvent';
    }
}
