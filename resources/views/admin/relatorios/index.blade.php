<x-app-layout>

    <div>
        <h1>Relatórios</h1>
        <p>Visualize indicadores e estatísticas do restaurante.</p>

        <div class="grid grid-cols-3 gap-6">
            <a href="{{ route('admin.relatorios.produtos.baratos') }}" 
                class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-red-600 transition-all group"
            >
                <h2 class="text-xl font-bold text-white group-hover:text-red-500">
                    Produtos mais baratos
                </h2>

                <p class="text-zinc-400 mt-2">
                    Consulte os 10 pratos mais baratos.
                </p>
            </a>

             <a href="{{ route('admin.relatorios.categorias') }}" 
                class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-red-600 transition-all group"
            >
                <h2 class="text-xl font-bold text-white group-hover:text-red-500">
                    Vendas por categoria
                </h2>

                <p class="text-zinc-400 mt-2">
                    Compare o desempenho de cada categoria do cardápio.
                </p>
            </a>

             <a href="{{ route('admin.relatorios.clientes') }}" 
                class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-red-600 transition-all group"
            >
                <h2 class="text-xl font-bold text-white group-hover:text-red-500">
                    Clientes que mais compram
                </h2>

                <p class="text-zinc-400 mt-2"> 
                    Consulte os clientes com maior volume de pedidos e gastos.
                </p>
            </a>

             <a href="{{ route('admin.relatorios.produtos.vendidos') }}" 
                class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-red-600 transition-all group"
            >
                <h2 class="text-xl font-bold text-white group-hover:text-red-500">
                    Produtos mais vendidos
                </h2>

                <p class="text-zinc-400 mt-2">
                    Veja quais pratos tiveram mais vendas e geraram maior receita.
                </p>
            </a>

             <a href="{{ route('admin.relatorios.faturamento') }}" 
                class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-red-600 transition-all group"
            >
                <h2 class="text-xl font-bold text-white group-hover:text-red-500">
                    Faturamento por período
                </h2>

                <p class="text-zinc-400 mt-2">
                    Consulte quanto o restaurante faturou.
                </p>
            </a>
        </div>

    </div>

</x-app-layout>