<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarangModel extends Model
{
    use HasFactory;
    protected $table = 'jenis_barang';

    protected $guarded = [];
    public function users()

    {
        return $this->belongsTo(User::class, 'jenis_barang');
    }
    public function produk()
    {
        return $this->hasMany(ProdukModel::class, 'jenis_barang_id');
    }
}
