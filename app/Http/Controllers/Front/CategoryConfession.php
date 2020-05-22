<?php

namespace App\Http\Controllers\Front;

use App\Confession;
use Illuminate\Http\Request;
use App\Bulong\Categories\Category;
use App\Http\Controllers\Controller;

class CategoryConfession extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $confessions = Confession::where('category_id', $category->id)->get();

        return view('front.categories_confessions', compact('category', 'confessions'));
    }
}
