<?php

namespace App;

use Carbon\Carbon;
use App\Bulong\Users\User;
use App\Models\BackgroundImage;
use App\Bulong\Comments\Comment;
use App\Bulong\Categories\Category;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Confession extends Model
{
    use Likeable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'user_id',
        'category_id',
        'like_count',
        'background_image_id'
    ];

    protected $appends = ['like_count', 'comment_count', 'is_liked', 'username'];

    protected $with = ['category', 'user', 'background'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function background()
    {
        return $this->hasOne(BackgroundImage::class, 'id', 'background_image_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getLikeCountAttribute()
    {
        return $this->likers()->get()->count();
    }

    public function getIsLikedAttribute()
    {
        if (!auth()->user()) {
            return false;
        }

        return auth()->user()->hasLiked($this);
    }

    public function getUsernameAttribute()
    {
        return $this->user->username;
    }

    public function addComment($attributes)
    {
        $comment = (new Comment())->forceFill($attributes);
        $comment->user_id = auth()->id();

        return $this->comments()->save($comment);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', 0);
    }

    public function getCommentCountAttribute()
    {
        return Comment::where('confession_id', $this->id)->count();
    }
}
