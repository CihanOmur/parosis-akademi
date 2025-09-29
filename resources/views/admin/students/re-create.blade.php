@extends('admin.layouts.app')
@section('styles')
    <link href="{{ asset('tomselect.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection
@section('page-banner')
    <div>
        <h1 class="text-xl font-semibold text-gray-800 ">
            @yield('page-title', 'Kayıt Yenileme' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
        </h1>
        <div class="grid grid-cols-2 gap-4">
            <p>İlk kayıt tarihi: {{ \Carbon\Carbon::parse($student->created_at)->format('d.m.Y') }}</p>
            <p>Durum: {{ $student->is_active == '1' ? 'Aktif' : 'Pasif' }}</p>
        </div>
    </div>
@endsection
@section('content')
    <form action="{{ route('students.changeActivity', ['id' => $student->id]) }}" method="post" id="changeActivityForm">
        @csrf
    </form>

    <div class="w-full">
        <form class=" w-full space-y-6" action="{{ route('students.reCreateUpdate', ['id' => $student->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">

            {{-- Registration Type --}}
            <input id="bordered-radio-2" type="text" name="registiration_type" value="2" class="hidden">



            {{-- Student Info --}}
            <div class="w-full bg-white rounded-lg border border-gray-200">
                <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                    <h3 class="text-md font-semibold text-gray-900 ">
                        Öğrenci Bilgileri
                    </h3>
                </div>
                <div class="py-10 px-5">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Ad Soyad</label>
                            <input type="text" name="full_name" value="{{ $student->full_name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('full_name') }}" placeholder="örn: Ahmet Yılmaz">
                            <div class="text-red-500 text-xs mt-2">
                                @error('full_name')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Cinsiyet</label>
                            <select name="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="" disabled selected>Bir seçim yapın</option>
                                <option {{ $student->gender == 'Erkek' ? 'selected' : '' }} value="Erkek">Erkek
                                </option>
                                <option {{ $student->gender == 'Kadın' ? 'selected' : '' }} value="Kadın">Kadın
                                </option>
                            </select>
                            <div class="text-red-500 text-xs mt-2">
                                @error('gender')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Doğum Tarihi</label>
                            <input type="date" name="birth_date" value="{{ $student->birth_date }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('birth_date') }}">
                            <div class="text-red-500 text-xs mt-2">
                                @error('birth_date')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 font-medium">T.C. Kimlik No</label>
                            <input type="text" name="tc_no" max="11" inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                value="{{ $student->national_id }}" placeholder="örn: 12345678901"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('tc_no') }}">
                            <div class="text-red-500 text-xs mt-2">
                                @error('tc_no')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="block mb-2 font-medium">Telefon</label>
                            <input type="tel" max="11" inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)" name="student_phone"
                                value="{{ $student->student_phone }}" placeholder="örn: 05551234545"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <div class="text-red-500 text-xs mt-2">
                                @error('student_phone')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="block mb-2 font-medium">Kan Grubu</label>
                            <select name="blood_type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @php
                                    $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', '0+', '0-'];
                                    $selectedBloodType = old('blood_type', $student->blood_type);
                                @endphp
                                @foreach ($bloodTypes as $type)
                                    <option value="{{ $type }}"
                                        {{ $selectedBloodType == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-red-500 text-xs mt-2">
                                @error('blood_type')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="block mb-2 font-medium">Okul Adı</label>
                            <input type="text" name="school_name" value="{{ $student->school_name }}"
                                placeholder="Öğrencinin eğitim aldığı okul"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('school_name') }}">
                            <div class="text-red-500 text-xs mt-2">
                                @error('school_name')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>


                    </div>

                </div>
            </div>



            <div class="w-full">
                <div class="w-full bg-white rounded-lg border border-gray-200">
                    <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                        <h3 class="text-md font-semibold text-gray-900 ">Veli Bilgileri</h3>
                    </div>
                    <div class="py-10 px-5">

                        <div>

                            <div class="grid grid-cols-4 gap-4">
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">Yakınlık</label>
                                    <input type="text" name="guardian1_relationship" placeholder="örn: Anne"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        value="{{ $student->guardians[0]?->relationship ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_relationship')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">Ad Soyad</label>
                                    <input type="text" name="guardian1_full_name" placeholder="Ayşe Yılmaz"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        value="{{ $student->guardians[0]->full_name ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_full_name')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">T.C. Kimlik No</label>
                                    <input type="text" max="11" inputmode="numeric"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                        name="guardian1_national_id" placeholder="örn: 12345678901"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        value="{{ $student->guardians[0]?->national_id ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_national_id')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">Doğum Tarihi</label>
                                    <input type="date" name="guardian1_birth_date" placeholder="Doğum Tarihi"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        value="{{ $student->guardians[0]?->birth_date ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_birth_date')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">Eğitim Düzeyi</label>
                                    <select name="guardian1_education_level"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @foreach ($education_levels as $level)
                                            <option
                                                {{ $student->guardians[0]?->education_level ?? '' == $level ? 'selected' : '' }}
                                                value="{{ $level }}">{{ $level }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_education_level')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">Meslek</label>
                                    <input type="text" name="guardian1_job" placeholder="örn: Memur"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        value="{{ $student->guardians[0]?->job ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_job')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">Telefon</label>
                                    <input type="tel" pattern="[0-9]*" max="11" inputmode="numeric"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                        name="guardian1_phone_1" placeholder="örn: 05551234545"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        value="{{ $student->guardians[0]?->phone_1 ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_phone_1')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">Telefon</label>
                                    <input type="tel" pattern="[0-9]*" max="11" inputmode="numeric"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                        name="guardian1_phone_2" placeholder="örn: 05551234545"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        value="{{ $student->guardians[0]?->phone_2 ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_phone_2')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">E-mail</label>
                                    <input type="email" name="guardian1_email" placeholder="örn: ornek@parosis.com"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        value="{{ $student->guardians[0]?->email ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_email')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">Ev Adresi</label>
                                    <input type="text" name="guardian1_home_address"
                                        placeholder="mahalle, sokak, no, ilçe, il"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        value="{{ $student->guardians[0]?->home_address ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_home_address')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 font-medium">İş Adresi</label>
                                    <input type="text" name="guardian1_work_address"
                                        placeholder="mahalle, sokak, no, ilçe, il"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 col-span-2"
                                        value="{{ $student->guardians[0]?->work_address ?? '' }}">
                                    <div class="text-red-500 text-xs mt-2">
                                        @error('guardian1_work_address')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-6 mt-8">
                                    <div
                                        class="flex items-center ps-4 border border-gray-300 rounded-lg w-1/4 bg-gray-50 cursor-pointer">
                                        <input type="checkbox" id="guardian2_active" name="guardian2_active"
                                            value="1" {{ count($student->guardians ?? []) > 1 ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2 cursor-pointer">
                                        <label for="guardian2_active"
                                            class="w-full py-4 ms-2 text-sm font-medium text-gray-900 cursor-pointer">Veli
                                            Ekle</label>

                                    </div>
                                </div>
                                {{-- Guardian 2 --}}
                                <div id="guardian2_fields" class="grid grid-cols-4 gap-4">
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Yakınlık</label>
                                        <input type="text" name="guardian2_relationship" placeholder="örn: Baba"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            value="{{ $student->guardians[1]?->relationship ?? '' }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_relationship')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Ad Soyad</label>
                                        <input type="text" name="guardian2_full_name" placeholder="Mehmet Yılmaz"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            value="{{ $student->guardians[1]?->full_name ?? '' }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_full_name')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">T.C. Kimlik No</label>
                                        <input type="text" max="11" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                            name="guardian2_national_id" placeholder="örn: 12345678901"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            value="{{ $student->guardians[1]?->national_id ?? '' }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_national_id')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Doğum Tarihi</label>
                                        <input type="date" name="guardian2_birth_date" placeholder="Doğum Tarihi"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            value="{{ $student->guardians[1]?->birth_date ?? '' }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_birth_date')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Eğitim Düzeyi</label>
                                        <select name="guardian2_education_level"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            @foreach ($education_levels as $level)
                                                <option
                                                    {{ $student->guardians[1]?->education_level ?? '' == $level ? 'selected' : '' }}
                                                    value="{{ $level }}">{{ $level }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_education_level')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Meslek</label>
                                        <input type="text" name="guardian2_job"
                                            placeholder="örn: Memur"{{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            value="{{ $student->guardians[1]?->job ?? '' }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_job')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Telefon</label>
                                        <input type="tel" pattern="[0-9]*" max="11" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                            name="guardian2_phone_1" placeholder="örn: 05551234545"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            value="{{ $student->guardians[1]?->phone_1 ?? '' }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_phone_1')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Telefon</label>
                                        <input type="tel" pattern="[0-9]*" max="11" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                            name="guardian2_phone_2" placeholder="örn: 05551234545" disabled
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            value="{{ $student->guardians[1]?->phone_2 ?? '' }}" <div
                                            class="text-red-500 text-xs mt-2">
                                        @error('guardian2_phone_2')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Email</label>
                                        <input type="email" name="guardian2_email" placeholder="örn: ornek@parsis.com"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            value="{{ $student->guardians[1]?->email ?? '' }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_email')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Ev Adresi</label>
                                        <input type="text" name="guardian2_home_address"
                                            placeholder="mahalle, sokak, no, ilçe, il"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            value="{{ $student->guardians[1]?->home_address ?? '' }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_home_address')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">İş Adresi</label>
                                        <input type="text" name="guardian2_work_address"
                                            placeholder="mahalle, sokak, no, ilçe, il"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 col-span-2"
                                            {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                            value="{{ $student->guardians[1]?->work_address ?? '' }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian2_work_address')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                </div>
            </div>


            {{-- Emergency --}}
            <div class="w-full bg-white rounded-lg border border-gray-200">
                <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                    <h3 class="text-md font-semibold text-gray-900 ">Acil Durumda Aranacak 3. Kişiler</h3>
                </div>
                <div class="py-10 px-5">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Ad Soyad</label>
                            <input type="text" name="emergency_full_name" placeholder="örn: Ahmet Yılmaz"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $student->emergencyContact->full_name ?? '' }}">
                            <div class="text-red-500 text-xs mt-2">
                                @error('emergency_full_name')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Yakınlık</label>
                            <input type="text" name="emergency_relationship" placeholder="örn: Amcası"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $student->emergencyContact->relationship ?? '' }}">
                            <div class="text-red-500 text-xs mt-2">
                                @error('emergency_relationship')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Telefon</label>
                            <input type="tel" pattern="[0-9]*" max="11" inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                name="emergency_phone" placeholder="örn: 12345678901"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $student->emergencyContact->phone ?? '' }}">
                            <div class="text-red-500 text-xs mt-2">
                                @error('emergency_phone')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>

                    </div>
                    <div class="w-full">
                        <div class="mb-0">
                            <label class="block mb-2 font-medium">Adres</label>
                            <input type="text" name="emergency_address" placeholder="mahalle, sokak, no, ilçe, il"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $student->emergencyContact->address ?? '' }}">
                            <div class="text-red-500 text-xs mt-2">
                                @error('emergency_address')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Allergy --}}
            <div class="w-full bg-white rounded-lg border border-gray-200">
                <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                    <h3 class="text-md font-semibold text-gray-900 ">Alerjisi Var Mı?</h3>
                </div>
                <div class="py-10 px-5">
                    <div class="mb-0">
                        <div class="flex items-center justify-start gap-4 ">
                            <div
                                class="flex items-center ps-4 border border-gray-300 rounded-lg w-1/4 bg-gray-50 cursor-pointer">
                                <input type="radio" name="has_allergy" value="1" id="has_allergy"
                                    {{ $student->has_allergy == '1' ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-white border-gray-300 focus:ring-blue-500  focus:ring-2 cursor-pointer">
                                <label for="has_allergy"
                                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 cursor-pointer">Evet</label>
                            </div>
                            <div class="text-red-500 text-xs mt-2">
                                @error('has_allergy')
                                    {{ $message }}
                                @enderror

                            </div>
                            <div
                                class="flex items-center ps-4 border border-gray-300 rounded-lg w-1/4 bg-gray-50 cursor-pointer">
                                <input type="radio" name="has_allergy" value="2" id="no_allergy"
                                    {{ $student->has_allergy == '2' ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-white border-gray-300 focus:ring-blue-500  focus:ring-2 cursor-pointer">
                                <label for="no_allergy"
                                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 cursor-pointer">Hayır</label>
                            </div>
                            <div class="text-red-500 text-xs mt-2">
                                @error('has_allergy')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="allergy_detail_field" class="hidden mb-0 mt-6">
                        <input type="text" name="allergy_detail" placeholder="Alerji Detayları"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $student->allergy_detail }}">
                        <div class="text-red-500 text-xs mt-2">
                            @error('allergy_detail')
                                {{ $message }}
                            @enderror

                        </div>
                    </div>

                </div>
            </div>




            {{-- Allergy --}}

            <div id="allergy_detail_field" class="hidden mb-6">
                <input type="text" name="allergy_detail" placeholder="Alerji Detayları"
                    value="{{ $student->allergy_detail }}"
                    class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <div class="text-red-500 text-xs mt-2">
                    @error('allergy_detail')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            {{-- Class Select --}}
            <div class="w-full bg-white rounded-lg border border-gray-200">
                <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                    <h3 class="text-md font-semibold text-gray-900 ">Sınıf</h3>
                </div>
                <div class="py-5 px-5 grid grid-cols-2 gap-4">
                    <div class="mb-0">
                        <select name="class_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($classes as $class)
                                <option {{ old('class_id') == $class->id ? 'selected' : '' }}
                                    value="{{ $class->id }}">
                                    {{ $class->name }} -
                                    {{ $class->teacher?->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="text-red-500 text-xs mt-2">
                            @error('class_id')
                                {{ $message }}
                            @enderror

                        </div>
                    </div>
                    <div class="mb-0">
                        <label for="registiration_term" class="block text-sm font-medium text-gray-900">
                        </label>
                        @php
                            use Carbon\Carbon;
                            $startYear = 2020;
                            $endYear = Carbon::now()->year + 1;
                            $years = range($startYear, $endYear);
                            rsort($years);
                        @endphp
                        @php
                            $selectedTerms = explode(',', $student->registiration_term);

                        @endphp
                        <select id="registiration_term" name="registiration_term[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($years as $year)
                                @foreach (['Güz', 'Yaz', 'Bahar'] as $term)
                                    <option value="{{ $year . ' ' . $term }}"
                                        {{ in_array($year . ' ' . $term, $selectedTerms) ? 'selected' : '' }}>
                                        {{ $year . ' ' . $term }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        <div class="text-red-500 text-xs mt-2">
                            @error('registiration_term')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            {{-- Notes --}}
            <div class="w-full bg-white rounded-lg border border-gray-200">
                <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                    <h3 class="text-md font-semibold text-gray-900 ">Not</h3>
                </div>
                <div class="py-5 px-5">
                    <div class="mb-0">
                        <textarea name="notes" placeholder=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-30">{{ $student->notes }}</textarea>
                        <div class="text-red-500 text-xs mt-2">
                            @error('notes')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded cursor-pointer">Kaydet</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // guardian2 checkbox
            $('#guardian2_active').change(function() {
                var isChecked = this.checked;
                $('#guardian2_fields').find('input, select, textarea').prop('disabled', !isChecked);
                $('#guardian2_fields').prop('hidden', !isChecked);

            });
            $('#guardian2_active').trigger('change');

            // has_allergy radio
            $('input[name="has_allergy"]').change(function() {
                if ($(this).val() === '1') {
                    $('#allergy_detail_field').show();
                } else {
                    $('#allergy_detail_field').hide();
                }
            });
            $('input[name="has_allergy"]:checked').trigger('change');
        });
    </script>
    <script>
        new TomSelect('#registiration_term', {
            create: false,
            highlight: true,
            persist: false,
            openOnFocus: true,
            allowEmptyOption: false,
            placeholder: 'Eğitim dönemi seçin...',
            hidePlaceholder: true,
        });
    </script>
@endsection
