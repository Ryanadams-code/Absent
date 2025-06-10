<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gurus = Guru::all();
        $subjects = Subject::all();
        
        // For each guru, assign 1-3 subjects
        foreach ($gurus as $guru) {
            // Get random number of subjects between 1 and 3
            $numSubjects = rand(1, 3);
            
            // Get random subjects
            $randomSubjects = $subjects->random($numSubjects);
            
            foreach ($randomSubjects as $subject) {
                // Check if the relationship already exists
                $exists = DB::table('guru_subject')
                    ->where('guru_id', $guru->id)
                    ->where('subject_id', $subject->id)
                    ->exists();
                
                if (!$exists) {
                    DB::table('guru_subject')->insert([
                        'guru_id' => $guru->id,
                        'subject_id' => $subject->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }
}