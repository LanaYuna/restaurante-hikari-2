<x-app-layout>
    <div class="py-12 flex justify-center items-center min-h-screen">
        <div class="w-full max-w-lg bg-gray-900 p-8 rounded-xl shadow-2xl">

            <a href="{{ route('admin.menu') }}">Voltar</a>
            
            <h1 class="text-2xl font-bold text-white mb-6 text-center border-b border-gray-800 pb-4">
                Cadastrar Novo Produto
            </h1>

            <form
                action="{{ route('admin.produtos.adicionar') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5"
            >
                @csrf

                <input type="hidden"
                    name="categoria_id"
                    value="{{ $categoria->id }}">

                <div>
                    <label for="nome" class="block text-sm font-medium text-gray-300 mb-1">Nome do Produto:</label>
                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        required
                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition"
                        placeholder="Nome do produto "
                    >
                </div>
                
                <div>
                    <label for="preco" class="block text-sm font-medium text-gray-300 mb-1">Preço (R$):</label>
                    <input
                        type="number"
                        id="preco"
                        name="preco"
                        step="0.01"
                        min="0"
                        required
                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition"
                        placeholder="0.00"
                    >
                </div>

                <div>
                    <label for="imagem" class="block text-sm font-medium text-gray-300 mb-1">Imagem:</label>
                    <input
                        type="file"
                        id="imagem"
                        name="imagem"
                        accept="image/*"
                        class="w-full bg-gray-800 border border-gray-700 text-gray-300 rounded-lg px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700 transition cursor-pointer"
                    >
                </div>

                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-lg shadow-red-900/40"
                    >
                        Cadastrar Produto
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>