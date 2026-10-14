@extends('front.layouts.app')

@php
    $locale = app()->getLocale();
    $privacyTitle = $privacyPageInfo?->getTranslation('title', $locale) ?: 'Gizlilik Politikası';
    $privacyContent = $privacyPageInfo?->getTranslation('content', $locale);
@endphp

@section('title', ($globalSettings['seo']['meta_title'] ?? 'Parosis Akademi') . ' | ' . $privacyTitle)

@push('styles')
    <style>
        .privacy-content { max-width: 860px; margin: 0 auto; }
        .privacy-content h2 { font-size: 1.5rem; line-height: 1.4; }
        .privacy-content h3 { font-size: 1.25rem; line-height: 1.4; }
        .privacy-content ul { list-style: disc; padding-left: 1.5rem; }
        .privacy-content ol { list-style: decimal; padding-left: 1.5rem; }
        .privacy-content li + li { margin-top: 0.5rem; }
        .privacy-content a { color: rgb(84 62 232); text-decoration: underline; text-underline-offset: 2px; }
        .privacy-content table { width: 100%; border-collapse: collapse; }
        .privacy-content th, .privacy-content td { border: 1px solid rgb(1 28 26 / 0.1); padding: 0.5rem 0.75rem; text-align: left; }
    </style>
@endpush

@section('content')
            <!--...::: Breadcrumb Section Start :::... -->
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden" style="background-color: #FAF9F6;">
                    <!-- Section Space -->
                    <div class="py-[60px] lg:py-[90px]">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="text-center">
                                <h1 class="mb-5 text-4xl capitalize tracking-normal">
                                    {!! nl2br(e($privacyTitle)) !!}
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">{{ $privacyPageInfo?->getTranslation('breadcrumb_home', $locale) ?: 'ANA SAYFA' }}</a>
                                        </li>
                                        <li>{{ $privacyPageInfo?->getTranslation('breadcrumb_current', $locale) ?: 'GİZLİLİK POLİTİKASI' }}</li>
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

            <!--...::: Privacy Section Start :::... -->
            <section class="section-privacy">
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="privacy-content rich-text-area jos">
                                @if($privacyContent)
                                    {!! $privacyContent !!}
                                @else
                                    <p>Gizlilik politikası metni hazırlanmaktadır.</p>
                                @endif
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Privacy Section End :::... -->
@endsection
