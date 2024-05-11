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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('stand')->nullable();
            $table->string('kd_penjualan');
            $table->string('kasir')->nullable();
            $table->string('customer')->nullable();
            $table->string('total_harga');
            $table->string('tanggal_penjualan')->nullable();
            $table->string('cash')->nullable();
            $table->string('change')->nullable();
            $table->string('discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
