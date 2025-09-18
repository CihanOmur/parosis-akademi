@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', 'Öğrenci Ekle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
@endsection

@section('content')
    <div class="rounded-lg mb-4">

        <div class="w-full">
            <form class=" w-full space-y-6" action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">

                {{-- Registration Type --}}
                <div class="w-full bg-white rounded-lg border border-gray-200">
                    <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                        <h3 class="text-md font-semibold text-gray-900 ">
                            Kayıt Türü
                        </h3>
                    </div>
                    <div class="py-10 px-5">
                        <div class="flex items-center justify-start gap-4 ">
                            <div
                                class="flex items-center ps-4 border border-gray-300 rounded-lg w-1/4 bg-gray-50 cursor-pointer">
                                <input id="bordered-radio-1" type="radio" name="registiration_type"
                                    value="1"class="w-4 h-4 text-blue-600 bg-white border-gray-300 focus:ring-blue-500  focus:ring-2 cursor-pointer">
                                <label for="bordered-radio-1"
                                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 cursor-pointer">Ön
                                    Kayıt</label>
                            </div>
                            <!-- <div class="flex items-center justify-start gap-2">
                                                                                                            <input type="radio" name="registiration_type" value="1">
                                                                                                            <span>Ön Kayıt</span>
                                                                                                        </div> -->
                            <div
                                class="flex items-center ps-4 border border-gray-300 rounded-lg w-1/4 bg-gray-50 cursor-pointer">
                                <input id="bordered-radio-2" type="radio" name="registiration_type" checked value="2"
                                    class="w-4 h-4 text-blue-600 bg-white border-gray-300 focus:ring-blue-500 focus:ring-2 cursor-pointer">
                                <label for="bordered-radio-2"
                                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 cursor-pointer">Kesin
                                    Kayıt</label>
                            </div>
                            <!-- <div class="flex items-center justify-start gap-2">
                                                                                                            <input type="radio" name="registiration_type" checked value="2">
                                                                                                            <span>Kesin Kayıt</span>
                                                                                                        </div> -->
                        </div>
                    </div>
                </div>

                {{-- Student Info --}}
                <div class="w-full bg-white rounded-lg border border-gray-200">
                    <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                        <h3 class="text-md font-semibold text-gray-900 ">
                            Öğrenci Bilgileri
                        </h3>
                    </div>
                    <div class="py-10 px-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Ad Soyad</label>
                                <input type="text" name="full_name"
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
                                    <option {{ old('gender') == 'Erkek' ? 'selected' : '' }} value="Erkek">Erkek</option>
                                    <option {{ old('gender') == 'Kadın' ? 'selected' : '' }} value="Kadın">Kadın</option>
                                </select>
                                <div class="text-red-500 text-xs mt-2">
                                    @error('gender')
                                        {{ $message }}
                                    @enderror

                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Doğum Tarihi</label>
                                <input type="date" name="birth_date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('birth_date') }}">
                                <div class="text-red-500 text-xs mt-2">
                                    @error('birth_date')
                                        {{ $message }}
                                    @enderror

                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Okul Adı</label>
                                <input type="text" name="school_name" placeholder="Öğrencinin eğitim aldığı okul"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('school_name') }}">
                                <div class="text-red-500 text-xs mt-2">
                                    @error('school_name')
                                        {{ $message }}
                                    @enderror

                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="block mb-2 font-medium">T.C. Kimlik No</label>
                                <input type="text" name="tc_no" maxlength="11" inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                    placeholder="örn: 12345678901"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('tc_no') }}">
                                <div class="text-red-500 text-xs mt-2">
                                    @error('tc_no')
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
                                    @endphp
                                    @foreach ($bloodTypes as $type)
                                        <option value="{{ $type }}"
                                            {{ old('blood_type') == $type ? 'selected' : '' }}>
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
                                            value="{{ old('guardian1_relationship') }}">
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
                                            value="{{ old('guardian1_full_name') }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian1_full_name')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">T.C. Kimlik No</label>
                                        <input type="text" maxlength="11" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                            name="guardian1_national_id" placeholder="örn: 12345678901"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            value="{{ old('guardian1_national_id') }}">
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
                                            value="{{ old('guardian1_birth_date') }}">
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
                                                <option {{ old('guardian1_education_level') == $level ? 'selected' : '' }}
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
                                        <select name="guardian1_job"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            @foreach ($jobs as $job)
                                                <option {{ old('guardian1_job') == $job ? 'selected' : '' }}
                                                    value="{{ $job }}">{{ $job }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian1_job')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Telefon</label>
                                        <input type="tel" pattern="[0-9]*" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            name="guardian1_phone_1" placeholder="örn: 05551234545"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            value="{{ old('guardian1_phone_1') }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian1_phone_1')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 font-medium">Telefon</label>
                                        <input type="tel" pattern="[0-9]*" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            name="guardian1_phone_2" placeholder="örn: 05551234545"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            value="{{ old('guardian1_phone_2') }}">
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
                                            value="{{ old('guardian1_email') }}">
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
                                            value="{{ old('guardian1_home_address') }}">
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
                                            value="{{ old('guardian1_work_address') }}">
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
                                                disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ old('guardian2_relationship') }}">
                                            <div class="text-red-500 text-xs mt-2">
                                                @error('guardian2_relationship')
                                                    {{ $message }}
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 font-medium">Ad Soyad</label>
                                            <input type="text" name="guardian2_full_name"
                                                placeholder="örn: Mehmet Yılmaz" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ old('guardian2_full_name') }}">
                                            <div class="text-red-500 text-xs mt-2">
                                                @error('guardian2_full_name')
                                                    {{ $message }}
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 font-medium">T.C Kimlik No</label>
                                            <input type="text" name="guardian1_national_id" maxlength="11"
                                                inputmode="numeric"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                                placeholder="örn: 12345678901" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ old('guardian1_national_id') }}">
                                            <div class="text-red-500 text-xs mt-2">
                                                @error('guardian1_national_id')
                                                    {{ $message }}
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="mb-6">
                                            <label class="block mb-2 font-medium">Doğum Tarihi</label>
                                            <input type="date" name="guardian1_birth_date" placeholder="Doğum Tarihi"
                                                disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ old('guardian1_birth_date') }}">
                                            <div class="text-red-500 text-xs mt-2">
                                                @error('guardian1_birth_date')
                                                    {{ $message }}
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 font-medium">Eğitim Düzeyi</label>
                                            <select name="guardian2_education_level" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                @foreach ($education_levels as $level)
                                                    <option
                                                        {{ old('guardian2_education_level') == $level ? 'selected' : '' }}
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
                                            <select name="guardian2_job" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                @foreach ($jobs as $job)
                                                    <option {{ old('guardian2_job') == $job ? 'selected' : '' }}
                                                        value="{{ $job }}">{{ $job }}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-red-500 text-xs mt-2">
                                                @error('guardian2_job')
                                                    {{ $message }}
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 font-medium">Telefon</label>
                                            <input type="tel" pattern="[0-9]*" inputmode="numeric"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                name="guardian2_phone_1" placeholder="örn: 05551234545" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ old('guardian2_phone_1') }}">
                                            <div class="text-red-500 text-xs mt-2">
                                                @error('guardian2_phone_1')
                                                    {{ $message }}
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 font-medium">Telefon</label>
                                            <input type="tel" pattern="[0-9]*" inputmode="numeric"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                name="guardian2_phone_2" placeholder="örn: 05551234545" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ old('guardian2_phone_2') }}">
                                            <div class="text-red-500 text-xs mt-2">
                                                @error('guardian2_phone_2')
                                                    {{ $message }}
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 font-medium">E-mail</label>
                                            <input type="email" name="guardian2_email"
                                                placeholder="örn: ornek@parosis.com" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ old('guardian2_email') }}">
                                            <div class="text-red-500 text-xs mt-2">
                                                @error('guardian2_email')
                                                    {{ $message }}
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 font-medium">Ev Adresi</label>
                                            <input type="text" name="guardian2_home_address"
                                                placeholder="mahalle, sokak, no, ilçe, il" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ old('guardian2_home_address') }}">
                                            <div class="text-red-500 text-xs mt-2">
                                                @error('guardian2_home_address')
                                                    {{ $message }}
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 font-medium">İş Adresi</label>
                                            <input type="text" name="guardian2_work_address"
                                                placeholder="mahalle, sokak, no, ilçe, il" disabled
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 col-span-2"
                                                value="{{ old('guardian2_work_address') }}">
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
                                    value="{{ old('emergency_full_name') }}">
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
                                    value="{{ old('emergency_relationship') }}">
                                <div class="text-red-500 text-xs mt-2">
                                    @error('emergency_relationship')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Telefon</label>
                                <input type="tel" pattern="[0-9]*" inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="emergency_phone"
                                    placeholder="örn: 12345678901"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ old('emergency_phone') }}">
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
                                    value="{{ old('emergency_address') }}">
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
                                        {{ old('has_allergy') == '1' ? 'checked' : '' }}
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
                                    <input type="radio" name="has_allergy" value="2" checked id="no_allergy"
                                        {{ old('has_allergy') == '2' ? 'checked' : '' }}
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
                                value="{{ old('allergy_detail') }}">
                            <div class="text-red-500 text-xs mt-2">
                                @error('allergy_detail')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>

                    </div>
                </div>

                {{-- Class Select --}}
                <div class="w-full bg-white rounded-lg border border-gray-200">
                    <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                        <h3 class="text-md font-semibold text-gray-900 ">Sınıf</h3>
                    </div>
                    <div class="py-5 px-5">
                        <div class="mb-0">
                            <select name="class_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($classes as $class)
                                    <option {{ old('class_id') == $class->id ? 'selected' : '' }}
                                        value="{{ $class->id }}">
                                        {{ $class->name }} -
                                        {{ $class->day }} -
                                        {{ $class->time }} -
                                        {{ $class->teacher_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-red-500 text-xs mt-2">
                                @error('class_id')
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
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-30">{{ old('notes') }}</textarea>
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

                    // İçindeki tüm form elemanlarını aktif/pasif yap
                    $('#guardian2_fields').find('input, select, textarea').prop('disabled', !isChecked);
                });


                // has_allergy radio
                $('input[name="has_allergy"]').change(function() {
                    if ($(this).val() === '1') { // 'yes' evet değerini temsil ediyor
                        $('#allergy_detail_field').show();
                    } else {
                        $('#allergy_detail_field').hide();
                    }
                });

                $('#allergy_detail_field').toggle($('input[name="has_allergy"]:checked').val() === 'yes');
            });
        </script>

    </div>
@endsection
