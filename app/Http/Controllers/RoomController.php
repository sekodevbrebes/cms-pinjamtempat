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

        $title = 'Delete Room!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('room.index', [
            'rooms' => $room
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Kirimkan array nilai enum ke view
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
     
        // Ambil semua data yang dikirim oleh user
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

        return redirect('rooms');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('room.show', [
            'room' => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $roomTypes = ['Popular', 'Recommended'];
        return view('room.edit', [
            'room' => $room,
            'roomTypes' => $roomTypes
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, $id)
    {
    $data = $request->all();

    // Find the room by ID
    $room = Room::findOrFail($id);

    // Check if new images are uploaded
    if ($request->hasFile('image')) {
        // Delete old images if they exist
        $oldImages = json_decode($room->image, true);
        if ($oldImages) {
            foreach ($oldImages as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        // Process new images
        $images = $request->file('image');
        $imagePaths = [];

        foreach ($images as $img) {
            // Store image in 'public/assets/image-room'
            $path = $img->store('assets/image-room', 'public');
            $imagePaths[] = $path;
        }

        // Store array of image paths in $data['images'] as JSON
        $data['image'] = json_encode($imagePaths);
    }

    // Update room data
    $room->update($data);

    return redirect('rooms')->with('success', 'Room Updated Successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        // first checking old file to delete from storage
        $get_item = $room['image'];

        $data = 'storage/' . $get_item;
        if (File::exists($data)) {
            File::delete($data);
        } else {
            File::delete('storage/app/public/' . $get_item);
        }

        $room->forceDelete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
