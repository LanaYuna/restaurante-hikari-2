<x-app-layout>
    <div class="py-12 px-4 flex justify-center items-center min-h-screen">
        <div class="w-full max-w-lg bg-gray-900 p-8 rounded-xl shadow-2xl">

            <a href="{{ route('profile.show') }}"
               class="text-gray-400 hover:text-white transition">
                ← Voltar ao perfil
            </a>

            <h1 class="text-2xl font-bold text-white mt-6 mb-6 text-center border-b border-gray-800 pb-4">
                Editar perfil
            </h1>

            @if ($errors->any())
                <div class="mb-5 bg-red-950 border border-red-800 rounded-lg p-4">
                    <ul class="text-red-300 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">
                        Nome
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                        autocomplete="name"
                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition"
                    >
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">
                        E-mail
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="username"
                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-lg shadow-red-900/40"
                >
                    Salvar alterações
                </button>
            </form>

            <a href="{{ route('profile.confirmDelete') }}"
               class="block text-center mt-5 text-sm text-red-400 hover:text-red-300 transition">
                Quero excluir minha conta
            </a>

        </div>
    </div>
</x-app-layout>
