<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stand')->insert([
            [
                'user_id' => 2, // Sesuaikan dengan ID user yang akan memiliki stand
                'nama_stand' => 'Stand A',
                'alamat' => 'Alamat Stand A',
            ],
            [
                'user_id' => 3, // Sesuaikan dengan ID user yang akan memiliki stand
                'nama_stand' => 'Stand B',
                'alamat' => 'Alamat Stand B',
            ],
            // Tambahkan data stand lainnya sesuai kebutuhan
        ]);
    }
}
