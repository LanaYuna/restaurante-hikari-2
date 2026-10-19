<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <h1 class="text-2xl font-bold text-white mb-6">
            Produtos mais baratos
        </h1>

        <div class="space-y-3">
            @forelse ($produtos as $produto)
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4">
                    <h2 class="font-semibold text-white">
                        {{ $produto->nome }}
                    </h2>

                    <p class="text-zinc-400">
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                    </p>
                </div>
            @empty
                <p class="text-zinc-400">
                    Nenhum produto encontrado.
                </p>
            @endforelse
        </div>
    </div>
</x-app-layout>