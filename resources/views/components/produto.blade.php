@props(['produto', 'isAdmin' => false])

<div class="bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg p-4 flex flex-col justify-between">
    <div>
        <img src="{{ asset($produto->imagem) }}" alt="{{ $produto->nome }}" class="h-32 w-full object-cover rounded-md mb-2">
        <h4 class="font-bold text-gray-900 text-lg">{{ $produto->nome }}</h4>
        <p class="text-gray-900 text-sm">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
    </div>

    @if($isAdmin)
        <div class="mt-4 flex gap-2 border-t pt-2">
            <a href="{{ route('admin.produtos.editar', $produto->id) }}" class="text-indigo-600 text-sm font-semibold">Editar</a>
    
            <form action="{{ route('admin.produtos.remover', $produto->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 text-sm font-semibold">Remover</button>
            </form>
        </div>
    @else
        <div class="mt-4">
            <button class="w-full bg-blue-600 text-white py-1 rounded-md text-sm">Adicionar ao Carrinho</button>
        </div>
    @endif
</div>