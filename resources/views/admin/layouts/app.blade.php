<!DOCTYPE html>
<html lang="tr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Parosis Akademi')</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Inter Font --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />

    {{-- Alpine.js Collapse Plugin (plugin'ler Alpine'dan ÖNCE yüklenmeli) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('styles')
</head>

<body x-data="{
        sidebarOpen: false,
        sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
        darkMode: localStorage.getItem('darkMode') === 'true',
    }"
    :class="{ 'dark': darkMode }"
    x-init="
        $watch('sidebarCollapsed', val => localStorage.setItem('sidebarCollapsed', val));
        $watch('darkMode', val => localStorage.setItem('darkMode', val));
        $nextTick(() => setTimeout(() => document.body.classList.remove('is-loading'), 50));
    "
    class="h-full font-[Inter] antialiased bg-slate-100 dark:bg-slate-950 transition-colors duration-300 is-loading">

    {{-- Mobile Overlay --}}
    <div x-show="sidebarOpen"
         @click="sidebarOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-30 lg:hidden"
         style="display: none;"></div>

    {{-- Toast Bildirimleri --}}
    @include('admin.layouts.toast')

    {{-- Sidebar --}}
    @include('admin.layouts.aside')

    {{-- Ana İçerik Alanı --}}
    <div class="transition-all duration-300 lg:pl-72"
         :class="{ 'lg:pl-20': sidebarCollapsed, 'lg:pl-72': !sidebarCollapsed }"

        {{-- Topbar --}}
        @include('admin.layouts.navbar')

        {{-- İçerik --}}
        <main class="px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
            @hasSection('page-banner')
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    @yield('page-banner')
                </div>
            @endif
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="px-4 sm:px-6 lg:px-8 py-4 border-t border-slate-200 dark:border-slate-800">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-slate-500 dark:text-slate-400">
                <p>&copy; {{ date('Y') }} Parosis Akademi. Tüm hakları saklıdır.</p>
                <p>Laravel v{{ app()->version() }}</p>
            </div>
        </footer>
    </div>

    {{-- Global Confirm / Alert Modal --}}
    <div x-data="{
            show: false,
            title: '',
            message: '',
            variant: 'danger',
            hasCancel: true,
            formEl: null,
            onConfirm: null,
            open(detail) {
                this.title   = detail.title   || '';
                this.message = detail.message || '';
                this.variant = detail.variant || 'danger';
                this.hasCancel = detail.hasCancel !== false;
                this.formEl  = detail.form     || null;
                this.onConfirm = detail.onConfirm || null;
                this.show = true;
            },
            accept() {
                this.show = false;
                if (this.formEl)    this.formEl.submit();
                if (this.onConfirm) this.onConfirm();
            },
            cancel() {
                this.show = false;
                this.formEl = null;
                this.onConfirm = null;
            }
        }"
         x-cloak
         @confirm-dialog.window="open($event.detail)"
         @alert-dialog.window="open({ ...$event.detail, variant: 'info', hasCancel: false })">

        {{-- Backdrop --}}
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-950/50 backdrop-blur-md z-[100]"
             style="display: none;"></div>

        {{-- Modal Kutusu --}}
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-6 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             @keydown.escape.window="cancel()"
             class="fixed inset-0 z-[101] flex items-center justify-center p-4"
             style="display: none;">
            <div class="relative bg-white dark:bg-slate-800 rounded-3xl
                        shadow-[0_25px_60px_-12px_rgba(0,0,0,0.35)]
                        dark:shadow-[0_25px_60px_-12px_rgba(0,0,0,0.6)]
                        border border-white/20 dark:border-slate-700/50
                        w-full max-w-sm overflow-hidden"
                 @click.outside="cancel()">

                <div class="px-7 pt-8 pb-5 text-center">
                    {{-- Danger İkonu --}}
                    <template x-if="variant === 'danger'">
                        <div class="modal-icon-pop mx-auto w-16 h-16 rounded-2xl
                                    bg-gradient-to-br from-red-50 to-red-100/80
                                    dark:from-red-500/10 dark:to-red-500/5
                                    flex items-center justify-center mb-5
                                    ring-1 ring-red-200/60 dark:ring-red-500/20">
                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                            </svg>
                        </div>
                    </template>

                    {{-- Warning İkonu --}}
                    <template x-if="variant === 'warning'">
                        <div class="modal-icon-pop mx-auto w-16 h-16 rounded-2xl
                                    bg-gradient-to-br from-amber-50 to-amber-100/80
                                    dark:from-amber-500/10 dark:to-amber-500/5
                                    flex items-center justify-center mb-5
                                    ring-1 ring-amber-200/60 dark:ring-amber-500/20">
                            <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
                            </svg>
                        </div>
                    </template>

                    {{-- Info İkonu --}}
                    <template x-if="variant === 'info'">
                        <div class="modal-icon-pop mx-auto w-16 h-16 rounded-2xl
                                    bg-gradient-to-br from-blue-50 to-indigo-50
                                    dark:from-blue-500/10 dark:to-indigo-500/5
                                    flex items-center justify-center mb-5
                                    ring-1 ring-blue-200/60 dark:ring-blue-500/20">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                            </svg>
                        </div>
                    </template>

                    <h3 class="text-lg font-bold text-slate-900 dark:text-white tracking-tight"
                        x-text="title"></h3>
                    <p class="mt-2.5 text-[13px] leading-relaxed text-slate-500 dark:text-slate-400"
                       x-text="message"></p>
                </div>

                {{-- Butonlar --}}
                <div class="px-7 pb-7 flex gap-3" :class="!hasCancel ? 'justify-center' : ''">
                    <template x-if="hasCancel">
                        <button @click="cancel()"
                                class="flex-1 px-5 py-3 text-sm font-semibold
                                       text-slate-600 dark:text-slate-300
                                       bg-slate-100 dark:bg-slate-700/80
                                       hover:bg-slate-200 dark:hover:bg-slate-600
                                       rounded-xl transition-all duration-200
                                       cursor-pointer active:scale-[0.97]">
                            Vazgeç
                        </button>
                    </template>
                    <button @click="accept()"
                            class="px-5 py-3 text-sm font-semibold text-white rounded-xl
                                   shadow-lg transition-all duration-200
                                   cursor-pointer active:scale-[0.97]"
                            :class="{
                                'flex-1': hasCancel,
                                'bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 shadow-red-500/25': variant === 'danger',
                                'bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 shadow-amber-500/25': variant === 'warning',
                                'bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 shadow-blue-500/25': variant === 'info',
                                'px-8': !hasCancel
                            }"
                            x-text="hasCancel ? 'Evet, Onayla' : 'Tamam'">
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Portal: Body seviyesinde renderlanması gereken modaller --}}
    @stack('modals')

    {{-- Flowbite JS (modal, dropdown vb. için gerekli) --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    @yield('scripts')

</body>

</html>
