@extends('front.layouts.app')

@section('title', ($globalSettings['seo']['meta_title'] ?? 'Parosis Akademi') . ' | Sipariş Onayı')

@php
    $shopInfo = $shopInfo ?? \App\Models\Pages\Shop\ShopPageInfo::first();
@endphp

@section('content')
            {{-- Breadcrumb --}}
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden bg-[#FAF9F6]">
                    <div class="section-space-top pt-6">
                        <div class="container">
                            @include('front.partials.checkout-stepper', ['currentStep' => 3])
                        </div>
                    </div>
                </div>
            </section>

            {{-- Onay Section --}}
            <section class="section-checkout">
                <div class="relative z-10 overflow-hidden bg-[#FAF9F6] pb-8">
                    <div class="section-space-top pt-6">
                        <div class="container">

                            <form action="{{ route('front.checkout.process') }}" method="POST" id="confirmForm">
                                @csrf

                                {{-- Hidden inputs: session'daki teslimat bilgileri --}}
                                <input type="hidden" name="customer_name" value="{{ $shipping['customer_name'] }}" />
                                <input type="hidden" name="customer_email" value="{{ $shipping['customer_email'] }}" />
                                <input type="hidden" name="customer_phone" value="{{ $shipping['customer_phone'] }}" />
                                <input type="hidden" name="shipping_country" value="{{ $shipping['shipping_country'] }}" />
                                <input type="hidden" name="shipping_city" value="{{ $shipping['shipping_city'] }}" />
                                <input type="hidden" name="shipping_district" value="{{ $shipping['shipping_district'] }}" />
                                <input type="hidden" name="shipping_zip" value="{{ $shipping['shipping_zip'] ?? '' }}" />
                                <input type="hidden" name="shipping_address" value="{{ $shipping['shipping_address'] }}" />
                                <input type="hidden" name="customer_note" value="{{ $shipping['customer_note'] ?? '' }}" />
                                <input type="hidden" name="payment_method" value="card" />

                                <div class="grid grid-cols-1 items-start gap-10 lg:grid-cols-12">

                                    {{-- Sol: Ödeme Yöntemi Kartı --}}
                                    <div class="space-y-6 lg:col-span-7 xl:col-span-8">
                                        <div class="overflow-hidden rounded-3xl border border-colorPurpleBlue/15 bg-white shadow-xl shadow-colorPurpleBlue/5">
                                            <div class="border-b border-colorPurpleBlue/10 bg-gradient-to-r from-colorPurpleBlue/[0.04] to-transparent px-6 py-5 sm:px-8">
                                                <div class="flex items-center gap-3.5">
                                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-colorPurpleBlue to-colorPurpleBlue/80 shadow-lg shadow-colorPurpleBlue/25">
                                                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25h-15a2.25 2.25 0 0 0-2.25 2.25v10.5a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-title text-lg font-bold text-colorBlackPearl">Ödeme Yöntemi</h4>
                                                        <p class="text-xs text-colorCarbonGrey/70">256-bit SSL ile korunmaktadır</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-6 sm:p-8 space-y-5">
                                                {{-- Kart Numarasi --}}
                                                <div>
                                                    <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl">
                                                        Kart Numarası <span class="text-red-400">*</span>
                                                    </label>
                                                    <input type="text" name="card_number" id="cardNumber" maxlength="19" required placeholder="0000 0000 0000 0000" autocomplete="cc-number"
                                                           class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-4 font-mono text-base tracking-widest text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white" />
                                                </div>
                                                {{-- Kart Ismi --}}
                                                <div>
                                                    <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl">
                                                        Kart Üzerindeki İsim <span class="text-red-400">*</span>
                                                    </label>
                                                    <input type="text" name="card_name" id="cardName" required placeholder="AD SOYAD" autocomplete="cc-name"
                                                           class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-4 text-base uppercase text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 placeholder:normal-case focus:border-colorPurpleBlue/40 focus:bg-white" />
                                                </div>
                                                {{-- Son Kullanma + CVV --}}
                                                <div class="grid grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl">
                                                            Son Kullanma <span class="text-red-400">*</span>
                                                        </label>
                                                        <input type="text" name="card_expiry" id="cardExpiry" maxlength="5" required placeholder="AA/YY" autocomplete="cc-exp"
                                                               class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-4 font-mono text-base tracking-widest text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white" />
                                                    </div>
                                                    <div>
                                                        <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl">
                                                            CVV <span class="text-red-400">*</span>
                                                        </label>
                                                        <input type="password" name="card_cvv" id="cardCvv" maxlength="4" required placeholder="•••" autocomplete="cc-csc"
                                                               class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-4 font-mono text-base tracking-widest text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white" />
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-3 rounded-2xl border border-green-100 bg-gradient-to-r from-green-50/80 to-emerald-50/50 p-4">
                                                    <svg class="h-5 w-5 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                                                    <p class="text-xs leading-relaxed text-green-700">Kart bilgileriniz 256-bit SSL şifreleme ile korunmaktadır.</p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Teslimat Ozeti (readonly) --}}
                                        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
                                            <div class="flex items-start justify-between gap-4">
                                                <div>
                                                    <h5 class="font-title text-base font-bold text-colorBlackPearl mb-1">Teslimat Bilgileri</h5>
                                                    <p class="text-sm text-colorCarbonGrey/80">
                                                        <span class="font-semibold text-colorBlackPearl">{{ $shipping['customer_name'] }}</span> — {{ $shipping['customer_phone'] }}<br/>
                                                        {{ $shipping['shipping_address'] }}<br/>
                                                        {{ $shipping['shipping_district'] }}/{{ $shipping['shipping_city'] }} @if(!empty($shipping['shipping_zip'])) — {{ $shipping['shipping_zip'] }}@endif<br/>
                                                        {{ $shipping['shipping_country'] }}
                                                    </p>
                                                </div>
                                                <a href="{{ route('front.checkout') }}" class="text-xs font-semibold text-colorPurpleBlue hover:underline whitespace-nowrap">Düzenle</a>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Sağ: Sade Sipariş Özeti --}}
                                    <div class="lg:col-span-5 xl:col-span-4">
                                        <div class="sticky top-8 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xl shadow-black/[0.04]">
                                            <div class="border-b border-gray-100 bg-gradient-to-r from-[#FAF9F6] to-white px-6 py-5">
                                                <h4 class="font-title text-lg font-bold text-colorBlackPearl">Sipariş Özeti</h4>
                                            </div>

                                            <div class="p-6">
                                                {{-- Ürünler --}}
                                                <div class="space-y-3">
                                                    @foreach($cart as $item)
                                                    <div class="flex items-center gap-3 rounded-xl bg-[#FAF9F6] p-3">
                                                        <div class="relative h-14 w-14 flex-shrink-0 overflow-hidden rounded-lg">
                                                            @if(!empty($item['image']))
                                                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover" />
                                                            @else
                                                                <div class="flex h-full w-full items-center justify-center bg-gray-100"></div>
                                                            @endif
                                                            <span class="absolute -right-0.5 -top-0.5 flex h-5 min-w-[20px] items-center justify-center rounded-full bg-colorPurpleBlue px-1.5 text-[10px] font-bold text-white">{{ $item['quantity'] }}</span>
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <p class="truncate text-sm font-semibold text-colorBlackPearl">{{ $item['name'] }}</p>
                                                        </div>
                                                        <span class="flex-shrink-0 text-sm font-bold text-colorBlackPearl">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} ₺</span>
                                                    </div>
                                                    @endforeach
                                                </div>

                                                <div class="my-4 border-t border-dashed border-gray-200"></div>

                                                {{-- Ara toplam / Kargo / KDV / Toplam --}}
                                                @php
                                                    $shippingCost = 0;
                                                    // KDV %20 (Türkiye standart) - hesap: toplam / 1.20 => KDV kısmı = toplam - subtotal_hariç
                                                    $kdvRate = 0.20;
                                                    $withoutVat = round($total / (1 + $kdvRate), 2);
                                                    $kdvAmount = round($total - $withoutVat, 2);
                                                @endphp
                                                <div class="space-y-2.5 text-sm">
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-colorCarbonGrey">Ara Toplam</span>
                                                        <span class="font-semibold text-colorBlackPearl">{{ number_format($subtotal, 2, ',', '.') }} ₺</span>
                                                    </div>
                                                    @if($discount > 0)
                                                        <div class="flex items-center justify-between">
                                                            <span class="text-green-600">İndirim</span>
                                                            <span class="font-semibold text-green-600">-{{ number_format($discount, 2, ',', '.') }} ₺</span>
                                                        </div>
                                                    @endif
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-colorCarbonGrey">Kargo</span>
                                                        <span class="font-semibold text-colorBlackPearl">
                                                            @if($shippingCost > 0)
                                                                {{ number_format($shippingCost, 2, ',', '.') }} ₺
                                                            @else
                                                                <span class="text-green-600">Ücretsiz</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center justify-between text-xs text-colorCarbonGrey/70">
                                                        <span>KDV Dahil (%{{ $kdvRate * 100 }})</span>
                                                        <span>{{ number_format($kdvAmount, 2, ',', '.') }} ₺</span>
                                                    </div>
                                                </div>

                                                <div class="mt-4 rounded-2xl bg-gradient-to-r from-colorPurpleBlue/5 to-indigo-50/50 p-4">
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-sm font-bold text-colorBlackPearl">Toplam</span>
                                                        <span class="font-title text-2xl font-black text-colorPurpleBlue">{{ number_format($total, 2, ',', '.') }} ₺</span>
                                                    </div>
                                                </div>

                                                {{-- Ödeme Yap butonu --}}
                                                <button type="submit" id="payNowBtn"
                                                        class="group mt-6 flex w-full items-center justify-center gap-2.5 rounded-2xl bg-gradient-to-r from-colorPurpleBlue to-colorPurpleBlue/90 px-6 py-4 text-base font-bold text-white shadow-xl shadow-colorPurpleBlue/25 transition-all hover:shadow-2xl active:scale-[0.98]">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                                                    Ödeme Yap
                                                </button>

                                                <a href="{{ route('front.checkout') }}" class="mt-4 flex items-center justify-center gap-2 text-sm font-semibold text-colorCarbonGrey/60 hover:text-colorPurpleBlue">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                                                    Geri Dön
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>

    <script>
        // Kart numarasi format: 4'lu gruplar
        document.getElementById('cardNumber')?.addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, '').substring(0, 16);
            e.target.value = v.replace(/(\d{4})/g, '$1 ').trim();
        });
        // Son kullanma: AA/YY
        document.getElementById('cardExpiry')?.addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, '').substring(0, 4);
            if (v.length >= 3) v = v.substring(0, 2) + '/' + v.substring(2);
            e.target.value = v;
        });
        // CVV: sadece sayi
        document.getElementById('cardCvv')?.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
        });
        // Kart ismi: sadece harf + bosluk
        document.getElementById('cardName')?.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^A-Za-zÇĞİÖŞÜçğıöşü ]/g, '').toUpperCase();
        });
        // Form submit: buton disabled
        document.getElementById('confirmForm')?.addEventListener('submit', function() {
            const btn = document.getElementById('payNowBtn');
            btn.disabled = true;
            btn.innerHTML = '<svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> İşleniyor...';
            btn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    </script>
@endsection
