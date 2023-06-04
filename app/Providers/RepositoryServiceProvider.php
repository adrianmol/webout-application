<?php

namespace App\Providers;

use App\Interfaces\CategoriesRepositoryInterface;
use App\Repositories\CategoriesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CategoriesRepositoryInterface::class,
            CategoriesRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
