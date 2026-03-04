@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Navbar / Menü</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Navigasyon menüsü ve header ayarları</p>
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
    <div x-data="navbarEditor()" x-cloak>

        {{-- Language Tabs --}}
        <div class="mb-5">
            @include('admin.components.language-tabs', ['selectedLang' => $selectedLang])
        </div>

        <div class="space-y-6">

            {{-- ═══ Canlı Header Önizleme ═══ --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Canlı Önizleme</h3>
                            <p class="text-xs text-slate-400 dark:text-slate-500">Header'ın frontend'deki görünümü</p>
                        </div>
                    </div>
                    <a href="{{ route('menu-items.index') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20 hover:bg-indigo-100 dark:hover:bg-indigo-900/30 rounded-lg transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                        </svg>
                        Menüyü Düzenle
                    </a>
                </div>

                <div class="p-4 space-y-3">
                    {{-- Top bar preview --}}
                    <div class="bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-200/60 dark:border-slate-700/40 px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 text-sm font-bold text-slate-400 dark:text-slate-500">LOGO</div>
                            {{-- Search bar --}}
                            <div x-show="showSearch" x-transition class="flex-1 flex items-center gap-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full px-4 py-2">
                                <span class="flex-1 text-xs text-slate-400 truncate" x-text="searchPlaceholder || 'Kursunuzu arayın'"></span>
                                <span class="bg-purple-600 text-white text-[10px] font-medium px-3 py-1 rounded-full" x-text="searchButtonText || 'Ara'"></span>
                            </div>
                            <div x-show="!showSearch" class="flex-1"></div>
                            {{-- Social links --}}
                            <div x-show="showSocialLinks" x-transition class="flex items-center gap-1.5 flex-shrink-0">
                                <div class="w-4 h-4 rounded bg-slate-300 dark:bg-slate-600"></div>
                                <div class="w-4 h-4 rounded bg-slate-300 dark:bg-slate-600"></div>
                                <div class="w-4 h-4 rounded bg-slate-300 dark:bg-slate-600"></div>
                            </div>
                            {{-- Buttons --}}
                            <span x-show="showRegisterButton" x-transition class="flex-shrink-0 bg-yellow-400 text-[10px] font-semibold text-slate-900 px-3 py-1.5 rounded-full" x-text="registerButtonText || 'Kayıt Ol'"></span>
                            <span x-show="showLoginButton" x-transition class="flex-shrink-0 bg-gradient-to-t from-slate-200 to-white text-[10px] font-semibold text-slate-700 px-3 py-1.5 rounded-full border border-slate-200" x-text="loginButtonText || 'Giriş Yap'"></span>
                        </div>
                    </div>

                    {{-- Bottom bar preview --}}
                    <div class="bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-200/60 dark:border-slate-700/40 px-4 py-2.5">
                        <div class="flex items-center justify-between">
                            {{-- Menu --}}
                            <div class="flex flex-wrap items-center gap-1">
                                @if(($navMenuItems ?? collect())->isNotEmpty())
                                    @foreach($navMenuItems as $item)
                                        @php $hasChildren = $item->children->isNotEmpty(); @endphp
                                        <div class="relative" x-data="{ open: false }">
                                            <button @if($hasChildren) @mouseenter="open = true" @mouseleave="open = false" @endif
                                                    class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-white dark:hover:bg-slate-800 rounded-lg transition-all cursor-default">
                                                {{ $item->label }}
                                                @if($hasChildren)
                                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                                                @endif
                                            </button>
                                            @if($hasChildren)
                                                <div x-show="open" @mouseenter="open = true" @mouseleave="open = false" x-transition class="absolute left-0 top-full z-30 mt-1 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1">
                                                    @foreach($item->children as $child)
                                                        @php $childHasChildren = $child->children->isNotEmpty(); @endphp
                                                        <div class="relative" x-data="{ subOpen: false }">
                                                            <div @if($childHasChildren) @mouseenter="subOpen = true" @mouseleave="subOpen = false" @endif class="flex items-center justify-between px-3 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors cursor-default">
                                                                {{ $child->label }}
                                                                @if($childHasChildren)
                                                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                                                                @endif
                                                            </div>
                                                            @if($childHasChildren)
                                                                <div x-show="subOpen" @mouseenter="subOpen = true" @mouseleave="subOpen = false" x-transition class="absolute left-full top-0 z-30 ml-1 w-44 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1">
                                                                    @foreach($child->children as $sub)
                                                                        <div class="px-3 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors cursor-default">{{ $sub->label }}</div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <span class="text-sm text-slate-400 py-2">Menü öğesi yok</span>
                                @endif
                            </div>
                            {{-- Right side --}}
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <div x-show="showCartButton" x-transition class="w-5 h-5 rounded bg-slate-300 dark:bg-slate-600"></div>
                                <div x-show="showSideInfoButton" x-transition class="w-5 h-5 rounded bg-slate-300 dark:bg-slate-600"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═══ Görünürlük Ayarları ═══ --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Görünürlük Ayarları</h3>
                            <p class="text-xs text-slate-400 dark:text-slate-500">Header bileşenlerini göster veya gizle</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="flex items-center justify-between gap-3 px-4 py-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl cursor-pointer">
                            <div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Arama Çubuğu</span>
                                <p class="text-xs text-slate-400">Arama input ve butonu</p>
                            </div>
                            <div class="relative flex-shrink-0">
                                <input type="checkbox" x-model="showSearch" class="sr-only peer">
                                <div class="w-10 h-5.5 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-4.5 after:w-4.5 after:transition-all peer-checked:after:translate-x-[18px] transition-colors duration-200"></div>
                            </div>
                        </label>
                        <label class="flex items-center justify-between gap-3 px-4 py-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl cursor-pointer">
                            <div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Kayıt Ol Butonu</span>
                                <p class="text-xs text-slate-400">Sarı kayıt butonu</p>
                            </div>
                            <div class="relative flex-shrink-0">
                                <input type="checkbox" x-model="showRegisterButton" class="sr-only peer">
                                <div class="w-10 h-5.5 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-4.5 after:w-4.5 after:transition-all peer-checked:after:translate-x-[18px] transition-colors duration-200"></div>
                            </div>
                        </label>
                        <label class="flex items-center justify-between gap-3 px-4 py-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl cursor-pointer">
                            <div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Giriş Yap Butonu</span>
                                <p class="text-xs text-slate-400">Giriş butonu</p>
                            </div>
                            <div class="relative flex-shrink-0">
                                <input type="checkbox" x-model="showLoginButton" class="sr-only peer">
                                <div class="w-10 h-5.5 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-4.5 after:w-4.5 after:transition-all peer-checked:after:translate-x-[18px] transition-colors duration-200"></div>
                            </div>
                        </label>
                        <label class="flex items-center justify-between gap-3 px-4 py-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl cursor-pointer">
                            <div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Sosyal Medya</span>
                                <p class="text-xs text-slate-400">Sosyal medya ikonları</p>
                            </div>
                            <div class="relative flex-shrink-0">
                                <input type="checkbox" x-model="showSocialLinks" class="sr-only peer">
                                <div class="w-10 h-5.5 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-4.5 after:w-4.5 after:transition-all peer-checked:after:translate-x-[18px] transition-colors duration-200"></div>
                            </div>
                        </label>
                        <label class="flex items-center justify-between gap-3 px-4 py-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl cursor-pointer">
                            <div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Sepet Butonu</span>
                                <p class="text-xs text-slate-400">Alışveriş sepeti ikonu</p>
                            </div>
                            <div class="relative flex-shrink-0">
                                <input type="checkbox" x-model="showCartButton" class="sr-only peer">
                                <div class="w-10 h-5.5 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-4.5 after:w-4.5 after:transition-all peer-checked:after:translate-x-[18px] transition-colors duration-200"></div>
                            </div>
                        </label>
                        <label class="flex items-center justify-between gap-3 px-4 py-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl cursor-pointer">
                            <div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Yan Menü Butonu</span>
                                <p class="text-xs text-slate-400">Sağ taraf bilgi butonu</p>
                            </div>
                            <div class="relative flex-shrink-0">
                                <input type="checkbox" x-model="showSideInfoButton" class="sr-only peer">
                                <div class="w-10 h-5.5 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-4.5 after:w-4.5 after:transition-all peer-checked:after:translate-x-[18px] transition-colors duration-200"></div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- ═══ Header Metinleri ═══ --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
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
                            x-model="searchPlaceholder"
                            :value="translateAttribute($navbarPageInfo, 'search_placeholder', $selectedLang)" />
                        <x-text-input name="search_button_text" label="Arama Butonu" placeholder="Ara"
                            x-model="searchButtonText"
                            :value="translateAttribute($navbarPageInfo, 'search_button_text', $selectedLang)" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-text-input name="register_button_text" label="Kayıt Ol Butonu" placeholder="Kayıt Ol"
                            x-model="registerButtonText"
                            :value="translateAttribute($navbarPageInfo, 'register_button_text', $selectedLang)" />
                        <x-text-input name="login_button_text" label="Giriş Yap Butonu" placeholder="Giriş Yap"
                            x-model="loginButtonText"
                            :value="translateAttribute($navbarPageInfo, 'login_button_text', $selectedLang)" />
                    </div>
                </div>
            </div>

            {{-- ═══ Kaydet ═══ --}}
            <div class="flex justify-end">
                <button type="button" @click="saveAll()"
                        :disabled="saving"
                        class="inline-flex items-center gap-2 px-6 py-3
                               bg-gradient-to-r from-indigo-500 to-purple-500
                               hover:from-indigo-600 hover:to-purple-600
                               text-white font-semibold rounded-xl
                               shadow-lg shadow-indigo-500/25 transition-all duration-200 cursor-pointer
                               disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg x-show="!saving" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                    </svg>
                    <svg x-show="saving" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    <span x-text="saving ? 'Kaydediliyor...' : 'Kaydet'"></span>
                </button>
            </div>
        </div>

        {{-- Toast --}}
        <div id="toast-msg" style="position: fixed; bottom: 24px; right: 24px; z-index: 10000; padding: 12px 24px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; box-shadow: 0 8px 24px rgba(0,0,0,0.15); transform: translateY(100px); opacity: 0; transition: all 0.3s ease;"></div>

    </div>
@endsection

@section('scripts')
<script>
    function navbarEditor() {
        const locale = '{{ $selectedLang }}';

        return {
            saving: false,
            searchPlaceholder: '{{ translateAttribute($navbarPageInfo, "search_placeholder", $selectedLang) }}',
            searchButtonText: '{{ translateAttribute($navbarPageInfo, "search_button_text", $selectedLang) }}',
            registerButtonText: '{{ translateAttribute($navbarPageInfo, "register_button_text", $selectedLang) }}',
            loginButtonText: '{{ translateAttribute($navbarPageInfo, "login_button_text", $selectedLang) }}',
            showSearch: {{ $navbarPageInfo->show_search ? 'true' : 'false' }},
            showRegisterButton: {{ $navbarPageInfo->show_register_button ? 'true' : 'false' }},
            showLoginButton: {{ $navbarPageInfo->show_login_button ? 'true' : 'false' }},
            showSocialLinks: {{ $navbarPageInfo->show_social_links ? 'true' : 'false' }},
            showCartButton: {{ $navbarPageInfo->show_cart_button ? 'true' : 'false' }},
            showSideInfoButton: {{ $navbarPageInfo->show_side_info_button ? 'true' : 'false' }},

            async saveAll() {
                this.saving = true;
                try {
                    const formData = new FormData();
                    formData.append('lang', locale);
                    formData.append('_token', '{{ csrf_token() }}');

                    formData.append('search_placeholder', this.searchPlaceholder);
                    formData.append('search_button_text', this.searchButtonText);
                    formData.append('register_button_text', this.registerButtonText);
                    formData.append('login_button_text', this.loginButtonText);

                    formData.append('show_search', this.showSearch ? '1' : '0');
                    formData.append('show_register_button', this.showRegisterButton ? '1' : '0');
                    formData.append('show_login_button', this.showLoginButton ? '1' : '0');
                    formData.append('show_social_links', this.showSocialLinks ? '1' : '0');
                    formData.append('show_cart_button', this.showCartButton ? '1' : '0');
                    formData.append('show_side_info_button', this.showSideInfoButton ? '1' : '0');

                    const res = await fetch('{{ route('pages.update', ['id' => 'navbar']) }}', {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                        body: formData,
                    });

                    const data = await res.json();
                    if (data.success) {
                        this.showToast('Kaydedildi', 'success');
                    } else {
                        this.showToast('Hata oluştu', 'error');
                    }
                } catch (e) {
                    this.showToast('Bağlantı hatası', 'error');
                }
                this.saving = false;
            },

            showToast(msg, type) {
                const el = document.getElementById('toast-msg');
                el.textContent = msg;
                el.style.background = type === 'success' ? 'rgb(84 62 232)' : 'rgb(215 59 62)';
                el.style.color = 'white';
                el.style.transform = 'translateY(0)';
                el.style.opacity = '1';
                setTimeout(() => { el.style.transform = 'translateY(100px)'; el.style.opacity = '0'; }, 2500);
            },
        };
    }
</script>
@endsection
