@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
        @yield('page-title', 'Proje Ekle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <div class="flex items-center gap-2">
        <a href="{{ route('projects.create') }}"
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Yeni Proje
            Ekle</a>
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
    <script>
        $(document).ready(function() {
            $('#editor_short').summernote({
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
            <form class="lg:w-1/2 w-full" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data"
                id="myForm">
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
                    <label for="short_content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kısa
                        Açıklama</label>
                    <textarea id="editor_short" name="short_content"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Kısa açıklama girin"></textarea>
                </div>
                <div class="mb-6">
                    <label for="content"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Açıklama</label>
                    <textarea id="editor" name="content"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Açıklama girin"></textarea>
                </div>

                <div class="mb-6">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                        Seçiniz</label>
                    <select id="category" name="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
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

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Özellikler</label>
                <div id="project-info-items-wrapper" class="space-y-4 ">
                    <div class="project-info-items-item flex items-center gap-4">
                        <div class="w-1/3">
                            <input type="text" name="info_items[0][title]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Başlık">
                        </div>

                        <div class="w-2/3">
                            <input type="text" name="info_items[0][description]"
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
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Galeri</label>
                <div id="project-gallery-wrapper" class="space-y-4">
                    <div class="project-gallery-item flex flex-col gap-4" data-gallery-id="0">
                        <div class="flex items-center gap-4">
                            <div class="w-1/3">
                                <input type="text" name="gallery_items[0][title]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Başlık">
                            </div>

                            <div class="w-2/3 relative">
                                <input type="file" name="gallery_items[0][file]"
                                    class="gallery-file-input block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    data-gallery-id="0" accept="image/*,video/*">

                                <input type="hidden" name="gallery_items[0][uploaded_file]" id="uploaded-file-0"
                                    value="">
                            </div>

                            <button type="button"
                                class="remove-gallery text-red-600 hover:text-red-800 font-semibold text-xl flex items-center"
                                data-gallery-id="0">×</button>
                        </div>

                        <div class="hidden mt-1 h-2 bg-gray-200 rounded overflow-hidden" id="progress-wrapper-0">
                            <div class="bg-blue-600 h-2 progress-bar" id="progress-bar-0" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <div id="gallery-preview-section" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4"></div>
                <div class="flex justify-end">
                    <button type="button" id="add-gallery"
                        class="my-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Ekle
                    </button>
                </div>

                <div class="">
                    <button type="button" id="submitBtn"
                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
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

    <script>
        $('#submitBtn').on('click', function() {
            const activeUploads = $('.progress-bar').filter(function() {
                return $(this).width() > 0 && !$(this).hasClass('upload-complete');
            });

            if (activeUploads.length > 0) {
                showToast('error', 'Lütfen yükleme işlemini bekleyin.');
                return false;
            }
            $('#myForm').submit();
        });
    </script>

    <script>
        let index = 1;

        $('#add-info').on('click', function() {
            const field = `
                <div class="project-info-items-item flex items-center gap-4">
                    <div class="w-1/3">
                        <input type="text" name="info_items[${index}][title]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Başlık">
                    </div>

                    <div class="w-2/3">
                        <input type="text" name="info_items[${index}][description]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Açıklama">
                    </div>

                    <button type="button"
                        class="remove-info text-red-600 hover:text-red-800 font-semibold text-xl flex items-center">×</button>
                </div>
            `;
            $('#project-info-items-wrapper').append(field);
            index++;
        });

        $(document).on('click', '.remove-info', function() {
            $(this).closest('.project-info-items-item').remove();
            if ($('#project-info-items-wrapper .project-info-items-item').length === 0) {
                $('#add-info').click();
            }
        });
    </script>

    <script>
        let galleryIndex = 1;

        $('#add-gallery').on('click', function() {
            const id = galleryIndex;
            const field = `
                <div class="project-gallery-item flex flex-col gap-4" data-gallery-id="${id}">
                    <div class="flex items-center gap-4">
                        <div class="w-1/3">
                            <input type="text" name="gallery_items[${id}][title]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Başlık">
                        </div>

                        <div class="w-2/3 relative">
                            <input type="file" name="gallery_items[${id}][file]"
                                class="gallery-file-input block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                data-gallery-id="${id}" accept="image/*,video/*">

                            <input type="hidden" name="gallery_items[${id}][uploaded_file]" id="uploaded-file-${id}" value="">
                        </div>

                        <button type="button"
                            class="remove-gallery text-red-600 hover:text-red-800 font-semibold text-xl flex items-center"
                            data-gallery-id="${id}">×</button>
                    </div>

                    <div class="hidden mt-1 h-2 bg-gray-200 rounded overflow-hidden" id="progress-wrapper-${id}">
                        <div class="bg-blue-600 h-2 progress-bar" id="progress-bar-${id}" style="width: 0%"></div>
                    </div>
                </div>
            `;
            $('#project-gallery-wrapper').append(field);
            galleryIndex++;
        });

        // Silme işlemi
        $(document).on('click', '.remove-gallery', function() {
            const galleryId = $(this).data('gallery-id');
            $(`.project-gallery-item[data-gallery-id="${galleryId}"]`).remove();
            $(`#gallery-preview-section [data-gallery-id="${galleryId}"]`).remove();
            if ($(`#project-gallery-wrapper .project-gallery-item`).length === 0) {
                $('#add-gallery').click();
            }
        });

        // Dosya seçildiğinde preview + ajax upload başlat
        $(document).on('change', '.gallery-file-input', function() {
            const file = this.files[0];
            const galleryId = $(this).data('gallery-id');

            if (!file) return;

            // Preview alanını temizle
            $(`#gallery-preview-section [data-gallery-id="${galleryId}"]`).remove();

            let previewElement;
            const reader = new FileReader();

            reader.onload = function(e) {
                if (file.type.startsWith('image/')) {
                    previewElement = $('<img>')
                        .attr('src', e.target.result)
                        .attr('data-gallery-id', galleryId)
                        .addClass('w-full max-w-xs max-h-[200px] object-contain rounded shadow');
                } else if (file.type.startsWith('video/')) {
                    previewElement = $('<video controls>')
                        .attr('src', e.target.result)
                        .attr('data-gallery-id', galleryId)
                        .addClass('w-full max-w-xs max-h-[200px] object-contain rounded shadow');
                } else {
                    alert('Bu dosya tipi desteklenmiyor.');
                    return;
                }
                $('#gallery-preview-section').append(previewElement);
            };

            reader.readAsDataURL(file);

            // Ajax ile upload başlat
            const progressWrapper = $(`#progress-wrapper-${galleryId}`);
            const progressBar = $(`#progress-bar-${galleryId}`);
            const hiddenInput = $(`#uploaded-file-${galleryId}`);

            progressWrapper.removeClass('hidden');
            progressBar.css('width', '0%');
            progressBar.removeClass('upload-complete');

            const formData = new FormData();
            formData.append('file', file);

            $.ajax({
                url: '{{ route('projects.gallery.upload') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                xhr: function() {
                    const xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            const percent = Math.round((e.loaded / e.total) * 100);
                            progressBar.css('width', percent + '%');
                        }
                    });
                    return xhr;
                },
                success: function(res) {
                    progressWrapper.addClass('hidden');
                    progressBar.addClass('upload-complete');
                    if (res.file_name) {
                        hiddenInput.val(res.file_name);
                    }
                },
                error: function(res) {
                    response = res;
                    if (response && response.responseJSON && response.responseJSON.errors) {
                        const errors = response.responseJSON.errors;
                        Object.values(errors).forEach(errorArray => {
                            errorArray.forEach(error => {
                                showToast('error', error);
                            });
                        });
                    } else {
                        showToast('error', 'Dosya yüklenirken hata oluştu!');
                    }
                    progressWrapper.addClass('hidden');
                    progressBar.removeClass('upload-complete');
                    hiddenInput.val('');
                }
            });

        });

        // Form gönderme butonu
    </script>
@endsection
