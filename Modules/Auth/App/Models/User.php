<?php

namespace Modules\Auth\App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\Database\Factories\UserFactory;
use Modules\Blog\App\Models\PostComment;
use Modules\RolePermission\App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ACTIVE_TWO_AUTH = 1;
    const DEACTIVE_TWO_AUTH = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function deactiveTwoFactorAuth()
    {
        $this->two_auth = self::DEACTIVE_TWO_AUTH;
        $this->save();
    }

    public function activeTwoFactorAuth()
    {
        $this->two_auth = self::ACTIVE_TWO_AUTH;
        $this->save();
    }

    public function postComment()
    {
        return $this->hasMany(PostComment::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin()
    {
        return $this->roles->pluck('name')->contains('admin');
    }

    public function isWriter()
    {
        return $this->roles->pluck('name')->contains('writer');
    }
}
