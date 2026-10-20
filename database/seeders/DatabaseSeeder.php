<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $bebida = Categoria::create(['descricao' => 'Bebida']);
        $carne = Categoria::create(['descricao' => 'Carne']);
        $frango = Categoria::create(['descricao' => 'Frango']);

        Produto::insert([
            [
                'nome' => 'Água com gás',
                'preco' => 4.00,
                'imagem' => 'produtos/agua-com-gas.jpg',
                'categoria_id' => $bebida->id,
            ],
            [
                'nome' => 'Água sem gás',
                'preco' => 4.00,
                'imagem' => 'produtos/agua-sem-gas.jpg',
                'categoria_id' => $bebida->id,
            ],
            [
                'nome' => 'Coca-Cola lata',
                'preco' => 6.50,
                'imagem' => 'produtos/coca-cola-lata.jpg',
                'categoria_id' => $bebida->id,
            ],
            [
                'nome' => 'Suco de laranja',
                'preco' => 8.00,
                'imagem' => 'produtos/suco-de-laranja.jpg',
                'categoria_id' => $bebida->id,
            ],
           
        ]);

        Produto::insert([
            [
                'nome' => 'Carne com legumes',
                'preco' => 64.00,
                'imagem' => 'produtos/carne-com-legumes.jpg',
                'categoria_id' => $carne->id,
            ],
            [
                'nome' => 'Filé mignon grelhado',
                'preco' => 90.00,
                'imagem' => 'produtos/file-mignon-grelhado.jpg',
                'categoria_id' => $carne->id,
            ],
            [
                'nome' => 'Gyukatsu',
                'preco' => 85.00,
                'imagem' => 'produtos/gyukatsu.jpg',
                'categoria_id' => $carne->id,
            ],
        ]);

        Produto::insert([
      
            [
                'nome' => 'Frango Xadrez',
                'preco' => 60.00,
                'imagem' => 'produtos/frango-xadrez.jpg',
                'categoria_id' => $frango->id,
            ],
            [
                'nome' => 'Frango Agridoce',
                'preco' => 67.00,
                'imagem' => 'produtos/file-mignon-grelhado.jpg',
                'categoria_id' => $frango->id,
            ],
            [
                'nome' => 'Frango ao Molho Curry',
                'preco' => 61.00,
                'imagem' => 'produtos/frango-ao-molho-curry.jpg',
                'categoria_id' => $frango->id,
            ],
            [
                'nome' => 'Frango Karaguê',
                'preco' => 62.00,
                'imagem' => 'produtos/frango-karague.jpg',
                'categoria_id' => $frango->id,
            ],
        ]);
    }
}