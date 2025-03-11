<?php

use App\Models\CategoriaProduto;
use App\Repositories\CategoriaProduto\CategoriaProdutoRepository;
use App\Services\CategoriaProduto\UpdateCategoriaProdutoService;

describe('UpdateCategoriaProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(CategoriaProdutoRepository::class);
        $this->service = new UpdateCategoriaProdutoService($this->repository);
    });

    it('should update a record', function () {
        $this->repository->shouldReceive('update')->with(1, ['nome_categoria' => 'value'])->andReturn(new CategoriaProduto());
        $record = $this->service->execute(1, ['nome_categoria' => 'value']);
        expect($record)->toBeInstanceOf(CategoriaProduto::class);
    });

    it('should throw an exception when data is invalid', function () {
        $this->repository->shouldReceive('update')->with(1, ['nome_categoria' => 'value'])->andThrow(new \Exception());
        $this->service->execute(1, ['nome_categoria' => 'value']);
    })->throws(\Exception::class);
});
