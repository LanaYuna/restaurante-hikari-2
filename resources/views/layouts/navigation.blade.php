<nav x-data="{ open: false }" class="bg-zinc-900 border-b border-zinc-800 text-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center gap-4">
            
            <!-- 1. Barra de Busca -->
            <div class="flex-1 max-w-xl">
                <form action="{{ route('dashboard') }}" method="GET" class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Busque por algum prato..." 
                        class="w-full bg-zinc-800/80 border border-zinc-700 text-sm rounded-full py-2 pl-4 pr-10 text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                    >
                    <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Opções da direita (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                
                <!-- 2. Endereço -->
                <button type="button" class="flex items-center text-sm font-medium text-gray-300 hover:text-white transition group">
                    <svg class="w-5 h-5 mr-1.5 text-gray-400 group-hover:text-red-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Seu endereço</span>
                </button>

                <!-- 3. Perfil (Dropdown Breeze) -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center text-sm font-medium text-gray-300 hover:text-white transition focus:outline-none">
                                <svg class="w-5 h-5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                @auth
                                    <div>{{ Auth::user()->name }}</div>
                                @else
                                    <div>Visitante</div>
                                @endauth
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-zinc-800 border border-zinc-700 rounded-md py-1">
                                <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:bg-zinc-700 hover:text-white">
                                    {{ __('Meu Perfil') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-300 hover:bg-zinc-700 hover:text-white">
                                        {{ __('Sair') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white">Entrar</a>
                @endauth

                <!-- 4. Botão Carrinho -->
                <a href="#" class="relative inline-flex items-center justify-center p-2.5 bg-red-600 hover:bg-red-700 text-white rounded-full transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    <!-- Badge para contagem de itens do carrinho (opcional) -->
                    <span class="absolute -top-1 -right-1 bg-zinc-900 border border-red-500 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        0
                    </span>
                </a>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-zinc-800 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-zinc-900 border-t border-zinc-800">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <button class="w-full text-left py-2 text-gray-300 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                Seu endereço
            </button>
        </div>
        <div class="pt-4 pb-1 border-t border-zinc-800">
            @auth
                <div class="px-4 text-sm font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="px-4 text-xs font-medium text-gray-400 mb-2">{{ Auth::user()->email }}</div>
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-white">Meu Perfil</x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('login')" class="text-gray-300">Entrar</x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>