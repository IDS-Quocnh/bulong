<?php

namespace App\Bulong\News\Repositories;

use App\Bulong\News\News;
use Illuminate\Http\UploadedFile;
use App\Bulong\Tools\UploadableTrait;
use Jsdecena\Baserepo\BaseRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use App\Bulong\Users\Exceptions\CreateUserInvalidArgumentException;
use App\Bulong\News\Repositories\Interfaces\NewsRepositoryInterface;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    use UploadableTrait;

    /**
     * NewsRepository constructor.
     *
     * @param News $news
     */
    public function __construct(News $news)
    {
        parent::__construct($news);
        $this->model = $news;
    }

    /**
     * List all the news
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return \Illuminate\Support\Collection
     */
    public function listNews(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Support
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * Create the user
     *
     * @param array $params
     * @return User
     * @throws CreateUserInvalidArgumentException
     */
    public function createNews(array $params) : News
    {
        try {
            $collection = collect($params);

            if (isset($params['image']) && ($params['image'] instanceof UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'news');
            }

            $merge = $collection->merge(compact('image'));

            $news = new News($merge->all());

            $news->save();

            return $news;
        } catch (QueryException $e) {
            throw new CreateUserInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

    /**
     * Update the news
     *
     * @param array $params
     * @return News
     */
    public function updateNews(array $params) : News
    {
        $news = $this->findNewsById($this->model->id);
        $collection = collect($params)->except('_token');

        if (isset($params['image']) && ($params['image'] instanceof UploadedFile)) {
            $image = $this->uploadOne($params['image']);
        }

        $merge = $collection->merge(compact('image'));

        $news->update($merge->all());

        return $news;
    }

    /**
     * Find news by id
     *
     * @param int $id
     * @return News
     */
    public function findNewsById(int $id) : News
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new NewsNotFoundException($e->getMessage());
        }
    }
}
