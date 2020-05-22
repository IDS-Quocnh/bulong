<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Confession;
use App\Bulong\Feeds\Feed;
use Illuminate\Http\Request;
use App\Traits\ApiJsonResponse;
use App\Http\Controllers\Controller;

class ConfessionController extends Controller
{
    use ApiJsonResponse;

    public function index()
    {
        return Confession::latest()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Confession::create([
            'text' => $request->text,
            'user_id' => auth()->id(),
            'category_id' => $request->categoryId,
            'background_image_id' => request('backgroundId', 1)
        ]);
    }

    /**
     * Show particular confession.
     *
     * @param Confession $confession
     * @return \Illuminate\Http\Response
     */
    public function show(Confession $confession)
    {
        return view('front.confessions.show', compact('confession'));
    }

    public function edit($id)
    {
        return Confession::where('id', $id)->first();
    }

    public function update(Request $request, $id)
    {
        $confession = Confession::findOrFail($id);

        if ($confession->user_id != auth()->id()) {
            return response()->json(['message' => 'unauthorized'], 403);
        }

        $confession->update([
            'text' => $request->text,
            'user_id' => auth()->id(),
            'category_id' => request('categoryId', $confession->category_id),
            'background_image_id' => request('backgroundId', $confession->background_image_id)
        ]);

        return response()->json(['message' => 'success']);
    }

    public function destroy($id)
    {
        $confession = Confession::findOrFail($id);

        if ($confession->user_id != auth()->id()) {
            return response()->json(['message' => 'unauthorized'], 403);
        }

        $confession->delete();

        return response()->json(['message' => 'success']);
    }

    public function latest()
    {
        $feeds = Feed::latest()->get();

        return $feeds;
    }

    public function trending()
    {
        $date = Carbon::now()->subDays(15);
        $feeds = Feed::where('created_at', '>=', $date)->orderBy('likes', 'desc')->get();

        if ($feeds) {
            return $feeds;
        }
        $this->mostFelt();
    }

    public function mostFelt()
    {
        $feeds = Feed::orderBy('likes', 'desc')->get();

        return $feeds;
    }

    public function getUserConfessions($userId)
    {
        return Confession::where('user_id', $userId)->latest()->get();
    }
}
