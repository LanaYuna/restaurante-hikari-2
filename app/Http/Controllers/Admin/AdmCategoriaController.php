<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class AdmCategoriaController extends Controller
{
    public function criar(){
        return view('admin.adicionarCategoria');
    }

    public function adicionar(Request $request){
        $dados = $request->validate([
            'descricao' => 'required|string|max:255'
        ]);

        Categoria::create($dados);

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function editar($id){
        $categoria = Categoria::findOrFail($id);
        return view('admin.editarCategoria', compact('categoria'));
    }

    public function atualizar(Request $request, $id){
        $categoria = Categoria::findOrFail($id);

        $dados = $request->validate([
            'descricao' => 'required|string|max:255',
        ]);

        $categoria->descricao = $dados['descricao'];

        $categoria->save();

        return redirect()
            ->route('admin.menu', $categoria->id)
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function remover($id){
        $categoria = Categoria::findOrFail($id);        

        if ($categoria->produtos()->exists()) {
            return back()->with(
                'erro',
                'Não pode excluir uma categoria com produtos'
            );
        }

        $categoria->delete();

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Produto removido com sucesso!');
    }
}
