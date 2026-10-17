<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\AdmMenuController;
use App\Http\Controllers\Admin\AdmProdutoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/carrinho', function() {
    return view('carrinho');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/menu', [AdmMenuController::class, 'index'])->name('menu');

    Route::get('/admin/categorias/{categoria}/produtos/criar', [AdmProdutoController::class, 'criar'])->name('produtos.criar');

    Route::post('/produtos/add', [AdmProdutoController::class, 'adicionar'])->name('produtos.adicionar');
    
    Route::get('/produtos/{id}/edit', [AdmProdutoController::class, 'editar'])->name('produtos.editar');

    Route::put('/produtos/{id}', [AdmProdutoController::class, 'atualizar'] )->name('produtos.atualizar');

    Route::delete('/produtos/{id}', [AdmProdutoController::class, 'remover'])->name('produtos.remover');

});

require __DIR__.'/auth.php';
