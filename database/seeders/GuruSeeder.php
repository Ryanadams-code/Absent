<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get guru users to link with guru records
        $guruUsers = User::where('role', 'guru')->get();
        
        // Subjects for teachers
        $subjects = ['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA', 'IPS', 'Pendidikan Agama', 'PPKN', 'Seni Budaya', 'Penjaskes', 'Informatika'];
        
        // Create 10 guru records
        for ($i = 1; $i <= 10; $i++) {
            $gender = $i % 2 == 0 ? 'Laki-laki' : 'Perempuan';
            $userId = null;
            
            // Link to existing guru users if available
            if ($i <= $guruUsers->count()) {
                $userId = $guruUsers[$i-1]->id;
            }
            
            Guru::create([
                'nip' => '1234567890' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'nama' => 'Guru ' . ($i <= 3 ? $i : $i + 7), // Match names with existing users for first 3
                'jenis_kelamin' => $gender,
                'tanggal_lahir' => date('Y-m-d', strtotime('-' . (25 + $i) . ' years')),
                'alamat' => 'Jl. Pendidikan No. ' . $i . ', Jakarta',
                'no_telepon' => '08123456' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'mata_pelajaran' => $subjects[$i-1],
                'user_id' => $userId,
                'record_flag' => 'active'
            ]);
        }
    }
}