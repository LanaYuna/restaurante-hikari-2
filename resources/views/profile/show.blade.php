<x-app-layout>
    <div class="py-12 px-4 flex justify-center items-center min-h-screen">
        <div class="w-full max-w-lg bg-gray-900 p-8 rounded-xl shadow-2xl">

            <a href="{{ url()->previous() }}"
               class="text-gray-400 hover:text-white transition">
                ← Voltar ao menu
            </a>

            <h1 class="text-2xl font-bold text-white mt-6 mb-6 text-center border-b border-gray-800 pb-4">
                Meu perfil
            </h1>

            @if (session('status'))
                <p class="mb-4 text-green-400">
                    {{ session('status') }}
                </p>
            @endif

            <div class="space-y-5">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Nome</p>
                    <p class="text-white">
                        {{ $user->name }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400 mb-1">E-mail</p>
                    <p class="text-white break-words">
                        {{ $user->email }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400 mb-1">Tipo de conta</p>
                    <p class="text-white">
                        {{ $user->tipo ?? 'cliente' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400 mb-1">Conta criada em</p>
                    <p class="text-white">
                        {{ $user->created_at?->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-3 mt-8">
                <a href="{{ route('profile.edit') }}"
                   class="text-center bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition">
                    Editar perfil
                </a>

                <a href="{{ route('profile.confirmDelete') }}"
                   class="text-center border border-red-600 text-red-400 hover:bg-red-600 hover:text-white font-bold py-3 px-4 rounded-lg transition">
                    Excluir minha conta
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
