@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', 'Sayfa Listesi' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
@endsection

@section('content')
    @php
        $pages = collect([
            [
                'id' => 1,
                'title' => 'Ekip',
                'type' => 'teams',
            ],
            [
                'id' => 2,
                'title' => 'Projelerimiz',
                'type' => 'projects',
            ],
            [
                'id' => 3,
                'title' => 'İletişim',
                'type' => 'contact',
            ],
            [
                'id' => 4,
                'title' => 'Referanslarımız',
                'type' => 'references',
            ],
            [
                'id' => 5,
                'title' => 'Hakkımızda',
                'type' => 'about-us',
            ],
            [
                'id' => 5,
                'title' => 'Hizmetlerimiz',
                'type' => 'services',
            ],
        ]);
    @endphp
    <div class="rounded-lg mb-4">

        <div class="w-full bg-white py-10 px-8 rounded-lg">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Başlık
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span>İşlem</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $item)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    <a href="{{ route('pages.edit', $item['type']) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        {{ $item['title'] }}
                                    </a>

                                </th>
                                <td class="px-6 py-4 gap-2 ">
                                    <div class="flex items-center gap-2">

                                        <div>
                                            <button id="languageDropdownButton{{ $item['type'] }}"
                                                data-dropdown-toggle="languageDropdown{{ $item['type'] }}"
                                                data-dropdown-offset-skidding="60" data-dropdown-placement="bottom"
                                                class="me-3 mb-3 md:mb-0 text-black border-gray-200 border bg-none focus:outline-none rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center cursor-pointer "
                                                type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
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
                                            <div id="languageDropdown{{ $item['type'] }}"
                                                class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 ">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-start"
                                                    aria-labelledby="languageDropdownButton{{ $item['type'] }}">
                                                    @foreach ($activeLanguages as $activeLanguageItem)
                                                        <li>
                                                            <a href="{{ route('pages.editTranslate', ['lang' => $activeLanguageItem->locale, 'id' => $item['type']]) }}"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $activeLanguageItem->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
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
@endsection
