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
        Schema::create('role_access', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama akses (contoh: "Kelola Balita", "Kelola Ibu Hamil")
            $table->string('slug')->unique(); // Slug untuk identifikasi (contoh: "manage-balita")
            $table->string('description')->nullable(); // Deskripsi akses
            $table->enum('role', ['admin', 'petugas', 'user', 'kepalaposyandu']); // Role yang memiliki akses ini
            $table->string('permission')->nullable(); // Permission detail (create, read, update, delete)
            $table->boolean('is_active')->default(true); // Status aktif/tidak aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_access');
    }
};
