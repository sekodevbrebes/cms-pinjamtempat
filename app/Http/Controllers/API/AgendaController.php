<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Agenda;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan status dari query string, default ke 'Accept' jika tidak ada
        $status = $request->query('status', 'Accept');

        // Validasi status yang diperbolehkan
        $allowedStatuses = ['Pending', 'Accept', 'Decline', 'Cancelled'];
        if (!in_array($status, $allowedStatuses)) {
            return response()->json([
                'message' => 'Status tidak valid.',
            ], 400);
        }

        // Mengambil data agenda berdasarkan status dengan eager loading relasi room dan user
        $agendas = Agenda::with(['room', 'user'])
            ->where('status', $status)
            ->get();


        // Mengembalikan data agenda dalam bentuk JSON dengan
        return response()->json([
            'status' => 'success',
            'message' => 'Data agenda berhasil diambil.',
            'data' => $agendas
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input dari permintaan
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date', // Tanggal agenda harus ada dan dalam format tanggal yang valid
            'waktu_mulai' => 'required|date_format:H:i:s', // Waktu mulai harus ada dan dalam format jam yang valid
            'waktu_selesai' => 'required|date_format:H:i:s|after:waktu_mulai', // Waktu selesai harus ada, dalam format jam yang valid, dan harus setelah waktu mulai
            'room_id' => 'required|integer|exists:rooms,id', // ID ruangan harus ada, harus berupa integer, dan harus ada di tabel rooms
            'user_id' => 'required|integer|exists:users,id', // ID pengguna harus ada, harus berupa integer, dan harus ada di tabel users
            'activities' => 'required|string', // Aktivitas harus ada dan berupa string
            'peserta' => 'required|integer', // Jumlah peserta harus ada dan harus berupa integer
        ]);

        // Tangani kesalahan validasi
        if ($validator->fails()) {
            // Mengembalikan pesan kesalahan jika validasi gagal
            return response()->json([
                'status' => 'error',
                'message' => 'Data yang dimasukkan tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Periksa apakah sudah ada agenda dengan waktu yang sama atau irisan waktu di ruangan yang sama pada tanggal yang sama
        $existingAgenda = Agenda::where('room_id', $request->room_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {
                // Memeriksa apakah ada waktu yang tumpang tindih
                $query->where(function ($query) use ($request) {
                    $query->where('waktu_mulai', '<', $request->waktu_selesai)
                        ->where('waktu_selesai', '>', $request->waktu_mulai);
                });
            })
            ->exists();

        if ($existingAgenda) {
            // Mengembalikan pesan kesalahan jika sudah ada agenda dengan waktu yang sama atau tumpang tindih
            return response()->json([
                'status' => 'error',
                'message' => 'Agenda dengan waktu yang sama atau irisan waktu sudah ada di ruangan yang sama pada tanggal ini.',
            ], 400);
        }

        // Simpan agenda baru ke database
        $agenda = Agenda::create([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'activities' => $request->activities,
            'peserta' => $request->peserta,
            'status' => 'Pending', // Menetapkan nilai default 'Pending'
        ]);

        // Mengembalikan respons sukses dengan data agenda yang baru disimpan
        return response()->json([
            'status' => 'success',
            'message' => 'Data agenda berhasil disimpan.',
            'data' => $agenda, // Data agenda yang baru disimpan
        ], 201);
    }
}
