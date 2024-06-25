<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data Agenda yang memiliki status Pending, Approved, atau Cancelled
        $data = Agenda::whereIn('status', ['Pending', 'Approved', 'Cancelled'])
                      ->with(['room', 'user']) // Menggunakan eager loading untuk memuat relasi room dan user
                      ->get();
        
        // Menghitung jumlah record berdasarkan masing-masing status
        $pendingCount = Agenda::where('status', 'Pending')->count();
        $approvedCount = Agenda::where('status', 'Approved')->count();
        $cancelledCount = Agenda::where('status', 'Cancelled')->count();

        // Menghitung jumlah total record
        $totalCount = Agenda::whereIn('status', ['Pending', 'Approved', 'Cancelled'])->count();
        
        return view('agenda.index', [
            'agenda' => $data,
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'cancelledCount' => $cancelledCount,
            'totalCount' => $totalCount,
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
        //
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
        //
    }
}
