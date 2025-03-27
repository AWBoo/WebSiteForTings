<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
        $imagePath =  ($this->image) ? $this->image : 'profile/AAF2UEOGV55ZGECqCXGqALI4jns5jv5iPklqmdUI.png';
        return '/storage/' . $imagePath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'userprofile_user', 'userprofile_id', 'user_id');
    }
}
