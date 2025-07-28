<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pelanggan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'username',
        'nama_pelanggan',
        'nomor_kwh',
        'alamat',
        'id_tarif',
        'password',
        'email',
    ];

    protected $hidden = ['password'];

    public function penggunaans()
    {
        return $this->hasMany(Penggunaan::class, 'id_pelanggan');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }
}