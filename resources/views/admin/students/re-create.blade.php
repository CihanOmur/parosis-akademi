@extends('admin.layouts.app')
@section('styles')
    <link href="{{ asset('tomselect.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('students.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kayıt Yenileme</h1>
            <div class="flex items-center gap-3 mt-1">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    {{ $student->full_name }} &mdash; İlk kayıt: {{ \Carbon\Carbon::parse($student->created_at)->format('d.m.Y') }}
                </p>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                    {{ $student->is_active == '1' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-400' }}">
                    {{ $student->is_active == '1' ? 'Aktif' : 'Pasif' }}
                </span>
            </div>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('students.changeActivity', ['id' => $student->id]) }}" method="post" id="changeActivityForm">
    @csrf
</form>

<form action="{{ route('students.reCreateUpdate', ['id' => $student->id]) }}" method="POST" enctype="multipart/form-data"
      x-data="{
          studentName: '{{ $student->full_name }}',
          guardian2Active: {{ count($student->guardians ?? []) > 1 ? 'true' : 'false' }},
          hasAllergy: '{{ $student->has_allergy ?? '2' }}',
          get initials() {
              const parts = this.studentName.trim().split(' ').filter(Boolean);
              if (parts.length >= 2) return (parts[0][0] + parts[parts.length-1][0]).toUpperCase();
              if (parts.length === 1) return parts[0].slice(0,2).toUpperCase();
              return '??';
          }
      }">
    @csrf
    <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
    <input type="hidden" name="registiration_type" value="2">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol Kolon --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Kayıt Tarihi --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-sky-100 dark:bg-sky-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Kayıt Tarihi</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Eski kayıtlar için tarih seçebilirsiniz, yeni kayıtlar otomatik tarih alır</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="sm:w-1/2">
                        <x-text-input
                            name="recrate_registration_date"
                            type="date"
                            label="Tarih"
                            ringColor="sky"
                            icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>'
                        />
                    </div>
                </div>
            </div>

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
                    {{-- Ad Soyad --}}
                    <div class="sm:col-span-2">
                        <x-text-input
                            name="full_name"
                            label="Ad Soyad"
                            placeholder="örn: Ahmet Yılmaz"
                            :value="$student->full_name"
                            :required="true"
                            x-model="studentName"
                            icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>'
                        />
                    </div>

                    {{-- Cinsiyet --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Cinsiyet <span class="text-red-500">*</span></label>
                        <x-checkbox-dropdown
                            name="gender"
                            :items="[['id' => 'Erkek', 'name' => 'Erkek'], ['id' => 'Kadın', 'name' => 'Kadın']]"
                            :selected="old('gender', $student->gender) ? [old('gender', $student->gender)] : []"
                            placeholder="Seçin..."
                            :multiple="false"
                            :required="true"
                        />
                        @error('gender')
                            <p class="text-sm text-red-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Doğum Tarihi --}}
                    <x-text-input
                        name="birth_date"
                        type="date"
                        label="Doğum Tarihi"
                        :value="$student->birth_date"
                        :required="true"
                        icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0L3 16.5m15-3.379a48.474 48.474 0 0 0-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 0 1 3 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 0 1 6 13.12"/></svg>'
                    />

                    {{-- T.C. Kimlik No --}}
                    <x-text-input
                        name="tc_no"
                        label="T.C. Kimlik No"
                        placeholder="12345678901"
                        :value="$student->national_id"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                        icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z"/></svg>'
                    />

                    {{-- Telefon --}}
                    <x-text-input
                        name="student_phone"
                        type="tel"
                        label="Telefon"
                        placeholder="05551234545"
                        :value="$student->student_phone"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                        icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>'
                    />

                    {{-- Kan Grubu --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Kan Grubu</label>
                        <x-checkbox-dropdown
                            name="blood_type"
                            :items="collect(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', '0+', '0-'])->map(fn($t) => ['id' => $t, 'name' => $t])->toArray()"
                            :selected="old('blood_type', $student->blood_type) ? [old('blood_type', $student->blood_type)] : []"
                            placeholder="Seçin..."
                            :multiple="false"
                        />
                        @error('blood_type')
                            <p class="text-sm text-red-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Okul Adı --}}
                    <div class="sm:col-span-2 lg:col-span-1">
                        <x-text-input
                            name="school_name"
                            label="Okul Adı"
                            placeholder="Öğrencinin eğitim aldığı okul"
                            :value="$student->school_name"
                            icon='<svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z"/></svg>'
                        />
                    </div>
                </div>
            </div>

            {{-- Veli Bilgileri (1. Veli) --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Veli Bilgileri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">1. veli bilgileri (zorunlu)</p>
                    </div>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    <x-text-input
                        name="guardian1_relationship"
                        label="Yakınlık"
                        placeholder="örn: Anne"
                        :value="$student->guardians[0]->relationship ?? ''"
                        :required="true"
                        ringColor="indigo"
                    />
                    <x-text-input
                        name="guardian1_full_name"
                        label="Ad Soyad"
                        placeholder="Ayşe Yılmaz"
                        :value="$student->guardians[0]->full_name ?? ''"
                        :required="true"
                        ringColor="indigo"
                    />
                    <x-text-input
                        name="guardian1_national_id"
                        label="T.C. Kimlik No"
                        placeholder="12345678901"
                        :value="$student->guardians[0]->national_id ?? ''"
                        ringColor="indigo"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                    />
                    <x-text-input
                        name="guardian1_birth_date"
                        type="date"
                        label="Doğum Tarihi"
                        :value="$student->guardians[0]->birth_date ?? ''"
                        ringColor="indigo"
                    />
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Eğitim Düzeyi</label>
                        <x-checkbox-dropdown
                            name="guardian1_education_level"
                            :items="collect($education_levels)->map(fn($l) => ['id' => $l, 'name' => $l])->toArray()"
                            :selected="old('guardian1_education_level', $student->guardians[0]->education_level ?? '') ? [old('guardian1_education_level', $student->guardians[0]->education_level ?? '')] : []"
                            placeholder="Seçin..."
                            :multiple="false"
                        />
                        @error('guardian1_education_level')
                            <p class="text-sm text-red-500 flex items-center gap-1.5"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                    <x-text-input
                        name="guardian1_job"
                        label="Meslek"
                        placeholder="örn: Memur"
                        :value="$student->guardians[0]->job ?? ''"
                        ringColor="indigo"
                    />
                    <x-text-input
                        name="guardian1_phone_1"
                        type="tel"
                        label="Telefon 1"
                        placeholder="05551234545"
                        :value="$student->guardians[0]->phone_1 ?? ''"
                        :required="true"
                        ringColor="indigo"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                    />
                    <x-text-input
                        name="guardian1_phone_2"
                        type="tel"
                        label="Telefon 2"
                        placeholder="05551234545"
                        :value="$student->guardians[0]->phone_2 ?? ''"
                        ringColor="indigo"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                    />
                    <x-text-input
                        name="guardian1_email"
                        type="email"
                        label="E-mail"
                        placeholder="ornek@parosis.com"
                        :value="$student->guardians[0]->email ?? ''"
                        ringColor="indigo"
                    />
                    <div class="sm:col-span-2">
                        <x-text-input
                            name="guardian1_home_address"
                            label="Ev Adresi"
                            placeholder="mahalle, sokak, no, ilçe, il"
                            :value="$student->guardians[0]->home_address ?? ''"
                            ringColor="indigo"
                        />
                    </div>
                    <div class="sm:col-span-2">
                        <x-text-input
                            name="guardian1_work_address"
                            label="İş Adresi"
                            placeholder="mahalle, sokak, no, ilçe, il"
                            :value="$student->guardians[0]->work_address ?? ''"
                            ringColor="indigo"
                        />
                    </div>
                </div>
            </div>

            {{-- 2. Veli (Toggle) --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center justify-between px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-slate-900 dark:text-white">2. Veli Bilgileri</h3>
                            <p class="text-xs text-slate-400 mt-0.5">İsteğe bağlı ek veli bilgileri</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="guardian2_active" value="1"
                               x-model="guardian2Active" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300/30 dark:peer-focus:ring-violet-800/30 rounded-full peer dark:bg-slate-600 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:after:border-slate-500 peer-checked:bg-violet-500"></div>
                    </label>
                </div>

                <div x-show="guardian2Active" x-collapse>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 dark:border-slate-700/50 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        <x-text-input
                            name="guardian2_relationship"
                            label="Yakınlık"
                            placeholder="örn: Baba"
                            :value="$student->guardians[1]->relationship ?? ''"
                            ringColor="violet"
                            x-bind:disabled="!guardian2Active"
                        />
                        <x-text-input
                            name="guardian2_full_name"
                            label="Ad Soyad"
                            placeholder="Mehmet Yılmaz"
                            :value="$student->guardians[1]->full_name ?? ''"
                            ringColor="violet"
                            x-bind:disabled="!guardian2Active"
                        />
                        <x-text-input
                            name="guardian2_national_id"
                            label="T.C. Kimlik No"
                            placeholder="12345678901"
                            :value="$student->guardians[1]->national_id ?? ''"
                            ringColor="violet"
                            x-bind:disabled="!guardian2Active"
                            inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                        />
                        <x-text-input
                            name="guardian2_birth_date"
                            type="date"
                            label="Doğum Tarihi"
                            :value="$student->guardians[1]->birth_date ?? ''"
                            ringColor="violet"
                            x-bind:disabled="!guardian2Active"
                        />
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Eğitim Düzeyi</label>
                            <select name="guardian2_education_level" x-bind:disabled="!guardian2Active"
                                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-violet-500/60 transition-all appearance-none">
                                @foreach ($education_levels as $level)
                                    <option {{ old('guardian2_education_level', $student->guardians[1]->education_level ?? '') == $level ? 'selected' : '' }} value="{{ $level }}">{{ $level }}</option>
                                @endforeach
                            </select>
                            @error('guardian2_education_level')
                                <p class="text-sm text-red-500 flex items-center gap-1.5"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                            @enderror
                        </div>
                        <x-text-input
                            name="guardian2_job"
                            label="Meslek"
                            placeholder="örn: Memur"
                            :value="$student->guardians[1]->job ?? ''"
                            ringColor="violet"
                            x-bind:disabled="!guardian2Active"
                        />
                        <x-text-input
                            name="guardian2_phone_1"
                            type="tel"
                            label="Telefon 1"
                            placeholder="05551234545"
                            :value="$student->guardians[1]->phone_1 ?? ''"
                            ringColor="violet"
                            x-bind:disabled="!guardian2Active"
                            inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                        />
                        <x-text-input
                            name="guardian2_phone_2"
                            type="tel"
                            label="Telefon 2"
                            placeholder="05551234545"
                            :value="$student->guardians[1]->phone_2 ?? ''"
                            ringColor="violet"
                            x-bind:disabled="!guardian2Active"
                            inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                        />
                        <x-text-input
                            name="guardian2_email"
                            type="email"
                            label="E-mail"
                            placeholder="ornek@parosis.com"
                            :value="$student->guardians[1]->email ?? ''"
                            ringColor="violet"
                            x-bind:disabled="!guardian2Active"
                        />
                        <div class="sm:col-span-2">
                            <x-text-input
                                name="guardian2_home_address"
                                label="Ev Adresi"
                                placeholder="mahalle, sokak, no, ilçe, il"
                                :value="$student->guardians[1]->home_address ?? ''"
                                ringColor="violet"
                                x-bind:disabled="!guardian2Active"
                            />
                        </div>
                        <div class="sm:col-span-2">
                            <x-text-input
                                name="guardian2_work_address"
                                label="İş Adresi"
                                placeholder="mahalle, sokak, no, ilçe, il"
                                :value="$student->guardians[1]->work_address ?? ''"
                                ringColor="violet"
                                x-bind:disabled="!guardian2Active"
                            />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Acil Durum Kişisi --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Acil Durumda Aranacak Kişi</h3>
                        <p class="text-xs text-slate-400 mt-0.5">3. kişi iletişim bilgileri</p>
                    </div>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <x-text-input
                        name="emergency_full_name"
                        label="Ad Soyad"
                        placeholder="örn: Ahmet Yılmaz"
                        :value="$student->emergencyContact->full_name ?? ''"
                        ringColor="red"
                    />
                    <x-text-input
                        name="emergency_relationship"
                        label="Yakınlık"
                        placeholder="örn: Amcası"
                        :value="$student->emergencyContact->relationship ?? ''"
                        ringColor="red"
                    />
                    <x-text-input
                        name="emergency_phone"
                        type="tel"
                        label="Telefon"
                        placeholder="05551234545"
                        :value="$student->emergencyContact->phone ?? ''"
                        ringColor="red"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                    />
                    <div class="sm:col-span-3">
                        <x-text-input
                            name="emergency_address"
                            label="Adres"
                            placeholder="mahalle, sokak, no, ilçe, il"
                            :value="$student->emergencyContact->address ?? ''"
                            ringColor="red"
                        />
                    </div>
                </div>
            </div>

            {{-- Alerji --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                               :class="hasAllergy === '1' ? 'bg-amber-50 dark:bg-amber-900/20 ring-2 ring-amber-400/50' : 'bg-slate-50 dark:bg-slate-700/50 ring-1 ring-slate-200 dark:ring-slate-600'">
                            <input type="radio" name="has_allergy" value="1" x-model="hasAllergy"
                                   class="w-4 h-4 text-amber-500 border-slate-300 focus:ring-amber-500 cursor-pointer">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Evet</span>
                        </label>
                        <label class="flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer transition-all"
                               :class="hasAllergy === '2' ? 'bg-emerald-50 dark:bg-emerald-900/20 ring-2 ring-emerald-400/50' : 'bg-slate-50 dark:bg-slate-700/50 ring-1 ring-slate-200 dark:ring-slate-600'">
                            <input type="radio" name="has_allergy" value="2" x-model="hasAllergy"
                                   class="w-4 h-4 text-emerald-500 border-slate-300 focus:ring-emerald-500 cursor-pointer">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Hayır</span>
                        </label>
                        @error('has_allergy')
                            <p class="text-sm text-red-500 flex items-center gap-1.5"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-show="hasAllergy === '1'" x-collapse>
                        <x-text-input
                            name="allergy_detail"
                            label="Alerji Detayları"
                            placeholder="Alerji detaylarını yazın..."
                            :value="$student->allergy_detail"
                            ringColor="amber"
                        />
                    </div>
                </div>
            </div>

            {{-- Sınıf ve Dönem --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Sınıf & Dönem</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Öğrencinin sınıf ve eğitim dönemi bilgileri</p>
                    </div>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sınıf <span class="text-red-500">*</span></label>
                        <x-checkbox-dropdown
                            name="class_id"
                            :items="$classes->map(fn($c) => ['id' => $c->id, 'name' => $c->name . ' - ' . ($c->teacher?->name ?? '')])->toArray()"
                            :selected="old('class_id') ? [(int) old('class_id')] : []"
                            placeholder="Sınıf seçin..."
                            :multiple="false"
                            :required="true"
                        />
                        @error('class_id')
                            <p class="text-sm text-red-500 flex items-center gap-1.5"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Eğitim Dönemi <span class="text-red-500">*</span></label>
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
                        @error('registiration_term')
                            <p class="text-sm text-red-500 flex items-center gap-1.5"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Notlar --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Notlar</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Ek bilgi veya notlar</p>
                    </div>
                </div>

                <div class="p-6">
                    <x-textarea name="notes" :value="$student->notes" placeholder="Öğrenci hakkında ek bilgi veya notlarınızı buraya yazın..." />
                </div>
            </div>
        </div>

        {{-- Sag Kolon (Sidebar) --}}
        <div class="lg:col-span-1 space-y-5">

            {{-- Onizleme Kartı --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 sticky top-24 self-start">
                <div class="px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Kayıt Yenileme</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Mevcut kayıt bilgileri</p>
                </div>

                <div class="p-6 flex flex-col items-center">
                    @php
                        $colors = ['from-fuchsia-500 to-purple-600', 'from-sky-500 to-blue-600', 'from-emerald-500 to-teal-600', 'from-amber-500 to-orange-600', 'from-rose-500 to-pink-600'];
                        $colorIndex = abs(crc32($student->full_name)) % count($colors);
                    @endphp
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br {{ $colors[$colorIndex] }} flex items-center justify-center shadow-lg">
                        <span class="text-2xl font-bold text-white" x-text="initials"></span>
                    </div>
                    <h4 class="mt-4 text-lg font-bold text-slate-900 dark:text-white text-center" x-text="studentName || 'Öğrenci Adı'"></h4>
                    <span class="mt-1.5 inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                        Kayıt Yenileme
                    </span>

                    <div class="mt-6 w-full space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500 dark:text-slate-400">İlk Kayıt</span>
                            <span class="font-medium text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($student->created_at)->format('d.m.Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500 dark:text-slate-400">Durum</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $student->is_active == '1' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-400' }}">
                                {{ $student->is_active == '1' ? 'Aktif' : 'Pasif' }}
                            </span>
                        </div>
                        @if($student->gender)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500 dark:text-slate-400">Cinsiyet</span>
                            <span class="font-medium text-slate-900 dark:text-white">{{ $student->gender }}</span>
                        </div>
                        @endif
                        @if($student->birth_date)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500 dark:text-slate-400">Doğum Tarihi</span>
                            <span class="font-medium text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($student->birth_date)->format('d.m.Y') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="px-6 pb-6 space-y-3">
                    <button type="submit"
                            class="w-full px-6 py-3.5 bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700
                                   text-white text-sm font-semibold rounded-xl shadow-lg shadow-fuchsia-500/25
                                   transition-all duration-200 cursor-pointer active:scale-[0.98]">
                        Kaydı Yenile
                    </button>
                    <a href="{{ route('students.index') }}"
                       class="block w-full px-6 py-3 bg-slate-100 dark:bg-slate-700/80 text-slate-600 dark:text-slate-300
                              text-sm font-semibold rounded-xl text-center hover:bg-slate-200 dark:hover:bg-slate-600
                              transition-all duration-200">
                        Vazgeç
                    </a>
                </div>
            </div>
        </div>

    </div>
</form>

@endsection
