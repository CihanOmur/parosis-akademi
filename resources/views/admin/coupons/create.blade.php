@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('coupons.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Yeni Kupon</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Yeni bir indirim kuponu oluşturun</p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('coupons.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol kolon --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Kupon Bilgileri --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Kupon Bilgileri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Kupon kodu ve indirim detaylarını girin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    {{-- Kupon Kodu --}}
                    <div>
                        <label for="code" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Kupon Kodu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}"
                               placeholder="Örn: SUMMER20"
                               class="w-full px-4 py-3 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white uppercase placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors"
                               required>
                        @error('code')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Tip --}}
                        <div>
                            <label for="type" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                                İndirim Tipi <span class="text-red-500">*</span>
                            </label>
                            <select name="type" id="type"
                                    class="w-full px-4 py-3 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors"
                                    required>
                                <option value="percentage" {{ old('type') === 'percentage' ? 'selected' : '' }}>Yüzde (%)</option>
                                <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Sabit TL (₺)</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Değer --}}
                        <div>
                            <label for="value" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                                İndirim Değeri <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="value" id="value" value="{{ old('value') }}"
                                   step="0.01" min="0.01" placeholder="Örn: 20"
                                   class="w-full px-4 py-3 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors"
                                   required>
                            @error('value')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Min. Sipariş Tutarı --}}
                        <div>
                            <label for="min_order_amount" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                                Min. Sipariş Tutarı (₺)
                            </label>
                            <input type="number" name="min_order_amount" id="min_order_amount" value="{{ old('min_order_amount') }}"
                                   step="0.01" min="0" placeholder="0.00"
                                   class="w-full px-4 py-3 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors">
                            @error('min_order_amount')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Max. İndirim Tutarı --}}
                        <div id="maxDiscountWrapper">
                            <label for="max_discount_amount" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                                Max. İndirim Tutarı (₺)
                                <span class="text-xs font-normal text-slate-400">(sadece yüzde tipi)</span>
                            </label>
                            <input type="number" name="max_discount_amount" id="max_discount_amount" value="{{ old('max_discount_amount') }}"
                                   step="0.01" min="0" placeholder="Sınırsız"
                                   class="w-full px-4 py-3 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors">
                            @error('max_discount_amount')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Kullanım Limiti --}}
                    <div>
                        <label for="usage_limit" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Kullanım Limiti
                            <span class="text-xs font-normal text-slate-400">(boş bırakırsanız sınırsız)</span>
                        </label>
                        <input type="number" name="usage_limit" id="usage_limit" value="{{ old('usage_limit') }}"
                               min="1" placeholder="Sınırsız"
                               class="w-full px-4 py-3 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors">
                        @error('usage_limit')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Başlangıç Tarihi --}}
                        <div>
                            <label for="starts_at" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                                Başlangıç Tarihi
                                <span class="text-xs font-normal text-slate-400">(isteğe bağlı)</span>
                            </label>
                            <input type="date" name="starts_at" id="starts_at" value="{{ old('starts_at') }}"
                                   class="w-full px-4 py-3 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors">
                            @error('starts_at')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Bitiş Tarihi --}}
                        <div>
                            <label for="expires_at" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                                Bitiş Tarihi
                                <span class="text-xs font-normal text-slate-400">(isteğe bağlı)</span>
                            </label>
                            <input type="date" name="expires_at" id="expires_at" value="{{ old('expires_at') }}"
                                   class="w-full px-4 py-3 text-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500 transition-colors">
                            @error('expires_at')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sağ kolon --}}
        <div class="space-y-5 sticky top-24 self-start">

            {{-- Aksiyonlar --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5 space-y-3">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                               bg-gradient-to-r from-fuchsia-500 to-purple-600
                               hover:from-fuchsia-600 hover:to-purple-700
                               text-white font-semibold text-sm rounded-xl
                               shadow-lg shadow-fuchsia-500/25
                               transition-all duration-200 active:scale-[.98] cursor-pointer">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Kaydet
                </button>
                <a href="{{ route('coupons.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700
                          text-slate-600 dark:text-slate-400 font-medium text-sm rounded-xl
                          border border-slate-200/60 dark:border-slate-600/50
                          transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    İptal
                </a>
            </div>

            {{-- İpucu --}}
            <div class="bg-amber-50 dark:bg-amber-900/10 border border-amber-200/60 dark:border-amber-800/30 rounded-2xl p-4">
                <div class="flex gap-3">
                    <svg class="w-4.5 h-4.5 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd"/>
                    </svg>
                    <div class="space-y-1.5">
                        <p class="text-xs font-semibold text-amber-800 dark:text-amber-400">Bilgi</p>
                        <p class="text-xs text-amber-700 dark:text-amber-500">
                            Kupon kodu otomatik olarak büyük harfe çevrilir. Tarih ve kullanım limiti isteğe bağlıdır.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.getElementById('type').addEventListener('change', function() {
    var wrapper = document.getElementById('maxDiscountWrapper');
    if (this.value === 'fixed') {
        wrapper.style.opacity = '0.4';
        wrapper.querySelector('input').disabled = true;
    } else {
        wrapper.style.opacity = '1';
        wrapper.querySelector('input').disabled = false;
    }
});
// Init on load
document.getElementById('type').dispatchEvent(new Event('change'));
</script>
@endpush
