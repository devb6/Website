<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ibu_hamil', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_suami')->nullable();
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->date('hpht'); // Hari Pertama Haid Terakhir
            $table->string('telepon')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ibu_hamil');
    }
};

