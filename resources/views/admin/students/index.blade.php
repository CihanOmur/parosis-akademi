@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', 'Öğrenciler' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <!-- Modal toggle -->
    <button data-modal-target="select-modal" data-modal-toggle="select-modal" class="block cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
    Yeni Ekle
    </button>
@endsection
@section('content')
<!-- Main modal -->
<div id="select-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    Kurs Kayıt
                </h3>
                <button type="button" class="text-gray-400 bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="select-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Kapat</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <p class="text-gray-500 dark:text-gray-400 mb-4">Kayıt türü seçin</p>
                <ul class="space-y-4 mb-4">
                    
                    <li>
                        <a href="{{ route('students.create') }}">
                        <label for="job-1" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100">                           
                        <div class="block">
                                <div class="w-full text-lg font-semibold">Ön Kayıt</div>
                                <div class="w-full text-gray-500 dark:text-gray-400">ön kayıt toplam sayısı</div>
                            </div>
                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
                        </label>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('students.create') }}">
                        <label for="job-2" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Kesin Kayıt</div>
                                <div class="w-full text-gray-500 dark:text-gray-400">Kesin kayıt sayısı</div>
                            </div>
                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
                        </label>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> 
    <div class="rounded-lg mb-4 h-[85%]">

        <div class="w-full bg-white py-10 px-8 rounded-lg h-full border border-gray-200">
            <div class="relative overflow-x-auto h-full">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>

                            <th scope="col" class="px-6 py-3">
                                Ad/Soyad
                            </th>
                            <th scope="col" class="px-6 py-3">
                                T.C. Kimlik No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kayıt Türü
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span>İşlem</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                            <tr class="bg-white border-b   border-gray-200 hover:bg-gray-50 ">

                                <th scope="row" class="px-6 py-4 font-medium text-blue-600 whitespace-nowrap ">
                                    <a href="{{ route('students.edit', $item->id) }}">{{ $item->full_name }}</a>
                                </th>

                                <td class="px-6 py-4">
                                    {{ $item->national_id ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->registration_type == '1' ? 'Ön Kayıt' : 'Kesin Kayıt' }}
                                </td>

                                {{-- <td class="px-6 py-4 gap-2 ">
                                    <div class="flex items-center gap-2">

                                        <!-- <form action="{{ route('class.delete', $item->id) }}" method="POST">
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
                                        </form> -->
                                    </div>
                                </td> --}}
                                <td class="px-6 py-4 gap-2 ">
                                    <div class="flex items-center gap-2">

                                        <div>
                                            <button id="languageDropdownButton{{ $item->id }}"
                                                data-dropdown-toggle="languageDropdown{{ $item->id }}"
                                                data-dropdown-offset-skidding="45" data-dropdown-placement="bottom"
                                                class="me-3 mb-3 md:mb-0 text-black border-gray-200 border bg-none focus:outline-none rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center cursor-pointer "
                                                type="button">
                                                İşlemler
                                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div id="languageDropdown{{ $item->id }}"
                                                class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 ">
                                                <ul class="py-2 text-sm text-gray-70"
                                                    aria-labelledby="languageDropdownButton{{ $item->id }}">
                                                    <li>
                                                        <form id="downloadRegistrationForm{{ $item->id }}"
                                                            action="{{ route('students.downloadRegistrationForm') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="student_id"
                                                                value="{{ $item->id }}">
                                                        </form>
                                                        <button form="downloadRegistrationForm{{ $item->id }}"
                                                            class="block px-4 py-2 hover:bg-gray-100  w-full text-start cursor-pointer">Kayıt
                                                            Formu İndir</button>
                                                    </li>
                                                    <li>
                                                        <form id="downloadContract{{ $item->id }}"
                                                            action="{{ route('students.downloadContract') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="student_id"
                                                                value="{{ $item->id }}">
                                                        </form>
                                                        <button form="downloadContract{{ $item->id }}"
                                                            class="block px-4 py-2 hover:bg-gray-100 w-full text-start cursor-pointer">Sözleşme
                                                            İndir</button>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('students.allPayments', $item->id) }}"
                                                            class="block px-4 py-2 hover:bg-gray-100">Ödemeler</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('students.reCreate', $item->id) }}"
                                                            class="block px-4 py-2 hover:bg-gray-100 ">Kayıt
                                                            Yenile</a>
                                                    </li>
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
    @endsection
