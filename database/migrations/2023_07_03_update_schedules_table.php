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
        // First, add the new foreign key columns
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignId('subject_id')->nullable()->after('guru_id');
            $table->foreignId('room_id')->nullable()->after('subject');
        });

        // We'll handle data migration in a seeder or manually
        
        // In a production environment, you would want to:
        // 1. Create the new tables
        // 2. Migrate the data from string fields to relationships
        // 3. Then remove the old columns
        
        // For now, we'll keep both columns for backward compatibility
        // and to avoid breaking existing functionality
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('subject_id');
            $table->dropColumn('room_id');
        });
    }
};