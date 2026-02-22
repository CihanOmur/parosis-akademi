@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('languages.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Yeni Dil Ekle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sisteme yeni bir dil tanımı ekleyin</p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('languages.store') }}" method="POST"
      x-data="{
          locale: '{{ old('locale') }}',
          defaultName: '{{ old('default_name') }}',
          get badge() { return this.locale ? this.locale.toUpperCase().slice(0,2) : '??' },
      }">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── Sol kolon ──────────────────────────────────── --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Kimlik kartı --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">

                {{-- Dekoratif arka plan --}}
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none"></div>

                {{-- Başlık --}}
                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Dil Kimliği</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Locale kodu ve dilin kendi adı</p>
                    </div>
                </div>

                {{-- İçerik --}}
                <div class="relative p-6 space-y-5">

                    {{-- Locale kodu + canlı önizleme --}}
                    <div class="flex items-start gap-4">
                        {{-- Canlı badge --}}
                        <div class="flex-shrink-0 pt-6">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center border-2 transition-all duration-300
                                        border-fuchsia-200 dark:border-fuchsia-700/50 bg-fuchsia-50 dark:bg-fuchsia-900/20
                                        shadow-inner">
                                <span x-text="badge"
                                      class="text-lg font-extrabold tracking-widest text-fuchsia-600 dark:text-fuchsia-400 font-mono transition-all duration-200"></span>
                            </div>
                        </div>

                        <div class="flex-1 space-y-1">
                            <label for="locale" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                Locale Kodu <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="locale" id="locale"
                                       x-model="locale"
                                       class="w-full pl-4 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                              text-slate-900 dark:text-white placeholder-slate-400 font-mono text-sm
                                              ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                                       placeholder="ör: tr · en · en-gb · zh-cn">
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                2 harfli dil kodu (ISO 639-1). Bölgesel variant için tire ekleyin:
                                <span class="font-mono text-fuchsia-500">en-gb</span>,
                                <span class="font-mono text-fuchsia-500">pt-br</span>,
                                <span class="font-mono text-fuchsia-500">zh-cn</span>
                            </p>
                            @error('locale')
                                <p class="text-sm text-red-500 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Ayırıcı --}}
                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Dilin kendi adı --}}
                    <div class="space-y-1">
                        <label for="default_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Dilin Kendi Adı <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="default_name" id="default_name"
                               x-model="defaultName"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="ör: Türkçe · English · Français">
                        <p class="text-xs text-slate-400">Bu dilin kendi dilinde nasıl yazıldığı (native adı)</p>
                        @error('default_name')
                            <p class="text-sm text-red-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ── Çeviriler ──────────────────────────────── --}}
            @if ($activeLanguages->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50"
                 x-data="{ activeTab: '{{ $activeLanguages->firstWhere('locale', $selectedLang) ? $selectedLang : ($activeLanguages->first()?->locale ?? '') }}' }">

                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 0 1 6.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Çeviriler</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Diğer aktif dillerdeki karşılıkları (opsiyonel)</p>
                    </div>
                    <span class="text-xs font-medium px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-800/40">
                        {{ $activeLanguages->count() }} dil
                    </span>
                </div>

                {{-- Tab bar --}}
                @if ($activeLanguages->count() > 1)
                    <div class="px-6 pt-4">
                        <div class="flex items-center gap-1 p-1 bg-slate-100 dark:bg-slate-700/50 rounded-xl overflow-x-auto">
                            @foreach($activeLanguages as $tabLang)
                                <button type="button"
                                        @click="activeTab = '{{ $tabLang->locale }}'"
                                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg text-sm font-medium transition-all duration-200 whitespace-nowrap flex-shrink-0 cursor-pointer"
                                        :class="activeTab === '{{ $tabLang->locale }}'
                                            ? 'bg-white dark:bg-slate-800 text-blue-600 dark:text-blue-400 shadow-sm'
                                            : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 hover:bg-white/60 dark:hover:bg-slate-800/60'">
                                    <span class="w-6 h-6 rounded-md flex items-center justify-center text-xs font-bold transition-colors"
                                          :class="activeTab === '{{ $tabLang->locale }}'
                                              ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400'
                                              : 'bg-slate-200 dark:bg-slate-600 text-slate-500 dark:text-slate-400'">
                                        {{ strtoupper(substr($tabLang->locale, 0, 2)) }}
                                    </span>
                                    {{ $tabLang->name ?: $tabLang->locale }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Çeviri inputları --}}
                <div class="p-6 space-y-4">
                    @foreach ($activeLanguages as $lang)
                        <div x-show="activeTab === '{{ $lang->locale }}' || {{ $activeLanguages->count() === 1 ? 'true' : 'false' }}"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                {{ $lang->name ?: $lang->locale }}
                                <span class="font-mono text-xs text-slate-400 ml-1">({{ $lang->locale }})</span>
                            </label>
                            <input type="text" name="names[{{ $lang->locale }}]"
                                   class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                          text-slate-900 dark:text-white placeholder-slate-400
                                          ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-blue-500/50 transition-all"
                                   placeholder="Bu dilde karşılığı..."
                                   value="{{ old('names.' . $lang->locale) }}">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- ── Sağ kolon ──────────────────────────────────── --}}
        <div class="space-y-5 sticky top-24 self-start">

            {{-- Önizleme kartı --}}
            <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-2xl p-5 text-white shadow-xl shadow-fuchsia-500/20 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-10 translate-x-10"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full translate-y-8 -translate-x-6"></div>
                <div class="relative">
                    <p class="text-fuchsia-100 text-xs font-medium uppercase tracking-wider mb-3">Önizleme</p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30 flex-shrink-0">
                            <span x-text="badge" class="text-base font-extrabold font-mono tracking-widest"></span>
                        </div>
                        <div class="min-w-0">
                            <p class="font-semibold text-lg leading-tight truncate"
                               x-text="defaultName || 'Dil Adı'"></p>
                            <p class="text-fuchsia-200 text-sm font-mono"
                               x-text="locale || 'locale-kodu'"></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Durum --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Yayın Durumu</h3>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative flex-shrink-0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 dark:bg-slate-600 rounded-full
                                    peer peer-checked:bg-fuchsia-500
                                    after:content-[''] after:absolute after:top-0.5 after:start-[2px]
                                    after:bg-white after:rounded-full after:h-5 after:w-5
                                    after:transition-all peer-checked:after:translate-x-full
                                    transition-colors duration-200"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white transition-colors">
                            Frontend'de Aktif
                        </p>
                        <p class="text-xs text-slate-400 mt-0.5">Ziyaretçiler bu dili görebilir</p>
                    </div>
                </label>
            </div>

            {{-- Aksiyonlar --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5 space-y-3">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                               bg-gradient-to-r from-fuchsia-500 to-purple-600
                               hover:from-fuchsia-600 hover:to-purple-700
                               text-white font-semibold text-sm rounded-xl
                               shadow-lg shadow-fuchsia-500/25
                               transition-all duration-200 active:scale-[.98] cursor-pointer">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Dili Kaydet
                </button>
                <a href="{{ route('languages.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700
                          text-slate-600 dark:text-slate-400 font-medium text-sm rounded-xl
                          border border-slate-200/60 dark:border-slate-600/50
                          transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    İptal
                </a>
            </div>

            {{-- İpucu --}}
            <div class="bg-amber-50 dark:bg-amber-900/10 border border-amber-200/60 dark:border-amber-800/30 rounded-2xl p-4">
                <div class="flex gap-3">
                    <svg class="w-4.5 h-4.5 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd"/>
                    </svg>
                    <div class="space-y-1.5">
                        <p class="text-xs font-semibold text-amber-800 dark:text-amber-400">Locale Kodu Formatı</p>
                        <div class="text-xs text-amber-700 dark:text-amber-500 space-y-1">
                            <p><span class="font-mono font-semibold">tr</span> → Türkçe</p>
                            <p><span class="font-mono font-semibold">en</span> → İngilizce</p>
                            <p><span class="font-mono font-semibold">en-gb</span> → İngilizce (UK)</p>
                            <p><span class="font-mono font-semibold">zh-cn</span> → Çince (Basit)</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
@endsection
