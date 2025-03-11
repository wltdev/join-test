<?php

namespace App\Services\CategoriaProduto;

use App\Repositories\CategoriaProduto\CategoriaProdutoRepositoryInterface;

class CreateCategoriaProdutoService
{
    public function __construct(
        private readonly CategoriaProdutoRepositoryInterface $categoriaProdutoRepository
    ) {}

    public function execute(array $data)
    {
        try {
            return $this->categoriaProdutoRepository->create($data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
