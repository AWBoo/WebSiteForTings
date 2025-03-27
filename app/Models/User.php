<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
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

    public static function boot()
    {
        parent::boot();

        static::created(function ($user) 
        {
            $user->profile()->create([
                'title'=> $user->username
            ]);
        });
    }

    public function imagePosts()
    {
        return $this->hasMany(ImagePost::class)->orderBy('created_at','desc');
    }

    public function textPosts()
    {
        return $this->hasMany(TextPost::class)->orderBy('created_at','desc');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function following()
    {
        return $this->belongsToMany(UserProfile::class, 'userprofile_user', 'user_id', 'userprofile_id');
    }
}
