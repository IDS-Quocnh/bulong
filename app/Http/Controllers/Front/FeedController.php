<?php

namespace App\Http\Controllers\Front;

use App\Bulong\Feeds\Feed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\FeltConfession;

class FeedController extends Controller
{
    /**
     * Like particular feed.
     *
     * @param Request $request
     * @return Response
     */
    public function like(Request $request)
    {
        $feed = Feed::find($request->id);

        $response = auth()->user()->toggleLike($feed);

        if (empty($response['attached'])) {
            $feed->decrement('likes');
        } else {
            $feed->increment('likes');
            $feed->user->notify(new FeltConfession($feed));
        }
        // empty($response['attached']) ? $feed->decrement('likes') : $feed->increment('likes');

        return response()->json(['success' => $response]);
    }
}
