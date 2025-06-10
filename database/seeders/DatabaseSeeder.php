<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders in the correct order to handle dependencies
        $this->call([
            UserSeeder::class,         // First create users
            GuruSeeder::class,         // Then create gurus linked to users
            MuridSeeder::class,        // Then create murids linked to users
            SubjectSeeder::class,      // Create subjects
            RoomSeeder::class,         // Create rooms
            GuruSubjectSeeder::class,  // Link gurus to subjects
            ScheduleSeeder::class,     // Create schedules
            ScheduleMuridSeeder::class, // Link schedules to murids
            AttendanceSeeder::class,   // Create attendance records
        ]);
    }
}
