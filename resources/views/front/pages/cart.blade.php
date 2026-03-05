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
                <div class="relative bg-gradient-to-b from-white via-white to-[#FAF9F6] pb-64 pt-12 lg:pt-20">
                    <div class="container">

                        @if(session('success'))
                        <div class="mb-8 flex items-center gap-3 rounded-2xl border border-green-100 bg-gradient-to-r from-green-50 to-white px-6 py-4 shadow-sm">
                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-green-100">
                                <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-green-800">{{ session('success') }}</p>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="mb-8 flex items-center gap-3 rounded-2xl border border-red-100 bg-gradient-to-r from-red-50 to-white px-6 py-4 shadow-sm">
                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-red-100">
                                <svg class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-red-800">{{ session('error') }}</p>
                        </div>
                        @endif

                        @if(empty($cart))
                        <!-- Empty Cart -->
                        <div class="flex flex-col items-center justify-center py-28 text-center">
                            <div class="relative mb-8">
                                <div class="flex h-32 w-32 items-center justify-center rounded-full bg-gradient-to-br from-[#FAF9F6] to-gray-100">
                                    <svg class="h-16 w-16 text-colorBlackPearl/10" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/>
                                    </svg>
                                </div>
                                <div class="absolute -bottom-1 -right-1 flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-lg">
                                    <svg class="h-5 w-5 text-colorCarbonGrey/40" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z"/></svg>
                                </div>
                            </div>
                            <h3 class="mb-3 font-title text-2xl font-bold text-colorBlackPearl">Sepetiniz henüz boş</h3>
                            <p class="mb-10 max-w-sm text-colorCarbonGrey/70">Mağazamızdaki ürünlere göz atarak sepetinize ürün ekleyebilirsiniz.</p>
                            <a href="{{ route('front.products') }}" class="group inline-flex items-center gap-2.5 rounded-2xl bg-gradient-to-r from-colorPurpleBlue to-colorPurpleBlue/90 px-8 py-4 text-sm font-bold text-white shadow-xl shadow-colorPurpleBlue/25 transition-all hover:shadow-2xl hover:shadow-colorPurpleBlue/30 active:scale-[0.98]">
                                <svg class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/></svg>
                                Ürünlere Göz At
                            </a>
                        </div>
                        @else
                        <div class="grid grid-cols-1 items-start gap-10 lg:grid-cols-12">
                            <!-- Cart Items (left) -->
                            <div class="lg:col-span-7 xl:col-span-8">
                                <div class="mb-6 flex items-center justify-between">
                                    <h3 class="font-title text-xl font-bold text-colorBlackPearl">
                                        Sepetinizdeki Ürünler
                                    </h3>
                                    <span class="inline-flex items-center rounded-full bg-colorPurpleBlue/10 px-3.5 py-1.5 text-xs font-bold text-colorPurpleBlue">{{ collect($cart)->sum('quantity') }} ürün</span>
                                </div>

                                <div class="space-y-4" id="cartItemsList">
                                    @foreach($cart as $key => $item)
                                    <div id="cart-row-{{ $key }}" class="group overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-lg shadow-black/[0.03] transition-all hover:shadow-xl hover:shadow-black/[0.05]">
                                        <div class="flex gap-5 p-5 sm:p-6">
                                            <!-- Image -->
                                            <a href="{{ route('front.product.details', $item['product_id']) }}" class="relative h-28 w-28 flex-shrink-0 overflow-hidden rounded-2xl sm:h-32 sm:w-32">
                                                @if(!empty($item['image']))
                                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                                                @else
                                                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100">
                                                        <svg class="h-10 w-10 text-gray-200" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12"/></svg>
                                                    </div>
                                                @endif
                                            </a>

                                            <!-- Info -->
                                            <div class="flex flex-1 flex-col justify-between gap-3">
                                                <div class="flex items-start justify-between gap-4">
                                                    <div>
                                                        <a href="{{ route('front.product.details', $item['product_id']) }}" class="font-title text-base font-bold text-colorBlackPearl transition-colors hover:text-colorPurpleBlue sm:text-lg">{{ $item['name'] }}</a>
                                                        @if(!empty($item['variant_info']) && is_array($item['variant_info']))
                                                        <div class="mt-2 flex flex-wrap gap-1.5">
                                                            @foreach($item['variant_info'] as $attrName => $valName)
                                                                <span class="inline-flex items-center gap-1 rounded-lg bg-[#FAF9F6] px-2.5 py-1 text-xs font-semibold text-colorCarbonGrey">{{ $attrName }}: {{ $valName }}</span>
                                                            @endforeach
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <!-- Remove -->
                                                    <form action="{{ route('front.cart.remove') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="key" value="{{ $key }}" />
                                                        <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-xl text-gray-300 transition-all hover:bg-red-50 hover:text-red-400" title="Kaldır">
                                                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <!-- +/- quantity -->
                                                    <form action="{{ route('front.cart.update') }}" method="POST" class="flex items-center">
                                                        @csrf
                                                        <input type="hidden" name="key" value="{{ $key }}" />
                                                        <div class="inline-flex items-center overflow-hidden rounded-2xl border-2 border-gray-100 bg-[#FAFAFA]">
                                                            <button type="button" class="flex h-11 w-11 items-center justify-center text-base font-bold text-gray-400 transition-colors hover:bg-gray-100 hover:text-colorBlackPearl" onclick="changeCartQty(this, -1)">&minus;</button>
                                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99"
                                                                   class="h-11 w-12 border-x-2 border-gray-100 bg-white text-center text-sm font-bold text-colorBlackPearl outline-none qty-no-spinner"
                                                                   onchange="this.form.submit()" />
                                                            <button type="button" class="flex h-11 w-11 items-center justify-center text-base font-bold text-gray-400 transition-colors hover:bg-gray-100 hover:text-colorBlackPearl" onclick="changeCartQty(this, 1)">+</button>
                                                        </div>
                                                    </form>
                                                    <!-- Price -->
                                                    <div class="text-right">
                                                        <span class="text-xs font-medium text-colorCarbonGrey/60">{{ number_format($item['price'], 2, ',', '.') }} ₺ / adet</span>
                                                        <p class="font-title text-xl font-black text-colorPurpleBlue">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} ₺</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Continue Shopping -->
                                <a href="{{ route('front.products') }}" class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-colorCarbonGrey/60 transition-colors hover:text-colorPurpleBlue">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                                    Alışverişe Devam Et
                                </a>
                            </div>

                            <!-- Order Summary (right) -->
                            <div class="lg:col-span-5 xl:col-span-4">
                                <div class="sticky top-8 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xl shadow-black/[0.04]">
                                    <!-- Summary Header -->
                                    <div class="border-b border-gray-100 bg-gradient-to-r from-[#FAF9F6] to-white px-6 py-5">
                                        <h4 class="font-title text-lg font-bold text-colorBlackPearl">Sipariş Özeti</h4>
                                    </div>

                                    <div class="p-6">
                                        <div class="space-y-4">
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-colorCarbonGrey">Ara Toplam <span class="text-colorCarbonGrey/50">({{ collect($cart)->sum('quantity') }} ürün)</span></span>
                                                <span class="font-bold text-colorBlackPearl">{{ number_format($subtotal, 2, ',', '.') }} ₺</span>
                                            </div>
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-colorCarbonGrey">Kargo</span>
                                                <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-bold text-green-600">
                                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                                    Ücretsiz
                                                </span>
                                            </div>
                                        </div>

                                        <div class="my-5 border-t border-dashed border-gray-200"></div>

                                        <!-- Coupon -->
                                        <div id="couponSection">
                                            @if($coupon)
                                            {{-- Applied coupon --}}
                                            <div id="couponApplied">
                                                <div class="flex items-center justify-between rounded-xl bg-green-50 px-3.5 py-2.5">
                                                    <div class="flex items-center gap-2">
                                                        <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/></svg>
                                                        <span id="couponCodeLabel" class="text-sm font-bold text-green-700">{{ $coupon['code'] }}</span>
                                                    </div>
                                                    <button type="button" onclick="removeCoupon()" class="text-xs font-semibold text-red-500 hover:text-red-700 transition-colors cursor-pointer">Kaldır</button>
                                                </div>
                                                <div class="mt-2 flex items-center justify-between text-sm">
                                                    <span class="text-green-600 font-medium">İndirim</span>
                                                    <span id="couponDiscountLabel" class="font-semibold text-green-600">-{{ number_format($discount, 2, ',', '.') }} ₺</span>
                                                </div>
                                            </div>
                                            @else
                                            <div id="couponApplied" style="display:none">
                                                <div class="flex items-center justify-between rounded-xl bg-green-50 px-3.5 py-2.5">
                                                    <div class="flex items-center gap-2">
                                                        <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/></svg>
                                                        <span id="couponCodeLabel" class="text-sm font-bold text-green-700"></span>
                                                    </div>
                                                    <button type="button" onclick="removeCoupon()" class="text-xs font-semibold text-red-500 hover:text-red-700 transition-colors cursor-pointer">Kaldır</button>
                                                </div>
                                                <div class="mt-2 flex items-center justify-between text-sm">
                                                    <span class="text-green-600 font-medium">İndirim</span>
                                                    <span id="couponDiscountLabel" class="font-semibold text-green-600"></span>
                                                </div>
                                            </div>
                                            @endif

                                            {{-- Coupon input --}}
                                            <div id="couponInput" @if($coupon) style="display:none" @endif>
                                                <p class="mb-2 text-xs font-semibold text-colorCarbonGrey/70">İndirim Kodu</p>
                                                <div class="flex gap-2">
                                                    <input type="text" id="couponCodeInput" placeholder="Kupon kodunuzu girin"
                                                           class="flex-1 rounded-xl border-2 border-gray-100 bg-[#FAFAFA] px-4 py-2.5 text-sm font-medium uppercase text-colorBlackPearl outline-none transition-all placeholder:normal-case placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white" />
                                                    <button type="button" id="couponApplyBtn" onclick="applyCoupon()"
                                                            class="rounded-xl bg-colorBlackPearl px-4 py-2.5 text-xs font-bold text-white transition-all hover:bg-colorPurpleBlue disabled:opacity-50 cursor-pointer">
                                                        Uygula
                                                    </button>
                                                </div>
                                                <p id="couponError" class="mt-1.5 text-xs font-medium text-red-500" style="display:none"></p>
                                            </div>
                                        </div>

                                        <div class="my-5 border-t border-dashed border-gray-200"></div>

                                        <!-- Total -->
                                        <div class="rounded-2xl bg-gradient-to-r from-colorPurpleBlue/5 to-indigo-50/50 p-4">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm font-bold text-colorBlackPearl">Toplam</span>
                                                <span id="cartTotal" class="font-title text-2xl font-black text-colorPurpleBlue">{{ number_format($total, 2, ',', '.') }} ₺</span>
                                            </div>
                                        </div>

                                        <a href="{{ route('front.checkout') }}"
                                           class="group mt-6 flex w-full items-center justify-center gap-2.5 rounded-2xl bg-gradient-to-r from-colorPurpleBlue to-colorPurpleBlue/90 px-6 py-4.5 text-base font-bold text-white shadow-xl shadow-colorPurpleBlue/25 transition-all hover:shadow-2xl hover:shadow-colorPurpleBlue/30 active:scale-[0.98]">
                                            Ödemeye Geç
                                            <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                                        </a>

                                        <!-- Trust badges -->
                                        <div class="mt-5 grid grid-cols-3 gap-2">
                                            <div class="flex flex-col items-center gap-1.5 rounded-xl bg-[#FAF9F6] p-3 text-center">
                                                <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                                                <span class="text-[10px] font-semibold leading-tight text-colorCarbonGrey">SSL Güvenlik</span>
                                            </div>
                                            <div class="flex flex-col items-center gap-1.5 rounded-xl bg-[#FAF9F6] p-3 text-center">
                                                <svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                                                <span class="text-[10px] font-semibold leading-tight text-colorCarbonGrey">Hızlı Kargo</span>
                                            </div>
                                            <div class="flex flex-col items-center gap-1.5 rounded-xl bg-[#FAF9F6] p-3 text-center">
                                                <svg class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182"/></svg>
                                                <span class="text-[10px] font-semibold leading-tight text-colorCarbonGrey">Kolay İade</span>
                                            </div>
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

// Coupon
var couponInput = document.getElementById('couponCodeInput');
if (couponInput) {
    couponInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); applyCoupon(); }
    });
}

function applyCoupon() {
    var code = document.getElementById('couponCodeInput').value.trim();
    if (!code) return;
    var btn = document.getElementById('couponApplyBtn');
    var errEl = document.getElementById('couponError');
    btn.disabled = true;
    btn.textContent = '...';
    errEl.style.display = 'none';

    fetch('{{ route('front.coupon.apply') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ code: code })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        btn.disabled = false;
        btn.textContent = 'Uygula';
        if (data.status === 1) {
            document.getElementById('couponCodeLabel').textContent = data.code;
            document.getElementById('couponDiscountLabel').textContent = '-' + data.discount_formatted + ' ₺';
            document.getElementById('couponApplied').style.display = '';
            document.getElementById('couponInput').style.display = 'none';
            document.getElementById('cartTotal').textContent = data.total_formatted + ' ₺';
        } else {
            errEl.textContent = data.message;
            errEl.style.display = '';
        }
    })
    .catch(function() {
        btn.disabled = false;
        btn.textContent = 'Uygula';
        errEl.textContent = 'Bir hata oluştu.';
        errEl.style.display = '';
    });
}

function removeCoupon() {
    fetch('{{ route('front.coupon.remove') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.status === 1) {
            document.getElementById('couponApplied').style.display = 'none';
            document.getElementById('couponInput').style.display = '';
            document.getElementById('couponCodeInput').value = '';
            document.getElementById('cartTotal').textContent = data.total_formatted + ' ₺';
        }
    });
}
</script>
@endpush
