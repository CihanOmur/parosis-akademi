@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">İletişim Sayfası Çeviri</h1>
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

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote-editor').each(function() {
                $(this).summernote({
                    height: 200,
                    placeholder: 'İçeriğini girin...',
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['fontname', 'fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture']]
                    ]
                });
            });
        });
    </script>
@endsection

@section('content')
    {{-- Language Tabs --}}
    <div class="mb-6">
        @include('admin.components.language-tabs', ['selectedLang' => $selectedLang])
    </div>

    <div class="max-w-2xl">
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
                        <p class="text-xs text-slate-400 dark:text-slate-500">Sadece metin içerikleri çevrilir, iletişim bilgileri ortaktır</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('pages.updateTranslate', ['id' => 'contact']) }}" method="POST">
                    @csrf
                    <input type="hidden" name="lang" value="{{ $selectedLang }}">

                    <div class="space-y-5">
                        <x-text-input name="title" label="Sayfa Başlığı" placeholder="Başlık girin"
                            :value="translateAttribute($contactPageInfo, 'title', $selectedLang)" />
                        <x-text-input name="subtitle" label="Alt Başlık" placeholder="Alt başlık girin"
                            :value="translateAttribute($contactPageInfo, 'subtitle', $selectedLang)" />
                        <div>
                            <label class="block mb-1.5 text-sm font-medium text-slate-700 dark:text-slate-300">Açıklama</label>
                            <textarea name="content" class="summernote-editor">{{ translateAttribute($contactPageInfo, 'description', $selectedLang) }}</textarea>
                        </div>
                        <x-text-input name="form_title" label="Form Başlığı" placeholder="Form başlığı girin"
                            :value="translateAttribute($contactPageInfo, 'form_title', $selectedLang)" />
                        <div>
                            <label class="block mb-1.5 text-sm font-medium text-slate-700 dark:text-slate-300">Form Açıklaması</label>
                            <textarea name="form_description" class="summernote-editor">{{ translateAttribute($contactPageInfo, 'form_description', $selectedLang) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
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
                </form>
            </div>
        </div>
    </div>
@endsection
