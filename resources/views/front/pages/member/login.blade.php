@extends('front.layouts.app')

@section('title', ($globalSettings['seo']['meta_title'] ?? 'Parosis Akademi') . ' | ' . __('member.login'))

@section('content')
    @include('front.partials.member-breadcrumb', ['title' => __('member.login'), 'current' => __('member.login')])

    <section class="section-member">
        <div class="bg-white">
            <div class="section-space">
                <div class="container">
                    <div class="mx-auto flex w-fit flex-col items-center rounded-lg bg-white px-6 py-[30px] shadow-[0_4px_30px_16px] shadow-[#070229]/5 sm:px-[75px] lg:py-10">
                        <p class="mb-7 text-center">
                            {{ __('member.no_account') }}
                            <a href="{{ route('front.member.register') }}" class="text-colorPurpleBlue">{{ __('member.register') }}</a>
                        </p>
                        @include('front.partials.member-login-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
