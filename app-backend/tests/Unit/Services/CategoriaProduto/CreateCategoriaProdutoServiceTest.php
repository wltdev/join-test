<?php

use App\Models\CategoriaProduto;
use App\Repositories\CategoriaProduto\CategoriaProdutoRepository;
use App\Services\CategoriaProduto\CreateCategoriaProdutoService;

describe('CreateCategoriaProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(CategoriaProdutoRepository::class);
        $this->service = new CreateCategoriaProdutoService($this->repository);
    });

    it('should create a record', function () {
        $this->repository->shouldReceive('create')->with(['nome_categoria' => 'value'])->andReturn(new CategoriaProduto());
        $record = $this->service->execute(['nome_categoria' => 'value']);
        expect($record)->toBeInstanceOf(CategoriaProduto::class);
    });

    it('should throw an exception when data is invalid', function () {
        $this->repository->shouldReceive('create')->with(['nome_categoria' => 'value'])->andThrow(new \Exception());
        $this->service->execute(['nome_categoria' => 'value']);
    })->throws(\Exception::class);
});
