# Admin Panel UI Component Reference

> Tailwind CSS v4 + Alpine.js v3 + jQuery 3.6 + Vite
> Kopyala-yapistir ile hizlica admin panel olusturmak icin referans dosyasi.

---

## Icindekiler

1. [Teknoloji Stack & Kurulum](#1-teknoloji-stack--kurulum)
2. [Layout Yapisi](#2-layout-yapisi)
3. [Sidebar / Aside](#3-sidebar--aside)
4. [Navbar / Topbar](#4-navbar--topbar)
5. [Sayfa Yapisi](#5-sayfa-yapisi)
6. [Form Bilesenleri](#6-form-bilesenleri)
7. [Butonlar](#7-butonlar)
8. [Tablolar](#8-tablolar)
9. [Badge / Pill / Tag](#9-badge--pill--tag)
10. [Modal & Dialog](#10-modal--dialog)
11. [Toast / Notification](#11-toast--notification)
12. [Dropdown / Popover](#12-dropdown--popover)
13. [Ikonlar (SVG)](#13-ikonlar-svg)
14. [Renk Sistemi](#14-renk-sistemi)
15. [CSS Custom Patterns](#15-css-custom-patterns)
16. [JavaScript Patterns](#16-javascript-patterns)
17. [Permission / Authorization](#17-permission--authorization)

---

## 1. Teknoloji Stack & Kurulum

### Bagimliliklar

| Paket | Versiyon | Kullanim |
|-------|---------|---------|
| Tailwind CSS | v4.1 | Ana stil framework |
| Alpine.js | v3.x | Reaktif DOM, modal, dropdown, dark mode |
| jQuery | 3.6.0 | DOM manipulasyonu, Summernote |
| Summernote | 0.8.20 | Rich text editor |
| TomSelect | 2.2.2 | Multi-select dropdown |
| Select2 | 4.1.0 | Select dropdown |
| Sortable.js | 1.15.0 | Drag & drop siralama |
| Flowbite | 3.1.2 | UI bilesenleri |
| Vite | - | Build araci |
| Inter Font | 300-800 | Ana font |

### CDN Linkleri (Head)

```html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />

    @yield('styles')
</head>
```

### Sayfa Bazli Ek Kutuphaneler

```html
{{-- Summernote (Rich Text Editor gereken sayfalarda) --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

{{-- TomSelect (Multi-select gereken sayfalarda) --}}
<link href="{{ asset('tomselect.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

{{-- Sortable.js (Drag & drop gereken sayfalarda) --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
```

### Tailwind CSS Yapilandirmasi

```css
/* resources/css/app.css */
@import "tailwindcss";
@import "flowbite/src/themes/default";
@plugin "flowbite/plugin";

@theme {
    --font-sans: "Instrument Sans", ui-sans-serif, system-ui, sans-serif;
}
```

---

## 2. Layout Yapisi

### Ana Layout (app.blade.php)

```html
<body x-data="{
    sidebarOpen: false,
    sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
    darkMode: localStorage.getItem('darkMode') === 'true',
    toasts: [],
    addToast(type, message, duration = 5000) {
        const id = Date.now();
        this.toasts.push({ id, type, message });
        setTimeout(() => this.removeToast(id), duration);
    },
    removeToast(id) {
        this.toasts = this.toasts.filter(t => t.id !== id);
    }
}" :class="{ 'dark': darkMode }"
x-init="$watch('sidebarCollapsed', val => localStorage.setItem('sidebarCollapsed', val));
         $watch('darkMode', val => localStorage.setItem('darkMode', val));
         $nextTick(() => setTimeout(() => document.body.classList.remove('is-loading'), 50))"
class="h-full font-[Inter] antialiased bg-slate-100 dark:bg-slate-950 transition-colors duration-300 is-loading">

    {{-- Mobile Overlay --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden"
         style="display: none;"></div>

    {{-- Toast Notifications --}}
    @include('admin.layouts.toast')

    {{-- Sidebar --}}
    @include('admin.layouts.aside')

    {{-- Main Content --}}
    <div class="transition-all duration-300"
         :class="sidebarCollapsed ? 'lg:pl-20' : 'lg:pl-72'">

        {{-- Topbar --}}
        @include('admin.layouts.navbar')

        {{-- Content Area --}}
        <main class="px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
            @hasSection('page-banner')
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    @yield('page-banner')
                </div>
            @endif
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="px-4 sm:px-6 lg:px-8 py-4 border-t border-slate-200 dark:border-slate-800">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-slate-500 dark:text-slate-400">
                <p>&copy; {{ date('Y') }} Tum haklari saklidir.</p>
                <p>Laravel v{{ app()->version() }}</p>
            </div>
        </footer>
    </div>

    {{-- Global Modal (Bolum 10'da detayli) --}}

    @yield('scripts')
</body>
```

### Grid Sistemi (3 Kolonlu Form Layout)

```html
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Sol Kolon: Icerik (2/3) --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Card bilesenleri --}}
    </div>

    {{-- Sag Kolon: Ayarlar & Medya & Kaydet (1/3) --}}
    <div class="lg:col-span-1 space-y-6">
        {{-- Card bilesenleri --}}
    </div>
</div>
```

---

## 3. Sidebar / Aside

### Sidebar Ana Yapisi

```html
<aside class="fixed inset-y-0 left-0 z-50 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 transition-all duration-300 ease-out flex flex-col"
       :class="[
           sidebarOpen ? 'translate-x-0 w-72' : '-translate-x-full w-72',
           sidebarCollapsed ? 'lg:translate-x-0 lg:w-20 sidebar-collapsed' : 'lg:translate-x-0 lg:w-72'
       ]"
       x-data="{ openMenu: '' }">

    {{-- Logo --}}
    <div class="sidebar-logo h-16 flex items-center gap-3 px-4 border-b border-slate-200 dark:border-slate-800 flex-shrink-0">
        <img src="/images/logo.svg" alt="Logo" class="h-6 flex-shrink-0 dark:invert"
             x-show="!sidebarCollapsed" x-transition>
        <img src="/images/logo.svg" alt="Logo" class="h-5 w-10 object-contain flex-shrink-0 dark:invert"
             x-show="sidebarCollapsed" x-transition>
        {{-- Mobile close --}}
        <button @click="sidebarOpen = false"
                class="lg:hidden ml-auto p-1 text-slate-400 hover:text-slate-600 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav flex-1 overflow-y-auto px-3 py-4 space-y-1">
        {{-- Menu oegeleri buraya --}}
    </nav>

    {{-- User Info --}}
    <div class="sidebar-user p-3 border-t border-slate-200 dark:border-slate-800 flex-shrink-0">
        {{-- Kullanici bilgisi buraya --}}
    </div>
</aside>
```

### Collapsed Sidebar Stilleri

```css
@media (min-width: 1024px) {
    .sidebar-collapsed .sidebar-nav {
        overflow: visible !important;
        padding-left: 0.375rem;
        padding-right: 0.375rem;
    }
    .sidebar-collapsed .sidebar-nav > a,
    .sidebar-collapsed .sidebar-nav > div > button {
        justify-content: center;
        padding-left: 0;
        padding-right: 0;
        gap: 0;
    }
    .sidebar-collapsed .sidebar-logo {
        justify-content: center;
        padding-left: 0.25rem;
        padding-right: 0.25rem;
    }
    .sidebar-collapsed .sidebar-user {
        justify-content: center;
    }
}
```

### Tek Seviye Menu Item

```html
@php $isActive = Route::is('dashboard.index'); @endphp
<a href="{{ route('dashboard.index') }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
          {{ $isActive
              ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
              : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                {{ $isActive
                    ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                    : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {{-- Icon SVG path --}}
        </svg>
    </div>
    <span x-show="!sidebarCollapsed" x-transition class="hidden lg:block">Dashboard</span>
    <span class="lg:hidden">Dashboard</span>
</a>
```

### Dropdown Menu Item (Alt Menulu)

```html
@php $isActive = Route::is('blogs.*'); @endphp
<div class="group/blogs relative">
    <button @click="openMenu = openMenu === 'blogs' ? '' : 'blogs'"
            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                   {{ $isActive
                       ? 'bg-fuchsia-50 dark:bg-fuchsia-500/10 text-fuchsia-600 dark:text-fuchsia-400'
                       : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white' }}">
        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                    {{ $isActive
                        ? 'bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30'
                        : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {{-- Icon SVG path --}}
            </svg>
        </div>
        <span x-show="!sidebarCollapsed" x-transition class="flex-1 text-left hidden lg:block">Blog</span>
        <span class="flex-1 text-left lg:hidden">Blog</span>
        {{-- Chevron --}}
        <svg x-show="!sidebarCollapsed"
             class="w-4 h-4 transition-transform duration-200 hidden lg:block"
             :class="{ 'rotate-180': openMenu === 'blogs' }"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    {{-- Normal submenu (expanded sidebar + mobile) --}}
    <div x-show="openMenu === 'blogs' && (!sidebarCollapsed || window.innerWidth < 1024)"
         x-collapse class="ml-12 mt-1 space-y-1">
        <a href="{{ route('blogs.index') }}"
           class="block px-3 py-2 rounded-lg text-sm
                  {{ Route::is('blogs.index')
                      ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium'
                      : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300' }}">
            Tumu
        </a>
        <a href="{{ route('blogs.create') }}"
           class="block px-3 py-2 rounded-lg text-sm
                  {{ Route::is('blogs.create')
                      ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium'
                      : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300' }}">
            Ekle
        </a>
        <a href="{{ route('blogs.categories.index') }}"
           class="block px-3 py-2 rounded-lg text-sm
                  {{ Route::is('blogs.categories.*')
                      ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium'
                      : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300' }}">
            Kategoriler
        </a>
    </div>

    {{-- Flyout submenu (collapsed sidebar, desktop only) --}}
    <template x-if="sidebarCollapsed">
        <div class="hidden lg:group-hover/blogs:block absolute left-full top-0 pl-2 z-[60]">
            <div class="w-48 bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-slate-200 dark:border-slate-700 py-2">
                <p class="px-3 py-1.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Blog</p>
                <a href="{{ route('blogs.index') }}"
                   class="block px-3 py-2 text-sm rounded-lg mx-1 transition-colors
                          {{ Route::is('blogs.index')
                              ? 'text-fuchsia-600 dark:text-fuchsia-400 font-medium bg-fuchsia-50 dark:bg-fuchsia-500/10'
                              : 'text-slate-600 dark:text-slate-300 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-500/10 hover:text-fuchsia-600 dark:hover:text-fuchsia-400' }}">
                    Tumu
                </a>
                {{-- Diger linkler --}}
            </div>
        </div>
    </template>
</div>
```

### Bolum Ayirici (Section Divider)

```html
<div class="pt-4">
    <p x-show="!sidebarCollapsed" x-transition
       class="px-3 text-xs font-medium uppercase text-slate-400 dark:text-slate-500 mb-2 hidden lg:block">
        Panel
    </p>
    <div x-show="sidebarCollapsed"
         class="hidden lg:block mx-auto w-8 border-t border-slate-200 dark:border-slate-700 mb-2">
    </div>
    <p class="px-3 text-xs font-medium uppercase text-slate-400 dark:text-slate-500 mb-2 lg:hidden">Panel</p>
</div>
```

### Kullanici Profil Bolumu

```html
<div class="sidebar-user p-3 border-t border-slate-200 dark:border-slate-800 flex-shrink-0">
    <div class="flex items-center gap-3">
        <div class="relative flex-shrink-0">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600
                        flex items-center justify-center text-white font-bold
                        shadow-lg shadow-fuchsia-500/20">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500
                        border-2 border-white dark:border-slate-900 rounded-full"></div>
        </div>
        <div x-show="!sidebarCollapsed" x-transition class="hidden lg:block min-w-0">
            <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">
                {{ auth()->user()->name ?? 'Admin' }}
            </p>
            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                {{ auth()->user()->email ?? '' }}
            </p>
        </div>
    </div>
</div>
```

---

## 4. Navbar / Topbar

### Tam Navbar Yapisi

```html
<header class="sticky top-0 z-30 glass border-b border-slate-200/50 dark:border-slate-700/50">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">

        {{-- Sol: Mobile menu + Sidebar collapse --}}
        <div class="flex items-center gap-4">
            {{-- Mobile hamburger --}}
            <button @click="sidebarOpen = !sidebarOpen" type="button"
                    class="lg:hidden inline-flex items-center justify-center p-2 rounded-xl
                           text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200
                           hover:bg-slate-100 dark:hover:bg-slate-800
                           focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20
                           transition-all duration-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Sidebar collapse toggle (desktop) --}}
            <button @click="sidebarCollapsed = !sidebarCollapsed" type="button"
                    class="hidden lg:inline-flex items-center justify-center p-2 rounded-xl
                           text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200
                           hover:bg-slate-100 dark:hover:bg-slate-800
                           focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20
                           transition-all duration-200">
                <svg class="h-5 w-5 transition-transform duration-300"
                     :class="{ 'rotate-180': sidebarCollapsed }"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
            </button>
        </div>

        {{-- Sag: Dark mode + Site link + User menu --}}
        <div class="flex items-center gap-2 sm:gap-3">
            {{-- Siteyi Gor Butonu --}}
            <a href="/" target="_blank"
               class="hidden sm:inline-flex items-center gap-2 px-4 py-2
                      bg-gradient-to-r from-fuchsia-500 to-blue-600
                      hover:from-fuchsia-600 hover:to-blue-700
                      text-white text-sm font-medium rounded-xl
                      shadow-sm hover:shadow-md transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Siteyi Gor
            </a>

            {{-- Dark Mode Toggle --}}
            <button @click="darkMode = !darkMode" type="button"
                    class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl
                           text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200
                           hover:bg-slate-100 dark:hover:bg-slate-800
                           focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20
                           transition-all duration-200 overflow-hidden">
                {{-- Moon (light mode) --}}
                <svg x-show="!darkMode"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 rotate-90 scale-0"
                     x-transition:enter-end="opacity-100 rotate-0 scale-100"
                     class="h-5 w-5 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
                {{-- Sun (dark mode) --}}
                <svg x-show="darkMode"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -rotate-90 scale-0"
                     x-transition:enter-end="opacity-100 rotate-0 scale-100"
                     class="h-5 w-5 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </button>

            {{-- User Dropdown (Bolum 12'de detayli) --}}
        </div>
    </div>
</header>
```

---

## 5. Sayfa Yapisi

### Page Banner - Liste Sayfasi

```html
@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Blog Yazilari</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Tum blog iceriklerini yonetin</p>
    </div>
    <a href="{{ route('blogs.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3
              bg-gradient-to-r from-fuchsia-500 to-purple-500
              hover:from-fuchsia-600 hover:to-purple-600
              text-white font-semibold rounded-xl
              shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Yeni Blog Ekle
    </a>
@endsection
```

### Page Banner - Form Sayfasi (Geri Butonlu)

```html
@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('blogs.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Blog Ekle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Yeni blog yazisi olusturun</p>
        </div>
    </div>
@endsection
```

### Card / Panel Bileseni

```html
<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm
            border border-slate-200/50 dark:border-slate-700/50 p-6">
    {{-- Card Header --}}
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl bg-fuchsia-100 dark:bg-fuchsia-900/30
                    flex items-center justify-center">
            <svg class="w-5 h-5 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {{-- Icon --}}
            </svg>
        </div>
        <div>
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Baslik</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500">Alt aciklama</p>
        </div>
    </div>

    {{-- Card Content --}}
    <div class="space-y-5">
        {{-- Icerik --}}
    </div>
</div>
```

### Card Icon Renk Varyantlari

```html
{{-- Fuchsia (Primary/Icerik) --}}
<div class="w-9 h-9 rounded-xl bg-fuchsia-100 dark:bg-fuchsia-900/30 flex items-center justify-center">
    <svg class="w-5 h-5 text-fuchsia-500">...</svg>
</div>

{{-- Blue (Ayarlar/Etiket) --}}
<div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
    <svg class="w-5 h-5 text-blue-500">...</svg>
</div>

{{-- Emerald (Medya/Gorsel) --}}
<div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
    <svg class="w-5 h-5 text-emerald-500">...</svg>
</div>

{{-- Amber (Galeri/Linkler) --}}
<div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
    <svg class="w-5 h-5 text-amber-500">...</svg>
</div>

{{-- Violet (Konfigurasyon) --}}
<div class="w-9 h-9 rounded-xl bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center">
    <svg class="w-5 h-5 text-violet-500">...</svg>
</div>
```

---

## 6. Form Bilesenleri

### Text Input

```html
<div>
    <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
        Baslik <span class="text-red-500">*</span>
    </label>
    <input type="text" name="title" id="title"
        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl
               text-slate-900 dark:text-white placeholder-slate-400
               focus:ring-2 focus:ring-fuchsia-500/50 transition-all"
        placeholder="Baslik girin" value="{{ old('title') }}">
    @error('title')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
```

### Email Input

```html
<div>
    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
        E-posta <span class="text-red-500">*</span>
    </label>
    <input type="email" name="email" id="email"
        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl
               text-slate-900 dark:text-white placeholder-slate-400
               focus:ring-2 focus:ring-fuchsia-500/50 transition-all"
        placeholder="ornek@mail.com" value="{{ old('email') }}">
    @error('email')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
```

### Phone Input

```html
<div>
    <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Telefon</label>
    <input type="tel" name="phone" id="phone" maxlength="13"
        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl
               text-slate-900 dark:text-white placeholder-slate-400
               focus:ring-2 focus:ring-fuchsia-500/50 transition-all"
        placeholder="+90 555 123 4567" value="{{ old('phone') }}">
</div>
```

### Password Input

```html
<div>
    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
        Sifre <span class="text-red-500">*</span>
    </label>
    <input type="password" name="password" id="password"
        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl
               text-slate-900 dark:text-white placeholder-slate-400
               focus:ring-2 focus:ring-fuchsia-500/50 transition-all"
        placeholder="Sifre girin">
    @error('password')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
```

### Textarea

```html
<div>
    <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Aciklama</label>
    <textarea name="description" id="description" rows="4"
        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl
               text-slate-900 dark:text-white placeholder-slate-400
               focus:ring-2 focus:ring-fuchsia-500/50 transition-all"
        placeholder="Aciklama girin">{{ old('description') }}</textarea>
</div>
```

### Rich Text Editor (Summernote)

```html
{{-- Styles bolumunde --}}
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                height: 300,
                placeholder: 'Icerik girin',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear', 'strikethrough',
                               'superscript', 'subscript', 'removeFormat', 'code']],
                    ['font', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture']]
                ]
            });
        });
    </script>
@endsection

{{-- Content bolumunde --}}
<div>
    <label for="editor" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Icerik</label>
    <textarea id="editor" name="description">{{ old('description') }}</textarea>
</div>
```

### Select Dropdown (Standart)

```html
<div>
    <label for="category" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Kategori</label>
    <select id="category" name="category"
        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl
               text-slate-900 dark:text-white placeholder-slate-400
               focus:ring-2 focus:ring-fuchsia-500/50 transition-all">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
```

### Multi-Select (TomSelect)

```html
{{-- Styles bolumunde --}}
@section('styles')
    <link href="{{ asset('tomselect.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection

{{-- Content bolumunde --}}
<div>
    <label for="categories" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Kategoriler</label>
    <select id="categories" name="categories[]" multiple
        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl
               text-slate-900 dark:text-white placeholder-slate-400
               focus:ring-2 focus:ring-fuchsia-500/50 transition-all">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<script>
    new TomSelect('#categories', {
        create: false,
        highlight: true,
        persist: false,
        openOnFocus: true,
        allowEmptyOption: false,
        placeholder: 'Kategori secin...',
        hidePlaceholder: true,
    });
</script>
```

### File Upload (Drag & Drop)

```html
<label class="block cursor-pointer">
    <div class="relative border-2 border-dashed border-slate-200 dark:border-slate-600
                rounded-xl p-8 text-center
                hover:border-fuchsia-400 dark:hover:border-fuchsia-500 transition-colors group">
        <div class="w-14 h-14 mx-auto mb-4 rounded-2xl
                    bg-gradient-to-br from-fuchsia-100 to-purple-100
                    dark:from-fuchsia-900/30 dark:to-purple-900/30
                    flex items-center justify-center
                    group-hover:scale-110 transition-transform duration-200">
            <svg class="w-7 h-7 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
            </svg>
        </div>
        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">Dosya yuklemek icin tiklayin</p>
        <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">PNG, JPG, WebP (Maks. 2MB)</p>
    </div>
    <input type="file" name="file" id="file" accept="image/*" class="hidden">
</label>
@error('file')
    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
@enderror

{{-- Preview --}}
<div id="preview_file" class="mt-4">
    <img id="preview_image" src="" alt="Preview"
         class="hidden rounded-xl w-full h-auto border border-slate-200 dark:border-slate-600">
</div>

{{-- Preview JavaScript --}}
<script>
    $(document).ready(function() {
        $('#file').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview_image').attr('src', e.target.result).removeClass('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                $('#preview_image').addClass('hidden');
            }
        });
    });
</script>
```

### File Upload (Inline - Galeri)

```html
<div class="border-2 border-dashed border-slate-200 dark:border-slate-600
            rounded-xl p-2 hover:border-fuchsia-400 dark:hover:border-fuchsia-500 transition-colors">
    <input type="file" name="gallery_items[0][file]"
        class="block w-full text-sm text-slate-500 dark:text-slate-400
               file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0
               file:text-sm file:font-medium
               file:bg-fuchsia-50 file:text-fuchsia-700
               hover:file:bg-fuchsia-100
               dark:file:bg-fuchsia-900/20 dark:file:text-fuchsia-400
               cursor-pointer"
        accept="image/*,video/*">
</div>
```

### Progress Bar (Upload)

```html
<div class="hidden mt-1 h-2 bg-slate-200 dark:bg-slate-600 rounded-full overflow-hidden" id="progress-wrapper-0">
    <div class="bg-fuchsia-500 h-2 progress-bar rounded-full" id="progress-bar-0" style="width: 0%"></div>
</div>
```

### Dynamic Field Rows (Ekle/Sil)

```html
<div id="project-info-items-wrapper" class="space-y-3">
    <div class="project-info-items-item flex items-center gap-3">
        <div class="w-1/3">
            <input type="text" name="info_items[0][title]"
                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl
                       text-slate-900 dark:text-white placeholder-slate-400
                       focus:ring-2 focus:ring-fuchsia-500/50 transition-all"
                placeholder="Baslik">
        </div>
        <div class="w-2/3">
            <input type="text" name="info_items[0][description]"
                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl
                       text-slate-900 dark:text-white placeholder-slate-400
                       focus:ring-2 focus:ring-fuchsia-500/50 transition-all"
                placeholder="Aciklama">
        </div>
        <button type="button"
            class="remove-info p-2 text-slate-400 hover:text-red-600 dark:hover:text-red-400
                   hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

{{-- Ekle Butonu --}}
<div class="flex justify-end mt-3">
    <button type="button" id="add-info"
        class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium
               text-fuchsia-600 dark:text-fuchsia-400
               bg-fuchsia-50 dark:bg-fuchsia-900/20
               hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900/30
               rounded-xl transition-all cursor-pointer">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Ekle
    </button>
</div>

{{-- JavaScript --}}
<script>
    let index = 1;
    $('#add-info').on('click', function() {
        const field = `
            <div class="project-info-items-item flex items-center gap-3">
                <div class="w-1/3">
                    <input type="text" name="info_items[${index}][title]"
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-fuchsia-500/50 transition-all"
                        placeholder="Baslik">
                </div>
                <div class="w-2/3">
                    <input type="text" name="info_items[${index}][description]"
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border-0 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-fuchsia-500/50 transition-all"
                        placeholder="Aciklama">
                </div>
                <button type="button"
                    class="remove-info p-2 text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>`;
        $('#project-info-items-wrapper').append(field);
        index++;
    });

    $(document).on('click', '.remove-info', function() {
        $(this).closest('.project-info-items-item').remove();
        if ($('#project-info-items-wrapper .project-info-items-item').length === 0) {
            $('#add-info').click();
        }
    });
</script>
```

---

## 7. Butonlar

### Primary Button (Gradient - Kaydet)

```html
<button type="submit"
    class="w-full inline-flex items-center justify-center gap-2 px-6 py-3
           bg-gradient-to-r from-fuchsia-500 to-purple-500
           hover:from-fuchsia-600 hover:to-purple-600
           text-white font-semibold rounded-xl
           shadow-lg shadow-fuchsia-500/25 hover:shadow-fuchsia-500/40
           transition-all duration-200 cursor-pointer">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    Kaydet
</button>
```

### Primary Button (Link - Yeni Ekle)

```html
<a href="{{ route('blogs.create') }}"
   class="inline-flex items-center gap-2 px-6 py-3
          bg-gradient-to-r from-fuchsia-500 to-purple-500
          hover:from-fuchsia-600 hover:to-purple-600
          text-white font-semibold rounded-xl
          shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
    </svg>
    Yeni Blog Ekle
</a>
```

### Cancel Button (Red)

```html
<a href="{{ route('blogs.index') }}"
   class="w-full inline-flex items-center justify-center gap-2 px-6 py-3
          bg-red-50 dark:bg-red-900/20
          hover:bg-red-100 dark:hover:bg-red-900/40
          border border-red-200/60 dark:border-red-800/50
          text-red-600 dark:text-red-400
          font-semibold rounded-xl transition-all duration-200">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
    Iptal
</a>
```

### Back Button (Geri)

```html
<a href="{{ route('blogs.index') }}"
   class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
          rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
    </svg>
</a>
```

### Icon Button (Tablo Aksiyonlari)

```html
{{-- Edit --}}
<a href="{{ route('blogs.edit', $item->id) }}"
   class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400
          hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
          rounded-lg transition-all" title="Duzenle">
    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
    </svg>
</a>

{{-- Delete --}}
<button type="submit"
    class="p-2 text-slate-400 hover:text-red-600
           hover:bg-red-50 dark:hover:bg-red-900/20
           rounded-lg transition-all cursor-pointer" title="Sil">
    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
    </svg>
</button>

{{-- Translate --}}
<button type="button"
    class="p-2 text-slate-400 hover:text-fuchsia-600
           rounded-lg transition-all cursor-pointer" title="Ceviri">
    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
    </svg>
</button>
```

### Add Button (Fuchsia Secondary)

```html
<button type="button" id="add-info"
    class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium
           text-fuchsia-600 dark:text-fuchsia-400
           bg-fuchsia-50 dark:bg-fuchsia-900/20
           hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900/30
           rounded-xl transition-all cursor-pointer">
    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
    </svg>
    Ekle
</button>
```

### View Site Button (Gradient Link)

```html
<a href="/" target="_blank"
   class="hidden sm:inline-flex items-center gap-2 px-4 py-2
          bg-gradient-to-r from-fuchsia-500 to-blue-600
          hover:from-fuchsia-600 hover:to-blue-700
          text-white text-sm font-medium rounded-xl
          shadow-sm hover:shadow-md transition-all duration-200">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
    </svg>
    Siteyi Gor
</a>
```

### Remove / X Button (Dynamic Rows)

```html
<button type="button"
    class="remove-info p-2 text-slate-400 hover:text-red-600 dark:hover:text-red-400
           hover:bg-red-50 dark:hover:bg-red-900/20
           rounded-lg transition-all cursor-pointer">
    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
    </svg>
</button>
```

---

## 8. Tablolar

### Tablo Ana Yapisi

```html
<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm
            border border-slate-200/50 dark:border-slate-700/50">
    <div class="overflow-visible">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 dark:bg-slate-700/50
                          [&>tr>th:first-child]:rounded-tl-2xl
                          [&>tr>th:last-child]:rounded-tr-2xl">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold
                                           text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        Baslik
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold
                                           text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold
                                           text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        Tarih
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold
                                           text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        Islem
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                @foreach ($items as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            {{-- Icerik --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
        {{ $items->withQueryString()->links() }}
    </div>
</div>
```

### Tablo Kolon Tipleri

#### Clickable Title Column

```html
<td class="px-6 py-4 font-medium whitespace-nowrap">
    <a href="{{ route('blogs.edit', $item->id) }}"
       class="text-fuchsia-600 dark:text-fuchsia-400
              hover:text-fuchsia-800 dark:hover:text-fuchsia-300 transition-colors">
        {{ $item->title }}
    </a>
</td>
```

#### Image Column

```html
<td class="px-6 py-4">
    <img src="{{ asset('storage/pages/' . $item->image) }}" alt="{{ $item->title }}"
         class="w-16 h-16 object-cover rounded-xl border border-slate-200 dark:border-slate-600">
</td>
```

#### Video Placeholder Column

```html
<td class="px-6 py-4">
    @if($item->is_video)
        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-xl
                    flex items-center justify-center">
            <svg class="w-8 h-8 text-fuchsia-500" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z"/>
            </svg>
        </div>
    @else
        <img src="{{ asset('storage/pages/' . $item->image) }}" alt="{{ $item->title }}"
             class="w-16 h-16 object-cover rounded-xl border border-slate-200 dark:border-slate-600">
    @endif
</td>
```

#### Date Column

```html
<td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
    {{ $item->created_at->format('d.m.Y') }}
</td>
```

#### Status Badge Column

```html
<td class="px-6 py-4">
    @if($item->is_video)
        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
                     bg-fuchsia-50 text-fuchsia-700 dark:bg-fuchsia-900/30 dark:text-fuchsia-400">
            Video
        </span>
    @else
        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
                     bg-fuchsia-50 text-fuchsia-700 dark:bg-fuchsia-900/30 dark:text-fuchsia-400">
            Resim
        </span>
    @endif
</td>
```

#### Category Tags Column

```html
<td class="px-6 py-4">
    @foreach ($item->categories as $category)
        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium
                     text-fuchsia-700 bg-fuchsia-100 rounded-full
                     dark:bg-fuchsia-900/30 dark:text-fuchsia-300">
            {{ $category->name }}
        </span>
    @endforeach
</td>
```

#### Actions Column (Delete + Translate Dropdown)

```html
<td class="px-6 py-4">
    <div class="flex items-center gap-1">
        {{-- Delete --}}
        <form action="{{ route('blogs.delete', $item->id) }}" method="POST"
              x-data @submit.prevent="$dispatch('confirm-dialog', {
                  title: 'Blogu Sil',
                  message: 'Bu blogu silmek istediginize emin misiniz?',
                  form: $el
              })">
            @csrf @method('DELETE')
            <button type="submit"
                class="p-2 text-slate-400 hover:text-red-600
                       rounded-lg transition-all cursor-pointer" title="Sil">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                </svg>
            </button>
        </form>

        {{-- Translate Dropdown --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="p-2 text-slate-400 hover:text-fuchsia-600
                       rounded-lg transition-all cursor-pointer"
                type="button" title="Ceviri">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                </svg>
            </button>
            <div x-show="open" @click.away="open = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 z-20 mt-2 w-44
                       bg-white dark:bg-slate-700
                       rounded-xl shadow-lg
                       border border-slate-200/50 dark:border-slate-700/50 py-1"
                style="display: none;">
                @foreach ($activeLanguages as $lang)
                    <a href="{{ route('blogs.editTranslate', ['lang' => $lang->locale, 'id' => $item->id]) }}"
                       class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200
                              hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
                        {{ $lang->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</td>
```

### Drag & Drop Sortable Table

```html
{{-- Styles bolumunde --}}
@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
@endsection

{{-- Drag handle kolonu --}}
<td class="px-6 py-4">
    <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
    </svg>
</td>

{{-- Sortable rows: cursor-grab class eklenmeli --}}
<tbody id="sortable-slides" class="divide-y divide-slate-100 dark:divide-slate-700/50">
    @foreach ($slides as $item)
        <tr data-id="{{ $item->id }}"
            class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors cursor-grab">
            {{-- Kolonlar --}}
        </tr>
    @endforeach
</tbody>

{{-- JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Sortable(document.getElementById('sortable-slides'), {
            animation: 150,
            handle: 'tr',
            ghostClass: 'bg-fuchsia-50',
            onEnd: function() {
                const order = [];
                document.querySelectorAll('#sortable-slides tr').forEach(function(row) {
                    order.push(row.dataset.id);
                });
                fetch('{{ route("slides.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: order })
                });
            }
        });
    });
</script>
```

---

## 9. Badge / Pill / Tag

### Status Badge (Rounded-lg)

```html
<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
             bg-fuchsia-50 text-fuchsia-700
             dark:bg-fuchsia-900/30 dark:text-fuchsia-400">
    Video
</span>
```

### Pill Badge (Rounded-full)

```html
<span class="inline-flex items-center px-2.5 py-1 text-xs font-medium
             text-fuchsia-700 bg-fuchsia-100 rounded-full
             dark:bg-fuchsia-900/30 dark:text-fuchsia-300">
    Kategori Adi
</span>
```

### Renk Varyantlari

```html
{{-- Fuchsia --}}
<span class="... bg-fuchsia-50 text-fuchsia-700 dark:bg-fuchsia-900/30 dark:text-fuchsia-400">Fuchsia</span>

{{-- Emerald (Basarili/Aktif) --}}
<span class="... bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">Aktif</span>

{{-- Blue (Bilgi) --}}
<span class="... bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">Bilgi</span>

{{-- Amber (Uyari/Bekleyen) --}}
<span class="... bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">Bekleyen</span>

{{-- Red (Hata/Pasif) --}}
<span class="... bg-red-50 text-red-700 dark:bg-red-900/30 dark:text-red-400">Pasif</span>
```

---

## 10. Modal & Dialog

### Global Confirm/Alert Modal

Bu modal `app.blade.php` icinde bir kez tanimlanir ve tum sayfalarda kullanilir.

```html
<style>
    @keyframes modal-icon-pop {
        0% { transform: scale(0); opacity: 0; }
        60% { transform: scale(1.15); }
        100% { transform: scale(1); opacity: 1; }
    }
    .modal-icon-pop {
        animation: modal-icon-pop 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s both;
    }
</style>

<div x-data="{
    show: false,
    title: '',
    message: '',
    variant: 'danger',
    hasCancel: true,
    formEl: null,
    onConfirm: null,
    open(detail) {
        this.title = detail.title || '';
        this.message = detail.message || '';
        this.variant = detail.variant || 'danger';
        this.hasCancel = detail.hasCancel !== false;
        this.formEl = detail.form || null;
        this.onConfirm = detail.onConfirm || null;
        this.show = true;
    },
    accept() {
        this.show = false;
        if (this.formEl) this.formEl.submit();
        if (this.onConfirm) this.onConfirm();
    },
    cancel() {
        this.show = false;
        this.formEl = null;
        this.onConfirm = null;
    }
}"
x-cloak
@confirm-dialog.window="open($event.detail)"
@alert-dialog.window="open({ ...$event.detail, variant: 'info', hasCancel: false })">

    {{-- Backdrop --}}
    <div x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-950/50 backdrop-blur-md z-[100]"></div>

    {{-- Modal --}}
    <div x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-6 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         @keydown.escape.window="cancel()"
         class="fixed inset-0 z-[101] flex items-center justify-center p-4">
        <div class="relative bg-white dark:bg-slate-800 rounded-3xl
                    shadow-[0_25px_60px_-12px_rgba(0,0,0,0.35)]
                    dark:shadow-[0_25px_60px_-12px_rgba(0,0,0,0.6)]
                    border border-white/20 dark:border-slate-700/50
                    w-full max-w-sm overflow-hidden"
             @click.outside="cancel()">

            <div class="px-7 pt-8 pb-5 text-center">
                {{-- Danger Icon --}}
                <template x-if="variant === 'danger'">
                    <div class="modal-icon-pop mx-auto w-16 h-16 rounded-2xl
                                bg-gradient-to-br from-red-50 to-red-100/80
                                dark:from-red-500/10 dark:to-red-500/5
                                flex items-center justify-center mb-5
                                ring-1 ring-red-200/60 dark:ring-red-500/20">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                        </svg>
                    </div>
                </template>

                {{-- Warning Icon --}}
                <template x-if="variant === 'warning'">
                    <div class="modal-icon-pop mx-auto w-16 h-16 rounded-2xl
                                bg-gradient-to-br from-amber-50 to-amber-100/80
                                dark:from-amber-500/10 dark:to-amber-500/5
                                flex items-center justify-center mb-5
                                ring-1 ring-amber-200/60 dark:ring-amber-500/20">
                        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
                        </svg>
                    </div>
                </template>

                {{-- Info Icon --}}
                <template x-if="variant === 'info'">
                    <div class="modal-icon-pop mx-auto w-16 h-16 rounded-2xl
                                bg-gradient-to-br from-blue-50 to-indigo-50
                                dark:from-blue-500/10 dark:to-indigo-500/5
                                flex items-center justify-center mb-5
                                ring-1 ring-blue-200/60 dark:ring-blue-500/20">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                        </svg>
                    </div>
                </template>

                <h3 class="text-lg font-bold text-slate-900 dark:text-white tracking-tight"
                    x-text="title"></h3>
                <p class="mt-2.5 text-[13px] leading-relaxed text-slate-500 dark:text-slate-400"
                   x-text="message"></p>
            </div>

            {{-- Buttons --}}
            <div class="px-7 pb-7 flex gap-3" :class="!hasCancel ? 'justify-center' : ''">
                <template x-if="hasCancel">
                    <button @click="cancel()"
                            class="flex-1 px-5 py-3 text-sm font-semibold
                                   text-slate-600 dark:text-slate-300
                                   bg-slate-100 dark:bg-slate-700/80
                                   hover:bg-slate-200 dark:hover:bg-slate-600
                                   rounded-xl transition-all duration-200
                                   cursor-pointer active:scale-[0.97]">
                        Vazgec
                    </button>
                </template>
                <button @click="accept()"
                        class="px-5 py-3 text-sm font-semibold text-white rounded-xl
                               shadow-lg transition-all duration-200
                               cursor-pointer active:scale-[0.97]"
                        :class="{
                            'flex-1': hasCancel,
                            'bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 shadow-red-500/25 hover:shadow-red-500/40': variant === 'danger',
                            'bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 shadow-amber-500/25 hover:shadow-amber-500/40': variant === 'warning',
                            'bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 shadow-blue-500/25 hover:shadow-blue-500/40': variant === 'info',
                            'px-8': !hasCancel
                        }"
                        x-text="hasCancel ? 'Evet, Onayla' : 'Tamam'">
                </button>
            </div>
        </div>
    </div>
</div>
```

### Modal Tetikleme Ornekleri

```html
{{-- Form ile silme onay --}}
<form action="{{ route('blogs.delete', $item->id) }}" method="POST"
      x-data @submit.prevent="$dispatch('confirm-dialog', {
          title: 'Blogu Sil',
          message: 'Bu blogu silmek istediginize emin misiniz?',
          form: $el
      })">
    @csrf @method('DELETE')
    <button type="submit">Sil</button>
</form>

{{-- JavaScript ile onay --}}
<button @click="$dispatch('confirm-dialog', {
    title: 'Islem Onayi',
    message: 'Bu islemi gerceklestirmek istiyor musunuz?',
    variant: 'warning',
    onConfirm: () => { /* callback */ }
})">Onayla</button>

{{-- Alert (sadece bilgi, iptal yok) --}}
<button @click="$dispatch('alert-dialog', {
    title: 'Bilgi',
    message: 'Islem basariyla tamamlandi.'
})">Bilgilendir</button>
```

---

## 11. Toast / Notification

### Toast Container

```html
<div class="fixed top-4 right-4 z-[9999] flex flex-col gap-3 max-w-md w-full pointer-events-none">
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="true"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-8"
             class="pointer-events-auto rounded-xl shadow-2xl border backdrop-blur-sm"
             :class="{
                 'bg-emerald-50/95 dark:bg-emerald-900/90 border-emerald-200 dark:border-emerald-700': toast.type === 'success',
                 'bg-red-50/95 dark:bg-red-900/90 border-red-200 dark:border-red-700': toast.type === 'error',
                 'bg-amber-50/95 dark:bg-amber-900/90 border-amber-200 dark:border-amber-700': toast.type === 'warning',
                 'bg-blue-50/95 dark:bg-blue-900/90 border-blue-200 dark:border-blue-700': toast.type === 'info'
             }">
            <div class="flex items-start gap-3 p-4">
                {{-- Icon --}}
                <div class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center"
                     :class="{
                         'bg-emerald-500': toast.type === 'success',
                         'bg-red-500': toast.type === 'error',
                         'bg-amber-500': toast.type === 'warning',
                         'bg-blue-500': toast.type === 'info'
                     }">
                    {{-- Success --}}
                    <svg x-show="toast.type === 'success'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{-- Error --}}
                    <svg x-show="toast.type === 'error'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    {{-- Warning --}}
                    <svg x-show="toast.type === 'warning'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    {{-- Info --}}
                    <svg x-show="toast.type === 'info'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                {{-- Message --}}
                <p class="flex-1 text-sm font-medium"
                   :class="{
                       'text-emerald-800 dark:text-emerald-200': toast.type === 'success',
                       'text-red-800 dark:text-red-200': toast.type === 'error',
                       'text-amber-800 dark:text-amber-200': toast.type === 'warning',
                       'text-blue-800 dark:text-blue-200': toast.type === 'info'
                   }"
                   x-text="toast.message"></p>

                {{-- Close --}}
                <button @click="removeToast(toast.id)"
                        class="flex-shrink-0 p-1 rounded-lg transition-colors"
                        :class="{
                            'text-emerald-500 hover:bg-emerald-100 dark:hover:bg-emerald-800': toast.type === 'success',
                            'text-red-500 hover:bg-red-100 dark:hover:bg-red-800': toast.type === 'error',
                            'text-amber-500 hover:bg-amber-100 dark:hover:bg-amber-800': toast.type === 'warning',
                            'text-blue-500 hover:bg-blue-100 dark:hover:bg-blue-800': toast.type === 'info'
                        }">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>
```

### Laravel Session Flash ile Tetikleme

```html
@if(session('success'))
    <div x-init="addToast('success', @js(session('success')))"></div>
@endif
@if(session('error'))
    <div x-init="addToast('error', @js(session('error')))"></div>
@endif
@if(session('warning'))
    <div x-init="addToast('warning', @js(session('warning')))"></div>
@endif
@if(session('info'))
    <div x-init="addToast('info', @js(session('info')))"></div>
@endif
@if($errors->any())
    @foreach($errors->all() as $error)
        <div x-init="addToast('error', @js($error))"></div>
    @endforeach
@endif
```

### Controller'dan Toast Tetikleme

```php
// Success
return redirect()->route('blogs.index')->with('success', 'Blog basariyla olusturuldu.');

// Error
return redirect()->back()->with('error', 'Bir hata olustu.');

// Warning
return redirect()->back()->with('warning', 'Dikkat! Bu islem geri alinamaz.');

// Info
return redirect()->back()->with('info', 'Kayit guncellendi.');
```

---

## 12. Dropdown / Popover

### Alpine.js Dropdown Pattern

```html
<div x-data="{ open: false }" class="relative">
    {{-- Trigger --}}
    <button @click="open = !open" type="button" class="...">
        Trigger
        <svg class="w-4 h-4 transition-transform duration-200"
             :class="{ 'rotate-180': open }"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    {{-- Dropdown Menu --}}
    <div x-show="open"
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         class="absolute right-0 mt-3 w-64 origin-top-right rounded-2xl
                bg-white dark:bg-slate-800 shadow-xl
                ring-1 ring-black/5 dark:ring-white/10
                focus:outline-none overflow-hidden"
         style="display: none;">

        {{-- Header --}}
        <div class="px-4 py-4 bg-gradient-to-r from-slate-50 to-slate-100
                    dark:from-slate-700 dark:to-slate-800
                    border-b border-slate-200 dark:border-slate-700">
            <p class="text-sm font-semibold text-slate-900 dark:text-white">Baslik</p>
        </div>

        {{-- Items --}}
        <div class="py-2">
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm
                              text-slate-700 dark:text-slate-300
                              hover:bg-slate-50 dark:hover:bg-slate-700/50
                              transition-colors duration-150">
                <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700
                            flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-600 dark:text-slate-400">...</svg>
                </div>
                <span>Menu Ogesi</span>
            </a>
        </div>

        {{-- Divider --}}
        <div class="py-2 border-t border-slate-200 dark:border-slate-700">
            <button class="flex items-center gap-3 w-full px-4 py-2.5 text-sm
                          text-red-600 dark:text-red-400
                          hover:bg-red-50 dark:hover:bg-red-900/20
                          transition-colors duration-150">
                <div class="w-8 h-8 rounded-lg bg-red-100 dark:bg-red-900/30
                            flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-600 dark:text-red-400">...</svg>
                </div>
                <span>Cikis Yap</span>
            </button>
        </div>
    </div>
</div>
```

### Scale Transition Dropdown (Tablo Aksiyonlari)

```html
<div x-show="open" @click.away="open = false"
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95"
    class="absolute right-0 z-20 mt-2 w-44
           bg-white dark:bg-slate-700
           rounded-xl shadow-lg
           border border-slate-200/50 dark:border-slate-700/50 py-1"
    style="display: none;">
    <a href="#" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200
                       hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
        Oge 1
    </a>
    <a href="#" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200
                       hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
        Oge 2
    </a>
</div>
```

---

## 13. Ikonlar (SVG)

Tum ikonlar **Heroicons Outline** (stroke) stilindedir.
Standart boyutlar: `w-4 h-4`, `w-5 h-5`, `w-7 h-7`, `w-8 h-8`

### Dashboard / Home

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
</svg>
```

### Sayfalar / Document

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
</svg>
```

### Blog / Edit

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
</svg>
```

### Slider / Image

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
</svg>
```

### Hizmet / Settings Gear

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
</svg>
```

### Proje / Archive Box

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
</svg>
```

### Referans / Star

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
</svg>
```

### Ekip / Users

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
</svg>
```

### Iletisim / Mail

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
</svg>
```

### SSS / Question Mark

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
</svg>
```

### Menu / Hamburger

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"/>
</svg>
```

### Footer / Building

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21"/>
</svg>
```

### Diller / Translate

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
</svg>
```

### Ayarlar / Sliders

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
</svg>
```

### Plus / Ekle

```html
<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>
```

### Trash / Sil

```html
<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
</svg>
```

### Checkmark / Onay

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
</svg>
```

### Close / X

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
</svg>
```

### Back Arrow / Geri

```html
<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
</svg>
```

### Upload / Yukle

```html
<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
</svg>
```

### External Link

```html
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
</svg>
```

### Chevron Down

```html
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
</svg>
```

### Double Chevron (Sidebar Collapse)

```html
<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
</svg>
```

### Moon (Dark Mode)

```html
<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
</svg>
```

### Sun (Light Mode)

```html
<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
</svg>
```

### Profile / User

```html
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
</svg>
```

### Logout

```html
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
</svg>
```

### Drag Handle

```html
<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
</svg>
```

### Tag / Etiket

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
</svg>
```

### Clipboard / Ozellikler

```html
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
</svg>
```

### Video

```html
<svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z"/>
</svg>
```

---

## 14. Renk Sistemi

### Primary Gradient

```
from-fuchsia-500 to-purple-500       → Butonlar, kaydirici ikonlar
hover:from-fuchsia-600 hover:to-purple-600
shadow-fuchsia-500/25 hover:shadow-fuchsia-500/40
```

### Site Link Gradient

```
from-fuchsia-500 to-blue-600         → "Siteyi Gor" butonu
hover:from-fuchsia-600 hover:to-blue-700
```

### User Avatar Gradient

```
from-fuchsia-500 to-purple-600       → Kullanici avatar
from-fuchsia-500 via-fuchsia-500 to-pink-500  → Navbar avatar
```

### Active State (Sidebar)

```
bg-fuchsia-50 dark:bg-fuchsia-500/10           → Active menu item bg
text-fuchsia-600 dark:text-fuchsia-400          → Active menu text
bg-fuchsia-500 text-white shadow-lg shadow-fuchsia-500/30  → Active icon bg
```

### Inactive State (Sidebar)

```
text-slate-600 dark:text-slate-400              → Normal menu text
hover:bg-slate-100 dark:hover:bg-slate-800      → Hover menu bg
bg-slate-100 dark:bg-slate-800                  → Normal icon bg
text-slate-500 dark:text-slate-400              → Normal icon color
```

### Status Renkleri

| Durum | Light BG | Light Text | Dark BG | Dark Text |
|-------|----------|------------|---------|-----------|
| Success | `bg-emerald-50` | `text-emerald-700` | `dark:bg-emerald-900/30` | `dark:text-emerald-400` |
| Error | `bg-red-50` | `text-red-700` | `dark:bg-red-900/30` | `dark:text-red-400` |
| Warning | `bg-amber-50` | `text-amber-700` | `dark:bg-amber-900/30` | `dark:text-amber-400` |
| Info | `bg-blue-50` | `text-blue-700` | `dark:bg-blue-900/30` | `dark:text-blue-400` |
| Default | `bg-fuchsia-50` | `text-fuchsia-700` | `dark:bg-fuchsia-900/30` | `dark:text-fuchsia-400` |

### Card Icon Renkleri

| Bolum | Light BG | Icon Color |
|-------|----------|------------|
| Icerik (Primary) | `bg-fuchsia-100 dark:bg-fuchsia-900/30` | `text-fuchsia-500` |
| Ayarlar/Etiket | `bg-blue-100 dark:bg-blue-900/30` | `text-blue-500` |
| Medya/Gorsel | `bg-emerald-100 dark:bg-emerald-900/30` | `text-emerald-500` |
| Galeri/Linkler | `bg-amber-100 dark:bg-amber-900/30` | `text-amber-500` |
| Konfigurasyon | `bg-violet-100 dark:bg-violet-900/30` | `text-violet-500` |

### Neutral Palette (Slate)

```
bg-slate-50     → Input bg, table header, hover
bg-slate-100    → Body bg (light), hover states
bg-slate-200    → Borders
bg-slate-400    → Placeholder text, inactive icons
bg-slate-500    → Secondary text
bg-slate-700    → Input bg (dark), borders (dark)
bg-slate-800    → Card bg (dark), sidebar bg item hover (dark)
bg-slate-900    → Sidebar bg (dark)
bg-slate-950    → Body bg (dark), modal backdrop
```

---

## 15. CSS Custom Patterns

### Glass Morphism

```css
.glass {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}
.dark .glass {
    background: rgba(30, 41, 59, 0.8);
}
```

### Gradient Text

```css
.gradient-text {
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
```

### Custom Scrollbar

```css
::-webkit-scrollbar { width: 6px; height: 6px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
.dark ::-webkit-scrollbar-thumb { background: #475569; }
.dark ::-webkit-scrollbar-thumb:hover { background: #64748b; }
```

### Modal Icon Pop Animation

```css
@keyframes modal-icon-pop {
    0% { transform: scale(0); opacity: 0; }
    60% { transform: scale(1.15); }
    100% { transform: scale(1); opacity: 1; }
}
.modal-icon-pop {
    animation: modal-icon-pop 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s both;
}
```

### Alpine.js Cloak

```css
[x-cloak] { display: none !important; }
```

### Loading State (Transition Blocker)

```css
.is-loading, .is-loading * { transition: none !important; }
```

### Onemli Tailwind Utilities

```
rounded-xl     → 12px (inputlar, butonlar, ikonlar)
rounded-2xl    → 16px (kartlar, tablolar)
rounded-3xl    → 24px (modaller)
rounded-full   → Pill badge'ler, avatar dot
rounded-lg     → 8px (submenu item'lar, badge'ler)

shadow-sm      → Kartlar
shadow-lg      → Primary butonlar, active sidebar icon
shadow-xl      → Dropdown menular
shadow-2xl     → Toast notifications

transition-all duration-200  → Standart gecis
transition-all duration-300  → Sidebar, layout
transition-colors duration-150  → Dropdown items
```

---

## 16. JavaScript Patterns

### Alpine.js Global State (Body)

```javascript
// Body x-data icinde tanimli
{
    sidebarOpen: false,                                          // Mobile sidebar
    sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',  // Desktop collapse
    darkMode: localStorage.getItem('darkMode') === 'true',       // Dark mode
    toasts: [],                                                  // Toast listesi
    addToast(type, message, duration = 5000) { ... },           // Toast ekle
    removeToast(id) { ... }                                      // Toast sil
}
```

### Summernote Initialization

```javascript
$(document).ready(function() {
    $('#editor').summernote({
        height: 300,
        placeholder: 'Icerik girin',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear', 'strikethrough',
                       'superscript', 'subscript', 'removeFormat', 'code']],
            ['font', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['link', 'picture']]
        ]
    });
});
```

### TomSelect Initialization

```javascript
new TomSelect('#categories', {
    create: false,
    highlight: true,
    persist: false,
    openOnFocus: true,
    allowEmptyOption: false,
    placeholder: 'Kategori secin...',
    hidePlaceholder: true,
});
```

### Sortable.js Initialization

```javascript
document.addEventListener('DOMContentLoaded', function() {
    new Sortable(document.getElementById('sortable-items'), {
        animation: 150,
        handle: 'tr',
        ghostClass: 'bg-fuchsia-50',
        onEnd: function() {
            const order = [];
            document.querySelectorAll('#sortable-items tr').forEach(function(row) {
                order.push(row.dataset.id);
            });
            fetch('/api/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ order: order })
            });
        }
    });
});
```

### File Preview (jQuery)

```javascript
$(document).ready(function() {
    $('#file').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_image').attr('src', e.target.result).removeClass('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            $('#preview_image').addClass('hidden');
        }
    });
});
```

### Ajax File Upload with Progress

```javascript
const formData = new FormData();
formData.append('file', file);

$.ajax({
    url: '/upload-endpoint',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    xhr: function() {
        const xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBar.css('width', percent + '%');
            }
        });
        return xhr;
    },
    success: function(res) {
        // Handle success
    },
    error: function(res) {
        // Handle error
    }
});
```

### Global Event Dispatch (Modal/Alert)

```javascript
// Confirm dialog (onay + iptal)
$dispatch('confirm-dialog', {
    title: 'Baslik',
    message: 'Mesaj',
    variant: 'danger',  // danger | warning | info
    form: $el,           // Form element (submit edilecek)
    onConfirm: () => {}  // Callback
});

// Alert dialog (sadece tamam)
$dispatch('alert-dialog', {
    title: 'Bilgi',
    message: 'Mesaj'
});
```

### Dynamic Field Management

```javascript
let index = 1;

// Ekle
$('#add-item').on('click', function() {
    const field = `<div class="item">...</div>`;
    $('#items-wrapper').append(field);
    index++;
});

// Sil (event delegation)
$(document).on('click', '.remove-item', function() {
    $(this).closest('.item').remove();
    // En az 1 satir kalmasini sagla
    if ($('#items-wrapper .item').length === 0) {
        $('#add-item').click();
    }
});
```

---

## 17. Permission / Authorization

### Spatie Laravel Permission

```bash
composer require spatie/laravel-permission
```

### Permission Adlandirma Kurali

```
{modul}.{aksiyon}

Ornekler:
- blogs.view
- blogs.create
- blogs.edit
- blogs.delete
- blogs.translate
- blogs.categories
```

### Blade Directives

```html
{{-- Tek yetki kontrolu --}}
@can('blogs.view')
    {{-- Gorunur icerik --}}
@endcan

{{-- Birden fazla yetki (herhangi biri) --}}
@canany(['menus.view', 'footer.view', 'users.view'])
    {{-- Gorunur icerik --}}
@endcanany

{{-- Yetki yoksa --}}
@cannot('blogs.delete')
    {{-- Alternatif icerik --}}
@endcannot
```

### Sidebar'da Kullanim

```html
{{-- Tek seviye menu --}}
@can('dashboard.view')
<a href="{{ route('dashboard.index') }}">Dashboard</a>
@endcan

{{-- Dropdown menu --}}
@can('blogs.view')
<div class="group/blogs relative">
    <button>Blog</button>
    <div>
        <a href="{{ route('blogs.index') }}">Tumu</a>
        @can('blogs.create')
        <a href="{{ route('blogs.create') }}">Ekle</a>
        @endcan
        @can('blogs.categories')
        <a href="{{ route('blogs.categories.index') }}">Kategoriler</a>
        @endcan
    </div>
</div>
@endcan

{{-- Bolum ayirici --}}
@canany(['menus.view', 'footer.view', 'users.view', 'languages.view', 'settings.view'])
<div class="pt-4">
    <p>Panel</p>
</div>
@endcanany
```

### Tablo Aksiyonlarinda Kullanim

```html
<td>
    <div class="flex items-center gap-1">
        @can('blogs.delete')
        <form action="{{ route('blogs.delete', $item->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit">Sil</button>
        </form>
        @endcan

        @can('blogs.translate')
        <div x-data="{ open: false }">
            <button @click="open = !open">Ceviri</button>
            {{-- Dropdown --}}
        </div>
        @endcan

        @can('blogs.edit')
        <a href="{{ route('blogs.edit', $item->id) }}">Duzenle</a>
        @endcan
    </div>
</td>
```

### Controller'da Kullanim

```php
// Route middleware (web.php)
Route::middleware(['auth', 'permission:blogs.view'])->group(function () {
    Route::get('/panel/blogs', [BlogController::class, 'index'])->name('blogs.index');
});

// Controller icinde
public function edit($id) {
    abort_unless(auth()->user()->can('blogs.edit'), 403);
    // ...
}
```

### Page Banner'da Kullanim

```html
@section('page-banner')
    <div>
        <h1>Blog Yazilari</h1>
    </div>
    @can('blogs.create')
    <a href="{{ route('blogs.create') }}" class="...">
        Yeni Blog Ekle
    </a>
    @endcan
@endsection
```

---

## Hizli Basvuru Tablosu

| Bilesen | Tailwind Sinifi |
|---------|----------------|
| Body BG | `bg-slate-100 dark:bg-slate-950` |
| Card BG | `bg-white dark:bg-slate-800` |
| Card Border | `border border-slate-200/50 dark:border-slate-700/50` |
| Card Radius | `rounded-2xl` |
| Input BG | `bg-slate-50 dark:bg-slate-700` |
| Input Radius | `rounded-xl` |
| Input Focus | `focus:ring-2 focus:ring-fuchsia-500/50` |
| Button Radius | `rounded-xl` |
| Primary Gradient | `from-fuchsia-500 to-purple-500` |
| Label | `text-sm font-medium text-slate-700 dark:text-slate-300` |
| Error Text | `text-sm text-red-600` |
| Heading | `text-2xl font-bold text-slate-900 dark:text-white` |
| Subtext | `text-sm text-slate-500 dark:text-slate-400` |
| Sidebar Width | `w-72` (expanded), `w-20` (collapsed) |
| Navbar Height | `h-16` |
| Z-Index | Sidebar: `z-50`, Navbar: `z-30`, Toast: `z-[9999]`, Modal: `z-[100-101]` |
| Font | `font-[Inter]` |
| Transition | `transition-all duration-200` |
