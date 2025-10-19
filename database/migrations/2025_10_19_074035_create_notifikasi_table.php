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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('Notifikasi_id');
            $table->unsignedBigInteger('User_id');
            
            $table->string('Isi_pesan', 255);
            $table->date('Tanggal_kirim');
            $table->string('Tipe', 50);
            $table->string('Status_baca', 10);

            $table->foreign('User_id')->references('User_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
