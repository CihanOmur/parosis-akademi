@extends('front.layouts.app')

@section('title', ($globalSettings['seo']['meta_title'] ?? 'Parosis Akademi') . ' | ' . ($coursePageInfo?->getTranslation('title', app()->getLocale()) ?: 'Kurslarımız'))

@php
    $fieldStyles = $coursePageInfo?->field_styles ?? [];
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
            @php
                $bcColor = $coursePageInfo?->breadcrumb_bg_color ?: '#FAF9F6';
                $bcImage = $coursePageInfo?->breadcrumb_bg_image ?? null;
                $bcStyle = 'background-color: ' . e($bcColor) . ';';
                if ($bcImage) $bcStyle .= ' background-image: url(' . e(asset($bcImage)) . '); background-size: cover; background-position: center; background-repeat: no-repeat;';
            @endphp
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden" style="{{ $bcStyle }}">
                    <!-- Section Space -->
                    <div class="py-[60px] lg:py-[90px]">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="text-center">
                                <h1 class="mb-5 text-4xl capitalize tracking-normal"
                                    @if($fs('title')) style="{{ $fs('title') }}" @endif
                                >{!! nl2br(e($coursePageInfo?->getTranslation('title', app()->getLocale()) ?: 'Kurslarımız')) !!}</h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}" @if($fs('breadcrumb_home')) style="{{ $fs('breadcrumb_home') }}" @endif>{{ $coursePageInfo?->getTranslation('breadcrumb_home', app()->getLocale()) ?: 'ANA SAYFA' }}</a>
                                        </li>
                                        <li @if($fs('breadcrumb_current')) style="{{ $fs('breadcrumb_current') }}" @endif>{{ $coursePageInfo?->getTranslation('breadcrumb_current', app()->getLocale()) ?: 'KURSLAR' }}</li>
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

            <!--...::: Course Section Start :::... -->
            <div class="section-course">
                <div class="bg-white pb-8">
                    <!-- Section Space -->
                    <div class="section-space-top pb-8">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Course Top -->
                            <div class="mb-8 flex flex-wrap items-center justify-center gap-x-10 gap-y-5 md:mb-10 md:justify-between">
                                <!-- Left Block -->
                                <div class="order-2 md:order-1 flex flex-wrap items-center gap-3" @if($fs('result_text')) style="{{ $fs('result_text') }}" @endif>
                                    <span>{{ $courses->total() }} {{ $coursePageInfo?->getTranslation('result_text', app()->getLocale()) ?: 'kurs bulundu' }}</span>
                                    @if(!empty($activeCategory))
                                    <span class="inline-flex items-center gap-2 rounded-full bg-colorBrightGold/25 px-3 py-1 text-sm text-colorBlackPearl">
                                        <span class="font-medium">{{ $activeCategory->name }}</span>
                                        <a href="{{ route('front.courses', array_filter(['q' => $search ?: null])) }}" class="text-colorBlackPearl/60 hover:text-colorBlackPearl" title="Filtreyi temizle" aria-label="Filtreyi temizle">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </a>
                                    </span>
                                    @endif
                                </div>
                                <!-- Left Block -->
                                <!-- Right Block -->
                                <div class="order-1 w-full md:order-2 md:w-[436px]">
                                    <!-- Search Form -->
                                    <form action="{{ route('front.courses') }}" method="get" class="w-full">
                                        @if(!empty($activeCategory))
                                        <input type="hidden" name="category" value="{{ $activeCategory->id }}" />
                                        @endif
                                        <div class="relative flex items-center">
                                            <input type="search" name="q" value="{{ $search ?? '' }}" placeholder="{{ $coursePageInfo?->getTranslation('search_placeholder', app()->getLocale()) ?: 'Kursunuzu arayın' }}" class="w-full rounded-[50px] border px-8 py-3.5 pr-36 text-sm font-medium outline-none placeholder:text-colorBlackPearl/55" />
                                            <button type="submit" class="absolute bottom-[5px] right-0 top-[5px] mr-[5px] inline-flex items-center justify-center gap-x-2.5 rounded-[50px] bg-colorPurpleBlue px-6 text-center text-sm text-white hover:bg-colorBlackPearl">
                                                {{ $coursePageInfo?->getTranslation('search_button_text', app()->getLocale()) ?: 'Ara' }}
                                                <img src="{{ asset('assets-front/img/icons/icon-white-search-line.svg') }}" alt="icon-white-search-line" width="16" height="16" />
                                            </button>
                                        </div>
                                    </form>
                                    <!-- Search Form -->
                                </div>
                                <!-- Right Block -->
                            </div>
                            <!-- Course Top -->

                            <!-- Course List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                @forelse($courses as $course)
                                <li class="jos" data-jos_animation="flip-left">
                                    @include('front.partials.course-card', ['course' => $course])
                                </li>
                                @empty
                                <li class="col-span-3 text-center py-16 text-slate-500">
                                    Henüz kurs eklenmemiş.
                                </li>
                                @endforelse
                            </ul>
                            <!-- Course List -->

                            <!-- Pagination -->
                            @if($courses->hasPages())
                            <div class="mt-[72px]">
                                {{ $courses->links() }}
                            </div>
                            @endif
                            <!-- Pagination -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </div>
            <!--...::: Course Section End :::... -->
@endsection
