@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800">
        @yield('page-title', 'Sınıf Düzenle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
    <div class="flex items-center gap-2">
        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Yeni
            Ekle</a>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('tomselect.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection
@section('content')
    <div class="rounded-lg mb-4">

        <div class="w-full bg-white py-10 px-8 border border-gray-100 rounded-lg">
            <form class=" w-full" action="{{ route('class.update', $lessonClass->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">

                <div class="flex w-full gap-4">
                    {{-- Sınıf Adı --}}
                    <div class="mb-6 w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                            Sınıf Adı</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $lessonClass->name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Sınıf adı girin">
                    </div>

                    {{-- Günü --}}
                    <div class="mb-6 w-full">
                        <label for="day" class="block mb-2 text-sm font-medium text-gray-900">
                            Günü</label>
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
                    </div>

                </div>
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
                        </div>
                    </div>

                    {{-- Ücreti --}}
                    <div class="mb-6 w-full">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">
                            Ücreti</label>
                        <input type="number" step="0.01" name="price" id="price"
                            value="{{ old('price', $lessonClass->price) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Ücret girin">
                    </div>

                </div>


                <div class="flex w-full gap-4">
                    {{-- Kontenjan --}}
                    <div class="mb-6 w-full">
                        <label for="quota" class="block mb-2 text-sm font-medium text-gray-900">
                            Kontenjan</label>
                        <input type="number" name="quota" id="quota" value="{{ old('quota', $lessonClass->quota) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Kontenjan girin">
                    </div>

                    {{-- Öğretmen Adı --}}

                    <div class="mb-6 w-full">
                        <label for="teacher_id" class="block mb-2 text-sm font-medium text-gray-900">
                            Öğretmen</label>
                        <select id="teacher_id" name="teacher_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ $lessonClass->teacher_id == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="flex flex-col lg:flex-row lg:items-center w-full gap-x-4">
                    <div class="flex w-full gap-4">
                        {{--  Kurs Başlangıç Tarihi --}}
                        <div class="mb-6 w-full">
                            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">
                                Kurs Başlangıç Tarihi</label>
                            <input type="date" name="start_date" id="start_date" value="{{ $lessonClass->start_date }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>

                        {{--  Kurs Bitiş Tarihi --}}
                        <div class="mb-6 w-full">
                            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">
                                Kurs Bitiş Tarihi</label>
                            <input type="date" name="end_date" id="end_date" value="{{ $lessonClass->end_date }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>

                    <div class="flex w-full gap-4">
                        {{--  Kurs Süresi --}}
                        <div class="mb-6 w-full">
                            <label for="course_time" class="block mb-2 text-sm font-medium text-gray-900">
                                Kurs Süresi</label>
                            <input type="text" name="course_time" id="course_time"
                                value="{{ $lessonClass->course_time }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Kurs süresi girin">
                        </div>
                    </div>
                </div>

                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>

    </div>

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
