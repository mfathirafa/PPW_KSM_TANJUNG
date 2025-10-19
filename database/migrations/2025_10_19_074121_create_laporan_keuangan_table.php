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
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id('Laporan_id');
            $table->unsignedBigInteger('User_id');

            $table->date('Tanggal_laporan');
            $table->integer('Total_pemasukan');
            $table->integer('Total_pengeluaran');

            $table->foreign('User_id')->references('User_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};
