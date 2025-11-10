<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@posyandu.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => UserRole::ADMIN,
            ]
        );

        // Petugas
        User::firstOrCreate(
            ['email' => 'petugas@posyandu.com'],
            [
                'name' => 'Petugas Posyandu',
                'password' => Hash::make('password'),
                'role' => UserRole::PETUGAS,
            ]
        );

        // Kepala Posyandu
        User::firstOrCreate(
            ['email' => 'kepala@posyandu.com'],
            [
                'name' => 'Kepala Posyandu',
                'password' => Hash::make('password'),
                'role' => UserRole::KEPALAPOSYANDU,
            ]
        );

        // User biasa
        User::firstOrCreate(
            ['email' => 'user@posyandu.com'],
            [
                'name' => 'User Test',
                'password' => Hash::make('password'),
                'role' => UserRole::USER,
            ]
        );
    }
}

