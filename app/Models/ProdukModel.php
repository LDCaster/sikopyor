<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use HasFactory;
    protected $table = 'produk';

    // protected $guarded = [];

    // protected $fillable = ['stand_id', 'nama_produk', 'harga_produk', 'satuan_id', 'jenis_barang_id', 'barcode', 'foto_produk'];
    protected $fillable = ['stand_id', 'nama_produk', 'harga_produk', 'stock', 'satuan_id', 'jenis_barang_id', 'barcode', 'barcode_data', 'foto_produk'];

    public function stand()
    {
        return $this->belongsTo(StandModel::class, 'stand_id');
    }
    public function satuan()
    {
        return $this->belongsTo(SatuanModel::class, 'satuan_id');
    }
    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarangModel::class, 'jenis_barang_id');
    }
}
