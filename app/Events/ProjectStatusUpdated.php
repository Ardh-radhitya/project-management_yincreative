<?php

namespace App\Events;

use App\Models\Project;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Properti untuk menyimpan data proyek
    public Project $project;

    /**
     * Create a new event instance.
     * Kita modifikasi constructor agar menerima objek Project
     */
    public function __construct(Project $project) // <-- Modifikasi ini
    {
        $this->project = $project; // <-- Tambahkan ini
    }

    /**
     * Get the channels the event should broadcast on.
     * (Biarkan default, kita tidak pakai broadcasting sekarang)
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
