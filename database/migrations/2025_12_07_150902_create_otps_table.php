<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id('otp_id');
            $table->string('phone', 20);              // nomor WA
            $table->string('code', 6);                // kode OTP 6 digit
            $table->boolean('is_used')->default(false);
            $table->timestamp('expires_at');          // masa berlaku OTP
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
