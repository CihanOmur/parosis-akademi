@extends('front.layouts.app')

@section('title', 'Parosis Akademi | ' . $blog->getTranslation('title', app()->getLocale()))

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
                                <h1 class="mb-5 text-4xl capitalize tracking-normal" @if($fs('detail_breadcrumb_current')) style="{{ $fs('detail_breadcrumb_current') }}" @endif>
                                    {!! nl2br(e($blogPageInfo?->getTranslation('detail_breadcrumb_current', app()->getLocale()) ?: 'Blog Detayı')) !!}
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}" @if($fs('breadcrumb_home')) style="{{ $fs('breadcrumb_home') }}" @endif>{{ $blogPageInfo?->getTranslation('breadcrumb_home', app()->getLocale()) ?: 'ANA SAYFA' }}</a>
                                        </li>
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.blog') }}" @if($fs('breadcrumb_current')) style="{{ $fs('breadcrumb_current') }}" @endif>{{ $blogPageInfo?->getTranslation('breadcrumb_current', app()->getLocale()) ?: 'BLOG' }}</a>
                                        </li>
                                        <li>{{ Str::limit($blog->getTranslation('title', app()->getLocale()), 40) }}</li>
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

            <!--...::: Blog Details Section Start :::... -->
            <section class="section-course">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Blog Details Area -->
                            <div class="grid grid-cols-1 gap-x-[30px] gap-y-10 lg:grid-cols-[1fr_minmax(0,360px)]">
                                <!-- Blog Details Content -->
                                <div class="jos">
                                    <div>
                                        @if($blog->image)
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}" width="783" height="439" class="max-w-full rounded-lg" />
                                        @endif
                                        <div class="rich-text-area mt-11">
                                            <h2>{{ $blog->getTranslation('title', app()->getLocale()) }}</h2>

                                            @if($blog->published_at || $blog->categories->count())
                                            <div class="flex gap-6 mb-6 text-sm text-slate-500">
                                                @if($blog->published_at)
                                                <span class="inline-flex items-center gap-1.5">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-calendar.svg') }}" alt="calendar" width="18" height="18" />
                                                    {{ $blog->published_at->translatedFormat('d F Y') }}
                                                </span>
                                                @endif
                                                @if($blog->categories->count())
                                                <span class="inline-flex items-center gap-1.5">
                                                    {{ $blog->categories->pluck('name')->join(', ') }}
                                                </span>
                                                @endif
                                            </div>
                                            @endif

                                            {!! $blog->getTranslation('content', app()->getLocale()) !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- Blog Details Content -->

                                <!-- Aside Bar -->
                                <aside class="jos">
                                    <ul class="grid grid-cols-1 gap-y-9">
                                        <!-- Search -->
                                        <li class="rounded-lg bg-[#f5f5f5] px-[30px] py-6">
                                            <h5 class="mb-7" @if($fs('sidebar_search_title')) style="{{ $fs('sidebar_search_title') }}" @endif>{{ $blogPageInfo?->getTranslation('sidebar_search_title', app()->getLocale()) ?: 'Ara' }}</h5>
                                            <form action="#" method="get">
                                                <input type="search" class="w-full rounded border border-[#D7D7D7] px-5 py-3.5 text-sm leading-none text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" placeholder="{{ $blogPageInfo?->getTranslation('sidebar_search_placeholder', app()->getLocale()) ?: 'Ara...' }}" />
                                            </form>
                                        </li>

                                        <!-- Categories -->
                                        @if($categories->count() > 0)
                                        <li class="rounded-lg bg-[#f5f5f5] px-[30px] py-6">
                                            <h5 class="mb-7" @if($fs('sidebar_categories_title')) style="{{ $fs('sidebar_categories_title') }}" @endif>{{ $blogPageInfo?->getTranslation('sidebar_categories_title', app()->getLocale()) ?: 'Kategoriler' }}</h5>
                                            <ul class="divide-y divide-[#E9E5DA]">
                                                @foreach($categories as $cat)
                                                <li class="flex items-center justify-between gap-x-5 py-2 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]">{{ $cat->name }}</span>
                                                    <span class="font-normal">{{ $cat->blogs_count }}</span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif

                                        <!-- Popular News -->
                                        @if($popularBlogs->count() > 0)
                                        <li class="rounded-lg bg-[#f5f5f5] px-[30px] py-6">
                                            <h5 class="mb-7" @if($fs('sidebar_popular_title')) style="{{ $fs('sidebar_popular_title') }}" @endif>{{ $blogPageInfo?->getTranslation('sidebar_popular_title', app()->getLocale()) ?: 'Popüler Yazılar' }}</h5>
                                            <ul class="grid grid-cols-1 gap-y-4">
                                                @foreach($popularBlogs as $popular)
                                                <li class="group flex items-center gap-x-4">
                                                    <a href="{{ route('front.blog.details', $popular->id) }}" class="h-auto w-20 overflow-hidden rounded-[4px]">
                                                        @if($popular->image)
                                                            <img src="{{ asset($popular->image) }}" alt="{{ $popular->getTranslation('title', app()->getLocale()) }}" width="81" height="77" class="max-w-full transition-all duration-300 group-hover:scale-105" />
                                                        @else
                                                            <div class="w-20 h-[60px] bg-gray-200 rounded flex items-center justify-center">
                                                                <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </a>
                                                    <div class="flex-1">
                                                        <a href="{{ route('front.blog.details', $popular->id) }}" class="mb-2 block font-medium text-colorBlackPearl hover:text-colorPurpleBlue">{{ Str::limit($popular->getTranslation('title', app()->getLocale()), 50) }}</a>
                                                        @if($popular->published_at)
                                                        <span class="text-sm text-colorPurpleBlue">{{ $popular->published_at->translatedFormat('d F Y') }}</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif

                                        <!-- Contact Us -->
                                        <li class="rounded-lg bg-[#f5f5f5] px-[30px] py-6">
                                            <h5 class="mb-7" @if($fs('sidebar_contact_title')) style="{{ $fs('sidebar_contact_title') }}" @endif>{{ $blogPageInfo?->getTranslation('sidebar_contact_title', app()->getLocale()) ?: 'İletişim' }}</h5>
                                            <ul class="flex flex-col gap-y-3">
                                                @if($blogPageInfo?->getTranslation('sidebar_contact_phone', app()->getLocale()))
                                                <li class="inline-flex gap-x-6">
                                                    <div class="h-7 w-auto">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-phone-ring.svg') }}" alt="phone" width="28" height="28" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="block" @if($fs('sidebar_contact_phone_label')) style="{{ $fs('sidebar_contact_phone_label') }}" @endif>{{ $blogPageInfo->getTranslation('sidebar_contact_phone_label', app()->getLocale()) ?: '7/24 Destek' }}</span>
                                                        <a href="tel:{{ preg_replace('/\s+/', '', $blogPageInfo->getTranslation('sidebar_contact_phone', app()->getLocale())) }}" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl" @if($fs('sidebar_contact_phone')) style="{{ $fs('sidebar_contact_phone') }}" @endif>{{ $blogPageInfo->getTranslation('sidebar_contact_phone', app()->getLocale()) }}</a>
                                                    </div>
                                                </li>
                                                @endif
                                                @if($blogPageInfo?->getTranslation('sidebar_contact_email', app()->getLocale()))
                                                <li class="inline-flex gap-x-6">
                                                    <div class="h-7 w-auto">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-mail-open.svg') }}" alt="email" width="28" height="28" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="block" @if($fs('sidebar_contact_email_label')) style="{{ $fs('sidebar_contact_email_label') }}" @endif>{{ $blogPageInfo->getTranslation('sidebar_contact_email_label', app()->getLocale()) ?: 'Mesaj Gönderin' }}</span>
                                                        <a href="mailto:{{ $blogPageInfo->getTranslation('sidebar_contact_email', app()->getLocale()) }}" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl" @if($fs('sidebar_contact_email')) style="{{ $fs('sidebar_contact_email') }}" @endif>{{ $blogPageInfo->getTranslation('sidebar_contact_email', app()->getLocale()) }}</a>
                                                    </div>
                                                </li>
                                                @endif
                                                @if($blogPageInfo?->getTranslation('sidebar_contact_address', app()->getLocale()))
                                                <li class="inline-flex gap-x-6">
                                                    <div class="h-7 w-auto">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-location.svg') }}" alt="location" width="28" height="28" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="block" @if($fs('sidebar_contact_address_label')) style="{{ $fs('sidebar_contact_address_label') }}" @endif>{{ $blogPageInfo->getTranslation('sidebar_contact_address_label', app()->getLocale()) ?: 'Adresimiz' }}</span>
                                                        <address class="font-title text-xl not-italic text-colorBlackPearl" @if($fs('sidebar_contact_address')) style="{{ $fs('sidebar_contact_address') }}" @endif>
                                                            {!! nl2br(e($blogPageInfo->getTranslation('sidebar_contact_address', app()->getLocale()))) !!}
                                                        </address>
                                                    </div>
                                                </li>
                                                @endif
                                            </ul>
                                        </li>

                                        <!-- Tags -->
                                        @if($tags->count() > 0)
                                        <li class="rounded-lg bg-[#f5f5f5] px-[30px] py-6">
                                            <h5 class="mb-7" @if($fs('sidebar_tags_title')) style="{{ $fs('sidebar_tags_title') }}" @endif>{{ $blogPageInfo?->getTranslation('sidebar_tags_title', app()->getLocale()) ?: 'Etiketler' }}</h5>
                                            <ul class="flex flex-wrap gap-2">
                                                @foreach($tags as $tag)
                                                <li>
                                                    <span class="inline-block rounded-[50px] bg-colorPurpleBlue/[7%] px-[18px] py-2 text-[15px] leading-none text-colorPurpleBlue">{{ $tag->name }}</span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif
                                    </ul>
                                </aside>
                                <!-- Aside Bar -->
                            </div>
                            <!-- Blog Details Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Blog Details Section End :::... -->
@endsection
