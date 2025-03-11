<?php

use App\Models\Produto;
use App\Repositories\Produto\ProdutoRepository;
use App\Services\Produto\GetOneProdutoService;

describe('GetOneProdutoServiceTest', function () {
    beforeEach(function () {
        $this->repository = mock(ProdutoRepository::class);
        $this->service = new GetOneProdutoService($this->repository);
    });

    it('should get a record by id', function () {
        $this->repository->shouldReceive('findById')->with(1)->andReturn(new Produto());
        $record = $this->service->execute(1);
        expect($record)->toBeInstanceOf(Produto::class);
    });

    it('should throw an exception when data is invalid', function () {
        $this->repository->shouldReceive('findById')->with(1)->andReturn(null);

        expect(fn() => $this->service->execute(1))->toThrow(new \Exception('Record not found'));
    });
});
