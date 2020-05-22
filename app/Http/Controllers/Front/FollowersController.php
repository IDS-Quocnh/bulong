<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function index()
    {
        $followers = auth()->user()->followers;

        return view('front.users.followers', compact('followers'));
    }
}
