@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Ön Kayıtlar</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Ön kayıtlı öğrencileri yönetin</p>
    </div>
    @can('student')
        <a href="{{ route('students.pre.createPreRegistiration') }}"
           class="inline-flex items-center gap-2 px-6 py-3
                  bg-gradient-to-r from-fuchsia-500 to-purple-500
                  hover:from-fuchsia-600 hover:to-purple-600
                  text-white font-semibold rounded-xl
                  shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Yeni Ön Kayıt
        </a>
    @endcan
@endsection

@section('content')
    {{-- Özet Kartları --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Toplam Ön Kayıt --}}
        <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $preCount }}</p>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Ön Kayıt</p>
                </div>
            </div>
            <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-amber-500/5 dark:bg-amber-500/10"></div>
        </div>

        {{-- Görüşüldü --}}
        <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $metCount }}</p>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Görüşüldü</p>
                </div>
            </div>
            <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-emerald-500/5 dark:bg-emerald-500/10"></div>
        </div>

        {{-- Görüşülecek --}}
        <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center shadow-lg shadow-violet-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $pendingMeetCount }}</p>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Görüşülecek</p>
                </div>
            </div>
            <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-violet-500/5 dark:bg-violet-500/10"></div>
        </div>

        {{-- Kesin Kayıtlar --}}
        <a href="{{ route('students.index') }}"
           class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-5
                  hover:border-blue-300 dark:hover:border-blue-600 hover:shadow-md hover:shadow-blue-500/5 transition-all group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/20
                            group-hover:scale-105 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $normalCount }}</p>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-0.5">Kesin Kayıt</p>
                </div>
            </div>
            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 dark:text-slate-600
                        group-hover:text-blue-400 group-hover:translate-x-0.5 transition-all"
                 fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
            </svg>
            <div class="absolute -right-3 -bottom-3 w-20 h-20 rounded-full bg-blue-500/5 dark:bg-blue-500/10"></div>
        </a>
    </div>

    {{-- Sekme Navigasyonu --}}
    <div class="flex items-center gap-1 mb-5 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-1.5">
        <a href="{{ route('students.index') }}"
           class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium rounded-xl
                  text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200
                  hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-all">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            Kesin Kayıtlar
            <span class="inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[11px] font-bold
                         bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 rounded-md">{{ $normalCount }}</span>
        </a>
        <a href="{{ route('students.pre.students') }}"
           class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl
                  bg-gradient-to-r from-fuchsia-500 to-purple-500 text-white shadow-sm shadow-fuchsia-500/20">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            Ön Kayıtlar
            <span class="inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[11px] font-bold bg-white/20 rounded-md">{{ $preCount }}</span>
        </a>
    </div>

    {{-- Filtreler --}}
    @php
        $activeCount = ($filterName ? 1 : 0) + count($selectedStatuses);
        $allStatuses = ['Görüşüldü', 'Görüşülmedi', 'Görüşülecek'];
        $statusColors = [
            'Görüşüldü'   => 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 border-emerald-200/60 dark:border-emerald-700/40',
            'Görüşülmedi' => 'bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 border-red-200/60 dark:border-red-700/40',
            'Görüşülecek' => 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 border-amber-200/60 dark:border-amber-700/40',
        ];
        $statusDots = [
            'Görüşüldü'   => 'bg-emerald-500',
            'Görüşülmedi' => 'bg-red-500',
            'Görüşülecek' => 'bg-amber-500',
        ];
    @endphp
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 mb-5"
         x-data="{ filtersOpen: {{ $activeCount > 0 ? 'true' : 'false' }} }">

        {{-- Kart Başlığı --}}
        <button @click="filtersOpen = !filtersOpen" type="button"
                class="w-full flex items-center justify-between px-5 py-3.5 cursor-pointer select-none
                       hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors rounded-2xl"
                :class="filtersOpen ? 'rounded-b-none border-b border-slate-100 dark:border-slate-700/50' : ''">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-sm shadow-fuchsia-500/20">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                </div>
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Filtreler</span>
                @if($activeCount > 0)
                    <span class="inline-flex items-center justify-center w-5 h-5 text-[11px] font-bold
                                 bg-fuchsia-500 text-white rounded-full animate-pulse">{{ $activeCount }}</span>
                @endif
            </div>
            <div class="flex items-center gap-3">
                @if($activeCount > 0)
                    <a href="{{ route('students.pre.students', ['_clear' => 1]) }}"
                       @click.stop
                       class="inline-flex items-center gap-1 text-xs font-medium text-slate-400
                              hover:text-red-500 dark:hover:text-red-400 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Temizle
                    </a>
                @endif
                <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="filtersOpen ? 'rotate-180' : ''"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </button>

        {{-- Filtre Girdileri --}}
        <div x-show="filtersOpen" x-collapse>
            <form method="GET" action="{{ route('students.pre.students') }}" id="filterForm" class="px-5 py-4">
                <div class="flex flex-wrap items-end gap-4">

                    {{-- Ad Soyad --}}
                    <div class="flex-1 min-w-52">
                        <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Ad Soyad</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                            </svg>
                            <input type="text" name="name" value="{{ $filterName }}" placeholder="Ad, soyad ara…"
                                   class="w-full pl-9 pr-4 py-2.5 text-sm rounded-xl
                                          border border-slate-200 dark:border-slate-600
                                          bg-slate-50 dark:bg-slate-700/50
                                          text-slate-900 dark:text-white placeholder-slate-400
                                          focus:outline-none focus:ring-2 focus:ring-fuchsia-500/30 focus:border-fuchsia-400 transition-all">
                        </div>
                    </div>

                    {{-- Randevu Durumu — Alpine dropdown --}}
                    <div class="relative min-w-48"
                         x-data="{
                             open: false,
                             selected: {{ json_encode($selectedStatuses) }},
                             items: ['Görüşüldü', 'Görüşülmedi', 'Görüşülecek'],
                             toggle(v) { const i = this.selected.indexOf(v); i === -1 ? this.selected.push(v) : this.selected.splice(i, 1); },
                             label() {
                                 if (!this.selected.length) return 'Tüm Durumlar';
                                 if (this.selected.length === 1) return this.selected[0];
                                 return this.selected.length + ' Durum Seçildi';
                             }
                         }"
                         @click.outside="open = false">
                        <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Randevu Durumu</label>
                        <button type="button" @click.stop="open = !open"
                                :class="selected.length ? 'border-fuchsia-300 dark:border-fuchsia-600 bg-fuchsia-50 dark:bg-fuchsia-900/20' : 'border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50'"
                                class="w-full flex items-center justify-between px-3 py-2.5 text-sm rounded-xl border transition-all cursor-pointer">
                            <span :class="selected.length ? 'text-fuchsia-700 dark:text-fuchsia-300' : 'text-slate-700 dark:text-slate-300'"
                                  x-text="label()"></span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute z-30 mt-1 w-48 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-600 shadow-lg overflow-hidden">
                            <template x-for="v in items" :key="v">
                                <div @click.stop="toggle(v)"
                                     class="flex items-center gap-3 px-3 py-2.5 hover:bg-slate-50 dark:hover:bg-slate-700/50 cursor-pointer transition-colors select-none">
                                    <div :class="selected.includes(v) ? 'bg-fuchsia-500 border-fuchsia-500' : 'border-slate-300 dark:border-slate-500 bg-white dark:bg-slate-700'"
                                         class="w-4 h-4 rounded border-2 flex items-center justify-center flex-shrink-0 transition-all">
                                        <svg x-show="selected.includes(v)" class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-slate-700 dark:text-slate-300 flex-1" x-text="v"></span>
                                </div>
                            </template>
                        </div>
                        <template x-for="v in selected" :key="v">
                            <input type="hidden" name="meets_status[]" :value="v">
                        </template>
                    </div>

                    {{-- Filtrele --}}
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl
                                   bg-gradient-to-r from-fuchsia-500 to-purple-500
                                   hover:from-fuchsia-600 hover:to-purple-600
                                   shadow-sm shadow-fuchsia-500/20 transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                        Filtrele
                    </button>
                </div>

                {{-- Aktif Filtre Chip'leri --}}
                @if($activeCount > 0)
                    <div class="flex flex-wrap items-center gap-2 mt-4 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                        <span class="text-xs font-medium text-slate-400 dark:text-slate-500">Aktif:</span>

                        @if($filterName)
                            <a href="{{ route('students.pre.students', ['_rm' => 'name']) }}"
                               class="inline-flex items-center gap-1.5 pl-2.5 pr-1.5 py-1 rounded-lg text-xs font-medium
                                      bg-fuchsia-50 dark:bg-fuchsia-900/20 text-fuchsia-700 dark:text-fuchsia-300
                                      border border-fuchsia-200/60 dark:border-fuchsia-700/40
                                      hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900/40 transition-colors">
                                "{{ $filterName }}"
                                <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif

                        @foreach($selectedStatuses as $s)
                            @php $colorClass = $statusColors[$s] ?? $statusColors['Görüşülecek']; $dotClass = $statusDots[$s] ?? 'bg-amber-500'; @endphp
                            <a href="{{ route('students.pre.students', ['_rm' => 'meets_status', '_val' => $s]) }}"
                               class="inline-flex items-center gap-1.5 pl-2.5 pr-1.5 py-1 rounded-lg text-xs font-medium border
                                      {{ $colorClass }} hover:opacity-80 transition-colors">
                                <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
                                {{ $s }}
                                <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Sonuç Bilgisi --}}
    <div class="flex items-center justify-between mb-3 px-1">
        <p class="text-sm text-slate-500 dark:text-slate-400">
            <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $students->total() }}</span> ön kayıt bulundu
            @if($activeCount > 0)
                <span class="text-fuchsia-500 font-medium">(filtrelenmiş)</span>
            @endif
        </p>
        <p class="text-xs text-slate-400 dark:text-slate-500">
            Sayfa {{ $students->currentPage() }} / {{ $students->lastPage() }}
        </p>
    </div>

    {{-- Tablo --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-gradient-to-r from-slate-50 to-slate-100/50 dark:from-slate-700/60 dark:to-slate-700/40
                               [&>th:first-child]:rounded-tl-2xl [&>th:last-child]:rounded-tr-2xl">
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Öğrenci</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Yaş</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider hidden md:table-cell">Veli</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Randevu</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider hidden lg:table-cell">Kayıt Tarihi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($students as $item)
                        @php
                            $avatarColors = [
                                'from-amber-400 to-orange-500',
                                'from-rose-400 to-pink-500',
                                'from-fuchsia-400 to-purple-500',
                                'from-violet-400 to-indigo-500',
                                'from-cyan-400 to-blue-500',
                                'from-teal-400 to-emerald-500',
                                'from-lime-400 to-green-500',
                                'from-yellow-400 to-amber-500',
                            ];
                            $colorIndex = crc32($item->full_name) % count($avatarColors);
                        @endphp

                        @include('admin.components.action-button-student', ['student' => $item])

                        <tr class="group hover:bg-amber-50/30 dark:hover:bg-amber-900/5 transition-colors duration-150">
                            {{-- Öğrenci --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $avatarColors[$colorIndex] }}
                                                flex items-center justify-center flex-shrink-0 shadow-sm
                                                group-hover:shadow-md group-hover:scale-105 transition-all duration-200">
                                        <span class="text-xs font-bold text-white uppercase">
                                            {{ strtoupper(mb_substr($item->full_name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div class="min-w-0">
                                        <a href="{{ route('students.pre.editPreRegistiration', $item->id) }}"
                                           class="font-semibold text-slate-900 dark:text-white
                                                  hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors
                                                  truncate block">
                                            {{ $item->full_name }}
                                        </a>
                                        <span class="inline-flex items-center gap-1 text-[11px] font-medium text-amber-600 dark:text-amber-400 mt-0.5">
                                            <span class="w-1 h-1 rounded-full bg-amber-500"></span>
                                            Ön Kayıt
                                        </span>
                                    </div>
                                </div>
                            </td>

                            {{-- Yaş --}}
                            <td class="px-6 py-4">
                                <span class="text-slate-700 dark:text-slate-300 font-medium">
                                    {{ \Carbon\Carbon::parse($item->birth_date)->age }}
                                </span>
                                <span class="text-xs text-slate-400 ml-0.5">yaş</span>
                            </td>

                            {{-- Veli --}}
                            <td class="px-6 py-4 hidden md:table-cell">
                                @if($item->guardians->first())
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-slate-400 to-slate-500
                                                    flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <span class="text-[10px] font-bold text-white uppercase">
                                                {{ strtoupper(mb_substr($item->guardians->first()->full_name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="text-slate-700 dark:text-slate-300 text-sm font-medium truncate block">
                                                {{ $item->guardians->first()->full_name }}
                                            </span>
                                            @if($item->guardians->first()->phone)
                                                <span class="text-[11px] text-slate-400 dark:text-slate-500">
                                                    {{ $item->guardians->first()->phone }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 dark:text-slate-500 italic">Belirtilmemiş</span>
                                @endif
                            </td>

                            {{-- Randevu --}}
                            <td class="px-6 py-4">
                                @if($item->meets_status == 'Görüşüldü')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                                 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400
                                                 border border-emerald-200/60 dark:border-emerald-700/40">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                        </span>
                                        Görüşüldü
                                    </span>
                                @elseif($item->meets_status == 'Görüşülmedi')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                                 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400
                                                 border border-red-200/60 dark:border-red-700/40">
                                        <span class="w-2 h-2 rounded-full bg-red-400"></span>
                                        Görüşülmedi
                                    </span>
                                @elseif($item->meets_status == 'Görüşülecek')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                                 bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400
                                                 border border-amber-200/60 dark:border-amber-700/40">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-pulse absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-50"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                        </span>
                                        Görüşülecek
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                                                 bg-slate-50 dark:bg-slate-700/50 text-slate-400 dark:text-slate-500
                                                 border border-slate-200/60 dark:border-slate-600/40">
                                        <span class="w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                                        Belirtilmemiş
                                    </span>
                                @endif
                            </td>

                            {{-- Kayıt Tarihi --}}
                            <td class="px-6 py-4 hidden lg:table-cell">
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                                    </svg>
                                    <span class="text-slate-500 dark:text-slate-400 text-xs">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}
                                    </span>
                                </div>
                            </td>

                            {{-- İşlem --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-1">
                                    {{-- Düzenle --}}
                                    <a href="{{ route('students.pre.editPreRegistiration', $item->id) }}"
                                       class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                              hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all
                                              opacity-0 group-hover:opacity-100"
                                       title="Düzenle">
                                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                        </svg>
                                    </a>

                                    {{-- 3-dots action button (Flowbite modal) --}}
                                    @can('student')
                                        <button data-modal-target="actionbutton-modal-{{ $item->id }}"
                                                data-modal-toggle="actionbutton-modal-{{ $item->id }}"
                                                type="button"
                                                class="p-2 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400
                                                       hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all cursor-pointer"
                                                title="İşlemler">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="3"
                                                      d="M12 6h.01M12 12h.01M12 18h.01"/>
                                            </svg>
                                        </button>
                                    @endcan

                                    {{-- Delete --}}
                                    @can('student_delete')
                                        <form action="{{ route('students.delete', $item->id) }}" method="POST"
                                              x-data @submit.prevent="$dispatch('confirm-dialog', {
                                                  title: 'Öğrenciyi Sil',
                                                  message: '{{ addslashes($item->full_name) }} adlı öğrenciyi silmek istediğinize emin misiniz?',
                                                  form: $el
                                              })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50
                                                           dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer
                                                           opacity-0 group-hover:opacity-100"
                                                    title="Sil">
                                                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200
                                                dark:from-slate-700 dark:to-slate-600
                                                flex items-center justify-center shadow-inner">
                                        <svg class="w-8 h-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-slate-700 dark:text-slate-300 font-medium">Ön kayıt bulunamadı</p>
                                        <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">
                                            @if($activeCount > 0)
                                                Filtre kriterlerinize uygun sonuç yok.
                                                <a href="{{ route('students.pre.students', ['_clear' => 1]) }}"
                                                   class="text-fuchsia-500 hover:text-fuchsia-600 font-medium">Filtreleri temizle</a>
                                            @else
                                                Henüz ön kayıt eklenmemiş.
                                            @endif
                                        </p>
                                    </div>
                                    @if($activeCount == 0)
                                        @can('student')
                                            <a href="{{ route('students.pre.createPreRegistiration') }}"
                                               class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl
                                                      bg-gradient-to-r from-fuchsia-500 to-purple-500 text-white
                                                      hover:from-fuchsia-600 hover:to-purple-600 shadow-lg shadow-fuchsia-500/20 transition-all mt-2">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                                </svg>
                                                İlk Ön Kaydı Ekle
                                            </a>
                                        @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($students->hasPages())
            <div class="border-t border-slate-100 dark:border-slate-700/50 px-6 py-3">
                {{ $students->links() }}
            </div>
        @endif
    </div>
@endsection

