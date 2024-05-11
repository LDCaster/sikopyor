<?php

namespace Database\Seeders;

use App\Models\ProdukModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'stand_id' => 1,
                'nama_produk' => 'Es Kopyor',
                'harga_produk' => '8000',
                'stock' => 0,
                'satuan_id' => 1,
                'jenis_barang_id' => 2,
                'barcode' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPYAAAAeAQMAAAAly3FkAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADNJREFUKJFj+MzD/PnzeWZ7A3ub88zM9vbnbWxsPnz48PnwYWZ+5s82DKPyo/Kj8oNWHgCiZKTikE9fKgAAAABJRU5ErkJggg==',
                'barcode_data' => 'PROD000001',
                'foto_produk' => 'es_kopyor.jpg',
            ],
            [
                'stand_id' => 2,
                'nama_produk' => 'Es Kopyor',
                'harga_produk' => '8000',
                'stock' => 0,
                'satuan_id' => 1,
                'jenis_barang_id' => 2,
                'barcode' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPYAAAAeAQMAAAAly3FkAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADFJREFUKJFj+MzD/PnzeWZ7A3ub88zM9vbnbWxsPgDB58MfzjN/tmEYlR+VH5UftPIAX4zcbtQ3qSUAAAAASUVORK5CYII=',
                'barcode_data' => 'PROD000002',
                'foto_produk' => 'es_kopyor.jpg',
            ],
            // Tambahkan data produk lainnya sesuai kebutuhan
        ];

        foreach ($data as $produk) {
            ProdukModel::create($produk);
        }
    }
}
