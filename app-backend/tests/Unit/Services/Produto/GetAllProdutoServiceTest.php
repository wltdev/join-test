<?php

use App\Models\Produto;
use App\Repositories\Produto\ProdutoRepository;
use App\Services\Produto\GetAllProdutoService;

describe('GetAllProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(ProdutoRepository::class);
        $this->service = new GetAllProdutoService($this->repository);
    });

    it('should get all records', function () {
        $this->repository->shouldReceive('getAll')->andReturn(collect([new Produto()]));
        $records = $this->service->execute();
        expect($records)->toHaveCount(1);
    });
});
