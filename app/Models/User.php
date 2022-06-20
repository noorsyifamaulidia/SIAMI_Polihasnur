<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'is_active'
    ];

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
    ];

    // scope is active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // scope role user
    public function scopeIsUser($query)
    {
        $query->role('user');
    }

    // scope role kepala upm
    public function scopeIsKepalaUpm($query)
    {
        $query->role('kepala upm');
    }

    // scope filter
    public function scopeFilter($query, $params)
    {
        $query->where(function($query) use ($params) {
            if (isset($params['q'])) {
                $query->where('username', 'like', '%' . $params['q'] . '%');
            }

            if (isset($params['q'])) {
                $query->orWhere('name', 'like', '%' . $params['q'] . '%');
            }

            if (isset($params['q'])) {
                $query->orWhere('email', 'like', '%' . $params['q'] . '%');
            }
        });
    }
}
