@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Blog')

@php
    $fieldStyles = $blogPageInfo?->field_styles ?? [];
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
                                    {!! nl2br(e($blogPageInfo?->getTranslation('title', app()->getLocale()) ?: 'Blog')) !!}
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}" @if($fs('breadcrumb_home')) style="{{ $fs('breadcrumb_home') }}" @endif>{{ $blogPageInfo?->getTranslation('breadcrumb_home', app()->getLocale()) ?: 'ANA SAYFA' }}</a>
                                        </li>
                                        <li @if($fs('breadcrumb_current')) style="{{ $fs('breadcrumb_current') }}" @endif>{{ $blogPageInfo?->getTranslation('breadcrumb_current', app()->getLocale()) ?: 'BLOG' }}</li>
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

            <!--...::: Blog Section Start :::... -->
            <div class="section-blog">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            @if($blogs->count() > 0)
                            <!-- Blog List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                @foreach($blogs as $blog)
                                <!-- Blog Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-[10px]">
                                            @if($blog->image)
                                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}" width="370" height="334" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />
                                            @else
                                                <div class="h-[250px] w-full bg-gray-100 flex items-center justify-center transition-all duration-300 group-hover:scale-105">
                                                    <svg class="w-16 h-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                    </svg>
                                                </div>
                                            @endif

                                            @if($blog->categories->count())
                                            <span class="absolute bottom-4 left-4 inline-block rounded-[40px] bg-colorPurpleBlue px-3.5 py-3 text-sm leading-none text-white">{{ $blog->categories->first()->name }}</span>
                                            @endif
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7">
                                            <!-- Blog Meta -->
                                            <div class="flex gap-9">
                                                @if($blog->published_at)
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-calendar.svg') }}" alt="icon-grey-calendar" width="23" height="23" />
                                                    <span class="flex-1">{{ $blog->published_at->translatedFormat('d F Y') }}</span>
                                                </span>
                                                @endif
                                            </div>
                                            <!-- Blog Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.blog.details', $blog->id) }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">{{ $blog->getTranslation('title', app()->getLocale()) }}</a>
                                            <!-- Title Link -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Blog Item -->
                                @endforeach
                            </ul>
                            <!-- Blog List -->
                            @else
                            <p class="text-center text-gray-500 py-16">Henüz blog yazısı eklenmemiş.</p>
                            @endif
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </div>
            <!--...::: Blog Section End :::... -->
@endsection
