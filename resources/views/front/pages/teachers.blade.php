@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Eğitmenler')

@section('content')
            <!--...::: Breadcrumb Section Start :::... -->
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden bg-[#FAF9F6]">
                    <!-- Section Space -->
                    <div class="py-[60px] lg:py-[90px]">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="text-center">
                                <h1 class="mb-5 text-4xl capitalize tracking-normal">
                                    {{ $teacherPageInfo?->getTranslation('title', app()->getLocale()) ?: 'Eğitmenlerimiz' }}
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">{{ $teacherPageInfo?->getTranslation('breadcrumb_home', app()->getLocale()) ?: 'ANA SAYFA' }}</a>
                                        </li>
                                        <li>{{ $teacherPageInfo?->getTranslation('breadcrumb_current', app()->getLocale()) ?: 'EĞİTMENLER' }}</li>
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

            <!--...::: Teacher Section Start :::... -->
            <div class="section-teacher">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            @if($teachers->count() > 0)
                            <!-- Instructor List -->
                            <ul class="grid grid-cols-1 gap-[30px] sm:grid-cols-2 md:grid-cols-3">
                                @foreach($teachers as $teacher)
                                <!-- Instructor Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group">
                                        <!-- Thumbnail -->
                                        <div class="relative overflow-hidden rounded-lg">
                                            @if($teacher->image)
                                                <img src="{{ asset($teacher->image) }}" alt="{{ $teacher->getTranslation('name', app()->getLocale()) }}" class="h-full w-full object-cover" />
                                            @else
                                                <div class="h-[320px] w-full bg-gray-100 flex items-center justify-center">
                                                    <svg class="w-16 h-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <!-- Overlay -->
                                            @if($teacher->facebook_url || $teacher->twitter_url || $teacher->dribbble_url || $teacher->instagram_url)
                                            <div class="absolute inset-0 flex translate-y-full items-end justify-center bg-gradient-to-t from-colorBlackPearl/65 to-colorBlackPearl/0 px-5 py-7 opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                                <!-- Social Links -->
                                                <div class="flex translate-y-10 items-center justify-center gap-x-6 opacity-0 transition-all delay-300 duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                                    @if($teacher->facebook_url)
                                                    <a href="{{ $teacher->facebook_url }}" target="_blank" rel="noopener noreferrer" class="translate-y-0 hover:-translate-y-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-white-facebook.svg') }}" alt="facebook" width="22" height="22" />
                                                    </a>
                                                    @endif
                                                    @if($teacher->twitter_url)
                                                    <a href="{{ $teacher->twitter_url }}" target="_blank" rel="noopener noreferrer" class="translate-y-0 hover:-translate-y-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-white-twitter.svg') }}" alt="twitter" width="22" height="22" />
                                                    </a>
                                                    @endif
                                                    @if($teacher->dribbble_url)
                                                    <a href="{{ $teacher->dribbble_url }}" target="_blank" rel="noopener noreferrer" class="translate-y-0 hover:-translate-y-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-white-dribbble.svg') }}" alt="dribbble" width="22" height="22" />
                                                    </a>
                                                    @endif
                                                    @if($teacher->instagram_url)
                                                    <a href="{{ $teacher->instagram_url }}" target="_blank" rel="noopener noreferrer" class="translate-y-0 hover:-translate-y-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-white-instagram.svg') }}" alt="instagram" width="22" height="22" />
                                                    </a>
                                                    @endif
                                                </div>
                                                <!-- Social Links -->
                                            </div>
                                            @endif
                                            <!-- Overlay -->
                                        </div>
                                        <!-- Thumbnail -->

                                        <!-- Content -->
                                        <div class="mt-6">
                                            <span class="mb-2 block text-sm">{{ $teacher->getTranslation('title', app()->getLocale()) }}</span>
                                            <a href="{{ route('front.teacher.details', $teacher->id) }}" class="block font-title text-xl font-bold text-colorBlackPearl">{{ $teacher->getTranslation('name', app()->getLocale()) }}</a>
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Instructor Item -->
                                @endforeach
                            </ul>
                            <!-- Instructor List -->
                            @else
                            <p class="text-center text-gray-500 py-16">Henüz eğitmen eklenmemiş.</p>
                            @endif
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </div>
            <!--...::: Teacher Section End :::... -->
@endsection
