@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', 'Referanslarımız Sayfası Düzenle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
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
                placeholder: 'İçerik girin',
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
            <form class="lg:w-1/2 w-full" action="{{ route('pages.update', ['id' => 'references']) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
                <div class="mb-6">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Başlık</label>
                    <input type="text" name="title" id="title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Başlık girin"
                        value="{{ translateAttribute($referencesPageInfo, 'title', request()->lang) }}">

                </div>
                <div class="mb-6">
                    <label for="subtitle" class="block mb-2 text-sm font-medium text-gray-900 ">Alt
                        Başlık</label>
                    <input type="text" name="subtitle" id="subtitle" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Alt başlık girin"
                        value="{{ translateAttribute($referencesPageInfo, 'subtitle', request()->lang) }}">

                </div>

                <div class="mb-6">
                    <label for="content"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Açıklama</label>
                    <textarea id="editor" name="content"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Açıklama girin">{{ translateAttribute($referencesPageInfo, 'description', request()->lang) }}</textarea>
                </div>


                <div class="mb-6">
                    <label for="contact_title" class="block mb-2 text-sm font-medium text-gray-900 ">İletişim
                        Başlığı</label>
                    <input type="text" name="contact_title" id="contact_title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Başlık girin"
                        value="{{ translateAttribute($referencesPageInfo, 'contact_title', request()->lang) }}">

                </div>
                <div class="mb-6">
                    <label for="contact_button_title"
                        class="block mb-2 text-sm font-medium text-gray-900 ">İletişim
                        Butonu Başlığı</label>
                    <input type="text" name="contact_button_title" id="contact_button_title"
                        aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Başlık girin"
                        value="{{ translateAttribute($referencesPageInfo, 'contact_button_title', request()->lang) }}">

                </div>
                <div class="mb-6">
                    <label for="contact_button_link"
                        class="block mb-2 text-sm font-medium text-gray-900 ">İletişim
                        Butonu Bağlantısı</label>
                    <input type="link" name="contact_button_link" id="contact_button_link"
                        aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Başlık girin"
                        value="{{ translateAttribute($referencesPageInfo, 'contact_button_link', request()->lang) }}">

                </div>

                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection
