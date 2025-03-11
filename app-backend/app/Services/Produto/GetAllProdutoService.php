<?php

namespace App\Services\Produto;

use App\Repositories\Produto\ProdutoRepositoryInterface;

class GetAllProdutoService
{
    public function __construct(
        private readonly ProdutoRepositoryInterface $ProdutoRepository
    ) {}

    public function execute()
    {
        try {
            return $this->ProdutoRepository->getAll();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
