<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name'           => 'Administrator',
                'email'          => 'admin@mail.com',
                'password'       => Hash::make('password',),
                'remember_token' => null,
                'instansi'       =>'DP3KB Kabupaten Brebes',
                'alamat'        =>'Aula Lantai 5 - KPT Jl. Proklamasi No. 77 Brebes',
                'telephone'     =>'081806663355',
                'roles'         =>'ADMIN',
                'created_at'     => '2024-06-16 00:00:00',
                'updated_at'     => '2024-06-16 00:00:00',
            ],
        ];

        User::insert($user);
    }
}
