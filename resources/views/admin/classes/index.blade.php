@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Sınıflar</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Ders sınıflarını yönetin</p>
    </div>
    @can('class')
        <a href="{{ route('class.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3
                  bg-gradient-to-r from-fuchsia-500 to-purple-500
                  hover:from-fuchsia-600 hover:to-purple-600
                  text-white font-semibold rounded-xl
                  shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Yeni Sınıf
        </a>
    @endcan
@endsection

@section('content')
    {{-- Filtreler --}}
    @php
        $activeCount = ($filterName ? 1 : 0) + count($selectedDays) + count($selectedTeachers);
    @endphp
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 mb-5">

        {{-- Kart Başlığı --}}
        <div class="flex items-center justify-between px-5 py-3 border-b border-slate-100 dark:border-slate-700/50">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-fuchsia-50 dark:bg-fuchsia-900/20 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                </div>
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Filtreler</span>
                @if($activeCount > 0)
                    <span class="inline-flex items-center justify-center w-5 h-5 text-[11px] font-bold
                                 bg-fuchsia-500 text-white rounded-full">{{ $activeCount }}</span>
                @endif
            </div>
            @if($activeCount > 0)
                <a href="{{ route('class.index', ['_clear' => 1]) }}"
                   class="inline-flex items-center gap-1 text-xs font-medium text-slate-400
                          hover:text-red-500 dark:hover:text-red-400 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Tümünü Temizle
                </a>
            @endif
        </div>

        {{-- Filtre Girdileri --}}
        <form method="GET" action="{{ route('class.index') }}" id="filterForm" class="px-5 py-4 space-y-4">

            {{-- Sınıf adı + Günler + Eğitmen + Filtrele --}}
            <div class="flex flex-wrap items-end gap-4">

                {{-- Sınıf Adı --}}
                <div class="flex-1 min-w-52">
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Sınıf Adı</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                        </svg>
                        <input type="text" name="name" value="{{ $filterName }}" placeholder="Sınıf ara…"
                               class="w-full pl-9 pr-4 py-2.5 text-sm rounded-xl
                                      border border-slate-200 dark:border-slate-600
                                      bg-slate-50 dark:bg-slate-700/50
                                      text-slate-900 dark:text-white placeholder-slate-400
                                      focus:outline-none focus:ring-2 focus:ring-fuchsia-500/30 focus:border-fuchsia-400 transition-all">
                    </div>
                </div>

                {{-- Günler --}}
                @php
                    $allDays = ['Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi','Pazar'];
                @endphp
                <div class="min-w-44">
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Gün</label>
                    <x-checkbox-dropdown
                        name="day[]"
                        :items="collect($allDays)->map(fn($d) => ['id' => $d, 'name' => $d])->toArray()"
                        :selected="$selectedDays"
                        placeholder="Tüm Günler"
                        singularLabel="gün"
                        pluralLabel="Gün Seçildi"
                        dropdownId="days"
                        :maxVisible="7"
                    />
                </div>

                {{-- Eğitmen --}}
                @if($teachers->isNotEmpty())
                <div class="min-w-44">
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5">Eğitmen</label>
                    <x-checkbox-dropdown
                        name="teacher[]"
                        :items="$teachers->map(fn($t) => ['id' => $t->id, 'name' => $t->name])->values()->toArray()"
                        :selected="$selectedTeachers"
                        placeholder="Tüm Eğitmenler"
                        singularLabel="eğitmen"
                        pluralLabel="Eğitmen Seçildi"
                        dropdownId="teachers"
                        :maxVisible="6"
                    />
                </div>
                @endif

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
                <div class="flex flex-wrap items-center gap-2 pt-3 border-t border-slate-100 dark:border-slate-700/50">
                    <span class="text-xs font-medium text-slate-400 dark:text-slate-500">Aktif:</span>

                    @if($filterName)
                        <a href="{{ route('class.index', ['_rm' => 'name']) }}"
                           class="inline-flex items-center gap-1.5 pl-2.5 pr-1.5 py-1 rounded-lg text-xs font-medium
                                  bg-fuchsia-50 dark:bg-fuchsia-900/20 text-fuchsia-700 dark:text-fuchsia-300
                                  border border-fuchsia-200/60 dark:border-fuchsia-700/40
                                  hover:bg-fuchsia-100 transition-colors">
                            "{{ $filterName }}"
                            <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    @endif

                    @foreach($selectedDays as $d)
                        <a href="{{ route('class.index', ['_rm' => 'day', '_val' => $d]) }}"
                           class="inline-flex items-center gap-1.5 pl-2.5 pr-1.5 py-1 rounded-lg text-xs font-medium
                                  bg-fuchsia-100 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-300
                                  border border-fuchsia-300/60 dark:border-fuchsia-600/60
                                  hover:bg-fuchsia-200 dark:hover:bg-fuchsia-900/50 transition-colors">
                            {{ $d }}
                            <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    @endforeach

                    @foreach($selectedTeachers as $tid)
                        @php $t = $teachers->firstWhere('id', $tid); @endphp
                        @if($t)
                            <a href="{{ route('class.index', ['_rm' => 'teacher', '_val' => $tid]) }}"
                               class="inline-flex items-center gap-1.5 pl-2.5 pr-1.5 py-1 rounded-lg text-xs font-medium
                                      bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300
                                      border border-emerald-200/60 dark:border-emerald-700/40
                                      hover:bg-emerald-100 transition-colors">
                                <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                                {{ $t->name }}
                                <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </form>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50 [&>tr>th:first-child]:rounded-tl-2xl [&>tr>th:last-child]:rounded-tr-2xl">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sınıf Adı</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Günler</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Eğitmen</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($classes as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            {{-- Sınıf Adı --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center
                                                flex-shrink-0 border border-blue-200/50 dark:border-blue-700/30">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 10.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                                        </svg>
                                    </div>
                                    <a href="{{ route('class.edit', $item->id) }}"
                                       class="font-semibold text-fuchsia-600 dark:text-fuchsia-400 hover:text-fuchsia-800
                                              dark:hover:text-fuchsia-300 transition-colors">
                                        {{ $item->name }}
                                    </a>
                                </div>
                            </td>

                            {{-- Günler --}}
                            <td class="px-6 py-4">
                                @php
                                    $dayColors = [
                                        'Pazartesi' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border-blue-200/60 dark:border-blue-700/40',
                                        'Salı'      => 'bg-violet-100 dark:bg-violet-900/30 text-violet-700 dark:text-violet-300 border-violet-200/60 dark:border-violet-700/40',
                                        'Çarşamba'  => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 border-emerald-200/60 dark:border-emerald-700/40',
                                        'Perşembe'  => 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 border-amber-200/60 dark:border-amber-700/40',
                                        'Cuma'      => 'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 border-orange-200/60 dark:border-orange-700/40',
                                        'Cumartesi' => 'bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 border-rose-200/60 dark:border-rose-700/40',
                                        'Pazar'     => 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 border-slate-200/60 dark:border-slate-600/40',
                                    ];
                                @endphp
                                <div class="flex flex-wrap gap-1">
                                    @forelse ($item->days as $day)
                                        @php $color = $dayColors[$day->day] ?? 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-600'; @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium border {{ $color }}">
                                            {{ $day->day }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-slate-400 italic">Gün belirtilmemiş</span>
                                    @endforelse
                                </div>
                            </td>

                            {{-- Eğitmen --}}
                            <td class="px-6 py-4">
                                @if ($item->teacher)
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-emerald-400 to-teal-500
                                                    flex items-center justify-center flex-shrink-0">
                                            <span class="text-xs font-bold text-white uppercase">
                                                {{ strtoupper(substr($item->teacher->name, 0, 2)) }}
                                            </span>
                                        </div>
                                        <span class="text-slate-700 dark:text-slate-300 font-medium">{{ $item->teacher->name }}</span>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 dark:text-slate-500 italic">Atanmamış</span>
                                @endif
                            </td>

                            {{-- İşlem --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    @can('class')
                                        <a href="{{ route('class.edit', $item->id) }}"
                                           class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                                  hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all"
                                           title="Düzenle">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                            </svg>
                                        </a>
                                    @endcan

                                    @can('class_delete')
                                        <form action="{{ route('class.delete', $item->id) }}" method="POST"
                                              x-data @submit.prevent="$dispatch('confirm-dialog', {
                                                  title: 'Sınıfı Sil',
                                                  message: '{{ addslashes($item->name) }} sınıfını silmek istediğinize emin misiniz?',
                                                  form: $el
                                              })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50
                                                           dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer"
                                                    title="Sil">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 10.741-3.342"/>
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 dark:text-slate-400">Henüz sınıf eklenmemiş.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $classes->links() }}
    </div>
@endsection
