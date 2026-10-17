<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\AdmMenuController;
use App\Http\Controllers\Admin\AdmProdutoController;
use App\Http\Controllers\CarrinhoController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('menu')
        : redirect()->route('login');
});

// Todas as rotas abaixo exigem login.
Route::middleware('auth')
    ->group(function () {

    // Menu do usuário
    Route::get('/menu', [MenuController::class, 'index'])
        ->name('menu');

    // Carrinho
    Route::post('/carrinho/adicionar/{id}', [
        CarrinhoController::class, 'adicionar'
    ])->name('carrinho.adicionar');

    Route::get('/carrinho', [CarrinhoController::class, 'index'])
        ->name('carrinho.index');

    Route::delete('/carrinho/remover/{id}', [
        CarrinhoController::class, 'remover'
    ])->name('carrinho.remover');

    Route::patch('/carrinho/editar/{id}', [
        CarrinhoController::class, 'editar'
    ])->name('carrinho.editar');

    // Perfil
     Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    // Editar perfil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Tela de confirmação para excluir a conta
    Route::get('/profile/delete', [ProfileController::class, 'confirmDelete'])
        ->name('profile.confirmDelete');

    // Excluir conta
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Administração
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin')
        ->group(function () {

        Route::get('/menu', [AdmMenuController::class, 'index'])
            ->name('menu');

        Route::get('/categorias/{categoria}/produtos/criar', [
            AdmProdutoController::class, 'criar'
        ])->name('produtos.criar');

        Route::post('/produtos/add', [
            AdmProdutoController::class, 'adicionar'
        ])->name('produtos.adicionar');

        Route::get('/produtos/{id}/edit', [
            AdmProdutoController::class, 'editar'
        ])->name('produtos.editar');

        Route::put('/produtos/{id}', [
            AdmProdutoController::class, 'atualizar'
        ])->name('produtos.atualizar');

        Route::delete('/produtos/{id}', [
            AdmProdutoController::class, 'remover'
        ])->name('produtos.remover');
    });
});

require __DIR__.'/auth.php';
