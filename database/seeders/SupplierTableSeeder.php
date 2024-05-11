<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('supplier')->insert([
            [
                'nama_toko' => 'Supplier A',
                'alamat' => 'Alamat Supplier A',
                'no_telp' => '08123456789',
                'jenis_barang_id' => 1, // Sesuaikan dengan ID jenis barang yang disediakan oleh supplier
            ],
            [
                'nama_toko' => 'Supplier B',
                'alamat' => 'Alamat Supplier B',
                'no_telp' => '08234567890',
                'jenis_barang_id' => 2, // Sesuaikan dengan ID jenis barang yang disediakan oleh supplier
            ],
            // Tambahkan data supplier lainnya sesuai kebutuhan
        ]);
    }
}
