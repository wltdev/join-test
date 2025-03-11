<?php

use App\Models\CategoriaProduto;
use App\Repositories\CategoriaProduto\CategoriaProdutoRepository;

describe('CategoriaProdutoRepositoryTest', function () {
    beforeEach(function () {
        $this->model = mock(CategoriaProduto::class);
        $this->repository = new CategoriaProdutoRepository($this->model);
    });

    beforeEach(function () {
        Mockery::close();
    });

    it('should return all records', function () {
        $this->model->shouldReceive('get')->andReturn(collect([new CategoriaProduto()]));
        $records = $this->repository->getAll();

        expect($records)->toHaveCount(1);
    });

    it('should return a record by id', function () {
        $this->model->shouldReceive('find')->with(1)->andReturn(new CategoriaProduto());
        $record = $this->repository->findById(1);

        expect($record)->toBeInstanceOf(CategoriaProduto::class);
    });

    it('should return a record by field', function () {
        $this->model->shouldReceive('where')->with('nome_categoria', 'value')->andReturnSelf();
        $this->model->shouldReceive('first')->andReturn(new CategoriaProduto());
        $record = $this->repository->findByField('nome_categoria', 'value');

        expect($record)->toBeInstanceOf(CategoriaProduto::class);
    });

    it('should create a record', function () {
        $this->model->shouldReceive('create')->with(['nome_categoria' => 'value'])->andReturn(new CategoriaProduto());
        $record = $this->repository->create(['nome_categoria' => 'value']);
        expect($record)->toBeInstanceOf(CategoriaProduto::class);
    });

    it('should update a record', function () {
        $this->model->shouldReceive('find')->with(1)->andReturn(new CategoriaProduto());
        $this->model->shouldReceive('update')->with(['nome_categoria' => 'value'])->andReturn(new CategoriaProduto());
        $record = $this->repository->update(1, ['nome_categoria' => 'value']);
        expect($record)->toBeInstanceOf(CategoriaProduto::class);
    });

    it('should delete a record', function () {
        $modelMock = mock(CategoriaProduto::class);
        $this->model->shouldReceive('find')->with(1)->andReturn($modelMock);
        $modelMock->shouldReceive('delete')->andReturn(true);
        $result = $this->repository->delete(1);
        expect($result)->toBeTrue();
    });
});
