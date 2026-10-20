<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

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
            ->route('admin.menu')
            ->with('success', 'Produto atualizado com sucesso!');
    }
    
    public function criar($categoria){
        $categoria = Categoria::findOrFail($categoria);

        return view('admin.adicionarProduto', compact('categoria'));
    }

    public function adicionar(Request $request){

        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        if ($request->hasFile('imagem')) {
            $caminho = $request->file('imagem')
                ->store('produtos', 'public');

            $dados['imagem'] = $caminho;
        }

        Produto::create($dados);

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function remover($id){
        $produto = Produto::findOrFail($id);

        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Produto removido com sucesso!');
    }
}
