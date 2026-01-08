<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom end_date agar BOLEH KOSONG (Nullable)
        // Khusus PostgreSQL
        DB::statement('ALTER TABLE projects ALTER COLUMN end_date DROP NOT NULL');
    }

    public function down(): void
    {
        // Kembalikan jadi wajib diisi (jika rollback)
        DB::statement('ALTER TABLE projects ALTER COLUMN end_date SET NOT NULL');
    }
};
