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
                <div class="mb-6">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Başlık</label>
                    <input type="text" name="title" id="title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Başlık girin"
                        value="{{ translateAttribute($servicesPageInfo, 'title', request()->lang) }}">

                </div>
                <div class="mb-6">
                    <label for="subtitle" class="block mb-2 text-sm font-medium text-gray-900 ">Alt
                        Başlık</label>
                    <input type="text" name="subtitle" id="subtitle" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Alt başlık girin"
                        value="{{ translateAttribute($servicesPageInfo, 'subtitle', request()->lang) }}">

                </div>

                <div class="mb-6">
                    <label for="content"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Açıklama</label>
                    <textarea id="editor" name="content"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Açıklama girin">{{ translateAttribute($servicesPageInfo, 'description', request()->lang) }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="info_title" class="block mb-2 text-sm font-medium text-gray-900 ">Info
                        Başlık</label>
                    <input type="text" name="info_title" id="info_title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Başlık girin"
                        value="{{ translateAttribute($servicesPageInfo, 'info_title', request()->lang) }}">

                </div>
                <div class="mb-6">
                    <label for="info_subtitle" class="block mb-2 text-sm font-medium text-gray-900 ">Info Alt
                        Başlık</label>
                    <input type="text" name="info_subtitle" id="info_subtitle" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Alt başlık girin"
                        value="{{ translateAttribute($servicesPageInfo, 'info_subtitle', request()->lang) }}">

                </div>

                <div class="mb-6">
                    <label for="info_content" class="block mb-2 text-sm font-medium text-gray-900 ">Info
                        Açıklama</label>
                    <textarea id="info_editor" name="info_content"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Açıklama girin">{{ translateAttribute($servicesPageInfo, 'info_description', request()->lang) }}</textarea>
                </div>
                <div class="mb-6">
                    <label for="info_skil_column_1"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Info Özellik 1</label>
                    <input type="text" name="info_skil_column_1" id="info_skil_column_1"
                        aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Alt başlık girin"
                        value="{{ translateAttribute($servicesPageInfo, 'info_skil_column_1', request()->lang) }}">

                </div>
                <div class="mb-6">
                    <label for="info_skil_column_2"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Info Özellik 2</label>
                    <input type="text" name="info_skil_column_2" id="info_skil_column_2"
                        aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Alt başlık girin"
                        value="{{ translateAttribute($servicesPageInfo, 'info_skil_column_2', request()->lang) }}">

                </div>
                <div class="mb-6">
                    <label for="info_skil_column_3"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Info Özellik 3</label>
                    <input type="text" name="info_skil_column_3" id="info_skil_column_3"
                        aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Alt başlık girin"
                        value="{{ translateAttribute($servicesPageInfo, 'info_skil_column_3', request()->lang) }}">

                </div>



                <div class="mb-6">
                    <label for="faq_title" class="block mb-2 text-sm font-medium text-gray-900 ">SSS
                        Başlık</label>
                    <input type="text" name="faq_title" id="faq_title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Başlık girin"
                        value="{{ translateAttribute($servicesPageInfo, 'faq_title', request()->lang) }}">

                </div>



                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection
