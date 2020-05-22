<?php

namespace App\Http\Controllers\Front;

use App\Bulong\Feeds\Feed;
use Illuminate\Http\Request;
use App\Traits\ApiJsonResponse;
use App\Http\Controllers\Controller;
use App\Notifications\CommentedConfession;

class CommentController extends Controller
{
    use ApiJsonResponse;

    public function index($id)
    {
        $feed = Feed::findOrFail($id);

        return $feed->comments;
        // $feed['comments'] = $feed->getThreadedComments();

        // return response()->json($this->successResponse($feed, ''));

        // return $feed->comments;
    }

    public function store()
    {
        $feed = Feed::where('id', '=', request('feed_id'))->first();
        $feed->addComment([
            'content' => request('content'),
            'parent_id' => request('parent_id', 0)
        ]);

        $feed->user->notify(new CommentedConfession($feed));
        return response()->json(['message' => 'success']);
    }
}
