<?php

namespace App\Repositories\CategoriaProduto;

use App\Models\CategoriaProduto;
use App\Repositories\BaseRepository;

class CategoriaProdutoRepository extends BaseRepository implements CategoriaProdutoRepositoryInterface
{
    public function __construct(CategoriaProduto $model)
    {
        parent::__construct($model);
    }
}
