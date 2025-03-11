<?php

use App\Models\Produto;
use App\Repositories\Produto\ProdutoRepository;
use App\Services\Produto\UpdateProdutoService;

describe('UpdateProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(ProdutoRepository::class);
        $this->service = new UpdateProdutoService($this->repository);
    });

    it('should update a record', function () {
        $this->repository->shouldReceive('update')->with(1, ['nome_produto' => 'value'])->andReturn(new Produto());
        $record = $this->service->execute(1, ['nome_produto' => 'value']);
        expect($record)->toBeInstanceOf(Produto::class);
    });

    it('should throw an exception when data is invalid', function () {
        $this->repository->shouldReceive('update')->with(1, ['nome_produto' => 'value'])->andThrow(new \Exception());
        $this->service->execute(1, ['nome_produto' => 'value']);
        $this->service->execute(1, ['nome_categoria' => 'value']);
    })->throws(\Exception::class);
});
