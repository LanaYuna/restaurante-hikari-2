<x-app-layout>
    <div class="min-h-screen bg-zinc-950 px-4 py-10">
        <div class="mx-auto max-w-4xl">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">
                    Meus endereços
                </h1>

                <p class="mt-2 text-zinc-400">
                    Consulte e atualize seus endereços cadastrados.
                </p>
            </div>

            @if ($enderecos->isEmpty())
                <div class="rounded-xl border border-zinc-800
                            bg-zinc-900 p-8 text-center">
                    <h2 class="text-xl font-semibold text-white">
                        Nenhum endereço cadastrado
                    </h2>

                    <p class="mt-2 text-zinc-400">
                        Você ainda não possui endereços registrados.
                    </p>
                </div>

                <a href="{{ route('enderecos.criar') }}">
                    Criar endereço
                </a>
            @else
                <div class="space-y-4">
                    @foreach ($enderecos as $endereco)
                        <div class="rounded-xl border border-zinc-800
                                    bg-zinc-900 p-6">

                            <div class="flex flex-col justify-between gap-4
                                        sm:flex-row sm:items-center">

                                <div>
                                    <h2 class="text-lg font-semibold text-white">
                                        {{ $endereco->rua }},
                                        {{ $endereco->numero }}
                                    </h2>

                                    <p class="mt-1 text-sm text-zinc-400">
                                        Complemento:
                                        {{ $endereco->complemento ?: 'Não informado' }}
                                    </p>
                                </div>

                                <a
                                    href="{{ route('enderecos.edit', $endereco->id) }}"
                                    class="inline-flex justify-center rounded-lg
                                           bg-red-600 px-4 py-2 font-medium
                                           text-white transition hover:bg-red-700"
                                >
                                    Editar endereço
                                </a> 

                                <form 
                                    action="{{ route('endereco.remove', $endereco->id) }}" 
                                    method="POST"  
                                    onsubmit="return confirm('Deseja realmente remover este endereço?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button 
                                        type="submit" class="text-red-600 text-sm font-semibold">
                                        Remover
                                    </button>

                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-8">
                <a
                    href="{{ route('menu') }}"
                    class="text-sm text-zinc-400 transition hover:text-white"
                >
                    ← Voltar ao menu
                </a>
            </div>

        </div>
    </div>
</x-app-layout>