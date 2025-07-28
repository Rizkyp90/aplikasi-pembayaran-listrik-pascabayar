<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penggunaans')->insert([
            [
                'id_pelanggan' => 1, // Pelanggan Ani
                'bulan' => '01',
                'tahun' => '2025',
                'meter_awal' => 1500,
                'meter_akhir' => 1620,
            ],
            [
                'id_pelanggan' => 2, // Pelanggan Budi
                'bulan' => '01',
                'tahun' => '2025',
                'meter_awal' => 2000,
                'meter_akhir' => 2250,
            ]
        ]);
    }
}