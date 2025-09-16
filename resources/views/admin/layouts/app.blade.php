<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Parosis Akademi')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    @yield('styles')

</head>

<body class="h-screen relative bg-[#FAFAFB]" style="font-family: plus-jakarta-sans, sans-serif;">
    @include('admin.layouts.toast')
    @include('admin.layouts.navbar')
    @include('admin.layouts.aside')

    <div class="p-4 sm:ml-64 flex flex-col h-full ">
        <div class="p-4 mt-14 flex-1">
            @hasSection('page-banner')
                <div class=" pb-4 rounded-lg ">
                    <div class="w-full py-5 px-8 rounded-lg flex items-center justify-between gap-2">
                        @yield('page-banner')
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
        <footer>
            <div class="px-4 text-center">
                <p class="text-gray-500  text-end text-xs">
                    © 2023 Corwus. All rights reserved.
                </p>
            </div>
        </footer>
    </div>

    @yield('scripts')

</body>

</html>
