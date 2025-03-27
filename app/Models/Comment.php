<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['commentable_id', 'commentable_type', 'user_id', 'content'];

    /**
     * Define the polymorphic relationship.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Define the relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}