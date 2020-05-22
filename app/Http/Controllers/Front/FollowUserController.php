<?php

namespace App\Http\Controllers\Front;

use App\Bulong\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowUserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::findOrFail($request->id);

        auth()->user()->toggleFollow($user);

        return response()->json(['message' => 'success']);
    }
}
