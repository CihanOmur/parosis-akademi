@extends('front.layouts.app')

@section('title', 'Parosis Akademi | ' . $teacher->getTranslation('name', app()->getLocale()))

@php
    $fieldStyles = $teacherPageInfo?->field_styles ?? [];
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
                                <h1 class="mb-5 text-4xl capitalize tracking-normal" @if($fs('detail_breadcrumb_current')) style="{{ $fs('detail_breadcrumb_current') }}" @endif>
                                    {!! nl2br(e($teacherPageInfo?->getTranslation('detail_breadcrumb_current', app()->getLocale()) ?: 'Eğitmen Detayı')) !!}
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}" @if($fs('breadcrumb_home')) style="{{ $fs('breadcrumb_home') }}" @endif>{{ $teacherPageInfo?->getTranslation('breadcrumb_home', app()->getLocale()) ?: 'ANA SAYFA' }}</a>
                                        </li>
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.teachers') }}" @if($fs('breadcrumb_current')) style="{{ $fs('breadcrumb_current') }}" @endif>{{ $teacherPageInfo?->getTranslation('breadcrumb_current', app()->getLocale()) ?: 'EĞİTMENLER' }}</a>
                                        </li>
                                        <li>{{ $teacher->getTranslation('name', app()->getLocale()) }}</li>
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
            <!--...::: Breadcrumb Section End :::... -->

            <!--...::: Teacher Details Section Start :::... -->
            <section class="section-teacher-details">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Teacher Details Area -->
                            <div class="grid grid-cols-1 items-center gap-x-[60px] gap-y-10 lg:grid-cols-[minmax(0,0.85fr)_1fr] xl:gap-x-[100px]">
                                <!-- Teacher Details Image -->
                                <div class="relative">
                                    @if($teacher->image)
                                        <img src="{{ asset($teacher->image) }}" alt="{{ $teacher->getTranslation('name', app()->getLocale()) }}" width="487" height="450" class="jos h-auto w-full rounded-lg" />
                                    @else
                                        <div class="jos h-[450px] w-full rounded-lg bg-gray-100 flex items-center justify-center">
                                            <svg class="w-24 h-24 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <!-- Teacher Details Image -->
                                <!-- Teacher Details Content -->
                                <div class="jos" data-jos_animation="fade-left">
                                    <span class="mb-5 block uppercase">{{ $teacher->getTranslation('title', app()->getLocale()) }}</span>
                                    <h2 class="mb-5">{{ $teacher->getTranslation('name', app()->getLocale()) }}</h2>
                                    @if($teacher->getTranslation('short_description', app()->getLocale()))
                                    <p>
                                        {{ $teacher->getTranslation('short_description', app()->getLocale()) }}
                                    </p>
                                    @endif

                                    @if($teacher->phone || $teacher->email)
                                    <!-- Separator -->
                                    <div class="my-5 h-px w-full bg-colorBlackPearl/25"></div>
                                    <!-- Separator -->

                                    <!-- Teacher Info List -->
                                    <ul class="flex flex-wrap gap-x-11 gap-y-3">
                                        @if($teacher->phone)
                                        <li class="inline-flex gap-x-6">
                                            <div class="h-7 w-auto">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-phone-ring.svg') }}" alt="phone" width="28" height="28" />
                                            </div>
                                            <div class="flex-1">
                                                <span class="block">24/7 Support</span>
                                                <a href="tel:{{ preg_replace('/\s+/', '', $teacher->phone) }}" class="font-title text-lg font-bold text-colorBlackPearl hover:underline md:text-xl">{{ $teacher->phone }}</a>
                                            </div>
                                        </li>
                                        @endif
                                        @if($teacher->email)
                                        <li class="inline-flex gap-x-6">
                                            <div class="h-7 w-auto">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-mail-open.svg') }}" alt="email" width="28" height="28" />
                                            </div>
                                            <div class="flex-1">
                                                <span class="block">Send Message</span>
                                                <a href="mailto:{{ $teacher->email }}" class="font-title text-lg font-bold text-colorBlackPearl hover:underline md:text-xl">{{ $teacher->email }}</a>
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                    <!-- Teacher Info List -->
                                    @endif

                                    @if($teacher->facebook_url || $teacher->twitter_url || $teacher->dribbble_url || $teacher->instagram_url)
                                    <!-- Social Links -->
                                    <div class="mt-8 flex items-center gap-x-6 lg:mt-10">
                                        @if($teacher->facebook_url)
                                        <a href="{{ $teacher->facebook_url }}" target="_blank" rel="noopener noreferrer" aria-label="facebook">
                                            <img src="{{ asset('assets-front/img/icons/icon-dark-facebook.svg') }}" alt="facebook" width="24" height="24" />
                                        </a>
                                        @endif
                                        @if($teacher->twitter_url)
                                        <a href="{{ $teacher->twitter_url }}" target="_blank" rel="noopener noreferrer" aria-label="twitter">
                                            <img src="{{ asset('assets-front/img/icons/icon-dark-twitter.svg') }}" alt="twitter" width="24" height="24" />
                                        </a>
                                        @endif
                                        @if($teacher->dribbble_url)
                                        <a href="{{ $teacher->dribbble_url }}" target="_blank" rel="noopener noreferrer" aria-label="dribbble">
                                            <img src="{{ asset('assets-front/img/icons/icon-dark-dribbble.svg') }}" alt="dribbble" width="24" height="24" />
                                        </a>
                                        @endif
                                        @if($teacher->instagram_url)
                                        <a href="{{ $teacher->instagram_url }}" target="_blank" rel="noopener noreferrer" aria-label="instagram">
                                            <img src="{{ asset('assets-front/img/icons/icon-dark-instagram.svg') }}" alt="instagram" width="24" height="24" />
                                        </a>
                                        @endif
                                    </div>
                                    <!-- Social Links -->
                                    @endif
                                </div>
                                <!-- Teacher Details Content -->
                            </div>
                            <!-- Teacher Details Area -->

                            @if($teacher->getTranslation('bio', app()->getLocale()))
                            <!-- Teacher About Block -->
                            <div class="jos mt-10">
                                <h5 class="mb-2.5">{{ __('Hakkımda') }}</h5>
                                <div class="rich-text-area">
                                    {!! $teacher->getTranslation('bio', app()->getLocale()) !!}
                                </div>
                            </div>
                            <!-- Teacher About Block -->
                            @endif
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Teacher Details Section End :::... -->
@endsection
