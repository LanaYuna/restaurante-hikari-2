<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function(){

    Route::get('/itens', [ItemController::class, 'index'])->name('api.index');  

    Route::get('/carrinho', [ItemController::class, 'indexCarrinho'])->name('api.carrinho.index');

    Route::post('/carrinho/adicionar/{id}', [ItemController::class, 'adicionar'])->name('api.carrinho.adicionar');

    Route::delete('/carrinho/remover/{id}', [ItemController::class, 'remover'])->name('api.carrinho.remover');

    Route::put('/carrinho/editar/{id}', [ItemController::class, 'editar'])->name('api.carrinho.editar');
    
    Route::post('/carrinho/pedido', [ItemController::class, 'finalizar'])->name('api.carrinho.pedido');

});