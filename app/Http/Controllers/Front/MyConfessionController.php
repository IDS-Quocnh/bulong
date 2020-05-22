<?php

namespace App\Http\Controllers\Front;

use App\Confession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyConfessionController extends Controller
{
    public function myConfessions()
    {
        $confessions = Confession::where('user_id', auth()->id())->latest()->get();

        return view('front.users.my_confessions', compact('confessions'));
    }

    public function myFeltConfessions()
    {
        // $confessions = auth()->user()->likes(Confession::class)->with('user')->get();
        $confessions = Confession::where('user_id', auth()->id())->get();

        return view('front.users.my_felt_confessions', compact('confessions'));
    }
}
