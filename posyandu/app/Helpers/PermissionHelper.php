<?php

namespace App\Helpers;

use App\Models\RoleAccess;
use App\Models\User;

class PermissionHelper
{
    /**
     * Cek apakah user memiliki permission berdasarkan slug
     * 
     * Jika slug tidak ada di database, akan auto-fallback ke role-based check
     * untuk memudahkan development tanpa harus tambah slug dulu
     *
     * @param User $user
     * @param string $slug
     * @return bool
     */
    public static function can(User $user, string $slug): bool
    {
        // Admin selalu bisa akses semua
        if ($user->isAdmin()) {
            return true;
        }

        // Cek di database role_access
        $roleAccess = RoleAccess::where('slug', $slug)
            ->where('is_active', true)
            ->where('role', $user->getRole()->value)
            ->first();

        // Jika slug ada di database, gunakan hasil dari database
        if ($roleAccess !== null) {
            return true;
        }

        // Auto-fallback: Jika slug tidak ada di database, gunakan role-based check
        // Default: admin, kepala posyandu, dan petugas bisa akses, user tidak bisa
        return $user->canAccessAdmin();
    }

    /**
     * Cek apakah user memiliki permission dengan permission detail
     * 
     * Jika slug tidak ada di database, akan auto-fallback ke role-based check
     *
     * @param User $user
     * @param string $slug
     * @param string $permission (create, read, update, delete, all)
     * @return bool
     */
    public static function canWithPermission(User $user, string $slug, string $permission = 'read'): bool
    {
        // Admin selalu bisa akses semua
        if ($user->isAdmin()) {
            return true;
        }

        // Cek di database role_access
        $roleAccess = RoleAccess::where('slug', $slug)
            ->where('is_active', true)
            ->where('role', $user->getRole()->value)
            ->first();

        // Jika slug ada di database, gunakan permission dari database
        if ($roleAccess !== null) {
            // Jika permission adalah 'all', user bisa semua
            if ($roleAccess->permission === 'all') {
                return true;
            }
            // Cek permission spesifik
            return $roleAccess->permission === $permission;
        }

        // Auto-fallback: Jika slug tidak ada di database, gunakan role-based check
        // Default behavior berdasarkan permission:
        // - 'read': semua yang bisa akses admin (admin, kepala posyandu, petugas, user bisa lihat)
        // - 'create', 'update', 'delete': hanya admin, kepala posyandu, dan petugas
        if ($permission === 'read') {
            // User biasa juga bisa read
            return true;
        }
        
        // Untuk create, update, delete: hanya admin, kepala posyandu, dan petugas
        return $user->canAccessAdmin();
    }

    /**
     * Get semua permission yang dimiliki user berdasarkan role
     *
     * @param User $user
     * @return array
     */
    public static function getUserPermissions(User $user): array
    {
        $permissions = RoleAccess::where('role', $user->getRole()->value)
            ->where('is_active', true)
            ->get();

        return $permissions->pluck('slug')->toArray();
    }
}

