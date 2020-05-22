<?php

namespace App\Bulong\Comments;

use Carbon\Carbon;
use App\Bulong\Users\User;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use App\Bulong\Comments\CommentCollection;

class Comment extends Model
{
    use Likeable;

    protected $fillable = ['content'];

    protected $with = ['user', 'childrens'];

    protected $appends = ['is_liked', 'like_count'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($comment) {
            foreach ($comment->childrens()->get() as $comment) {
                $comment->delete();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function newCollection(array $models = [])
    {
        return new CommentCollection($models);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function getIsLikedAttribute()
    {
        if (!auth()->user()) {
            return false;
        }

        return auth()->user()->hasLiked($this);
    }

    public function getLikeCountAttribute()
    {
        return $this->likers()->get()->count();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
