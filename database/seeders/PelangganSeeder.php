<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggans')->insert([
            [
                'username' => 'ani123',
                'password' => Hash::make('password'), // Password di-hash untuk keamanan
                'nomor_kwh' => '12345678901',
                'nama_pelanggan' => 'Ani Yudhoyono',
                'alamat' => 'Jl. Merdeka No. 10',
                'id_tarif' => 1, // ID untuk 900 VA
            ],
            [
                'username' => 'budi_gg',
                'password' => Hash::make('password'),
                'nomor_kwh' => '09876543211',
                'nama_pelanggan' => 'Budi Gunawan',
                'alamat' => 'Jl. Sudirman No. 25',
                'id_tarif' => 2, // ID untuk 1300 VA
            ]
        ]);
    }
}