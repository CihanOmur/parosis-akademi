<!doctype html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', $globalSettings['seo']['meta_title'] ?? 'Parosis Akademi')</title>

    <!-- SEO Meta -->
    @if(!empty($globalSettings['seo']['meta_description']))
    <meta name="description" content="{{ $globalSettings['seo']['meta_description'] }}">
    @endif
    @if(!empty($globalSettings['seo']['meta_keywords']))
    <meta name="keywords" content="{{ $globalSettings['seo']['meta_keywords'] }}">
    @endif

    <!-- Favicon -->
    @if(!empty($globalSettings['logos']['favicon']))
    <link rel="shortcut icon" href="{{ asset($globalSettings['logos']['favicon']) }}" type="image/x-icon" />
    @else
    <link rel="shortcut icon" href="{{ asset('assets-front/img/favicon.ico') }}" type="image/x-icon" />
    @endif

    <!-- Site font -->
    <link rel="stylesheet" href="{{ asset('assets-front/fonts/webfonts/poppins/stylesheet.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-front/fonts/webfonts/aeonik-pro-trial/stylesheet.css') }}" />

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets-front/css/vendors/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-front/css/vendors/jos.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-front/css/vendors/menu.css') }}" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets-front/css/custom.css') }}" />

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/front.css'])

    @stack('styles')

    {{-- Google Analytics --}}
    @if(!empty($globalSettings['seo']['google_analytics_id']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $globalSettings['seo']['google_analytics_id'] }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $globalSettings['seo']['google_analytics_id'] }}');</script>
    @endif

    {{-- Google Tag Manager --}}
    @if(!empty($globalSettings['seo']['google_tag_manager_id']))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $globalSettings['seo']['google_tag_manager_id'] }}');</script>
    @endif

    {{-- Custom Head Code --}}
    {!! $globalSettings['advanced']['custom_head_code'] ?? '' !!}
</head>

<body class="element-wrapper bg-[#FAF9F6]">
    <div class="page-wrapper relative">
        @include('front.partials.header')
        @include('front.partials.modals')

        <!-- Overlay -->
        <div class="overlay-bg absolute inset-0 z-40 hidden bg-black/50" onclick="hideElement()"></div>

        <!-- Main Wrapper -->
        <main class="main-wrapper relative">
            @yield('content')
        </main>

        @include('front.partials.footer')

        <!-- Scroll to Top Button -->
        <button id="scrollTopBtn" title="Go to top">Top</button>
    </div>

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-content">
            <span class="typing-animation">Parosis</span>
        </div>
    </div>

    <!--Vendor js-->
    <script src="{{ asset('assets-front/js/vendors/counterup.js') }}" type="module"></script>
    <script src="{{ asset('assets-front/js/vendors/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/vendors/fslightbox.js') }}"></script>
    <script src="{{ asset('assets-front/js/vendors/jos.min.js') }}"></script>
    <script src="{{ asset('assets-front/js/vendors/menu.js') }}"></script>

    <!-- Main js -->
    <script src="{{ asset('assets-front/js/main.js') }}"></script>

    @stack('scripts')

    {{-- Custom Body Code --}}
    {!! $globalSettings['advanced']['custom_body_code'] ?? '' !!}
</body>

</html>
