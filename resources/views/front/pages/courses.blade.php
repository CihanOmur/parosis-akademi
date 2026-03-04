@extends('front.layouts.app')

@section('title', 'Parosis Akademi | ' . ($coursePageInfo?->getTranslation('title', app()->getLocale()) ?: 'Kurslarımız'))

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
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden bg-[#FAF9F6]">
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
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Course Top -->
                            <div class="mb-8 flex flex-wrap items-center justify-center gap-x-10 gap-y-5 md:mb-10 md:justify-between">
                                <!-- Left Block -->
                                <div class="order-2 md:order-1" @if($fs('result_text')) style="{{ $fs('result_text') }}" @endif>
                                    {{ $courses->total() }} {{ $coursePageInfo?->getTranslation('result_text', app()->getLocale()) ?: 'kurs bulundu' }}
                                </div>
                                <!-- Left Block -->
                                <!-- Right Block -->
                                <div class="order-1 w-full md:order-2 md:w-[436px]">
                                    <!-- Search Form -->
                                    <form action="{{ route('front.courses') }}" method="get" class="w-full">
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
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            @if($course->image)
                                                <img src="{{ asset($course->image) }}" alt="{{ $course->getTranslation('title', app()->getLocale()) }}" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />
                                            @else
                                                <div class="h-[270px] w-full bg-gray-200 flex items-center justify-center">
                                                    <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                    </svg>
                                                </div>
                                            @endif

                                            @if($course->categories->count())
                                                <span class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl">{{ $course->categories->first()->name }}</span>
                                            @endif
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                @if($course->lesson_count)
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">{{ $course->lesson_count }} Ders</span>
                                                </span>
                                                @endif
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details', $course->id) }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">{{ $course->getTranslation('title', app()->getLocale()) }}</a>
                                            <!-- Title Link -->

                                            @if($course->getTranslation('short_description', app()->getLocale()))
                                            <p class="line-clamp-2">
                                                {{ $course->getTranslation('short_description', app()->getLocale()) }}
                                            </p>
                                            @endif

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    @if($course->instructor_image)
                                                    <div class="h-7 w-7 overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset($course->instructor_image) }}" alt="{{ $course->instructor_name }}" width="28" height="28" class="h-full w-full object-cover" />
                                                    </div>
                                                    @endif
                                                    @if($course->instructor_name)
                                                    <span class="text-sm">{{ $course->instructor_name }}</span>
                                                    @endif
                                                    @if($course->student_count)
                                                    <div class="inline-flex items-center gap-1.5 text-sm">
                                                        <img src="{{ asset('assets-front/img/icons/icon-grey-graduation-cap-line.svg') }}" alt="icon-grey-graduation-cap-line" width="17" height="17" />
                                                        <span class="flex-1">{{ $course->student_count }} Öğrenci</span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <!-- Instructor Block -->
                                                @if($course->price)
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">{{ $course->price }}</span>
                                                @endif
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
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
