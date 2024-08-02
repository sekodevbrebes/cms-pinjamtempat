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
        // Validasi input request
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        // Periksa apakah email sudah terdaftar
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Email tidak terdaftar, silahkan daftar terlebih dahulu'
            ], 400);
        }

        // Periksa kredensial
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Password salah'
            ], 401);
        }

        // Tambahkan URL dasar pada image path
        $user->image = url('storage/' . $user->image);

        // Buat token
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);
    } catch (Exception $error) {
        return response()->json([
            'message' => 'Terjadi kesalahan',
            'error' => $error->getMessage(),
        ], 500);
    }
}



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
                'user' => $user,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani kesalahan validasi
            $errors = $e->errors();

            // Jika email sudah ada
            if (isset($errors['email'])) {
                return response()->json([
                    'message' => 'Gagal registrasi',
                    'error' => 'Email sudah tersedia.',
                ], 422);
            }

            // Untuk kesalahan validasi lainnya
            return response()->json([
                'message' => 'Gagal registrasi',
                'errors' => $errors,
            ], 422);
        } catch (\Exception $e) {
            // Tangani kesalahan umum
            return response()->json([
                'message' => 'Gagal registrasi',
                'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
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

        // Tambahkan base URL ke path gambar
        $user->image = url($user->image);

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

    // Metode untuk mendapatkan data pengguna berdasarkan ID
    public function show($id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Kembalikan data pengguna
        return response()->json([
            'user' => $user
        ], 200);
    }
}
