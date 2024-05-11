<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_barang')->insert([
            ['nama_jenis' => 'Makanan'],
            ['nama_jenis' => 'Minuman'],
            ['nama_jenis' => 'Peralatan'],
            // Tambahkan jenis barang lainnya sesuai kebutuhan
        ]);
    }
}
