<?php

namespace App\Providers;

use App\Repositories\CategoriaProduto\CategoriaProdutoRepository;
use App\Repositories\CategoriaProduto\CategoriaProdutoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoriaProdutoRepositoryInterface::class, CategoriaProdutoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
