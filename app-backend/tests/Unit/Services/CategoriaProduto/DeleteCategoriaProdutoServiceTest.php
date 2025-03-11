<?php

use App\Models\CategoriaProduto;
use App\Repositories\CategoriaProduto\CategoriaProdutoRepository;
use App\Services\CategoriaProduto\DeleteCategoriaProdutoService;

describe('DeleteCategoriaProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(CategoriaProdutoRepository::class);
        $this->service = new DeleteCategoriaProdutoService($this->repository);
    });

    it('should delete a record', function () {
        $this->repository->shouldReceive('delete')->with(1)->andReturn(true);
        $result = $this->service->execute(1);
        expect($result)->toBeTrue();
    });
});
