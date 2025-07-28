<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tarifs')->insert([
            ['daya' => '900 VA', 'tarif_per_kwh' => 1352.00],
            ['daya' => '1300 VA', 'tarif_per_kwh' => 1444.70],
        ]);
    }
}