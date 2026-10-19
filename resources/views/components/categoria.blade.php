@props(['categoria', 'isAdmin' => false])

<div class="mb-8">
    <h3 class="text-3xl font-bold text-white pb-2 mb-4 mr-4">
        {{ $categoria->descricao }}
    </h3>

    @if($isAdmin)
        <div class="flex gap-2 my-5">
            <a 
                href="{{ route('admin.categoria.editar', $categoria->id) }}"
                class= "bg-indigo-700 w-30 font-medium text-sm px-3 py-2 rounded-lg hover:bg-indigo-800 transition">
                Editar categoria
            </a>

            <form 
                action="{{ route('admin.categoria.remover', $categoria->id) }}" 
                method="POST"  
                onsubmit="return confirm('Deseja realmente remover esta categoria?')">

                @csrf
                @method('DELETE')

                <button class="bg-red-600 w-30 font-medium text-sm px-3 py-2 rounded-lg hover:bg-red-700 transition">
                    Remover categoria
                </button>

            </form>
        </div>

        <a 
            href="{{ route('admin.produtos.criar', $categoria->id) }}" 
            class="bg-indigo-700 w-6 font-medium text-sm px-3 py-2 rounded-lg hover:bg-indigo-800 transition">
            Adicionar novo produto
        </a>
    @endif

    <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($categoria->produtos as $produto)
            <x-produto :produto="$produto" :isAdmin="$isAdmin" />
        @empty
            <p class="text-gray-500 italic col-span-full">Nenhum produto cadastrado nesta categoria no momento.</p>

        @endforelse
    </div>
</div>