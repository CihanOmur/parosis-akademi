@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Footer Çeviri</h1>
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
        <form action="{{ route('pages.updateTranslate', ['id' => 'footer']) }}" method="POST">
            @csrf
            <input type="hidden" name="lang" value="{{ $selectedLang }}">

            <div class="space-y-6">

                {{-- ═══ Genel Metinler ═══ --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-fuchsia-50 dark:bg-fuchsia-900/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Çevrilebilir İçerikler</h3>
                                <p class="text-xs text-slate-400 dark:text-slate-500">Sadece metin içerikleri çevrilir</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-5">
                        <x-textarea name="about_text" label="Hakkında Metni" rows="3"
                            placeholder="Footer hakkında metni..."
                            :value="translateAttribute($footerPageInfo, 'about_text', $selectedLang)" />

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <x-text-input name="links_title" label="Bağlantılar Başlığı" placeholder="Bağlantılar"
                                :value="translateAttribute($footerPageInfo, 'links_title', $selectedLang)" />
                            <x-text-input name="contact_title" label="İletişim Başlığı" placeholder="İletişim"
                                :value="translateAttribute($footerPageInfo, 'contact_title', $selectedLang)" />
                            <x-text-input name="newsletter_title" label="Bülten Başlığı" placeholder="Abone Olun"
                                :value="translateAttribute($footerPageInfo, 'newsletter_title', $selectedLang)" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <x-text-input name="support_label" label="Destek Etiketi" placeholder="7/24 Destek"
                                :value="translateAttribute($footerPageInfo, 'support_label', $selectedLang)" />
                            <x-text-input name="email_label" label="E-posta Etiketi" placeholder="Mesaj Gönderin"
                                :value="translateAttribute($footerPageInfo, 'email_label', $selectedLang)" />
                            <x-text-input name="address_label" label="Adres Etiketi" placeholder="Adresimiz"
                                :value="translateAttribute($footerPageInfo, 'address_label', $selectedLang)" />
                        </div>

                        <x-text-input name="newsletter_text" label="Bülten Açıklaması"
                            placeholder="Bültenimize abone olmak için e-posta adresinizi girin"
                            :value="translateAttribute($footerPageInfo, 'newsletter_text', $selectedLang)" />

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-text-input name="newsletter_placeholder" label="Input Placeholder" placeholder="E-posta girin"
                                :value="translateAttribute($footerPageInfo, 'newsletter_placeholder', $selectedLang)" />
                            <x-text-input name="newsletter_button" label="Buton Metni" placeholder="Abone Ol"
                                :value="translateAttribute($footerPageInfo, 'newsletter_button', $selectedLang)" />
                        </div>

                        <x-text-input name="copyright_text" label="Copyright Metni"
                            placeholder="Copyright {{ date('Y') }} Parosis Akademi | Tüm Hakları Saklıdır"
                            :value="translateAttribute($footerPageInfo, 'copyright_text', $selectedLang)" />
                    </div>
                </div>

                {{-- ═══ Navigasyon Link Etiketleri ═══ --}}
                @if($footerPageInfo->nav_links && count($footerPageInfo->nav_links) > 0)
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Link Etiketleri Çevirisi</h3>
                                <p class="text-xs text-slate-400 dark:text-slate-500">Navigasyon linkleri etiketlerinin çevirisi</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        @foreach($footerPageInfo->nav_links as $index => $link)
                            @php
                                $linkLabel = is_array($link['label'] ?? null)
                                    ? ($link['label'][$selectedLang] ?? ($link['label'][app()->getLocale()] ?? ''))
                                    : ($link['label'] ?? '');
                                $linkUrl = $link['url'] ?? '';
                            @endphp
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-slate-400 dark:text-slate-500 w-24 truncate flex-shrink-0" title="{{ $linkUrl }}">{{ $linkUrl }}</span>
                                <input type="text" name="nav_link_labels[{{ $index }}]" value="{{ $linkLabel }}"
                                       placeholder="Link etiketi çevirisi"
                                       class="flex-1 px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                              text-slate-900 dark:text-white placeholder-slate-400
                                              ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-indigo-500/60 transition-all">
                            </div>
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
