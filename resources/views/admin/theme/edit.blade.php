@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Sidebar Tema</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            Sol menünün renklerini buradan özelleştirin. Değişiklikler kaydedildikten sonra anında uygulanır.
        </p>
    </div>
@endsection

@section('content')
<div x-data="themeForm({{ \Illuminate\Support\Js::from($colors) }})" class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Sol: Form (2/3) --}}
    <div class="lg:col-span-2 space-y-6">

        @if (session('success'))
            <div class="rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('theme.update') }}" method="POST" class="space-y-6">
            @csrf

            @foreach ($groups as $groupName => $fields)
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">
                            {{ $groupName }}
                        </h3>
                    </div>
                    <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($fields as $key => $label)
                            <div class="flex items-center gap-3">
                                <input type="color"
                                       x-model="colors.{{ $key }}"
                                       @input="colors.{{ $key }} = $event.target.value.toLowerCase()"
                                       class="w-12 h-12 rounded-lg border border-slate-200 dark:border-slate-600 cursor-pointer flex-shrink-0 bg-transparent">
                                <div class="flex-1 min-w-0">
                                    <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1 truncate">
                                        {{ $label }}
                                    </label>
                                    <input type="text"
                                           name="colors[{{ $key }}]"
                                           x-model="colors.{{ $key }}"
                                           pattern="^#[0-9a-fA-F]{6}$"
                                           maxlength="7"
                                           class="w-full px-2 py-1.5 text-xs font-mono rounded-md border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-fuchsia-500/30 focus:border-fuchsia-500">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="flex items-center justify-between gap-3">
                <button type="button"
                        @click="if (confirm('Tüm renkleri varsayılana sıfırlamak istediğinizden emin misiniz?')) { document.getElementById('theme-reset-form').submit(); }"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium
                               text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800
                               hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                    </svg>
                    Varsayılana Sıfırla
                </button>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-medium text-white
                               bg-gradient-to-r from-fuchsia-500 to-purple-600
                               hover:from-fuchsia-600 hover:to-purple-700
                               shadow-sm hover:shadow-md hover:shadow-fuchsia-500/25
                               transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    Renkleri Kaydet
                </button>
            </div>
        </form>

        <form action="{{ route('theme.reset') }}" method="POST" id="theme-reset-form" class="hidden">
            @csrf
        </form>
    </div>

    {{-- Sağ: Canlı Önizleme (1/3, sticky) --}}
    <div class="lg:col-span-1">
        <div class="sticky top-20">
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-5 py-3 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                    <h3 class="text-xs font-semibold text-slate-900 dark:text-white uppercase tracking-wider">Canlı Önizleme</h3>
                </div>
                <div class="p-4 bg-slate-100 dark:bg-slate-900">
                    {{-- Mini sidebar --}}
                    <div class="rounded-xl overflow-hidden border"
                         :style="`background:${colors.sidebar_bg}; border-color:${colors.sidebar_border};`">
                        {{-- Mini section title --}}
                        <div class="px-3 pt-3 pb-2">
                            <p class="text-xs font-medium uppercase tracking-wider" :style="`color:${colors.section_title_text};`">
                                Eğitim
                            </p>
                        </div>
                        {{-- Aktif menü item --}}
                        <div class="px-3 space-y-1 pb-2">
                            <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium"
                                 :style="`background:${colors.menu_bg_active}; color:${colors.menu_text_active};`">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                                     :style="`background:${colors.icon_bg_active}; color:${colors.icon_text_active};`">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347"/>
                                    </svg>
                                </div>
                                <span class="flex-1">Kurslar</span>
                                <span class="text-[10px] font-normal opacity-60">aktif</span>
                            </div>
                            {{-- Alt menü --}}
                            <div class="ml-12 space-y-1">
                                <div class="flex items-center justify-between gap-2 px-3 py-1.5 rounded-lg text-sm font-medium"
                                     :style="`background:${colors.submenu_bg_active}; color:${colors.submenu_text_active};`">
                                    <span>Sınıflar</span>
                                    <span class="text-[10px] font-normal opacity-60">aktif</span>
                                </div>
                                <div class="flex items-center justify-between gap-2 px-3 py-1.5 rounded-lg text-sm"
                                     :style="`color:${colors.submenu_text};`">
                                    <span>Kayıtlar</span>
                                    <span class="text-[10px] opacity-60">normal</span>
                                </div>
                                <div class="flex items-center justify-between gap-2 px-3 py-1.5 rounded-lg text-sm"
                                     :style="`background:${colors.submenu_bg_hover}; color:${colors.submenu_text};`">
                                    <span>Kurs</span>
                                    <span class="text-[10px] opacity-60">hover</span>
                                </div>
                            </div>
                        </div>
                        {{-- Normal menü item --}}
                        <div class="px-3 space-y-1 pb-2">
                            <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium"
                                 :style="`color:${colors.menu_text};`">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                                     :style="`background:${colors.icon_bg}; color:${colors.icon_text};`">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Z"/>
                                    </svg>
                                </div>
                                <span class="flex-1">Eğitmenler</span>
                                <span class="text-[10px] font-normal opacity-60">normal</span>
                            </div>
                            {{-- Hover state --}}
                            <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium"
                                 :style="`background:${colors.menu_bg_hover}; color:${colors.menu_text};`">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                                     :style="`background:${colors.icon_bg}; color:${colors.icon_text};`">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5"/>
                                    </svg>
                                </div>
                                <span class="flex-1">Mağaza</span>
                                <span class="text-[10px] font-normal opacity-60">hover</span>
                            </div>
                        </div>
                        {{-- Divider --}}
                        <div class="mx-3 border-t" :style="`border-color:${colors.section_divider};`"></div>
                        {{-- Avatar --}}
                        <div class="p-3 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold"
                                 :style="`background:linear-gradient(to bottom right, ${colors.avatar_from}, ${colors.avatar_to});`">
                                A
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold truncate" :style="`color:${colors.menu_text};`">Admin</p>
                                <p class="text-xs truncate" :style="`color:${colors.submenu_text};`">admin@site.com</p>
                            </div>
                        </div>
                    </div>
                    {{-- Buton önizlemesi --}}
                    <div class="mt-4 p-3 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 space-y-2">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Butonlar</p>
                        <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all"
                                :style="`background-image:linear-gradient(to right, ${colors.btn_primary_from}, ${colors.btn_primary_to}); color:${colors.btn_primary_text};`">
                            Kaydet
                        </button>
                        <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl border transition-all"
                                :style="`background:${colors.btn_secondary_bg}; color:${colors.btn_secondary_text}; border-color:${colors.btn_secondary_border};`">
                            Vazgeç
                        </button>
                        <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all"
                                :style="`background:${colors.btn_danger_bg}; color:${colors.btn_danger_text};`">
                            Sil
                        </button>
                    </div>

                    <p class="mt-3 text-xs text-slate-500 dark:text-slate-400 text-center">
                        Renkler kaydedildikten sonra tüm panelde geçerli olur.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function themeForm(initialColors) {
        return {
            colors: initialColors,
        }
    }
</script>
@endsection
