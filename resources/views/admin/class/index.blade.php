@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800">
        @yield('page-title', 'Sınıflar' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <div class="flex items-center gap-2">
        <a href="{{ route('class.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Yeni Ekle</a>
    </div>
@endsection
@section('content')
    <div class="rounded-lg mb-4 h-[85%] border border-gray-200">
        <div class="w-full bg-white py-10 px-8 rounded-lg h-full">
            <div class="relative overflow-x-auto h-full">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>

                            <th scope="col" class="px-6 py-3">
                                Sınıf Adı
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Günü
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Saat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Öğretmen
                            </th>

                            <th scope="col" class="px-6 py-3">
                                <span>İşlem</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $item)
                            <tr
                                class="bg-white border-b border-gray-200 hover:bg-gray-50">

                                <th scope="row"
                                    class="px-6 py-4 font-medium text-blue-600 whitespace-nowrap">
                                    <a href="{{ route('class.edit', $item->id) }}">{{ $item->name }}</a>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $dayNames[$item->day] ?? $item->day }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->time)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->teacher_name }}
                                </td>

                                <td class="px-6 py-4 gap-2 ">
                                    <div class="flex items-center gap-2">

                                        <form action="{{ route('class.delete', $item->id) }}" method="POST">
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
        </div>
    </div>
@endsection
