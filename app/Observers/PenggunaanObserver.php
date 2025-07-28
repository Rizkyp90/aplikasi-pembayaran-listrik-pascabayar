<?php

namespace App\Observers;

use App\Models\Penggunaan;
use App\Models\Tagihan;

class PenggunaanObserver
{
    public function created(Penggunaan $penggunaan): void
    {
        // Pastikan relasi tidak null sebelum diakses
        if ($penggunaan->pelanggan && $penggunaan->pelanggan->tarif) {
            $tarif_per_kwh = $penggunaan->pelanggan->tarif->tarif_per_kwh;
            $jumlah_meter = $penggunaan->meter_akhir - $penggunaan->meter_awal;
            $total_bayar = $jumlah_meter * $tarif_per_kwh;

            Tagihan::create([
                'id_penggunaan' => $penggunaan->id_penggunaan,
                'jumlah_meter' => $jumlah_meter,
                'total_bayar' => $total_bayar,
                'status' => 'Belum Lunas', // Pastikan ada nilai default jika perlu
            ]);
        }
    }
} 