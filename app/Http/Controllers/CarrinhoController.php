<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CarrinhoController extends Controller
{
    
    public function index(){
        $carrinho = session()->get('carrinho', []);

        $produtos = Produto::whereIn('id', array_keys($carrinho))->get();

        $itens = $produtos->map(function ($produto) use ($carrinho) {
            $quantidade = $carrinho[$produto->id];

            return [
                'produto' => $produto,
                'quantidade' => $quantidade,
                'subtotal' => $produto->preco * $quantidade,
            ];
        });

        $total = $itens->sum('subtotal');

        return view('carrinho', compact('itens', 'total'));
    }


    public function adicionar($id)
    {
        $produto = Produto::findOrFail($id);

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            $carrinho[$id]++;
        } else {
            $carrinho[$id] = 1;
        }

        session()->put('carrinho', $carrinho);

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
        $dados = $request->validate([
            'quantidade' => 'required|integer|min:1|max:99',
        ]);

        $carrinho = session()->get('carrinho', []);

        if (!isset($carrinho[$id])) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Produto não encontrado no carrinho.');
        }

        $carrinho[$id] = $dados['quantidade'];

        session()->put('carrinho', $carrinho);

        return redirect()->route('carrinho.index')
            ->with('success', 'Quantidade atualizada com sucesso!');
    }

    public function finalizar(Request $request){
        $dados = $request->validate([
            'forma_pagamento' => [
                'required',
                Rule::in(['debito', 'credito', 'pix', 'dinheiro']),
            ],
        ]);

        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()
                ->route('carrinho.index')
                ->with('erro', 'Seu carrinho está vazio.');
        }

        DB::transaction(function () use ($carrinho, $dados) {
            $produtos = [];
            $total = 0;

            foreach ($carrinho as $produtoId => $quantidade) {
                $quantidade = filter_var(
                    $quantidade,
                    FILTER_VALIDATE_INT,
                    ['options' => ['min_range' => 1, 'max_range' => 99]]
                );

                if ($quantidade === false) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'carrinho' => 'Existe uma quantidade inválida no carrinho.',
                    ]);
                }

                $produto = Produto::findOrFail($produtoId);

                $subtotal = (float) $produto->preco * $quantidade;

                $produtos[] = [
                    'produto' => $produto,
                    'quantidade' => $quantidade,
                    'subtotal' => $subtotal,
                ];

                $total += $subtotal;
            }

            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'forma_pagamento' => $dados['forma_pagamento'],
                'status' => 'pago',
            ]);

            foreach ($produtos as $item) {
                $pedido->itens()->create([
                    'produto_id' => $item['produto']->id,
                    'nome_produto' => $item['produto']->nome,
                    'preco_unitario' => $item['produto']->preco,
                    'quantidade' => $item['quantidade'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

        });

        session()->forget('carrinho');

        return redirect()
            ->route('menu')
            ->with('success', 'Pedido realizado com sucesso!');
    }
}
