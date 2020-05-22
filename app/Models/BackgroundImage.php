<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundImage extends Model
{
    public function getImageAttribute()
    {
        return '/images/backgrounds/' . $this->attributes['image'];
    }
}
