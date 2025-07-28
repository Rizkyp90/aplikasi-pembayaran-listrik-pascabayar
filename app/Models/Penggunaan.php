<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tagihan;

class Penggunaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penggunaan';

    protected $fillable = [
        'id_pelanggan',
        'bulan',
        'tahun',
        'meter_awal',
        'meter_akhir',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    /**
     * The "booted" method of the model.
     * Kode di sini akan berjalan setiap kali model ini digunakan.
     */
    protected static function booted(): void
    {
        // Event "created" akan berjalan setelah record baru berhasil dibuat
        static::created(function (Penggunaan $penggunaan) {
            if ($penggunaan->pelanggan && $penggunaan->pelanggan->tarif) {
                $tarif_per_kwh = $penggunaan->pelanggan->tarif->tarif_per_kwh;
                $jumlah_meter = $penggunaan->meter_akhir - $penggunaan->meter_awal;
                $total_bayar = $jumlah_meter * $tarif_per_kwh;

                Tagihan::create([
                    'id_penggunaan' => $penggunaan->id_penggunaan,
                    'jumlah_meter' => $jumlah_meter,
                    'total_bayar' => $total_bayar,
                    'status' => 'Belum Lunas',
                ]);
            }
        });
    }

}