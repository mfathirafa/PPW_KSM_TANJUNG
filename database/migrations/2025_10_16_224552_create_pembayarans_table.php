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
        $table->id();
        $table->foreignId('tagihan_id')->constrained('tagihans')->onDelete('cascade');
        $table->date('tanggal_bayar');
        $table->integer('jumlah_bayar');
        $table->string('metode')->default('Tunai'); // misal: Tunai / Transfer / QRIS
        $table->timestamps();
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
