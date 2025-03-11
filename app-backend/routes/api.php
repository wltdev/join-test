<?php

use App\Http\Controllers\CategoriaProdutoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categorias-produtos', CategoriaProdutoController::class);
Route::apiResource('produtos', ProdutoController::class);
