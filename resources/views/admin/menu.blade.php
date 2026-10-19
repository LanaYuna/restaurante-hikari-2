<x-app-layout>
    @include('layouts.navigation')

    <a href="{{ route('admin.categoria.criar') }}">
        Criar nova categoria
    </a>

    <a href="{{ route('admin.relatorio.index') }}">
        Ver relatórios
    </a>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach($categorias as $categoria)
            <x-categoria :categoria="$categoria" :isAdmin="true" />
        @endforeach
    </div>
</x-app-layout>