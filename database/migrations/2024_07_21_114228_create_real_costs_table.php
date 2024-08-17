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
        Schema::create('real_costs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->uuid('uuid_customer');
            $table->string('tanggal');
            $table->string('nama_kapal');
            $table->string('alamat_pengirim');
            $table->string('alamat_tujuan');
            $table->json('jenis_muatan');
            $table->json('qty');
            $table->json('satuan');
            $table->json('harga');
            $table->string('no_invoice');
            $table->string('muat');
            $table->string('bongkar');
            $table->string('delevery');
            $table->string('terbayarkan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_costs');
    }
};
