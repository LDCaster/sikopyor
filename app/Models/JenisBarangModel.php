<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarangModel extends Model
{
    use HasFactory;
    protected $table = 'jenis_barang';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($jenis_barang) {
            // Set nilai jenis_barang_id pada semua produk yang memiliki jenis_barang ini menjadi null
            $jenis_barang->produk()->update(['jenis_barang_id' => null]);
        });
    }

    public function produk()
    {
        return $this->hasMany(ProdukModel::class, 'jenis_barang_id');
    }
}
