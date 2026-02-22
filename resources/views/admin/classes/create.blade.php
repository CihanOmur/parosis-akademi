@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Sınıf Ekle</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Yeni bir ders sınıfı oluşturun</p>
    </div>
    <a href="{{ route('class.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400
              hover:text-slate-900 dark:hover:text-white bg-white dark:bg-slate-800
              border border-slate-200 dark:border-slate-700 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
        </svg>
        Geri Dön
    </a>
@endsection

@section('content')
@php
    $existingDayData = old('day_data') ?? [];
    $checkedDays     = array_keys($existingDayData);

    $dayColors = [
        'Pazartesi' => ['on' => 'border-blue-300 dark:border-blue-700 bg-blue-50 dark:bg-blue-900/20',       'dot' => 'bg-blue-500',    'label' => 'text-blue-700 dark:text-blue-300'],
        'Salı'      => ['on' => 'border-violet-300 dark:border-violet-700 bg-violet-50 dark:bg-violet-900/20', 'dot' => 'bg-violet-500',  'label' => 'text-violet-700 dark:text-violet-300'],
        'Çarşamba'  => ['on' => 'border-emerald-300 dark:border-emerald-700 bg-emerald-50 dark:bg-emerald-900/20', 'dot' => 'bg-emerald-500', 'label' => 'text-emerald-700 dark:text-emerald-300'],
        'Perşembe'  => ['on' => 'border-amber-300 dark:border-amber-700 bg-amber-50 dark:bg-amber-900/20',    'dot' => 'bg-amber-500',   'label' => 'text-amber-700 dark:text-amber-300'],
        'Cuma'      => ['on' => 'border-orange-300 dark:border-orange-700 bg-orange-50 dark:bg-orange-900/20', 'dot' => 'bg-orange-500',  'label' => 'text-orange-700 dark:text-orange-300'],
        'Cumartesi' => ['on' => 'border-rose-300 dark:border-rose-700 bg-rose-50 dark:bg-rose-900/20',        'dot' => 'bg-rose-500',    'label' => 'text-rose-700 dark:text-rose-300'],
        'Pazar'     => ['on' => 'border-slate-400 dark:border-slate-500 bg-slate-100 dark:bg-slate-700/50',   'dot' => 'bg-slate-500',   'label' => 'text-slate-700 dark:text-slate-300'],
    ];
    $allDayKeys = array_keys($dayColors);
@endphp

<form action="{{ route('class.store') }}" method="POST" x-data="classCreateForm">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol: Ana Form --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Sınıf Bilgileri --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Sınıf Bilgileri</h3>
                </div>
                <div class="p-6 space-y-5">

                    {{-- Sınıf Adı --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Sınıf Adı <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" x-model="name"
                               placeholder="Örn: A1 Almanca Başlangıç"
                               class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900
                                      text-slate-900 dark:text-white px-4 py-2.5 text-sm
                                      focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400 transition-colors
                                      @error('name') border-red-400 focus:border-red-400 focus:ring-red-500/20 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kontenjan + Kurs Süresi --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="quota" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                Kontenjan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" id="quota" name="quota" value="{{ old('quota') }}"
                                       min="1" placeholder="15"
                                       class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900
                                              text-slate-900 dark:text-white pl-4 pr-12 py-2.5 text-sm
                                              focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400 transition-colors
                                              @error('quota') border-red-400 @enderror">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400 pointer-events-none">kişi</span>
                            </div>
                            @error('quota')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="course_time" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                Kurs Süresi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="course_time" name="course_time" value="{{ old('course_time') }}"
                                   placeholder="Örn: 3 Ay / 48 Saat"
                                   class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900
                                          text-slate-900 dark:text-white px-4 py-2.5 text-sm
                                          focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400 transition-colors
                                          @error('course_time') border-red-400 @enderror">
                            @error('course_time')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Başlangıç + Bitiş Tarihi --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                Başlangıç Tarihi <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                                   class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900
                                          text-slate-900 dark:text-white px-4 py-2.5 text-sm
                                          focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400 transition-colors
                                          @error('start_date') border-red-400 @enderror">
                            @error('start_date')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                Bitiş Tarihi <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                                   class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900
                                          text-slate-900 dark:text-white px-4 py-2.5 text-sm
                                          focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400 transition-colors
                                          @error('end_date') border-red-400 @enderror">
                            @error('end_date')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Eğitmen --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Eğitmen</h3>
                </div>
                <div class="p-6">
                    <label for="teacher_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                        Eğitmen Seçin <span class="text-red-500">*</span>
                    </label>
                    <select id="teacher_id" name="teacher_id"
                            class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900
                                   text-slate-900 dark:text-white px-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400 transition-colors
                                   @error('teacher_id') border-red-400 @enderror">
                        <option value="">— Eğitmen seçin —</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Çalışma Saatleri --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Çalışma Saatleri</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                            <span x-text="selectedCount"></span> gün seçili
                        </p>
                    </div>
                    <button type="button" @click="toggleAll()"
                            class="text-xs font-medium px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700
                                   text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <span x-text="checkedDays.length === allDays.length ? 'Tümünü Kaldır' : 'Tümünü Seç'"></span>
                    </button>
                </div>
                <div class="p-6 space-y-2">

                    @error('day_data')
                        <div class="px-4 py-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 mb-3">
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        </div>
                    @enderror

                    @foreach ($dayColors as $key => $c)
                        @php
                            $defStart = $existingDayData[$key]['start_time'] ?? '09:00:00';
                            $defEnd   = $existingDayData[$key]['end_time']   ?? '10:00:00';
                        @endphp
                        <div class="rounded-xl border transition-all duration-200"
                             :class="hasDay('{{ $key }}') ? '{{ $c['on'] }}' : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800'">
                            <div class="flex items-center gap-3 p-3">

                                {{-- Toggle Çember --}}
                                <button type="button" @click="toggleDay('{{ $key }}')"
                                        class="flex-shrink-0 w-6 h-6 rounded-full border-2 transition-all duration-200 flex items-center justify-center cursor-pointer"
                                        :class="hasDay('{{ $key }}') ? '{{ $c['dot'] }} border-transparent' : 'border-slate-300 dark:border-slate-600 hover:border-slate-400'">
                                    <svg x-show="hasDay('{{ $key }}')" x-cloak
                                         class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                </button>

                                {{-- Gün Adı --}}
                                <button type="button" @click="toggleDay('{{ $key }}')"
                                        class="w-24 text-sm font-semibold text-left transition-colors cursor-pointer flex-shrink-0"
                                        :class="hasDay('{{ $key }}') ? '{{ $c['label'] }}' : 'text-slate-600 dark:text-slate-400'">
                                    {{ $key }}
                                </button>

                                {{-- Saat Seçiciler (seçildiğinde görünür) --}}
                                <div class="flex items-center gap-2 flex-1" x-show="hasDay('{{ $key }}')" x-cloak>
                                    <select name="day_data[{{ $key }}][start_time]"
                                            :disabled="!hasDay('{{ $key }}')"
                                            class="flex-1 rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900
                                                   text-slate-900 dark:text-white px-2 py-1.5 text-sm
                                                   focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400">
                                        @foreach ($times as $value)
                                            @php $shortTime = substr($value, 0, 5); @endphp
                                            <option value="{{ $value }}" {{ $defStart == $value ? 'selected' : '' }}>
                                                {{ $shortTime }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-slate-400 dark:text-slate-500 text-sm flex-shrink-0">—</span>
                                    <select name="day_data[{{ $key }}][end_time]"
                                            :disabled="!hasDay('{{ $key }}')"
                                            class="flex-1 rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900
                                                   text-slate-900 dark:text-white px-2 py-1.5 text-sm
                                                   focus:outline-none focus:ring-2 focus:ring-fuchsia-500/20 focus:border-fuchsia-400">
                                        @foreach ($times as $value)
                                            @php $shortTime = substr($value, 0, 5); @endphp
                                            <option value="{{ $value }}" {{ $defEnd == $value ? 'selected' : '' }}>
                                                {{ $shortTime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Seçilmedi yazısı --}}
                                <div x-show="!hasDay('{{ $key }}')" x-cloak class="flex-1 text-right">
                                    <span class="text-xs text-slate-400 dark:text-slate-500 italic">Seçilmedi</span>
                                </div>
                            </div>

                            {{-- Gizli gün adı inputu — sadece seçiliyken DOM'a eklenir --}}
                            <template x-if="hasDay('{{ $key }}')">
                                <input type="hidden" name="day_data[{{ $key }}][day]" value="{{ $key }}">
                            </template>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Sağ: Önizleme + Eylemler --}}
        <div class="space-y-4 sticky top-24 self-start">

            {{-- Önizleme Kartı --}}
            <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg shadow-fuchsia-500/25">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                    </svg>
                </div>
                <h4 class="text-lg font-bold leading-snug min-h-[1.75rem] mb-1" x-text="name || 'Sınıf Adı'"></h4>
                <p class="text-white/60 text-xs mb-4">Yeni sınıf</p>
                <div class="pt-4 border-t border-white/20 space-y-2 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-white/70">Seçili Gün</span>
                        <span class="font-bold" x-text="selectedCount + ' / 7'"></span>
                    </div>
                </div>
            </div>

            {{-- İşlemler --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-sm p-5 space-y-3">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-3
                               bg-gradient-to-r from-fuchsia-500 to-purple-500
                               hover:from-fuchsia-600 hover:to-purple-600
                               text-white font-semibold rounded-xl
                               shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Sınıfı Kaydet
                </button>
                <a href="{{ route('class.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-6 py-3
                          text-slate-600 dark:text-slate-400 font-medium rounded-xl
                          hover:bg-slate-50 dark:hover:bg-slate-700/50 border border-slate-200 dark:border-slate-700 transition-all">
                    İptal
                </a>
            </div>

        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('classCreateForm', () => ({
            name: @json(old('name', '')),
            checkedDays: @json($checkedDays),
            allDays: @json($allDayKeys),

            hasDay(day) {
                return this.checkedDays.includes(day);
            },
            toggleDay(day) {
                const idx = this.checkedDays.indexOf(day);
                if (idx !== -1) {
                    this.checkedDays.splice(idx, 1);
                } else {
                    this.checkedDays.push(day);
                }
            },
            toggleAll() {
                this.checkedDays = this.checkedDays.length === this.allDays.length
                    ? []
                    : this.allDays.slice();
            },
            get selectedCount() {
                return this.checkedDays.length;
            }
        }));
    });
</script>
@endsection
