<x-app-layout>
    @include('layouts.navigation')

    @if (session('success'))
        <div
            id="alert"
            class="mb-4 rounded-lg border border-green-800 bg-green-950
                p-4 text-green-300 transition-opacity duration-500"
        >
            {{ session('success') }}
        </div>
    @elseif (session('erro'))
        <div
            id="alert"
            class="mb-4 rounded-lg border border-red-800 bg-red-950
                p-4 text-red-300 transition-opacity duration-500"
        >
            {{ session('erro') }}
        </div>      
    @endif
    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert');

            if (alert) {
                alert.classList.add('opacity-0');

                setTimeout(() => {
                    alert.remove();
                }, 500);
            }
        }, 3000);
    </script>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 mb-6">
            <a href="{{ route('admin.categoria.criar') }}"
                class="bg-indigo-700 font-medium text-sm px-3 py-2 rounded-lg hover:bg-indigo-800 transition whitespace-nowrap">
                Criar nova categoria
            </a>

            <a href="{{ route('admin.relatorios.index') }}"
                class="bg-indigo-700 font-medium text-sm px-3 py-2 rounded-lg hover:bg-indigo-800 transition whitespace-nowrap">
                Ver relatórios
            </a>
        </div>

        @foreach($categorias as $categoria)
            <x-categoria :categoria="$categoria" :isAdmin="true" />
        @endforeach
    </div>

</x-app-layout>