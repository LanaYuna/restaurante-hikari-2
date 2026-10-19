<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class AdmRelatorioController extends Controller
{
    
    public function index(){
        return view('admin.relatorios.index');
    }

    public function exibirProdutosBaratos(){
        $produtos = Produto::query()
            ->orderBy('preco', 'asc')
            ->limit(10)
            ->get();

        return view(
            'admin.relatorios.relatorioProdutosBaratos',
            compact('produtos')
        );
    }

    public function exibirProdutosVendidos(){
        $produtos = Produto::query();

        return view('admin.relatorios.relatorioProdutosVendidos');
    }

    public function exibirCategorias(){
        return view('admin.relatorios.relatorioCategorias');
    }

    public function exibirFaturamento(){
        return view('admin.relatorios.relatorioFaturamento');
    }

    public function exibirClientes(){
        return view('admin.relatorios.relatorioClientes');
    }
}
