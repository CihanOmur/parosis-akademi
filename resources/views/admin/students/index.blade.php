@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', 'Kesin Kayıtlar ' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    @can('student')
        <a href="{{ route('students.create') }}"
            class="block cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            type="button">
            Yeni Ekle
        </a>
    @endcan
@endsection
@section('content')
    <form class="grid grid-cols-1 md:grid-cols-12 gap-3" method="GET" action="{{ route('students.index') }}" id="filterForm">
        <div class="mb-0 w-full pb-2 lg:col-span-5 md:col-span-6">
            <div class="relative w-full flex items-center">
                <!-- Arama ikonu -->
                <span class="absolute left-3 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"></path>
                    </svg>
                </span>

                <input type="text" name="name" id="name" value="{{ request()->input('name') }}"
                    class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10 py-2.5"
                    placeholder="Ara...">
            </div>
        </div>


        <div class="mb-0 w-full pb-2 lg:col-span-3 md:col-span-6">
            <select id="class_id" name="class"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled selected>Sınıf seçin</option>
                <option value="all" {{ request()->input('class') == 'all' ? 'selected' : '' }}>Tüm Sınıflar</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" {{ request()->input('class') == $class->id ? 'selected' : '' }}>
                        {{ $class?->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @php
            $startYear = 2020;
            $endYear = \Carbon\Carbon::now()->year + 1;
            $years = range($startYear, $endYear);
            rsort($years);
            $requestValue = request()->input('period');
        @endphp
        <div class="mb-0 w-full pb-2 lg:col-span-3 md:col-span-6">
            <select id="period" name="period"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" disabled selected>Dönem seçin</option>
                <option value="all" {{ request()->input('period') == 'all' ? 'selected' : '' }}>Tüm Dönemler</option>
                @foreach ($years as $year)
                    <option value="{{ $year }} Güz"
                        {{ request()->input('period') == $year . ' Güz' ? 'selected' : '' }}>
                        {{ $year }} Güz
                    </option>
                    <option value="{{ $year }} Yaz"
                        {{ request()->input('period') == $year . ' Yaz' ? 'selected' : '' }}>
                        {{ $year }} Yaz
                    </option>
                    <option value="{{ $year }} Bahar"
                        {{ request()->input('period') == $year . ' Bahar' ? 'selected' : '' }}>
                        {{ $year }} Bahar
                    </option>
                @endforeach
            </select>

        </div>
        <div class="mb-0 w-full pb-2 lg:col-span-1 md:col-span-6 flex items-center text-center">
            <button type="submit" form="filterForm"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 text-center lg:w-max w-full cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="mx-auto">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5" d="M4.5 7.25h15M7.385 12h9.23m-6.345 4.75h3.46" />
                </svg>
            </button>
        </div>
    </form>
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
                                Yaş
                            </th>
                            <th scope="col" class="px-6 py-3">
                                T.C. Kimlik No
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Sınıf
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Durum
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kayıt Tarihi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span>İşlem</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                            @include('admin.components.actionbuttonstudent', ['student' => $item])

                            <tr class="bg-white border-b   border-gray-200 hover:bg-gray-50 ">

                                <th scope="row" class="px-6 py-4 font-medium text-blue-600 whitespace-nowrap ">
                                    <a
                                        href="{{ $item->registration_type == '1' ? route('students.pre.editPreRegistiration', $item->id) : route('students.edit', $item->id) }}">{{ $item->full_name }}</a>
                                </th>
                                <td class="px-6 py-4">
                                    {{ Carbon\Carbon::parse($item->birth_date)->age }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->national_id ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item->lessonClass->name ?? 'Belirtilmemiş' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($item->is_active == 1)
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Aktif</span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Pasif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}
                                </td>
                                <td class="px-6 py-4 gap-2 ">
                                    <div class="flex items-center gap-2">
                                        <!-- Action button -->
                                        <div class="">
                                            <button data-modal-target="actionbutton-modal-{{ $item->id }}"
                                                data-modal-toggle="actionbutton-modal-{{ $item->id }}" type="button"
                                                class="cursor-pointer text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center me-2 ">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="4"
                                                        d="M12 6h.01M12 12h.01M12 18h.01" />
                                                </svg>
                                            </button>
                                        </div>

                                        @can('student_delete')
                                            <button type="button" data-modal-target="are-you-sure-modal-{{ $item->id }}"
                                                data-modal-toggle="are-you-sure-modal-{{ $item->id }}"
                                                class="cursor-pointer font-medium text-red-600 items-center hover:underline mb-3 md:mb-0 border-gray-200 border bg-none focus:outline-none rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex ">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        @endcan

                                    </div>
                                </td>
                                @can('student_delete')
                                    @include('admin.components.are-you-sure-modal', [
                                        'id' => $item->id,
                                        'route' => route('students.delete', $item->id),
                                    ])
                                @endcan
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endsection
