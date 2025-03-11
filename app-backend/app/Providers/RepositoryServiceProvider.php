<?php

namespace App\Providers;

use App\Repositories\CategoriaProduto\CategoriaProdutoRepository;
use App\Repositories\CategoriaProduto\CategoriaProdutoRepositoryInterface;
use App\Repositories\Produto\ProdutoRepository;
use App\Repositories\Produto\ProdutoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoriaProdutoRepositoryInterface::class, CategoriaProdutoRepository::class);
        $this->app->bind(ProdutoRepositoryInterface::class, ProdutoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
