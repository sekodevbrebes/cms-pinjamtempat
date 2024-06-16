<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create name room seeds
        $rooms = [
            [
                'name' => 'Aula Utama',
                'location' => 'Lantai 5 - KPT Jl. Proklamasi 77 Brebes',
                'capacity' => '500',
                'facility' => 'Kursi Rapat, Meja Rapat Pimpinan, VideoWall 100 inci, Sound System',
                'image' => 'https://dbijapkm3o6fj.cloudfront.net/resources/4628,1004,1,6,4,0,600,450/-4608-/20230504201249/ruang-pertemuan.jpeg',
                'rate' => '4',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

         // this array $specialist will be insert to table 'rooms'
         Room::insert($rooms);
    }
}
