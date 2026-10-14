@extends('front.layouts.app')

@section('title', ($globalSettings['seo']['meta_title'] ?? 'Parosis Akademi') . ' | Hesabım')

@php
    $infoErrors = $errors->getBag('accountInfo');
    $passwordErrors = $errors->getBag('accountPassword');
    $inputClass = 'w-full rounded border px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue';
    $border = fn ($bag, $field) => $bag->has($field) ? 'border-colorJasper' : 'border-[#D7D7D7]';
@endphp

@section('content')
    @include('front.partials.member-breadcrumb', ['title' => 'Hesabım', 'current' => 'HESABIM'])

    <section class="section-member">
        <div class="bg-white">
            <div class="section-space">
                <div class="container">
                    <div class="mx-auto max-w-[1000px]">

                        @if(session('account_status'))
                            <div class="mb-8 rounded-lg bg-green-50 px-5 py-4 text-sm text-green-700">{{ session('account_status') }}</div>
                        @endif

                        <div class="mb-10 flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <h2 class="text-2xl lg:text-3xl">Merhaba, {{ $member->name }}</h2>
                                <p class="mt-2 text-sm">Üyelik tarihi: {{ $member->created_at->format('d.m.Y') }}</p>
                            </div>
                            <form action="{{ route('front.member.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="inline-flex h-11 items-center rounded-full border border-colorBlackPearl/15 px-6 text-sm font-semibold text-colorBlackPearl hover:bg-colorBlackPearl/5">
                                    Çıkış Yap
                                </button>
                            </form>
                        </div>

                        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                            {{-- Bilgilerim --}}
                            <div class="rounded-lg bg-white p-6 shadow-[0_4px_30px_16px] shadow-[#070229]/5 lg:p-8">
                                <h3 class="mb-6 text-xl">Bilgilerim</h3>
                                <form action="{{ route('front.account.update') }}" method="post" class="grid grid-cols-1 gap-y-[22px]">
                                    @csrf
                                    @if($infoErrors->any())
                                        <div class="rounded bg-colorJasper/10 px-4 py-3 text-sm text-colorJasper">
                                            @foreach($infoErrors->all() as $error)<p>{{ $error }}</p>@endforeach
                                        </div>
                                    @endif
                                    <label class="grid gap-2 text-sm">
                                        <span>Ad soyad</span>
                                        <input type="text" name="name" value="{{ old('name', $member->name) }}" required maxlength="150" autocomplete="name"
                                               class="{{ $inputClass }} {{ $border($infoErrors, 'name') }}" />
                                    </label>
                                    <label class="grid gap-2 text-sm">
                                        <span>E-posta adresi</span>
                                        <input type="email" name="email" value="{{ old('email', $member->email) }}" required maxlength="190" autocomplete="email"
                                               class="{{ $inputClass }} {{ $border($infoErrors, 'email') }}" />
                                    </label>
                                    <label class="grid gap-2 text-sm">
                                        <span>Telefon</span>
                                        <input type="tel" name="phone" value="{{ old('phone', $member->phone) }}" required maxlength="30" inputmode="tel" autocomplete="tel"
                                               class="{{ $inputClass }} {{ $border($infoErrors, 'phone') }}" />
                                    </label>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Kaydet</button>
                                    </div>
                                </form>
                            </div>

                            {{-- Şifre değiştir --}}
                            <div class="rounded-lg bg-white p-6 shadow-[0_4px_30px_16px] shadow-[#070229]/5 lg:p-8">
                                <h3 class="mb-6 text-xl">Şifre Değiştir</h3>
                                <form action="{{ route('front.account.password') }}" method="post" class="grid grid-cols-1 gap-y-[22px]">
                                    @csrf
                                    @if($passwordErrors->any())
                                        <div class="rounded bg-colorJasper/10 px-4 py-3 text-sm text-colorJasper">
                                            @foreach($passwordErrors->all() as $error)<p>{{ $error }}</p>@endforeach
                                        </div>
                                    @endif
                                    <label class="grid gap-2 text-sm">
                                        <span>Mevcut şifre</span>
                                        <input type="password" name="current_password" required maxlength="255" autocomplete="current-password"
                                               class="{{ $inputClass }} {{ $border($passwordErrors, 'current_password') }}" />
                                    </label>
                                    <label class="grid gap-2 text-sm">
                                        <span>Yeni şifre (en az 8 karakter)</span>
                                        <input type="password" name="password" required minlength="8" maxlength="255" autocomplete="new-password"
                                               class="{{ $inputClass }} {{ $border($passwordErrors, 'password') }}" />
                                    </label>
                                    <label class="grid gap-2 text-sm">
                                        <span>Yeni şifre (tekrar)</span>
                                        <input type="password" name="password_confirmation" required minlength="8" maxlength="255" autocomplete="new-password"
                                               class="{{ $inputClass }} {{ $border($passwordErrors, 'password') }}" />
                                    </label>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Şifreyi Değiştir</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
