<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <a href="{{ route('admin.relatorios.index') }}"
            class="text-sm text-zinc-400 hover:text-red-500 transition">
            &larr; Voltar
        </a>

        <h1 class="text-2xl font-bold text-white my-6">
            Produtos mais vendidos
        </h1>

        <div class="space-y-3">
            @forelse ($produtos as $produto)
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4
                    flex items-center justify-between gap-4">

                    <div>
                        <h2 class="font-semibold text-white">
                            {{ $produto->nome }}
                        </h2>

                        <p class="text-sm text-zinc-400 mt-1">
                            Unidades vendidas:
                            {{ $produto->quantidade_vendida }}
                        </p>
                    </div>

                    <span class="text-red-500 font-bold text-lg">
                        {{ $produto->quantidade_vendida }}
                    </span>
                </div>
            @empty
                <p class="text-zinc-400">
                    Nenhum produto vendido encontrado.
                </p>
            @endforelse
        </div>
    </div>
</x-app-layout>
