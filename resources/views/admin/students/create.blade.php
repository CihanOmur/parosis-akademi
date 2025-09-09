@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
        @yield('page-title', 'Kullanıcı Ekle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <div class="flex items-center gap-2">
        <a href="{{ route('class.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Yeni
            Sınıf Ekle</a>
    </div>
@endsection

@section('content')
    <div class="rounded-lg mb-4">

        <div class="w-full bg-white py-10 px-8 rounded-lg">
            <form class=" w-full" action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">


                {{-- Registration Type --}}
                <div class="mb-6">
                    <label class="block mb-2 font-medium">Kayıt Tipi</label>
                    <div class="flex items-center justify-start gap-4">
                        <div class="flex items-center justify-start gap-2">
                            <input type="radio" name="registiration_type" value="1">
                            <span>Ön Kayıt</span>
                        </div>
                        <div class="flex items-center justify-start gap-2">
                            <input type="radio" name="registiration_type" checked value="2">
                            <span>Kesin Kayıt</span>
                        </div>
                    </div>
                </div>

                {{-- Student Info --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Adı Soyadı</label>
                        <input type="text" name="full_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="John Doe">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Cinsiyet</label>
                        <select name="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="Erkek">Erkek</option>
                            <option value="Kadın">Kadın</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Doğum Tarihi</label>
                        <input type="date" name="birth_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Okul Adı</label>
                        <input type="text" name="school_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Tc No</label>
                        <input type="text" name="tc_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Kan Grubu</label>
                        <input type="text" name="blood_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>

                {{-- Class Select --}}
                <div class="mb-6">
                    <label class="block mb-2 font-medium">Sınıf</label>
                    <select name="class_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }} ({{ $class->day }}
                                {{ $class->time }})</option>
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
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">TC No</label>
                                <input type="text" name="guardian1_national_id" placeholder="TC No"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Yakınlık</label>
                                <input type="text" name="guardian1_relationship" placeholder="Yakınlık"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Doğum Tarihi</label>
                                <input type="date" name="guardian1_birth_date" placeholder="Doğum Tarihi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Eğitim Düzeyi</label>
                                <select name="guardian1_education_level"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach ($education_levels as $level)
                                        <option value="{{ $level }}">{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Meslek</label>
                                <select name="guardian1_job"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job }}">{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">1. Telefon</label>
                                <input type="text" name="guardian1_phone_1" placeholder="1. Telefon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">2.Telefon</label>
                                <input type="text" name="guardian1_phone_2" placeholder="2.Telefon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Email</label>
                                <input type="email" name="guardian1_email" placeholder="Email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Ev Adresi</label>
                                <input type="text" name="guardian1_home_address" placeholder="Ev Adresi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">İş Adresi</label>
                                <input type="text" name="guardian1_work_address" placeholder="İş Adresi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 col-span-2">
                            </div>
                        </div>
                    </div>

                    {{-- Guardian 2 --}}
                    <div>
                        <div class="mb-6">
                            <label class="mb-2 font-semibold">
                                <input type="checkbox" id="guardian2_active" name="guardian2_active" class="">
                                Veli 2 Aktif Et
                            </label>
                        </div>

                        <div id="guardian2_fields" class="grid grid-cols-2 gap-4">
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Adı Soyadı</label>
                                <input type="text" name="guardian1_full_name" placeholder="Adı Soyadı" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">TC No</label>
                                <input type="text" name="guardian1_national_id" placeholder="TC No" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Yakınlık</label>
                                <input type="text" name="guardian1_relationship" placeholder="Yakınlık" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Doğum Tarihi</label>
                                <input type="date" name="guardian1_birth_date" placeholder="Doğum Tarihi" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Eğitim Düzeyi</label>
                                <select name="guardian1_education_level" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach ($education_levels as $level)
                                        <option value="{{ $level }}">{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Meslek</label>
                                <select name="guardian1_job" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job }}">{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">1. Telefon</label>
                                <input type="text" name="guardian1_phone_1" placeholder="1. Telefon" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">2.Telefon</label>
                                <input type="text" name="guardian1_phone_2" placeholder="2.Telefon" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Email</label>
                                <input type="email" name="guardian1_email" placeholder="Email" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">Ev Adresi</label>
                                <input type="text" name="guardian1_home_address" placeholder="Ev Adresi" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-medium">İş Adresi</label>
                                <input type="text" name="guardian1_work_address" placeholder="İş Adresi" disabled
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Yakınlık</label>
                        <input type="text" name="emergency_relationship" placeholder="Yakınlık"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Telefon</label>
                        <input type="text" name="emergency_phone" placeholder="Telefon"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Adres</label>
                        <input type="text" name="emergency_address" placeholder="Adres"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>



                {{-- Allergy --}}
                <div class="mb-6">
                    <label>
                        <span class="font-semibold">Alerjisi Var Mı?</span>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="has_allergy" value="1" id="has_allergy">
                                <label for="has_allergy">Evet</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="radio" name="has_allergy" value="2" checked id="no_allergy">
                                <label for="no_allergy">Hayır</label>

                            </div>


                        </div>
                    </label>
                </div>
                <div id="allergy_detail_field" class="hidden mb-6">
                    <input type="text" name="allergy_detail" placeholder="Alerji Detayları"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                {{-- Notes --}}
                <div class="mb-6">
                    <label class="block mb-2 font-medium">Notlar</label>
                    <textarea name="notes" placeholder="Notlar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Student</button>
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
