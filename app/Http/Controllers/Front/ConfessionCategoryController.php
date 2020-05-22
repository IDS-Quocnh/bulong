<?php

namespace App\Http\Controllers\Front;

use App\Confession;
use App\Bulong\Feeds\Feed;
use Illuminate\Http\Request;
use App\Bulong\Categories\Category;
use App\Http\Controllers\Controller;
use App\Bulong\News\Repositories\Interfaces\NewsRepositoryInterface;
use App\Bulong\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class ConfessionCategoryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $news = $this->newsRepo->listNews()->take(3);
        $category = Category::where('slug', $slug)->first();
        $feeds = Feed::where('category_id', $category->id)->get();

        if (request()->ajax()) {
            return $feeds;
        }

        return view('front.confession_categories.index', compact('categories', 'news', 'slug', 'category'));
    }

    public function getConfessions($categoryId)
    {
        return Confession::where('category_id', $categoryId)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
