<?php

namespace Database\Seeders;

use App\Models\Murid;
use App\Models\User;
use Illuminate\Database\Seeder;

class MuridSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get murid users to link with murid records
        $muridUsers = User::where('role', 'murid')->get();
        
        // Classes for students
        $classes = ['X-A', 'X-B', 'XI-A', 'XI-B', 'XII-A', 'XII-B'];
        
        // Create 10 murid records
        for ($i = 1; $i <= 10; $i++) {
            $gender = $i % 2 == 0 ? 'Laki-laki' : 'Perempuan';
            $userId = null;
            
            // Link to existing murid users if available
            if ($i <= $muridUsers->count()) {
                $userId = $muridUsers[$i-1]->id;
            }
            
            Murid::create([
                'nis' => '987654321' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'nama' => 'Murid ' . ($i <= 5 ? $i : $i + 5), // Match names with existing users for first 5
                'jenis_kelamin' => $gender,
                'tanggal_lahir' => date('Y-m-d', strtotime('-' . (15 + $i) . ' years')),
                'alamat' => 'Jl. Pelajar No. ' . $i . ', Jakarta',
                'no_telepon' => '08198765' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'kelas' => $classes[$i % count($classes)],
                'user_id' => $userId,
                'record_flag' => 'active'
            ]);
        }
    }
}