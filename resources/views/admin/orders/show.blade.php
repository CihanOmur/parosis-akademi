@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Sipariş #{{ $order->order_number }}</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            {{ $order->created_at->format('d.m.Y H:i') }}
        </p>
    </div>
    <a href="{{ route('orders.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium
              bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700
              text-slate-600 dark:text-slate-300
              hover:bg-slate-50 dark:hover:bg-slate-700/50
              rounded-xl transition-all duration-200">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
        </svg>
        Siparişlere Dön
    </a>
@endsection

@section('content')
    @php
        $statusConfig = [
            'pending'    => ['label' => 'Beklemede',     'class' => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/10 dark:text-yellow-400'],
            'processing' => ['label' => 'İşleniyor',     'class' => 'bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400'],
            'shipped'    => ['label' => 'Kargoda',       'class' => 'bg-purple-50 text-purple-700 dark:bg-purple-500/10 dark:text-purple-400'],
            'delivered'  => ['label' => 'Teslim Edildi', 'class' => 'bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400'],
            'cancelled'  => ['label' => 'İptal',         'class' => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400'],
        ];
        $currentBadge = $statusConfig[$order->status] ?? ['label' => $order->status, 'class' => 'bg-slate-50 text-slate-700 dark:bg-slate-700 dark:text-slate-300'];
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left Column --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Card: Sipariş Kalemleri --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <h2 class="text-sm font-semibold text-slate-900 dark:text-white">Sipariş Kalemleri</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 dark:bg-slate-700/50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-16">Resim</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ürün</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Varyant</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28">Birim Fiyat</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-16 text-center">Adet</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28 text-right">Toplam</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                            @forelse ($order->items as $item)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4">
                                        @if(!empty($item->product_image))
                                            <img src="{{ asset($item->product_image) }}"
                                                 alt="{{ $item->product_name }}"
                                                 class="w-12 h-12 rounded-lg object-cover">
                                        @else
                                            <div class="w-12 h-12 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-medium text-slate-900 dark:text-white">
                                            {{ $item->product_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                        @if(!empty($item->variant_info))
                                            @php
                                                $variantParts = [];
                                                $variantData = is_array($item->variant_info) ? $item->variant_info : (json_decode($item->variant_info, true) ?? []);
                                                foreach ($variantData as $key => $value) {
                                                    $variantParts[] = ucfirst($key) . ': ' . $value;
                                                }
                                            @endphp
                                            <span class="text-xs">{{ implode(', ', $variantParts) ?: $item->variant_info }}</span>
                                        @else
                                            <span class="text-slate-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-300 whitespace-nowrap">
                                        ₺{{ number_format($item->unit_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-600 dark:text-slate-300">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-right font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                        ₺{{ number_format($item->total_price, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-slate-400 dark:text-slate-500 text-sm">
                                        Sipariş kalemi bulunamadı.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Card: Müşteri Bilgileri --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <h2 class="text-sm font-semibold text-slate-900 dark:text-white">Müşteri Bilgileri</h2>
                </div>
                <div class="px-6 py-5 space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-0.5">Ad Soyad</p>
                            <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $order->customer_name }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-0.5">E-posta</p>
                            <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $order->customer_email }}</p>
                        </div>
                    </div>
                    @if(!empty($order->customer_phone))
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-0.5">Telefon</p>
                                <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $order->customer_phone }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Card: Teslimat Adresi --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <h2 class="text-sm font-semibold text-slate-900 dark:text-white">Teslimat Adresi</h2>
                </div>
                <div class="px-6 py-5">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                            </svg>
                        </div>
                        <div class="space-y-1">
                            @if(!empty($order->shipping_address))
                                <p class="text-sm text-slate-900 dark:text-white">{{ $order->shipping_address }}</p>
                            @endif
                            @if(!empty($order->shipping_district) || !empty($order->shipping_city))
                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    {{ implode(', ', array_filter([$order->shipping_district ?? null, $order->shipping_city ?? null])) }}
                                </p>
                            @endif
                            @if(empty($order->shipping_address) && empty($order->shipping_city))
                                <p class="text-sm text-slate-400 dark:text-slate-500">Adres bilgisi girilmemiş.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card: Notlar --}}
            @if(!empty($order->customer_note) || !empty($order->admin_note))
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                        <h2 class="text-sm font-semibold text-slate-900 dark:text-white">Notlar</h2>
                    </div>
                    <div class="px-6 py-5 space-y-4">
                        @if(!empty($order->customer_note))
                            <div>
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Müşteri Notu</p>
                                <p class="text-sm text-slate-700 dark:text-slate-300 bg-slate-50 dark:bg-slate-700/50 rounded-lg px-4 py-3">
                                    {{ $order->customer_note }}
                                </p>
                            </div>
                        @endif
                        @if(!empty($order->admin_note))
                            <div>
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Admin Notu</p>
                                <p class="text-sm text-slate-700 dark:text-slate-300 bg-fuchsia-50 dark:bg-fuchsia-500/10 rounded-lg px-4 py-3">
                                    {{ $order->admin_note }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

        </div>

        {{-- Right Column --}}
        <div class="space-y-6">

            {{-- Card: Sipariş Durumu --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-slate-900 dark:text-white">Sipariş Durumu</h2>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $currentBadge['class'] }}">
                        {{ $currentBadge['label'] }}
                    </span>
                </div>
                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="px-6 py-5 space-y-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Durum
                        </label>
                        <select name="status"
                                class="w-full px-3 py-2.5 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors">
                            <option value="pending"    {{ $order->status === 'pending'    ? 'selected' : '' }}>Beklemede</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>İşleniyor</option>
                            <option value="shipped"    {{ $order->status === 'shipped'    ? 'selected' : '' }}>Kargoda</option>
                            <option value="delivered"  {{ $order->status === 'delivered'  ? 'selected' : '' }}>Teslim Edildi</option>
                            <option value="cancelled"  {{ $order->status === 'cancelled'  ? 'selected' : '' }}>İptal</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Admin Notu
                        </label>
                        <textarea name="admin_note" rows="3"
                                  placeholder="Dahili not ekleyin..."
                                  class="w-full px-3 py-2.5 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors resize-none">{{ $order->admin_note }}</textarea>
                    </div>
                    <button type="submit"
                            class="w-full px-4 py-2.5 bg-gradient-to-r from-fuchsia-500 to-purple-500 hover:from-fuchsia-600 hover:to-purple-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
                        Kaydet
                    </button>
                </form>
            </div>

            {{-- Card: Sipariş Özeti --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <h2 class="text-sm font-semibold text-slate-900 dark:text-white">Sipariş Özeti</h2>
                </div>
                <div class="px-6 py-5 space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Ara Toplam</span>
                        <span class="text-slate-900 dark:text-white font-medium">₺{{ number_format($order->subtotal ?? ($order->total_amount - ($order->shipping_amount ?? 0)), 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Kargo</span>
                        <span class="text-slate-900 dark:text-white font-medium">
                            @if(($order->shipping_amount ?? 0) > 0)
                                ₺{{ number_format($order->shipping_amount, 2) }}
                            @else
                                <span class="text-green-600 dark:text-green-400">Ücretsiz</span>
                            @endif
                        </span>
                    </div>
                    <div class="border-t border-slate-100 dark:border-slate-700/50 pt-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-slate-900 dark:text-white">Toplam</span>
                            <span class="text-base font-bold text-fuchsia-600 dark:text-fuchsia-400">₺{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card: Sipariş Bilgileri --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <h2 class="text-sm font-semibold text-slate-900 dark:text-white">Sipariş Bilgileri</h2>
                </div>
                <div class="px-6 py-5 space-y-3">
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-0.5">Sipariş No</p>
                        <p class="text-sm font-medium text-slate-900 dark:text-white">#{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-0.5">Oluşturulma Tarihi</p>
                        <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-0.5">Son Güncelleme</p>
                        <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $order->updated_at->format('d.m.Y H:i') }}</p>
                    </div>
                </div>
            </div>

            {{-- Delete Button --}}
            <form action="{{ route('orders.delete', $order->id) }}" method="POST"
                  x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Siparişi Sil', message: 'Bu siparişi kalıcı olarak silmek istediğinize emin misiniz? Bu işlem geri alınamaz.', form: $el })">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium
                               bg-red-50 dark:bg-red-500/10 hover:bg-red-100 dark:hover:bg-red-500/20
                               text-red-600 dark:text-red-400 border border-red-200 dark:border-red-500/30
                               rounded-xl transition-all duration-200 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                    </svg>
                    Siparişi Sil
                </button>
            </form>

        </div>
    </div>
@endsection
