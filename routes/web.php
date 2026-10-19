<?php

use App\Http\Controllers\admin\AdmRelatorioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\AdmMenuController;
use App\Http\Controllers\Admin\AdmProdutoController;
use App\Http\Controllers\Admin\AdmCategoriaController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\EnderecoController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('menu')
        : redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    // Menu do usuário
    Route::get('/menu', [MenuController::class, 'index'])
        ->name('menu');

    // Endereco
    Route::get('/enderecos', [EnderecoController::class, 'index'])
        ->name('enderecos.index');

    Route::get('/enderecos/criar', [EnderecoController::class, 'criar'])
        ->name('enderecos.criar');

    Route::post('/enderecos/adicionar', [EnderecoController::class, 'adicionar'])
        ->name('enderecos.adicionar');

    Route::get('/enderecos/{id}/editar', [EnderecoController::class, 'edit'])
        ->name('enderecos.edit');

    Route::put('/enderecos/{id}', [EnderecoController::class, 'update'])
        ->name('enderecos.update');

    Route::delete('/enderecos/remover/{id}', [EnderecoController::class, 'remove'])
        ->name('enderecos.remove');
        
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

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile/delete', [ProfileController::class, 'confirmDelete'])
        ->name('profile.confirmDelete');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Administração
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin')
        ->group(function () {

        Route::get('/menu', [AdmMenuController::class, 'index'])
            ->name('menu');
        
        // Produtos

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

        // Categorias

        Route::get('/categoria/criar', 
            [AdmCategoriaController::class, 'criar'
        ])->name('categoria.criar');

        Route::post('/categoria/add', 
            [AdmCategoriaController::class, 'adicionar'
        ])->name('categoria.adicionar');

        Route::get('/categoria/{id}/edit', [
            AdmCategoriaController::class, 'editar'
        ])->name('categoria.editar');

        Route::put('/categoria/{id}/atualizar', [
            AdmCategoriaController::class, 'atualizar'
        ])->name('categoria.atualizar');

        Route::delete('/categoria/{id}', 
            [AdmCategoriaController::class, 'remover'
        ])->name('categoria.remover');

        // Relatorios

        Route::get('/relatorio',
            [AdmRelatorioController::class, 'index'
        ])->name('relatorio.index');


    });
});

require __DIR__.'/auth.php';
