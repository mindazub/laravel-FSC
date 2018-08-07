<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Services\API\ArticleService;
use App\Services\API\AuthorService;
use App\Services\API\CategoryService;

use App\Services\ClientAPI\ClientArticleService;
use App\Services\ClientAPI\ClientAuthorService;
use App\Services\ClientAPI\ClientCategoryService;
use App\Services\UserService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->app->singleton(ArticleService::class);
        $this->app->singleton(AuthorService::class);
        $this->app->singleton(CategoryService::class);
    }

    /**
     *
     */
    public function registerRepositories(): void
    {
        $this->app->singleton(ArticleRepository::class);
        $this->app->singleton(AuthorRepository::class);
        $this->app->singleton(CategoryRepository::class);
        $this->app->singleton(UserRepository::class);
    }
}
