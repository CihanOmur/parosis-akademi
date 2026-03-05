@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Sipariş Oluştur')

@php
    $fieldStyles = $shopInfo?->field_styles ?? [];
    $fs = function($field) use ($fieldStyles) {
        $s = $fieldStyles[$field] ?? [];
        $style = '';
        if (!empty($s['fontSize'])) $style .= 'font-size:'.$s['fontSize'].';';
        if (!empty($s['color'])) $style .= 'color:'.$s['color'].';';
        if (isset($s['opacity']) && $s['opacity'] !== '' && intval($s['opacity']) < 100) $style .= 'opacity:'.round(intval($s['opacity']) / 100, 2).';';
        if (!empty($s['fontFamily'])) $style .= 'font-family:'.$s['fontFamily'].';';
        if (!empty($s['fontWeight'])) $style .= 'font-weight:'.$s['fontWeight'].';';
        if (!empty($s['fontStyle'])) $style .= 'font-style:'.$s['fontStyle'].';';
        if (!empty($s['textAlign'])) $style .= 'text-align:'.$s['textAlign'].';';
        return $style;
    };
@endphp

@section('content')
            <!--...::: Breadcrumb Section Start :::... -->
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden bg-[#FAF9F6]">
                    <div class="py-[60px] lg:py-[90px]">
                        <div class="container">
                            <div class="text-center">
                                <h1 class="mb-5 text-4xl capitalize tracking-normal" @if($fs('checkout_title')) style="{{ $fs('checkout_title') }}" @endif>{{ $shopInfo->checkout_title ?? 'Ödeme' }}</h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">{{ $shopInfo->products_breadcrumb_home ?? 'ANA SAYFA' }}</a>
                                        </li>
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.cart') }}" @if($fs('checkout_breadcrumb_cart')) style="{{ $fs('checkout_breadcrumb_cart') }}" @endif>{{ $shopInfo->checkout_breadcrumb_cart ?? 'SEPETİM' }}</a>
                                        </li>
                                        <li @if($fs('checkout_breadcrumb_current')) style="{{ $fs('checkout_breadcrumb_current') }}" @endif>{{ $shopInfo->checkout_breadcrumb_current ?? 'ÖDEME' }}</li>
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

            <!--...::: Checkout Section Start :::... -->
            <section class="section-checkout">
                <div class="relative bg-gradient-to-b from-white via-white to-[#FAF9F6] pb-64 pt-12 lg:pt-20">
                    <div class="container">

                        @if($errors->any())
                        <div class="mb-10 flex items-start gap-4 rounded-2xl border border-red-100 bg-gradient-to-r from-red-50 to-white px-6 py-5 shadow-sm">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-red-100">
                                <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                            </div>
                            <div>
                                <p class="mb-1.5 text-sm font-bold text-red-800">Lütfen aşağıdaki alanları kontrol edin</p>
                                <ul class="space-y-0.5 text-sm text-red-600">
                                    @foreach($errors->all() as $error)
                                        <li class="flex items-center gap-1.5">
                                            <span class="h-1 w-1 flex-shrink-0 rounded-full bg-red-400"></span>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        <!-- Steps indicator -->
                        <div class="mb-14 flex items-center justify-center">
                            <div class="flex items-center">
                                <!-- Step 1 -->
                                <div class="flex flex-col items-center">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-colorPurpleBlue shadow-lg shadow-colorPurpleBlue/30">
                                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                    </div>
                                    <span class="mt-2.5 text-xs font-bold uppercase tracking-wider text-colorPurpleBlue" @if($fs('checkout_step_1')) style="{{ $fs('checkout_step_1') }}" @endif>{{ $shopInfo->checkout_step_1 ?? 'Sepet' }}</span>
                                </div>
                                <div class="mx-2 h-0.5 w-14 rounded-full bg-colorPurpleBlue sm:mx-4 sm:w-24"></div>
                                <!-- Step 2 -->
                                <div class="flex flex-col items-center">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-colorPurpleBlue shadow-lg shadow-colorPurpleBlue/30">
                                        <span class="text-sm font-bold text-white">2</span>
                                    </div>
                                    <span class="mt-2.5 text-xs font-bold uppercase tracking-wider text-colorPurpleBlue" @if($fs('checkout_step_2')) style="{{ $fs('checkout_step_2') }}" @endif>{{ $shopInfo->checkout_step_2 ?? 'Ödeme' }}</span>
                                </div>
                                <div class="mx-2 h-0.5 w-14 rounded-full bg-gray-200 sm:mx-4 sm:w-24"></div>
                                <!-- Step 3 -->
                                <div class="flex flex-col items-center">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-full border-2 border-gray-200 bg-white">
                                        <span class="text-sm font-bold text-gray-300">3</span>
                                    </div>
                                    <span class="mt-2.5 text-xs font-medium uppercase tracking-wider text-gray-400" @if($fs('checkout_step_3')) style="{{ $fs('checkout_step_3') }}" @endif>{{ $shopInfo->checkout_step_3 ?? 'Onay' }}</span>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('front.checkout.process') }}" method="POST" id="checkoutForm">
                            @csrf

                            <div class="grid grid-cols-1 items-start gap-10 lg:grid-cols-12">

                                <!-- Left Column: Forms -->
                                <div class="space-y-6 lg:col-span-7 xl:col-span-8">

                                    <!-- Ödeme Yöntemi Card -->
                                    <div class="overflow-hidden rounded-3xl border border-colorPurpleBlue/15 bg-white shadow-xl shadow-colorPurpleBlue/5">
                                        <!-- Card Header -->
                                        <div class="border-b border-colorPurpleBlue/10 bg-gradient-to-r from-colorPurpleBlue/[0.04] to-transparent px-6 py-5 sm:px-8">
                                            <div class="flex items-center gap-3.5">
                                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-colorPurpleBlue to-colorPurpleBlue/80 shadow-lg shadow-colorPurpleBlue/25">
                                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25h-15a2.25 2.25 0 0 0-2.25 2.25v10.5a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                                                </div>
                                                <div>
                                                    <h4 class="font-title text-lg font-bold text-colorBlackPearl" @if($fs('checkout_payment_title')) style="{{ $fs('checkout_payment_title') }}" @endif>{{ $shopInfo->checkout_payment_title ?? 'Ödeme Yöntemi' }}</h4>
                                                    <p class="text-xs text-colorCarbonGrey/70" @if($fs('checkout_payment_subtitle')) style="{{ $fs('checkout_payment_subtitle') }}" @endif>{{ $shopInfo->checkout_payment_subtitle ?? '256-bit SSL ile korunmaktadır' }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-6 sm:p-8">
                                            <input type="hidden" name="payment_method" value="card" />

                                            <!-- Card Form -->
                                                <!-- 3D Card Preview -->
                                                <div class="group relative mx-auto mb-10 max-w-lg cursor-default" style="perspective: 1000px;">
                                                    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#0f0c29] via-[#302b63] to-[#24243e] px-8 py-9 text-white shadow-2xl transition-transform duration-500 sm:px-10 sm:py-10" style="transform-style: preserve-3d;">
                                                        <!-- Shiny overlay -->
                                                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-tr from-transparent via-white/[0.06] to-transparent"></div>
                                                        <!-- Chip + Brand -->
                                                        <div class="relative flex items-start justify-between">
                                                            <div class="flex h-10 w-14 items-center justify-center overflow-hidden rounded-md bg-gradient-to-br from-[#ffd700] to-[#b8860b] shadow-inner">
                                                                <div class="grid grid-cols-3 gap-px">
                                                                    <div class="h-2 w-2 rounded-[1px] bg-[#daa520]/50"></div>
                                                                    <div class="h-2 w-2 rounded-[1px] bg-[#daa520]/30"></div>
                                                                    <div class="h-2 w-2 rounded-[1px] bg-[#daa520]/50"></div>
                                                                    <div class="h-2 w-2 rounded-[1px] bg-[#daa520]/30"></div>
                                                                    <div class="h-2 w-2 rounded-[1px] bg-[#daa520]/50"></div>
                                                                    <div class="h-2 w-2 rounded-[1px] bg-[#daa520]/30"></div>
                                                                </div>
                                                            </div>
                                                            <!-- Contactless icon -->
                                                            <div class="flex items-center gap-3">
                                                                <svg class="h-6 w-6 rotate-90 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0"/></svg>
                                                                <div id="cardBrand" class="text-2xl font-bold tracking-widest opacity-80">VISA</div>
                                                            </div>
                                                        </div>
                                                        <!-- Number -->
                                                        <p id="cardPreviewNumber" class="relative mt-8 whitespace-nowrap font-mono text-[22px] tracking-[0.16em] sm:text-[26px]">
                                                            <span class="opacity-90">•••• •••• •••• ••••</span>
                                                        </p>
                                                        <!-- Bottom row -->
                                                        <div class="relative mt-7 flex items-end justify-between">
                                                            <div>
                                                                <p class="text-[9px] font-medium uppercase tracking-[0.2em] text-white/40" @if($fs('checkout_card_holder_label')) style="{{ $fs('checkout_card_holder_label') }}" @endif>{{ $shopInfo->checkout_card_holder_label ?? 'Kart Sahibi' }}</p>
                                                                <p id="cardPreviewName" class="mt-1 text-[13px] font-semibold uppercase tracking-wider sm:text-sm" @if($fs('checkout_card_preview_name')) style="{{ $fs('checkout_card_preview_name') }}" @endif>{{ $shopInfo->checkout_card_preview_name ?? 'AD SOYAD' }}</p>
                                                            </div>
                                                            <div class="text-right">
                                                                <p class="text-[9px] font-medium uppercase tracking-[0.2em] text-white/40" @if($fs('checkout_card_expiry_preview')) style="{{ $fs('checkout_card_expiry_preview') }}" @endif>{{ $shopInfo->checkout_card_expiry_preview ?? 'Son Kullanma' }}</p>
                                                                <p id="cardPreviewExpiry" class="mt-1 text-[13px] font-semibold tracking-wider sm:text-sm">••/••</p>
                                                            </div>
                                                        </div>
                                                        <!-- Decorative -->
                                                        <div class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full bg-white/[0.04]"></div>
                                                        <div class="pointer-events-none absolute -bottom-20 -left-10 h-52 w-52 rounded-full bg-white/[0.03]"></div>
                                                        <div class="pointer-events-none absolute right-10 top-1/2 h-32 w-32 -translate-y-1/2 rounded-full bg-white/[0.02]"></div>
                                                    </div>
                                                </div>

                                                <!-- Card Inputs -->
                                                <div class="space-y-5">
                                                    <div>
                                                        <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" @if($fs('checkout_card_number_label')) style="{{ $fs('checkout_card_number_label') }}" @endif>
                                                            <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25h-15a2.25 2.25 0 0 0-2.25 2.25v10.5a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                                                            {{ $shopInfo->checkout_card_number_label ?? 'Kart Numarası' }}
                                                        </label>
                                                        <div class="relative">
                                                            <input type="text" name="card_number" id="cardNumber" maxlength="19" placeholder="{{ $shopInfo->checkout_card_number_ph ?? '0000 0000 0000 0000' }}" autocomplete="cc-number"
                                                                   class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] py-4 pl-5 pr-14 font-mono text-base tracking-widest text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5" />
                                                            <div class="pointer-events-none absolute right-4 top-1/2 flex -translate-y-1/2 items-center gap-1 opacity-30">
                                                                <svg class="h-6 w-9" viewBox="0 0 36 24" fill="currentColor"><rect width="36" height="24" rx="4"/><rect x="4" y="8" width="8" height="8" rx="1.5" fill="white" opacity="0.4"/></svg>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" @if($fs('checkout_card_name_label')) style="{{ $fs('checkout_card_name_label') }}" @endif>
                                                            <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                                            {{ $shopInfo->checkout_card_name_label ?? 'Kart Üzerindeki İsim' }}
                                                        </label>
                                                        <input type="text" name="card_name" id="cardName" placeholder="{{ $shopInfo->checkout_card_name_ph ?? 'AD SOYAD' }}" autocomplete="cc-name"
                                                               class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-4 text-base uppercase text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 placeholder:normal-case focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5" />
                                                    </div>

                                                    <div class="grid grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" @if($fs('checkout_card_expiry_label')) style="{{ $fs('checkout_card_expiry_label') }}" @endif>
                                                                <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                                                                {{ $shopInfo->checkout_card_expiry_label ?? 'Son Kullanma' }}
                                                            </label>
                                                            <input type="text" name="card_expiry" id="cardExpiry" maxlength="5" placeholder="{{ $shopInfo->checkout_card_expiry_ph ?? 'AA/YY' }}" autocomplete="cc-exp"
                                                                   class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-4 font-mono text-base tracking-widest text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5" />
                                                        </div>
                                                        <div>
                                                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" @if($fs('checkout_card_cvv_label')) style="{{ $fs('checkout_card_cvv_label') }}" @endif>
                                                                <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                                                                {{ $shopInfo->checkout_card_cvv_label ?? 'CVV' }}
                                                            </label>
                                                            <div class="relative">
                                                                <input type="password" name="card_cvv" id="cardCvv" maxlength="4" placeholder="{{ $shopInfo->checkout_card_cvv_ph ?? '•••' }}" autocomplete="cc-csc"
                                                                       class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] py-4 pl-5 pr-12 font-mono text-base tracking-widest text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5" />
                                                                <div class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 opacity-30">
                                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Security info -->
                                                <div class="mt-7 flex items-center gap-3 rounded-2xl border border-green-100 bg-gradient-to-r from-green-50/80 to-emerald-50/50 p-4">
                                                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-green-100">
                                                        <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                                                    </div>
                                                    <p class="text-xs leading-relaxed text-green-700" @if($fs('checkout_ssl_info')) style="{{ $fs('checkout_ssl_info') }}" @endif>{{ $shopInfo->checkout_ssl_info ?? 'Kart bilgileriniz 256-bit SSL şifreleme ile korunmaktadır. Bilgileriniz sunucularımızda saklanmaz.' }}</p>
                                                </div>
                                        </div>
                                    </div>

                                    <!-- Teslimat Bilgileri Card -->
                                    <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-lg shadow-black/[0.03]">
                                        <div class="border-b border-gray-100 bg-gradient-to-r from-gray-50/80 to-transparent px-6 py-5 sm:px-8">
                                            <div class="flex items-center gap-3.5">
                                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100">
                                                    <svg class="h-5 w-5 text-colorBlackPearl/60" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                                </div>
                                                <div>
                                                    <h4 class="font-title text-lg font-bold text-colorBlackPearl" @if($fs('checkout_delivery_title')) style="{{ $fs('checkout_delivery_title') }}" @endif>{{ $shopInfo->checkout_delivery_title ?? 'Teslimat Bilgileri' }}</h4>
                                                    <p class="text-xs text-colorCarbonGrey/70" @if($fs('checkout_delivery_subtitle')) style="{{ $fs('checkout_delivery_subtitle') }}" @endif>{{ $shopInfo->checkout_delivery_subtitle ?? 'Siparişinizin ulaşacağı adres' }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-6 sm:p-8">
                                            <div class="space-y-5">
                                                <!-- Name -->
                                                <div>
                                                    <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" for="customer_name" @if($fs('checkout_name_label')) style="{{ $fs('checkout_name_label') }}" @endif>
                                                        <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                                        {{ $shopInfo->checkout_name_label ?? 'Ad Soyad' }} <span class="text-red-400">*</span>
                                                    </label>
                                                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required placeholder="{{ $shopInfo->checkout_name_ph ?? 'Adınızı ve soyadınızı girin' }}"
                                                           class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-3.5 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5 @error('customer_name') border-red-200 bg-red-50/50 @enderror" />
                                                    @error('customer_name')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                                </div>

                                                <!-- Email + Phone -->
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                    <div>
                                                        <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" for="customer_email" @if($fs('checkout_email_label')) style="{{ $fs('checkout_email_label') }}" @endif>
                                                            <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                                                            {{ $shopInfo->checkout_email_label ?? 'E-posta' }} <span class="text-red-400">*</span>
                                                        </label>
                                                        <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required placeholder="{{ $shopInfo->checkout_email_ph ?? 'ornek@mail.com' }}"
                                                               class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-3.5 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5 @error('customer_email') border-red-200 bg-red-50/50 @enderror" />
                                                        @error('customer_email')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                                    </div>
                                                    <div>
                                                        <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" for="customer_phone" @if($fs('checkout_phone_label')) style="{{ $fs('checkout_phone_label') }}" @endif>
                                                            <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                                                            {{ $shopInfo->checkout_phone_label ?? 'Telefon' }}
                                                        </label>
                                                        <input type="tel" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="{{ $shopInfo->checkout_phone_ph ?? '05XX XXX XX XX' }}"
                                                               class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-3.5 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5 @error('customer_phone') border-red-200 bg-red-50/50 @enderror" />
                                                        @error('customer_phone')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                                    </div>
                                                </div>

                                                <!-- Address -->
                                                <div>
                                                    <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" for="shipping_address" @if($fs('checkout_address_label')) style="{{ $fs('checkout_address_label') }}" @endif>
                                                        <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                                                        {{ $shopInfo->checkout_address_label ?? 'Teslimat Adresi' }} <span class="text-red-400">*</span>
                                                    </label>
                                                    <textarea id="shipping_address" name="shipping_address" rows="3" required placeholder="{{ $shopInfo->checkout_address_ph ?? 'Mahalle, cadde, sokak, bina no, daire no' }}"
                                                              class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-3.5 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5 @error('shipping_address') border-red-200 bg-red-50/50 @enderror">{{ old('shipping_address') }}</textarea>
                                                    @error('shipping_address')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                                </div>

                                                <!-- City + District -->
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                    <div>
                                                        <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" for="shipping_city" @if($fs('checkout_city_label')) style="{{ $fs('checkout_city_label') }}" @endif>
                                                            <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/></svg>
                                                            {{ $shopInfo->checkout_city_label ?? 'Şehir' }} <span class="text-red-400">*</span>
                                                        </label>
                                                        <input type="text" id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}" required placeholder="{{ $shopInfo->checkout_city_ph ?? 'İstanbul' }}"
                                                               class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-3.5 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5 @error('shipping_city') border-red-200 bg-red-50/50 @enderror" />
                                                        @error('shipping_city')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                                    </div>
                                                    <div>
                                                        <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" for="shipping_district" @if($fs('checkout_district_label')) style="{{ $fs('checkout_district_label') }}" @endif>
                                                            <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z"/></svg>
                                                            {{ $shopInfo->checkout_district_label ?? 'İlçe' }}
                                                        </label>
                                                        <input type="text" id="shipping_district" name="shipping_district" value="{{ old('shipping_district') }}" placeholder="{{ $shopInfo->checkout_district_ph ?? 'Kadıköy' }}"
                                                               class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-3.5 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5 @error('shipping_district') border-red-200 bg-red-50/50 @enderror" />
                                                        @error('shipping_district')<p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>@enderror
                                                    </div>
                                                </div>

                                                <!-- Note -->
                                                <div>
                                                    <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-colorBlackPearl" for="customer_note" @if($fs('checkout_note_label')) style="{{ $fs('checkout_note_label') }}" @endif>
                                                        <svg class="h-4 w-4 text-colorCarbonGrey/50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/></svg>
                                                        {{ $shopInfo->checkout_note_label ?? 'Sipariş Notu' }}
                                                        <span class="text-xs font-normal text-colorCarbonGrey/50" @if($fs('checkout_optional_text')) style="{{ $fs('checkout_optional_text') }}" @endif>{{ $shopInfo->checkout_optional_text ?? '(isteğe bağlı)' }}</span>
                                                    </label>
                                                    <textarea id="customer_note" name="customer_note" rows="2" placeholder="{{ $shopInfo->checkout_note_ph ?? 'Siparişinizle ilgili notlar...' }}"
                                                              class="w-full rounded-2xl border-2 border-gray-100 bg-[#FAFAFA] px-5 py-3.5 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white focus:shadow-lg focus:shadow-colorPurpleBlue/5">{{ old('customer_note') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Right Column: Order Summary -->
                                <div class="lg:col-span-5 xl:col-span-4">
                                    <div class="sticky top-8 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xl shadow-black/[0.04]">
                                        <!-- Summary Header -->
                                        <div class="border-b border-gray-100 bg-gradient-to-r from-[#FAF9F6] to-white px-6 py-5">
                                            <div class="flex items-center justify-between">
                                                <h4 class="font-title text-lg font-bold text-colorBlackPearl" @if($fs('checkout_summary_header')) style="{{ $fs('checkout_summary_header') }}" @endif>{{ $shopInfo->checkout_summary_header ?? 'Sipariş Özeti' }}</h4>
                                                <span class="inline-flex items-center rounded-full bg-colorPurpleBlue/10 px-3 py-1 text-xs font-bold text-colorPurpleBlue">{{ collect($cart)->sum('quantity') }} ürün</span>
                                            </div>
                                        </div>

                                        <div class="p-6">
                                            <!-- Items -->
                                            <div class="space-y-3">
                                                @foreach($cart as $key => $item)
                                                <div class="flex items-center gap-3.5 rounded-2xl bg-[#FAF9F6] p-3">
                                                    <div class="relative h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl">
                                                        @if(!empty($item['image']))
                                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover" />
                                                        @else
                                                            <div class="flex h-full w-full items-center justify-center bg-gray-100">
                                                                <svg class="h-5 w-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12"/></svg>
                                                            </div>
                                                        @endif
                                                        <span class="absolute -right-0.5 -top-0.5 flex h-5 min-w-[20px] items-center justify-center rounded-full bg-colorPurpleBlue px-1.5 text-[10px] font-bold text-white shadow-sm">{{ $item['quantity'] }}</span>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <p class="truncate text-sm font-bold text-colorBlackPearl">{{ $item['name'] }}</p>
                                                        @if(!empty($item['variant_info']) && is_array($item['variant_info']))
                                                        <p class="mt-0.5 truncate text-xs text-colorCarbonGrey/60">
                                                            @foreach($item['variant_info'] as $attrName => $valName)
                                                                {{ $attrName }}: {{ $valName }}@if(!$loop->last), @endif
                                                            @endforeach
                                                        </p>
                                                        @endif
                                                    </div>
                                                    <span class="flex-shrink-0 text-sm font-bold text-colorBlackPearl">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} ₺</span>
                                                </div>
                                                @endforeach
                                            </div>

                                            <!-- Divider -->
                                            <div class="my-5 border-t border-dashed border-gray-200"></div>

                                            <!-- Totals -->
                                            <div class="space-y-3">
                                                <div class="flex items-center justify-between text-sm">
                                                    <span class="text-colorCarbonGrey">{{ $shopInfo->cart_subtotal ?? 'Ara Toplam' }}</span>
                                                    <span class="font-semibold text-colorBlackPearl">{{ number_format($subtotal, 2, ',', '.') }} ₺</span>
                                                </div>
                                                <div class="flex items-center justify-between text-sm">
                                                    <span class="text-colorCarbonGrey">{{ $shopInfo->cart_shipping ?? 'Kargo' }}</span>
                                                    <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-bold text-green-600">
                                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                                        {{ $shopInfo->cart_shipping_free ?? 'Ücretsiz' }}
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Coupon -->
                                            <div class="mt-3" id="checkoutCouponSection">
                                                @if($coupon)
                                                <div id="checkoutCouponApplied">
                                                    <div class="flex items-center justify-between rounded-xl bg-green-50 px-3.5 py-2.5">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/></svg>
                                                            <span id="checkoutCouponCodeLabel" class="text-sm font-bold text-green-700">{{ $coupon['code'] }}</span>
                                                        </div>
                                                        <button type="button" onclick="removeCheckoutCoupon()" class="text-xs font-semibold text-red-500 hover:text-red-700 transition-colors cursor-pointer">{{ $shopInfo->cart_coupon_remove ?? 'Kaldır' }}</button>
                                                    </div>
                                                    <div class="mt-2 flex items-center justify-between text-sm">
                                                        <span class="text-green-600 font-medium">{{ $shopInfo->cart_coupon_discount ?? 'İndirim' }}</span>
                                                        <span id="checkoutDiscountLabel" class="font-semibold text-green-600">-{{ number_format($discount, 2, ',', '.') }} ₺</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div id="checkoutCouponApplied" style="display:none">
                                                    <div class="flex items-center justify-between rounded-xl bg-green-50 px-3.5 py-2.5">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/></svg>
                                                            <span id="checkoutCouponCodeLabel" class="text-sm font-bold text-green-700"></span>
                                                        </div>
                                                        <button type="button" onclick="removeCheckoutCoupon()" class="text-xs font-semibold text-red-500 hover:text-red-700 transition-colors cursor-pointer">{{ $shopInfo->cart_coupon_remove ?? 'Kaldır' }}</button>
                                                    </div>
                                                    <div class="mt-2 flex items-center justify-between text-sm">
                                                        <span class="text-green-600 font-medium">{{ $shopInfo->cart_coupon_discount ?? 'İndirim' }}</span>
                                                        <span id="checkoutDiscountLabel" class="font-semibold text-green-600"></span>
                                                    </div>
                                                </div>
                                                @endif

                                                <div id="checkoutCouponInput" @if($coupon) style="display:none" @endif>
                                                    <div class="flex gap-2">
                                                        <input type="text" id="checkoutCouponCodeInput" placeholder="{{ $shopInfo->cart_coupon_placeholder ?? 'Kupon kodu girin' }}"
                                                               class="flex-1 rounded-xl border-2 border-gray-100 bg-[#FAFAFA] px-4 py-2.5 text-sm font-medium uppercase text-colorBlackPearl outline-none transition-all placeholder:normal-case placeholder:text-gray-300 focus:border-colorPurpleBlue/40 focus:bg-white" />
                                                        <button type="button" id="checkoutCouponApplyBtn" onclick="applyCheckoutCoupon()"
                                                                class="rounded-xl bg-colorBlackPearl px-4 py-2.5 text-xs font-bold text-white transition-all hover:bg-colorPurpleBlue disabled:opacity-50 cursor-pointer">
                                                            {{ $shopInfo->cart_coupon_apply ?? 'Uygula' }}
                                                        </button>
                                                    </div>
                                                    <p id="checkoutCouponError" class="mt-1.5 text-xs font-medium text-red-500" style="display:none"></p>
                                                </div>
                                            </div>

                                            <!-- Total -->
                                            <div class="mt-5 rounded-2xl bg-gradient-to-r from-colorPurpleBlue/5 to-indigo-50/50 p-4">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm font-bold text-colorBlackPearl">{{ $shopInfo->cart_total ?? 'Toplam' }}</span>
                                                    <span id="checkoutTotal" class="font-title text-2xl font-black text-colorPurpleBlue">{{ number_format($total, 2, ',', '.') }} ₺</span>
                                                </div>
                                            </div>

                                            <!-- Submit -->
                                            <button type="submit" id="submitBtn" @if($fs('checkout_submit_button')) style="{{ $fs('checkout_submit_button') }}" @endif
                                                    class="group mt-6 flex w-full items-center justify-center gap-2.5 rounded-2xl bg-gradient-to-r from-colorPurpleBlue to-colorPurpleBlue/90 px-6 py-4.5 text-base font-bold text-white shadow-xl shadow-colorPurpleBlue/25 transition-all hover:shadow-2xl hover:shadow-colorPurpleBlue/30 active:scale-[0.98]">
                                                <svg class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                                                {{ $shopInfo->checkout_submit_button ?? 'Siparişi Tamamla' }}
                                            </button>

                                            <!-- Trust badges -->
                                            <div class="mt-5 grid grid-cols-3 gap-2">
                                                <div class="flex flex-col items-center gap-1.5 rounded-xl bg-[#FAF9F6] p-3 text-center">
                                                    <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                                                    <span class="text-[10px] font-semibold leading-tight text-colorCarbonGrey">{{ $shopInfo->cart_trust_1 ?? 'SSL Güvenlik' }}</span>
                                                </div>
                                                <div class="flex flex-col items-center gap-1.5 rounded-xl bg-[#FAF9F6] p-3 text-center">
                                                    <svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                                                    <span class="text-[10px] font-semibold leading-tight text-colorCarbonGrey">{{ $shopInfo->cart_trust_2 ?? 'Hızlı Kargo' }}</span>
                                                </div>
                                                <div class="flex flex-col items-center gap-1.5 rounded-xl bg-[#FAF9F6] p-3 text-center">
                                                    <svg class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182"/></svg>
                                                    <span class="text-[10px] font-semibold leading-tight text-colorCarbonGrey">{{ $shopInfo->cart_trust_3 ?? 'Kolay İade' }}</span>
                                                </div>
                                            </div>

                                            <!-- Back to cart -->
                                            <a href="{{ route('front.cart') }}" class="mt-5 flex items-center justify-center gap-2 text-sm font-semibold text-colorCarbonGrey/60 transition-colors hover:text-colorPurpleBlue">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                                                {{ $shopInfo->checkout_breadcrumb_cart ?? 'Sepete Dön' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </section>
            <!--...::: Checkout Section End :::... -->
@endsection

@push('scripts')
<script>
// Card number formatting + brand detection
var cardNumberInput = document.getElementById('cardNumber');
if (cardNumberInput) {
    cardNumberInput.addEventListener('input', function() {
        var val = this.value.replace(/\D/g, '').substring(0, 16);
        var formatted = val.replace(/(.{4})/g, '$1 ').trim();
        this.value = formatted;
        var preview = document.getElementById('cardPreviewNumber');
        if (preview) {
            var display = formatted || '•••• •••• •••• ••••';
            while (display.replace(/\s/g, '').length < 16) display += '•';
            display = display.replace(/\s/g, '').replace(/(.{4})/g, '$1 ').trim();
            preview.innerHTML = '<span class="opacity-90">' + display + '</span>';
        }
        var brand = document.getElementById('cardBrand');
        if (brand) {
            if (val.startsWith('4')) brand.textContent = 'VISA';
            else if (val.startsWith('5') || (val.startsWith('2') && parseInt(val.substring(0,4)) >= 2221 && parseInt(val.substring(0,4)) <= 2720)) brand.textContent = 'MASTERCARD';
            else if (val.startsWith('9')) brand.textContent = 'TROY';
            else if (val.startsWith('3')) brand.textContent = 'AMEX';
            else brand.textContent = 'VISA';
        }
    });
}

// Card name
var cardNameInput = document.getElementById('cardName');
if (cardNameInput) {
    cardNameInput.addEventListener('input', function() {
        var preview = document.getElementById('cardPreviewName');
        if (preview) preview.textContent = this.value.toUpperCase() || '{{ $shopInfo->checkout_card_preview_name ?? "AD SOYAD" }}';
    });
}

// Card expiry formatting
var cardExpiryInput = document.getElementById('cardExpiry');
if (cardExpiryInput) {
    cardExpiryInput.addEventListener('input', function() {
        var val = this.value.replace(/\D/g, '').substring(0, 4);
        if (val.length > 2) val = val.substring(0, 2) + '/' + val.substring(2);
        this.value = val;
        var preview = document.getElementById('cardPreviewExpiry');
        if (preview) preview.textContent = val || '••/••';
    });
}

// Prevent double submit
var checkoutForm = document.getElementById('checkoutForm');
if (checkoutForm) {
    checkoutForm.addEventListener('submit', function() {
        var btn = document.getElementById('submitBtn');
        if (btn) {
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
            btn.innerHTML = '<svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> İşleniyor...';
        }
    });
}

// Coupon
var chkCouponInput = document.getElementById('checkoutCouponCodeInput');
if (chkCouponInput) {
    chkCouponInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); applyCheckoutCoupon(); }
    });
}

function applyCheckoutCoupon() {
    var code = document.getElementById('checkoutCouponCodeInput').value.trim();
    if (!code) return;
    var btn = document.getElementById('checkoutCouponApplyBtn');
    var errEl = document.getElementById('checkoutCouponError');
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
            document.getElementById('checkoutCouponCodeLabel').textContent = data.code;
            document.getElementById('checkoutDiscountLabel').textContent = '-' + data.discount_formatted + ' ₺';
            document.getElementById('checkoutCouponApplied').style.display = '';
            document.getElementById('checkoutCouponInput').style.display = 'none';
            document.getElementById('checkoutTotal').textContent = data.total_formatted + ' ₺';
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

function removeCheckoutCoupon() {
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
            document.getElementById('checkoutCouponApplied').style.display = 'none';
            document.getElementById('checkoutCouponInput').style.display = '';
            document.getElementById('checkoutCouponCodeInput').value = '';
            document.getElementById('checkoutTotal').textContent = data.total_formatted + ' ₺';
        }
    });
}
</script>
@endpush
