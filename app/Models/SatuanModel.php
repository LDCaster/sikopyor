<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanModel extends Model
{
    use HasFactory;
    protected $table = 'satuan';

    protected $guarded = [];
    public function produk()
    {
        return $this->hasMany(ProdukModel::class, 'satuan_id');
    }
}
