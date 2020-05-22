<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Bulong\Categories\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return $categories;
    }
}
