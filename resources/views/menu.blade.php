<x-app-layout>
    @include('layouts.navigation')

   @if (session('success'))
        <div
            id="success-alert"
            class="mb-4 rounded-lg border border-green-800 bg-green-950
                p-4 text-green-300 transition-opacity duration-500"
        >
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');

                if (alert) {
                    alert.classList.add('opacity-0');

                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }
            }, 3000);
        </script>
    @endif

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach($categorias as $categoria)
            <x-categoria :categoria="$categoria" :isAdmin="false" />
        @endforeach
    </div>
</x-app-layout>