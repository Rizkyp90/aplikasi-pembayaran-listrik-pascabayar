<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Tarif;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenggunaanTagihanTest extends TestCase
{
    use RefreshDatabase; 

    /** @test */
    public function tagihan_otomatis_terbuat_saat_penggunaan_dibuat()
    {
        // 1. Arrange (Persiapan Data Uji)
        $tarif = Tarif::create(['daya' => 'Test', 'tarif_per_kwh' => 1500]);
        $pelanggan = Pelanggan::factory()->create(['id_tarif' => $tarif->id_tarif]);

        // 2. Act (Laksanakan Aksi)
        $penggunaan = Penggunaan::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'bulan' => '01',
            'tahun' => '2025',
            'meter_awal' => 100,
            'meter_akhir' => 120,
        ]);

        // 3. Assert (Verifikasi Hasil)
        $this->assertDatabaseHas('tagihans', [
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'total_bayar' => 30000, // (120 - 100) * 1500
            'status' => 'Belum Lunas'
        ]);
    }
}