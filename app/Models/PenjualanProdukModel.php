<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanProdukModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan_produk';

    // protected $guarded = [];
    protected $fillable = ['penjualan_id', 'produk_id', 'jumlah'];
}
