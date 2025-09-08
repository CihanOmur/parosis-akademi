@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
        @yield('page-title', 'Referans Düzenle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <div class="flex items-center gap-2">
        <a href="{{ route('references.create') }}"
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Yeni Referans
            Ekle</a>
    </div>
@endsection

@section('content')
    <div class="rounded-lg mb-4">

        <div class="w-full bg-white py-10 px-8 rounded-lg">
            <form class="lg:w-1/2 w-full" action="{{ route('references.update', $reference->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
                <div class="mb-6">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Başlık</label>
                    <input type="text" name="title" id="title" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Başlık girin" value="{{ translateAttribute($reference, 'name', request()->lang) }}">

                </div>

                <div class="mb-6">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sektör
                        Seçiniz</label>
                    <select id="category" name="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $reference->category_id ? 'selected' : '' }}>
                                {{ translateAttribute($category, 'name', request()->lang) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="reference_type"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Referans Türü
                        Seçiniz</label>
                    <select id="reference_type" name="reference_type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="customer" {{ $reference->reference_type == 'customer' ? 'selected' : '' }}>Müşteri
                        </option>
                        <option value="partner" {{ $reference->reference_type == 'partner' ? 'selected' : '' }}>Ortak
                        </option>
                    </select>
                </div>


                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file">Upload
                        file</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_help" name="file" id="file" type="file">
                </div>
                <div id="preview_file" class="mb-6 ">
                    <img id="preview_image" src="{{ asset('storage/references/' . $reference->image_url) }}" alt="Preview"
                        class="rounded-lg w-60 h-auto">
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


                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection
