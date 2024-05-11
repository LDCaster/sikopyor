<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    // protected $guarded = [];
    protected $fillable = ['stand', 'tanggal_penjualan', 'kd_penjualan', 'kasir', 'customer', 'total_harga', 'cash', 'change', 'discount'];
}
