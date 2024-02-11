<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use HasFactory;
    protected $table = 'produk';

    protected $guarded = [];
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
