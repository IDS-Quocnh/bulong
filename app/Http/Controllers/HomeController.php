<?php

namespace App\Http\Controllers;

use App\Bulong\Feeds\Feed;
use Illuminate\Http\Request;

class HomeController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $feeds = Feed::all();

        if (request()->ajax()) {
            return $feeds;
        }
        return view('home');
    }
}
