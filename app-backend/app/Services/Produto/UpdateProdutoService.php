<?php

namespace App\Services\Produto;

use App\Repositories\Produto\ProdutoRepositoryInterface;

class UpdateProdutoService
{
    public function __construct(
        private readonly ProdutoRepositoryInterface $ProdutoRepository
    ) {}

    public function execute(int $id, array $data)
    {
        try {
            return $this->ProdutoRepository->update($id, $data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
