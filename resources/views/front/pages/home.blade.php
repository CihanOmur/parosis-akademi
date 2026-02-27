@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Geleceğin Teknolojisine Yön Veren Akademi')

@section('content')
            <!--...::: Hero Section Start :::... -->
            <section class="section-hero overflow-hidden">
                @if($activeSlider && $activeSlider->activeItems->count() > 0)
                    @php $slides = $activeSlider->activeItems; @endphp

                    @if($slides->count() === 1)
                        {{-- Tek slayt — statik hero --}}
                        @php $slide = $slides->first(); @endphp
                        <div class="relative z-10 overflow-hidden bg-cover bg-center bg-no-repeat"
                             style="background-image: url('{{ $slide->background_image ? asset($slide->background_image) : asset('assets-front/img/images/th-1/hero-bg.svg') }}')">
                            <div class="grid grid-cols-1 items-end gap-6 px-5 pb-0 pt-8 md:py-16 lg:grid-cols-2 lg:gap-0 lg:px-0 lg:py-0 lg:pl-20 xxxl:pl-32 xxxxl:pl-[250px]">
                                <div class="py-8 lg:py-16 xxl:py-24">
                                    <h1 class="mb-[30px]">
                                        {!! nl2br(e(str_replace(
                                            $slide->highlight_text,
                                            '',
                                            $slide->title
                                        ))) !!}
                                        @if($slide->highlight_text)
                                            <span class="inline-flex rounded-md bg-colorBrightGold px-2">{{ $slide->highlight_text }}</span>
                                        @endif
                                    </h1>
                                    @if($slide->description)
                                        <p class="mb-10 max-w-[400px] xl:max-w-[474px]">
                                            {{ $slide->description }}
                                        </p>
                                    @endif
                                    @if($slide->button_text && $slide->button_url)
                                        <a href="{{ $slide->button_url }}" class="btn btn-primary is-icon group">{{ $slide->button_text }}
                                            <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="arrow" width="13" height="12" />
                                            </span>
                                            <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="arrow" width="13" height="12" />
                                            </span>
                                        </a>
                                    @endif
                                </div>
                                @if($slide->image)
                                    <div class="relative flex items-end justify-center overflow-hidden">
                                        <img src="{{ asset($slide->image) }}" alt="{{ $slide->title }}" width="653" height="740" class="element-move-x relative z-10 max-h-[420px] w-auto max-w-full object-contain object-bottom md:max-h-[500px] xl:max-h-[580px] xxl:max-h-[680px]"/>
                                        <div class="jos absolute bottom-0 left-1/2 -z-10 h-[300px] w-[300px] -translate-x-1/2 rounded-[50%] bg-gradient-to-t from-[#D7E1D8] to-white lg:-bottom-28 xl:h-[400px] xl:w-[400px] xxl:h-[550px] xxl:w-[550px]" data-jos_animation="zoom-in-up"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        {{-- Birden fazla slayt — Swiper carousel --}}
                        <div class="relative">
                            <div class="swiper hero-slider relative z-10 overflow-hidden">
                                <div class="swiper-wrapper">
                                    @foreach($slides as $slide)
                                        <div class="swiper-slide">
                                            <div class="relative z-10 bg-cover bg-center bg-no-repeat"
                                                 style="background-image: url('{{ $slide->background_image ? asset($slide->background_image) : asset('assets-front/img/images/th-1/hero-bg.svg') }}')">
                                                <div class="grid grid-cols-1 items-end gap-6 px-5 pb-0 pt-8 md:py-16 lg:grid-cols-2 lg:gap-0 lg:px-0 lg:py-0 lg:pl-20 xxxl:pl-32 xxxxl:pl-[250px]">
                                                    <div class="py-8 lg:py-16 xxl:py-24">
                                                        <h1 class="mb-[30px]">
                                                            {!! nl2br(e(str_replace(
                                                                $slide->highlight_text,
                                                                '',
                                                                $slide->title
                                                            ))) !!}
                                                            @if($slide->highlight_text)
                                                                <span class="inline-flex rounded-md bg-colorBrightGold px-2">{{ $slide->highlight_text }}</span>
                                                            @endif
                                                        </h1>
                                                        @if($slide->description)
                                                            <p class="mb-10 max-w-[400px] xl:max-w-[474px]">
                                                                {{ $slide->description }}
                                                            </p>
                                                        @endif
                                                        @if($slide->button_text && $slide->button_url)
                                                            <a href="{{ $slide->button_url }}" class="btn btn-primary is-icon group">{{ $slide->button_text }}
                                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="arrow" width="13" height="12" />
                                                                </span>
                                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="arrow" width="13" height="12" />
                                                                </span>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    @if($slide->image)
                                                        <div class="relative flex items-end justify-center overflow-hidden">
                                                            <img src="{{ asset($slide->image) }}" alt="{{ $slide->title }}" width="653" height="740" class="relative z-10 max-h-[420px] w-auto max-w-full object-contain object-bottom md:max-h-[500px] xl:max-h-[580px] xxl:max-h-[680px]"/>
                                                            <div class="absolute bottom-0 left-1/2 -z-10 h-[300px] w-[300px] -translate-x-1/2 rounded-[50%] bg-gradient-to-t from-[#D7E1D8] to-white lg:-bottom-28 xl:h-[400px] xl:w-[400px] xxl:h-[550px] xxl:w-[550px]"></div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- Sol/Sag oklar — kenarlarda --}}
                            <button class="hero-slider-prev absolute left-4 lg:left-8 top-1/2 z-30 -translate-y-1/2 w-12 h-12 rounded-full backdrop-blur-sm flex items-center justify-center transition-all duration-300 group" style="background:rgba(84,62,232,0.2);" onmouseover="this.style.background='rgba(84,62,232,0.4)'" onmouseout="this.style.background='rgba(84,62,232,0.2)'">
                                <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/></svg>
                            </button>
                            <button class="hero-slider-next absolute right-4 lg:right-8 top-1/2 z-30 -translate-y-1/2 w-12 h-12 rounded-full backdrop-blur-sm flex items-center justify-center transition-all duration-300 group" style="background:rgba(84,62,232,0.2);" onmouseover="this.style.background='rgba(84,62,232,0.4)'" onmouseout="this.style.background='rgba(84,62,232,0.2)'">
                                <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                            </button>
                            {{-- Pagination — mobilde altında, desktop'ta slider içinde --}}
                            <div class="hero-slider-pagination relative z-30 flex items-center justify-center gap-2 py-4 lg:absolute lg:bottom-6 lg:left-1/2 lg:-translate-x-1/2 lg:py-5"></div>
                        </div>
                    @endif
                @else
                    {{-- Fallback — statik hero (slider tanımlanmamışsa) --}}
                    <div class="relative z-10 overflow-hidden bg-[url(../img/images/th-1/hero-bg.svg)] bg-cover bg-center bg-no-repeat">
                        <div class="grid grid-cols-1 items-end gap-6 px-5 pb-0 pt-8 md:py-16 lg:grid-cols-2 lg:gap-0 lg:px-0 lg:py-0 lg:pl-20 xxxl:pl-32 xxxxl:pl-[250px]">
                            <div class="py-8 lg:py-16 xxl:py-24">
                                <h1 class="mb-[30px]">
                                    En İyi
                                    <span class="inline-flex rounded-md bg-colorBrightGold px-2">Online</span>
                                    Eğitim Platformu
                                </h1>
                                <p class="mb-10 max-w-[400px] xl:max-w-[474px]">
                                    Profesyonel eğitmenlerimizle kariyer hedeflerinize ulaşmanız için en uygun kursları keşfedin.
                                </p>
                                <a href="{{ route('front.courses') }}" class="btn btn-primary is-icon group">Tüm Kursları Görüntüle
                                    <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="arrow" width="13" height="12" />
                                    </span>
                                    <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="arrow" width="13" height="12" />
                                    </span>
                                </a>
                            </div>
                            <div class="relative flex items-end justify-center overflow-hidden">
                                <img src="{{ asset('assets-front/img/images/th-1/hero-img-1.png') }}" alt="hero-img-1" width="653" height="740" class="element-move-x relative z-10 max-h-[420px] w-auto max-w-full object-contain object-bottom md:max-h-[500px] xl:max-h-[580px] xxl:max-h-[680px]"/>
                                <div class="jos absolute bottom-0 left-1/2 -z-10 h-[300px] w-[300px] -translate-x-1/2 rounded-[50%] bg-gradient-to-t from-[#D7E1D8] to-white lg:-bottom-28 xl:h-[400px] xl:w-[400px] xxl:h-[550px] xxl:w-[550px]" data-jos_animation="zoom-in-up"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </section>
            <!--...::: Hero Section End :::... -->

            <!--...::: Welcome Section Start :::... -->
            <section class="section-welcome">
                <div class="relative z-10">
                    <!-- Section Space -->
                    <div class="section-space-top">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Welcome Area -->
                            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-16 xl:gap-32">
                                <!-- Welcome Left Block -->
                                <div class="jos relative order-2 mx-auto lg:order-1" data-jos_animation="fade-right">
                                    <img src="{{ $homePageInfo && $homePageInfo->welcome_image ? asset($homePageInfo->welcome_image) : asset('assets-front/img/images/th-1/welcome-img.png') }}" alt="welcome-img" width="482" height="486" class="max-w-full" />

                                    <!-- Card -->
                                    <div class="jos absolute bottom-24 left-16 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-4 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10 xxl:-left-16 xxxl:-left-28">
                                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="icon-red-tomato-graduation-cap-line." width="28" height="28" />
                                        </div>
                                        <div class="">
                                            <span class="block font-title text-[28px] font-bold leading-[1.73] text-[#DF4343]">{{ $homePageInfo->welcome_stat_number ?? '9394' }}+</span>
                                            <span>{{ $homePageInfo ? ($homePageInfo->welcome_stat_text ?: 'Enrolled Learners') : 'Enrolled Learners' }}</span>
                                        </div>
                                    </div>
                                    <!-- Card -->

                                    <!-- Background Element -->
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-2.svg') }}" alt="abstract-dots-2" class="absolute -left-10 top-1/2 z-20 -translate-y-1/2 rotate-90" />
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-golden-yellow-bg-black-dash-1.svg') }}" alt="abstract-dots-2" width="83" height="74" class="absolute bottom-5 right-0 z-20" />
                                    <!-- Background Element -->
                                </div>
                                <!-- Welcome Left Block -->

                                <!-- Welcome Right Block -->
                                <div class="jos order-1 lg:order-2" data-jos_animation="fade-left">
                                    <!-- Section Block -->
                                    <div class="mb-6">
                                        <span class="mb-5 block uppercase text-[#84994F]">{{ $homePageInfo ? ($homePageInfo->welcome_label ?: 'WELCOME TO PAROSIS') : 'WELCOME TO PAROSIS' }}</span>
                                        <h2>
                                            {{ $homePageInfo ? ($homePageInfo->welcome_title ?: 'Digital Online Academy: Your Path to Creative Excellence') : 'Digital Online Academy: Your Path to Creative Excellence' }}
                                        </h2>
                                    </div>
                                    <!-- Section Block -->
                                    <!-- Content Block -->
                                    <div>
                                        <p>
                                            {{ $homePageInfo ? ($homePageInfo->welcome_description ?: 'Profesyonel eğitmenlerimizle kariyer hedeflerinize ulaşmanız için en uygun kursları keşfedin.') : 'Profesyonel eğitmenlerimizle kariyer hedeflerinize ulaşmanız için en uygun kursları keşfedin.' }}
                                        </p>
                                        @php
                                            $welcomeFeatures = $homePageInfo ? $homePageInfo->welcome_features : null;
                                            if (!is_array($welcomeFeatures) || empty($welcomeFeatures)) {
                                                $welcomeFeatures = ['Our Expert Trainers', 'Online Remote Learning', 'Easy to follow curriculum', 'Lifetime Access'];
                                            }
                                        @endphp
                                        <ul class="mt-6 flex list-inside list-image-[url(../img/icons/icon-purple-check.svg)] flex-col gap-y-4 font-title text-colorBlackPearl">
                                            @foreach($welcomeFeatures as $feature)
                                                <li>{{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Content Block -->
                                </div>
                                <!-- Welcome Right Block -->
                            </div>
                            <!-- Welcome Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Section Elements -->
                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="absolute bottom-0 right-20 -z-10" />
                    <div class="absolute -bottom-20 left-0 -z-10 h-[383px] w-[531px] -translate-x-1/2 rounded-[50%] bg-colorBrightGold/[23%] blur-3xl"></div>
                    <!-- Section Elements -->
                </div>
            </section>
            <!--...::: Welcome Section End :::... -->

            <!--...::: Course Category Section Start :::... -->
            <section class="section-course-category">
                <!-- Section Space -->
                <div class="section-space">
                    <!-- Section Container  -->
                    <div class="container">
                        <!-- Section Block -->
                        <div class="mb-10 flex flex-wrap items-center justify-between gap-8 lg:mb-[60px]">
                            <div class="jos max-w-xl">
                                <span class="mb-5 block uppercase">{{ $homePageInfo ? ($homePageInfo->categories_label ?: 'COURSE CATEGORIES') : 'COURSE CATEGORIES' }}</span>
                                <h2>{{ $homePageInfo ? ($homePageInfo->categories_title ?: 'Top Categories You Want to Learn') : 'Top Categories You Want to Learn' }}</h2>
                            </div>
                            <div class="jos inline-block">
                                <a href="{{ $homePageInfo && $homePageInfo->categories_button_url ? $homePageInfo->categories_button_url : route('front.courses') }}" class="btn btn-primary is-icon group">{{ $homePageInfo ? ($homePageInfo->categories_button_text ?: 'Find Courses') : 'Find Courses' }}
                                    <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                    </span>
                                    <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                    </span>
                                </a>
                            </div>
                        </div>
                        <!-- Section Block -->

                        <!-- Course Category List -->
                        <ul class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            @foreach($courseCategories as $category)
                            <li class="jos">
                                <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%]" style="background-color: {{ ($category->color ?? '#543EE4') . '1a' }}">
                                        @if($category->icon)
                                            <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}" width="30" height="30" />
                                        @else
                                            <svg class="w-[30px] h-[30px]" style="color: {{ $category->color ?? '#543EE4' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">{{ $category->name }}</span>
                                        <span class="text-sm">{{ str_pad($category->courses_count, 2, '0', STR_PAD_LEFT) }} Kurs</span>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <!-- Course Category List -->
                    </div>
                    <!-- Section Container  -->
                </div>
                <!-- Section Space -->
            </section>
            <!--...::: Course Category Section End :::... -->

            <!--...::: Feature Section Start :::... -->
            <div class="section-feature">
                <!-- Section Background -->
                <div class="relative z-10 bg-colorBlackPearl">
                    <!-- Section Space -->
                    <div class="py-[60px] lg:py-[90px]">
                        <!-- Section Container -->
                        <div class="container">
                            @php
                                $featuresData = $homePageInfo ? $homePageInfo->features : null;
                                if (!is_array($featuresData) || empty($featuresData)) {
                                    $featuresData = [
                                        ['title' => 'Educator Support', 'description' => 'Excepteur sint occaecat cupidatat non the proident sunt in culpa', 'icon' => 'assets-front/img/icons/feature-icon-1.svg', 'bg_color' => '#FFCD20'],
                                        ['title' => 'Top Instructor', 'description' => 'Excepteur sint occaecat cupidatat non the proident sunt in culpa', 'icon' => 'assets-front/img/icons/feature-icon-2.svg', 'bg_color' => '#6FC081'],
                                        ['title' => 'Award Wining', 'description' => 'Excepteur sint occaecat cupidatat non the proident sunt in culpa', 'icon' => 'assets-front/img/icons/feature-icon-3.svg', 'bg_color' => '#DF4343'],
                                    ];
                                }
                            @endphp
                            <!-- Feature List -->
                            <ul class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
                                @foreach($featuresData as $feature)
                                <li class="jos flex items-start gap-5">
                                    <div class="inline-flex h-[60px] w-[60px] items-center justify-center rounded-[50%]" style="background-color: {{ ($feature['bg_color'] ?? '#FFCD20') . '1a' }}">
                                        @if(!empty($feature['icon']))
                                            <img src="{{ asset($feature['icon']) }}" alt="{{ $feature['title'] ?? '' }}" width="30" height="30" />
                                        @else
                                            <svg class="w-[30px] h-[30px]" style="color: {{ $feature['bg_color'] ?? '#FFCD20' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-2 block font-title text-xl font-bold text-white">{{ $feature['title'] ?? '' }}</span>
                                        <span class="text-white/80">{{ $feature['description'] ?? '' }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <!-- Feature List -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Background Elements -->
                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-2.svg') }}" alt="abstract-dots-2" width="49" height="79" class="absolute left-[100px] top-1/2 -z-10 hidden -translate-y-1/2 rotate-90 animate-pulse xxxl:inline-block" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-golden-yellow-dash-1.svg') }}" alt="abstract-golden-yellow-dash-1" width="45" height="37" class="absolute bottom-12 right-[100px] -z-10 hidden animate-bounce xxxl:inline-block" />
                    <!-- Background Elements -->
                </div>
                <!-- Section Background -->
            </div>
            <!--...::: Feature Section End :::... -->

            <!--...::: Course Section Start :::... -->
            <section class="section-course">
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 lg:mb-[60px]">
                                <div class="jos mx-auto max-w-md text-center">
                                    <span class="mb-5 block uppercase">{{ $homePageInfo ? ($homePageInfo->courses_label ?: 'ONLINE COURSES') : 'ONLINE COURSES' }}</span>
                                    <h2>{{ $homePageInfo ? ($homePageInfo->courses_title ?: 'Get Your Course With Us') : 'Get Your Course With Us' }}</h2>
                                </div>
                            </div>
                            <!-- Section Block -->

                            <!-- Course List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                @foreach($courses as $course)
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden">
                                            @if($course->image)
                                                <img src="{{ asset($course->image) }}" alt="{{ $course->getTranslation('title', app()->getLocale()) }}" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />
                                            @else
                                                <img src="{{ asset('assets-front/img/images/th-1/course-img-1.jpg') }}" alt="course" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />
                                            @endif

                                            @if($course->categories->count())
                                                <span class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl">{{ $course->categories->first()->name }}</span>
                                            @endif
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="bg-[#F5F5F5] px-5 py-8">
                                            <!-- Course Meta -->
                                            <div class="flex gap-9">
                                                @if($course->lesson_count)
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">{{ $course->lesson_count }} Ders</span>
                                                </span>
                                                @endif
                                                @if($course->instructor_name)
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-user-3-line.svg') }}" alt="icon-grey-user-3-line" width="17" height="18" />
                                                    <span class="flex-1">{{ $course->instructor_name }}</span>
                                                </span>
                                                @endif
                                            </div>
                                            <!-- Course Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details', $course->id) }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">{{ $course->getTranslation('title', app()->getLocale()) }}</a>
                                            <!-- Title Link -->

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                @if($course->price)
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">{{ $course->price }}</span>
                                                @endif
                                                @if($course->student_count)
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-graduation-cap-line.svg') }}" alt="icon-grey-graduation-cap-line" width="17" height="17" />
                                                    <span class="flex-1">{{ $course->student_count }} Ogrenci</span>
                                                </div>
                                                @endif
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <!-- Course List -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Course Section End :::... -->

            <!--...::: Content Section Start :::... -->
            <section class="section-content">
                <!-- Section Background -->
                <div class="relative z-10">
                    <!-- Section Space -->
                    <div class="section-space-top pb-[286px]">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Content Area -->
                            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-[minmax(0,0.9fr)_1fr] xxl:gap-28">
                                <!-- Content Left Block -->
                                <div class="jos" data-jos_animation="fade-right">
                                    <!-- Section Block -->
                                    <div class="mb-6">
                                        <span class="mb-5 block uppercase">{{ $homePageInfo ? ($homePageInfo->why_label ?: 'WHY CHOOSE US') : 'WHY CHOOSE US' }}</span>
                                        <h2>{{ $homePageInfo ? ($homePageInfo->why_title ?: 'Transform Your Best Practice with Our Online Course') : 'Transform Your Best Practice with Our Online Course' }}</h2>
                                    </div>
                                    <!-- Section Block -->
                                    <!-- Content -->
                                    <div class="mt-7">
                                        <p>{{ $homePageInfo ? ($homePageInfo->why_description ?: 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit. Excepteur sint occaecat.') : 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit. Excepteur sint occaecat.' }}</p>

                                        @php
                                            $whyItems = $homePageInfo ? $homePageInfo->why_items : null;
                                            if (!is_array($whyItems) || empty($whyItems)) {
                                                $whyItems = [
                                                    ['title' => 'Face-to-face Teaching', 'description' => 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia for this is a for that an deserunt mollit.', 'icon' => 'assets-front/img/icons/content-icon-1.svg', 'bg_color' => '#20B9AB'],
                                                    ['title' => '24/7 Support Available', 'description' => 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia for this is a for that an deserunt mollit.', 'icon' => 'assets-front/img/icons/content-icon-2.svg', 'bg_color' => '#DF4343'],
                                                ];
                                            }
                                        @endphp
                                        <ul class="mt-10 flex flex-col gap-y-10">
                                            @foreach($whyItems as $whyItem)
                                            <li>
                                                <div class="mb-5 flex items-center gap-x-5">
                                                    <div class="inline-flex h-[60px] w-[60px] items-center justify-center rounded-[50%]" style="background-color: {{ ($whyItem['bg_color'] ?? '#20B9AB') . '1a' }}">
                                                        @if(!empty($whyItem['icon']))
                                                            <img src="{{ asset($whyItem['icon']) }}" alt="{{ $whyItem['title'] ?? '' }}" width="25" height="25" />
                                                        @else
                                                            <svg class="w-[25px] h-[25px]" style="color: {{ $whyItem['bg_color'] ?? '#20B9AB' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                                                        @endif
                                                    </div>
                                                    <span class="flex-1 font-title text-xl font-bold text-colorBlackPearl">{{ $whyItem['title'] ?? '' }}</span>
                                                </div>
                                                <p>{{ $whyItem['description'] ?? '' }}</p>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Content -->
                                </div>
                                <!-- Content Left Block -->

                                <!-- Content Right Block -->
                                <div class="jos relative z-10" data-jos_animation="fade-left">
                                    <img src="{{ $homePageInfo && $homePageInfo->why_image ? asset($homePageInfo->why_image) : asset('assets-front/img/images/th-1/content-img-1.png') }}" alt="content-img-1" width="586" height="585" class="max-w-full pl-5" />

                                    <!-- Card -->
                                    <div class="jos absolute bottom-[60px] left-0 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-2 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10">
                                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="icon-red-tomato-graduation-cap-line." width="28" height="28" />
                                        </div>
                                        <div class="">
                                            <span class="block font-title text-[28px] font-bold leading-[1.73] text-[#DF4343]">{{ $homePageInfo->why_stat_number ?? '69K' }}+</span>
                                            <span>{{ $homePageInfo ? ($homePageInfo->why_stat_text ?: 'Satisfied Students') : 'Satisfied Students' }}</span>
                                        </div>
                                    </div>
                                    <!-- Card -->

                                    <!-- Background Shape -->
                                    <div class="absolute left-0 top-0 -z-10 h-96 w-96 rounded-[50%] bg-[#6FC081] blur-[230px]"></div>
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-orange-1.svg') }}" alt="abstract-orange-1" width="70" height="55" class="absolute left-1 top-[133px]" />
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-3.svg') }}" alt="aabstract-dots-3" width="79" height="50" class="absolute -right-5 bottom-[65px]" />
                                    <!-- Background Shape -->
                                </div>
                                <!-- Content Right Block -->
                            </div>
                            <!-- Content Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Background Elements -->
                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-2.svg') }}" alt="abstract-dots-2" width="49" height="79" class="absolute left-28 top-28 -z-10 hidden animate-pulse xl:inline-block" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-3.svg') }}" alt="abstract-dots-3" width="79" height="50" class="absolute bottom-16 right-96 -z-10 hidden animate-pulse xl:inline-block" />
                    <div class="absolute -left-80 top-1/2 -z-10 h-[457px] w-[457px] -translate-y-1/2 rounded-[50%] bg-[#BFC06F] blur-[230px]"></div>
                    <!-- Background Elements -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Client Logo Section Start :::... -->
            <div class="section-client-logo">
                <!-- Section Background -->
                <div class="bg-white">
                    <!-- Fun-fact Area -->
                    @php
                        $funfactItems = $homePageInfo ? $homePageInfo->funfact_items : null;
                        if (!is_array($funfactItems) || empty($funfactItems)) {
                            $funfactItems = [
                                ['number' => '5923', 'text' => 'Student enrolled'],
                                ['number' => '8497', 'text' => 'Classes completed'],
                                ['number' => '7554', 'text' => 'Learners report'],
                                ['number' => '2755', 'text' => 'Top instructors'],
                            ];
                        }
                    @endphp
                    <div class="z-10 -mt-44">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="rounded-lg bg-colorPurpleBlue p-5">
                                <div class="grid grid-cols-1 items-center gap-x-28 gap-y-10 lg:grid-cols-2">
                                    <!-- Countdown Left Block -->
                                    <div class="overflow-hidden rounded-lg">
                                        <img src="{{ $homePageInfo && $homePageInfo->funfact_image ? asset($homePageInfo->funfact_image) : asset('assets-front/img/images/th-1/funfact-image.png') }}" alt="funfact-image" width="553" height="315" class="mx-auto max-w-full" />
                                    </div>
                                    <!-- Countdown Left Block -->
                                    <!-- Countdown Right Block -->
                                    <div>
                                        <ul class="grid grid-cols-1 gap-x-[120px] gap-y-6 text-center sm:grid-cols-2 lg:gap-y-16 lg:text-left">
                                            @foreach($funfactItems as $funfact)
                                            <li>
                                                <div class="mb-2 font-title text-4xl font-bold text-white" data-module="countup">
                                                    <span class="start-number" data-countup-number="{{ $funfact['number'] ?? '0' }}">{{ $funfact['number'] ?? '0' }}</span>+
                                                </div>
                                                <span class="text-white/80">{{ $funfact['text'] ?? '' }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Countdown Right Block -->
                                </div>
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Fun-fact Area -->
                    <!-- Section Space -->
                    <div class="section-space pt-[286px]">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="mx-auto mb-10 max-w-xl lg:mb-[60px]">
                                <p class="text-center text-lg text-colorBlackPearl">
                                    {!! $homePageInfo && $homePageInfo->client_logo_text ? $homePageInfo->client_logo_text : 'Get in touch with the <strong>250+</strong> companies who Collaboration us' !!}
                                </p>
                            </div>

                            @if($clientLogos->count() > 0)
                            <!-- Slider main container -->
                            <div class="swiper client-slider">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper ease-linear">
                                    @foreach($clientLogos as $logo)
                                    <div class="swiper-slide">
                                        @if($logo->url)
                                            <a href="{{ $logo->url }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ asset($logo->image) }}" alt="{{ $logo->name ?? 'client-logo' }}" height="40" class="mx-auto" style="max-height: 40px; width: auto;" />
                                            </a>
                                        @else
                                            <img src="{{ asset($logo->image) }}" alt="{{ $logo->name ?? 'client-logo' }}" height="40" class="mx-auto" style="max-height: 40px; width: auto;" />
                                        @endif
                                    </div>
                                    @endforeach
                                    {{-- Sonsuz slider efekti için logoları tekrarla --}}
                                    @foreach($clientLogos as $logo)
                                    <div class="swiper-slide">
                                        @if($logo->url)
                                            <a href="{{ $logo->url }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ asset($logo->image) }}" alt="{{ $logo->name ?? 'client-logo' }}" height="40" class="mx-auto" style="max-height: 40px; width: auto;" />
                                            </a>
                                        @else
                                            <img src="{{ asset($logo->image) }}" alt="{{ $logo->name ?? 'client-logo' }}" height="40" class="mx-auto" style="max-height: 40px; width: auto;" />
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </div>
            <!--...::: Client Logo Section End :::... -->

            <!--...::: Testimonial Section Start :::... -->
            <section class="section-testimonial">
                <!-- Section Space -->
                <div class="section-space">
                    <!-- Section Container -->
                    <div class="container">
                        <!-- Testimonial Area -->
                        <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-16 xl:gap-32">
                            <!-- Testimonial Left Block -->
                            <div class="jos" data-jos_animation="fade-left">
                                <!-- Section Block -->
                                <div class="mb-10 lg:mb-[60px]">
                                    <span class="mb-5 block uppercase">OUR TESTIMONIAL</span>
                                    <h2>What Student Say About Our Online Education Course</h2>
                                </div>
                                <!-- Section Block -->

                                <!-- Testimonial Slider -->
                                <div class="rounded-lg bg-white p-8">
                                    <div class="swiper testimonial-slider-1">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            <!-- Slide Item -->
                                            <div class="swiper-slide">
                                                <!-- Review Star -->
                                                <div class="mb-5 inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <!-- Review Star -->
                                                <blockquote class="text-lg">
                                                    " Attending EduVibe School of Business was one of
                                                    the best decisions I've ever made. The curriculum
                                                    was practical and industry-focused, and I was able
                                                    to apply what I learned in the classroom."
                                                </blockquote>
                                                <div class="mt-8 flex items-center gap-x-4">
                                                    <div class="h-[43px] w-[43px] overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-1/testimonial-avater-1.png') }}" alt="testimonial-avater-1" width="43" height="43" class="h-full w-full object-cover" />
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span class="block font-title text-xl font-bold text-colorBlackPearl">John Smith</span>
                                                        <span class="block text-sm">Science Student</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Slide Item -->
                                            <!-- Slide Item -->
                                            <div class="swiper-slide">
                                                <!-- Review Star -->
                                                <div class="mb-5 inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <!-- Review Star -->
                                                <blockquote class="text-lg">
                                                    " Attending EduVibe School of Business was one of
                                                    the best decisions I've ever made. The curriculum
                                                    was practical and industry-focused, and I was able
                                                    to apply what I learned in the classroom."
                                                </blockquote>
                                                <div class="mt-8 flex items-center gap-x-4">
                                                    <div class="h-[43px] w-[43px] overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-1/testimonial-avater-1.png') }}" alt="testimonial-avater-1" width="43" height="43" class="h-full w-full object-cover" />
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span class="block font-title text-xl font-bold text-colorBlackPearl">John Smith</span>
                                                        <span class="block text-sm">Science Student</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Slide Item -->
                                        </div>

                                        <!-- If we need navigation buttons -->
                                        <div class="absolute bottom-0 right-0 z-10 flex items-center gap-x-[18px]">
                                            <div class="slider-button-prev static opacity-100 transition-all">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-long-arrow-left.svg') }}" alt="icon-purple-long-arrow-left" width="28" height="16" />
                                            </div>
                                            <div class="slider-button-next static opacity-100 transition-all">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-long-arrow-right.svg') }}" alt="icon-purple-long-arrow-right" width="28" height="16" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slider -->
                            </div>
                            <!-- Testimonial Left Block -->

                            <!-- Testimonial Right Block -->
                            <div class="jos relative mx-auto" data-jos_animation="fade-right">
                                <img src="{{ asset('assets-front/img/images/th-1/testimonial-img.png') }}" alt="testimonial-img" width="437" height="520" class="max-w-full" />

                                <!-- Card -->
                                <div class="jos absolute bottom-12 left-16 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-2 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10 xxl:-left-16 xxxl:-left-28">
                                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                        <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="icon-red-tomato-graduation-cap-line." width="28" height="28" />
                                    </div>
                                    <div class="">
                                        <span class="block font-title text-[28px] font-bold leading-[1.73] text-[#DF4343]">667K+</span>
                                        <span>Students worldwide</span>
                                    </div>
                                </div>
                                <!-- Card -->

                                <!-- Background Element -->
                                <img src="{{ asset('assets-front/img/abstracts/abstract-dots-3.svg') }}" alt="abstract-dots-2" class="absolute -right-10 top-1/2 z-20 -translate-y-1/2 animate-pulse" />
                                <!-- Background Element -->
                            </div>
                            <!-- Testimonial Right Block -->
                        </div>
                        <!-- Testimonial Area -->
                    </div>
                    <!-- Section Container -->
                </div>
                <!-- Section Space -->
            </section>
            <!--...::: Testimonial Section End :::... -->

            <!--...::: Blog Section Start :::... -->
            <section class="section-blog">
                <!-- Section Background -->
                <div class="relative z-10 overflow-hidden bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 lg:mb-[60px]">
                                <div class="jos mx-auto max-w-md text-center">
                                    <span class="mb-5 block uppercase">{{ $homePageInfo ? ($homePageInfo->blog_label ?: 'OUR NEWS') : 'OUR NEWS' }}</span>
                                    <h2>{{ $homePageInfo ? ($homePageInfo->blog_title ?: 'Our New Articles') : 'Our New Articles' }}</h2>
                                </div>
                            </div>
                            <!-- Section Block -->

                            <!-- Blog List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                @foreach($blogs as $blog)
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-[10px]">
                                            @if($blog->image)
                                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->getTranslation('title', app()->getLocale()) }}" width="370" height="334" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />
                                            @else
                                                <img src="{{ asset('assets-front/img/images/th-1/blog-img-1.jpg') }}" alt="blog" width="370" height="334" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />
                                            @endif

                                            @if($blog->categories->count())
                                                <a href="{{ route('front.blog') }}" class="absolute bottom-4 left-4 inline-block rounded-[40px] bg-colorPurpleBlue px-3.5 py-3 text-sm leading-none text-white hover:bg-colorBlackPearl">{{ $blog->categories->first()->name }}</a>
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
                                                    <span class="flex-1">{{ $blog->published_at->format('d M, Y') }}</span>
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
                                @endforeach
                            </ul>
                            <!-- Blog List -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Background Elements -->
                    <div class="absolute -left-80 top-1/2 -z-10 h-[457px] w-[457px] -translate-y-1/2 rounded-[50%] bg-[#BFC06F] blur-[230px]"></div>
                    <div class="absolute -right-40 -top-20 -z-10 h-[457px] w-[457px] -translate-y-1/2 rounded-[50%] bg-[#6FC081] blur-[230px]"></div>
                    <!-- Background Elements -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Blog Section End :::... -->

@endsection

@push('scripts')
@if(isset($activeSlider) && $activeSlider && $activeSlider->activeItems->count() > 1)
<style>
    .hero-slider-pagination {
        text-align: center !important;
        display: flex !important;
        justify-content: center !important;
        width: auto !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
    }
    .hero-slider-pagination .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        border-radius: 9999px;
        background: #d1d5db;
        opacity: 1;
        display: inline-block;
        cursor: pointer;
        transition: width 0.4s ease, background 0.4s ease;
        border: none;
    }
    .hero-slider-pagination .swiper-pagination-bullet:hover {
        background: #9ca3af;
    }
    .hero-slider-pagination .swiper-pagination-bullet-active {
        width: 30px;
        background: #543EE8;
    }
    .hero-slider-pagination .swiper-pagination-bullet::after,
    .hero-slider-pagination .swiper-pagination-bullet::before {
        display: none !important;
    }
</style>
<script>

    const heroSlider = new Swiper(".hero-slider", {
        loop: true,
        speed: 1000,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".hero-slider-next",
            prevEl: ".hero-slider-prev",
        },
        pagination: {
            el: ".hero-slider-pagination",
            clickable: true,
        },
    });
</script>
@endif
@endpush
