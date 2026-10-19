<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <a href="{{ route('admin.relatorios.index') }}"
            class="text-sm text-zinc-400 hover:text-red-500 transition">
            &larr; Voltar
        </a>

        <h1 class="text-2xl font-bold text-white my-6">
            Faturamento por período
        </h1>

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 mb-6">
            <p class="text-sm text-zinc-400">
                Faturamento total
            </p>

            <p class="text-3xl font-bold text-red-500 mt-2">
                R$ {{ number_format($totalFaturado, 2, ',', '.') }}
            </p>
        </div>

        <h2 class="text-lg font-semibold text-white mb-4">
            Histórico diário
        </h2>

        <div class="space-y-3">
            @forelse ($faturamento as $dia)
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4
                    flex items-center justify-between gap-4">

                    <div>
                        <h3 class="font-semibold text-white">
                            {{ \Carbon\Carbon::parse($dia->data)->format('d/m/Y') }}
                        </h3>

                        <p class="text-sm text-zinc-400 mt-1">
                            {{ $dia->quantidade_pedidos }}
                            {{ $dia->quantidade_pedidos == 1
                                ? 'pedido'
                                : 'pedidos' }}
                        </p>
                    </div>

                    <p class="text-red-500 font-bold">
                        R$ {{ number_format($dia->total, 2, ',', '.') }}
                    </p>
                </div>
            @empty
                <p class="text-zinc-400">
                    Nenhum faturamento encontrado.
                </p>
            @endforelse
        </div>
    </div>
</x-app-layout>
