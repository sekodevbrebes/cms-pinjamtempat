<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agenda = [
        [
            'tanggal' => '2024-07-01',
            'waktu_mulai' => '09:00:00',
            'waktu_selesai' => '10:00:00',
            'room_id' => 7, // Sesuaikan dengan ID yang ada di tabel rooms
            'user_id' => 2, // Sesuaikan dengan ID yang ada di tabel users
            'status' => 'Pending',
            'activities' => 'Rapat bulanan tim A',
            'reason' => '',
            'peserta' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'tanggal' => '2024-07-02',
            'waktu_mulai' => '11:00:00',
            'waktu_selesai' => '12:00:00',
            'room_id' => 5, // Sesuaikan dengan ID yang ada di tabel rooms
            'user_id' => 2, // Sesuaikan dengan ID yang ada di tabel users
            'status' => 'Accept',
            'activities' => 'Presentasi proyek X',
            'reason' => '',
            'peserta' => 75,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'tanggal' => '2024-07-03',
            'waktu_mulai' => '13:00:00',
            'waktu_selesai' => '14:00:00',
            'room_id' => 1, // Sesuaikan dengan ID yang ada di tabel rooms
            'user_id' => 3, // Sesuaikan dengan ID yang ada di tabel users
            'status' => 'Accept',
            'activities' => 'Workshop pengembangan diri',
            'reason' => '',
            'peserta' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'tanggal' => '2024-07-04',
            'waktu_mulai' => '15:00:00',
            'waktu_selesai' => '16:00:00',
            'room_id' => 3, // Sesuaikan dengan ID yang ada di tabel rooms
            'user_id' => 3, // Sesuaikan dengan ID yang ada di tabel users
            'status' => 'Accept',
            'activities' => 'Training keamanan kerja',
            'reason' => '',
            'peserta' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'tanggal' => '2024-07-05',
            'waktu_mulai' => '17:00:00',
            'waktu_selesai' => '18:00:00',
            'room_id' => 2, // Sesuaikan dengan ID yang ada di tabel rooms
            'user_id' => 3, // Sesuaikan dengan ID yang ada di tabel users
            'status' => 'Pending',
            'activities' => 'Rapat evaluasi bulanan',
            'reason' => '',
            'peserta' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ];
      // this array $specialist will be insert to table 'rooms'
      Agenda::insert($agenda);
   }
}
