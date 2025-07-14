<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['Not Started', 'In Progress', 'Completed'])->default('Not Started');
            $table->unsignedBigInteger('client_id')->nullable(); // relasi ke client
            $table->unsignedBigInteger('admin_id')->nullable(); // dibuat oleh admin
            $table->timestamps();

            // Foreign key
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('project_categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
