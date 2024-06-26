<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;
    protected $table = 'supplier';

    protected $guarded = [];

    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarangModel::class, 'jenis_barang_id');
    }
}
