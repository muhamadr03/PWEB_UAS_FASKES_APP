<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Support\Facades\Log;


class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan atribut role
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $attributes = [
        'role' => self::ROLE_USER,
    ];

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    // Metode untuk FilamentUser interface
    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya admin dan super_admin yang bisa mengakses panel Filament
        $canAccess = $this->isSuperAdmin() || $this->isAdmin();

        Log::info('User Model canAccessPanel: Checking access for user: ' . $this->email);
        Log::info('User Model canAccessPanel: User role: ' . $this->role);
        Log::info('User Model canAccessPanel: isSuperAdmin(): ' . ($this->isSuperAdmin() ? 'true' : 'false'));
        Log::info('User Model canAccessPanel: isAdmin(): ' . ($this->isAdmin() ? 'true' : 'false'));

        return $canAccess;
    }
}
