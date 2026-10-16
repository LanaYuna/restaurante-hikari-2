<x-app-layout>
    @include('layouts.navigation')
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach($categorias as $categoria)
            <x-categoria :categoria="$categoria" :isAdmin="false" />
        @endforeach
    </div>
</x-app-layout>