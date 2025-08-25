<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'image',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * علاقات المحتوى
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function breakingContents()
    {
        return $this->hasMany(BreakingContent::class);
    }

    /**
     * علاقة مع الأدوار
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * علاقة مع الصلاحيات المباشرة
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    /**
     * التحقق من الدور
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * التحقق من الصلاحية
     */
    public function hasPermission(string $permission): bool
    {
        // صلاحية مباشرة
        if ($this->permissions()->where('name', $permission)->exists()) {
            return true;
        }

        // صلاحية عن طريق الدور
        return $this->roles()->whereHas('permissions', function ($q) use ($permission) {
            $q->where('name', $permission);
        })->exists();
    }

    /**
     * التحقق من أي دور (قائمة)
     */
    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    /**
     * التحقق من أي صلاحية (قائمة)
     */
    public function hasAnyPermission(array $permissions): bool
    {
        // مباشرة
        if ($this->permissions()->whereIn('name', $permissions)->exists()) {
            return true;
        }

        // عبر الدور
        return $this->roles()->whereHas('permissions', function ($q) use ($permissions) {
            $q->whereIn('name', $permissions);
        })->exists();
    }
}
