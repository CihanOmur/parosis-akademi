<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Parosis Akademi - Login')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="h-screen relative bg-[#FAFAFB]" style="font-family: plus-jakarta-sans, sans-serif;">


  <div class="h-full w-full md:w-w-1/3 flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 ">
          <img class="w-52 mr-2" src="https://parosisakademi.com/images/corwus-board-logo.svg" alt="logo">    
      </a>
      <div class="w-full bg-white rounded-lg border border-gray-200 md:mt-0 sm:max-w-md xl:p-0">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <form action="{{ route('loginPost') }}" method="POST" class="space-y-4 md:space-y-6">
                    @csrf
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">E-posta veya Kullanıcı Adı</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="ornek@parosis.com" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Şifrenizi girin</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                  </div>
                  
                  <button type="submit" class="w-full cursor-pointer  text-white bg-gray-700 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-4 text-center ">Giriş Yap</button>
                 @if ($errors->has('email'))
                  <p class="text-sm font-light text-red-500">
                      {{ $errors->first('email') }}
                  </p>
                  @endif
                  
              </form>
          </div>
      </div>
  </div>
    @yield('scripts')

</body>

</html>
