<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name');
            $table->string('email')->unique(); // Biar nggak dobel
            $table->string('password');
            $table->string('photo_profile')->nullable(); // Optional
            $table->timestamp('email_verified_at')->nullable(); // Opsional, kalau kamu mau sistem verifikasi
            $table->rememberToken(); // Buat auth "remember me"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
