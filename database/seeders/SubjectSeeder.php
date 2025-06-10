<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'Matematika',
                'code' => 'MTK',
                'description' => 'Mata pelajaran yang mempelajari tentang angka, perhitungan, dan logika.'
            ],
            [
                'name' => 'Bahasa Indonesia',
                'code' => 'BIN',
                'description' => 'Mata pelajaran yang mempelajari tentang bahasa dan sastra Indonesia.'
            ],
            [
                'name' => 'Bahasa Inggris',
                'code' => 'BIG',
                'description' => 'Mata pelajaran yang mempelajari tentang bahasa Inggris.'
            ],
            [
                'name' => 'IPA',
                'code' => 'IPA',
                'description' => 'Mata pelajaran yang mempelajari tentang ilmu pengetahuan alam.'
            ],
            [
                'name' => 'IPS',
                'code' => 'IPS',
                'description' => 'Mata pelajaran yang mempelajari tentang ilmu pengetahuan sosial.'
            ],
            [
                'name' => 'Pendidikan Agama',
                'code' => 'PAI',
                'description' => 'Mata pelajaran yang mempelajari tentang agama dan nilai-nilai keagamaan.'
            ],
            [
                'name' => 'PPKN',
                'code' => 'PKN',
                'description' => 'Mata pelajaran yang mempelajari tentang pendidikan kewarganegaraan.'
            ],
            [
                'name' => 'Seni Budaya',
                'code' => 'SBD',
                'description' => 'Mata pelajaran yang mempelajari tentang seni dan budaya.'
            ],
            [
                'name' => 'Penjaskes',
                'code' => 'PJK',
                'description' => 'Mata pelajaran yang mempelajari tentang pendidikan jasmani dan kesehatan.'
            ],
            [
                'name' => 'Informatika',
                'code' => 'INF',
                'description' => 'Mata pelajaran yang mempelajari tentang teknologi informasi dan komputer.'
            ]
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                'name' => $subject['name'],
                'code' => $subject['code'],
                'description' => $subject['description'],
                'status' => 'active'
            ]);
        }
    }
}