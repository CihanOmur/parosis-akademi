@extends('admin.layouts.app')
@section('styles')
    <link href="{{ asset('tomselect.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('students.pre.students') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kesin Kayıt Oluştur</h1>
            <div class="flex items-center gap-3 mt-1">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    {{ $student->full_name }}
                </p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                             bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Ön Kayıt
                </span>
                <span class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($student->created_at)->format('d.m.Y') }}</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('students.pre-to-normal.post', ['id' => $student->id]) }}" method="POST" enctype="multipart/form-data"
      x-data="{
          guardian2Active: {{ count($student->guardians ?? []) > 1 ? 'true' : 'false' }},
          hasAllergy: '{{ $student->has_allergy ?? '2' }}'
      }">
    @csrf
    <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
    <input type="hidden" name="registiration_type" value="2">

    <div class="space-y-5">

        {{-- Öğrenci Bilgileri --}}
        <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
            <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/50 via-transparent to-purple-50/30 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

            <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Öğrenci Bilgileri</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Öğrencinin kişisel bilgileri</p>
                </div>
            </div>

            <div class="relative p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                    $inputClass = 'w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all';
                    $labelClass = 'block text-sm font-medium text-slate-700 dark:text-slate-300';
                    $errorSvg = '<svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>';
                @endphp

                {{-- Ad Soyad --}}
                <div class="sm:col-span-2 space-y-1">
                    <label class="{{ $labelClass }}">Ad Soyad <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                            </svg>
                        </span>
                        <input type="text" name="full_name" class="{{ $inputClass }}"
                               placeholder="örn: Ahmet Yılmaz" value="{{ old('full_name', $student->full_name) }}">
                    </div>
                    @error('full_name')
                        <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p>
                    @enderror
                </div>

                {{-- Cinsiyet --}}
                <div class="space-y-1">
                    <label class="{{ $labelClass }}">Cinsiyet</label>
                    <x-checkbox-dropdown
                        name="gender"
                        :items="[['id' => 'Erkek', 'name' => 'Erkek'], ['id' => 'Kadın', 'name' => 'Kadın']]"
                        :selected="old('gender', $student->gender) ? [old('gender', $student->gender)] : []"
                        placeholder="Seçin..."
                        :multiple="false"
                    />
                    @error('gender') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>

                {{-- Doğum Tarihi --}}
                <div class="space-y-1">
                    <label class="{{ $labelClass }}">Doğum Tarihi <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                            </svg>
                        </span>
                        <input type="date" name="birth_date" class="{{ $inputClass }}"
                               value="{{ old('birth_date', $student->birth_date) }}">
                    </div>
                    @error('birth_date') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>

                {{-- T.C. --}}
                <div class="space-y-1">
                    <label class="{{ $labelClass }}">T.C. Kimlik No</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z"/>
                            </svg>
                        </span>
                        <input type="text" name="tc_no" inputmode="numeric"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                               class="{{ $inputClass }}" placeholder="12345678901"
                               value="{{ old('tc_no', $student->national_id) }}">
                    </div>
                    @error('tc_no') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>

                {{-- Telefon --}}
                <div class="space-y-1">
                    <label class="{{ $labelClass }}">Telefon</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                            </svg>
                        </span>
                        <input type="tel" name="student_phone" inputmode="numeric"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                               class="{{ $inputClass }}" placeholder="05551234545"
                               value="{{ old('student_phone', $student->student_phone) }}">
                    </div>
                    @error('student_phone') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>

                {{-- Kan Grubu --}}
                <div class="space-y-1">
                    <label class="{{ $labelClass }}">Kan Grubu</label>
                    <x-checkbox-dropdown
                        name="blood_type"
                        :items="collect(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', '0+', '0-'])->map(fn($t) => ['id' => $t, 'name' => $t])->toArray()"
                        :selected="old('blood_type', $student->blood_type) ? [old('blood_type', $student->blood_type)] : []"
                        placeholder="Seçin..."
                        :multiple="false"
                    />
                    @error('blood_type') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>

                {{-- Okul --}}
                <div class="space-y-1">
                    <label class="{{ $labelClass }}">Okul Adı</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z"/>
                            </svg>
                        </span>
                        <input type="text" name="school_name" class="{{ $inputClass }}"
                               placeholder="Öğrencinin eğitim aldığı okul"
                               value="{{ old('school_name', $student->school_name) }}">
                    </div>
                    @error('school_name') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Veli Bilgileri --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-md shadow-blue-500/20 flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">1. Veli Bilgileri</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Birinci velinin iletişim ve kişisel bilgileri</p>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ([
                    ['name' => 'guardian1_relationship', 'label' => 'Yakınlık', 'placeholder' => 'örn: Anne', 'value' => $student->guardians[0]->relationship ?? ''],
                    ['name' => 'guardian1_full_name', 'label' => 'Ad Soyad', 'placeholder' => 'Ayşe Yılmaz', 'value' => $student->guardians[0]->full_name ?? ''],
                    ['name' => 'guardian1_national_id', 'label' => 'T.C. Kimlik No', 'placeholder' => '12345678901', 'value' => $student->guardians[0]->national_id ?? '', 'numeric' => true],
                    ['name' => 'guardian1_birth_date', 'label' => 'Doğum Tarihi', 'type' => 'date', 'value' => $student->guardians[0]->birth_date ?? ''],
                ] as $field)
                    <div class="space-y-1">
                        <label class="{{ $labelClass }}">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="{{ $field['placeholder'] ?? '' }}"
                               {{ isset($field['numeric']) ? 'inputmode=numeric oninput=this.value=this.value.replace(/[^0-9]/g,\'\').slice(0,11)' : '' }}
                               value="{{ old($field['name'], $field['value']) }}">
                        @error($field['name']) <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                    </div>
                @endforeach

                {{-- Eğitim Düzeyi --}}
                <div class="space-y-1">
                    <label class="{{ $labelClass }}">Eğitim Düzeyi</label>
                    <x-checkbox-dropdown
                        name="guardian1_education_level"
                        :items="collect($education_levels)->map(fn($l) => ['id' => $l, 'name' => $l])->toArray()"
                        :selected="old('guardian1_education_level', $student->guardians[0]->education_level ?? '') ? [old('guardian1_education_level', $student->guardians[0]->education_level ?? '')] : []"
                        placeholder="Seçin..."
                        :multiple="false"
                    />
                    @error('guardian1_education_level') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>

                @foreach ([
                    ['name' => 'guardian1_job', 'label' => 'Meslek', 'placeholder' => 'örn: Memur', 'value' => $student->guardians[0]->job ?? ''],
                    ['name' => 'guardian1_phone_1', 'label' => 'Telefon 1', 'placeholder' => '05551234545', 'value' => $student->guardians[0]->phone_1 ?? '', 'numeric' => true],
                    ['name' => 'guardian1_phone_2', 'label' => 'Telefon 2', 'placeholder' => '05551234545', 'value' => $student->guardians[0]->phone_2 ?? '', 'numeric' => true],
                    ['name' => 'guardian1_email', 'label' => 'E-posta', 'type' => 'email', 'placeholder' => 'ornek@parosis.com', 'value' => $student->guardians[0]->email ?? ''],
                    ['name' => 'guardian1_home_address', 'label' => 'Ev Adresi', 'placeholder' => 'mahalle, sokak, no, ilçe, il', 'value' => $student->guardians[0]->home_address ?? ''],
                    ['name' => 'guardian1_work_address', 'label' => 'İş Adresi', 'placeholder' => 'mahalle, sokak, no, ilçe, il', 'value' => $student->guardians[0]->work_address ?? ''],
                ] as $field)
                    <div class="space-y-1">
                        <label class="{{ $labelClass }}">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="{{ $field['placeholder'] ?? '' }}"
                               {{ isset($field['numeric']) ? 'inputmode=numeric oninput=this.value=this.value.replace(/[^0-9]/g,\'\').slice(0,11)' : '' }}
                               value="{{ old($field['name'], $field['value']) }}">
                        @error($field['name']) <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 2. Veli Toggle + Alanlar --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
            <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center shadow-md shadow-violet-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">2. Veli Bilgileri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">İkinci veli bilgileri (isteğe bağlı)</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="guardian2_active" value="1"
                           x-model="guardian2Active"
                           class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 dark:bg-slate-600 peer-focus:outline-none peer-focus:ring-4
                                peer-focus:ring-fuchsia-500/20 rounded-full peer
                                peer-checked:after:translate-x-full peer-checked:after:border-white
                                after:content-[''] after:absolute after:top-[2px] after:start-[2px]
                                after:bg-white after:border-gray-300 after:border after:rounded-full
                                after:h-5 after:w-5 after:transition-all
                                peer-checked:bg-fuchsia-500"></div>
                    <span class="ms-3 text-sm font-medium text-slate-600 dark:text-slate-400" x-text="guardian2Active ? 'Aktif' : 'Pasif'"></span>
                </label>
            </div>

            <div x-show="guardian2Active" x-collapse class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ([
                    ['name' => 'guardian2_relationship', 'label' => 'Yakınlık', 'placeholder' => 'örn: Baba', 'value' => $student->guardians[1]->relationship ?? ''],
                    ['name' => 'guardian2_full_name', 'label' => 'Ad Soyad', 'placeholder' => 'Mehmet Yılmaz', 'value' => $student->guardians[1]->full_name ?? ''],
                    ['name' => 'guardian2_national_id', 'label' => 'T.C. Kimlik No', 'placeholder' => '12345678901', 'value' => $student->guardians[1]->national_id ?? '', 'numeric' => true],
                    ['name' => 'guardian2_birth_date', 'label' => 'Doğum Tarihi', 'type' => 'date', 'value' => $student->guardians[1]->birth_date ?? ''],
                ] as $field)
                    <div class="space-y-1">
                        <label class="{{ $labelClass }}">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="{{ $field['placeholder'] ?? '' }}"
                               {{ isset($field['numeric']) ? 'inputmode=numeric oninput=this.value=this.value.replace(/[^0-9]/g,\'\').slice(0,11)' : '' }}
                               value="{{ old($field['name'], $field['value']) }}">
                        @error($field['name']) <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                    </div>
                @endforeach

                {{-- Eğitim Düzeyi --}}
                <div class="space-y-1">
                    <label class="{{ $labelClass }}">Eğitim Düzeyi</label>
                    <x-checkbox-dropdown
                        name="guardian2_education_level"
                        :items="collect($education_levels)->map(fn($l) => ['id' => $l, 'name' => $l])->toArray()"
                        :selected="old('guardian2_education_level', $student->guardians[1]->education_level ?? '') ? [old('guardian2_education_level', $student->guardians[1]->education_level ?? '')] : []"
                        placeholder="Seçin..."
                        :multiple="false"
                    />
                </div>

                @foreach ([
                    ['name' => 'guardian2_job', 'label' => 'Meslek', 'placeholder' => 'örn: Memur', 'value' => $student->guardians[1]->job ?? ''],
                    ['name' => 'guardian2_phone_1', 'label' => 'Telefon 1', 'placeholder' => '05551234545', 'value' => $student->guardians[1]->phone_1 ?? '', 'numeric' => true],
                    ['name' => 'guardian2_phone_2', 'label' => 'Telefon 2', 'placeholder' => '05551234545', 'value' => $student->guardians[1]->phone_2 ?? '', 'numeric' => true],
                    ['name' => 'guardian2_email', 'label' => 'E-posta', 'type' => 'email', 'placeholder' => 'ornek@parosis.com', 'value' => $student->guardians[1]->email ?? ''],
                    ['name' => 'guardian2_home_address', 'label' => 'Ev Adresi', 'placeholder' => 'mahalle, sokak, no, ilçe, il', 'value' => $student->guardians[1]->home_address ?? ''],
                    ['name' => 'guardian2_work_address', 'label' => 'İş Adresi', 'placeholder' => 'mahalle, sokak, no, ilçe, il', 'value' => $student->guardians[1]->work_address ?? ''],
                ] as $field)
                    <div class="space-y-1">
                        <label class="{{ $labelClass }}">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="{{ $field['placeholder'] ?? '' }}"
                               {{ isset($field['numeric']) ? 'inputmode=numeric oninput=this.value=this.value.replace(/[^0-9]/g,\'\').slice(0,11)' : '' }}
                               value="{{ old($field['name'], $field['value']) }}">
                        @error($field['name']) <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Acil Durum --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center shadow-md shadow-red-500/20 flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Acil Durumda Aranacak 3. Kişi</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Acil durumda ulaşılacak kişi bilgileri</p>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ([
                    ['name' => 'emergency_full_name', 'label' => 'Ad Soyad', 'placeholder' => 'örn: Ahmet Yılmaz', 'value' => $student->emergencyContact->full_name ?? ''],
                    ['name' => 'emergency_relationship', 'label' => 'Yakınlık', 'placeholder' => 'örn: Amcası', 'value' => $student->emergencyContact->relationship ?? ''],
                    ['name' => 'emergency_phone', 'label' => 'Telefon', 'placeholder' => '05551234545', 'value' => $student->emergencyContact->phone ?? '', 'numeric' => true],
                ] as $field)
                    <div class="space-y-1">
                        <label class="{{ $labelClass }}">{{ $field['label'] }}</label>
                        <input type="text" name="{{ $field['name'] }}"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="{{ $field['placeholder'] }}"
                               {{ isset($field['numeric']) ? 'inputmode=numeric oninput=this.value=this.value.replace(/[^0-9]/g,\'\').slice(0,11)' : '' }}
                               value="{{ old($field['name'], $field['value']) }}">
                        @error($field['name']) <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                    </div>
                @endforeach
                <div class="space-y-1 lg:col-span-4">
                    <label class="{{ $labelClass }}">Adres</label>
                    <input type="text" name="emergency_address"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                           placeholder="mahalle, sokak, no, ilçe, il"
                           value="{{ old('emergency_address', $student->emergencyContact->address ?? '') }}">
                    @error('emergency_address') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Alerji --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-md shadow-amber-500/20 flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Alerji Bilgisi</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Öğrencinin alerji durumu</p>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-center gap-4 mb-4">
                    <label class="flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer transition-all"
                           :class="hasAllergy === '1' ? 'bg-amber-50 dark:bg-amber-900/20 ring-2 ring-amber-400' : 'bg-slate-50 dark:bg-slate-700/50 ring-1 ring-slate-200 dark:ring-slate-600'">
                        <input type="radio" name="has_allergy" value="1" x-model="hasAllergy"
                               class="w-4 h-4 text-amber-500 border-slate-300 focus:ring-amber-500 cursor-pointer">
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Evet</span>
                    </label>
                    <label class="flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer transition-all"
                           :class="hasAllergy === '2' ? 'bg-emerald-50 dark:bg-emerald-900/20 ring-2 ring-emerald-400' : 'bg-slate-50 dark:bg-slate-700/50 ring-1 ring-slate-200 dark:ring-slate-600'">
                        <input type="radio" name="has_allergy" value="2" x-model="hasAllergy"
                               class="w-4 h-4 text-emerald-500 border-slate-300 focus:ring-emerald-500 cursor-pointer">
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Hayır</span>
                    </label>
                    @error('has_allergy') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>

                <div x-show="hasAllergy === '1'" x-collapse>
                    <div class="space-y-1">
                        <label class="{{ $labelClass }}">Alerji Detayları</label>
                        <input type="text" name="allergy_detail"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="Alerji detaylarını yazın"
                               value="{{ old('allergy_detail', $student->allergy_detail) }}">
                        @error('allergy_detail') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Sınıf & Dönem --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-md shadow-emerald-500/20 flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Sınıf & Dönem</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Sınıf ve eğitim dönemi seçimi</p>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1">
                    <label class="{{ $labelClass }}">Sınıf</label>
                    <x-checkbox-dropdown
                        name="class_id"
                        :items="$classes->map(fn($c) => ['id' => $c->id, 'name' => $c->name . ' - ' . ($c->teacher?->name ?? '')])->toArray()"
                        :selected="old('class_id') ? [(int) old('class_id')] : []"
                        placeholder="Sınıf seçin..."
                        :multiple="false"
                        :required="true"
                    />
                    @error('class_id') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <label class="{{ $labelClass }}">Eğitim Dönemi</label>
                    @php
                        $startYear = 2020;
                        $endYear = \Carbon\Carbon::now()->year + 1;
                        $years = range($startYear, $endYear);
                        rsort($years);
                        $selectedTerms = explode(',', $student->registiration_term);
                        $termItems = [];
                        foreach ($years as $year) {
                            $termItems[] = ['id' => "$year Güz", 'name' => "$year Güz"];
                            $termItems[] = ['id' => "$year Yaz", 'name' => "$year Yaz"];
                            $termItems[] = ['id' => "$year Bahar", 'name' => "$year Bahar"];
                        }
                    @endphp
                    <x-checkbox-dropdown
                        name="registiration_term[]"
                        :items="$termItems"
                        :selected="old('registiration_term', $selectedTerms)"
                        placeholder="Dönem seçin..."
                        :multiple="true"
                        :required="true"
                        singularLabel="dönem"
                        pluralLabel="dönem seçildi"
                    />
                    @error('registiration_term') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Notlar --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-slate-500 to-slate-700 flex items-center justify-center shadow-md shadow-slate-500/20 flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Notlar</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Öğrenci hakkında ek notlar</p>
                </div>
            </div>

            <div class="p-6">
                <textarea name="notes" rows="4"
                          class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white placeholder-slate-400 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all resize-none"
                          placeholder="Öğrenci hakkında notlar...">{{ old('notes', $student->notes) }}</textarea>
                @error('notes') <p class="text-sm text-red-500 flex items-center gap-1.5">{!! $errorSvg !!} {{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Kaydet --}}
        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-8 py-3 text-sm font-semibold text-white rounded-xl
                           bg-gradient-to-r from-fuchsia-500 to-purple-500
                           hover:from-fuchsia-600 hover:to-purple-600
                           shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5"/>
                </svg>
                Kesin Kayıt Oluştur
            </button>
        </div>
    </div>
</form>

@endsection
