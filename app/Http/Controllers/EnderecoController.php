<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function index(Request $request)
    {
        $enderecos = $request->user()
            ->enderecos()
            ->get();

        return view('enderecos.index', compact('enderecos'));
    }

    public function criar(){
        return view('enderecos.criarEndereco');
    }

    public function adicionar(Request $request){
        $dados = $request->validate([
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:30',
            'complemento' => 'nullable|string|max:255',
        ]);

        $request->user()->enderecos()->create($dados);

        return redirect()
            ->route('enderecos.index')
            ->with('success', 'Endereço cadastrado com sucesso!');
    }

    public function edit(Request $request, int $id)
    {
        $endereco = $request->user()
            ->enderecos()
            ->findOrFail($id);

        return view('enderecos.edit', compact('endereco'));
    }

    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'rua' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:30'],
            'complemento' => ['nullable', 'string', 'max:255'],
        ]);

        $endereco = $request->user()
            ->enderecos()
            ->findOrFail($id);

        $endereco->update($dados);

        return redirect()
            ->route('enderecos.index')
            ->with('success', 'Endereço atualizado com sucesso!');
    }

    public function remove(Request $request, $id){
        $endereco = $request->user()
        ->enderecos()
        ->findOrFail($id);

        $endereco->delete();

        return redirect()
            ->route('enderecos.index')
            ->with('success', 'Endereço removido com sucesso!');
    }
}