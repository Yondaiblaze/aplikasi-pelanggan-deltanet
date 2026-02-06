<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // 1. Tabel Types (Untuk CIR & MIR)
        Schema::create('isp_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Dedicated, Up To
            $table->string('cir')->nullable(); // Kecepatan dijamin
            $table->string('mir')->nullable(); // Kecepatan maksimal
            $table->timestamps();
        });

        // 2. Tabel Packages (Paket Utama)
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('harga', 15, 2);
            $table->string('kecepatan');
            $table->text('deskripsi')->nullable();
            $table->string('icon')->nullable(); // Tambahan icon/gambar sesuai pesan Bapak
            $table->foreignId('type_id')->constrained('isp_types')->onDelete('cascade');
            $table->timestamps();
        });

        // 3. Tabel Addons
        Schema::create('addons', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('harga', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        // 4. Tabel Penghubung (Langganan Addons)
        Schema::create('langganan_addons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('langganan_id'); // Menempel ke tabel langganan/user
            $table->foreignId('addon_id')->constrained('addons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('langganan_addons');
        Schema::dropIfExists('addons');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('isp_types');
    }
};
