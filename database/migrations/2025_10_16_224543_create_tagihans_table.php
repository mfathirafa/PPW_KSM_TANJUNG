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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id('ID_Tagihan');
            $table->unsignedBigInteger('ID_Pelanggan');
            
            $table->date('Tanggal');
            $table->integer('Jumlah');
            $table->string('Status', 20);

            $table->foreign('ID_Pelanggan')->references('ID_Pelanggan')->on('pelanggans')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
