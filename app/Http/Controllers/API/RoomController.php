<?php

namespace App\Http\Controllers\API;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index()
    {
    // Mengambil semua data ruangan dari model Room
        $rooms = Room::all();

        // Mengembalikan response dalam bentuk JSON dengan status code 200
        return response()->json([
            'success' => true,
            'message' => 'Rooms retrieved successfully.',
            'data' => $rooms
        ], 200);
    }
}
