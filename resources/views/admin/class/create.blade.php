@extends('admin.layouts.app')
@section('styles')
    <link href="{{ asset('tomselect.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800">
        @yield('page-title', 'Sınıf Ekle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
@endsection

@section('content')
    <form class="w-full" action="{{ route('class.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
        <div class="rounded-lg mb-4">
            <div class="w-full bg-white rounded-lg border border-gray-200">

                <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                    <h3 class="text-md font-semibold text-gray-900 ">
                        Sınıf Bilgileri
                    </h3>
                </div>

                <div class="py-10 px-5">
                    <div class="flex w-full gap-4">
                        {{-- Sınıf Adı --}}
                        <div class="mb-0 w-full">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                Sınıf Adı</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                                placeholder="Sınıf adı girin">
                            <div class="text-red-500 text-xs mt-2">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        {{-- Günü --}}
                        {{-- <div class="mb-0 w-full">
                        <label for="day" class="block mb-2 text-sm font-medium text-gray-900">
                            Ders Günleri</label>
                        <select id="day" name="day[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($days as $key => $label)
                                <option value="{{ $key }}"
                                    {{ is_array(old('day')) && in_array($key, old('day')) ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <div class="text-red-500 text-xs mt-2">
                            @error('day')
                                {{ $message }}
                            @enderror
                        </div>
                    </div> --}}
                    </div>
                </div>
                {{-- <div class="py-0 px-5">
                    <div class="flex flex-col lg:flex-row lg:items-center w-full gap-x-4">
                        <div class="flex w-full gap-4">
                            <div class="mb-6 w-full">
                                <label for="time" class="block mb-2 text-sm font-medium text-gray-900">
                                    Başlangıç Saati</label>
                                <select id="time" name="time"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="" disabled selected>00:00</option>
                                    @foreach ($times as $value)
                                        @php
                                            $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                        @endphp
                                        <option value="{{ $value }}" {{ old('time') == $value ? 'selected' : '' }}>
                                            {{ $shortTime }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-red-500 text-xs mt-2">
                                    @error('time')
                                        {{ $message }}
                                    @enderror

                                </div>


                            </div>
                            <div class="mb-6 w-full">
                                <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900">
                                    Bitiş Saati</label>
                                <select id="end_time" name="end_time"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="" disabled selected>00:00</option>
                                    @foreach ($times as $value)
                                        @php
                                            $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                        @endphp
                                        <option value="{{ $value }}"
                                            {{ old('end_time') == $value ? 'selected' : '' }}>
                                            {{ $shortTime }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-red-500 text-xs mt-2">
                                    @error('end_time')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-6 w-full">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900">
                                Ücret</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Ücret girin">
                            <div class="text-red-500 text-xs mt-2">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                    </div>
                </div> --}}
                <div class="py-0 px-5">
                    <div class="flex w-full gap-4">
                        {{-- Kontenjan --}}
                        <div class="mb-0 w-full">
                            <label for="quota" class="block mb-2 text-sm font-medium text-gray-900">
                                Kontenjan</label>
                            <input type="number" name="quota" id="quota" value="{{ old('quota') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Kontenjan girin">
                            <div class="text-red-500 text-xs mt-2">
                                @error('quota')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        {{-- Öğretmen Adı --}}

                        <div class="mb-0 w-full">
                            <label for="teacher_id" class="block mb-2 text-sm font-medium text-gray-900">
                                Eğitmen</label>
                            <select id="teacher_id" name="teacher_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="" disabled selected>Eğitmen seçin</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-red-500 text-xs mt-2">
                                @error('teacher_id')
                                    {{ $message }}
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <div class="py-10 px-5">
                    <div class="flex flex-col lg:flex-row lg:items-center w-full gap-x-4">
                        <div class="flex w-full gap-4">
                            {{--  Başlangıç Tarihi --}}
                            <div class="mb-0 w-full">
                                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">
                                    Başlangıç Tarihi</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <div class="text-red-500 text-xs mt-2">
                                    @error('start_date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            {{--  Bitiş Tarihi --}}
                            <div class="mb-0 w-full">
                                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">
                                    Bitiş Tarihi</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <div class="text-red-500 text-xs mt-2">
                                    @error('end_date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex w-full gap-4">
                            {{--  Kurs Süresi --}}
                            <div class="mb-0 w-full">
                                <label for="course_time" class="block mb-2 text-sm font-medium text-gray-900">
                                    Kurs Süresi</label>
                                <input type="text" name="course_time" id="course_time" value="{{ old('course_time') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Kurs süresi girin">
                                <div class="text-red-500 text-xs mt-2">
                                    @error('course_time')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="rounded-lg mb-4">
            <div class="w-full">
                <div class="w-full bg-white rounded-lg border border-gray-200">
                    <div class="flex items-start justify-between rounded-t border-b border-gray-200 p-5 py-5 px-5">
                        <h3 class="text-md font-semibold text-gray-900 ">
                            Çalışma Saatleri
                        </h3>
                    </div>
                    <div class="py-10 px-5">

                        {{-- Saatler --}}
                        @php
                            $days = [
                                'Pazartesi' => 'Pazartesi',
                                'Salı' => 'Salı',
                                'Çarşamba' => 'Çarşamba',
                                'Perşembe' => 'Perşembe',
                                'Cuma' => 'Cuma',
                                'Cumartesi' => 'Cumartesi',
                                'Pazar' => 'Pazar',
                            ];
                        @endphp

                        @foreach ($days as $key => $label)
                            <div class="mb-6 w-1/2">
                                <div class="flex items-center justify-between gap-4">

                                    <!-- Checkbox -->
                                    <div class="flex items-center w-2xs">
                                        <input id="{{ $key }}" name="day_data[{{ $key }}][day]"
                                            type="checkbox" value="{{ $key }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500"
                                            {{ old("day_data.$key.day") ? 'checked' : '' }}>
                                        <label for="{{ $key }}"
                                            class="ms-2 text-sm font-medium text-gray-900">{{ $label }}</label>
                                    </div>

                                    <!-- Start Time -->
                                    <div class="w-full">
                                        <div class="relative">
                                            <select name="day_data[{{ $key }}][start_time]"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="" disabled selected>00:00</option>
                                                @foreach ($times as $value)
                                                    @php $shortTime = substr($value, 0, 5); @endphp
                                                    <option value="{{ $value }}"
                                                        {{ old("day_data.$key.start_time") == $value ? 'selected' : '' }}>
                                                        {{ $shortTime }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- End Time -->
                                    <div class="w-full">
                                        <div class="relative">
                                            <select name="day_data[{{ $key }}][end_time]"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="" disabled selected>00:00</option>
                                                @foreach ($times as $value)
                                                    @php $shortTime = substr($value, 0, 5); @endphp
                                                    <option value="{{ $value }}"
                                                        {{ old("day_data.$key.end_time") == $value ? 'selected' : '' }}>
                                                        {{ $shortTime }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        {{-- Saatler --}}

                    </div>
                </div>
            </div>
        </div>


        <div class="">
            <button
                class="block cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Kaydet</button>
        </div>
    </form>
@endsection
