@extends('admin.layouts.app')
@section('page-banner')
    <div>
        <h1 class="text-xl font-semibold text-gray-800 ">
            @yield('page-title', $student->full_name . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
        </h1>
        <div class="grid grid-cols-2 gap-4">
            <p>İlk kayıt tarihi: {{ \Carbon\Carbon::parse($student->created_at)->format('d.m.Y') }}</p>
            <p>Durum: {{ $student->is_active == '1' ? 'Aktif' : 'Pasif' }}</p>
        </div>
    </div>
    <div class="flex gap-4">
        <button form="changeActivityForm"
            class="block cursor-pointer {{ $student->is_active == '1' ? 'bg-green-700' : 'bg-red-500' }} text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            type="submit">
            {{ $student->is_active == '1' ? 'Dondur' : 'Aktif et' }}
        </button>
        <!-- Modal toggle -->
        <button data-modal-target="select-modal" data-modal-toggle="select-modal"
            class="block cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            type="button">Yeni Ekle</button>
        @include('admin.components.StudentNewAddModal', [
            'normalCount' => $normalCount,
            'preCount' => $preCount,
        ])
    </div>
@endsection
@section('content')
    <div class="flex justify-between items-center">
        @include('admin.components.tabmenustudent')
        @include('admin.components.actionbuttonstudent', ['student' => $student])
        <!-- Action button -->
        <div class="">
            <button data-modal-target="actionbutton-modal-{{ $student->id }}"
                data-modal-toggle="actionbutton-modal-{{ $student->id }}" type="button"
                class="cursor-pointer text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center me-2 ">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="4" d="M12 6h.01M12 12h.01M12 18h.01" />
                </svg>
            </button>
        </div>
        <!-- Action button -->
    </div>

    <form action="{{ route('students.changeActivity', ['id' => $student->id]) }}" method="post" id="changeActivityForm">
        @csrf
    </form>
    <div class="rounded-lg mb-4 h-[85%]">
        <div class="w-full bg-white border border-gray-300 py-10 px-8 rounded-lg h-full">
            <div class="relative overflow-x-auto h-full">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Kayıt
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sınıf
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
                                    <a href="{{ route('students.payment', $item->id) }}">{{ $loop->iteration }}. Kayıt</a>
                                </th>
                                <td class="px-6 py-4">

                                    {{ $item->class->name }}
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
                                        <!-- ödeme planı indir -->
                                        <form id="downloadPayment{{ $item->id }}"
                                            action="{{ route('students.downloadPayment') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $item->student_id }}">
                                            <input type="hidden" name="payment_id" value="{{ $item->id }}">
                                        </form>
                                        <button form="downloadPayment{{ $item->id }}" type="submit"
                                            class=" cursor-pointer py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">
                                            <svg class="w-3 h-3 me-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                                <path
                                                    d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                            </svg>
                                            indir
                                        </button>
                                        <!-- ödeme planı indir -->
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
