<?php

namespace App\Bulong\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'slug',
    ];

    /**
     * Get the category image
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
