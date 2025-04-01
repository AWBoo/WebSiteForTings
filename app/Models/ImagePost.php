<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ImagePost extends Model
{
    protected $guarded = [];

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'likeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // Count the number of likes for the post
    public function likeCount()
    {
        return $this->likes()->count();
    }
}
