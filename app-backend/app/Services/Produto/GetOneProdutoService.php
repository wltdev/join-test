<?php

namespace App\Services\Produto;

use App\Repositories\Produto\ProdutoRepositoryInterface;

class GetOneProdutoService
{
    public function __construct(
        private readonly ProdutoRepositoryInterface $ProdutoRepository
    ) {}

    public function execute(int $id)
    {
        try {
            $record = $this->ProdutoRepository->findById($id);

            if (!$record) {
                throw new \Exception('Record not found', 404);
            }

            return $record;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
