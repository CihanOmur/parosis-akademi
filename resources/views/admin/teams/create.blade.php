@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
        @yield('page-title', 'Takım Ekle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
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
            <form class="lg:w-1/2 w-full" action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
                <div class="mb-6">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Başlık</label>
                    <input type="text" name="title" id="title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Başlık girin">
                </div>
                <div class="mb-6">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Açıklama</label>
                    <textarea id="editor" name="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Açıklama girin"></textarea>
                </div>

                <div class="mb-6">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sektör
                        Seçiniz</label>
                    <select id="category" name="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="position"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pozisyon</label>
                    <input type="text" name="position" id="position" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pozisyon girin">
                </div>


                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="file">Görsel</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_help" name="file" id="file" type="file">
                </div>
                <div id="preview_file" class="mb-6 ">
                    <img id="preview_image" src="" alt="Preview" class="hidden rounded-lg w-60 h-auto">
                </div>
                <script>
                    $(document).ready(function() {
                        $('#file').change(function() {
                            const file = this.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#preview_image').attr('src', e.target.result).removeClass('hidden');
                                }
                                reader.readAsDataURL(file);
                            } else {
                                $('#preview_image').addClass('hidden');
                            }
                        });
                    });
                </script>

                <div class="mb-6">
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-posta</label>
                    <input type="email" name="email" id="email" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="E-posta girin">
                </div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kişisel Bilgiler</label>
                <div id="personal-info-wrapper" class="space-y-4 ">
                    <div class="personal-info-item flex items-center gap-4">
                        <div class="w-1/3">
                            <input type="text" name="personal_infos[0][title]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Başlık">
                        </div>

                        <div class="w-2/3">
                            <input type="text" name="personal_infos[0][description]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Açıklama">
                        </div>

                        <button type="button"
                            class="remove-info text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                    </div>
                </div>


                <div class="flex justify-end">
                    <button type="button" id="add-info"
                        class="my-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Ekle
                    </button>
                </div>


                <script>
                    let index = 1;

                    $('#add-info').on('click', function() {
                        const field = `
                <div class="personal-info-item flex items-center gap-4">
                    <div class="w-1/3">
                        <input type="text" name="personal_infos[${index}][title]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Başlık">
                    </div>

                    <div class="w-2/3">
                        <input type="text" name="personal_infos[${index}][description]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Açıklama">
                    </div>

                    <button type="button"
                        class="remove-info text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                </div>
            `;
                        $('#personal-info-wrapper').append(field);
                        index++;
                    });

                    $(document).on('click', '.remove-info', function() {
                        $(this).closest('.personal-info-item').remove();
                    });
                </script>
                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection
