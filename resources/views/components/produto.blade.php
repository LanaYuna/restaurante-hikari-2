@props(['produto', 'isAdmin' => false])

<div class="bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg p-4 flex flex-col justify-between w-64 my-5">
    <div>
        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="h-32 w-32 object-cover rounded-md mb-2">
        <h4 class="font-bold text-white text-lg">{{ $produto->nome }}</h4>
        <p class="text-white text-sm">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
    </div>

    @if($isAdmin)
        <div class="mt-4 flex gap-2 border-t pt-2">
            <a 
                href="{{ route('admin.produtos.editar', $produto->id) }}" 
                class="text-indigo-600 text-sm font-semibold">
                Editar
            </a>
    
            <form 
                action="{{ route('admin.produtos.remover', $produto->id) }}" 
                method="POST"  
                onsubmit="return confirm('Deseja realmente remover este produto?')"
            >

                @csrf
                @method('DELETE')

                <button 
                    type="submit" class="text-red-600 text-sm font-semibold">
                    Remover
                </button>

            </form>
        </div>
    @else
        <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST">
            @csrf

            <button class="bg-indigo-700" type="submit">
                Adicionar ao carrinho
            </button>
        </form>
    @endif
</div>