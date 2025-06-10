<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all schedules with their students
        $schedules = Schedule::all();
        $guruUsers = User::where('role', 'guru')->get();
        $statuses = ['present', 'absent', 'late', 'sick', 'permission'];
        
        // Generate attendance records for the last 10 days
        for ($day = 1; $day <= 10; $day++) {
            $date = date('Y-m-d', strtotime("-$day days"));
            
            // Skip weekends
            $dayOfWeek = date('N', strtotime($date));
            if ($dayOfWeek > 5) { // 6 = Saturday, 7 = Sunday
                continue;
            }
            
            // For each schedule
            foreach ($schedules as $schedule) {
                // Skip if schedule day doesn't match the current day
                $scheduleDay = $this->getDayNumber($schedule->day);
                if ($scheduleDay != $dayOfWeek) {
                    continue;
                }
                
                // Get students for this schedule
                $students = DB::table('schedule_murid')
                    ->where('schedule_id', $schedule->id)
                    ->join('murids', 'schedule_murid.murid_id', '=', 'murids.id')
                    ->select('murids.id')
                    ->get();
                
                // Mark attendance for each student
                foreach ($students as $student) {
                    $status = $statuses[array_rand($statuses)];
                    $notes = null;
                    
                    if ($status != 'present') {
                        $notes = "Catatan untuk status $status pada tanggal $date";
                    }
                    
                    Attendance::create([
                        'schedule_id' => $schedule->id,
                        'murid_id' => $student->id,
                        'date' => $date,
                        'status' => $status,
                        'notes' => $notes,
                        'marked_by' => $guruUsers->random()->id
                    ]);
                }
            }
        }
    }
    
    /**
     * Convert day name to day number (1 = Monday, 5 = Friday)
     */
    private function getDayNumber($dayName)
    {
        $days = [
            'Senin' => 1,
            'Selasa' => 2,
            'Rabu' => 3,
            'Kamis' => 4,
            'Jumat' => 5,
            'Sabtu' => 6,
            'Minggu' => 7
        ];
        
        return $days[$dayName] ?? null;
    }
}