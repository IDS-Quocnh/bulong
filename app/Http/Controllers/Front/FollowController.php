<?php

namespace App\Http\Controllers\Front;

use App\Bulong\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowController extends Controller
{
    public function follow(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        auth()->user()->follow($user);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function unfollow(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        auth()->user()->unfollow($user);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
