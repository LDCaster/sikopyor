<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandModel extends Model
{
    use HasFactory;
    protected $table = 'stand';

    protected $guarded = [];
    public function users()
    {
        return $this->belongsTo(UsersModel::class, 'user_id');
    }
}
