<?php

namespace App\Http\Controllers;

// use library here
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;
use App\Models\Room;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = Room::all();
        return view('room.index', [
            'rooms' => $room
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $data = $request->all();

        // upload process here
        // Proses upload gambar
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePaths = [];

        foreach ($image as $img) {
            // Simpan gambar ke dalam folder 'public/assets/image-room'
            $path = $img->store('assets/image-room', 'public');
            $imagePaths[] = $path;
        }

        // Simpan array path gambar ke dalam $data['images'] dalam format JSON
        $data['image'] = json_encode($imagePaths);
    }
    
        Room::create($data);

        return redirect('rooms')->with('success', 'Room Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
      
        
        return view('room.show',[
            'room' => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
