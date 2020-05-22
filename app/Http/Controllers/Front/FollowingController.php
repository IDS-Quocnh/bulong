<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function index()
    {
        $followings = auth()->user()->followings()->get();

        return view('front.users.followings', compact('followings'));
    }
}
