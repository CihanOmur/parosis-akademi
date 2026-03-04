@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Navbar Çeviri</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            {{ isset($selectedLanguage) && $selectedLanguage ? $selectedLanguage . ' dilinde' : '' }} içerik çevirisi
        </p>
    </div>
    <a href="{{ route('pages.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium
              text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800
              border border-slate-200 dark:border-slate-700
              hover:bg-slate-50 dark:hover:bg-slate-700
              rounded-xl transition-all duration-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
        </svg>
        Geri Dön
    </a>
@endsection

@section('content')
    {{-- Language Tabs --}}
    <div class="mb-6">
        @include('admin.components.language-tabs', ['selectedLang' => $selectedLang])
    </div>

    <div class="max-w-2xl">
        <form action="{{ route('pages.updateTranslate', ['id' => 'navbar']) }}" method="POST">
            @csrf
            <input type="hidden" name="lang" value="{{ $selectedLang }}">

            <div class="space-y-6">

                {{-- ═══ Çevrilebilir İçerikler ═══ --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-fuchsia-50 dark:bg-fuchsia-900/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Header Metinleri</h3>
                                <p class="text-xs text-slate-400 dark:text-slate-500">Arama, butonlar ve diğer metinler</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-text-input name="search_placeholder" label="Arama Placeholder" placeholder="Kursunuzu arayın"
                                :value="translateAttribute($navbarPageInfo, 'search_placeholder', $selectedLang)" />
                            <x-text-input name="search_button_text" label="Arama Butonu" placeholder="Ara"
                                :value="translateAttribute($navbarPageInfo, 'search_button_text', $selectedLang)" />
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-text-input name="register_button_text" label="Kayıt Ol Butonu" placeholder="Kayıt Ol"
                                :value="translateAttribute($navbarPageInfo, 'register_button_text', $selectedLang)" />
                            <x-text-input name="login_button_text" label="Giriş Yap Butonu" placeholder="Giriş Yap"
                                :value="translateAttribute($navbarPageInfo, 'login_button_text', $selectedLang)" />
                        </div>
                    </div>
                </div>

                {{-- ═══ Menü Etiketleri Çevirisi ═══ --}}
                @if($navbarPageInfo->nav_items && count($navbarPageInfo->nav_items) > 0)
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Menü Etiketleri Çevirisi</h3>
                                <p class="text-xs text-slate-400 dark:text-slate-500">Navigasyon menü öğelerinin çevirisi</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        @foreach($navbarPageInfo->nav_items as $i => $item)
                            @php
                                $itemLabel = is_array($item['label'] ?? null)
                                    ? ($item['label'][$selectedLang] ?? ($item['label'][app()->getLocale()] ?? ''))
                                    : ($item['label'] ?? '');
                                $itemUrl = $item['url'] ?? '';
                            @endphp
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-slate-400 dark:text-slate-500 w-28 truncate flex-shrink-0" title="{{ $itemUrl }}">{{ $itemUrl ?: '—' }}</span>
                                <input type="text" name="nav_item_labels[{{ $i }}][label]" value="{{ $itemLabel }}"
                                       placeholder="Menü etiketi çevirisi"
                                       class="flex-1 px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                              text-slate-900 dark:text-white placeholder-slate-400
                                              ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-indigo-500/60 transition-all">
                            </div>

                            {{-- Level 1 children --}}
                            @if(!empty($item['children']))
                                @foreach($item['children'] as $j => $child)
                                    @php
                                        $childLabel = is_array($child['label'] ?? null)
                                            ? ($child['label'][$selectedLang] ?? ($child['label'][app()->getLocale()] ?? ''))
                                            : ($child['label'] ?? '');
                                        $childUrl = $child['url'] ?? '';
                                    @endphp
                                    <div class="flex items-center gap-3 pl-8">
                                        <span class="text-xs text-slate-400 dark:text-slate-500 w-28 truncate flex-shrink-0" title="{{ $childUrl }}">↳ {{ $childUrl ?: '—' }}</span>
                                        <input type="text" name="nav_item_labels[{{ $i }}][children][{{ $j }}][label]" value="{{ $childLabel }}"
                                               placeholder="Alt menü etiketi çevirisi"
                                               class="flex-1 px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                                      text-slate-900 dark:text-white placeholder-slate-400
                                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-indigo-500/60 transition-all">
                                    </div>

                                    {{-- Level 2 children --}}
                                    @if(!empty($child['children']))
                                        @foreach($child['children'] as $k => $sub)
                                            @php
                                                $subLabel = is_array($sub['label'] ?? null)
                                                    ? ($sub['label'][$selectedLang] ?? ($sub['label'][app()->getLocale()] ?? ''))
                                                    : ($sub['label'] ?? '');
                                                $subUrl = $sub['url'] ?? '';
                                            @endphp
                                            <div class="flex items-center gap-3 pl-16">
                                                <span class="text-xs text-slate-400 dark:text-slate-500 w-28 truncate flex-shrink-0" title="{{ $subUrl }}">↳↳ {{ $subUrl ?: '—' }}</span>
                                                <input type="text" name="nav_item_labels[{{ $i }}][children][{{ $j }}][children][{{ $k }}][label]" value="{{ $subLabel }}"
                                                       placeholder="Alt alt menü çevirisi"
                                                       class="flex-1 px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                                              text-slate-900 dark:text-white placeholder-slate-400
                                                              ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-indigo-500/60 transition-all">
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- ═══ Kaydet ═══ --}}
                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3
                                   bg-gradient-to-r from-fuchsia-500 to-purple-500
                                   hover:from-fuchsia-600 hover:to-purple-600
                                   text-white font-semibold rounded-xl
                                   shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                        </svg>
                        Kaydet
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
