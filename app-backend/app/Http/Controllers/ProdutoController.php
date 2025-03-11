<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Services\Produto\CreateProdutoService;
use App\Services\Produto\DeleteProdutoService;
use App\Services\Produto\GetAllProdutoService;
use App\Services\Produto\GetOneProdutoService;
use App\Services\Produto\UpdateProdutoService;

class ProdutoController
{
    public function __construct(
        private readonly GetAllProdutoService $getAllProdutoService,
        private readonly GetOneProdutoService $getOneProdutoService,
        private readonly CreateProdutoService $createProdutoService,
        private readonly UpdateProdutoService $updateProdutoService,
        private readonly DeleteProdutoService $deleteProdutoService,
    ) {}

    public function index()
    {
        $records = $this->getAllProdutoService->execute();

        return response()->json([
            'success' => true,
            'data' => ProdutoResource::collection($records)
        ]);
    }

    public function show(int $id)
    {
        try {
            $record = $this->getOneProdutoService->execute($id);

            return response()->json([
                'success' => true,
                'data' => new ProdutoResource($record)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function store(ProdutoRequest $request)
    {
        try {
            $payload = $request->validated();
            $record = $this->createProdutoService->execute($payload);

            return response()->json([
                'success' => true,
                'data' => new ProdutoResource($record)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function update(ProdutoRequest $request, int $id)
    {
        try {
            $payload = $request->validated();

            $record = $this->updateProdutoService->execute($id, $payload);

            return response()->json([
                'success' => true,
                'data' => new ProdutoResource($record)
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
            $this->deleteProdutoService->execute($id);

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
