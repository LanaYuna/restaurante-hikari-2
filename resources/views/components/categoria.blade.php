@props(['categoria', 'isAdmin' => false])

<div class="mb-8">
    <h3 class="text-2xl font-bold text-gray-800 border-b pb-2 mb-4">
        {{ $categoria->nome }}

        @if($isAdmin)
            // exibir botoes crud

        @endif
    </h3>

    <!-- Grade de Produtos daquela Categoria -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($categoria->produtos as $produto)
            <!-- Chamando o nosso componente de card de produto -->
            <x-produto :produto="$produto" :isAdmin="$isAdmin" />
        @empty
            <p class="text-gray-500 italic col-span-full">Nenhum produto cadastrado nesta categoria no momento.</p>
        @endforelse
    </div>
</div>