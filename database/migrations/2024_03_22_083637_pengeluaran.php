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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stand_id')->constrained('stand');
            $table->enum('jenis_pengeluaran', ['Belanja Barang', 'Gaji Karyawan']);
            $table->date('tanggal_pengeluaran');
            $table->string('deskripsi');
            $table->integer('jumlah');
            $table->timestamps();
            $table->foreignId('supplier_id')->nullable()->constrained('supplier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
