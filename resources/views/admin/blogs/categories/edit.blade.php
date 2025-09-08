@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
        @yield('page-title', 'Blog Kategori ' . ($selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>

    <div class="flex items-center gap-2">
        <a href="{{ route('blogs.categories.index') }}"
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Yeni
            Kategori Ekle</a>
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
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <div class="rounded-lg mb-4">

            <div class="w-full bg-white py-10 px-8 rounded-lg">
                <form class="w-1/2 lg:w-full" action="{{ route('blogs.categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
                    <div class="mb-6">
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Başlık</label>
                        <input type="text" name="title" id="title" aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Başlık girin" value="{{ translateAttribute($category, 'name', request()->lang) }}">

                    </div>
                    <div class="mb-6">
                        <label for="parent_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Üst
                            Departman</label>
                        <select name="parent_id" id="parent_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Seçiniz</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('parent_id', $category->parent_id) == $item->id ? 'selected' : '' }}>
                                    {{ translateAttribute($category, 'name', request()->lang) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Açıklama</label>
                        <textarea name="description" id="editor" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Açıklama girin">{{ translateAttribute($category, 'description', request()->lang) }}</textarea>

                    </div>


                    <div class="">
                        <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="rounded-lg mb-4">

            <div class="w-full bg-white py-10 px-8 rounded-lg h-full">
                <div class="relative overflow-x-auto h-full">
                    <div class="pb-4 bg-white dark:bg-gray-900">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative m-1">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search" name="search"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search for items">
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#table-search').on('change', function() {
                                    const searchValue = $(this).val().toLowerCase();
                                    var url = new URL(window.location.href);
                                    url.searchParams.set('search', searchValue);
                                    window.location.href = url.toString();
                                });
                            });
                        </script>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 h-fit">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Başlık
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Açıklama
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Sayı
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span>İşlem</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ route('blogs.categories.edit', $item->id) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            {{ $item->name }}
                                        </a>

                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->blogs_count }}
                                    </td>
                                    <td class="px-6 py-4 text-right flex gap-2 items-center">

                                        <form action="{{ route('blogs.categories.delete', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="cursor-pointer font-medium text-red-600 items-center hover:underline mb-3 md:mb-0 border-gray-200 border bg-none focus:outline-none rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex ">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                        <div>
                                            <button id="languageDropdownButton{{ $item->id }}"
                                                data-dropdown-toggle="languageDropdown{{ $item->id }}"
                                                data-dropdown-offset-skidding="60" data-dropdown-placement="bottom"
                                                class="me-3 mb-3 md:mb-0 text-black border-gray-200 border bg-none focus:outline-none rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center cursor-pointer "
                                                type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
                                                </svg>
                                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div id="languageDropdown{{ $item->id }}"
                                                class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-start"
                                                    aria-labelledby="languageDropdownButton{{ $item->id }}">
                                                    @foreach ($activeLanguages as $activeLanguageItem)
                                                        <li>
                                                            <a href="{{ route('blogs.categories.categoryEditTranslate', ['lang' => $activeLanguageItem->locale, 'id' => $item->id]) }}"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $activeLanguageItem->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
