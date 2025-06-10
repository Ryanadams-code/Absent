<?php

namespace Database\Seeders;

use App\Models\Murid;
use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleMuridSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = Schedule::all();
        $murids = Murid::all();
        
        // For each schedule, assign 5-8 random students
        foreach ($schedules as $schedule) {
            // Get random number of students between 5 and 8
            $numStudents = rand(5, 8);
            
            // Get random students
            $randomMurids = $murids->random($numStudents);
            
            foreach ($randomMurids as $murid) {
                DB::table('schedule_murid')->insert([
                    'schedule_id' => $schedule->id,
                    'murid_id' => $murid->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}