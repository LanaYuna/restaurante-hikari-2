<x-app-layout>
    
    <div class="grid grid-cols-3 gap-4">
        @foreach($produtos as $produto)
            <!-- Chamando o componente sem ser admin -->
            <x-produto :produto="$produto" :isAdmin="false" />
        @endforeach
    </div>

</x-app-layout>

