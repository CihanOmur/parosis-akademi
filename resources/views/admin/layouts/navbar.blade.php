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

            {{-- Firma Başlığı --}}
            @php $companyName = \App\Models\Setting::get('site_name', 'Parosis Akademi'); @endphp
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl
                        bg-slate-100/70 dark:bg-slate-800/70
                        border border-slate-200/60 dark:border-slate-700/60">
                <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-fuchsia-500 to-purple-600
                            flex items-center justify-center text-white font-bold text-xs
                            shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                    {{ strtoupper(mb_substr($companyName, 0, 1)) }}
                </div>
                <span class="text-sm font-semibold text-slate-900 dark:text-white truncate max-w-[160px] sm:max-w-[260px]">
                    {{ $companyName }}
                </span>
            </div>

        </div>
    </div>
</header>
