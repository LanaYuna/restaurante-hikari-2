@props(['categoria', 'isAdmin' => false])

<div class="mb-8">
    <h3 class="text-3xl font-bold text-white pb-2 mb-4 mr-4 inline-block">
        {{ $categoria->descricao }}
    </h3>

    @if($isAdmin)
        <button class="bg-blue-600">Editar</button>
        <button class="bg-red-600">Remover</button>
    @endif

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($categoria->produtos as $produto)
            <x-produto :produto="$produto" :isAdmin="$isAdmin" />
        @empty
            @if($isAdmin)
                <a href="{{ route('admin.produtos.criar') }}" class="bg-blue-600 w-64">Adicionar novo produto</a>
            @else
                <p class="text-gray-500 italic col-span-full">Nenhum produto cadastrado nesta categoria no momento.</p>
            @endif
        @endforelse
    </div>
</div>