@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Sayfalar</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Frontend sayfa içeriklerini yönetin</p>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

        {{-- Ana Sayfa Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">Ana Sayfa</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Welcome, bölüm başlıkları</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'home') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'home']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Hakkımızda Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">Hakkımızda</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Hero, bölüm başlıkları, istatistikler</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'about') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'about']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- İletişim Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">İletişim</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Telefon, e-posta, adres bilgileri</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'contact') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'contact']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- SSS Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">SSS</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Başlıklar, görseller, form ayarları</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'faq') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'faq']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Eğitmenler Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">Eğitmenler</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Başlıklar, CTA ayarları</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'teachers') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'teachers']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Blog Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">Blog</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Breadcrumb, sidebar, CTA ayarları</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'blog') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'blog']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Kurslar Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">Kurslar</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Breadcrumb, sidebar, CTA ayarları</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'courses') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'courses']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Mağaza Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">Mağaza</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Ürünler, sepet, ödeme metinleri</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'shop') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'shop']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">Footer</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Logo, bağlantılar, sosyal medya, bülten</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'footer') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'footer']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Navbar Kartı --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-6 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200/50 dark:border-fuchsia-700/30
                            flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">Navbar / Menü</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Navigasyon menüsü ve header ayarları</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('pages.edit', 'navbar') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium
                          bg-gradient-to-r from-fuchsia-500 to-purple-500
                          hover:from-fuchsia-600 hover:to-purple-600
                          text-white rounded-lg shadow-sm shadow-fuchsia-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                    Düzenle
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                                   text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700
                                   hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                   hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                   rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                        Çeviriler
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                        @foreach ($activeLanguages as $activeLang)
                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLang->locale, 'id' => 'navbar']) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                      text-slate-600 dark:text-slate-300
                                      hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                      hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                      transition-all">
                                <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                    {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                </span>
                                {{ $activeLang->name ?: $activeLang->locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
