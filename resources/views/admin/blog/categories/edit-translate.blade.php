@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('blogCategories.edit', $category->id) }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kategori Çeviri</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                {{ $selectedLanguage->name ?? $selectedLang }} dilinde çeviri yapın
            </p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('blogCategories.updateTranslate', $category->id) }}" method="POST">
    @csrf
    <input type="hidden" name="lang" value="{{ $selectedLang }}">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol kolon --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Orijinal içerik (readonly) --}}
            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-6 pt-5 pb-3 border-b border-slate-200/50 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-slate-200 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-400">Orijinal (Varsayılan Dil)</h3>
                </div>
                <div class="p-6 space-y-3">
                    <div>
                        <span class="text-xs text-slate-400 uppercase">Kategori Adı</span>
                        <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">{{ $category->getTranslation('name', app()->getLocale(), false) ?: '—' }}</p>
                    </div>
                </div>
            </div>

            {{-- Çeviri alanları --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50/60 via-transparent to-indigo-50/40 dark:from-blue-950/20 dark:to-indigo-950/10 pointer-events-none"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-md shadow-blue-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">
                            Çeviri: {{ $selectedLanguage->name ?? $selectedLang }}
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Kategori adının çevirisini yazın</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Kategori Adı <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-blue-500/60 transition-all"
                               placeholder="Kategori adının çevirisini yazın..."
                               value="{{ old('name', $category->getTranslation('name', $selectedLang, false)) }}" required>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sağ kolon --}}
        <div class="space-y-5 sticky top-24 self-start">

            {{-- Aksiyonlar --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5 space-y-3">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                               bg-gradient-to-r from-blue-500 to-indigo-600
                               hover:from-blue-600 hover:to-indigo-700
                               text-white font-semibold text-sm rounded-xl
                               shadow-lg shadow-blue-500/25
                               transition-all duration-200 active:scale-[.98] cursor-pointer">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Çeviriyi Kaydet
                </button>
                <a href="{{ route('blogCategories.edit', $category->id) }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700
                          text-slate-600 dark:text-slate-400 font-medium text-sm rounded-xl
                          border border-slate-200/60 dark:border-slate-600/50
                          transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                    </svg>
                    Geri Dön
                </a>
            </div>

            {{-- Dil bilgisi --}}
            <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-200/60 dark:border-blue-800/30 rounded-2xl p-4">
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center flex-shrink-0">
                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400">
                            {{ strtoupper(substr($selectedLang, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-blue-800 dark:text-blue-400">
                            {{ $selectedLanguage->name ?? $selectedLang }}
                        </p>
                        <p class="text-xs text-blue-600 dark:text-blue-500 font-mono mt-0.5">{{ $selectedLang }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
