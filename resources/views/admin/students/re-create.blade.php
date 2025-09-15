@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
        @yield('page-title', 'Kullanıcı Düzenle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <div class="flex items-center gap-2">
        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Yeni
            Sınıf Ekle</a>
    </div>
@endsection

@section('content')
    <div class="rounded-lg mb-4">


        <div class="w-full bg-white py-10 px-8 rounded-lg">
            <form class=" w-full" action="{{ route('students.reCreateUpdate', ['id' => $student->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">


                {{-- Registration Type --}}
                <div class="mb-6">
                    <label class="block mb-2 font-medium">Kayıt Tipi</label>
                    <div class="flex items-center justify-start gap-4">
                        <div class="flex items-center justify-start gap-2">
                            <input type="radio" name="registiration_type" value="1"
                                {{ $student->registration_type == '' ? 'checked' : '1' }}>
                            <span>Ön Kayıt</span>
                        </div>
                        <div class="flex items-center justify-start gap-2">
                            <input type="radio" name="registiration_type" value="2"
                                {{ $student->registration_type == '2' ? 'checked' : '' }}>
                            <span>Kesin Kayıt</span>
                        </div>
                    </div>
                </div>

                {{-- Student Info --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Adı Soyadı</label>
                        <input type="text" name="full_name" value="{{ $student->full_name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="John Doe">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Cinsiyet</label>
                        <select name="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option {{ $student->gender == 'Erkek' ? 'selected' : '' }} value="Erkek">Erkek</option>
                            <option {{ $student->gender == 'Kadın' ? 'selected' : '' }} value="Kadın">Kadın</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Doğum Tarihi</label>
                        <input type="date" name="birth_date" value="{{ $student->birth_date }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Okul Adı</label>
                        <input type="text" name="school_name" value="{{ $student->school_name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Tc No</label>
                        <input type="text" name="tc_no" value="{{ $student->national_id }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Kan Grubu</label>
                        <input type="text" name="blood_type" value="{{ $student->blood_type }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>

                {{-- Class Select --}}
                <div class="mb-6">
                    <label class="block mb-2 font-medium">Sınıf</label>
                    <select name="class_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach ($classes as $class)
                            <option {{ $student->class_id == $class->id ? 'selected' : '' }} value="{{ $class->id }}">
                                {{ $class->name }}
                                ({{ $class->day }}
                                {{ $class->time }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Guardian 1 --}}
                    <div>
                        <div class="mb-6">
                            <label>
                                <h3 class="mb-2 font-semibold">Veli 1</h3>
                            </label>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Adı Soyadı</label>
                                <input type="text" name="guardian1_full_name" placeholder="Adı Soyadı"
                                    value="{{ $student->guardians[0]->full_name ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">TC No</label>
                                <input type="text" name="guardian1_national_id" placeholder="TC No"
                                    value="{{ $student->guardians[0]?->national_id ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Yakınlık</label>
                                <input type="text" name="guardian1_relationship" placeholder="Yakınlık"
                                    value="{{ $student->guardians[0]?->relationship ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Doğum Tarihi</label>
                                <input type="date" name="guardian1_birth_date" placeholder="Doğum Tarihi"
                                    value="{{ $student->guardians[0]?->birth_date ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Meslek</label>
                                <select name="guardian1_job"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach ($jobs as $job)
                                        <option {{ $student->guardians[0]?->job ?? '' == $job ? 'selected' : '' }}
                                            value="{{ $job }}">{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">1. Telefon</label>
                                <input type="text" name="guardian1_phone_1" placeholder="1. Telefon"
                                    value="{{ $student->guardians[0]?->phone_1 ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">2.Telefon</label>
                                <input type="text" name="guardian1_phone_2" placeholder="2.Telefon"
                                    value="{{ $student->guardians[0]?->phone_2 ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Email</label>
                                <input type="email" name="guardian1_email" placeholder="Email"
                                    value="{{ $student->guardians[0]?->email ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Ev Adresi</label>
                                <input type="text" name="guardian1_home_address" placeholder="Ev Adresi"
                                    value="{{ $student->guardians[0]?->home_address ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">İş Adresi</label>
                                <input type="text" name="guardian1_work_address" placeholder="İş Adresi"
                                    value="{{ $student->guardians[0]?->work_address ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 col-span-2">
                            </div>
                        </div>
                    </div>

                    {{-- Guardian 2 --}}
                    <div>
                        <div class="mb-6">
                            <label class="mb-2 font-semibold">
                                <input type="checkbox" id="guardian2_active" name="guardian2_active" value="1"
                                    {{ count($student->guardians ?? []) > 1 ? 'checked' : '' }} class="">
                                Veli 2 Aktif Et
                            </label>
                        </div>

                        <div id="guardian2_fields" class="grid grid-cols-2 gap-4">
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Adı Soyadı</label>
                                <input type="text" name="guardian1_full_name" placeholder="Adı Soyadı"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    value="{{ $student->guardians[1]?->full_name ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">TC No</label>
                                <input type="text" name="guardian1_national_id" placeholder="TC No"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    value="{{ $student->guardians[1]?->national_id ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Yakınlık</label>
                                <input type="text" name="guardian1_relationship" placeholder="Yakınlık"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    value="{{ $student->guardians[1]?->relationship ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Doğum Tarihi</label>
                                <input type="date" name="guardian1_birth_date" placeholder="Doğum Tarihi"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    value="{{ $student->guardians[1]?->birth_date ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Eğitim Düzeyi</label>
                                <select name="guardian1_education_level"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach ($education_levels as $level)
                                        <option
                                            {{ $student->guardians[1]?->education_level ?? '' == $level ? 'selected' : '' }}
                                            value="{{ $level }}">{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Meslek</label>
                                <select name="guardian1_job" {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach ($jobs as $job)
                                        <option {{ $student->guardians[1]?->job ?? '' == $job ? 'selected' : '' }}
                                            value="{{ $job }}">{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">1. Telefon</label>
                                <input type="text" name="guardian1_phone_1" placeholder="1. Telefon"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    value="{{ $student->guardians[1]?->phone_1 ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">2.Telefon</label>
                                <input type="text" name="guardian1_phone_2" placeholder="2.Telefon"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    value="{{ $student->guardians[1]?->phone_2 ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Email</label>
                                <input type="email" name="guardian1_email" placeholder="Email"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    value="{{ $student->guardians[1]?->email ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Ev Adresi</label>
                                <input type="text" name="guardian1_home_address" placeholder="Ev Adresi"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    value="{{ $student->guardians[1]?->home_address ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">İş Adresi</label>
                                <input type="text" name="guardian1_work_address" placeholder="İş Adresi"
                                    {{ count($student->guardians ?? []) > 1 ? '' : 'disabled' }}
                                    value="{{ $student->guardians[1]?->work_address ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 col-span-2">
                            </div>

                        </div>
                    </div>
                </div>



                {{-- Emergency --}}
                <h3 class="mb-2 font-semibold">Acil Durumda Aranacak 3. Kişiler</h3>
                <div class="grid grid-cols-4 gap-4">
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Adı Soyadı</label>
                        <input type="text" name="emergency_full_name" placeholder="Adı Soyadı"
                            value="{{ $student->emergencyContact->full_name ?? '' }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Yakınlık</label>
                        <input type="text" name="emergency_relationship" placeholder="Yakınlık"
                            value="{{ $student->emergencyContact->relationship ?? '' }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Telefon</label>
                        <input type="text" name="emergency_phone" placeholder="Telefon"
                            value="{{ $student->emergencyContact->phone ?? '' }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Adres</label>
                        <input type="text" name="emergency_address" placeholder="Adres"
                            value="{{ $student->emergencyContact->address ?? '' }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>



                {{-- Allergy --}}
                <div class="mb-6">
                    <label>
                        <span class="font-semibold">Alerjisi Var Mı?</span>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="has_allergy" value="1" id="has_allergy"
                                    {{ $student->has_allergy ? 'checked' : '' }}>
                                <label for="has_allergy">Evet</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="radio" name="has_allergy" value="2"
                                    {{ !$student->has_allergy ? 'checked' : '' }} id="no_allergy">
                                <label for="no_allergy">Hayır</label>

                            </div>


                        </div>
                    </label>
                </div>
                <div id="allergy_detail_field" class="hidden mb-6">
                    <input type="text" name="allergy_detail" placeholder="Alerji Detayları"
                        value="{{ $student->allergy_detail }}"
                        class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                {{-- Notes --}}
                <div class="mb-6">
                    <label class="block mb-2 font-medium">Notlar</label>
                    <textarea name="notes" placeholder="Notlar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $student->notes }}</textarea>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Student</button>
            </form>
        </div>

        <script>
            $(document).ready(function() {
                // guardian2 checkbox
                $('#guardian2_active').change(function() {
                    var isChecked = this.checked;
                    $('#guardian2_fields').find('input, select, textarea').prop('disabled', !isChecked);
                });

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

    </div>
@endsection
