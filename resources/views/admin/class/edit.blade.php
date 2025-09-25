@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800">
        @yield('page-title', 'Sınıf Düzenle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <div class="block cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        <a href="{{ route('class.create') }}">Yeni
            Ekle</a>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('tomselect.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection
@section('content')
<form class=" w-full" action="{{ route('class.update', $lessonClass->id) }}" method="POST"
                enctype="multipart/form-data">
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
                        <input type="text" name="name" id="name" value="{{ old('name', $lessonClass->name) }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                            placeholder="Sınıf adı girin">
                        <div class="text-red-500 text-xs mt-2">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    {{-- Günü --}}
                    <div class="mb-0 w-full">
                        <label for="day" class="block mb-2 text-sm font-medium text-gray-900">
                            Ders Günleri</label>
                        <select id="day" name="day[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @php
                                $selectedDays = explode(',', $lessonClass->day); // veritabanındaki string'i array yap
                            @endphp
                            @foreach ($days as $key => $label)
                                <option value="{{ $key }}" {{ in_array($key, $selectedDays) ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <div class="text-red-500 text-xs mt-2">
                            @error('day')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                </div>
                <div class="py-0 px-5">
                <div class="flex flex-col lg:flex-row lg:items-center w-full gap-x-4">
                    <div class="flex w-full gap-4">
                        {{-- Saati --}}
                        <div class="mb-6 w-full">
                            <label for="time" class="block mb-2 text-sm font-medium text-gray-900">
                                Başlangıç Saati</label>
                            <select id="time" name="time"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($times as $value)
                                    @php
                                        $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                    @endphp
                                    <option value="{{ $value }}"
                                        {{ $lessonClass->time == $value ? 'selected' : '' }}>
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
                                @foreach ($times as $value)
                                    @php
                                        $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                    @endphp
                                    <option value="{{ $value }}"
                                        {{ $lessonClass->end_time == $value ? 'selected' : '' }}>
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

                        {{-- Ücret --}}
                        <div class="mb-6 w-full">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900">
                                Ücret</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $lessonClass->price) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Ücret girin">
                            <div class="text-red-500 text-xs mt-2">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                    <div class="py-0 px-5">
                    <div class="flex w-full gap-4">
                        {{-- Kontenjan --}}
                        <div class="mb-0 w-full">
                            <label for="quota" class="block mb-2 text-sm font-medium text-gray-900">
                                Kontenjan</label>
                            <input type="number" name="quota" id="quota" value="{{ old('quota', $lessonClass->quota) }}"
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
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ $lessonClass->teacher_id == $teacher->id ? 'selected' : '' }}>
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
                                <input type="date" name="start_date" id="start_date" value="{{ $lessonClass->start_date }}"
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
                                <input type="date" name="end_date" id="end_date" value="{{ $lessonClass->end_date }}"
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
                                <input type="text" name="course_time" id="course_time"
                                    value="{{ $lessonClass->course_time }}"
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

                    {{--Saatler--}}
                          <div class="mb-6 w-1/2">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center w-2xs">
                                <input checked id="pazartesi" name="days" type="checkbox" value="pazartesi" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 ">
                                <label for="pazartesi" class="ms-2 text-sm font-medium text-gray-900">Pazartesi</label>
                                </div>
                                <div class="w-full">
                                <div class="relative">
                                    <select id="end_time" name="end_time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="" disabled selected>00:00</option>
                                        @foreach ($times as $value)
                                            @php
                                                $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                            @endphp
                                            <option value="{{ $value }}"
                                                {{ old('start_time') == $value ? 'selected' : '' }}>
                                                {{ $shortTime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="w-full">
                                <div class="relative">
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
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="mb-6 w-1/2">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center w-2xs">
                                <input id="sali" name="days" type="checkbox" value="sali" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 ">
                                <label for="sali" class="ms-2 text-sm font-medium text-gray-900">Salı</label>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
                                    <select id="end_time" name="end_time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="" disabled selected>00:00</option>
                                        @foreach ($times as $value)
                                            @php
                                                $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                            @endphp
                                            <option value="{{ $value }}"
                                                {{ old('start_time') == $value ? 'selected' : '' }}>
                                                {{ $shortTime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
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
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="mb-6 w-1/2">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center w-2xs">
                                <input id="carsamba" name="days" type="checkbox" value="carsamba" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 ">
                                <label for="carsamba" class="ms-2 text-sm font-medium text-gray-900">Çarşamba</label>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
                                    <select id="end_time" name="end_time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="" disabled selected>00:00</option>
                                        @foreach ($times as $value)
                                            @php
                                                $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                            @endphp
                                            <option value="{{ $value }}"
                                                {{ old('start_time') == $value ? 'selected' : '' }}>
                                                {{ $shortTime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
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
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="mb-6 w-1/2">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center w-2xs">
                                <input checked id="persembe" name="days" type="checkbox" value="persembe" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 ">
                                <label for="persembe" class="ms-2 text-sm font-medium text-gray-900">Perşembe</label>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
                                    <select id="end_time" name="end_time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="" disabled selected>00:00</option>
                                        @foreach ($times as $value)
                                            @php
                                                $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                            @endphp
                                            <option value="{{ $value }}"
                                                {{ old('start_time') == $value ? 'selected' : '' }}>
                                                {{ $shortTime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
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
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="mb-6 w-1/2">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center w-2xs">
                                <input id="cuma" name="days" type="checkbox" value="cuma" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 ">
                                <label for="cuma" class="ms-2 text-sm font-medium text-gray-900">Cuma</label>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
                                    <select id="end_time" name="end_time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="" disabled selected>00:00</option>
                                        @foreach ($times as $value)
                                            @php
                                                $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                            @endphp
                                            <option value="{{ $value }}"
                                                {{ old('start_time') == $value ? 'selected' : '' }}>
                                                {{ $shortTime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
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
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="mb-6 w-1/2">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center w-2xs">
                                <input id="cumartesi" name="days" type="checkbox" value="cumartesi" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 ">
                                <label for="cumartesi" class="ms-2 text-sm font-medium text-gray-900">Cumartesi</label>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
                                    <select id="end_time" name="end_time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="" disabled selected>00:00</option>
                                        @foreach ($times as $value)
                                            @php
                                                $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                            @endphp
                                            <option value="{{ $value }}"
                                                {{ old('start_time') == $value ? 'selected' : '' }}>
                                                {{ $shortTime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
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
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="mb-6 w-1/2">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center w-2xs">
                                <input id="pazar" name="days" type="checkbox" value="pazar" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 ">
                                <label for="pazar" class="ms-2 text-sm font-medium text-gray-900">Pazar</label>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
                                    <select id="end_time" name="end_time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="" disabled selected>00:00</option>
                                        @foreach ($times as $value)
                                            @php
                                                $shortTime = substr($value, 0, 5); // 00:00:00 -> 00:00
                                            @endphp
                                            <option value="{{ $value }}"
                                                {{ old('start_time') == $value ? 'selected' : '' }}>
                                                {{ $shortTime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="w-full ">
                                <div class="relative">
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
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    {{--Saatler--}}
                                
                    </div>
            </div>    
        </div>
    </div>
    <div class="">
                    <button class="block cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Kaydet</button>
                </div>
            </form>
    <script>
        new TomSelect('#day', {
            create: false,
            highlight: true,
            persist: false,
            openOnFocus: true,
            allowEmptyOption: false,
            placeholder: 'Eğitim günü seçin...',
            hidePlaceholder: true,
            maxItems: 4
        });
    </script>
    <script>
        new TomSelect('#teacher_id', {
            create: false,
            highlight: true,
            persist: false,
            openOnFocus: true,
            allowEmptyOption: false,
            placeholder: 'Öğretmen seçin...',
            hidePlaceholder: true,
        });
    </script>
@endsection
