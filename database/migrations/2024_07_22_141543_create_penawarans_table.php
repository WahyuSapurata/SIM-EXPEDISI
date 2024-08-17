<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penawarans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nama_costumer');
            $table->string('alamat');
            $table->string('no_surat');
            $table->string('perihal');
            $table->string('jenis_barang');
            $table->string('jumlah');
            $table->string('kondisi');
            $table->string('lokasi_muat');
            $table->string('lokasi_tujuan');
            $table->string('harga');
            $table->string('pembayaran');
            $table->string('lokasi');
            $table->string('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawarans');
    }
};
