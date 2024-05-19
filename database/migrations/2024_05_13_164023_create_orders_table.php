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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->foreignUuid('id_cart')->unique();
            $table->string('metode_pembayaran');
            $table->integer('biaya_layananAplikasi');
            $table->integer('ongkos_kirim');
            $table->string('bukti_pembayaran');
            $table->string('nama_file_original');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
