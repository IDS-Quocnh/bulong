<?php

namespace App\Http\Controllers\Front;

use App\Bulong\Feeds\Feed;
use App\Bulong\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserConfessionController extends Controller
{
    public function myConfession($username)
    {
        $user = User::where('username', $username)->first();
        $feeds = Feed::where('user_id', $user->id)->get();

        return view('front.users.confessions', compact('feeds', 'user'));
    }

    public function myFeltConfessions()
    {
        $feeds = auth()->user()->likes(Feed::class)->get();

        return view('front.users.felt_confessions', compact('feeds'));
    }

    public function edit($id)
    {
        return Confession::where('id', $id)->first();
    }

    public function destroy($id)
    {
        $feed = Feed::findOrFail($id);

        if (auth()->id() == $feed->user_id) {
            $feed->delete();

            return response()->json(['messgae' => 'success']);
        }
    }
}
