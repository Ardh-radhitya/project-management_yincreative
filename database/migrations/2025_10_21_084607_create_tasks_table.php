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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade'); // Terhubung ke Proyek
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('To Do'); // Status awal: To Do, In Progress, Done
            $table->foreignId('assigned_to_user_id')->nullable()->constrained('users')->onDelete('set null'); // Siapa yang ditugaskan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
