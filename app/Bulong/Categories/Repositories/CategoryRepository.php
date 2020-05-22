<?php

namespace App\Bulong\Categories\Repositories;

use Illuminate\Http\UploadedFile;
use App\Bulong\Categories\Category;
use App\Bulong\Tools\UploadableTrait;
use Jsdecena\Baserepo\BaseRepository;
use App\Bulong\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    use UploadableTrait;

    /**
     * CategoryRepository constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
        $this->model = $category;
    }

    /**
     * List all the categories
     *
     * @return \Illuminate\Http\Exception
     */
    public function listCategories()
    {
        return $this->model->latest()->get();
    }

    /**
     * Create the category
     *
     * @param array $params
     * @throws CategoryInvalidArgumentException
     * @return Category
     */
    public function createCategory(array $params) : Category
    {
        try {
            $collection = collect($params)->except('_token');
            $collection['slug'] = str_slug($params['name']);

            if (isset($params['image']) && ($params['image'] instanceof UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'categories');
            }

            $merge = $collection->merge(compact('image'));

            $category = new Category($merge->all());
            $category->save();

            return $category;
        } catch (QueryException $e) {
            throw new CategoryInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCategory(array $params) : Category
    {
        $category = $this->findCategoryById($this->model->id);
        $collection = collect($params)->except('_token');

        if (isset($params['image']) && ($params['image'] instanceof UploadedFile)) {
            $image = $this->uploadOne($params['image'], 'categories');
        }

        $merge = $collection->merge(compact('image'));

        $category->update($merge->all());

        return $category;
    }

    /**
     * Find specific category
     *
     * @param int $id
     * @return Category
     */
    public function findCategoryById(int $id) : Category
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException($e->getMessage());
        }
    }
}
