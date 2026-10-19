<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdmRelatorioController extends Controller
{
    
    public function index(){
        return view('admin.relatorios.index');
    }

    public function exibirProdutosBaratos(){
        $produtos = DB::table('produtos')
            ->orderBy('preco', 'asc')
            ->limit(10)
            ->get();

        return view(
            'admin.relatorios.relatorioProdutosBaratos',
            compact('produtos')
        );
    }

    public function exibirProdutosVendidos(){
        $produtos = DB::table('produtos')
            ->join('itens_pedido', 'itens_pedido.produto_id', '=', 'produtos.id')
            ->join('pedidos', 'pedidos.id', '=', 'itens_pedido.pedido_id')
            ->whereIn('pedidos.status', ['pago'])
            ->select(
                'produtos.id',
                'produtos.nome',
                DB::raw('SUM(itens_pedido.quantidade) as quantidade_vendida')
            )
            ->groupBy('produtos.id', 'produtos.nome')
            ->orderByDesc('quantidade_vendida')
            ->limit(10)
            ->get();

        return view('admin.relatorios.relatorioProdutosVendidos', compact('produtos'));
    }

    public function exibirCategorias(){
       $categorias = DB::table('categorias')
        ->join('produtos', 'categorias.id', '=', 'produtos.categoria_id')
        ->join('itens_pedido', 'produtos.id', '=', 'itens_pedido.produto_id')
        ->join('pedidos', 'itens_pedido.pedido_id', '=', 'pedidos.id')
        ->whereIn('pedidos.status', ['pago'])
        ->select(
            'categorias.id',
            'categorias.descricao',
            DB::raw('SUM(itens_pedido.quantidade) as quantidade_vendida'),
            DB::raw('SUM(itens_pedido.subtotal) as receita')
        )
        ->groupBy('categorias.id', 'categorias.descricao')
        ->orderByDesc('receita')
        ->get();

        return view('admin.relatorios.relatorioCategorias', compact('categorias'));
    }

    public function exibirFaturamento(){
        $faturamento = DB::table('pedidos')
        ->whereIn('status', ['pago'])
        ->selectRaw('DATE(created_at) as data')
        ->selectRaw('SUM(total) as total')
        ->selectRaw('COUNT(*) as quantidade_pedidos')
        ->groupByRaw('DATE(created_at)')
        ->orderByDesc('data')
        ->get();

        $totalFaturado = $faturamento->sum('total');

        return view(
            'admin.relatorios.relatorioFaturamento',
            compact('faturamento', 'totalFaturado')
        );
    }

    public function exibirClientes(){
        $clientes = DB::table('users')
        ->join('pedidos', 'users.id', '=', 'pedidos.user_id')
        ->whereIn('pedidos.status', ['pago'])
        ->select(
            'users.id',
            'users.name',
            'users.email',
            DB::raw('COUNT(pedidos.id) as quantidade_pedidos'),
            DB::raw('SUM(pedidos.total) as total_gasto')
        )
        ->groupBy('users.id', 'users.name', 'users.email')
        ->orderByDesc('total_gasto')
        ->limit(10)
        ->get();

        return view('admin.relatorios.relatorioClientes', compact('clientes'));
    }
}
