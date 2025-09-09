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
            <form class="lg:w-1/2 w-full" action="{{ route('class.update', $lessonClass->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
                {{-- Sınıf Adı --}}
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                        Sınıf Adı</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $lessonClass->name) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full p-2.5"
                        placeholder="Sınıf adı girin">
                </div>

                {{-- Günü --}}
                <div class="mb-6">
                    <label for="day" class="block mb-2 text-sm font-medium text-gray-900">
                        Günü</label>
                    <select id="day" name="day"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full p-2.5">
                        @foreach ($days as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('day', $lessonClass->day) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Saati --}}
                <div class="mb-6">
                    <label for="time" class="block mb-2 text-sm font-medium text-gray-900">
                        Saati</label>
                    <select id="time" name="time"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full p-2.5">
                        @foreach ($times as $value)
                            <option value="{{ $value }}"
                                {{ old('time', $lessonClass->time) == $value ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Ücreti --}}
                <div class="mb-6">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900">
                        Ücreti</label>
                    <input type="number" step="0.01" name="price" id="price"
                        value="{{ old('price', $lessonClass->price) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full p-2.5"
                        placeholder="Ücret girin">
                </div>

                {{-- Kontenjan --}}
                <div class="mb-6">
                    <label for="quota" class="block mb-2 text-sm font-medium text-gray-900">
                        Kontenjan</label>
                    <input type="number" name="quota" id="quota" value="{{ old('quota', $lessonClass->quota) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full p-2.5"
                        placeholder="Kontenjan girin">
                </div>

                {{-- Öğretmen Adı --}}
                <div class="mb-6">
                    <label for="teacher_name" class="block mb-2 text-sm font-medium text-gray-900">
                        Öğretmen Adı</label>
                    <input type="text" name="teacher_name" id="teacher_name"
                        value="{{ old('teacher_name', $lessonClass->teacher_name) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full p-2.5"
                        placeholder="Öğretmen adı girin">
                </div>


                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection
