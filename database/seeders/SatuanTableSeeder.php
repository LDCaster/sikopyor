<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('satuan')->insert([
            ['nama_satuan' => 'Pcs'],
            ['nama_satuan' => 'Kg'],
            ['nama_satuan' => 'Meter'],
            ['nama_satuan' => 'Liter'],
            ['nama_satuan' => 'Pack'],
            ['nama_satuan' => 'Botol'],
            ['nama_satuan' => 'Dus'],
            ['nama_satuan' => 'Roll'],
            ['nama_satuan' => 'Lembar'],
            ['nama_satuan' => 'Buah'],
            ['nama_satuan' => 'Kardus']
            // Tambahkan satuan lainnya sesuai kebutuhan
        ]);
    }
}
