<x-app-layout>
    <div class="py-12 px-4 flex justify-center items-center min-h-screen">
        <div class="w-full max-w-lg bg-gray-900 p-8 rounded-xl shadow-2xl">

            <a href="{{ route('profile.show') }}"
               class="text-gray-400 hover:text-white transition">
                ← Voltar ao perfil
            </a>

            <h1 class="text-2xl font-bold text-white mt-6 mb-4 text-center border-b border-gray-800 pb-4">
                Excluir minha conta
            </h1>

            <div class="bg-red-950 border border-red-800 rounded-lg p-4 mb-6">
                <p class="text-red-300 font-semibold mb-2">
                    Atenção: esta ação é permanente!
                </p>

                <p class="text-gray-300 text-sm">
                    Ao excluir sua conta, seus dados de usuário serão removidos.
                    Essa ação não pode ser desfeita.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-5 bg-red-950 border border-red-800 rounded-lg p-4">
                    <ul class="text-red-300 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.destroy') }}"
                  method="POST"
                  class="space-y-5">

                @csrf
                @method('DELETE')

                <div>
                    <label for="password"
                           class="block text-sm font-medium text-gray-300 mb-1">
                        Digite sua senha atual para confirmar
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-lg shadow-red-900/40"
                >
                    Confirmar exclusão da conta
                </button>

                <a href="{{ route('profile.show') }}"
                   class="block text-center border border-gray-700 text-gray-300 hover:bg-gray-800 py-3 px-4 rounded-lg transition">
                    Cancelar
                </a>

            </form>
        </div>
    </div>
</x-app-layout>
