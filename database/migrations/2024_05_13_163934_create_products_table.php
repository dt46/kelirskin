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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->foreignUuid('id_admin');
            $table->string('fotoProduk');
            $table->string('nama_foto_original');
            $table->string('namaProduk');
            $table->integer('hargaProduk');
            $table->integer('stokProduk');
            $table->integer('beratProduk');
            $table->string('deskripsiProduk');
            $table->string('kategoriProduk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
