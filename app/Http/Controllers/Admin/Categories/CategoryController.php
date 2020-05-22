<?php

namespace App\Http\Controllers\Admin\Categories;

use Illuminate\Http\Request;
use App\Bulong\Categories\Category;
use App\Http\Controllers\Controller;
use App\Bulong\Categories\Repositories\CategoryRepository;
use App\Http\Controllers\Admin\Categories\Requests\CreateCategoryRequest;
use App\Http\Controllers\Admin\Categories\Requests\UpdateCategoryRequest;
use App\Bulong\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * Category controller constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepo
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->categoryRepo->listCategories();

        if (request()->ajax()) {
            return $list;
        }

        $categories = Category::latest()->paginate();

        return view('admin.categories.list', compact('categories'));

        // return view('admin.categories.list', [
        //     'categories' => $this->categoryRepo->paginateArrayResults($list->all())
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->categoryRepo->createCategory($request->except('_token', '_method'));

        return redirect()->route('admin.categories.index')->with('message', 'Category created');
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
        return view('admin.categories.edit', [
            'category' => $this->categoryRepo->findCategoryById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categoryRepo->findCategoryById($id);

        $update = new CategoryRepository($category);
        $update->updateCategory($request->except('_token', '_method'));

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.categories.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $category = $this->categoryRepo->findCategoryById($id);
        $category->delete();

        request()->session()->flash('message', 'Delete successful');
        return redirect()->route('admin.categories.index');
    }
}
