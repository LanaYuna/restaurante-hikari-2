<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Criando Categorias
        $lanches = Categoria::create(['descricao' => 'Lanches']);
        $bebidas = Categoria::create(['descricao' => 'Bebidas']);
        $frangos = Categoria::create(['descricao' => 'Frango']);

        // 2. Criando Produtos vinculados às categorias
        Produto::create([
            'nome' => 'X-Burguer Especial',
            'descricao' => 'Pão, carne artesanal, queijo cheddar e maionese da casa.',
            'preco' => 28.50,
            'imagem' => 'produtos/xburguer.jpg',
            'categoria_id' => $lanches->id
        ]);

        Produto::create([
            'nome' => 'Refrigerante Lata 350ml',
            'descricao' => 'Coca-Cola, Guaraná ou Sprite gelado.',
            'preco' => 6.00,
            'imagem' => 'produtos/refi.jpg',
            'categoria_id' => $bebidas->id
        ]);
    }
}