@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', $student->full_name . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
@endsection
@section('content')
    <div class="rounded-lg mb-4 h-[85%]">

        <div class="w-full bg-white border border-gray-300 py-10 px-8 rounded-lg h-full">
            <div class="relative overflow-x-auto h-full">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>

                            <th scope="col" class="px-6 py-3">
                                Kur
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sınıf
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Gün
                            </th>
                            <th scope="col" class="px-6 py-3">
                                BT
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ödenen
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kalan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                TS
                            </th>
                            <th scope="col" class="px-6 py-3">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments->reverse() as $item)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">

                                <th scope="row" class="px-6 py-4 font-medium text-blue-600 whitespace-nowrap ">
                                    <a href="{{ route('students.payment', $item->id) }}">{{ $loop->iteration }}. Kur</a>
                                </th>
                                <td class="px-6 py-4">

                                    {{ $item->class->name }}
                                </td>
                                <td class="px-6 py-4">

                                    ({{ $item->class->day }}
                                    {{ $item->class->time ? \Carbon\Carbon::parse($item->class->time)->format('H:i') : '' }})
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item->start_date ? \Carbon\Carbon::parse($item->start_date)->format('d.m.Y') : '' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($item->total_payed_price ?? '0.00', 2, ',', '') }}
                                    ₺
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($item->total_price - $item->total_payed_price, 2, ',', '') }}
                                    ₺
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->installment_count ?? '0' }}
                                </td>
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
                                                class="z-20 hidden bg-white border border-gray-300 divide-y divide-gray-100 rounded-lg shadow-sm w-44 ">
                                                <ul class="py-2 text-sm text-gray-700  text-start"
                                                    aria-labelledby="languageDropdownButton{{ $item->id }}">

                                                    <li>
                                                        <form id="downloadContract{{ $item->id }}"
                                                            action="{{ route('students.downloadPayment') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="student_id"
                                                                value="{{ $item->student_id }}">
                                                            <input type="hidden" name="payment_id"
                                                                value="{{ $item->id }}">
                                                        </form>
                                                        <button form="downloadContract{{ $item->id }}"
                                                            class="block px-4 py-2 hover:bg-gray-100  w-full text-start cursor-pointer">
                                                            Pdf indir</button>
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
    </div>
@endsection
