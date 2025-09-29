@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', 'Kesin Kayıtlar ' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <a href="{{ route('students.create') }}"
        class="block cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
        type="button">
        Yeni Ekle
    </a>
@endsection
@section('content')
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



                                        <button type="button" data-modal-target="are-you-sure-modal-{{ $item->id }}"
                                            data-modal-toggle="are-you-sure-modal-{{ $item->id }}"
                                            class="cursor-pointer font-medium text-red-600 items-center hover:underline mb-3 md:mb-0 border-gray-200 border bg-none focus:outline-none rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>

                                    </div>
                                </td>
                                @include('admin.components.are-you-sure-modal', [
                                    'id' => $item->id,
                                    'route' => route('students.delete', $item->id),
                                ])
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endsection
