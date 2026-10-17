<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Meu Carrinho</h1>
            <a href="{{ route('menu') }}" class="text-sm font-medium text-gray-400 hover:text-red-500 transition">
                &larr; Voltar ao Cardápio
            </a>
        </div>

        @if ($itens->isEmpty())
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-12 text-center shadow-xl">
                <p class="text-gray-400 text-lg mb-6">Seu carrinho está vazio.</p>
            </div>
        @else
            <div class="bg-gray-900 border border-gray-800 rounded-2xl shadow-xl overflow-hidden divide-y divide-gray-800">
                @foreach ($itens as $item)
                    <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 transition hover:bg-gray-800/50">
                        
                        <div class="space-y-1">
                            <h2 class="text-xl font-bold text-white">{{ $item['produto']->nome }}</h2>
                            <p class="text-sm text-gray-400">
                                Preço unitário: <span class="text-gray-200">R$ {{ number_format($item['produto']->preco, 2, ',', '.') }}</span>
                            </p>
                            <p class="text-sm font-semibold text-red-500">
                                Subtotal: R$ {{ number_format($item['subtotal'], 2, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end pt-4 sm:pt-0 border-t sm:border-t-0 border-gray-800">
                            
                            <form
                                action="{{ route('carrinho.editar', $item['produto']->id) }}"
                                method="POST"
                                class="flex items-center gap-2"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="number"
                                    name="quantidade"
                                    value="{{ $item['quantidade'] }}"
                                    min="1"
                                    max="99"
                                    required
                                    class="w-20 bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-1.5 text-center focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition text-sm"
                                >
                                <button
                                    type="submit"
                                    class="bg-gray-800 hover:bg-gray-700 text-gray-200 border border-gray-700 px-3 py-1.5 rounded-lg text-sm font-medium transition"
                                >
                                    Atualizar
                                </button>
                            </form>

                            <form
                                action="{{ route('carrinho.remover', $item['produto']->id) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-red-500 hover:text-red-400 font-medium text-sm px-3 py-1.5 rounded-lg hover:bg-red-500/10 transition"
                                >
                                    Remover
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-xl flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <span class="text-gray-400 text-sm">Valor Total do Pedido:</span>
                    <h2 class="text-2xl font-black text-white">
                        R$ {{ number_format($total, 2, ',', '.') }}
                    </h2>
                </div>

                <button
                    type="button"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-xl transition duration-200 shadow-lg shadow-red-900/40 text-center"
                >
                    Finalizar Pedido
                </button>
            </div>
        @endif
    </div>
</x-app-layout>