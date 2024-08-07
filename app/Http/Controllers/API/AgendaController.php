<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Agenda;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan status dan all_users dari query string, default ke null jika tidak ada
        $statuses = $request->query('status'); // Ini bisa berupa string atau array
        $allUsers = $request->query('all_users', 'false');

        // Validasi status yang diperbolehkan
        $allowedStatuses = ['Pending', 'Accept', 'Decline', 'Cancelled'];

        // Jika status ada, pastikan bahwa semua status yang diberikan valid
        if ($statuses) {
            // Jika status berupa string, ubah menjadi array
            $statuses = is_array($statuses) ? $statuses : explode(',', $statuses);

            foreach ($statuses as $status) {
                if (!in_array($status, $allowedStatuses)) {
                    return response()->json([
                        'message' => 'Status tidak valid.',
                    ], 400);
                }
            }
        }

        // Membuat query dasar untuk mendapatkan agenda
        $query = Agenda::with(['room', 'user']);

        // Jika status ada, tambahkan kondisi untuk memfilter berdasarkan status
        if ($statuses) {
            $query->whereIn('status', $statuses);
        }

        // Jika all_users tidak ada atau nilainya false, filter berdasarkan pengguna yang sedang login
        if ($allUsers === 'false') {
            // Mendapatkan pengguna yang sedang login
            $user = auth()->user();

            // Jika pengguna tidak ditemukan (misalnya, belum login), kembalikan error
            if (!$user) {
                return response()->json([
                    'message' => 'Pengguna tidak ditemukan.',
                ], 401);
            }

            // Filter agenda berdasarkan pengguna yang sedang login
            $query->where('user_id', $user->id);
        }

        // Mengambil data agenda
        $agendas = $query->get();

        // Mendapatkan URL dasar untuk menyimpan gambar dari storage
        $baseUrl = URL::to('/storage');

        // Mengubah path gambar menjadi URL lengkap
        foreach ($agendas as $agenda) {
            // Misalkan agenda memiliki atribut gambar (misalnya, room_image atau user_image)
            if ($agenda->room && $agenda->room->image) {
                $agenda->room->image = collect(json_decode($agenda->room->image))
                    ->map(function ($image) use ($baseUrl) {
                        // Hanya tambahkan $baseUrl jika $image tidak sudah termasuk baseUrl
                        return str_starts_with($image, $baseUrl) ? $image : $baseUrl . '/' . $image;
                    })
                    ->toJson();
            }
            if ($agenda->user && $agenda->user->profile_image) {
                $agenda->user->profile_image = $baseUrl . '/' . $agenda->user->profile_image;
            }
        }

        // Mengembalikan data agenda dalam bentuk JSON dengan status code 200
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
                })
                    // Mengecualikan agenda dengan status 'Cancelled' dan 'Decline'
                    ->whereNotIn('status', ['Cancelled', 'Decline']);
            })
            ->exists();

        if ($existingAgenda) {
            // Mengembalikan pesan kesalahan jika sudah ada agenda dengan waktu yang sama atau tumpang tindih
            return response()->json([
                'status' => 'error',
                'message' => 'Cek apakah ada waktu/jam yang sama?',
            ], 400);
        }

        // Ambil ID pengguna yang sedang login
        $userId = auth()->id();

        // Simpan agenda baru ke database
        $agenda = Agenda::create([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'room_id' => $request->room_id,
            'user_id' => $userId, // Menyimpan ID pengguna yang sedang login
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


    public function changeStatus(Request $request, $id)
    {
        // Validasi permintaan
        $request->validate([
            'status' => 'required|string',
        ]);

        try {
            // Temukan agenda berdasarkan ID
            $agenda = Agenda::findOrFail($id);

            // Perbarui status agenda
            $agenda->status = $request->status;
            $agenda->save();

            // Kembalikan respons JSON sukses
            return response()->json([
                'success' => true,
                'message' => 'Agenda status updated successfully',
                'data' => $agenda
            ], 200);
        } catch (\Exception $e) {
            // Tangani kesalahan dan kembalikan respons JSON yang sesuai
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateReason(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->update($request->validate(['reason' => 'nullable|string|max:255']));

        return response()->json([
            'status' => 'success',
            'message' => 'Reason updated successfully.',
            'data' => $agenda,
        ]);
    }
}
