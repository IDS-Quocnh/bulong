<?php

namespace App\Bulong\Users;

use Laravel\Passport\HasApiTokens;
use Overtrue\LaravelFollow\Followable;
use Overtrue\LaravelLike\Traits\Liker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Liker, Followable, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'avatar', 'dob', 'gender', 'city_id', 'is_deleted',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['is_following', 'profile_picture'];

    public function getGenderAttribute($value)
    {
        if ($value == 'F') {
            return 'Female';
        } elseif ($value == 'M') {
            return 'Male';
        } else {
            return 'Other';
        }
    }

    public function getProfilePictureAttribute()
    {
        $value = $this->attributes['avatar'];

        if ($value != '') {
            return asset('storage/'. $value);
        }
        return asset('public/images/profile.jpg');
    }

    public function getIsFollowingAttribute()
    {
        if (!auth()->user()) {
            return false;
        }

        return auth()->user()->isFollowing($this);
    }

    public function deleteAccount()
    {
        $this->update(['is_deleted' => true]);
    }
}
