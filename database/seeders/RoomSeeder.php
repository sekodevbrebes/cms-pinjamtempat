<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array path gambar lokal yang akan disimpan sebagai JSON
        $images = json_encode([
            "assets/image-room/bLAwIA1EQXmIOz6JNAF1SpfmWGY8jQv6JN2W1nUr.png",
            "assets/image-room/OArV36ZAhmDfJVYx83rteCkroR4Czr6ddVGKdT2G.png",
            "assets/image-room/mj0ZOlGI6iWo6GdRzn9Ncjh2tew1rTPNfmUWihsG.png",
            "assets/image-room/uNQ6cpHiqbHBC3kc5FqmgVjTSC3t57q7UDiOD6gk.png"
        ]);

        // Contoh data rooms
        $rooms = [
            [
                'name' => 'Conference Room A',
                'location' => 'Building 1, Floor 3',
                'capacity' => 50,
                'facility' => 'Projector, Whiteboard, Wi-Fi',
                'image' => $images,
                'rate' => 150.0,
            ],
            [
                'name' => 'Meeting Room B',
                'location' => 'Building 2, Floor 1',
                'capacity' => 20,
                'facility' => 'TV, Conference Call, Wi-Fi',
                'image' => $images,
                'rate' => 100.0,
            ],
            [
                'name' => 'Workshop Room C',
                'location' => 'Building 1, Floor 2',
                'capacity' => 100,
                'facility' => 'Stage, Microphone, Speakers, Wi-Fi',
                'image' => $images,
                'rate' => 250.0,
            ],
            [
                'name' => 'Conference Room D',
                'location' => 'Building 3, Floor 1',
                'capacity' => 30,
                'facility' => 'Projector, Whiteboard, Wi-Fi',
                'image' => $images,
                'rate' => 120.0,
            ],
            [
                'name' => 'Meeting Room E',
                'location' => 'Building 3, Floor 2',
                'capacity' => 25,
                'facility' => 'TV, Conference Call, Wi-Fi',
                'image' => $images,
                'rate' => 90.0,
            ],
            [
                'name' => 'Workshop Room F',
                'location' => 'Building 2, Floor 3',
                'capacity' => 80,
                'facility' => 'Stage, Microphone, Speakers, Wi-Fi',
                'image' => $images,
                'rate' => 220.0,
            ],
            [
                'name' => 'Conference Room G',
                'location' => 'Building 4, Floor 1',
                'capacity' => 40,
                'facility' => 'Projector, Whiteboard, Wi-Fi',
                'image' => $images,
                'rate' => 130.0,
            ],
            [
                'name' => 'Meeting Room H',
                'location' => 'Building 4, Floor 2',
                'capacity' => 15,
                'facility' => 'TV, Conference Call, Wi-Fi',
                'image' => $images,
                'rate' => 70.0,
            ],
        ];

         // this array $specialist will be insert to table 'rooms'
         Room::insert($rooms);
    }
}
