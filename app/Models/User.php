<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi ke enrollments (kursus yang diikuti oleh Student).
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relasi ke courses (kursus yang diajarkan oleh Teacher).
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    /**
     * Relasi ke notifications (notifikasi milik User).
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Cek apakah user memiliki role tertentu.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}
