<?php

namespace App\Http\Controllers\Front;

use App\Confession;
use Illuminate\Http\Request;
use App\Bulong\Comments\Comment;
use App\Http\Controllers\Controller;
use App\Notifications\CommentedConfession;

class CommentConfessionController extends Controller
{
    public function getComments($id)
    {
        $confession = Confession::findOrFail($id);

        return $confession->comments;
    }


    public function store()
    {
        $confession = Confession::where('id', request('confessionId'))->first();

        $confession->addComment([
            'content' => request('text'),
            'parent_id' => request('parentId', 0)
        ]);

        $confession->user->notify(new CommentedConfession($confession));

        return response()->json(['message' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $comment->update([
            'content' => $request->text
        ]);

        return response()->json(['message' => 'success']);
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id == auth()->id()) {
            $comment->delete();

            return response()->json(['message' => 'success']);
        }

        return response()->json(['message' => 'unauthorized'], 403);
    }
}
