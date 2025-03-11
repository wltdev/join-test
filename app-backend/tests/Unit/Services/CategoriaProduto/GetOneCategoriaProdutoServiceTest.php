<?php

use App\Models\CategoriaProduto;
use App\Repositories\CategoriaProduto\CategoriaProdutoRepository;
use App\Services\CategoriaProduto\GetOneCategoriaProdutoService;

describe('GetOneCategoriaProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(CategoriaProdutoRepository::class);
        $this->service = new GetOneCategoriaProdutoService($this->repository);
    });

    it('should get a record by id', function () {
        $this->repository->shouldReceive('findById')->with(1)->andReturn(new CategoriaProduto());
        $record = $this->service->execute(1);
        expect($record)->toBeInstanceOf(CategoriaProduto::class);
    });

    it('should throw an exception when data is invalid', function () {
        $this->repository->shouldReceive('findById')->with(1)->andReturn(null);

        expect(fn() => $this->service->execute(1))->toThrow(new \Exception('Record not found'));
    });
});
