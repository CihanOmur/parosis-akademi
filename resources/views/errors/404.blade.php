<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Parosis Akademi')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">


</head>

<body class="h-screen relative bg-[#FAFAFB] flex items-center justify-center h-screen"
    style="font-family: 'Plus Jakarta Sans', sans-serif;">


    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-blue-600 dark:text-blue-500">
                404
            </h1>
            <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
                Sayfa bulunamadı
            </p>
            <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Üzgünüz, bu sayfayı bulamıyoruz. Ana
                sayfada keşfedilecek çok şey bulacaksınız.</p>
            <a href="{{ route('students.index') }}"
                class="inline-flex text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">Ana
                Sayfaya Dön</a>
        </div>
    </div>


</body>

</html>
