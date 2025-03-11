<?php

namespace App\Services\CategoriaProduto;

use App\Repositories\CategoriaProduto\CategoriaProdutoRepositoryInterface;

class GetAllCategoriaProdutoService
{
    public function __construct(
        private readonly CategoriaProdutoRepositoryInterface $categoriaProdutoRepository
    ) {}

    public function execute()
    {
        try {
            return $this->categoriaProdutoRepository->getAll();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
