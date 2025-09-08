@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
        @yield('page-title', 'Takım Düzenle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <div class="flex items-center gap-2">
        <a href="{{ route('teams.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Yeni
            Takım Ekle</a>
    </div>
@endsection
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                height: 300,
                placeholder: 'Blog içeriğini girin',
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
            <form class="lg:w-1/2 w-full" action="{{ route('teams.updateTranslate', $team->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
                <div class="mb-6">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Başlık</label>
                    <input type="text" name="title" id="title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Başlık girin" value="{{ translateAttribute($team, 'title', request()->lang) }}">
                </div>
                <div class="mb-6">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Açıklama</label>
                    <textarea id="editor" name="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Açıklama girin">{{ translateAttribute($team, 'description', request()->lang) }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="position"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pozisyon</label>
                    <input type="text" name="position" id="position" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pozisyon girin" value="{{ translateAttribute($team, 'position', request()->lang) }}">
                </div>

                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection
