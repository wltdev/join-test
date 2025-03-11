<?php

namespace App\Services\Produto;

use App\Repositories\Produto\ProdutoRepositoryInterface;

class DeleteProdutoService
{
    public function __construct(
        private readonly ProdutoRepositoryInterface $ProdutoRepository
    ) {}

    public function execute(int $id)
    {
        try {
            $result = $this->ProdutoRepository->delete($id);

            if (!$result) {
                throw new \Exception('Record not found', 404);
            }

            return $result;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
