<?php

namespace App\Http\Controllers\Front;

use App\Confession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowingPeopleConfessionController extends Controller
{
    public function index()
    {
        $userIds = auth()->user()->followings()->get()->pluck('id');

        $confessions = Confession::whereIn('user_id', $userIds)->latest()->paginate();

        return $confessions;
    }
}
