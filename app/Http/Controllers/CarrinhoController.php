<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    
    public function index(){
        // Recupera os produtos e suas quantidades
        $carrinho = session()->get('carrinho', []);

        // Busca no banco os produtos que estão no carrinho
        $produtos = Produto::whereIn('id', array_keys($carrinho))->get();

        // Monta os itens e calcula os subtotais
        $itens = $produtos->map(function ($produto) use ($carrinho) {
        $quantidade = $carrinho[$produto->id];

        return [
            'produto' => $produto,
            'quantidade' => $quantidade,
            'subtotal' => $produto->preco * $quantidade,
        ];
    });

        // Soma os subtotais
        $total = $itens->sum('subtotal');

        return view('carrinho', compact('itens', 'total'));
    }


    public function adicionar($id)
    {
        // 1. Busca o produto no banco de dados
        $produto = Produto::findOrFail($id);

        // 2. Recupera o carrinho da sessão
        $carrinho = session()->get('carrinho', []);

        // 3. Verifica se o produto já está no carrinho
        if (isset($carrinho[$id])) {
            $carrinho[$id]++;
        } else {
            $carrinho[$id] = 1;
        }

        // 4. Salva o carrinho atualizado na sessão
        session()->put('carrinho', $carrinho);

        // 5. Retorna para a página anterior
        return back()->with(
            'success',
            'Produto adicionado ao carrinho!'
        );
    }

    public function remover($id){   
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
        }

        session()->put('carrinho', $carrinho);

        return redirect()->route('carrinho.index')
            ->with('success', 'Produto removido do carrinho!');
    }

    public function editar(Request $request, $id){
        // 1. Validar a quantidade enviada pelo formulário
        $dados = $request->validate([
            'quantidade' => 'required|integer|min:1|max:99',
        ]);

        // 2. Recuperar o carrinho da sessão
        $carrinho = session()->get('carrinho', []);

        // 3. Verificar se o produto está no carrinho
        if (!isset($carrinho[$id])) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Produto não encontrado no carrinho.');
        }

        // 4. Substituir a quantidade anterior pela nova
        $carrinho[$id] = $dados['quantidade'];

        // 5. Salvar as alterações
        session()->put('carrinho', $carrinho);

        // 6. Voltar para o carrinho
        return redirect()->route('carrinho.index')
            ->with('success', 'Quantidade atualizada com sucesso!');
    }
}
