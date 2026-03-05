@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">İndirim Kuponları</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Kuponları yönetin</p>
    </div>
    <a href="{{ route('coupons.create') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold
              bg-gradient-to-r from-fuchsia-500 to-purple-600
              hover:from-fuchsia-600 hover:to-purple-700
              text-white rounded-xl shadow-lg shadow-fuchsia-500/25
              transition-all duration-200 active:scale-[.98]">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Yeni Kupon
    </a>
@endsection

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kod</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-24">Tip</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28">Değer</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28">Min. Tutar</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-32">Kullanım</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-40">Tarih Aralığı</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-24 text-center">Durum</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($coupons as $coupon)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-700 dark:text-fuchsia-400 font-mono font-bold text-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/>
                                    </svg>
                                    {{ $coupon->code }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($coupon->type === 'percentage')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">Yüzde</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-green-50 text-green-700 dark:bg-green-500/10 dark:text-green-400">Sabit TL</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">
                                @if($coupon->type === 'percentage')
                                    %{{ number_format($coupon->value, 0) }}
                                    @if($coupon->max_discount_amount)
                                        <span class="text-xs font-normal text-slate-400">(max ₺{{ number_format($coupon->max_discount_amount, 0) }})</span>
                                    @endif
                                @else
                                    ₺{{ number_format($coupon->value, 2) }}
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                @if($coupon->min_order_amount > 0)
                                    ₺{{ number_format($coupon->min_order_amount, 2) }}
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold text-slate-900 dark:text-white">{{ $coupon->used_count }}</span>
                                    <span class="text-slate-400">/</span>
                                    <span class="text-slate-500 dark:text-slate-400">{{ $coupon->usage_limit ?? '∞' }}</span>
                                </div>
                                @if($coupon->usage_limit)
                                    <div class="mt-1 h-1.5 w-20 rounded-full bg-slate-100 dark:bg-slate-700 overflow-hidden">
                                        <div class="h-full rounded-full {{ $coupon->used_count >= $coupon->usage_limit ? 'bg-red-400' : 'bg-fuchsia-400' }}"
                                             style="width: {{ min(100, ($coupon->used_count / $coupon->usage_limit) * 100) }}%"></div>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                @if($coupon->starts_at || $coupon->expires_at)
                                    {{ $coupon->starts_at?->format('d.m.Y') ?? '—' }}
                                    <br>
                                    {{ $coupon->expires_at?->format('d.m.Y') ?? '—' }}
                                    @if($coupon->expires_at && $coupon->expires_at->lt(today()))
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-red-50 text-red-600 mt-0.5">Süresi dolmuş</span>
                                    @endif
                                @else
                                    <span class="text-slate-400">Süresiz</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button type="button"
                                        class="toggle-btn relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none cursor-pointer {{ $coupon->is_active ? 'bg-green-500' : 'bg-slate-300 dark:bg-slate-600' }}"
                                        data-id="{{ $coupon->id }}"
                                        data-url="{{ route('coupons.toggle', $coupon->id) }}">
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform duration-200 {{ $coupon->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <a href="{{ route('coupons.edit', $coupon->id) }}"
                                       class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all"
                                       title="Düzenle">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('coupons.delete', $coupon->id) }}" method="POST"
                                          x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Kuponu Sil', message: '{{ $coupon->code }} kuponunu silmek istediğinize emin misiniz?', form: $el })">
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
                            <td colspan="8" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/>
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400">Henüz kupon bulunmuyor.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($coupons->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700/50">
                {{ $coupons->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.toggle-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var url = this.dataset.url;
        var el = this;
        fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.status === 1) {
                var isActive = data.action === 'Aktif';
                el.className = el.className.replace(/bg-green-500|bg-slate-300 dark:bg-slate-600/g, '');
                if (isActive) {
                    el.classList.add('bg-green-500');
                    el.classList.remove('bg-slate-300', 'dark:bg-slate-600');
                } else {
                    el.classList.add('bg-slate-300', 'dark:bg-slate-600');
                    el.classList.remove('bg-green-500');
                }
                var dot = el.querySelector('span');
                if (isActive) {
                    dot.classList.remove('translate-x-1');
                    dot.classList.add('translate-x-6');
                } else {
                    dot.classList.remove('translate-x-6');
                    dot.classList.add('translate-x-1');
                }
            }
        });
    });
});
</script>
@endpush
