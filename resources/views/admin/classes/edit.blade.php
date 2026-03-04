@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Sınıf Düzenle</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $lessonClass->name }}</p>
    </div>
    <a href="{{ route('class.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3
              bg-gradient-to-r from-fuchsia-500 to-purple-500
              hover:from-fuchsia-600 hover:to-purple-600
              text-white font-semibold rounded-xl
              shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Yeni Sınıf
    </a>
@endsection

@section('content')
@php
    // old() yoksa modelden doldur
    if (old('day_data') !== null) {
        $existingDayData = old('day_data');
    } else {
        $existingDayData = [];
        foreach ($lessonClass->days as $d) {
            $existingDayData[$d->day] = [
                'day'        => $d->day,
                'start_time' => $d->start_time,
                'end_time'   => $d->end_time,
            ];
        }
    }
    $checkedDays = array_keys($existingDayData);

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

<form action="{{ route('class.update', $lessonClass->id) }}" method="POST" x-data="classEditForm">
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
                    <x-text-input name="name" label="Sınıf Adı" placeholder="Örn: A1 Almanca Başlangıç" required x-model="name" />

                    {{-- Kontenjan + Kurs Süresi --}}
                    <div class="grid grid-cols-2 gap-4">
                        <x-text-input name="quota" type="number" label="Kontenjan" placeholder="15" suffix="kişi" required min="1" :value="$lessonClass->quota" />
                        <x-text-input name="course_time" label="Kurs Süresi" placeholder="Örn: 3 Ay / 48 Saat" required :value="$lessonClass->course_time" />
                    </div>

                    {{-- Başlangıç + Bitiş Tarihi --}}
                    <div class="grid grid-cols-2 gap-4">
                        <x-text-input name="start_date" type="date" label="Başlangıç Tarihi" required :value="$lessonClass->start_date" />
                        <x-text-input name="end_date" type="date" label="Bitiş Tarihi" required :value="$lessonClass->end_date" />
                    </div>
                </div>
            </div>

            {{-- Eğitmen --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Eğitmen</h3>
                </div>
                <div class="p-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                        Eğitmen Seçin <span class="text-red-500">*</span>
                    </label>
                    <x-checkbox-dropdown
                        name="teacher_id"
                        :items="$teachers->map(fn($t) => ['id' => $t->id, 'name' => $t->name])->toArray()"
                        :selected="[old('teacher_id', $lessonClass->teacher_id)]"
                        placeholder="Eğitmen seçin..."
                        :multiple="false"
                        :required="true"
                    />
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
                <p class="text-white/60 text-xs mb-4">Düzenleniyor</p>
                <div class="pt-4 border-t border-white/20 space-y-2 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-white/70">Seçili Gün</span>
                        <span class="font-bold" x-text="selectedCount + ' / 7'"></span>
                    </div>
                </div>
            </div>

            {{-- Sınıf Meta --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-sm p-5 space-y-3">
                <h4 class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sınıf Bilgisi</h4>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Sınıf No</span>
                        <span class="font-semibold text-slate-900 dark:text-white">#{{ $lessonClass->id }}</span>
                    </div>
                    @if ($lessonClass->teacher)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500 dark:text-slate-400">Eğitmen</span>
                            <span class="font-semibold text-slate-900 dark:text-white">{{ $lessonClass->teacher->name }}</span>
                        </div>
                    @endif
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Kontenjan</span>
                        <span class="font-semibold text-slate-900 dark:text-white">{{ $lessonClass->quota }} kişi</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Oluşturulma</span>
                        <span class="font-semibold text-slate-900 dark:text-white">{{ $lessonClass->created_at->format('d.m.Y') }}</span>
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                    </svg>
                    Değişiklikleri Kaydet
                </button>
                <a href="{{ route('class.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-6 py-3
                          text-slate-600 dark:text-slate-400 font-medium rounded-xl
                          hover:bg-slate-50 dark:hover:bg-slate-700/50 border border-slate-200 dark:border-slate-700 transition-all">
                    İptal
                </a>
            </div>

            {{-- Sil --}}
            @can('class_delete')
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-red-200/60 dark:border-red-800/40 shadow-sm p-5">
                    <h4 class="text-xs font-semibold text-red-500 dark:text-red-400 uppercase tracking-wider mb-3">Tehlikeli Bölge</h4>
                    <form action="{{ route('class.delete', $lessonClass->id) }}" method="POST"
                          x-data @submit.prevent="$dispatch('confirm-dialog', {
                              title: 'Sınıfı Sil',
                              message: '{{ addslashes($lessonClass->name) }} adlı sınıfı silmek istediğinize emin misiniz? Bu işlem geri alınamaz.',
                              form: $el
                          })">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5
                                       text-red-600 dark:text-red-400 text-sm font-medium rounded-xl
                                       border border-red-200 dark:border-red-800
                                       hover:bg-red-50 dark:hover:bg-red-900/20 transition-all cursor-pointer">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                            </svg>
                            Sınıfı Sil
                        </button>
                    </form>
                </div>
            @endcan

        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('classEditForm', () => ({
            name: @json(old('name', $lessonClass->name)),
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
