<?php

namespace App\Http\Controllers\Front;

use App\Confession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index()
    {
        $query = request('q');

        $confessions = Confession::where('text', 'LIKE', '%'.$query.'%')->get();

        return view('front.search.index', compact('confessions', 'query'));
    }
}
