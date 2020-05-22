<?php

namespace App\Bulong\News\Repositories\Interfaces;

use App\Bulong\News\News;
use Jsdecena\Baserepo\BaseRepositoryInterface;
use Illuminate\Support\Collection as Support;

interface NewsRepositoryInterface extends BaseRepositoryInterface
{
    public function listNews(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Support;

    public function createNews(array $params) : News;
}
