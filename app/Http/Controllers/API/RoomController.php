<?php

namespace App\Http\Controllers\API;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan tipe ruangan dari query parameter
        $type = $request->query('type');
    
        // Mengambil data ruangan berdasarkan tipe, jika ada
        // Jika tidak ada tipe yang diberikan, mengambil semua data ruangan
        $rooms = $type ? Room::where('type', $type)->get() : Room::all();
        
        // Mendapatkan URL dasar untuk menyimpan gambar dari storage
        $baseUrl = URL::to('/storage');
    
        // Mengubah path gambar menjadi URL lengkap
        foreach ($rooms as $room) {
            // Mengubah string JSON dari path gambar menjadi koleksi
            $room->image = collect(json_decode($room->image))
                            // Mengubah setiap path gambar menjadi URL lengkap
                            ->map(fn($image) => $baseUrl . '/' . $image)
                            // Mengembalikan koleksi ke dalam bentuk JSON
                            ->toJson();
        }
    
        // Mengembalikan response dalam bentuk JSON dengan status code 200
        return response()->json([
            'success' => true, // Menandakan bahwa permintaan berhasil
            'message' => 'Rooms retrieved successfully.', // Pesan sukses
            'data' => $rooms // Data ruangan yang diambil
        ], 200);
    }
}
