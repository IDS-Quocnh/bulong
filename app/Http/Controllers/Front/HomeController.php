<?php

namespace App\Http\Controllers\Front;

use Spatie\Tags\Tag;
use App\Bulong\Feeds\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bulong\News\Repositories\Interfaces\NewsRepositoryInterface;
use App\Bulong\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class HomeController
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepo;

    /**
     * HomeController constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        NewsRepositoryInterface $newsRepository
    ) {
        $this->categoryRepo = $categoryRepository;
        $this->newsRepo = $newsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tags = Tag::latest()->get();
        // $tagCount = DB::table('taggables')->where('tag_id', $tags->id)->count();

        $categories = $this->categoryRepo->listCategories('created_at', 'desc');
        $news = $this->newsRepo->listNews()->take(3);
        $feeds = Feed::latest()->get();

        if (request()->ajax()) {
            return $feeds;
        }

        return view('front.feeds', [
            'categories' => $categories,
            'news' => $news,
            'tags' => $tags,
        ]);
    }

    public function store(Request $request)
    {
        Feed::create([
            'text' => $request->text,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);
    }
}
