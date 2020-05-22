<?php

namespace App\Http\Controllers\Front;

use App\Confession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\FeltConfession;

class LikeConfessionController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->id);
        $confession = Confession::findOrFail($request->id);

        if (!auth()->user()->hasLiked($confession)) {
            $confession->user->notify(new FeltConfession($confession));
            auth()->user()->like($confession);
            $confession->increment('like');
        } else {
            auth()->user()->unlike($confession);
            $confession->decrement('like');
        }

        return response()->json(['message' => 'success']);
    }
}
