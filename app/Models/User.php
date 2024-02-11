<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'nama',
        'no_telp',
        'jenis_kelamin',
        'alamat',
        'img',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }
    public function scopeKaryawan($query)
    {
        return $query->join('role', 'users.role_id', '=', 'role.id')
            ->where('role.nama_role', 'karyawan')
            ->select('users.*');
    }
    public function stands()
    {
        return $this->hasMany(StandModel::class, 'user_id');
    }
}
