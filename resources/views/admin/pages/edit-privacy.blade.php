@extends('admin.layouts.app')

@section('page-banner')
    <div class="w-full">
        <div class="flex items-center gap-3">
            <x-back-button :href="route('pages.index')" />
            <div class="min-w-0">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Gizlilik Politikası Sayfası</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sitedeki gizlilik politikası metnini düzenleyin</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- Language Tabs --}}
    <div class="mb-5">
        @include('admin.components.language-tabs', ['selectedLang' => $selectedLang])
    </div>

<form action="{{ route('pages.update', 'privacy') }}" method="POST">
    @csrf
    <input type="hidden" name="lang" value="{{ $selectedLang }}">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol kolon --}}
        <div class="lg:col-span-2 space-y-5">

            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Sayfa İçeriği</h3>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $activeLanguages->firstWhere('locale', $selectedLang)?->name ?: $selectedLang }} dilindeki metin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    <x-text-input name="title" label="Sayfa Başlığı" placeholder="Gizlilik Politikası" :value="$privacyPageInfo->getTranslation('title', $selectedLang, false)" />

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <x-text-input name="breadcrumb_home" label="Breadcrumb: Ana Sayfa" placeholder="ANA SAYFA" :value="$privacyPageInfo->getTranslation('breadcrumb_home', $selectedLang, false)" />
                        <x-text-input name="breadcrumb_current" label="Breadcrumb: Bu Sayfa" placeholder="GİZLİLİK POLİTİKASI" :value="$privacyPageInfo->getTranslation('breadcrumb_current', $selectedLang, false)" />
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <x-textarea name="content" label="Metin" placeholder="Gizlilik politikası metnini yazın..." rows="16" :value="$privacyPageInfo->getTranslation('content', $selectedLang, false)" inputClass="tinymce-editor" />
                </div>
            </div>
        </div>

        {{-- Sağ kolon --}}
        <div class="space-y-5 sticky top-24 self-start">

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
                    Kaydet
                </button>
                <a href="{{ route('front.privacy', ['locale' => $selectedLang]) }}" target="_blank" rel="noopener"
                   class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700
                          text-slate-600 dark:text-slate-400 font-medium text-sm rounded-xl
                          border border-slate-200/60 dark:border-slate-600/50
                          transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                    </svg>
                    Sayfayı Görüntüle
                </a>
            </div>

            {{-- Bağlantı bilgisi --}}
            <div class="bg-fuchsia-50 dark:bg-fuchsia-900/10 border border-fuchsia-200/60 dark:border-fuchsia-800/30 rounded-2xl p-4 space-y-2">
                <p class="text-xs font-semibold text-fuchsia-800 dark:text-fuchsia-400">Sayfa adresi</p>
                <p class="text-xs text-fuchsia-700 dark:text-fuchsia-500 font-mono break-all">/{{ $selectedLang }}/gizlilik-politikasi</p>
                <p class="text-xs text-fuchsia-700 dark:text-fuchsia-500">
                    İletişim ve SSS formlarındaki onay metninde bağlantı vermek için:
                    <span class="font-mono break-all">[Gizlilik Politikası](/{{ $selectedLang }}/gizlilik-politikasi)</span>
                </p>
            </div>
        </div>
    </div>
</form>
@endsection

@push('head')
    <link rel="preload" href="/tinymce/tinymce.min.js" as="script">
@endpush

@section('scripts')
    <script src="/tinymce/tinymce.min.js"></script>
    @vite('resources/js/tinymce-init.js')
@endsection
