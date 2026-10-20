<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <a href="{{ route('admin.relatorios.index') }}"
            class="text-sm text-zinc-400 hover:text-red-500 transition">
            &larr; Voltar
        </a>

        <h1 class="text-2xl font-bold text-white my-6">
            Vendas por categoria
        </h1>

        <div class="space-y-3">
            @forelse ($categorias as $categoria)
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4
                    flex flex-col sm:flex-row sm:items-center
                    justify-between gap-4">

                    <div>
                        <h2 class="font-semibold text-white text-lg">
                            {{ $categoria->descricao }}
                        </h2>

                        <p class="text-sm text-zinc-400 mt-1">
                            Unidades vendidas:
                            {{ $categoria->quantidade_vendida }}
                        </p>
                    </div>

                    <div class="sm:text-right">
                        <p class="text-xs text-zinc-400">
                            Receita total
                        </p>

                        <p class="text-red-500 font-bold text-lg">
                            R$ {{ number_format(
                                $categoria->receita,
                                2,
                                ',',
                                '.'
                            ) }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-zinc-400">
                    Nenhuma venda por categoria encontrada.
                </p>
            @endforelse
        </div>
    </div>
</x-app-layout>