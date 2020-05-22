<?php

namespace App\Bulong\News;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    /**
     * Get the news image
     *
     * @return string
     */
    public function getImageAttribute()
    {
        if (file_exists('storage/' . $this->attributes['image']) && $this->attributes['image'] != '') {
            return asset('storage/'.$this->attributes['image']);
        }
        return asset('storage/categories/default.jpg');
    }
}
