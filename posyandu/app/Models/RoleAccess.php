<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\UserRole;

class RoleAccess extends Model
{
    use HasFactory;

    protected $table = 'role_access';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'role',
        'permission',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get role label
     */
    public function getRoleLabelAttribute(): string
    {
        return UserRole::from($this->role)->label();
    }

    /**
     * Scope untuk filter berdasarkan role
     */
    public function scopeForRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope untuk akses aktif saja
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
