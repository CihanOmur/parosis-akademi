@extends('admin.layouts.app')
@section('styles')
    <link href="{{ asset('tomselect.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800 ">
        @yield('page-title', 'Ön Kayıt Ekle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
@endsection

@section('content')
    <div class="rounded-lg mb-4">

        <div class="w-full">
            <form class=" w-full space-y-6" action="{{ route('students.storePreRegistiration') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">

                {{-- Registration Type --}}
                <input id="bordered-radio-1" type="text" name="registiration_type" value="1"class="hidden">

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
                                        <label class="block mb-2 font-medium">Telefon</label>
                                        <input type="tel" pattern="[0-9]*" max="11" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
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
                                        <input type="tel" pattern="[0-9]*" max="11" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11)"
                                            name="guardian1_phone_2" placeholder="örn: 05551234545"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            value="{{ old('guardian1_phone_2') }}">
                                        <div class="text-red-500 text-xs mt-2">
                                            @error('guardian1_phone_2')
                                                {{ $message }}
                                            @enderror

                                        </div>
                                    </div>

                                </div>

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
                        <div class="mb-6">
                            <label class="block mb-2 font-medium">Randevu Durumu</label>
                            <select name="meets_status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach (['Görüşüldü', 'Görüşülmedi', 'Görüşülecek'] as $meets_st)
                                    <option {{ old('meets_status') == $meets_st ? 'selected' : '' }}
                                        value="{{ $meets_st }}">
                                        {{ $meets_st }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-red-500 text-xs mt-2">
                                @error('meets_status')
                                    {{ $message }}
                                @enderror

                            </div>
                        </div>
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
                    $('#guardian2_fields').prop('hidden', !isChecked);

                });
                $('#guardian2_active').trigger('change');



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
