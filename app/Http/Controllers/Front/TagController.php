<?php

namespace App\Http\Controllers\Front;

use App\Bulong\Feeds\Feed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bulong\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class TagController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * HomeController constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepo = $categoryRepository;
    }

    public function show($slug)
    {
        $categories = $this->categoryRepo->listCategories('created_at', 'desc');
        $category = $categories->first();

        $feeds = Feed::withAnyTags($slug)->get();

        if (request()->ajax()) {
            return $feeds;
        }

        return view('front.tags.show', compact('categories', 'news', 'slug', 'category'));
    }
}
