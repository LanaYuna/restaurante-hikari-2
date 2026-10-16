<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $bebidas = Categoria::create(['descricao' => 'Bebidas']);
        $frangos = Categoria::create(['descricao' => 'Frango']);

        Produto::create([
            'nome' => 'Água com gás 350ml',
            'preco' => 4.00,
            'imagem' => 'produtos/agua-com-gas.jpg',
            'categoria_id' => $bebidas->id
        ]);

        Produto::create([
            'nome' => 'Água sem gás 350ml',
            'preco' => 4.00,
            'imagem' => 'produtos/agua-sem-gas.jpg',
            'categoria_id' => $bebidas->id
        ]);
    }
}