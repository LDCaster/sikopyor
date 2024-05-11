<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'role' => 'admin',
            'nama' => 'Admin',
            'no_telp' => '08123456789',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jalan Contoh No. 123',
            'img' => 'admin.jpg',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role' => 'karyawan',
            'nama' => 'Karyawan A',
            'no_telp' => '08123456789',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jalan Contoh No. 456',
            'img' => 'karyawan.jpg',
            'email' => 'karyawan1@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'role' => 'karyawan',
            'nama' => 'Karyawan B',
            'no_telp' => '08123456789',
            'jenis_kelamin' => 'Laki-Laki',
            'alamat' => 'Jalan Contoh No. 456',
            'img' => 'karyawan.jpg',
            'email' => 'karyawan2@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
