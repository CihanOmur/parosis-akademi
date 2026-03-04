@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Sepetim')

@section('content')
            <!--...::: Breadcrumb Section Start :::... -->
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden bg-[#FAF9F6]">
                    <div class="py-[60px] lg:py-[90px]">
                        <div class="container">
                            <div class="text-center">
                                <h1 class="mb-5 text-4xl capitalize tracking-normal">Sepetim</h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">ANA SAYFA</a>
                                        </li>
                                        <li>SEPETİM</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -left-48 top-0 -z-10 h-[327px] w-[371px] bg-[#BFC06F] blur-[250px]"></div>
                    <div class="absolute -right-36 bottom-20 -z-10 h-[327px] w-[371px] bg-[#AAC3E9] blur-[200px]"></div>
                    <img src="{{ asset('assets-front/img/abstracts/abstract-purple-dash-1.svg') }}" alt="" class="absolute left-56 top-1/2 -z-10 hidden -translate-y-1/2 sm:inline-block" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="" class="absolute -bottom-14 right-[100px] -z-10 hidden sm:inline-block" />
                </div>
            </section>
            <!--...::: Breadcrumb Section End :::... -->

            <!--...::: Cart Section Start :::... -->
            <section class="section-cart">
                <div class="bg-white pb-64 pt-16 lg:pt-24">
                    <div class="container">

                        @if(session('success'))
                        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-6 py-4 text-green-800">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-6 py-4 text-red-800">{{ session('error') }}</div>
                        @endif

                        @if(empty($cart))
                        <!-- Empty Cart -->
                        <div class="flex flex-col items-center justify-center py-24 text-center">
                            <div class="mb-6 flex h-28 w-28 items-center justify-center rounded-full bg-[#FAF9F6]">
                                <svg class="h-14 w-14 text-colorBlackPearl/15" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/>
                                </svg>
                            </div>
                            <h3 class="mb-3 font-title text-2xl font-bold text-colorBlackPearl">Sepetiniz boş</h3>
                            <p class="mb-8 text-colorCarbonGrey">Henüz sepetinize ürün eklemediniz.</p>
                            <a href="{{ route('front.products') }}" class="inline-flex items-center gap-2 rounded-full bg-colorPurpleBlue px-8 py-3.5 text-sm font-semibold text-white transition-all hover:bg-colorBlackPearl">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/></svg>
                                Ürünlere Göz At
                            </a>
                        </div>
                        @else
                        <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">
                            <!-- Cart Items (left 2/3) -->
                            <div class="lg:col-span-2">
                                <div class="mb-6 flex items-center justify-between">
                                    <h3 class="font-title text-xl font-bold text-colorBlackPearl">
                                        Sepetinizdeki Ürünler
                                        <span class="ml-2 inline-flex h-7 min-w-[28px] items-center justify-center rounded-full bg-colorPurpleBlue/10 px-2 text-sm font-semibold text-colorPurpleBlue">{{ collect($cart)->sum('quantity') }}</span>
                                    </h3>
                                </div>

                                <div class="space-y-4" id="cartItemsList">
                                    @foreach($cart as $key => $item)
                                    <div id="cart-row-{{ $key }}" class="group rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
                                        <div class="flex gap-5">
                                            <!-- Image -->
                                            <a href="{{ route('front.product.details', $item['product_id']) }}" class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-xl sm:h-28 sm:w-28">
                                                @if(!empty($item['image']))
                                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover" />
                                                @else
                                                    <div class="flex h-full w-full items-center justify-center bg-gray-100">
                                                        <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12"/></svg>
                                                    </div>
                                                @endif
                                            </a>

                                            <!-- Info -->
                                            <div class="flex flex-1 flex-col justify-between gap-3">
                                                <div class="flex items-start justify-between gap-4">
                                                    <div>
                                                        <a href="{{ route('front.product.details', $item['product_id']) }}" class="text-base font-bold text-colorBlackPearl transition-colors hover:text-colorPurpleBlue">{{ $item['name'] }}</a>
                                                        @if(!empty($item['variant_info']) && is_array($item['variant_info']))
                                                        <p class="mt-1 text-sm text-colorCarbonGrey">
                                                            @foreach($item['variant_info'] as $attrName => $valName)
                                                                <span class="inline-flex items-center gap-1 rounded bg-gray-100 px-2 py-0.5 text-xs font-medium">{{ $attrName }}: {{ $valName }}</span>
                                                            @endforeach
                                                        </p>
                                                        @endif
                                                    </div>
                                                    <!-- Remove -->
                                                    <form action="{{ route('front.cart.remove') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="key" value="{{ $key }}" />
                                                        <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-full text-gray-300 transition-all hover:bg-red-50 hover:text-red-500" title="Kaldır">
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <!-- +/- quantity -->
                                                    <form action="{{ route('front.cart.update') }}" method="POST" class="flex items-center">
                                                        @csrf
                                                        <input type="hidden" name="key" value="{{ $key }}" />
                                                        <div class="inline-flex items-center overflow-hidden rounded-xl border border-gray-200">
                                                            <button type="button" class="flex h-10 w-10 items-center justify-center bg-gray-50 text-lg font-semibold text-gray-500 transition-colors hover:bg-gray-100" onclick="changeCartQty(this, -1)">&minus;</button>
                                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99"
                                                                   class="h-10 w-12 border-x border-gray-200 bg-white text-center text-sm font-semibold text-colorBlackPearl outline-none qty-no-spinner"
                                                                   onchange="this.form.submit()" />
                                                            <button type="button" class="flex h-10 w-10 items-center justify-center bg-gray-50 text-lg font-semibold text-gray-500 transition-colors hover:bg-gray-100" onclick="changeCartQty(this, 1)">+</button>
                                                        </div>
                                                    </form>
                                                    <!-- Price -->
                                                    <div class="text-right">
                                                        <span class="text-sm text-colorCarbonGrey">{{ number_format($item['price'], 2, ',', '.') }} ₺ / adet</span>
                                                        <p class="text-lg font-bold text-colorPurpleBlue">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} ₺</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Continue Shopping -->
                                <a href="{{ route('front.products') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-colorCarbonGrey transition-colors hover:text-colorPurpleBlue">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                                    Alışverişe Devam Et
                                </a>
                            </div>

                            <!-- Order Summary (right 1/3) -->
                            <div class="lg:col-span-1">
                                <div class="sticky top-8 rounded-2xl border border-gray-100 bg-[#FAF9F6] p-6 shadow-sm">
                                    <h4 class="mb-6 font-title text-lg font-bold text-colorBlackPearl">Sipariş Özeti</h4>

                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-colorCarbonGrey">Ara Toplam ({{ collect($cart)->sum('quantity') }} ürün)</span>
                                            <span class="font-semibold text-colorBlackPearl">{{ number_format($total, 2, ',', '.') }} ₺</span>
                                        </div>
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-colorCarbonGrey">Kargo</span>
                                            <span class="font-medium text-green-600">Ücretsiz</span>
                                        </div>
                                    </div>

                                    <div class="my-5 border-t border-gray-200"></div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-base font-bold text-colorBlackPearl">Toplam</span>
                                        <span class="font-title text-2xl font-bold text-colorPurpleBlue">{{ number_format($total, 2, ',', '.') }} ₺</span>
                                    </div>

                                    <a href="{{ route('front.checkout') }}" class="mt-6 flex w-full items-center justify-center gap-2 rounded-full bg-colorPurpleBlue px-6 py-4 text-base font-semibold text-white transition-all hover:bg-colorBlackPearl hover:shadow-lg">
                                        Ödemeye Geç
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                                    </a>

                                    <!-- Trust badges -->
                                    <div class="mt-6 grid grid-cols-2 gap-3">
                                        <div class="flex items-center gap-2 rounded-lg bg-white p-2.5 text-xs text-colorCarbonGrey">
                                            <svg class="h-4 w-4 flex-shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                                            Güvenli Ödeme
                                        </div>
                                        <div class="flex items-center gap-2 rounded-lg bg-white p-2.5 text-xs text-colorCarbonGrey">
                                            <svg class="h-4 w-4 flex-shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                                            Hızlı Kargo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </section>
            <!--...::: Cart Section End :::... -->
@endsection

@push('styles')
<style>
.qty-no-spinner::-webkit-outer-spin-button,
.qty-no-spinner::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
.qty-no-spinner { -moz-appearance: textfield; }
</style>
@endpush

@push('scripts')
<script>
function changeCartQty(btn, delta) {
    var form = btn.closest('form');
    var input = form.querySelector('input[name="quantity"]');
    if (!input) return;
    var val = parseInt(input.value) || 1;
    val = Math.max(1, Math.min(99, val + delta));
    input.value = val;
    form.submit();
}
</script>
@endpush
