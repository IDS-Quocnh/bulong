<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\BackgroundImage;
use App\Http\Controllers\Controller;

class BackgroundImagesController extends Controller
{
    public function index()
    {
        return BackgroundImage::where('image', '!=', 'Default_Background.png')->latest()->get();
    }
}
