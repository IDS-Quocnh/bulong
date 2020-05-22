<?php

namespace App\Http\Controllers\Front;

use App\Bulong\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->first();

        return view('front.users.profile', compact('user'));
    }
}
