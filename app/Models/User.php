<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public const LOCAL=['fr'=>'FRENCH','en'=>'ENGLISH'];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
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
       return $this->morphMany(Comment::class,"commentable");
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // scopes
     public function scopeMostActiveUsers(Builder $builder)
    {
        $builder->withCount('posts')->orderBy('posts_count', "DESC");
    }

    public function scopeUserActiveLastMonth(Builder $builder)
    {
        $builder->withCount(['posts'=>function(Builder $query){
            $query->whereBetween(static::CREATED_AT,[now()->subMonths(1),now()]);
        }])
        ->having('posts_count',">",5)
        ->orderBy('posts_count','DESC');
    }
}
