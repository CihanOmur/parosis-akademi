<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\Setting::get('site_name', 'Parosis Akademi') }} - Giriş</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .login-card {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        }
        .input-focus:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
        }
        .pattern-overlay {
            background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0);
            background-size: 40px 40px;
        }
    </style>
</head>

<body class="h-screen gradient-bg">
    <div class="pattern-overlay h-full w-full flex items-center justify-center p-4">
        <div class="login-card w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            @php
                $adminLogo = \App\Models\Setting::get('admin_logo', '', 'logos');
                $logoSrc = $adminLogo
                    ? asset(ltrim($adminLogo, '/'))
                    : '/images/corwus-board-logo.svg';
                $logoAlt = \App\Models\Setting::get('site_name', 'Parosis Akademi');
            @endphp
            <div class="bg-slate-900 px-8 py-8 text-center">
                <img class="h-10 mx-auto mb-3" src="{{ $logoSrc }}" alt="{{ $logoAlt }}">
                <p class="text-slate-400 text-sm">Yönetim Paneli</p>
            </div>

            <!-- Form -->
            <div class="px-8 py-8">
                <h2 class="text-xl font-semibold text-slate-800 mb-1">Hoş Geldiniz</h2>
                <p class="text-slate-500 text-sm mb-6">Devam etmek için giriş yapın</p>

                @if ($errors->has('email'))
                    <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200">
                        <p class="text-sm text-red-600">{{ $errors->first('email') }}</p>
                    </div>
                @endif

                <form action="{{ route('loginPost') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block mb-1.5 text-sm font-medium text-slate-700">E-posta veya Kullanıcı Adı</label>
                        <input type="email" name="email" id="email"
                            class="input-focus w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm placeholder-slate-400 outline-none transition-all"
                            placeholder="ornek@parosis.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div>
                        <label for="password" class="block mb-1.5 text-sm font-medium text-slate-700">Şifre</label>
                        <input type="password" name="password" id="password"
                            class="input-focus w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm placeholder-slate-400 outline-none transition-all"
                            placeholder="Şifrenizi girin" required>
                    </div>
                    <button type="submit"
                        class="btn-primary w-full text-white font-medium rounded-xl text-sm px-5 py-3.5 text-center cursor-pointer">
                        Giriş Yap
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="px-8 pb-6 text-center">
                <p class="text-xs text-slate-400">&copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'Parosis Akademi') }}. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </div>
    @yield('scripts')
</body>

</html>
