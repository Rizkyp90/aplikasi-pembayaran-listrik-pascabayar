<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->foreignId('id_penggunaan')->constrained('penggunaans', 'id_penggunaan')->onDelete('cascade');
            $table->float('jumlah_meter');
            $table->decimal('total_bayar', 10, 2);
            $table->string('status')->default('Belum Bayar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};