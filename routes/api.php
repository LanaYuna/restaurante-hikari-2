<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;

Route::post('/login', [ItemController::class, 'login']);

Route::get('/itens', [ItemController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/carrinho', [ItemController::class, 'indexCarrinho']);

    Route::post('/carrinho/adicionar/{id}', [ItemController::class, 'adicionar']);

    Route::delete('/carrinho/remover/{id}', [ItemController::class, 'remover']);

    Route::put('/carrinho/editar/{id}', [ItemController::class, 'editar']);

    Route::post('/carrinho/pedido', [ItemController::class, 'finalizar']);
});