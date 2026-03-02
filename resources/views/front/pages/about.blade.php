@extends('front.layouts.app')

@section('title', 'Parosis Akademi | ' . ($aboutPageInfo?->getTranslation('breadcrumb_title', app()->getLocale(), false) ?: __('Hakkımızda')))

@php
    $locale = app()->getLocale();
    $t = fn($field, $fallback = '') => $aboutPageInfo?->getTranslation($field, $locale, false) ?: $fallback;
    $v = fn($field, $fallback = '') => $aboutPageInfo?->$field ?: $fallback;

    $fieldStyles = $aboutPageInfo?->field_styles ?? [];
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
                                <h1 class="mb-5 text-4xl capitalize tracking-normal" @if($fs('breadcrumb_title')) style="{{ $fs('breadcrumb_title') }}" @endif>
                                    {{ $t('breadcrumb_title', 'Hakkımızda') }}
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}" @if($fs('breadcrumb_home')) style="{{ $fs('breadcrumb_home') }}" @endif>{{ $t('breadcrumb_home', 'ANA SAYFA') }}</a>
                                        </li>
                                        <li @if($fs('breadcrumb_current')) style="{{ $fs('breadcrumb_current') }}" @endif>{{ $t('breadcrumb_current', 'HAKKIMIZDA') }}</li>
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

            <!--...::: Content Section Start :::... -->
            <section class="section-content">
                <!-- Section Background -->
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Content Area -->
                            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 xxl:gap-44">
                                <!-- Content Left Block -->
                                <div class="jos" data-jos_animation="fade-right">
                                    <!-- Section Block -->
                                    <div class="mb-6">
                                        <span class="mb-5 block uppercase" @if($fs('section1_label')) style="{{ $fs('section1_label') }}" @endif>{{ $t('section1_label', 'NEDEN BIZ') }}</span>
                                        <h2 @if($fs('section1_title')) style="{{ $fs('section1_title') }}" @endif>
                                            {{ $t('section1_title', 'Online Kurslarımızla En İyi Uygulamalarınızı Dönüştürün') }}
                                        </h2>
                                    </div>
                                    <!-- Section Block -->
                                    <!-- Content -->
                                    <div class="mt-7">
                                        <p @if($fs('section1_description')) style="{{ $fs('section1_description') }}" @endif>
                                            {{ $t('section1_description', 'Uzman eğitmenlerimiz ve kapsamlı müfredatımızla hedeflerinize ulaşmanıza yardımcı oluyoruz.') }}
                                        </p>

                                        @php
                                            $s1features = $aboutPageInfo?->getTranslation('section1_features', $locale, false);
                                            if (!is_array($s1features) || count($s1features) === 0) {
                                                $s1features = [];
                                                $f1t = $t('section1_feature1_title', '');
                                                if ($f1t) $s1features[] = ['title' => $f1t, 'description' => $t('section1_feature1_description', ''), 'icon' => $aboutPageInfo?->section1_feature1_icon ?? '', 'bg_color' => '#42AC98'];
                                                $f2t = $t('section1_feature2_title', '');
                                                if ($f2t) $s1features[] = ['title' => $f2t, 'description' => $t('section1_feature2_description', ''), 'icon' => $aboutPageInfo?->section1_feature2_icon ?? '', 'bg_color' => '#D73B3E'];
                                                if (empty($s1features)) {
                                                    $s1features = [
                                                        ['title' => 'Yüz Yüze Eğitim', 'description' => 'Uzman eğitmenlerimizle birebir etkileşimli öğrenme deneyimi yaşayın.', 'icon' => 'assets-front/img/icons/content-icon-1.svg', 'bg_color' => '#42AC98'],
                                                        ['title' => '7/24 Destek', 'description' => 'İhtiyacınız olduğu her an yanınızda olan destek ekibimizle tanışın.', 'icon' => 'assets-front/img/icons/content-icon-2.svg', 'bg_color' => '#D73B3E'],
                                                    ];
                                                }
                                            }
                                        @endphp
                                        <ul class="mt-10 flex flex-col gap-y-10">
                                            @foreach($s1features as $fIdx => $feat)
                                            @php $fColor = $feat['bg_color'] ?? '#42AC98'; @endphp
                                            <li>
                                                <div class="mb-5 flex items-center gap-x-5">
                                                    <div class="inline-flex h-[60px] w-[60px] min-w-[60px] items-center justify-center rounded-[50%]" style="background: {{ $fColor }}1a">
                                                        @if(!empty($feat['icon']))
                                                            <img src="{{ asset($feat['icon']) }}" alt="{{ $feat['title'] ?? '' }}" width="25" height="25" />
                                                        @else
                                                            <svg class="h-[25px] w-[25px]" style="color: {{ $fColor }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                @if($fIdx % 3 === 0)
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>
                                                                @elseif($fIdx % 3 === 1)
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                                                                @else
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.746 3.746 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                                                                @endif
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <span class="flex-1 font-title text-xl font-bold text-colorBlackPearl" @if($fs('feature_'.$fIdx.'_title')) style="{{ $fs('feature_'.$fIdx.'_title') }}" @endif>{{ $feat['title'] ?? '' }}</span>
                                                </div>
                                                <p @if($fs('feature_'.$fIdx.'_description')) style="{{ $fs('feature_'.$fIdx.'_description') }}" @endif>{{ $feat['description'] ?? '' }}</p>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Content -->
                                </div>
                                <!-- Content Left Block -->

                                <!-- Content Right Block -->
                                <div class="relative z-10">
                                    <img src="{{ asset($v('section1_image1', 'assets-front/img/images/th-3/content-img-1.jpg')) }}" alt="content-img-1" width="456" height="465" class="jos ml-auto max-w-full rounded-lg" />
                                    <img src="{{ asset($v('section1_image2', 'assets-front/img/images/th-3/content-img-2.jpg')) }}" alt="content-img-2" width="355" height="263" class="jos -mt-[106px] max-w-full rounded-lg" />

                                    <!-- Card -->
                                    <div class="jos absolute bottom-[30px] right-0 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-2 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10" data-jos_animation="fade-right">
                                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="icon-red-tomato-graduation-cap-line." width="28" height="28" />
                                        </div>
                                        <div class="">
                                            <span class="block font-title text-[28px] font-bold leading-[1.73] text-[#DF4343]">{{ $v('section1_stat_number', '69K+') }}</span>
                                            <span>{{ $t('section1_stat_text', 'Memnun Öğrenci') }}</span>
                                        </div>
                                    </div>
                                    <!-- Card -->

                                    <!-- Background Element -->
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-1.svg') }}" alt="abstract-dots-1" width="49" height="94" class="absolute left-0 top-1/2 -translate-y-1/2 animate-pulse" />
                                    <!-- Background Element -->

                                    <!-- Background Shape -->
                                    <div class="absolute left-0 top-1/2 -z-10 h-96 w-96 -translate-y-1/2 rounded-[50%] bg-[#6FC081] blur-[230px]"></div>
                                    <!-- Background Shape -->
                                </div>
                                <!-- Content Right Block -->
                            </div>
                            <!-- Content Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Course Category Section Start :::... -->
            <section class="section-course-category">
                <div class="relative z-10 lg:pb-[248px]">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container  -->
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 flex flex-wrap items-center justify-between gap-8 lg:mb-[60px]">
                                <div class="jos max-w-xl">
                                    <span class="mb-5 block uppercase" @if($fs('categories_label')) style="{{ $fs('categories_label') }}" @endif>{{ $t('categories_label', 'KURS KATEGORİLERİ') }}</span>
                                    <h2 @if($fs('categories_title')) style="{{ $fs('categories_title') }}" @endif>{{ $t('categories_title', 'Öğrenmek İstediğiniz Popüler Kategoriler') }}</h2>
                                </div>
                                <div class="jos inline-block">
                                    <a href="{{ route('front.courses') }}" class="btn btn-primary is-icon group">{{ $t('categories_button_text', 'Kursları Keşfet') }}
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
                                @php $defaultColors = ['#DE1EF9', '#42AC98', '#DF4343', '#543EE4', '#FF6B35', '#2196F3', '#E91E63', '#009688']; @endphp
                                @foreach($courseCategories as $cat)
                                @php $catColor = $cat->color ?? $defaultColors[$loop->index % count($defaultColors)]; @endphp
                                <li class="jos">
                                    <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                        <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%]" style="background-color: {{ $catColor }}1a">
                                            @if($cat->icon)
                                                <img src="{{ asset($cat->icon) }}" alt="{{ $cat->getTranslation('name', app()->getLocale()) }}" width="30" height="30" />
                                            @else
                                                <svg class="w-[30px] h-[30px]" style="color: {{ $catColor }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">{{ $cat->getTranslation('name', app()->getLocale()) }}</span>
                                            <span class="text-sm">{{ str_pad($cat->courses_count, 2, '0', STR_PAD_LEFT) }} {{ __('Kurs') }}</span>
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

                    <!-- Background Element -->
                    <div class="absolute left-[360px] top-60 -z-10 h-[383px] w-[531px] bg-colorBrightGold/25 blur-[250px]"></div>
                    <!-- Background Element -->
                </div>
            </section>
            <!--...::: Course Category Section End :::... -->

            <!--...::: Video Section Start :::... -->
            <div class="section-video">
                <div class="relative z-20 lg:-mt-[248px]">
                    <div class="bg-transparent">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="jos relative flex items-center justify-center">
                                <img src="{{ asset($v('video_image', 'assets-front/img/images/th-2/video-img.jpg')) }}" alt="video-img" width="1170" height="500" class="h-96 w-full rounded-bl-[80px] rounded-tr-[80px] object-cover md:h-auto md:max-w-full" />

                                <a data-fslightbox="gallery" href="{{ $v('video_url', 'https://www.youtube.com/watch?v=3nQNiWdeH2Q') }}" class="absolute inline-flex h-20 w-20 items-center justify-center rounded-[50%] border-[5px] border-colorBrightGold bg-transparent lg:h-[120px] lg:w-[120px]" aria-label="video-play">
                                    <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-play.svg') }}" alt="icon-golden-yellow-play" width="20" height="24" />
                                </a>

                                <!-- Background Element -->
                                <img src="{{ asset('assets-front/img/abstracts/abstract-orange-plus-1.svg') }}" alt="abstract-orange-plus-1" width="75" height="98" class="absolute bottom-0 left-0 z-10" />
                                <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="absolute -right-20 -top-20 -z-10" />

                                <!-- Background Element -->
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                </div>
                <!-- Section Space -->
                <!-- Section Space -->
            </div>
            <!--...::: Video Section End :::... -->

            <!--...::: Client Logo Section Start :::... -->
            <div class="section-client-logo">
                <!-- Section Background -->
                <div class="bg-white lg:-mt-[248px] lg:pt-[248px]">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="mx-auto mb-10 max-w-xl lg:mb-[60px]">
                                <p class="text-center text-lg text-colorBlackPearl" @if($fs('logos_text')) style="{{ $fs('logos_text') }}" @endif>
                                    {!! $t('logos_text', 'Bizimle iş birliği yapan <strong>250+</strong> şirketle tanışın') !!}
                                </p>
                            </div>

                            <!-- Slider main container -->
                            <div class="swiper client-slider">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper ease-linear">
                                    <!-- Slides -->
                                    @foreach($clientLogos as $logo)
                                        <div class="swiper-slide">
                                            @if($logo->url)
                                                <a href="{{ $logo->url }}" target="_blank" rel="noopener noreferrer">
                                                    <img src="{{ asset($logo->image) }}" alt="{{ $logo->name ?? 'client-logo' }}" height="40" class="mx-auto h-10 object-contain" />
                                                </a>
                                            @else
                                                <img src="{{ asset($logo->image) }}" alt="{{ $logo->name ?? 'client-logo' }}" height="40" class="mx-auto h-10 object-contain" />
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </div>
            <!--...::: Client Logo Section End :::... -->

            <!--...::: Content Section Start :::... -->
            <section class="section-content">
                <!-- Section Background -->
                <div class="relative z-10 overflow-hidden bg-colorPurpleBlue">
                    <!-- Section Container -->
                    <div class="container">
                        <!-- Content Area -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-x-28">
                            <!-- Content Left Block -->
                            <div class="relative z-10 order-2 lg:order-1">
                                <img src="{{ asset($v('cta_image', 'assets-front/img/images/th-3/content-img-3.png')) }}" alt="content-img-3" width="399" height="543" class="bottom-0 mx-auto max-w-full lg:absolute lg:left-1/2 lg:-translate-x-1/2" />
                                <img src="{{ asset('assets-front/img/abstracts/abstract-dots-4-white.svg') }}" alt="abstract-dots-4-white" width="108" height="67" class="absolute left-0 top-56 -z-10 inline-block" />
                                <div class="absolute bottom-0 left-1/2 -z-10 inline-block h-[470px] w-[470px] -translate-x-1/2 translate-y-1/4 rounded-[50%] bg-white/10 xl:h-[537px] xl:w-[537px]"></div>
                            </div>
                            <!-- Content Left Block -->
                            <!-- Content Right Block -->
                            <div class="order-1 px-6 py-[70px] sm:px-10 lg:order-2 lg:px-0 lg:py-[150px]">
                                <!-- Section Block -->
                                <div class="max-w-[530px]">
                                    <div class="jos">
                                        <span class="mb-5 block uppercase text-colorBrightGold" @if($fs('cta_label')) style="{{ $fs('cta_label') }}" @endif>{{ $t('cta_label', 'ONLİNE KURSLAR') }}</span>
                                        <h2 class="text-white" @if($fs('cta_title')) style="{{ $fs('cta_title') }}" @endif>
                                            {{ $t('cta_title', 'Geleceğiniz İçin Doğru Öğrenme Yolunu Bulun') }}
                                        </h2>
                                    </div>
                                    <p class="mb-[30px] mt-7 text-white/80" @if($fs('cta_description')) style="{{ $fs('cta_description') }}" @endif>
                                        {{ $t('cta_description', 'Profesyonel eğitmenlerimizle kariyer hedeflerinize ulaşmanız için en uygun kursları keşfedin.') }}
                                    </p>
                                    <div class="inline-block">
                                        <a href="{{ route('front.courses') }}" class="btn btn-secondary is-icon group">{{ $t('cta_button_text', 'Hemen Öğrenmeye Başlayın') }}
                                            <span class="btn-icon bg-colorBlackPearl group-hover:right-0 group-hover:translate-x-full">
                                                <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-arrow-right.svg') }}" alt="icon-golden-yellow-arrow-right" width="13" height="12" />
                                            </span>
                                            <span class="btn-icon bg-colorBlackPearl group-hover:left-[5px] group-hover:translate-x-0">
                                                <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-arrow-right.svg') }}" alt="icon-golden-yellow-arrow-right" width="13" height="12" />
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Section Block -->
                            </div>
                            <!-- Content Right Block -->
                        </div>
                        <!-- Content Area -->
                    </div>
                    <!-- Section Container -->
                    <!-- Background Element -->
                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="absolute -top-[77px] left-36 -z-10 rotate-180" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="absolute -bottom-[77px] right-36 -z-10" />
                    <!-- Background Element -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Content Section Start :::... -->
            <section class="section-content">
                <!-- Section Background -->
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Content Area -->
                            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-16 xl:gap-32">
                                <!-- Content Left Block -->
                                <div class="jos" data-jos_animation="fade-left">
                                    <!-- Section Block -->
                                    <div class="mb-6">
                                        <span class="mb-5 block uppercase" @if($fs('section2_label')) style="{{ $fs('section2_label') }}" @endif>{{ $t('section2_label', 'NEDEN BİZİ SEÇMELİSİNİZ') }}</span>
                                        <h2 @if($fs('section2_title')) style="{{ $fs('section2_title') }}" @endif>
                                            {{ $t('section2_title', 'Dijital Online Akademi: Yaratıcı Mükemmelliğe Giden Yolunuz') }}
                                        </h2>
                                    </div>
                                    <!-- Section Block -->
                                    <!-- Content Block -->
                                    <div>
                                        <p @if($fs('section2_description')) style="{{ $fs('section2_description') }}" @endif>
                                            {{ $t('section2_description', 'Alanında uzman eğitmenlerle pratik odaklı eğitim anlayışımızla fark yaratıyoruz.') }}
                                        </p>
                                        @php
                                            $s2features = $aboutPageInfo?->getTranslation('section2_features', $locale, false);
                                            if (is_string($s2features) && $s2features) {
                                                $s2features = array_values(array_filter(array_map('trim', explode("\n", $s2features))));
                                            }
                                            if (!is_array($s2features) || count($s2features) === 0) {
                                                $s2features = ['Uzman Eğitmenler', 'Online Uzaktan Eğitim', 'Kolay Takip Edilebilir Müfredat', 'Ömür Boyu Erişim'];
                                            }
                                        @endphp
                                        <ul class="mb-10 mt-6 flex flex-col gap-y-4 font-title text-colorBlackPearl">
                                            @foreach($s2features as $s2fIdx => $feature)
                                                @if(trim($feature))
                                                    <li class="flex items-center gap-x-3">
                                                        <svg class="h-5 w-5 flex-shrink-0 text-colorPurpleBlue" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                                        </svg>
                                                        <span @if($fs('s2f_'.$s2fIdx)) style="{{ $fs('s2f_'.$s2fIdx) }}" @endif>{{ trim($feature) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Content Block -->
                                </div>
                                <!-- Content Left Block -->

                                <!-- Content Right Block -->
                                <div class="jos relative mx-auto" data-jos_animation="fade-right">
                                    <img src="{{ asset($v('section2_image', 'assets-front/img/images/th-3/content-img-4.png')) }}" alt="content-img-4" width="482" height="486" class="max-w-full" />
                                    <!-- Card -->
                                    <div class="jos absolute bottom-20 left-16 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-3.5 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10 xxl:-left-16 xxxl:-left-28">
                                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tamato-emotion-laugh-line.svg') }}" alt="icon-red-tamato-emotion-laugh-line" width="28" height="28" />
                                        </div>
                                        <div>
                                            <span class="block font-title text-[28px] font-bold leading-none text-[#DF4343]">{{ $v('section2_stat_number', '3458+') }}</span>
                                            <span>{{ $t('section2_stat_text', 'Memnun Öğrenci') }}</span>
                                        </div>
                                    </div>
                                    <!-- Card -->
                                    <!-- Background Element -->
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-3.svg') }}" alt="abstract-dots-2" class="absolute -left-14 top-1/2 z-20 hidden -translate-y-1/2 animate-pulse lg:inline-block" />
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-golden-yellow-bg-black-dash-1.svg') }}" alt="abstract-dots-2" class="absolute bottom-0 right-0 z-20 hidden lg:inline-block" />
                                    <!-- Background Element -->
                                </div>
                                <!-- Content Right Block -->
                            </div>
                            <!-- Content Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Testimonial Section Start :::... -->
            <section class="section-testimonial">
                <!-- Section Background -->
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space-bottom">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 lg:mb-[60px]">
                                <div class="jos mx-auto max-w-lg text-center">
                                    <span class="mb-5 block uppercase" @if($fs('testimonial_label')) style="{{ $fs('testimonial_label') }}" @endif>{{ $t('testimonial_label', 'REFERANSLARIMIZ') }}</span>
                                    <h2 @if($fs('testimonial_title')) style="{{ $fs('testimonial_title') }}" @endif>{{ $t('testimonial_title', 'Öğrencilerimiz Hakkımızda Ne Düşünüyor') }}</h2>
                                </div>
                            </div>
                            <!-- Section Block -->
                        </div>
                        <!-- Section Container -->
                        <div class="relative md:-mx-[140px]">
                            <!-- Slider main container -->
                            <div class="swiper testimonial-slider-3">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    @php $bgColors = ['bg-colorJasper/10', 'bg-colorLightSeaGreen/10', 'bg-colorPurpleBlue/10', 'bg-colorHotPurple/10']; @endphp
                                    @foreach($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="{{ $bgColors[$loop->index % count($bgColors)] }} p-[30px]">
                                            <!-- Review Star -->
                                            <div class="inline-flex items-center gap-x-0.5">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-[18px] h-[18px] {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-300/40' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <!-- Review Star -->
                                            <blockquote class="mt-4 text-lg">
                                                "{{ $testimonial->getTranslation('quote', app()->getLocale()) }}"
                                            </blockquote>

                                            <div class="mt-8 flex items-center gap-x-4">
                                                <div class="h-11 w-11 overflow-hidden rounded-[50%]">
                                                    @if($testimonial->image)
                                                        <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" width="43" height="43" class="h-full w-full object-cover" />
                                                    @else
                                                        <div class="h-full w-full bg-fuchsia-100 flex items-center justify-center text-fuchsia-600 font-bold">
                                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <span class="block font-title text-xl font-bold text-colorBlackPearl">{{ $testimonial->name }}</span>
                                                    <span class="text-sm">{{ $testimonial->getTranslation('role', app()->getLocale()) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination static mt-14"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Testimonial Section End :::... -->

            <!--...::: FAQ Section Start :::... -->
            <section class="section-faq">
                <div class="relative z-20 overflow-hidden bg-white">
                    <!-- Section Space -->
                    <div class="section-space-bottom">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Faq Area -->
                            <div class="grid grid-cols-1 gap-y-10 lg:grid-cols-[1fr_minmax(0,0.9fr)] lg:gap-x-20 xl:gap-x-28">
                                <!-- FAQ Left Block -->
                                <div class="relative z-10 order-2 mx-auto lg:order-1">
                                    <div class="flex items-start gap-7">
                                        <img src="{{ asset($v('faq_image1', 'assets-front/img/images/th-2/faq-img-1.png')) }}" alt="faq-img-1" width="258" height="440" class="jos max-w-full rounded-lg" />
                                        <div class="hidden md:inline-block">
                                            <img src="{{ asset($v('faq_image2', 'assets-front/img/images/th-2/faq-img-2.png')) }}" alt="faq-img-2" width="258" height="172" class="jos mb-6 max-w-full rounded-lg xl:mb-14" />
                                            <img src="{{ asset($v('faq_image3', 'assets-front/img/images/th-2/faq-img-3.png')) }}" alt="faq-img-3" width="258" height="371" class="jos max-w-full rounded-lg" />
                                        </div>
                                    </div>
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="jos absolute bottom-10 left-14 -z-10 hidden rotate-180 sm:inline-block lg:bottom-36 xl:bottom-10" />
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-orange-plus-1.svg') }}" alt="abstract-element-regular" width="75" height="98" class="jos absolute right-14 top-40 hidden rotate-180 xl:inline-block" />
                                </div>
                                <!-- FAQ Left Block -->
                                <!-- FAQ Right Block -->
                                <div class="jos order-1 lg:order-2" data-jos_animation="fade-right">
                                    <!-- Section Block -->
                                    <div class="mb-6">
                                        <span class="mb-5 block uppercase" @if($fs('faq_label')) style="{{ $fs('faq_label') }}" @endif>{{ $t('faq_label', 'SIKÇA SORULAN SORULAR') }}</span>
                                        <h2 @if($fs('faq_title')) style="{{ $fs('faq_title') }}" @endif>{{ $t('faq_title', 'Online Kurslarımız Hakkında En Çok Sorulan Sorular') }}</h2>
                                    </div>
                                    <!-- Section Block -->

                                    <!-- Accordion List -->
                                    <ul class="mt-7 grid grid-cols-1 gap-y-4">
                                        @foreach($faqs as $faq)
                                        <li class="accordion-item {{ $loop->first ? 'active' : '' }} rounded-lg bg-white px-6 py-5">
                                            <!-- Accordion Header -->
                                            <div class="accordion-header flex items-center justify-between gap-6 font-title text-lg font-bold text-colorBlackPearl">
                                                <button class="flex-1 text-left">
                                                    {{ $faq->getTranslation('question', app()->getLocale()) }}
                                                </button>
                                                <div class="accordion-icon">
                                                    <img src="{{ asset('assets-front/img/icons/icon-dark-arrow-solid-down.svg') }}" alt="icon-dark-arrow-solid-down" width="13" height="7" />
                                                </div>
                                            </div>
                                            <!-- Accordion Header -->
                                            <!-- Accordion Body -->
                                            <div class="accordion-body">
                                                <p class="pt-5">
                                                    {{ $faq->getTranslation('answer', app()->getLocale()) }}
                                                </p>
                                            </div>
                                            <!-- Accordion Body -->
                                        </li>
                                        @endforeach
                                    </ul>
                                    <!-- Accordion List -->
                                </div>
                                <!-- FAQ Right Block -->
                            </div>
                            <!-- Faq Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: FAQ Section End :::... -->

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
                                    <span class="mb-5 block uppercase" @if($fs('blog_label')) style="{{ $fs('blog_label') }}" @endif>{{ $t('blog_label', 'HABERLER') }}</span>
                                    <h2 @if($fs('blog_title')) style="{{ $fs('blog_title') }}" @endif>{{ $t('blog_title', 'Son Yazılarımız') }}</h2>
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
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Blog Section End :::... -->
@endsection
