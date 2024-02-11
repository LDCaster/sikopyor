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
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stand_id')->constrained('stand');
            $table->string('nama_barang');
            $table->string('keterangan');
            $table->integer('jumlah');
            $table->foreignId('satuan_id')->constrained('satuan');
            // Add other attributes as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
