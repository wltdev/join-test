<?php

use App\Models\Produto;
use App\Repositories\Produto\ProdutoRepository;
use App\Services\Produto\DeleteProdutoService;

describe('DeleteProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(ProdutoRepository::class);
        $this->service = new DeleteProdutoService($this->repository);
    });

    it('should delete a record', function () {
        $this->repository->shouldReceive('delete')->with(1)->andReturn(true);
        $result = $this->service->execute(1);
        expect($result)->toBeTrue();
    });
});
