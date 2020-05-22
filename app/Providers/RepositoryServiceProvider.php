<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Bulong\News\Repositories\NewsRepository;
use App\Bulong\Users\Repositories\UserRepository;
use App\Bulong\Categories\Repositories\CategoryRepository;
use App\Bulong\News\Repositories\Interfaces\NewsRepositoryInterface;
use App\Bulong\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Bulong\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            NewsRepositoryInterface::class,
            NewsRepository::class
        );
    }
}
