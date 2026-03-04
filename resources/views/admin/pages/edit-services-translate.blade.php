@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', 'Hizmetlerimiz Sayfası Düzenle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
@endsection
@section('styles')
    <link href="{{ asset('tomselect.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                height: 300,
                placeholder: 'Projelerimiz içeriğini girin',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript',
                        'subscript', 'removeFormat', 'code'
                    ]],
                    ['font', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture']]
                ]
            });
        });
        $(document).ready(function() {
            $('#info_editor').summernote({
                height: 300,
                placeholder: 'Projelerimiz içeriğini girin',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript',
                        'subscript', 'removeFormat', 'code'
                    ]],
                    ['font', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture']]
                ]
            });
        });
    </script>
@endsection
@section('content')
    <div class="rounded-lg mb-4">

        <div class="w-full bg-white py-10 px-8 rounded-lg">
            <form class="lg:w-1/2 w-full" action="{{ route('pages.updateTranslate', ['id' => 'services']) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
                <x-text-input name="title" label="Başlık" placeholder="Başlık girin" ringColor="blue"
                    :value="translateAttribute($servicesPageInfo, 'title', request()->lang)" />
                <x-text-input name="subtitle" label="Alt Başlık" placeholder="Alt başlık girin" ringColor="blue"
                    :value="translateAttribute($servicesPageInfo, 'subtitle', request()->lang)" />

                <div class="mb-6">
                    <label for="content"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Açıklama</label>
                    <textarea id="editor" name="content"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Açıklama girin">{{ translateAttribute($servicesPageInfo, 'description', request()->lang) }}</textarea>
                </div>

                <x-text-input name="info_title" label="Info Başlık" placeholder="Başlık girin" ringColor="blue"
                    :value="translateAttribute($servicesPageInfo, 'info_title', request()->lang)" />
                <x-text-input name="info_subtitle" label="Info Alt Başlık" placeholder="Alt başlık girin" ringColor="blue"
                    :value="translateAttribute($servicesPageInfo, 'info_subtitle', request()->lang)" />

                <div class="mb-6">
                    <label for="info_content" class="block mb-2 text-sm font-medium text-gray-900 ">Info
                        Açıklama</label>
                    <textarea id="info_editor" name="info_content"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Açıklama girin">{{ translateAttribute($servicesPageInfo, 'info_description', request()->lang) }}</textarea>
                </div>
                <x-text-input name="info_skil_column_1" label="Info Özellik 1" placeholder="Alt başlık girin" ringColor="blue"
                    :value="translateAttribute($servicesPageInfo, 'info_skil_column_1', request()->lang)" />
                <x-text-input name="info_skil_column_2" label="Info Özellik 2" placeholder="Alt başlık girin" ringColor="blue"
                    :value="translateAttribute($servicesPageInfo, 'info_skil_column_2', request()->lang)" />
                <x-text-input name="info_skil_column_3" label="Info Özellik 3" placeholder="Alt başlık girin" ringColor="blue"
                    :value="translateAttribute($servicesPageInfo, 'info_skil_column_3', request()->lang)" />



                <x-text-input name="faq_title" label="SSS Başlık" placeholder="Başlık girin" ringColor="blue"
                    :value="translateAttribute($servicesPageInfo, 'faq_title', request()->lang)" />



                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection
