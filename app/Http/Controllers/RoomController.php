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

        return redirect('rooms');
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
        return view('room.edit',[
            'room' => $room
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
{
    $data = $request->all();

    // Check if an image is uploaded
    if ($request->hasFile('image')) {
        // First, get the old image to delete it from storage
        $oldImage = $room->image;

        // Store the new image in the desired location
        $data['image'] = $request->file('image')->store(
            'assets/image-room', 'public'
        );

        // Delete the old image from storage if it exists
        $oldImagePath = 'storage/' . $oldImage;
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        } else {
            File::delete('storage/app/public/' . $oldImage);
        }
    } else {
        // If no new image is uploaded, retain the old image data
        unset($data['image']);
    }

    // Update the room with the modified data
    $room->update($data);

    // Return a response or redirect as needed
    return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
          // first checking old file to delete from storage
          $get_item = $room['image'];

          $data = 'storage/'.$get_item;
          if (File::exists($data)) {
              File::delete($data);
          }else{
              File::delete('storage/app/public/'.$get_item);
          }
  
          $room->forceDelete();
  
          return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
