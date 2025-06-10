<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = ['A', 'B', 'C'];
        $floors = ['1', '2', '3'];

        for ($i = 1; $i <= 10; $i++) {
            $building = $buildings[$i % count($buildings)];
            $floor = $floors[$i % count($floors)];
            $roomNumber = str_pad($i, 2, '0', STR_PAD_LEFT);

            Room::create([
                'name' => "Ruang $building-$floor$roomNumber",
                'code' => "$building$floor$roomNumber",
                'capacity' => 30 + ($i % 10),
                'building' => "Gedung $building",
                'floor' => "Lantai $floor",
                'description' => "Ruang kelas di Gedung $building Lantai $floor",
                'status' => 'active'
            ]);
        }
    }
}