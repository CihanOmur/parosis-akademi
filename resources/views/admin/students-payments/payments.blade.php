@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('students.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $student->full_name }}</h1>
            <div class="flex items-center gap-3 mt-1">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    İlk kayıt: <span class="font-medium">{{ \Carbon\Carbon::parse($student->created_at)->format('d.m.Y') }}</span>
                </p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                    {{ $student->is_active == '1' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $student->is_active == '1' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                    {{ $student->is_active == '1' ? 'Aktif' : 'Pasif' }}
                </span>
            </div>
        </div>
    </div>

    @can('student')
        <div class="flex gap-3">
            <button form="changeActivityForm"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 cursor-pointer
                    {{ $student->is_active == '1'
                        ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 border border-emerald-200/60 dark:border-emerald-800/30 hover:bg-emerald-100'
                        : 'bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 border border-red-200/60 dark:border-red-800/30 hover:bg-red-100' }}"
                type="submit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9"/>
                </svg>
                {{ $student->is_active == '1' ? 'Dondur' : 'Aktif et' }}
            </button>
            <button data-modal-target="select-modal" data-modal-toggle="select-modal"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium
                       bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700
                       text-white shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer"
                type="button">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Yeni Ekle
            </button>
            @include('admin.components.student-new-add-modal', [
                'normalCount' => $normalCount,
                'preCount' => $preCount,
            ])
        </div>
    @endcan
@endsection

@section('content')
    <div class="flex justify-between items-center mb-5">
        @include('admin.components.tab-menu-student')
        @include('admin.components.action-button-student', ['student' => $student])
        <div>
            <button data-modal-target="actionbutton-modal-{{ $student->id }}"
                data-modal-toggle="actionbutton-modal-{{ $student->id }}" type="button"
                class="cursor-pointer p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                       rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z"/>
                </svg>
            </button>
        </div>
    </div>

    @can('student')
        <form action="{{ route('students.changeActivity', ['id' => $student->id]) }}" method="post" id="changeActivityForm">
            @csrf
        </form>
    @endcan

    {{-- Özet Kartları --}}
    @php
        $totalPrice = $payments->sum('total_price');
        $totalPayed = $payments->sum('total_payed_price');
        $totalRemaining = $totalPrice - $totalPayed;
        $totalInstallments = $payments->sum('installment_count');
    @endphp
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Toplam Tutar --}}
        <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($totalPrice, 2, ',', '.') }} ₺</p>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Toplam Tutar</p>
                </div>
            </div>
            <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-blue-500/5 dark:bg-blue-500/10"></div>
        </div>

        {{-- Ödenen --}}
        <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($totalPayed, 2, ',', '.') }} ₺</p>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Ödenen</p>
                </div>
            </div>
            <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-emerald-500/5 dark:bg-emerald-500/10"></div>
        </div>

        {{-- Kalan --}}
        <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center shadow-lg shadow-red-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($totalRemaining, 2, ',', '.') }} ₺</p>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Kalan</p>
                </div>
            </div>
            <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-red-500/5 dark:bg-red-500/10"></div>
        </div>

        {{-- Kayıt Sayısı --}}
        <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $payments->count() }}</p>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Kayıt Sayısı</p>
                </div>
            </div>
            <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-amber-500/5 dark:bg-amber-500/10"></div>
        </div>
    </div>

    {{-- Tablo --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-gradient-to-r from-slate-50 to-slate-100/50 dark:from-slate-700/60 dark:to-slate-700/40
                               [&>th:first-child]:rounded-tl-2xl [&>th:last-child]:rounded-tr-2xl">
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kayıt</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sınıf</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider hidden md:table-cell">Başlangıç</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ödenen</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kalan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider hidden sm:table-cell">Taksit</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($payments->reverse() as $item)
                        @php
                            $remaining = $item->total_price - $item->total_payed_price;
                            $paidPercent = $item->total_price > 0 ? round(($item->total_payed_price / $item->total_price) * 100) : 0;
                        @endphp
                        <tr class="group hover:bg-fuchsia-50/30 dark:hover:bg-fuchsia-900/5 transition-colors duration-150">
                            {{-- Kayıt --}}
                            <td class="px-6 py-4">
                                <a href="{{ route('students.payment', $item->id) }}"
                                   class="inline-flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600
                                                flex items-center justify-center flex-shrink-0 shadow-sm
                                                group-hover:shadow-md group-hover:scale-105 transition-all duration-200">
                                        <span class="text-xs font-bold text-white">{{ $loop->iteration }}</span>
                                    </div>
                                    <span class="font-semibold text-slate-900 dark:text-white
                                                 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                        {{ $loop->iteration }}. Kayıt
                                    </span>
                                </a>
                            </td>

                            {{-- Sınıf --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium
                                             bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300
                                             border border-blue-200/60 dark:border-blue-700/40">
                                    <svg class="w-3 h-3 opacity-60" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>
                                    </svg>
                                    {{ $item->class->name }}
                                </span>
                            </td>

                            {{-- Başlangıç Tarihi --}}
                            <td class="px-6 py-4 hidden md:table-cell">
                                @if($item->start_date)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                                        </svg>
                                        <span class="text-slate-500 dark:text-slate-400 text-xs">
                                            {{ \Carbon\Carbon::parse($item->start_date)->format('d.m.Y') }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 italic">—</span>
                                @endif
                            </td>

                            {{-- Ödenen --}}
                            <td class="px-6 py-4">
                                <div class="space-y-1.5">
                                    <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                                        {{ number_format($item->total_payed_price ?? 0, 2, ',', '.') }} ₺
                                    </span>
                                    <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5 max-w-20">
                                        <div class="h-1.5 rounded-full transition-all duration-500
                                                    {{ $paidPercent >= 100 ? 'bg-emerald-500' : ($paidPercent >= 50 ? 'bg-amber-500' : 'bg-red-400') }}"
                                             style="width: {{ min($paidPercent, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>

                            {{-- Kalan --}}
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium {{ $remaining > 0 ? 'text-red-500 dark:text-red-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                                    {{ number_format($remaining, 2, ',', '.') }} ₺
                                </span>
                            </td>

                            {{-- Taksit Sayısı --}}
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="inline-flex items-center justify-center min-w-[28px] h-7 px-2 rounded-lg text-xs font-bold
                                             bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                    {{ $item->installment_count ?? 0 }}
                                </span>
                            </td>

                            {{-- İşlem --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-1">
                                    {{-- Detay --}}
                                    <a href="{{ route('students.payment', $item->id) }}"
                                       class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                              hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all
                                              opacity-0 group-hover:opacity-100"
                                       title="Detay">
                                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                        </svg>
                                    </a>

                                    {{-- PDF İndir --}}
                                    <form id="downloadPayment{{ $item->id }}"
                                          action="{{ route('students.downloadPayment') }}" method="POST" class="hidden">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $item->student_id }}">
                                        <input type="hidden" name="payment_id" value="{{ $item->id }}">
                                    </form>
                                    <button form="downloadPayment{{ $item->id }}" type="submit"
                                            class="p-2 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400
                                                   hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all cursor-pointer"
                                            title="PDF İndir">
                                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200
                                                dark:from-slate-700 dark:to-slate-600
                                                flex items-center justify-center shadow-inner">
                                        <svg class="w-8 h-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-slate-700 dark:text-slate-300 font-medium">Ödeme kaydı bulunamadı</p>
                                        <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Henüz ödeme kaydı eklenmemiş.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
