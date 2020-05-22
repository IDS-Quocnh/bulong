<?php

namespace App\Bulong\Feeds;

use App\TagQueue;
use Carbon\Carbon;
use Spatie\Tags\HasTags;
use App\Bulong\Users\User;
use App\Parsers\HashtagParser;
use League\CommonMark\DocParser;
use League\CommonMark\HtmlRenderer;
use App\Bulong\Comments\Comment;
use League\CommonMark\Environment;
use App\Bulong\Categories\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasTags;

    public static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            App::singleton('tagqueue', function () {
                return new TagQueue;
            });
            $environment = Environment::createCommonMarkEnvironment();
            $environment->addInlineParser(new HashtagParser());
            $parser = new DocParser($environment);
            $htmlRenderer = new HtmlRenderer($environment);

            $text = $parser->parse($model->text);

            $model->html = $htmlRenderer->renderBlock($text);
        });

        self::saved(function ($model) {
            $model->syncTags(app('tagqueue')->getTags());
        });
    }

    protected $guarded = [];

    protected $appends = ['username', 'like_count', 'is_liked', 'comment_count'];

    protected $dates = ['created_at'];

    protected $with = ['category', 'user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getUsernameAttribute()
    {
        return $this->user->username;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getCommentCountAttribute()
    {
        return $this->comments()->get()->count();
    }

    public function getIsLikedAttribute()
    {
        return auth()->user()->hasLiked($this);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', 0);
    }

    public function getThreadedComments()
    {
        return $this->comments()->with('user')->get()->threaded();
    }

    public function addComment($attributes)
    {
        $comment = (new Comment())->forceFill($attributes);
        $comment->user_id = auth()->id();
        return $this->comments()->save($comment);
    }
}
