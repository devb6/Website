<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop existing enum and recreate with new values
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'petugas', 'user', 'kepalaposyandu') DEFAULT 'user'");
    }

    public function down(): void
    {
        // Revert to original enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'petugas', 'user') DEFAULT 'user'");
    }
};
