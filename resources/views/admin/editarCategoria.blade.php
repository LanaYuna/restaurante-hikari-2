<x-app-layout>
    <div class="py-12 flex justify-center items-center min-h-screen">
        <div class="w-full max-w-lg bg-gray-900 p-8 rounded-xl shadow-2xl">

            <a href="{{ route('admin.menu') }}">Voltar</a>

            <h1 class="text-2xl font-bold text-white mb-6 text-center border-b border-gray-800 pb-4">
                Editar categoria
            </h1>

            <form
                action="{{ route('admin.categoria.atualizar', $categoria->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div>
                    <label for="nome" class="block text-sm font-medium text-gray-300 mb-1">Descrição da Categoria:</label>
                    <input
                        type="text"
                        id="descricao"
                        name="descricao"
                        required
                        value="{{ old('descricao', $categoria->descricao) }}"
                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition"
                        placeholder="Descrição da categoria"
                    >
                </div>

        
                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-lg shadow-red-900/40"
                    >
                        Salvar Categoria
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>