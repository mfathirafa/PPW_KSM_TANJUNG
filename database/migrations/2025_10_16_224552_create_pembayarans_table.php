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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('ID_Pembayaran');
            $table->unsignedBigInteger('ID_Tagihan');
            $table->unsignedBigInteger('ID_Admin');

            $table->date('Tanggal');
            $table->integer('Jumlah_Bayar');
            $table->string('Metode', 20);

            $table->foreign('ID_Tagihan')->references('ID_Tagihan')->on('tagihans')->onDelete('cascade');
            $table->foreign('ID_Admin')->references('ID_Admin')->on('admins')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
