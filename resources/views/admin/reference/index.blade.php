@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">UI Referans Sayfası</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Admin panelinde kullanılan tüm form elemanları ve UI bileşenleri</p>
    </div>
@endsection

@section('content')
<div x-data="{ activeSection: 'all' }" class="space-y-6">

    {{-- Navigation --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-4">
        <div class="flex flex-wrap gap-2">
            <button @click="activeSection = 'all'" :class="activeSection === 'all' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Tümü</button>
            <button @click="activeSection = 'inputs'" :class="activeSection === 'inputs' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Text Inputs</button>
            <button @click="activeSection = 'selects'" :class="activeSection === 'selects' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Select & Dropdown</button>
            <button @click="activeSection = 'checkboxes'" :class="activeSection === 'checkboxes' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Checkbox & Toggle</button>
            <button @click="activeSection = 'uploads'" :class="activeSection === 'uploads' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Dosya Yükleme</button>
            <button @click="activeSection = 'buttons'" :class="activeSection === 'buttons' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Butonlar</button>
            <button @click="activeSection = 'special'" :class="activeSection === 'special' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Özel Bileşenler</button>
            <button @click="activeSection = 'layout'" :class="activeSection === 'layout' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Layout & Kartlar</button>
            <button @click="activeSection = 'feedback'" :class="activeSection === 'feedback' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">Hata & Bilgi</button>
        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- 1. TEXT INPUTS --}}
    {{-- ═══════════════════════════════════════ --}}
    <div x-show="activeSection === 'all' || activeSection === 'inputs'" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
            <div class="w-9 h-9 rounded-xl bg-fuchsia-100 dark:bg-fuchsia-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4.5 h-4.5 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/></svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Text Inputs</h3>
                <p class="text-xs text-slate-400 mt-0.5">Metin, sayı, tarih, e-posta, telefon, URL, şifre, textarea</p>
            </div>
        </div>
        <div class="divide-y divide-slate-200/80 dark:divide-slate-700/50">

            {{-- 1a. Standart Text Input --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=text]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Standart Text Input</span>
                    <span class="text-xs text-slate-400">— faq, teacher, slider, blog, category</span>
                </div>
                <div class="max-w-md space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Alan Adı</label>
                    <input type="text" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all" placeholder="Placeholder metin..." value="">
                </div>
            </div>

            {{-- 1b. Text Input with Icon --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input + icon</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Ikonlu Text Input</span>
                    <span class="text-xs text-slate-400">— students/create</span>
                </div>
                <div class="max-w-md space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Ad Soyad</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0"/></svg>
                        </span>
                        <input type="text" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all" placeholder="Ad Soyad">
                    </div>
                </div>
            </div>

            {{-- 1c. Border-style Input --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input border</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Border Stilli Input</span>
                    <span class="text-xs text-slate-400">— classes/create</span>
                </div>
                <div class="max-w-md space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sınıf Adı</label>
                    <input type="text" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400 transition-colors" placeholder="Sınıf adı girin">
                </div>
            </div>

            {{-- 1d. Number Input with Unit --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=number]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Sayı Input (Birimli)</span>
                    <span class="text-xs text-slate-400">— classes/create</span>
                </div>
                <div class="max-w-xs space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Kontenjan</label>
                    <div class="relative">
                        <input type="number" min="1" placeholder="15" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white pl-4 pr-12 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400 transition-colors">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400 pointer-events-none">kişi</span>
                    </div>
                </div>
            </div>

            {{-- 1e. Currency Input --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=number step=0.01]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Para Birimi Input</span>
                    <span class="text-xs text-slate-400">— students-payments/create</span>
                </div>
                <div class="max-w-xs space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tutar</label>
                    <input type="number" step="0.01" min="0" placeholder="0.00" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                </div>
            </div>

            {{-- 1f. Date Input --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=date]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Tarih Seçici</span>
                    <span class="text-xs text-slate-400">— students, classes, payments</span>
                </div>
                <div class="max-w-xs space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tarih</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                        </span>
                        <input type="date" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-sky-500/60 transition-all">
                    </div>
                </div>
            </div>

            {{-- 1g. Datetime-local --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=datetime-local]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Tarih-Saat Seçici</span>
                    <span class="text-xs text-slate-400">— blog/create</span>
                </div>
                <div class="max-w-xs space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Yayın Tarihi</label>
                    <input type="datetime-local" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-slate-900 dark:text-white text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                </div>
            </div>

            {{-- 1h. Email Input --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=email]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">E-posta Input</span>
                    <span class="text-xs text-slate-400">— students, users</span>
                </div>
                <div class="max-w-md space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">E-posta</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                        </span>
                        <input type="email" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all" placeholder="ornek@parosis.com">
                    </div>
                </div>
            </div>

            {{-- 1i. Phone Input --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=tel]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Telefon Input (Numerik)</span>
                    <span class="text-xs text-slate-400">— students/create</span>
                </div>
                <div class="max-w-md space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Telefon</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                        </span>
                        <input type="tel" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all" placeholder="05551234545">
                    </div>
                </div>
            </div>

            {{-- 1j. URL Input --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=url]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">URL Input</span>
                    <span class="text-xs text-slate-400">— client-logo/create</span>
                </div>
                <div class="max-w-md space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Web Sitesi</label>
                    <input type="url" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all" placeholder="https://example.com">
                </div>
            </div>

            {{-- 1k. Password with Toggle --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=password] + toggle</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Şifre Input (Göster/Gizle)</span>
                    <span class="text-xs text-slate-400">— users/create</span>
                </div>
                <div class="max-w-md space-y-1" x-data="{ showPass: false }">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Şifre</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                        </span>
                        <input :type="showPass ? 'text' : 'password'" class="w-full pl-10 pr-12 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all" placeholder="••••••••">
                        <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600">
                            <svg x-show="!showPass" class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            <svg x-show="showPass" x-cloak class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- 1l. Color Input --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=color]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Renk Seçici (Hex Bağlantılı)</span>
                    <span class="text-xs text-slate-400">— course/categories/create</span>
                </div>
                <div class="max-w-xs space-y-1" x-data="{ color: '#DE1EF9' }">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Renk</label>
                    <div class="flex items-center gap-3">
                        <input type="color" x-model="color" class="w-12 h-12 rounded-xl border-0 cursor-pointer bg-transparent p-0.5 ring-1 ring-slate-200 dark:ring-slate-600">
                        <input type="text" x-model="color" readonly class="w-28 px-3 py-2 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-lg text-slate-600 dark:text-slate-300 text-xs font-mono ring-1 ring-slate-200 dark:ring-slate-600">
                    </div>
                </div>
            </div>

            {{-- 1m. Textarea --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">textarea</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Textarea (resize-y)</span>
                    <span class="text-xs text-slate-400">— faq, teacher, slider, testimonial</span>
                </div>
                <div class="max-w-lg space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Açıklama</label>
                    <textarea rows="4" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all resize-y" placeholder="Açıklama yazın..."></textarea>
                </div>
            </div>

            {{-- 1n. Search Input --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=search]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Arama Input (Filtre)</span>
                    <span class="text-xs text-slate-400">— students/index, filtre panelleri</span>
                </div>
                <div class="max-w-sm space-y-1">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                        </span>
                        <input type="search" class="w-full pl-9 pr-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all" placeholder="İsim, telefon veya numara...">
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- 2. SELECT & DROPDOWN --}}
    {{-- ═══════════════════════════════════════ --}}
    <div x-show="activeSection === 'all' || activeSection === 'selects'" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
            <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4.5 h-4.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/></svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Select & Dropdown</h3>
                <p class="text-xs text-slate-400 mt-0.5">Native select, Alpine dropdown, x-checkbox-dropdown, Tom Select</p>
            </div>
        </div>
        <div class="divide-y divide-slate-200/80 dark:divide-slate-700/50">

            {{-- 2a. Native Select --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">select</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Native Select (ring stili)</span>
                    <span class="text-xs text-slate-400">— students/create (cinsiyet, kan grubu)</span>
                </div>
                <div class="max-w-xs space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Cinsiyet</label>
                    <select class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all appearance-none">
                        <option value="" disabled selected>Seçin</option>
                        <option value="Erkek">Erkek</option>
                        <option value="Kadın">Kadın</option>
                    </select>
                </div>
            </div>

            {{-- 2b. Native Select (border stili) --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">select border</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Native Select (border stili)</span>
                    <span class="text-xs text-slate-400">— classes/create (öğretmen)</span>
                </div>
                <div class="max-w-xs space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Öğretmen</label>
                    <select class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400 transition-colors">
                        <option value="">Seçin...</option>
                        <option>Ali Yılmaz</option>
                        <option>Ayşe Kaya</option>
                    </select>
                </div>
            </div>

            {{-- 2c. x-checkbox-dropdown --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-fuchsia-100 dark:bg-fuchsia-900/30 rounded text-xs font-mono text-fuchsia-600">x-checkbox-dropdown</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Checkbox Dropdown Bileşeni</span>
                    <span class="text-xs text-slate-400">— blog, course (kategori seçimi)</span>
                </div>
                <div class="max-w-sm">
                    <x-checkbox-dropdown
                        name="categories[]"
                        :items="[
                            ['id' => 1, 'name' => 'Web Geliştirme'],
                            ['id' => 2, 'name' => 'Mobil Uygulama'],
                            ['id' => 3, 'name' => 'Veri Bilimi'],
                            ['id' => 4, 'name' => 'Yapay Zeka'],
                            ['id' => 5, 'name' => 'Siber Güvenlik'],
                            ['id' => 6, 'name' => 'Bulut Bilişim'],
                        ]"
                        :selected="[2, 4]"
                        placeholder="Kategori seçin..."
                        singularLabel="kategori"
                        pluralLabel="kategori seçildi"
                        :maxVisible="4"
                        :maxSelect="3"
                    />
                    <p class="text-xs text-slate-400 mt-2">Props: name, items, selected, placeholder, singularLabel, pluralLabel, maxVisible, maxSelect, minSelect, multiple, required</p>
                </div>
            </div>

            {{-- 2c-2. x-checkbox-dropdown Tekli Mod --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-fuchsia-100 dark:bg-fuchsia-900/30 rounded text-xs font-mono text-fuchsia-600">x-checkbox-dropdown</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Tekli Seçim (Radio)</span>
                    <span class="text-xs text-slate-400">— :multiple="false"</span>
                </div>
                <div class="max-w-sm">
                    <x-checkbox-dropdown
                        name="level"
                        :items="[
                            ['id' => 1, 'name' => 'Başlangıç'],
                            ['id' => 2, 'name' => 'Orta Seviye'],
                            ['id' => 3, 'name' => 'İleri Seviye'],
                            ['id' => 4, 'name' => 'Uzman'],
                        ]"
                        :selected="[2]"
                        placeholder="Seviye seçin..."
                        singularLabel="seviye"
                        :multiple="false"
                    />
                </div>
                <pre class="text-xs text-slate-500 bg-slate-50 dark:bg-slate-700/30 rounded-lg p-3 font-mono mt-2">&lt;x-checkbox-dropdown name="level" :items="$levels" :multiple="false" /&gt;</pre>
            </div>

            {{-- 2c-3. x-checkbox-dropdown Min Select --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-fuchsia-100 dark:bg-fuchsia-900/30 rounded text-xs font-mono text-fuchsia-600">x-checkbox-dropdown</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Min/Max Seçim</span>
                    <span class="text-xs text-slate-400">— :minSelect="2" :maxSelect="4"</span>
                </div>
                <div class="max-w-sm">
                    <x-checkbox-dropdown
                        name="skills[]"
                        :items="[
                            ['id' => 1, 'name' => 'PHP'],
                            ['id' => 2, 'name' => 'JavaScript'],
                            ['id' => 3, 'name' => 'Python'],
                            ['id' => 4, 'name' => 'Go'],
                            ['id' => 5, 'name' => 'Rust'],
                            ['id' => 6, 'name' => 'TypeScript'],
                        ]"
                        :selected="[1, 2]"
                        placeholder="Beceri seçin..."
                        singularLabel="beceri"
                        pluralLabel="beceri seçildi"
                        :minSelect="2"
                        :maxSelect="4"
                    />
                </div>
                <pre class="text-xs text-slate-500 bg-slate-50 dark:bg-slate-700/30 rounded-lg p-3 font-mono mt-2">&lt;x-checkbox-dropdown name="skills[]" :items="$skills" :minSelect="2" :maxSelect="4" /&gt;</pre>
            </div>

            {{-- 2d. Alpine Inline Multi-select (Filter) --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">Alpine dropdown</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Alpine Multi-Select Filtre</span>
                    <span class="text-xs text-slate-400">— students/index (sınıf, dönem filtresi)</span>
                </div>
                <div class="max-w-sm" x-data="{
                    open: false,
                    selected: [],
                    items: [{id:1,name:'A Sınıfı'},{id:2,name:'B Sınıfı'},{id:3,name:'C Sınıfı'}],
                    toggle(id) { const i=this.selected.indexOf(id); i===-1?this.selected.push(id):this.selected.splice(i,1) },
                    label() { if(!this.selected.length) return 'Sınıf seçin...'; return this.selected.length+' sınıf seçildi'; }
                }" @click.outside="open = false">
                    <button type="button" @click="open = !open"
                        :class="selected.length ? 'ring-fuchsia-300 bg-fuchsia-50/50' : 'ring-slate-200 bg-slate-50'"
                        class="w-full flex items-center justify-between px-4 py-2.5 text-sm rounded-xl ring-1 transition-all cursor-pointer">
                        <span :class="selected.length ? 'text-fuchsia-700' : 'text-slate-400'" x-text="label()"></span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition class="absolute z-20 mt-1 w-full bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-600 shadow-lg overflow-hidden">
                        <template x-for="item in items" :key="item.id">
                            <div @click="toggle(item.id)" class="flex items-center gap-3 px-3 py-2.5 hover:bg-slate-50 transition-colors cursor-pointer">
                                <div :class="selected.includes(item.id) ? 'bg-fuchsia-500 border-fuchsia-500' : 'border-slate-300 bg-white'" class="w-4 h-4 rounded border-2 flex items-center justify-center flex-shrink-0 transition-all">
                                    <svg x-show="selected.includes(item.id)" class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                <span class="text-sm text-slate-700" x-text="item.name"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- 3. CHECKBOX & TOGGLE --}}
    {{-- ═══════════════════════════════════════ --}}
    <div x-show="activeSection === 'all' || activeSection === 'checkboxes'" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
            <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4.5 h-4.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Checkbox & Toggle</h3>
                <p class="text-xs text-slate-400 mt-0.5">Checkbox, toggle switch, radio-button, rol seçim kartları</p>
            </div>
        </div>
        <div class="divide-y divide-slate-200/80 dark:divide-slate-700/50">

            {{-- 3a. Standard Checkbox --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">input[type=checkbox]</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Standart Checkbox</span>
                    <span class="text-xs text-slate-400">— course/create</span>
                </div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-fuchsia-500 focus:ring-fuchsia-500/60 dark:bg-slate-700 dark:border-slate-600">
                    <span class="text-sm text-slate-700 dark:text-slate-300">Sertifika Verilecek</span>
                </label>
            </div>

            {{-- 3b. CSS Toggle Switch --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">toggle switch (peer)</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">CSS Toggle Switch</span>
                    <span class="text-xs text-slate-400">— languages/create</span>
                </div>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative flex-shrink-0">
                        <input type="checkbox" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full transition-colors duration-200"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">Frontend'de Aktif</p>
                        <p class="text-xs text-slate-400 mt-0.5">Ziyaretçiler bu dili görebilir</p>
                    </div>
                </label>
            </div>

            {{-- 3c. Radio Button Group (Yes/No) --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">Alpine radio</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Evet/Hayır Radio-Button</span>
                    <span class="text-xs text-slate-400">— students/create (alerji)</span>
                </div>
                <div x-data="{ choice: '2' }" class="space-y-3">
                    <div class="flex items-center gap-3">
                        <button type="button" @click="choice = '1'" class="flex items-center gap-2.5 px-5 py-3 rounded-xl border-2 text-sm font-medium transition-all duration-200 cursor-pointer" :class="choice === '1' ? 'border-amber-400 bg-amber-50 text-amber-700' : 'border-slate-200 bg-slate-50 text-slate-600 hover:border-slate-300'">
                            <div class="w-4 h-4 rounded-full border-2 flex items-center justify-center transition-all" :class="choice === '1' ? 'border-amber-500' : 'border-slate-300'">
                                <div x-show="choice === '1'" class="w-2 h-2 rounded-full bg-amber-500"></div>
                            </div>
                            Evet
                        </button>
                        <button type="button" @click="choice = '2'" class="flex items-center gap-2.5 px-5 py-3 rounded-xl border-2 text-sm font-medium transition-all duration-200 cursor-pointer" :class="choice === '2' ? 'border-emerald-400 bg-emerald-50 text-emerald-700' : 'border-slate-200 bg-slate-50 text-slate-600 hover:border-slate-300'">
                            <div class="w-4 h-4 rounded-full border-2 flex items-center justify-center transition-all" :class="choice === '2' ? 'border-emerald-500' : 'border-slate-300'">
                                <div x-show="choice === '2'" class="w-2 h-2 rounded-full bg-emerald-500"></div>
                            </div>
                            Hayır
                        </button>
                    </div>
                    <div x-show="choice === '1'" x-transition class="max-w-md">
                        <input type="text" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-amber-500/60 transition-all" placeholder="Detay girin...">
                    </div>
                </div>
            </div>

            {{-- 3d. Section Toggle Button --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">Alpine toggle section</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Bölüm Aç/Kapa Toggle</span>
                    <span class="text-xs text-slate-400">— students/create (2. veli)</span>
                </div>
                <div x-data="{ active: false }">
                    <button type="button" @click="active = !active" class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-xl border-2 text-sm font-medium transition-all duration-200 cursor-pointer" :class="active ? 'border-indigo-400 bg-indigo-50 text-indigo-700' : 'border-slate-200 bg-slate-50 text-slate-600 hover:border-slate-300'">
                        <div class="w-5 h-5 rounded-md border-2 flex items-center justify-center transition-all duration-200" :class="active ? 'bg-indigo-500 border-indigo-500' : 'border-slate-300 bg-white'">
                            <svg x-show="active" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        Ek Bölüm Ekle
                    </button>
                    <div x-show="active" x-transition class="mt-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-700/30 border border-slate-200 dark:border-slate-700">
                        <p class="text-sm text-slate-500">Bu alan aktif edildiğinde açılır...</p>
                    </div>
                </div>
            </div>

            {{-- 3e. Role/Permission Card --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">Alpine card toggle</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Seçim Kartı (İzin/Rol)</span>
                    <span class="text-xs text-slate-400">— roles/create, users/create</span>
                </div>
                <div x-data="{ selected: [] }" class="grid grid-cols-2 sm:grid-cols-3 gap-3 max-w-lg">
                    @foreach(['Görüntüleme', 'Düzenleme', 'Silme'] as $perm)
                    <button type="button" @click="selected.includes('{{ $perm }}') ? selected.splice(selected.indexOf('{{ $perm }}'),1) : selected.push('{{ $perm }}')" class="flex items-start gap-3 p-4 rounded-xl border-2 text-left transition-all duration-200 cursor-pointer w-full" :class="selected.includes('{{ $perm }}') ? 'border-blue-400 bg-blue-50' : 'border-slate-200 bg-slate-50/50 hover:border-slate-300'">
                        <div class="flex-shrink-0 mt-0.5 w-5 h-5 rounded-md border-2 flex items-center justify-center transition-all" :class="selected.includes('{{ $perm }}') ? 'bg-blue-500 border-blue-500' : 'border-slate-300'">
                            <svg x-show="selected.includes('{{ $perm }}')" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm font-medium" :class="selected.includes('{{ $perm }}') ? 'text-blue-700' : 'text-slate-600'">{{ $perm }}</span>
                    </button>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- 4. DOSYA YÜKLEME --}}
    {{-- ═══════════════════════════════════════ --}}
    <div x-show="activeSection === 'all' || activeSection === 'uploads'" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
            <div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4.5 h-4.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Dosya Yükleme</h3>
                <p class="text-xs text-slate-400 mt-0.5">Standart file input, önizlemeli yükleme, label-button stili</p>
            </div>
        </div>
        <div class="divide-y divide-slate-200/80 dark:divide-slate-700/50">

            {{-- 4a. Tekli Yükleme --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-fuchsia-100 dark:bg-fuchsia-900/30 rounded text-xs font-mono text-fuchsia-600">x-image-upload</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Tekli Yükleme</span>
                    <span class="text-xs text-slate-400">— blog, course, slider, teacher vb.</span>
                </div>
                <div class="max-w-md">
                    <x-image-upload name="demo_single" />
                </div>
                <pre class="text-xs text-slate-500 bg-slate-50 dark:bg-slate-700/30 rounded-lg p-3 font-mono mt-2">&lt;x-image-upload name="image" required /&gt;
&lt;x-image-upload name="image" :existing="$blog->image ? asset($blog->image) : null" /&gt;</pre>
            </div>

            {{-- 4b. Çoklu Yükleme --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-fuchsia-100 dark:bg-fuchsia-900/30 rounded text-xs font-mono text-fuchsia-600">x-image-upload</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Çoklu Yükleme</span>
                    <span class="text-xs text-slate-400">— galeri, çoklu görsel alanları</span>
                </div>
                <div class="max-w-lg">
                    <x-image-upload name="demo_multi" :multiple="true" />
                </div>
                <pre class="text-xs text-slate-500 bg-slate-50 dark:bg-slate-700/30 rounded-lg p-3 font-mono mt-2">&lt;x-image-upload name="images" :multiple="true" /&gt;
&lt;x-image-upload name="images" :multiple="true" :existing="$item->galleryUrls()" /&gt;</pre>
            </div>

            {{-- 4c. Props Tablosu --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">props</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Component Props</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="text-xs w-full">
                        <thead>
                            <tr class="border-b border-slate-200 dark:border-slate-700">
                                <th class="text-left py-2 pr-4 font-semibold text-slate-600 dark:text-slate-400">Prop</th>
                                <th class="text-left py-2 pr-4 font-semibold text-slate-600 dark:text-slate-400">Varsayılan</th>
                                <th class="text-left py-2 font-semibold text-slate-600 dark:text-slate-400">Açıklama</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-500 dark:text-slate-400">
                            <tr class="border-b border-slate-100 dark:border-slate-700/50"><td class="py-1.5 pr-4 font-mono text-fuchsia-600">name</td><td class="pr-4">—</td><td>Form field adı (zorunlu)</td></tr>
                            <tr class="border-b border-slate-100 dark:border-slate-700/50"><td class="py-1.5 pr-4 font-mono">multiple</td><td class="pr-4">false</td><td>Çoklu dosya yükleme (grid preview, ekle/kaldır)</td></tr>
                            <tr class="border-b border-slate-100 dark:border-slate-700/50"><td class="py-1.5 pr-4 font-mono">existing</td><td class="pr-4">null</td><td>Mevcut görsel URL (tekli: string, çoklu: array)</td></tr>
                            <tr class="border-b border-slate-100 dark:border-slate-700/50"><td class="py-1.5 pr-4 font-mono">required</td><td class="pr-4">false</td><td>Zorunlu alan</td></tr>
                            <tr class="border-b border-slate-100 dark:border-slate-700/50"><td class="py-1.5 pr-4 font-mono">accept</td><td class="pr-4">'image/*'</td><td>Kabul edilen dosya türleri</td></tr>
                            <tr class="border-b border-slate-100 dark:border-slate-700/50"><td class="py-1.5 pr-4 font-mono">hint</td><td class="pr-4">'PNG, JPG...'</td><td>Alt bilgi metni</td></tr>
                            <tr class="border-b border-slate-100 dark:border-slate-700/50"><td class="py-1.5 pr-4 font-mono">label</td><td class="pr-4">'Görsel yüklemek...'</td><td>Dropzone metin</td></tr>
                            <tr><td class="py-1.5 pr-4 font-mono">changeLabel</td><td class="pr-4">auto</td><td>Görsel varken metin (multi: 'Daha fazla görsel eklemek...')</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- 5. BUTONLAR --}}
    {{-- ═══════════════════════════════════════ --}}
    <div x-show="activeSection === 'all' || activeSection === 'buttons'" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
            <div class="w-9 h-9 rounded-xl bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4.5 h-4.5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5"/></svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Butonlar</h3>
                <p class="text-xs text-slate-400 mt-0.5">Submit, cancel, back, filter butonları</p>
            </div>
        </div>
        <div class="divide-y divide-slate-200/80 dark:divide-slate-700/50">

            <div class="px-6 py-5 flex flex-wrap gap-4">
                {{-- Submit --}}
                <div class="space-y-2">
                    <span class="block text-xs text-slate-400">Submit (Gradient)</span>
                    <button type="button" class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white font-semibold rounded-xl shadow-lg shadow-fuchsia-500/25 hover:shadow-xl hover:shadow-fuchsia-500/30 active:scale-[.98] transition-all text-sm">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                        Kaydet
                    </button>
                </div>

                {{-- Cancel --}}
                <div class="space-y-2">
                    <span class="block text-xs text-slate-400">Cancel</span>
                    <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-medium rounded-xl border border-slate-200 dark:border-slate-600 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all text-sm">İptal</a>
                </div>

                {{-- Back --}}
                <div class="space-y-2">
                    <span class="block text-xs text-slate-400">Geri Dön</span>
                    <a href="#" class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                    </a>
                </div>

                {{-- Danger --}}
                <div class="space-y-2">
                    <span class="block text-xs text-slate-400">Danger / Delete</span>
                    <button type="button" class="inline-flex items-center gap-2 px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-medium rounded-xl shadow-sm transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                        Sil
                    </button>
                </div>

                {{-- Filter Toggle --}}
                <div class="space-y-2">
                    <span class="block text-xs text-slate-400">Filtre Aç/Kapa</span>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z"/></svg>
                        Filtreler
                        <span class="bg-fuchsia-100 text-fuchsia-700 text-xs font-bold px-2 py-0.5 rounded-full">3</span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- 6. ÖZEL BİLEŞENLER --}}
    {{-- ═══════════════════════════════════════ --}}
    <div x-show="activeSection === 'all' || activeSection === 'special'" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
            <div class="w-9 h-9 rounded-xl bg-rose-100 dark:bg-rose-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4.5 h-4.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/></svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Özel Bileşenler</h3>
                <p class="text-xs text-slate-400 mt-0.5">Yıldız rating, dil sekmeleri, filtre chip, dinamik liste, gün-saat seçici</p>
            </div>
        </div>
        <div class="divide-y divide-slate-200/80 dark:divide-slate-700/50">

            {{-- 6a. Star Rating --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">star rating</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Yıldız Rating (Hover + Click)</span>
                    <span class="text-xs text-slate-400">— testimonial/create</span>
                </div>
                <div x-data="{ rating: 4, hovered: 0 }" class="flex items-center gap-1.5">
                    <template x-for="star in 5" :key="star">
                        <button type="button" @click="rating = star" @mouseenter="hovered = star" @mouseleave="hovered = 0" class="group relative p-0.5 transition-transform duration-150" :class="{ 'scale-125': hovered === star }">
                            <svg class="w-7 h-7 transition-all duration-200 drop-shadow-sm" :class="star <= (hovered || rating) ? 'text-amber-400 drop-shadow-[0_0_6px_rgba(251,191,36,0.4)]' : 'text-slate-200 dark:text-slate-600'" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </button>
                    </template>
                    <span class="ml-2 text-sm font-semibold text-slate-500 tabular-nums" x-text="(hovered || rating) + '/5'"></span>
                </div>
            </div>

            {{-- 6b. Language Tabs --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">language tabs</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Dil Sekmeleri</span>
                    <span class="text-xs text-slate-400">— languages/create, çeviri formları</span>
                </div>
                <div x-data="{ tab: 'tr' }">
                    <div class="flex items-center gap-1 p-1 bg-slate-100 dark:bg-slate-700/50 rounded-xl max-w-md">
                        @foreach(['tr' => 'Türkçe', 'en' => 'English', 'de' => 'Deutsch'] as $code => $lang)
                        <button type="button" @click="tab = '{{ $code }}'" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg text-sm font-medium transition-all duration-200 whitespace-nowrap cursor-pointer" :class="tab === '{{ $code }}' ? 'bg-white dark:bg-slate-800 text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-800 hover:bg-white/60'">
                            <span class="w-6 h-6 rounded-md flex items-center justify-center text-xs font-bold">{{ strtoupper($code) }}</span>
                            {{ $lang }}
                        </button>
                        @endforeach
                    </div>
                    @foreach(['tr', 'en', 'de'] as $code)
                    <div x-show="tab === '{{ $code }}'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="mt-3 max-w-md">
                        <input type="text" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all" placeholder="{{ $code }} dilinde metin...">
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 6c. Filter Chips --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">filter chips</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Filtre Chip'leri (Aktif Filtreler)</span>
                    <span class="text-xs text-slate-400">— students/index</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200 dark:border-fuchsia-800/40 rounded-full text-xs font-medium text-fuchsia-700 dark:text-fuchsia-400">
                        A Sınıfı
                        <button type="button" class="hover:text-fuchsia-900 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        </button>
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-fuchsia-50 dark:bg-fuchsia-900/20 border border-fuchsia-200 dark:border-fuchsia-800/40 rounded-full text-xs font-medium text-fuchsia-700 dark:text-fuchsia-400">
                        2025 Güz
                        <button type="button" class="hover:text-fuchsia-900 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        </button>
                    </span>
                    <button type="button" class="text-xs text-slate-400 hover:text-red-500 transition-colors underline">Temizle</button>
                </div>
            </div>

            {{-- 6d. Tab Navigation --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">pill tabs</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Sekme Navigasyonu (Pill)</span>
                    <span class="text-xs text-slate-400">— students/index (kayıt türleri)</span>
                </div>
                <div x-data="{ activeTab: 'all' }" class="flex gap-2">
                    <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">
                        Tümü <span class="ml-1.5 bg-white/20 px-2 py-0.5 rounded-full text-xs">150</span>
                    </button>
                    <button @click="activeTab = 'active'" :class="activeTab === 'active' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">
                        Aktif <span class="ml-1.5 bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full text-xs">120</span>
                    </button>
                    <button @click="activeTab = 'passive'" :class="activeTab === 'passive' ? 'bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'" class="px-4 py-2 rounded-xl text-sm font-medium transition-all">
                        Pasif <span class="ml-1.5 bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs">30</span>
                    </button>
                </div>
            </div>

            {{-- 6e. Dynamic List Builder --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">Alpine listBuilder</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Dinamik Liste Ekle/Çıkar</span>
                    <span class="text-xs text-slate-400">— course/create (öğrenecekler, neden tercih)</span>
                </div>
                <div class="max-w-lg" x-data="{ items: ['İlk madde', 'İkinci madde'], newItem: '' }">
                    <div class="space-y-2 mb-3">
                        <template x-for="(item, index) in items" :key="index">
                            <div class="flex items-center gap-2">
                                <input type="text" x-model="items[index]" class="flex-1 px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                                <button type="button" @click="items.splice(index, 1)" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="items.push('')" class="inline-flex items-center gap-1.5 text-sm text-fuchsia-600 hover:text-fuchsia-700 font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Madde Ekle
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- 7. LAYOUT & KARTLAR --}}
    {{-- ═══════════════════════════════════════ --}}
    <div x-show="activeSection === 'all' || activeSection === 'layout'" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
            <div class="w-9 h-9 rounded-xl bg-sky-100 dark:bg-sky-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4.5 h-4.5 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z"/></svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Layout & Kartlar</h3>
                <p class="text-xs text-slate-400 mt-0.5">Section kart, sidebar, özet kartları, önizleme kartı</p>
            </div>
        </div>
        <div class="divide-y divide-slate-200/80 dark:divide-slate-700/50">

            {{-- 7a. Section Card --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">section card</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Section Kart (Gradient Header)</span>
                    <span class="text-xs text-slate-400">— tüm create formları</span>
                </div>
                <div class="max-w-lg bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                    <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                        <div class="w-9 h-9 rounded-xl bg-fuchsia-100 dark:bg-fuchsia-900/30 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Bölüm Başlığı</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Bölüm açıklaması</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-slate-500">İçerik alanı...</p>
                    </div>
                </div>
            </div>

            {{-- 7b. Summary Stats --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">stat cards</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Özet İstatistik Kartları</span>
                    <span class="text-xs text-slate-400">— students/index</span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-2xl">
                    @foreach([
                        ['label' => 'Toplam', 'value' => '150', 'color' => 'fuchsia', 'icon' => 'M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z'],
                        ['label' => 'Aktif', 'value' => '120', 'color' => 'emerald', 'icon' => 'm4.5 12.75 6 6 9-13.5'],
                        ['label' => 'Pasif', 'value' => '30', 'color' => 'red', 'icon' => 'M6 18 18 6M6 6l12 12'],
                    ] as $stat)
                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200/50 dark:border-slate-700/50 p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-{{ $stat['color'] }}-100 dark:bg-{{ $stat['color'] }}-900/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-{{ $stat['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">{{ $stat['label'] }}</p>
                                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $stat['value'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 7c. Preview Card (Sidebar) --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">preview card</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Önizleme Kartı (Sidebar)</span>
                    <span class="text-xs text-slate-400">— roles, classes, students</span>
                </div>
                <div class="max-w-xs">
                    <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-2xl p-5 text-white shadow-xl shadow-fuchsia-500/20 overflow-hidden relative">
                        <div class="absolute top-0 right-0 w-28 h-28 bg-white/10 rounded-full -translate-y-8 translate-x-8"></div>
                        <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-full translate-y-6 -translate-x-4"></div>
                        <div class="relative">
                            <p class="text-fuchsia-100 text-xs font-medium uppercase tracking-wider mb-3">Önizleme</p>
                            <p class="font-semibold text-base">Yönetici Rolü</p>
                            <p class="text-fuchsia-200 text-sm">5 izin atandı</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 7d. 2-column form layout --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">form layout</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Form Layout: 3-kolon Grid (2+1 Sidebar)</span>
                    <span class="text-xs text-slate-400">— tüm create/edit formları</span>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-700/30 border border-slate-200 dark:border-slate-700">
                    <pre class="text-xs text-slate-600 dark:text-slate-400 font-mono whitespace-pre">grid grid-cols-1 lg:grid-cols-3 gap-6
├── lg:col-span-2 space-y-5   (Ana Form Bölümleri)
│   ├── Section Card 1
│   ├── Section Card 2
│   └── Section Card N
└── space-y-5 sticky top-24    (Sidebar)
    ├── Preview Card
    └── Action Buttons</pre>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- 8. HATA & BİLGİ --}}
    {{-- ═══════════════════════════════════════ --}}
    <div x-show="activeSection === 'all' || activeSection === 'feedback'" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
            <div class="w-9 h-9 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                <svg class="w-4.5 h-4.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Hata & Bilgi Mesajları</h3>
                <p class="text-xs text-slate-400 mt-0.5">Validation hata, uyarı kutusu, başarı mesajı</p>
            </div>
        </div>
        <div class="divide-y divide-slate-200/80 dark:divide-slate-700/50">

            {{-- 8a. Validation Error --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-red-100 dark:bg-red-900/30 rounded text-xs font-mono text-red-600">@@error</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Validation Hata Mesajı</span>
                    <span class="text-xs text-slate-400">— tüm formlar</span>
                </div>
                <div class="max-w-md space-y-2">
                    <input type="text" class="w-full px-4 py-3 bg-slate-50 border-0 rounded-xl text-sm ring-1 ring-red-400 focus:ring-2 focus:ring-red-500/60 transition-all" value="Hatalı değer">
                    <p class="text-sm text-red-500 flex items-center gap-1.5">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                        Bu alan zorunludur.
                    </p>
                </div>
            </div>

            {{-- 8b. Inline Error (classes style) --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">@@error inline</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Inline @@error Class Injection</span>
                    <span class="text-xs text-slate-400">— classes/create</span>
                </div>
                <div class="max-w-md">
                    <input type="text" class="w-full rounded-xl border border-red-400 bg-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-400 transition-colors" value="Hatalı">
                    <p class="mt-1.5 text-sm text-red-500">Bu alan gerekli.</p>
                </div>
            </div>

            {{-- 8c. Warning Box --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-amber-100 dark:bg-amber-900/30 rounded text-xs font-mono text-amber-600">warning</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Uyarı Kutusu</span>
                </div>
                <div class="max-w-lg px-4 py-3 bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-800/40 rounded-xl">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                        <div>
                            <p class="text-sm font-medium text-amber-800 dark:text-amber-300">Dikkat!</p>
                            <p class="text-xs text-amber-600 dark:text-amber-400 mt-0.5">Bu işlem geri alınamaz.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 8d. Info Box --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 rounded text-xs font-mono text-blue-600">info</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Bilgi Kutusu</span>
                </div>
                <div class="max-w-lg px-4 py-3 bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800/40 rounded-xl">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd"/></svg>
                        <p class="text-sm text-blue-700 dark:text-blue-300">Bilgilendirme mesajı burada gösterilir.</p>
                    </div>
                </div>
            </div>

            {{-- 8e. Max Select Warning --}}
            <div class="px-6 py-5 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-mono text-slate-500">max select</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Maksimum Seçim Uyarısı</span>
                    <span class="text-xs text-slate-400">— x-checkbox-dropdown</span>
                </div>
                <div class="max-w-sm px-3 py-1.5 bg-amber-50 dark:bg-amber-900/10 border-b border-amber-200/60 dark:border-amber-800/30 rounded-lg">
                    <p class="text-[11px] text-amber-600 dark:text-amber-400">En fazla 3 seçim yapabilirsiniz</p>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
