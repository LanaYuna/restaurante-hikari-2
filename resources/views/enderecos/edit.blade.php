<x-app-layout>
    <div class="min-h-screen bg-zinc-950 px-4 py-10">
        <div class="mx-auto max-w-2xl">

            <a
                href="{{ route('enderecos.index') }}"
                class="text-sm text-zinc-400 transition hover:text-white"
            >
                ← Voltar aos endereços
            </a>

            <div class="mt-6 rounded-xl border border-zinc-800
                        bg-zinc-900 p-6 sm:p-8">

                <h1 class="text-2xl font-bold text-white">
                    Editar endereço
                </h1>

                <p class="mt-2 text-sm text-zinc-400">
                    Altere as informações do endereço abaixo.
                </p>

                @if ($errors->any())
                    <div class="mt-6 rounded-lg border border-red-800
                                bg-red-950 p-4">
                        <p class="mb-2 font-medium text-red-300">
                            Verifique os seguintes erros:
                        </p>

                        <ul class="list-inside list-disc text-sm text-red-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('enderecos.update', $endereco->id) }}"
                    method="POST"
                    class="mt-6 space-y-5"
                >
                    @csrf
                    @method('PUT')

                    <div>
                        <label
                            for="rua"
                            class="mb-2 block text-sm font-medium text-zinc-300"
                        >
                            Rua
                        </label>

                        <input
                            type="text"
                            id="rua"
                            name="rua"
                            value="{{ old('rua', $endereco->rua) }}"
                            required
                            maxlength="255"
                            class="w-full rounded-lg border border-zinc-700
                                   bg-zinc-800 px-4 py-3 text-white
                                   focus:border-red-500 focus:outline-none
                                   focus:ring-1 focus:ring-red-500"
                        >

                        @error('rua')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label
                            for="numero"
                            class="mb-2 block text-sm font-medium text-zinc-300"
                        >
                            Número
                        </label>

                        <input
                            type="text"
                            id="numero"
                            name="numero"
                            value="{{ old('numero', $endereco->numero) }}"
                            required
                            maxlength="30"
                            class="w-full rounded-lg border border-zinc-700
                                   bg-zinc-800 px-4 py-3 text-white
                                   focus:border-red-500 focus:outline-none
                                   focus:ring-1 focus:ring-red-500"
                        >

                        @error('numero')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label
                            for="complemento"
                            class="mb-2 block text-sm font-medium text-zinc-300"
                        >
                            Complemento
                            <span class="text-zinc-500">(opcional)</span>
                        </label>

                        <input
                            type="text"
                            id="complemento"
                            name="complemento"
                            value="{{ old('complemento', $endereco->complemento) }}"
                            maxlength="255"
                            placeholder="Apartamento, bloco, referência..."
                            class="w-full rounded-lg border border-zinc-700
                                   bg-zinc-800 px-4 py-3 text-white
                                   placeholder:text-zinc-500
                                   focus:border-red-500 focus:outline-none
                                   focus:ring-1 focus:ring-red-500"
                        >

                        @error('complemento')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-3 pt-3 sm:flex-row">
                        <button
                            type="submit"
                            class="rounded-lg bg-red-600 px-5 py-3
                                   font-semibold text-white transition
                                   hover:bg-red-700"
                        >
                            Salvar alterações
                        </button>

                        <a
                            href="{{ route('enderecos.index') }}"
                            class="rounded-lg border border-zinc-700 px-5 py-3
                                   text-center font-medium text-zinc-300
                                   transition hover:bg-zinc-800"
                        >
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>