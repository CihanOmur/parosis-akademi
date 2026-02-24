<!doctype html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Parosis Akademi | Geleceğin Teknolojisine Yön Veren Akademi')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets-front/img/favicon.ico') }}" type="image/x-icon" />

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
</body>

</html>
