<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('projects', function ($table) {
            // Ini kolom yang bikin error tadi karena belum ada
            $table->unsignedBigInteger('user_id')->nullable()->after('client_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('projects', function ($table) {
            $table->dropColumn('user_id');
        });
    }
};
