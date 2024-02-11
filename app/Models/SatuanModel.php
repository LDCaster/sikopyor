<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanModel extends Model
{
    use HasFactory;
    protected $table = 'satuan';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($satuan) {
            // Set nilai satuan_id pada semua produk yang memiliki satuan ini menjadi null
            $satuan->produk()->update(['satuan_id' => null]);
        });
    }

    public function produk()
    {
        return $this->hasMany(ProdukModel::class, 'satuan_id');
    }
}
