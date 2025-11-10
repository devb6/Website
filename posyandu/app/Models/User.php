<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function isAdmin(): bool
    {
        return $this->getRole() === UserRole::ADMIN;
    }

    public function isPetugas(): bool
    {
        return $this->getRole() === UserRole::PETUGAS;
    }

    public function isUser(): bool
    {
        return $this->getRole() === UserRole::USER;
    }

    public function isKepalaPosyandu(): bool
    {
        return $this->getRole() === UserRole::KEPALAPOSYANDU;
    }

    public function canAccessAdmin(): bool
    {
        return $this->isAdmin() || $this->isPetugas() || $this->isKepalaPosyandu();
    }

    public function getRole(): UserRole
    {
        if ($this->role instanceof UserRole) {
            return $this->role;
        }
        return UserRole::from($this->role ?? 'user');
    }

    /**
     * Cek apakah user memiliki permission berdasarkan slug
     *
     * @param string $slug
     * @return bool
     */
    public function hasPermission(string $slug): bool
    {
        return \App\Helpers\PermissionHelper::can($this, $slug);
    }

    /**
     * Cek apakah user memiliki permission dengan detail permission
     *
     * @param string $slug
     * @param string $permission (create, read, update, delete, all)
     * @return bool
     */
    public function canPermission(string $slug, string $permission = 'read'): bool
    {
        return \App\Helpers\PermissionHelper::canWithPermission($this, $slug, $permission);
    }
}

