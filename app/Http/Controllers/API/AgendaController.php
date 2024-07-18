<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan status dari query string, default ke 'Pending' jika tidak ada
        $status = $request->query('status', 'Pending');

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
}
