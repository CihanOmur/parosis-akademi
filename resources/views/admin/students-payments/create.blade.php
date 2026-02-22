@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('students.allPayments', ['id' => $payment->student_id]) }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $payment->student->full_name }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Ödeme planı ve taksit detayları</p>
        </div>
    </div>
@endsection

@section('content')
    {{-- Özet Kartları --}}
    @if ($payment)
        @php
            $totalPrice = $payment->total_price ?? 0;
            $totalPayed = $payment->total_payed_price ?? 0;
            $remaining  = max($totalPrice - $totalPayed, 0);
            $paidPercent = $totalPrice > 0 ? round(($totalPayed / $totalPrice) * 100) : 0;
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
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($remaining, 2, ',', '.') }} ₺</p>
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Kalan</p>
                    </div>
                </div>
                <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-amber-500/5 dark:bg-amber-500/10"></div>
            </div>

            {{-- Tablo Toplam --}}
            <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center shadow-lg shadow-red-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white" id="table_total_price">0.00 ₺</p>
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Tablo Toplam</p>
                    </div>
                </div>
                <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-red-500/5 dark:bg-red-500/10"></div>
            </div>
        </div>
    @endif

    {{-- Ödeme Formu --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden mb-6">
        {{-- Payment alert modal --}}
        @include('admin.components.payment-alert')
        <button type="button" id="payment-alert-button" data-modal-target="payment-alert-modal"
            data-modal-toggle="payment-alert-modal" class="hidden"></button>

        <form class="w-full" action="{{ route('students.paymentUpdate', ['id' => $payment->id]) }}" method="POST" id="paymentForm">
            @csrf

            {{-- Header --}}
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Ödeme Ayarları</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Ödeme tutarı, taksit sayısı ve başlangıç tarihi</p>
                </div>
            </div>

            {{-- Giriş Alanları --}}
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Ödeme Tutarı</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                                </svg>
                            </span>
                            <input type="number" id="total_payment" name="total_payment" step="0.01"
                                @cannot('accounting') {{ isset($first_create) && $first_create ? '' : 'disabled' }} @endcannot
                                value="{{ old('total_payment', $payment->total_price ?? '') }}"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                       text-slate-900 dark:text-white placeholder-slate-400
                                       ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all
                                       @cannot('accounting') {{ isset($first_create) && $first_create ? '' : '!cursor-not-allowed opacity-60' }} @endcannot"
                                placeholder="0.00">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Taksit Sayısı</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5"/>
                                </svg>
                            </span>
                            <input type="number" id="installments_count"
                                @cannot('accounting') {{ isset($first_create) && $first_create ? '' : 'disabled' }} @endcannot
                                value="{{ old('installments_count', $payment->installments->count() ?? '') }}"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                       text-slate-900 dark:text-white placeholder-slate-400
                                       ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all
                                       @cannot('accounting') {{ isset($first_create) && $first_create ? '' : '!cursor-not-allowed opacity-60' }} @endcannot"
                                placeholder="0">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Başlangıç Tarihi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                                </svg>
                            </span>
                            <input type="date" id="start_date" name="start_date"
                                @cannot('accounting') {{ isset($first_create) && $first_create ? '' : 'disabled' }} @endcannot
                                value="{{ old('start_date', optional($payment->installments->first())->payment_date ? \Carbon\Carbon::parse($payment->installments->first()->payment_date)->format('Y-m-d') : '') }}"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                       text-slate-900 dark:text-white placeholder-slate-400
                                       ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all
                                       @cannot('accounting') {{ isset($first_create) && $first_create ? '' : '!cursor-not-allowed opacity-60' }} @endcannot">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Taksit Tablosu --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        {{-- Header --}}
        <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-md shadow-blue-500/20 flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Taksit Planı</h3>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $payment->installments->count() }} taksit</p>
                </div>
            </div>

            @can('accounting')
                <button type="button" id="sendButton"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl
                               bg-gradient-to-r from-fuchsia-500 to-purple-500
                               hover:from-fuchsia-600 hover:to-purple-600
                               shadow-lg shadow-fuchsia-500/20 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5"/>
                    </svg>
                    Kaydet
                </button>
            @else
                @if (isset($first_create) && $first_create)
                    <button type="button" id="sendButton"
                            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl
                                   bg-gradient-to-r from-fuchsia-500 to-purple-500
                                   hover:from-fuchsia-600 hover:to-purple-600
                                   shadow-lg shadow-fuchsia-500/20 transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5"/>
                        </svg>
                        Kaydet
                    </button>
                @endif
            @endcan
        </div>

        {{-- Taksit Satırları --}}
        <div class="p-6" id="installments_container">
            @if ($payment->installments && $payment->installments->count())
                {{-- Desktop Header --}}
                <div class="xl:grid xl:grid-cols-7 gap-4 mb-3 hidden">
                    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">#</div>
                    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tarih</div>
                    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ödenecek</div>
                    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ödenen</div>
                    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ödenen Tarih</div>
                    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ödeme Türü</div>
                    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Not</div>
                </div>

                @foreach ($payment->installments as $i => $inst)
                    @php
                        $isPaid = $inst->payed_price >= $inst->installment_price && $inst->installment_price > 0;
                        $isPartial = $inst->payed_price > 0 && $inst->payed_price < $inst->installment_price;
                    @endphp
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-7 gap-3 mb-2.5 p-4 rounded-xl border transition-all
                                {{ $isPaid
                                    ? 'bg-emerald-50/50 dark:bg-emerald-900/10 border-emerald-200/60 dark:border-emerald-800/30'
                                    : ($isPartial
                                        ? 'bg-amber-50/50 dark:bg-amber-900/10 border-amber-200/60 dark:border-amber-800/30'
                                        : 'bg-slate-50/50 dark:bg-slate-700/20 border-slate-200/60 dark:border-slate-700/50') }}">

                        {{-- Numara --}}
                        <div class="md:col-span-2 lg:col-span-3 xl:col-span-1 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0
                                        {{ $isPaid
                                            ? 'bg-emerald-500 text-white'
                                            : ($isPartial
                                                ? 'bg-amber-500 text-white'
                                                : 'bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-300') }}">
                                {{ $i + 1 }}
                            </div>
                            @if($isPaid)
                                <svg class="w-4 h-4 text-emerald-500 xl:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            @endif
                        </div>

                        {{-- Tarih --}}
                        <div>
                            <label class="text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 block xl:hidden">Tarih</label>
                            <input type="date" name="installments[{{ $i }}][payment_date]"
                                form="paymentForm"
                                @cannot('accounting') disabled @endcannot
                                class="w-full px-3 py-2 bg-white dark:bg-slate-700/50 rounded-lg text-sm
                                       text-slate-900 dark:text-white
                                       ring-1 ring-slate-200 dark:ring-slate-600 border-0
                                       focus:ring-2 focus:ring-fuchsia-500/60 transition-all
                                       @cannot('accounting') !cursor-not-allowed opacity-60 @endcannot"
                                value="{{ \Carbon\Carbon::parse($inst->payment_date)->format('Y-m-d') }}">
                        </div>

                        {{-- Ödenecek Tutar --}}
                        <div>
                            <label class="text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 block xl:hidden">Ödenecek</label>
                            <input type="number" step="0.01"
                                name="installments[{{ $i }}][installment_price]"
                                form="paymentForm"
                                @cannot('accounting') disabled @endcannot
                                value="{{ $inst->installment_price }}"
                                class="w-full px-3 py-2 bg-white dark:bg-slate-700/50 rounded-lg text-sm
                                       text-slate-900 dark:text-white
                                       ring-1 ring-slate-200 dark:ring-slate-600 border-0
                                       focus:ring-2 focus:ring-fuchsia-500/60 transition-all
                                       @cannot('accounting') !cursor-not-allowed opacity-60 @endcannot">
                        </div>

                        {{-- Ödenen Tutar --}}
                        <div>
                            <label class="text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 block xl:hidden">Ödenen</label>
                            <input type="number" step="0.01"
                                name="installments[{{ $i }}][payed_price]"
                                form="paymentForm"
                                @cannot('accounting') disabled @endcannot
                                class="w-full px-3 py-2 bg-white dark:bg-slate-700/50 rounded-lg text-sm
                                       text-slate-900 dark:text-white
                                       ring-1 ring-slate-200 dark:ring-slate-600 border-0
                                       focus:ring-2 focus:ring-fuchsia-500/60 transition-all
                                       @cannot('accounting') !cursor-not-allowed opacity-60 @endcannot"
                                value="{{ $inst->payed_price == 0 ? '0.00' : number_format($inst->payed_price, 2, '.', '') }}">
                        </div>

                        {{-- Ödenen Tarih --}}
                        <div>
                            <label class="text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 block xl:hidden">Ödenen Tarih</label>
                            <input type="date" name="installments[{{ $i }}][payyed_date]"
                                form="paymentForm"
                                @cannot('accounting') disabled @endcannot
                                class="w-full px-3 py-2 bg-white dark:bg-slate-700/50 rounded-lg text-sm
                                       text-slate-900 dark:text-white
                                       ring-1 ring-slate-200 dark:ring-slate-600 border-0
                                       focus:ring-2 focus:ring-fuchsia-500/60 transition-all
                                       @cannot('accounting') !cursor-not-allowed opacity-60 @endcannot"
                                value="{{ $inst->payyed_date ? \Carbon\Carbon::parse($inst->payyed_date)->format('Y-m-d') : '' }}">
                        </div>

                        {{-- Ödeme Türü --}}
                        <div>
                            <label class="text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 block xl:hidden">Ödeme Türü</label>
                            <select name="installments[{{ $i }}][payment_type]"
                                form="paymentForm"
                                @cannot('accounting') disabled @endcannot
                                class="w-full px-3 py-2 bg-white dark:bg-slate-700/50 rounded-lg text-sm
                                       text-slate-900 dark:text-white
                                       ring-1 ring-slate-200 dark:ring-slate-600 border-0
                                       focus:ring-2 focus:ring-fuchsia-500/60 transition-all
                                       @cannot('accounting') !cursor-not-allowed opacity-60 @endcannot">
                                <option value="Nakit" {{ $inst->payment_type == 'Nakit' ? 'selected' : '' }}>Nakit</option>
                                <option value="Havale" {{ $inst->payment_type == 'Havale' ? 'selected' : '' }}>Havale</option>
                                <option value="Kredi Kartı/Banka" {{ $inst->payment_type == 'Banka' ? 'selected' : '' }}>Kredi Kartı/Banka</option>
                            </select>
                        </div>

                        {{-- Not --}}
                        <div>
                            <label class="text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 block xl:hidden">Not</label>
                            <textarea name="installments[{{ $i }}][note]"
                                form="paymentForm"
                                class="w-full px-3 py-2 bg-white dark:bg-slate-700/50 rounded-lg text-sm
                                       text-slate-900 dark:text-white
                                       ring-1 ring-slate-200 dark:ring-slate-600 border-0
                                       focus:ring-2 focus:ring-fuchsia-500/60 transition-all resize-none"
                                rows="1">{{ $inst->note }}</textarea>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        $("#sendButton").on("click", function() {
            let totalPayment = parseFloat($("#total_payment").val()) || 0;
            let tableTotal = parseFloat($("#table_total_price").text().replace(/[^\d.,]/g, '').replace(',', '.')) || 0;
            if (totalPayment !== 0) {
                if (totalPayment !== tableTotal) {
                    $("#payment-alert-button").click();
                    return;
                }
            }
            $("#paymentForm").submit();
        });

        function generateInstallments(isInitial = false) {
            let totalPayment = parseFloat($("#total_payment").val()) || 0;
            let count = parseInt($("#installments_count").val()) || 0;
            let startDate = $("#start_date").val();
            let $container = $("#installments_container");
            if (!totalPayment || !count || !startDate) return;

            let installments = @json($payment->installments);
            let paidInstallments = installments.filter(inst => parseFloat(inst.payed_price) > 0);
            let unpaidInstallments = installments.filter(inst => parseFloat(inst.payed_price) === 0);

            if (isInitial) return;

            let remainingUnpaidCount = count - paidInstallments.length;
            if (remainingUnpaidCount < 0) remainingUnpaidCount = 0;

            if (unpaidInstallments.length > remainingUnpaidCount) {
                unpaidInstallments = unpaidInstallments.slice(0, remainingUnpaidCount);
            } else if (unpaidInstallments.length < remainingUnpaidCount) {
                let addCount = remainingUnpaidCount - unpaidInstallments.length;
                for (let i = 0; i < addCount; i++) {
                    unpaidInstallments.push({
                        id: installments.length + i,
                        payed_price: 0,
                        installment_price: 0,
                        payment_date: startDate,
                        payment_type: 'Nakit',
                        status: 0,
                        payyed_date: null,
                        note: '',
                    });
                }
            }

            $container.empty();

            let header = `<div class="xl:grid xl:grid-cols-7 gap-4 mb-3 hidden">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">#</div>
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tarih</div>
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Ödenecek</div>
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Ödenen</div>
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Ödenen Tarih</div>
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Ödeme Türü</div>
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Not</div>
            </div>`;
            $container.append(header);

            let allInstallments = [...paidInstallments, ...unpaidInstallments];

            let remainingAmount = totalPayment - paidInstallments.reduce((sum, inst) => sum + parseFloat(inst.payed_price || 0), 0);
            let newAmount = (remainingUnpaidCount ? (remainingAmount / remainingUnpaidCount).toFixed(2) : 0);

            allInstallments.forEach((inst, i) => {
                let currentInstallmentDate = new Date(startDate);
                currentInstallmentDate.setMonth(currentInstallmentDate.getMonth() + i);
                let dateStr = currentInstallmentDate.toISOString().split('T')[0];
                let dateStrPayed = inst.payyed_date ? inst.payyed_date.split('T')[0] : '';

                let paid = Number(inst.payed_price);
                let total = Number(inst.installment_price || newAmount);

                let isPaid = paid >= total && total > 0;
                let isPartial = paid > 0 && paid < total;

                let rowClass = isPaid
                    ? 'bg-emerald-50/50 border-emerald-200/60'
                    : (isPartial
                        ? 'bg-amber-50/50 border-amber-200/60'
                        : 'bg-slate-50/50 border-slate-200/60');

                let numClass = isPaid
                    ? 'bg-emerald-500 text-white'
                    : (isPartial
                        ? 'bg-amber-500 text-white'
                        : 'bg-slate-200 text-slate-600');

                let installmentPrice = paid > 0 ? inst.installment_price : newAmount;

                let inputClass = 'w-full px-3 py-2 bg-white rounded-lg text-sm text-slate-900 ring-1 ring-slate-200 border-0 focus:ring-2 focus:ring-fuchsia-500/60 transition-all';

                let row = `<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-7 gap-3 mb-2.5 p-4 rounded-xl border transition-all ${rowClass}">
                    <div class="md:col-span-2 lg:col-span-3 xl:col-span-1 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0 ${numClass}">${i + 1}</div>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate-500 mb-1 block xl:hidden">Tarih</label>
                        <input type="date" name="installments[${i}][payment_date]" form="paymentForm" value="${dateStr}" class="${inputClass}">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate-500 mb-1 block xl:hidden">Ödenecek</label>
                        <input type="number" step="0.01" name="installments[${i}][installment_price]" form="paymentForm" value="${installmentPrice}" class="${inputClass}">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate-500 mb-1 block xl:hidden">Ödenen</label>
                        <input type="number" step="0.01" name="installments[${i}][payed_price]" form="paymentForm" value="${inst.payed_price || '0.00'}" class="${inputClass}">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate-500 mb-1 block xl:hidden">Ödenen Tarih</label>
                        <input type="date" name="installments[${i}][payyed_date]" form="paymentForm" value="${dateStrPayed}" class="${inputClass}">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate-500 mb-1 block xl:hidden">Ödeme Türü</label>
                        <select name="installments[${i}][payment_type]" form="paymentForm" class="${inputClass}">
                            <option value="Nakit" ${inst.payment_type == "Nakit" ? 'selected' : ''}>Nakit</option>
                            <option value="Havale" ${inst.payment_type == "Havale" ? 'selected' : ''}>Havale</option>
                            <option value="Kredi Kartı/Banka" ${inst.payment_type == "Kredi Kartı/Banka" ? 'selected' : ''}>Kredi Kartı/Banka</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate-500 mb-1 block xl:hidden">Not</label>
                        <textarea name="installments[${i}][note]" form="paymentForm" class="${inputClass} resize-none" rows="1">${inst.note || ''}</textarea>
                    </div>
                </div>`;

                $container.append(row);
            });
        }

        $(document).ready(function() {
            generateInstallments(true);
        });

        $("#total_payment, #installments_count, #start_date").on("input change", function() {
            generateInstallments(false);
            updateTableTotals();
        });

        function updateTableTotals() {
            let totalPrice = 0;
            $("input[name$='[installment_price]']").each(function() {
                totalPrice += parseFloat($(this).val()) || 0;
            });
            $("#table_total_price").text(totalPrice.toFixed(2).replace('.', ',') + " ₺");
        }

        $(document).on("input", "input[name$='[installment_price]']", function() {
            updateTableTotals();
        });

        $(document).ready(function() {
            updateTableTotals();
        });
    </script>
@endsection
