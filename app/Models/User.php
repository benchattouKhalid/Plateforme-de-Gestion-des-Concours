<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'prenom', 'email', 'password', 'role', 'region',
    ];

    // Define relationships for different roles
    public function centres()
    {
        return $this->hasMany(Centre::class, 'centre_responsable');
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }

    // Role-checking helper methods
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isGestionnaireGlobal(): bool
    {
        return $this->hasRole('gestionnaire_global');
    }

    public function isGestionnaireLocal(): bool
    {
        return $this->hasRole('gestionnaire_local');
    }

    public function region()
{
    return $this->belongsTo(Region::class, 'region_id');
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hasPermission($permissionName)
    {
        return DB::table('role_permissions')
            ->join('permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->where('role_permissions.role', $this->role)
            ->where('permissions.name', $permissionName)
            ->exists();
    }
    
}
