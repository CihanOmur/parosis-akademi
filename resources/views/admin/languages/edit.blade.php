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
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Dil Düzenle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                <span class="font-mono font-semibold text-fuchsia-600 dark:text-fuchsia-400">{{ $language->locale }}</span>
                dilini düzenleyin
            </p>
        </div>
    </div>
@endsection

@section('content')
@php
    $existingTranslations = $language->getTranslations('name');
    $currentDefaultName   = old('default_name', $existingTranslations[$language->locale] ?? (array_values($existingTranslations)[0] ?? ''));
    $otherLanguages       = $activeLanguages->filter(fn($l) => $l->locale !== $language->locale)->values();
    $activeTab            = $otherLanguages->firstWhere('locale', $selectedLang)
        ? $selectedLang
        : ($otherLanguages->first()?->locale ?? '');
@endphp

<form action="{{ route('languages.update', $language->id) }}" method="POST"
      x-data="{
          locale: '{{ old('locale', $language->locale) }}',
          defaultName: '{{ addslashes($currentDefaultName) }}',
          get badge() { return this.locale ? this.locale.toUpperCase().slice(0,2) : '??' },
      }">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── Sol kolon ──────────────────────────────────── --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Kimlik kartı --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">

                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none"></div>

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

                <div class="relative p-6 space-y-5">

                    {{-- Locale kodu + canlı önizleme --}}
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 pt-6">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center border-2 transition-all duration-300
                                        border-fuchsia-200 dark:border-fuchsia-700/50 bg-fuchsia-50 dark:bg-fuchsia-900/20 shadow-inner">
                                <span x-text="badge"
                                      class="text-lg font-extrabold tracking-widest text-fuchsia-600 dark:text-fuchsia-400 font-mono"></span>
                            </div>
                        </div>

                        <div class="flex-1">
                            <x-text-input name="locale" label="Locale Kodu" required
                                :value="$language->locale"
                                x-model="locale"
                                inputClass="font-mono" />
                            <p class="text-xs text-slate-400 mt-1">
                                ISO 639-1 kodu. Bölgesel variant:
                                <span class="font-mono text-fuchsia-500">en-gb</span>,
                                <span class="font-mono text-fuchsia-500">pt-br</span>
                            </p>
                        </div>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Dilin kendi adı --}}
                    <x-text-input name="default_name" label="Dilin Kendi Adı" required
                        :value="$currentDefaultName"
                        x-model="defaultName" />
                    <p class="text-xs text-slate-400 -mt-0.5">Bu dilin kendi dilinde native adı</p>
                </div>
            </div>

            {{-- ── Çeviriler ──────────────────────────────── --}}
            @if ($otherLanguages->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50"
                 x-data="{ activeTab: '{{ $activeTab }}' }">

                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 0 1 6.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Çeviriler</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Bu dilin diğer aktif dillerdeki karşılıkları</p>
                    </div>
                    <span class="text-xs font-medium px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-800/40">
                        {{ $otherLanguages->count() }} dil
                    </span>
                </div>

                @if ($otherLanguages->count() > 1)
                    <div class="px-6 pt-4">
                        <div class="flex items-center gap-1 p-1 bg-slate-100 dark:bg-slate-700/50 rounded-xl overflow-x-auto">
                            @foreach($otherLanguages as $tabLang)
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
                                    @php $hasVal = !empty($existingTranslations[$tabLang->locale]) || !empty(old('names.' . $tabLang->locale)); @endphp
                                    @if($hasVal)
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400 flex-shrink-0"></span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="p-6 space-y-4">
                    @foreach ($otherLanguages as $lang)
                        <div x-show="activeTab === '{{ $lang->locale }}' || {{ $otherLanguages->count() === 1 ? 'true' : 'false' }}"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0">
                            <x-text-input name="names[{{ $lang->locale }}]"
                                label="{{ ($lang->name ?: $lang->locale) . ' (' . $lang->locale . ')' }}"
                                placeholder="Bu dilde karşılığı..."
                                :value="$existingTranslations[$lang->locale] ?? ''"
                                ringColor="blue" />
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- ── Sağ kolon ──────────────────────────────────── --}}
        <div class="space-y-5 sticky top-24 self-start">

            {{-- Canlı önizleme --}}
            <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-2xl p-5 text-white shadow-xl shadow-fuchsia-500/20 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-10 translate-x-10"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full translate-y-8 -translate-x-6"></div>
                <div class="relative">
                    <p class="text-fuchsia-100 text-xs font-medium uppercase tracking-wider mb-3">Canlı Önizleme</p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30 flex-shrink-0">
                            <span x-text="badge" class="text-base font-extrabold font-mono tracking-widest"></span>
                        </div>
                        <div class="min-w-0">
                            <p class="font-semibold text-lg leading-tight truncate"
                               x-text="defaultName || '—'"></p>
                            <p class="text-fuchsia-200 text-sm font-mono"
                               x-text="locale || '—'"></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mevcut çeviriler özeti --}}
            @if(!empty($existingTranslations))
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Kayıtlı Çeviriler</h3>
                <div class="space-y-2">
                    @foreach($existingTranslations as $loc => $val)
                        @if($val)
                        <div class="flex items-center gap-2.5">
                            <span class="w-7 h-7 rounded-lg flex items-center justify-center text-[10px] font-bold
                                         bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-mono flex-shrink-0">
                                {{ strtoupper(substr($loc, 0, 2)) }}
                            </span>
                            <span class="text-sm text-slate-700 dark:text-slate-300 truncate">{{ $val }}</span>
                            <span class="ml-auto text-xs font-mono text-slate-400">{{ $loc }}</span>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Durum --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Yayın Durumu</h3>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative flex-shrink-0">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $language->is_active) ? 'checked' : '' }}
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
                    Güncelle
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

                {{-- Silme (varsayılan değilse) --}}
                @if(!$language->is_default)
                <form action="{{ route('languages.delete', $language->id) }}" method="POST"
                      x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Dili Sil', message: '{{ addslashes($language->getTranslation('name', app()->getLocale()) ?: $language->locale) }} dilini silmek istediğinize emin misiniz?', form: $el })">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                                   bg-red-50 dark:bg-red-900/10 hover:bg-red-100 dark:hover:bg-red-900/20
                                   text-red-600 dark:text-red-400 font-medium text-sm rounded-xl
                                   border border-red-200/60 dark:border-red-800/30
                                   transition-all duration-200 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                        </svg>
                        Dili Sil
                    </button>
                </form>
                @endif
            </div>

        </div>
    </div>
</form>
@endsection
