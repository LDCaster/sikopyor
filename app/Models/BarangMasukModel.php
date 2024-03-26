<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukModel extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    // protected $guarded = [];
    protected $fillable = ['produk_id', 'jumlah', 'tanggal_masuk', 'created_at', 'updated_at'];

    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'produk_id');
    }
}
