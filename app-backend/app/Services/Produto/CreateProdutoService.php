<?php

namespace App\Services\Produto;

use App\Repositories\Produto\ProdutoRepositoryInterface;

class CreateProdutoService
{
    public function __construct(
        private readonly ProdutoRepositoryInterface $ProdutoRepository
    ) {}

    public function execute(array $data)
    {
        try {
            return $this->ProdutoRepository->create($data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
