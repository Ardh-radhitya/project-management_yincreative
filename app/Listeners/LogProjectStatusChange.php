<?php

namespace App\Listeners;

use App\Events\ProjectStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log; // <-- Tambahkan ini

class LogProjectStatusChange
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * Fungsi ini akan otomatis berjalan saat ProjectStatusUpdated diumumkan
     */
    public function handle(ProjectStatusUpdated $event): void
    {
        // Ambil data proyek dari event
        $project = $event->project;

        // Tulis pesan log ke file laravel.log
        Log::info("Status Proyek ID {$project->id} ('{$project->name}') diubah menjadi: {$project->status}");
    }
}
