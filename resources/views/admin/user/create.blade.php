@extends('admin.layouts.app')
@section('page-banner')
    <h1 class="text-2xl font-semibold text-gray-800">
        @yield('page-title', 'Kullanıcı Ekle' . (isset($selectedLanguage) && $selectedLanguage ? ' - ' . $selectedLanguage : ''))
    </h1>
@endsection

@section('content')
    <div class="rounded-lg mb-4">

        <div class="w-full bg-white py-10 px-8 rounded-lg border border-gray-200">
            <form class="lg:w-1/2 w-full" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lang" value="{{ request()->lang ?? app()->getLocale() }}">
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Ad/Soyad</label>
                    <input type="text" name="name" id="name" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Başlık girin">
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="email" name="email" id="email" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Email girin">
                </div>
                <div class="mb-6">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Telefon</label>
                    <input type="tel" name="phone" pattern="[0-9]*" inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="phone"
                        aria-describedby="helper-text-explanation" maxlength="13"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Telefon girin">
                </div>

                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Şifre</label>
                    <input type="password" name="password" id="password" aria-describedby="helper-text-explanation"
                        maxlength="13"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="Şifre girin">
                </div>
                <div class="mb-6">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 ">Rol
                        Seçiniz</label>
                    <select id="role" name="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection
