<?php

use App\Http\Controllers\CategoriaProdutoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categorias-produtos', CategoriaProdutoController::class);
