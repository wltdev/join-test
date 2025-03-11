<?php

namespace App\Services\CategoriaProduto;

use App\Repositories\CategoriaProduto\CategoriaProdutoRepositoryInterface;

class UpdateCategoriaProdutoService
{
    public function __construct(
        private readonly CategoriaProdutoRepositoryInterface $categoriaProdutoRepository
    ) {}

    public function execute(int $id, array $data)
    {
        try {
            return $this->categoriaProdutoRepository->update($id, $data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
