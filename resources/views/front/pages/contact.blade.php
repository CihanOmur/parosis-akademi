@extends('front.layouts.app')

@section('title', 'Parosis Akademi | İletişim')

@php
    $fieldStyles = $contactInfo?->field_styles ?? [];
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
                    <!-- Section Space -->
                    <div class="py-[60px] lg:py-[90px]">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="text-center">
                                <h1 class="mb-5 text-4xl capitalize tracking-normal" @if($fs('title')) style="{{ $fs('title') }}" @endif>
                                    {!! nl2br(e($contactInfo?->getTranslation('title', app()->getLocale()) ?: 'Bizimle Iletisim Kurun')) !!}
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}" @if($fs('breadcrumb_home')) style="{{ $fs('breadcrumb_home') }}" @endif>{{ $contactInfo?->getTranslation('breadcrumb_home', app()->getLocale()) ?: 'ANA SAYFA' }}</a>
                                        </li>
                                        <li @if($fs('breadcrumb_current')) style="{{ $fs('breadcrumb_current') }}" @endif>{{ $contactInfo?->getTranslation('breadcrumb_current', app()->getLocale()) ?: 'ILETISIM' }}</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Background Element -->
                    <div class="absolute -left-48 top-0 -z-10 h-[327px] w-[371px] bg-[#BFC06F] blur-[250px]"></div>
                    <div class="absolute -right-36 bottom-20 -z-10 h-[327px] w-[371px] bg-[#AAC3E9] blur-[200px]"></div>
                    <img src="{{ asset('assets-front/img/abstracts/abstract-purple-dash-1.svg') }}" alt="abstract-purple-dash-1" class="absolute left-56 top-1/2 -z-10 hidden -translate-y-1/2 sm:inline-block" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" class="absolute -bottom-14 right-[100px] -z-10 hidden sm:inline-block" />
                    <!-- Background Element -->
                </div>
            </section>
            <!--...::: Breadcrumb Section Start :::... -->

            <!--...::: Contact Info Section Start :::... -->
            <div class="section-contact-info">
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Contact Info List -->
                            @php
                                $phones = $contactInfo?->phones ?? [];
                                $emailsList = $contactInfo?->emails ?? [];
                                $addressesList = $contactInfo?->addresses ?? [];
                            @endphp
                            <ul class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                                <!-- Contact Info Item - Phone -->
                                @if(count($phones) > 0)
                                <li class="jos rounded-lg bg-[#F5F5F5] px-9 py-11">
                                    <div class="mb-6 inline-flex h-[100px] w-[100px] items-center justify-center rounded-lg bg-colorPurpleBlue">
                                        <img src="{{ asset('assets-front/img/icons/icon-white-phone-2.svg') }}" alt="icon-white-phone-2" width="43" height="43" />
                                    </div>
                                    <div class="flex flex-col gap-y-5">
                                        @foreach($phones as $phone)
                                            <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="block font-title text-2xl font-bold leading-none text-colorBlackPearl hover:underline">{{ $phone }}</a>
                                        @endforeach
                                    </div>
                                </li>
                                @endif
                                <!-- Contact Info Item - Email -->
                                @if(count($emailsList) > 0)
                                <li class="jos rounded-lg bg-[#F5F5F5] px-9 py-11">
                                    <div class="mb-6 inline-flex h-[100px] w-[100px] items-center justify-center rounded-lg bg-colorPurpleBlue">
                                        <img src="{{ asset('assets-front/img/icons/icon-white-chat-2.svg') }}" alt="icon-white-chat-2" width="43" height="43" />
                                    </div>
                                    <div class="flex flex-col gap-y-5">
                                        @foreach($emailsList as $email)
                                            <a href="mailto:{{ $email }}" class="block font-title text-2xl font-bold leading-none text-colorBlackPearl hover:underline">{{ $email }}</a>
                                        @endforeach
                                    </div>
                                </li>
                                @endif
                                <!-- Contact Info Item - Address -->
                                @if(count($addressesList) > 0)
                                <li class="jos rounded-lg bg-[#F5F5F5] px-9 py-11">
                                    <div class="mb-6 inline-flex h-[100px] w-[100px] items-center justify-center rounded-lg bg-colorPurpleBlue">
                                        <img src="{{ asset('assets-front/img/icons/icon-white-location-pin.svg') }}" alt="icon-white-location-pin" width="43" height="43" />
                                    </div>
                                    <div class="flex flex-col gap-y-5">
                                        <address class="flex flex-col gap-y-5 font-title text-2xl font-bold not-italic leading-tight text-colorBlackPearl">
                                            @foreach($addressesList as $address)
                                                <span style="white-space: pre-line;">{!! e($address) !!}</span>
                                            @endforeach
                                        </address>
                                    </div>
                                </li>
                                @endif
                            </ul>
                            <!-- Contact Info List -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </div>
            <!--...::: Contact Info Section End :::... -->

            <!--...::: Contact Form Section Start :::... -->
            <section class="section-contact">
                <!-- Section Background -->
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space-bottom">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Contact Form Area -->
                            <div class="grid grid-cols-1 items-center gap-10 md:gap-[60px] lg:grid-cols-2 xl:grid-cols-[1fr_minmax(0,0.7fr)] xl:gap-[90px]">
                                <!-- Contact Form Right Block -->
                                <div class="jos" data-jos_animation="fade-left">
                                    @php $formImg = $contactInfo?->contact_form_image; @endphp
                                    <img src="{{ $formImg ? asset($formImg) : asset('assets-front/img/images/th-1/contact-form-img.jpg') }}" alt="contact-form-img" width="619" height="620" class="mx-auto max-w-full rounded-lg" />
                                </div>
                                <!-- Contact Form Right Block -->
                                <!-- Contact Form Left Block -->
                                <div class="jos" data-jos_animation="fade-right">
                                    <!-- Section Block -->
                                    <div class="mb-10 lg:mb-[60px]">
                                        <div class="jos mx-auto max-w-2xl">
                                            <span class="mb-5 block uppercase" @if($fs('subtitle')) style="{{ $fs('subtitle') }}" @endif>{{ $contactInfo?->getTranslation('subtitle', app()->getLocale()) ?: 'ILETISIM' }}</span>
                                            <h2 @if($fs('form_title')) style="{{ $fs('form_title') }}" @endif>{!! nl2br(e($contactInfo?->getTranslation('form_title', app()->getLocale()) ?: 'Sorulariniz mi var? Bizimle iletisime gecin')) !!}</h2>
                                        </div>
                                    </div>
                                    <!-- Section Block -->

                                    @if(session('success'))
                                    <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 text-sm">{{ session('success') }}</div>
                                    @endif
                                    @if($errors->any())
                                    <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 text-sm">
                                        @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
                                    </div>
                                    @endif
                                    <form action="{{ route('front.contact.send') }}" method="post">
                                        @csrf
                                        <div class="grid grid-cols-1 gap-y-10">
                                            <!-- Form Group -->
                                            <div class="grid grid-cols-1 gap-9">
                                                <!-- Single Input Item -->
                                                <div class="w-full">
                                                    <input type="text" placeholder="{{ $contactInfo?->getTranslation('form_name_placeholder', app()->getLocale()) ?: 'Ad Soyad' }}" name="contact-name" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                </div>
                                                <!-- Single Input Item -->
                                            </div>
                                            <!-- Form Group -->
                                            <!-- Form Group -->
                                            <div class="grid grid-cols-1 gap-9">
                                                <!-- Single Input Item -->
                                                <div class="w-full">
                                                    <input type="email" placeholder="{{ $contactInfo?->getTranslation('form_email_placeholder', app()->getLocale()) ?: 'E-posta adresiniz' }}" name="contact-email" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                </div>
                                                <!-- Single Input Item -->
                                            </div>
                                            <!-- Form Group -->
                                            <!-- Form Group -->
                                            <div class="mt-10 grid grid-cols-1 gap-9">
                                                <!-- Single Input Item -->
                                                <div class="w-full">
                                                    <textarea name="message" placeholder="{{ $contactInfo?->getTranslation('form_message_placeholder', app()->getLocale()) ?: 'Size nasil yardimci olabiliriz?' }}" class="w-full border-b border-colorBlackPearl/25 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required></textarea>
                                                </div>
                                                <!-- Single Input Item -->
                                            </div>
                                            <!-- Form Group -->
                                        </div>
                                        <!-- Form Group -->
                                        <div class="mb-8 grid grid-cols-1 gap-9">
                                            <!-- Single Input Item -->
                                            <div class="w-full">
                                                <label for="check-box" class="mt-3.5 flex items-center gap-x-3 text-sm text-[#8D8D8D]">
                                                    <span class="relative">
                                                        <input type="checkbox" name="check-box" id="check-box" class="peer opacity-0" />
                                                        <span class="absolute left-0 top-1/2 inline-block h-4 w-4 -translate-y-1/2 rounded-[50%] border border-colorBlackPearl/75 peer-checked:bg-colorBlackPearl/75"></span>
                                                    </span>
                                                    {{ $contactInfo?->getTranslation('form_privacy_text', app()->getLocale()) ?: 'Gizlilik Politikasini kabul ediyorum.' }}
                                                </label>
                                            </div>
                                            <!-- Single Input Item -->
                                        </div>
                                        <!-- Form Group -->
                                        <button type="submit" class="btn btn-primary is-icon group mt-[10px]">
                                            {{ $contactInfo?->getTranslation('form_button_text', app()->getLocale()) ?: 'Mesajinizi Gonderin' }}
                                            <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                                            </span>
                                            <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                                            </span>
                                        </button>
                                    </form>
                                </div>
                                <!-- Contact Form Left Block -->
                            </div>
                            <!-- Contact Form Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Contact Form Section End :::... -->
@endsection
