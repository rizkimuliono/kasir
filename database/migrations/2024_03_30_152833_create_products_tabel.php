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
            $table->id();
            $table->string('pro_nama');
            $table->string('pro_deskripsi');
            $table->integer('pro_stok');
            $table->integer('pro_harga_beli');
            $table->integer('pro_harga_jual');
            $table->integer('pro_categori_id');
            $table->string('pro_gambar');
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
