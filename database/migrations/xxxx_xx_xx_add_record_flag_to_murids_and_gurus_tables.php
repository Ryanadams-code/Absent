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
        Schema::table('murids', function (Blueprint $table) {
            $table->enum('record_flag', ['active', 'delete'])->default('active');
        });

        Schema::table('gurus', function (Blueprint $table) {
            $table->enum('record_flag', ['active', 'delete'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('murids', function (Blueprint $table) {
            $table->dropColumn('record_flag');
        });

        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn('record_flag');
        });
    }
};
