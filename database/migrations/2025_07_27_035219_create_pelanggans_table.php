<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nomor_kwh')->unique();
            $table->string('nama_pelanggan');
            $table->text('alamat');
            $table->foreignId('id_tarif')->constrained('tarifs', 'id_tarif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};