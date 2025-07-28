<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

   /**
     * The primary key associated with the table.
     *
     * Pengecualian: Menggunakan 'id_tagihan' ketimbang 'id' standar Laravel
     * untuk meningkatkan kejelasan saat query manual atau integrasi.
     *
     * @var string
     */
    protected $primaryKey = 'id_tagihan';
    protected $fillable = [
        'id_penggunaan',
        'jumlah_meter',
        'total_bayar',
        'status',
        'metode_pembayaran',
        'bukti_pembayaran',
    ];

    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan');
    }
}