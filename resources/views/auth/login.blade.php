<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ \App\Models\Setting::get('site_name', 'Parosis Akademi') }} - Giriş</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body class="font-sans antialiased">
    @php
        $adminLogo = \App\Models\Setting::get('admin_logo', '', 'logos');
        $logoSrc = $adminLogo
            ? asset(ltrim($adminLogo, '/'))
            : '/images/corwus-board-logo.svg';
        $siteName = \App\Models\Setting::get('site_name', 'Parosis Akademi');
    @endphp

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-100 via-slate-200 to-slate-100 animate-gradient relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-slate-400/20 rounded-full blur-3xl animate-float"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-slate-300/30 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-slate-400/10 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>
        </div>

        <!-- Logo -->
        <div class="relative z-10">
            <a href="/" class="flex justify-center mb-8 transition-transform duration-300 hover:scale-105">
                <img class="h-28 sm:h-32 w-auto object-contain drop-shadow-lg" src="{{ $logoSrc }}" alt="{{ $siteName }}">
            </a>
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white/90 backdrop-blur-md shadow-2xl overflow-hidden rounded-2xl relative z-10 border border-slate-200">
            <div class="absolute top-0 left-0 w-full h-1 bg-slate-900"></div>

            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-slate-900">Hoş Geldiniz</h2>
                <p class="mt-2 text-sm text-slate-600">Devam etmek için hesabınıza giriş yapın</p>
            </div>

            @if ($errors->has('email'))
                <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200">
                    <p class="text-sm text-red-600">{{ $errors->first('email') }}</p>
                </div>
            @endif

            @if (session('status'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-50 border border-emerald-200">
                    <p class="text-sm text-emerald-700">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('loginPost') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div class="group">
                    <label for="email" class="block text-sm font-medium text-slate-700">E-posta veya Kullanıcı Adı</label>
                    <div class="relative mt-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-slate-900 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                               placeholder="ornek@parosis.com"
                               class="block w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 text-sm placeholder-slate-400 focus:ring-2 focus:ring-slate-500 focus:border-transparent focus:bg-white outline-none transition-all">
                    </div>
                </div>

                <!-- Password -->
                <div class="group">
                    <label for="password" class="block text-sm font-medium text-slate-700">Şifre</label>
                    <div class="relative mt-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-slate-900 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                               placeholder="Şifrenizi girin"
                               class="block w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 text-sm placeholder-slate-400 focus:ring-2 focus:ring-slate-500 focus:border-transparent focus:bg-white outline-none transition-all">
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember" class="inline-flex items-center cursor-pointer group">
                        <input id="remember" type="checkbox" name="remember"
                               class="rounded border-slate-300 text-slate-900 shadow-sm focus:ring-slate-500 cursor-pointer transition-all">
                        <span class="ms-2 text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Beni hatırla</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-slate-700 hover:text-slate-900 transition-colors" href="{{ route('password.request') }}">
                            Şifremi unuttum?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full flex justify-center items-center px-4 py-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transform hover:scale-[1.02] transition-all duration-200 cursor-pointer">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Giriş Yap
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-slate-500 text-sm relative z-10">
            <p>&copy; {{ date('Y') }} {{ $siteName }}. Tüm hakları saklıdır.</p>
        </div>
    </div>

    @yield('scripts')
</body>

</html>
