<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Bulong\Comments\Comment;
use App\Http\Controllers\Controller;

class LikeConfessionCommentController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->id);
        $comment = Comment::findOrFail($request->id);

        if (!auth()->user()->hasLiked($comment)) {
            auth()->user()->like($comment);
        } else {
            auth()->user()->unlike($comment);
        }

        return response()->json(['message' => 'success']);
    }
}
