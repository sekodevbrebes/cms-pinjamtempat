<?php

namespace App\Http\Controllers\API;

use GMP;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Fungsi untuk login pengguna
    public function login(Request $request)
{
    try {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 500);
        }

        $user = User::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
            throw new \Exception('Invalid Credentials');
        }

        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
    }
    }


    // public function login(Request $request)
    // {
    //     try {
    //         // Validasi input yang diterima dari permintaan
    //         $request->validate([
    //             'email' => 'required|email',
    //             'password' => 'required',
    //         ]);

    //         // Ambil hanya email dan password dari permintaan
    //         $credentials = $request->only('email', 'password');

    //         // Cek kredensial pengguna
    //         if (Auth::attempt($credentials)) {
    //             // Jika kredensial benar, ambil data pengguna dan buat token autentikasi
    //             $user = Auth::user();
    //             $token = $user->createToken('auth_token')->plainTextToken;

    //             // Kembalikan respons JSON dengan token dan data pengguna
    //             return response()->json([
    //                 'token_type' => 'Bearer',
    //                 'access_token' => $token,
    //                 'message' => 'Login berhasil',
    //                 'user' => $user
    //             ]);
    //         }

    //         // Jika kredensial salah, lemparkan pengecualian validasi
    //         throw ValidationException::withMessages([
    //             'email' => ['Kredensial yang diberikan tidak valid.'],
    //         ]);
    //     } catch (ValidationException $e) {
    //         // Kembalikan respons JSON dengan pesan kesalahan validasi
    //         return response()->json([
    //             'message' => 'Gagal login',
    //             'errors' => $error,
    //         ], 422);
    //     }
    // }

    // Fungsi untuk mendaftarkan pengguna baru
    public function register(Request $request)
    {
        try {
            // Validasi input yang diterima dari permintaan
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            // Buat pengguna baru dengan data yang telah diverifikasi
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $request->image,
                'instansi' => $request->instansi,
                'telephone' => $request->telephone,
                'alamat' => $request->alamat,
                'role' => 'USER', // Tetapkan role USER saat registrasi
            ]);

            // Buat token autentikasi untuk pengguna baru
            $token = $user->createToken('auth_token')->plainTextToken;

            // Kembalikan respons JSON dengan token dan data pengguna baru
            return response()->json([
                'token_type' => 'Bearer',
                'access_token' => $token,
                'message' => 'Registrasi berhasil',
                'user' => $user, // Mengembalikan user yang telah terdaftar, agar dapat diisi data lain sesuai kebutuhan
            ], 201);
        } catch (\Exception $e) {
            // Kembalikan respons JSON dengan pesan kesalahan
            return response()->json([
                'message' => 'Gagal registrasi',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    // Fungsi untuk logout pengguna
    public function logout(Request $request)
    {
        // Menghapus token autentikasi saat ini
        $request->user()->currentAccessToken()->delete();

        // Kembalikan respons JSON dengan pesan berhasil logout
        return response()->json([
            'message' => 'Logout berhasil',
        ]);
    }

    public function updateProfile(Request $request)
    {
        // Ambil pengguna yang sedang terautentikasi
        $user = Auth::user();

        // Validasi input update profil
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Ambil semua input dari request
        $data = $request->all();

        // Jika password diisi, hash password sebelum disimpan
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Update data pengguna
        $user->update($data);

        // Kembalikan respons JSON dengan pesan sukses dan data pengguna yang diperbarui
        return response()->json([
            'message' => 'Profil berhasil diperbarui',
            'user' => $user,
        ]);
    }

    public function fetch()
    {
        // Ambil pengguna yang sedang terautentikasi
        $user = Auth::user();

        // Kembalikan respons JSON dengan data pengguna
        return response()->json([
            'user' => $user,
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Jika ada file yang diunggah
        if ($request->file('image')) {

            $file = $request->file('image')->store('assets/image-user', 'public');

            //store your file into database
            $user = Auth::user();
            $user->image = $file;
            $user->update();

            // Kembalikan respons JSON dengan pesan sukses dan data pengguna yang diperbarui
            return response()->json(['message' => 'Foto profil berhasil diperbarui', 'image' => $file]);
        }
    }
    
    // public function updatePhoto(Request $request)
    // {
    //     // Ambil pengguna yang sedang terautentikasi
    //     $user = Auth::user();

    //     // Validasi input gambar
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk pastikan input adalah file gambar dengan tipe dan ukuran yang sesuai
    //     ]);

    //     // Jika ada file gambar yang diunggah
    //     if ($request->hasFile('image')) {
    //         // Simpan gambar ke direktori 'public/users'
    //         $user->image = $request->file('image')->store('assets/image-user', 'public');
    //         $user->update(); // Simpan nama file gambar ke database
    //     }

    //     // Kembalikan respons JSON dengan pesan sukses dan data pengguna yang diperbarui
    //     return response()->json([
    //         'message' => 'Foto profil berhasil diperbarui',
    //         'user' => $user,
    //     ]);
    // }
}