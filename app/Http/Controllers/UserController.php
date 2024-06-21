<?php

namespace App\Http\Controllers;

// use library here
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;


use File;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return view('user.index', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();

        // $data['image'] = $request->file('image')->store('assets/images/', 'public');

        // upload process here
        $path = public_path('app/public/assets/image-user');
        if(!File::isDirectory($path)){
            $response = Storage::makeDirectory('public/assets/image-user');
        }

        // change file locations
        if(isset($data['image'])){
            $data['image'] = $request->file('image')->store(
                'assets/image-user', 'public'
            );
        }else{
            $data['image'] = "";
        }
    
        User::create($data);

        return redirect('users')->with('success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit',[
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
     
    // Chat GPT - Berikut adalah skrip yang telah diubah sehingga ketika input password tidak diisi, proses update tetap berjalan tanpa mengubah password yang sudah ada:
       // get all request from frontsite
       $data = $request->all();

         // upload process here
       // change format image
       if(isset($data['image'])){

            // first checking old photo to delete from storage
           $get_item = $user['image'];

           // change file locations
           $data['image'] = $request->file('image')->store(
               'assets/image-user', 'public'
           );

           // delete old image from storage
           $data_old = 'storage/'.$get_item;
           if (File::exists($data_old)) {
               File::delete($data_old);
           }else{
               File::delete('storage/app/public/'.$get_item);
           }

       }

         // Remove password from data if it's not filled
        if (empty($data['password'])) {
            unset($data['password']);
        }


       // update to database
       $user->update($data);

       alert()->success('Success Message', 'Successfully updated User');
       return redirect()->route('users.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // first checking old file to delete from storage
        $get_item = $user['image'];

        $data = 'storage/'.$get_item;
        if (File::exists($data)) {
            File::delete($data);
        }else{
            File::delete('storage/app/public/'.$get_item);
        }

        $user->forceDelete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
