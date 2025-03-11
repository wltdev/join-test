<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaProdutoRequest;
use App\Services\CategoriaProduto\CreateCategoriaProdutoService;
use App\Services\CategoriaProduto\DeleteCategoriaProdutoService;
use App\Services\CategoriaProduto\GetAllCategoriaProdutoService;
use App\Services\CategoriaProduto\GetOneCategoriaProdutoService;
use App\Services\CategoriaProduto\UpdateCategoriaProdutoService;

class CategoriaProdutoController
{
    public function __construct(
        private readonly GetAllCategoriaProdutoService $getAllCategoriaProdutoService,
        private readonly GetOneCategoriaProdutoService $getOneCategoriaProdutoService,
        private readonly CreateCategoriaProdutoService $createCategoriaProdutoService,
        private readonly UpdateCategoriaProdutoService $updateCategoriaProdutoService,
        private readonly DeleteCategoriaProdutoService $deleteCategoriaProdutoService,
    ) {}

    public function index()
    {
        $records = $this->getAllCategoriaProdutoService->execute();

        return response()->json([
            'success' => true,
            'data' => $records
        ]);
    }

    public function show(int $id)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $this->getOneCategoriaProdutoService->execute($id)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function store(CategoriaProdutoRequest $request)
    {
        try {
            $payload = $request->validated();
            $record = $this->createCategoriaProdutoService->execute($payload);

            return response()->json([
                'success' => true,
                'data' => $record
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function update(CategoriaProdutoRequest $request, int $id)
    {
        try {
            $payload = $request->validated();

            $record = $this->updateCategoriaProdutoService->execute($id, $payload);

            return response()->json([
                'success' => true,
                'data' => $record
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->deleteCategoriaProdutoService->execute($id);

            return response()->json([
                'success' => true,
                'data' => []
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
