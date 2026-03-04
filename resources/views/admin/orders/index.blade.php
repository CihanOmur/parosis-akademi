@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Siparişler</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Siparişleri yönetin</p>
    </div>
@endsection

@section('content')
    {{-- Status Filter Tabs --}}
    <div class="flex flex-wrap gap-2 mb-4">
        @php
            $tabs = [
                ''           => 'Tümü',
                'pending'    => 'Beklemede',
                'processing' => 'İşleniyor',
                'shipped'    => 'Kargoda',
                'delivered'  => 'Teslim Edildi',
                'cancelled'  => 'İptal',
            ];
        @endphp
        @foreach ($tabs as $value => $label)
            <a href="{{ route('orders.index', array_filter(['status' => $value ?: null, 'q' => $search ?? null])) }}"
               class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                      {{ ($status ?? '') === $value
                          ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/25'
                          : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Search --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('orders.index') }}" class="flex items-center gap-3">
            @if(!empty($status))
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <div class="relative flex-1 max-w-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0"/>
                    </svg>
                </div>
                <input type="text" name="q" value="{{ $search ?? '' }}"
                       placeholder="Sipariş no veya müşteri adı..."
                       class="w-full pl-10 pr-4 py-2.5 text-sm bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors">
            </div>
            <button type="submit"
                    class="px-4 py-2.5 bg-fuchsia-500 hover:bg-fuchsia-600 text-white text-sm font-medium rounded-xl transition-colors">
                Ara
            </button>
            @if(!empty($search))
                <a href="{{ route('orders.index', array_filter(['status' => $status ?? null])) }}"
                   class="px-4 py-2.5 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300 text-sm font-medium rounded-xl transition-colors">
                    Temizle
                </a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sipariş No</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Müşteri</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-40">Tarih</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28 text-center">Ürün Sayısı</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-32">Toplam</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-32">Durum</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($orders as $order)
                        @php
                            $statusConfig = [
                                'pending'    => ['label' => 'Beklemede',     'class' => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/10 dark:text-yellow-400'],
                                'processing' => ['label' => 'İşleniyor',     'class' => 'bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400'],
                                'shipped'    => ['label' => 'Kargoda',       'class' => 'bg-purple-50 text-purple-700 dark:bg-purple-500/10 dark:text-purple-400'],
                                'delivered'  => ['label' => 'Teslim Edildi', 'class' => 'bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400'],
                                'cancelled'  => ['label' => 'İptal',         'class' => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400'],
                            ];
                            $badge = $statusConfig[$order->status] ?? ['label' => $order->status, 'class' => 'bg-slate-50 text-slate-700 dark:bg-slate-700 dark:text-slate-300'];
                        @endphp
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="font-bold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                    #{{ $order->order_number }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-900 dark:text-white">{{ $order->customer_name }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ $order->customer_email }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                {{ $order->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                    {{ $order->items_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                ₺{{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $badge['class'] }}">
                                    {{ $badge['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                       class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all"
                                       title="Görüntüle">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('orders.delete', $order->id) }}" method="POST"
                                          x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Siparişi Sil', message: 'Bu siparişi silmek istediğinize emin misiniz?', form: $el })">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer"
                                                title="Sil">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/>
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400">Henüz sipariş bulunmuyor.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($orders->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700/50">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
