<?php

use App\Models\Produto;
use App\Repositories\Produto\ProdutoRepository;
use App\Services\Produto\CreateProdutoService;

describe('CreateProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(ProdutoRepository::class);
        $this->service = new CreateProdutoService($this->repository);
    });

    it('should create a record', function () {
        $data = [
            'id_categoria_produto' => 1,
            'nome_produto' => 'value',
            'valor_produto' => 10.00
        ];
        $this->repository->shouldReceive('create')->with($data)->andReturn(new Produto());
        $record = $this->service->execute($data);

        expect($record)->toBeInstanceOf(Produto::class);
    });

    it('should throw an exception when data is invalid', function () {
        $this->repository->shouldReceive('create')->with(['nome_produto' => 'value'])->andThrow(new \Exception());
        $this->service->execute(['nome_produto' => 'value']);
    })->throws(\Exception::class);
});
