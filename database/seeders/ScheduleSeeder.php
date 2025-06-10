<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $startTimes = ['07:00:00', '08:30:00', '10:00:00', '12:30:00', '14:00:00'];
        
        // Get all gurus, subjects, and rooms
        $gurus = Guru::all();
        $subjects = Subject::all();
        $rooms = Room::all();
        
        for ($i = 1; $i <= 10; $i++) {
            $day = $days[$i % count($days)];
            $startTime = $startTimes[$i % count($startTimes)];
            $endTime = date('H:i:s', strtotime($startTime) + 5400); // 1.5 hours later
            
            $guru = $gurus[$i % $gurus->count()];
            $subject = $subjects[$i % $subjects->count()];
            $room = $rooms[$i % $rooms->count()];
            
            Schedule::create([
                'title' => $subject->name . ' - ' . $guru->nama,
                'day' => $day,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'guru_id' => $guru->id,
                'subject_id' => $subject->id,
                'subject' => $subject->name, // For backward compatibility
                'room_id' => $room->id,
                'room' => $room->name, // For backward compatibility
                'description' => 'Jadwal pelajaran ' . $subject->name . ' dengan ' . $guru->nama,
                'status' => 'active'
            ]);
        }
    }
}