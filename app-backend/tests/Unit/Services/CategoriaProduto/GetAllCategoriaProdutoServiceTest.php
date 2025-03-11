<?php

use App\Models\CategoriaProduto;
use App\Repositories\CategoriaProduto\CategoriaProdutoRepository;
use App\Services\CategoriaProduto\GetOneCategoriaProdutoService;
use App\Services\CategoriaProduto\GetAllCategoriaProdutoService;

describe('GetAllCategoriaProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(CategoriaProdutoRepository::class);
        $this->service = new GetAllCategoriaProdutoService($this->repository);
    });

    it('should get all records', function () {
        $this->repository->shouldReceive('getAll')->andReturn(collect([new CategoriaProduto()]));
        $records = $this->service->execute();
        expect($records)->toHaveCount(1);
    });
});
