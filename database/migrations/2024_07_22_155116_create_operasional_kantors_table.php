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
        Schema::create('operasional_kantors', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('kategori');
            $table->string('tanggal');
            $table->string('item');
            $table->string('qty')->nullable();
            $table->string('satuan')->nullable();
            $table->string('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operasional_kantors');
    }
};
