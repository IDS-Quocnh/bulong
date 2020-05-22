<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
    protected $guarded = [];

    public function getImageAttribute($image)
    {
        return Storage::url($image);
    }
}
