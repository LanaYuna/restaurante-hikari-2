<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;

class AdmProdutoController extends Controller
{
    public function editar($id){
        $produto = Produto::findOrFail($id);
        return view('admin.editarProduto', compact('produto'));
    }

    public function atualizar(Request $request, $id){
        $produto = Produto::findOrFail($id);

        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $caminho = $request->file('imagem')
                ->store('produtos', 'public');

            $produto->imagem = $caminho;
        }

            $produto->nome = $dados['nome'];
            $produto->preco = $dados['preco'];

            $produto->save();

            return redirect()
                ->route('admin.menu', $produto->id)
                ->with('success', 'Produto atualizado com sucesso!');
    }
    
    public function criar(){
         return view('admin.adicionarProduto');
    }

    public function adicionar(Request $request){
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

    }

    public function remover(Request $request){
    }
}
