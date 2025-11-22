<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade'); // Laporan untuk tugas mana
            $table->foreignId('user_id')->constrained('users'); // Siapa yang lapor (Team)
            $table->text('progress_note'); // Isi laporannya
            $table->timestamps(); // Mencatat kapan lapor (created_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_progress');
    }
};
