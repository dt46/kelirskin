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
        Schema::create('resellers', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->foreignUuid('user_id')->unique();
            $table->string('no_hp');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('alamat_detail');
            // $table->decimal('latitude', 10, 8);
            // $table->decimal('longitude', 11, 8);
            $table->string('foto_ktp');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resellers');
    }
};
