<?php

namespace App\Services\CategoriaProduto;

use App\Repositories\CategoriaProduto\CategoriaProdutoRepositoryInterface;

class DeleteCategoriaProdutoService
{
    public function __construct(
        private readonly CategoriaProdutoRepositoryInterface $categoriaProdutoRepository
    ) {}

    public function execute(int $id)
    {
        try {
            $result = $this->categoriaProdutoRepository->delete($id);

            if (!$result) {
                throw new \Exception('Record not found', 404);
            }

            return $result;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
