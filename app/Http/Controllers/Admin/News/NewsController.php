<?php

namespace App\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bulong\News\Requests\CreateNewsRequest;
use App\Bulong\News\Requests\UpdateNewsRequest;
use App\Bulong\News\Repositories\NewsRepository;
use App\Bulong\News\Repositories\Interfaces\NewsRepositoryInterface;

class NewsController extends Controller
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepo;

    /**
     * UserController constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepo = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->newsRepo->listNews('created_at', 'desc');

        return view('admin.news.list', [
            'news' => $this->newsRepo->paginateArrayResults($list->all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewsRequest $request)
    {
        $this->newsRepo->createNews($request->except('_token', '_method'));

        $request->session()->flash('message', 'News created');
        return redirect()->route('admin.news.index');
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
        return view('admin.news.edit', ['news' => $this->newsRepo->findNewsById($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateNewsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, $id)
    {
        $news = $this->newsRepo->findNewsById($id);

        $update = new NewsRepository($news);
        $update->updateNews($request->except('_token', '_method'));

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.news.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $news = $this->newsRepo->findNewsById($id);
        $news->delete();

        request()->session()->flash('message', 'Delete successful');
        return redirect()->route('admin.news.index');
    }
}
