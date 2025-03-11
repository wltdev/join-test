<?php

namespace App\Services\CategoriaProduto;

use App\Repositories\CategoriaProduto\CategoriaProdutoRepositoryInterface;

class GetOneCategoriaProdutoService
{
    public function __construct(
        private readonly CategoriaProdutoRepositoryInterface $categoriaProdutoRepository
    ) {}

    public function execute(int $id)
    {
        try {
            $record = $this->categoriaProdutoRepository->findById($id);

            if (!$record) {
                throw new \Exception('Record not found', 404);
            }

            return $record;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
