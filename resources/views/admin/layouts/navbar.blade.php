<header class="sticky top-0 z-30 glass border-b border-slate-200/50 dark:border-slate-700/50">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">

        {{-- Sol: Mobile menü + Sidebar collapse --}}
        <div class="flex items-center gap-2">
            {{-- Mobile hamburger --}}
            <button @click="sidebarOpen = !sidebarOpen" type="button"
                    class="lg:hidden inline-flex items-center justify-center p-2 rounded-xl
                           text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200
                           hover:bg-slate-100 dark:hover:bg-slate-800
                           focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20
                           transition-all duration-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Desktop sidebar collapse toggle --}}
            <button @click="sidebarCollapsed = !sidebarCollapsed" type="button"
                    class="hidden lg:inline-flex items-center justify-center p-2 rounded-xl
                           text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200
                           hover:bg-slate-100 dark:hover:bg-slate-800
                           focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20
                           transition-all duration-200">
                <svg class="h-5 w-5 transition-transform duration-300"
                     :class="{ 'rotate-180': sidebarCollapsed }"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
            </button>
        </div>

        {{-- Sağ: Dark mode + Site link + Kullanıcı menüsü --}}
        <div class="flex items-center gap-2 sm:gap-3">

            {{-- Siteyi Gör Butonu --}}
            <a href="/" target="_blank"
               class="hidden sm:inline-flex items-center gap-2 px-4 py-2
                      bg-gradient-to-r from-fuchsia-500 to-purple-600
                      hover:from-fuchsia-600 hover:to-purple-700
                      text-white text-sm font-medium rounded-xl
                      shadow-sm hover:shadow-md hover:shadow-fuchsia-500/25
                      transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Siteyi Gör
            </a>

            {{-- Dark Mode Toggle --}}
            <button @click="darkMode = !darkMode" type="button"
                    class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl
                           text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200
                           hover:bg-slate-100 dark:hover:bg-slate-800
                           focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20
                           transition-all duration-200 overflow-hidden">
                {{-- Ay ikonu (light modda görünür) --}}
                <svg x-show="!darkMode"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 rotate-90 scale-0"
                     x-transition:enter-end="opacity-100 rotate-0 scale-100"
                     class="h-5 w-5 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
                {{-- Güneş ikonu (dark modda görünür) --}}
                <svg x-show="darkMode"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -rotate-90 scale-0"
                     x-transition:enter-end="opacity-100 rotate-0 scale-100"
                     class="h-5 w-5 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </button>

            {{-- Kullanıcı Dropdown --}}
            <div x-data="{ userOpen: false }" class="relative">
                <button @click="userOpen = !userOpen" type="button"
                        class="flex items-center gap-2 p-1 rounded-xl
                               hover:bg-slate-100 dark:hover:bg-slate-800
                               focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20
                               transition-all duration-200">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600
                                flex items-center justify-center text-white font-bold text-sm
                                shadow-md shadow-fuchsia-500/20">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <svg class="w-4 h-4 text-slate-400 hidden sm:block transition-transform duration-200"
                         :class="{ 'rotate-180': userOpen }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown menü --}}
                <div x-show="userOpen"
                     @click.outside="userOpen = false"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="transform opacity-0 scale-95 translate-y-1"
                     x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="transform opacity-0 scale-95 translate-y-1"
                     class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-2xl
                            shadow-xl shadow-slate-900/10 dark:shadow-slate-950/50
                            border border-slate-200/50 dark:border-slate-700/50 overflow-hidden z-50"
                     style="display: none;">

                    {{-- Kullanıcı bilgisi --}}
                    <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">
                            {{ auth()->user()->name ?? 'Admin' }}
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate mt-0.5">
                            {{ auth()->user()->email ?? '' }}
                        </p>
                    </div>

                    {{-- Çıkış --}}
                    <div class="p-1">
                        <form action="{{ route('logout') }}" method="post" id="logout-form">
                            @csrf
                        </form>
                        <button onclick="document.getElementById('logout-form').submit();"
                                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
                                       text-red-600 dark:text-red-400
                                       hover:bg-red-50 dark:hover:bg-red-500/10
                                       transition-all duration-200 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Çıkış Yap
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
