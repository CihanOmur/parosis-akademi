@extends('front.layouts.app')

@section('title', 'Parosis Akademi | ' . $course->getTranslation('title', app()->getLocale()))

@section('content')
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

            <!--...::: Breadcrumb Section Start :::... -->
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden bg-[#FAF9F6]">
                    <!-- Section Space -->
                    <div class="py-[60px] lg:py-[90px]">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="text-center">
                                <h1 class="mb-5 text-4xl capitalize tracking-normal" @if($fs('detail_breadcrumb_current')) style="{{ $fs('detail_breadcrumb_current') }}" @endif>
                                    {{ $coursePageInfo?->getTranslation('detail_breadcrumb_current', app()->getLocale()) ?: 'Kurs Detayı' }}
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}" @if($fs('breadcrumb_home')) style="{{ $fs('breadcrumb_home') }}" @endif>{{ $coursePageInfo?->getTranslation('breadcrumb_home', app()->getLocale()) ?: 'ANA SAYFA' }}</a>
                                        </li>
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.courses') }}" @if($fs('breadcrumb_current')) style="{{ $fs('breadcrumb_current') }}" @endif>{{ $coursePageInfo?->getTranslation('breadcrumb_current', app()->getLocale()) ?: 'KURSLAR' }}</a>
                                        </li>
                                        <li>{{ Str::limit($course->getTranslation('title', app()->getLocale()), 40) }}</li>
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
            <section class="section-course">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Course Details Area -->
                            <div class="grid grid-cols-1 gap-x-[30px] gap-y-10 lg:grid-cols-[1fr_minmax(0,360px)]">
                                <!-- Course Details Content -->
                                <div class="jos">
                                    @if($course->image)
                                    <img src="{{ asset($course->image) }}" alt="{{ $course->getTranslation('title', app()->getLocale()) }}" width="783" height="479" class="max-w-full rounded-xl shadow-sm" />
                                    @endif

                                    <div class="rich-text-area mt-11">
                                        <h2 class="text-2xl font-bold lg:text-3xl">{{ $course->getTranslation('title', app()->getLocale()) }}</h2>

                                        <div class="mt-6 text-base leading-relaxed text-[#5f5d5d]">
                                            {!! $course->getTranslation('content', app()->getLocale()) !!}
                                        </div>

                                        @if($course->getTranslation('what_you_learn', app()->getLocale()))
                                        <div class="mt-10 rounded-xl border border-colorPurpleBlue/10 bg-gradient-to-br from-[#F8F7FF] to-[#F1F0FB] p-6 lg:p-8">
                                            <div class="mb-5 flex items-center gap-3">
                                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-colorPurpleBlue/10">
                                                    <svg class="h-5 w-5 text-colorPurpleBlue" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                                                    </svg>
                                                </div>
                                                <h5 class="text-xl font-bold" @if($fs('detail_what_learn_title')) style="{{ $fs('detail_what_learn_title') }}" @endif>{{ $coursePageInfo?->getTranslation('detail_what_learn_title', app()->getLocale()) ?: 'Neler Öğreneceksiniz?' }}</h5>
                                            </div>
                                            <div class="course-checklist course-checklist--learn">
                                                {!! $course->getTranslation('what_you_learn', app()->getLocale()) !!}
                                            </div>
                                        </div>
                                        @endif

                                        @if($course->inner_image)
                                        <img src="{{ asset($course->inner_image) }}" alt="{{ $course->getTranslation('title', app()->getLocale()) }}" width="783" height="353" class="mt-8 max-w-full rounded-xl shadow-sm" />
                                        @endif
                                    </div>

                                    @if($course->getTranslation('why_choose', app()->getLocale()))
                                    <div class="mt-10 rounded-xl border border-colorBrightGold/20 bg-gradient-to-br from-[#FFFDF5] to-[#FFF9E6] p-6 lg:p-8">
                                        <div class="mb-5 flex items-center gap-3">
                                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-colorBrightGold/15">
                                                <svg class="h-5 w-5 text-[#B8960C]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                                                </svg>
                                            </div>
                                            <h5 class="text-xl font-bold" @if($fs('detail_why_choose_title')) style="{{ $fs('detail_why_choose_title') }}" @endif>{{ $coursePageInfo?->getTranslation('detail_why_choose_title', app()->getLocale()) ?: 'Neden Bu Kurs?' }}</h5>
                                        </div>
                                        <div class="course-checklist course-checklist--why">
                                            {!! $course->getTranslation('why_choose', app()->getLocale()) !!}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <!-- Course Details Content -->

                                <!-- Aside Bar -->
                                <aside class="jos">
                                    <ul class="grid grid-cols-1 gap-y-9">
                                        <!-- Course Information -->
                                        <li class="rounded-lg bg-[#f5f5f5] px-[30px] py-6">
                                            <h5 class="mb-7" @if($fs('sidebar_info_title')) style="{{ $fs('sidebar_info_title') }}" @endif>{{ $coursePageInfo?->getTranslation('sidebar_info_title', app()->getLocale()) ?: 'Kurs Bilgileri:' }}</h5>
                                            <ul class="divide-y divide-[#E9E5DA]">
                                                @if($course->price)
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]" @if($fs('sidebar_price_label')) style="{{ $fs('sidebar_price_label') }}" @endif>{{ $coursePageInfo?->getTranslation('sidebar_price_label', app()->getLocale()) ?: 'Fiyat:' }}</span>
                                                    <span class="font-bold text-colorPurpleBlue">{{ $course->price }}</span>
                                                </li>
                                                @endif
                                                @if($course->instructor_name)
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]" @if($fs('sidebar_instructor_label')) style="{{ $fs('sidebar_instructor_label') }}" @endif>{{ $coursePageInfo?->getTranslation('sidebar_instructor_label', app()->getLocale()) ?: 'Eğitmen:' }}</span>
                                                    <span class="font-normal">{{ $course->instructor_name }}</span>
                                                </li>
                                                @endif
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]" @if($fs('sidebar_certification_label')) style="{{ $fs('sidebar_certification_label') }}" @endif>{{ $coursePageInfo?->getTranslation('sidebar_certification_label', app()->getLocale()) ?: 'Sertifika:' }}</span>
                                                    <span class="font-normal">{{ $course->has_certification ? 'Evet' : 'Hayır' }}</span>
                                                </li>
                                                @if($course->lesson_count)
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]" @if($fs('sidebar_lessons_label')) style="{{ $fs('sidebar_lessons_label') }}" @endif>{{ $coursePageInfo?->getTranslation('sidebar_lessons_label', app()->getLocale()) ?: 'Dersler:' }}</span>
                                                    <span class="font-normal">{{ $course->lesson_count }}</span>
                                                </li>
                                                @endif
                                                @if($course->duration)
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]" @if($fs('sidebar_duration_label')) style="{{ $fs('sidebar_duration_label') }}" @endif>{{ $coursePageInfo?->getTranslation('sidebar_duration_label', app()->getLocale()) ?: 'Süre:' }}</span>
                                                    <span class="font-normal">{{ $course->duration }}</span>
                                                </li>
                                                @endif
                                                @if($course->language)
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]" @if($fs('sidebar_language_label')) style="{{ $fs('sidebar_language_label') }}" @endif>{{ $coursePageInfo?->getTranslation('sidebar_language_label', app()->getLocale()) ?: 'Dil:' }}</span>
                                                    <span class="font-normal">{{ $course->language }}</span>
                                                </li>
                                                @endif
                                                @if($course->student_count)
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]" @if($fs('sidebar_students_label')) style="{{ $fs('sidebar_students_label') }}" @endif>{{ $coursePageInfo?->getTranslation('sidebar_students_label', app()->getLocale()) ?: 'Öğrenciler:' }}</span>
                                                    <span class="font-normal">{{ $course->student_count }}</span>
                                                </li>
                                                @endif
                                            </ul>
                                        </li>
                                        <!-- Course Information -->

                                        <!-- Contact Us -->
                                        <li class="rounded-lg bg-[#f5f5f5] px-[30px] py-6">
                                            <h5 class="mb-7" @if($fs('sidebar_contact_title')) style="{{ $fs('sidebar_contact_title') }}" @endif>{{ $coursePageInfo?->getTranslation('sidebar_contact_title', app()->getLocale()) ?: 'İletişim' }}</h5>
                                            <ul class="flex flex-col gap-y-3">
                                                @if($coursePageInfo?->getTranslation('sidebar_contact_phone', app()->getLocale()))
                                                <li class="inline-flex gap-x-6">
                                                    <div class="h-7 w-auto">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-phone-ring.svg') }}" alt="phone" width="28" height="28" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="block" @if($fs('sidebar_contact_phone_label')) style="{{ $fs('sidebar_contact_phone_label') }}" @endif>{{ $coursePageInfo->getTranslation('sidebar_contact_phone_label', app()->getLocale()) ?: '7/24 Destek' }}</span>
                                                        <a href="tel:{{ preg_replace('/\s+/', '', $coursePageInfo->getTranslation('sidebar_contact_phone', app()->getLocale())) }}" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">{{ $coursePageInfo->getTranslation('sidebar_contact_phone', app()->getLocale()) }}</a>
                                                    </div>
                                                </li>
                                                @endif
                                                @if($coursePageInfo?->getTranslation('sidebar_contact_email', app()->getLocale()))
                                                <li class="inline-flex gap-x-6">
                                                    <div class="h-7 w-auto">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-mail-open.svg') }}" alt="email" width="28" height="28" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="block" @if($fs('sidebar_contact_email_label')) style="{{ $fs('sidebar_contact_email_label') }}" @endif>{{ $coursePageInfo->getTranslation('sidebar_contact_email_label', app()->getLocale()) ?: 'Mesaj Gönderin' }}</span>
                                                        <a href="mailto:{{ $coursePageInfo->getTranslation('sidebar_contact_email', app()->getLocale()) }}" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">{{ $coursePageInfo->getTranslation('sidebar_contact_email', app()->getLocale()) }}</a>
                                                    </div>
                                                </li>
                                                @endif
                                                @if($coursePageInfo?->getTranslation('sidebar_contact_address', app()->getLocale()))
                                                <li class="inline-flex gap-x-6">
                                                    <div class="h-7 w-auto">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-location.svg') }}" alt="location" width="28" height="28" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="block" @if($fs('sidebar_contact_address_label')) style="{{ $fs('sidebar_contact_address_label') }}" @endif>{{ $coursePageInfo->getTranslation('sidebar_contact_address_label', app()->getLocale()) ?: 'Adresimiz' }}</span>
                                                        <address class="font-title text-xl not-italic text-colorBlackPearl" @if($fs('sidebar_contact_address')) style="{{ $fs('sidebar_contact_address') }}" @endif>
                                                            {!! nl2br(e($coursePageInfo->getTranslation('sidebar_contact_address', app()->getLocale()))) !!}
                                                        </address>
                                                    </div>
                                                </li>
                                                @endif
                                            </ul>
                                        </li>
                                        <!-- Contact Us -->
                                    </ul>
                                </aside>
                                <!-- Aside Bar -->
                            </div>
                            <!-- Course Details Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Course Section End :::... -->
@endsection
