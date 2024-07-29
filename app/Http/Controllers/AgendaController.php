<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        // Mendapatkan waktu saat ini
        $currentDate = Carbon::now();

        // Ambil data Agenda yang memiliki status Pending, Approved, atau Cancelled dan urutkan berdasarkan id
        $data = Agenda::whereIn('status', ['Pending', 'Accept', 'Cancelled', 'Decline'])
            ->with(['room', 'user']) // Menggunakan eager loading untuk memuat relasi room dan user
            ->orderBy('id', 'desc')
            ->get();

        // Ambil data berdasarkan tanggal yang sudah lewat dan urutkan berdasarkan id
        $dataPast = Agenda::whereIn('status', ['Pending', 'Accept', 'Cancelled', 'Decline'])
            ->where('tanggal', '<', $currentDate)
            ->with(['room', 'user'])
            ->orderBy('id', 'desc')
            ->get();

        // Ambil data berdasarkan tanggal yang belum lewat dan urutkan berdasarkan id
        $dataFuture = Agenda::whereIn('status', ['Pending', 'Accept', 'Cancelled', 'Decline'])
            ->where('tanggal', '>=', $currentDate)
            ->with(['room', 'user'])
            ->orderBy('id', 'desc')
            ->get();

        // Menghitung jumlah record berdasarkan masing-masing status
        $pendingCount = Agenda::where('status', 'Pending')->count();
        $approvedCount = Agenda::where('status', 'Accept')->count();
        $cancelledCount = Agenda::where('status', 'Cancelled')->count();

        // Menghitung jumlah total record
        $totalCount = Agenda::whereIn('status', ['Pending', 'Accept', 'Cancelled', 'Decline'])->count();

        // Menghitung jumlah record berdasarkan status approved dan tanggal yang telah lewat
        $approvedPastCount = Agenda::where('status', 'Accept')
            ->where('tanggal', '<', $currentDate)
            ->count();

        // Menghitung jumlah record berdasarkan status Accept dan tanggal yang belum lewat
        $approvedFutureCount = Agenda::where('status', 'Accept')
            ->where('tanggal', '>=', $currentDate)
            ->count();

        // Menghitung jumlah record berdasarkan status decline
        $declineCount = Agenda::where('status', 'Decline')
            ->where('tanggal', '>=', $currentDate)
            ->count();

        $title = 'Delete Agenda!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('agenda.index', [
            'agenda' => $data,
            'dataPast' => $dataPast,
            'dataFuture' => $dataFuture,
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'cancelledCount' => $cancelledCount,
            'totalCount' => $totalCount,
            'approvedPastCount' => $approvedPastCount,
            'approvedFutureCount' => $approvedFutureCount,
            'declineCount' => $declineCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgendaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        return view('agenda.show', [
            'agenda' => $agenda
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendaRequest $request, Agenda $agenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda deleted successfully.');
    }

    public function changeStatus(Request $request, $id, $status)
    {
        // Temukan agenda berdasarkan ID
        $agenda = Agenda::findOrFail($id);

        // Perbarui status agenda
        $agenda->status = $status;
        $agenda->save();

        // Periksa status dan arahkan ke rute yang sesuai
        if ($status === 'Decline' || $status === 'Cancelled') {
            // Jika status 'Decline' atau 'Cancelled', arahkan ke rute 'agenda.show'
            return redirect()->route('agenda.show', $id);
        } else {
            // Untuk status lainnya, arahkan ke rute 'agenda.index'
            return redirect()->route('agenda.index');
        }
    }

    public function updateReason(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->reason = $request->input('reason');
        $agenda->save();

        return redirect()->route('agenda.show', $id)->with('success', 'Reason for rejection updated successfully.');
    }
}
