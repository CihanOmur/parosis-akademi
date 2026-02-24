<aside class="fixed inset-y-0 left-0 z-40 bg-white dark:bg-slate-900
              border-r border-slate-200 dark:border-slate-800
              transition-all duration-300 ease-out flex flex-col"
       :class="[
           sidebarOpen ? 'translate-x-0 w-72' : '-translate-x-full w-72',
           sidebarCollapsed ? 'lg:translate-x-0 lg:w-20 sidebar-collapsed' : 'lg:translate-x-0 lg:w-72'
       ]"
       x-data="{ openMenu: '{{ Route::is('class.*') || Route::is('students.*') ? 'egitim' : (Route::is('blogs.*') || Route::is('blogCategories.*') || Route::is('blogTags.*') ? 'blog' : '') }}' }">

    {{-- Logo --}}
    <div class="sidebar-logo h-16 flex items-center gap-3 px-4 border-b border-slate-200 dark:border-slate-800 flex-shrink-0">
        {{-- Genişletilmiş logo --}}
        <div x-show="!sidebarCollapsed" x-transition class="flex items-center gap-2 hidden lg:flex">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold text-sm">PA</span>
            </div>
            <span class="font-bold text-slate-900 dark:text-white text-sm truncate">Parosis Akademi</span>
        </div>
        {{-- Her zaman görünen (mobil) --}}
        <div class="flex items-center gap-2 lg:hidden">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold text-sm">PA</span>
            </div>
            <span class="font-bold text-slate-900 dark:text-white text-sm">Parosis Akademi</span>
        </div>
        {{-- Collapsed logo (sadece desktop) --}}
        <div x-show="sidebarCollapsed" x-transition class="hidden lg:flex items-center justify-center">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center">
                <span class="text-white font-bold text-sm">PA</span>
            </div>
        </div>

        {{-- Mobile kapat butonu --}}
        <button @click="sidebarOpen = false"
                class="lg:hidden ml-auto p-1 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Navigasyon --}}
    <nav class="sidebar-nav flex-1 overflow-y-auto px-3 py-4 space-y-1">

        {{-- Dashboard --}}
        @php $isDashboard = Route::is('dashboard.index'); @endphp
        <a href="{{ route('dashboard.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                  {{ $isDashboard
                      ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                      : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ $isDashboard
                            ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                            : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>
            </div>
            <span x-show="!sidebarCollapsed" x-transition class="hidden lg:block">Dashboard</span>
            <span class="lg:hidden">Dashboard</span>
        </a>

        {{-- Eğitim Bölümü --}}
        @canany(['class', 'class_delete', 'student', 'student_delete', 'accounting'])
            <div class="pt-4">
                <p x-show="!sidebarCollapsed" x-transition
                   class="px-3 text-xs font-medium uppercase text-slate-400 dark:text-slate-500 mb-2 hidden lg:block">
                    Eğitim
                </p>
                <div x-show="sidebarCollapsed"
                     class="hidden lg:block mx-auto w-8 border-t border-slate-200 dark:border-slate-700 mb-2"></div>
                <p class="px-3 text-xs font-medium uppercase text-slate-400 dark:text-slate-500 mb-2 lg:hidden">Eğitim</p>
            </div>

            {{-- Eğitim Dropdown --}}
            @php $isEgitimActive = Route::is('class.*') || Route::is('students.*'); @endphp
            <div class="group/egitim relative">
                <button @click="openMenu = openMenu === 'egitim' ? '' : 'egitim'"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                               {{ $isEgitimActive
                                   ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                                   : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                                {{ $isEgitimActive
                                    ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                                    : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                        </svg>
                    </div>
                    <span x-show="!sidebarCollapsed" x-transition class="flex-1 text-left hidden lg:block">Eğitim</span>
                    <span class="flex-1 text-left lg:hidden">Eğitim</span>
                    {{-- Chevron --}}
                    <svg x-show="!sidebarCollapsed"
                         class="w-4 h-4 transition-transform duration-200 hidden lg:block"
                         :class="{ 'rotate-180': openMenu === 'egitim' }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                    <svg class="w-4 h-4 transition-transform duration-200 lg:hidden"
                         :class="{ 'rotate-180': openMenu === 'egitim' }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Normal alt menü (genişletilmiş sidebar + mobil) --}}
                <div x-show="openMenu === 'egitim' && (!sidebarCollapsed || window.innerWidth < 1024)"
                     x-collapse
                     class="ml-12 mt-1 space-y-1">

                    @canany(['class', 'class_delete'])
                        <a href="{{ route('class.index') }}"
                           class="block px-3 py-2 rounded-lg text-sm transition-colors
                                  {{ Route::is('class.*')
                                      ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                                      : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                            Sınıflar
                        </a>
                    @endcanany

                    @canany(['student', 'student_delete', 'accounting'])
                        <a href="{{ route('students.index') }}"
                           class="block px-3 py-2 rounded-lg text-sm transition-colors
                                  {{ Route::is('students.*') && !Route::is('students.pre.*')
                                      ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                                      : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                            Kesin Kayıtlar
                        </a>
                    @endcanany

                    @canany(['student', 'student_delete'])
                        <a href="{{ route('students.pre.students') }}"
                           class="block px-3 py-2 rounded-lg text-sm transition-colors
                                  {{ Route::is('students.pre.*')
                                      ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                                      : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                            Ön Kayıtlar
                        </a>
                    @endcanany
                </div>

                {{-- Flyout alt menü (collapsed sidebar, sadece desktop) --}}
                <template x-if="sidebarCollapsed">
                    <div class="hidden lg:group-hover/egitim:block absolute left-full top-0 pl-2 z-[60]">
                        <div class="w-52 bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-slate-200 dark:border-slate-700 py-2">
                            <p class="px-3 py-1.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Eğitim</p>

                            @canany(['class', 'class_delete'])
                                <a href="{{ route('class.index') }}"
                                   class="block px-3 py-2 text-sm rounded-lg mx-1 transition-colors
                                          {{ Route::is('class.*')
                                              ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                                              : 'text-slate-600 dark:text-slate-300 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-500/10 hover:text-fuchsia-600 dark:hover:text-fuchsia-400' }}">
                                    Sınıflar
                                </a>
                            @endcanany

                            @canany(['student', 'student_delete', 'accounting'])
                                <a href="{{ route('students.index') }}"
                                   class="block px-3 py-2 text-sm rounded-lg mx-1 transition-colors
                                          {{ Route::is('students.*') && !Route::is('students.pre.*')
                                              ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                                              : 'text-slate-600 dark:text-slate-300 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-500/10 hover:text-fuchsia-600 dark:hover:text-fuchsia-400' }}">
                                    Kesin Kayıtlar
                                </a>
                            @endcanany

                            @canany(['student', 'student_delete'])
                                <a href="{{ route('students.pre.students') }}"
                                   class="block px-3 py-2 text-sm rounded-lg mx-1 transition-colors
                                          {{ Route::is('students.pre.*')
                                              ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                                              : 'text-slate-600 dark:text-slate-300 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-500/10 hover:text-fuchsia-600 dark:hover:text-fuchsia-400' }}">
                                    Ön Kayıtlar
                                </a>
                            @endcanany
                        </div>
                    </div>
                </template>
            </div>
        @endcanany

        {{-- Admin Bölümü --}}
        @canany(['user', 'user_delete'])
            <div class="pt-4">
                <p x-show="!sidebarCollapsed" x-transition
                   class="px-3 text-xs font-medium uppercase text-slate-400 dark:text-slate-500 mb-2 hidden lg:block">
                    Yönetim
                </p>
                <div x-show="sidebarCollapsed"
                     class="hidden lg:block mx-auto w-8 border-t border-slate-200 dark:border-slate-700 mb-2"></div>
                <p class="px-3 text-xs font-medium uppercase text-slate-400 dark:text-slate-500 mb-2 lg:hidden">Yönetim</p>
            </div>

            {{-- Roller --}}
            @php $isRoles = Route::is('roles.*'); @endphp
            <a href="{{ route('roles.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                      {{ $isRoles
                          ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                          : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                            {{ $isRoles
                                ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                                : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                    </svg>
                </div>
                <span x-show="!sidebarCollapsed" x-transition class="hidden lg:block">Roller</span>
                <span class="lg:hidden">Roller</span>
            </a>

            {{-- Kullanıcılar --}}
            @php $isUsers = Route::is('users.*'); @endphp
            <a href="{{ route('users.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                      {{ $isUsers
                          ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                          : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                            {{ $isUsers
                                ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                                : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                    </svg>
                </div>
                <span x-show="!sidebarCollapsed" x-transition class="hidden lg:block">Kullanıcılar</span>
                <span class="lg:hidden">Kullanıcılar</span>
            </a>
        @endcanany

        {{-- Diller --}}
        @php $isLanguages = Route::is('languages.*'); @endphp
        <a href="{{ route('languages.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                  {{ $isLanguages
                      ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                      : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ $isLanguages
                            ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                            : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                </svg>
            </div>
            <span x-show="!sidebarCollapsed" x-transition class="hidden lg:block">Diller</span>
            <span class="lg:hidden">Diller</span>
        </a>

        {{-- Eğitmenler --}}
        @php $isTeachers = Route::is('teachers.*'); @endphp
        <a href="{{ route('teachers.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                  {{ $isTeachers
                      ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                      : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ $isTeachers
                            ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                            : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                </svg>
            </div>
            <span x-show="!sidebarCollapsed" x-transition class="hidden lg:block">Eğitmenler</span>
            <span class="lg:hidden">Eğitmenler</span>
        </a>

        {{-- Blog Dropdown --}}
        @php $isBlogActive = Route::is('blogs.*') || Route::is('blogCategories.*') || Route::is('blogTags.*'); @endphp
        <div class="group/blog relative">
            <button @click="openMenu = openMenu === 'blog' ? '' : 'blog'"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                           {{ $isBlogActive
                               ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                               : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                            {{ $isBlogActive
                                ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                                : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>
                    </svg>
                </div>
                <span x-show="!sidebarCollapsed" x-transition class="flex-1 text-left hidden lg:block">Blog</span>
                <span class="flex-1 text-left lg:hidden">Blog</span>
                <svg x-show="!sidebarCollapsed"
                     class="w-4 h-4 transition-transform duration-200 hidden lg:block"
                     :class="{ 'rotate-180': openMenu === 'blog' }"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
                <svg class="w-4 h-4 transition-transform duration-200 lg:hidden"
                     :class="{ 'rotate-180': openMenu === 'blog' }"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openMenu === 'blog' && (!sidebarCollapsed || window.innerWidth < 1024)"
                 x-collapse
                 class="ml-12 mt-1 space-y-1">
                <a href="{{ route('blogs.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm transition-colors
                          {{ Route::is('blogs.*')
                              ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                              : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                    Yazılar
                </a>
                <a href="{{ route('blogCategories.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm transition-colors
                          {{ Route::is('blogCategories.*')
                              ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                              : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                    Kategoriler
                </a>
                <a href="{{ route('blogTags.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm transition-colors
                          {{ Route::is('blogTags.*')
                              ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                              : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                    Etiketler
                </a>
            </div>

            <template x-if="sidebarCollapsed">
                <div class="hidden lg:group-hover/blog:block absolute left-full top-0 pl-2 z-[60]">
                    <div class="w-52 bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-slate-200 dark:border-slate-700 py-2">
                        <p class="px-3 py-1.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Blog</p>
                        <a href="{{ route('blogs.index') }}"
                           class="block px-3 py-2 text-sm rounded-lg mx-1 transition-colors
                                  {{ Route::is('blogs.*')
                                      ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                                      : 'text-slate-600 dark:text-slate-300 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-500/10 hover:text-fuchsia-600 dark:hover:text-fuchsia-400' }}">
                            Yazılar
                        </a>
                        <a href="{{ route('blogCategories.index') }}"
                           class="block px-3 py-2 text-sm rounded-lg mx-1 transition-colors
                                  {{ Route::is('blogCategories.*')
                                      ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                                      : 'text-slate-600 dark:text-slate-300 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-500/10 hover:text-fuchsia-600 dark:hover:text-fuchsia-400' }}">
                            Kategoriler
                        </a>
                        <a href="{{ route('blogTags.index') }}"
                           class="block px-3 py-2 text-sm rounded-lg mx-1 transition-colors
                                  {{ Route::is('blogTags.*')
                                      ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                                      : 'text-slate-600 dark:text-slate-300 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-500/10 hover:text-fuchsia-600 dark:hover:text-fuchsia-400' }}">
                            Etiketler
                        </a>
                    </div>
                </div>
            </template>
        </div>

        {{-- SSS --}}
        @php $isFaq = Route::is('faq.*'); @endphp
        <a href="{{ route('faq.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                  {{ $isFaq
                      ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                      : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ $isFaq
                            ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                            : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
                </svg>
            </div>
            <span x-show="!sidebarCollapsed" x-transition class="hidden lg:block">SSS</span>
            <span class="lg:hidden">SSS</span>
        </a>

        {{-- Sayfalar --}}
        @php $isPages = Route::is('pages.*'); @endphp
        <a href="{{ route('pages.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                  {{ $isPages
                      ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                      : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ $isPages
                            ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                            : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                </svg>
            </div>
            <span x-show="!sidebarCollapsed" x-transition class="hidden lg:block">Sayfalar</span>
            <span class="lg:hidden">Sayfalar</span>
        </a>

    </nav>

    {{-- Kullanıcı Profili --}}
    <div class="sidebar-user p-3 border-t border-slate-200 dark:border-slate-800 flex-shrink-0">
        <div class="flex items-center gap-3">
            <div class="relative flex-shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600
                            flex items-center justify-center text-white font-bold
                            shadow-lg shadow-fuchsia-500/20">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500
                            border-2 border-white dark:border-slate-900 rounded-full"></div>
            </div>
            <div x-show="!sidebarCollapsed" x-transition class="hidden lg:block min-w-0">
                <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">
                    {{ auth()->user()->name ?? 'Admin' }}
                </p>
                <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                    {{ auth()->user()->email ?? '' }}
                </p>
            </div>
            <div class="lg:hidden min-w-0">
                <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">
                    {{ auth()->user()->name ?? 'Admin' }}
                </p>
                <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                    {{ auth()->user()->email ?? '' }}
                </p>
            </div>
        </div>
    </div>
</aside>
