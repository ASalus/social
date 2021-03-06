<?php

namespace App\Models;


use App\Models\Post\PostStat;
use App\Models\Post\UserPostStat;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function isAdmin()
    {
        return auth()->user()->role_id === 1 ? true : false;
    }

    public function followers()
    {
        return $this->hasMany(UserFollower::class, 'user_id', 'id');
    }

    public function followed()
    {
        return $this->hasMany(UserFollower::class, 'follower_id', 'id');
    }

    public function userPostStat()
    {
        return $this->hasMany(UserPostStat::class);
    }
}
