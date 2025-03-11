<?php

namespace App\Repositories\Produto;

use App\Models\Produto;
use App\Repositories\BaseRepository;

class ProdutoRepository extends BaseRepository implements ProdutoRepositoryInterface
{
    public function __construct(Produto $model)
    {
        parent::__construct($model);
    }
}
