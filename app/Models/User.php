<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function follow(User $user)
{
    $this->follows()->attach($user->id);
}

public function unfollow(User $user)
{
    $this->follows()->detach($user->id);
}

public function isFollowing(User $user)
{
    return $this->follows()->where('followed_id', $user->id)->exists();
}

public function follows()
{
    return $this->belongsToMany(User::class, 'user_follows', 'follower_id', 'followed_id')->withTimestamps();
}

public function savePost(Post $post)
{
    $this->savedPosts()->attach($post->id);
}

public function unsave(Post $post)
{
    $this->savedPosts()->detach($post->id);
}

public function hasSaved(Post $post)
{
    return $this->savedPosts()->where('post_id', $post->id)->exists();
}

public function savedPosts()
{
    return $this->belongsToMany(Post::class, 'user_saved_posts', 'user_id', 'post_id')->withTimestamps();
}

}
