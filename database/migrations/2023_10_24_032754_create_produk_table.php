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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stand_id')->constrained('stand');
            $table->string('nama_produk');
            $table->string('harga_produk');
            $table->integer('stock');
            $table->foreignId('satuan_id')->constrained('satuan');
            $table->foreignId('jenis_barang_id')->constrained('jenis_barang');
            $table->string('barcode');
            $table->string('foto_produk');
            // Add other attributes as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
