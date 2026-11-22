<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ItemController extends Controller
{
    public function login(Request $request){
        
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credenciais['email'])->first();

        if (!$user || !Hash::check($credenciais['password'], $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function index(): JsonResponse{
        return response()->json(Produto::all(), 200);
    }
    
    public function indexCarrinho(): JsonResponse {
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

        return response()->json([
            'itens' => $itens,
            'total' => $total
        ], 200);
    }

    public function adicionar($id): JsonResponse{
        Produto::findOrFail($id);

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            $carrinho[$id]++;
        } else {
            $carrinho[$id] = 1;
        }

        session()->put('carrinho', $carrinho);

        return response()->json(null, 204);
    }

    public function remover($id): JsonResponse{
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
        }

        session()->put('carrinho', $carrinho);

        return response()->json(null, 204);
    }

    public function editar(Request $request, $id): JsonResponse{
        $dados = $request->validate([
            'quantidade' => 'required|integer|min:1|max:99',
        ]);

        $carrinho = session()->get('carrinho', []);

        if (!isset($carrinho[$id])) {
            return response()->json([
                'message' => 'Produto não encontrado no carrinho'
            ], 404);
        }

        $carrinho[$id] = $dados['quantidade'];

        session()->put('carrinho', $carrinho);

        return response()->json(
            ['message' => 'Quantidade atualizada com sucesso'],
            200
        );
    }

    public function finalizar(Request $request): JsonResponse{
        
        $dados = $request->validate([
            'forma_pagamento' => [
                'required',
                Rule::in(['debito', 'credito', 'pix', 'dinheiro']),
            ],
        ]);

        $userId = $request->user()->id;

        $carrinho = session()->get('carrinho', []);
    
        if (empty($carrinho)) {
            return response()->json(
                ['message' => 'O carrinho está vazio'],
                400
            );
        }

        DB::transaction(function () use ($carrinho, $dados, $userId) {
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
                'user_id' => $userId,
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

        return response()->json(
            ['message' => 'Pedido realizado com sucesso'],
            200
        );
    }

}


