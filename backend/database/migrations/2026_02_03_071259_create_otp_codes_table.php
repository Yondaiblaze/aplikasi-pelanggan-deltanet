<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('otp_codes', function (Blueprint $table) {
        $table->id();
        $table->string('phone'); // Untuk mencocokkan nomor HP pelanggan
        $table->string('code');  // Kode OTP (misal: 123456)
        $table->string('type');  // login, register, atau forgot_password
        $table->timestamp('expired_at'); // Untuk keamanan (kedaluwarsa dalam 5-30 menit)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_codes');
    }
};
