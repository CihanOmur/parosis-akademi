@extends('front.layouts.app')

@section('title', ($globalSettings['seo']['meta_title'] ?? 'Parosis Akademi') . ' | ' . __('member.account'))

@php
    $infoErrors = $errors->getBag('accountInfo');
    $passwordErrors = $errors->getBag('accountPassword');
    $inputClass = 'w-full rounded border px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue';
    $border = fn ($bag, $field) => $bag->has($field) ? 'border-colorJasper' : 'border-[#D7D7D7]';
    $cardClass = 'rounded-lg bg-white p-6 shadow-[0_4px_30px_16px] shadow-[#070229]/5 lg:p-8';
    // Durum rozetleri (sınıflar burada — front.css yalnız front Blade'lerini tarar)
    $orderBadge = [
        'pending'    => 'bg-yellow-100 text-yellow-800',
        'processing' => 'bg-blue-100 text-blue-800',
        'shipped'    => 'bg-purple-100 text-purple-800',
        'delivered'  => 'bg-green-100 text-green-800',
        'cancelled'  => 'bg-red-100 text-red-800',
    ];
    $applicationBadge = [
        'pending'   => 'bg-yellow-100 text-yellow-800',
        'contacted' => 'bg-green-100 text-green-800',
    ];
    $locale = app()->getLocale();
@endphp

@section('content')
    @include('front.partials.member-breadcrumb', ['title' => __('member.account'), 'current' => __('member.account')])

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
                                <h2 class="text-2xl lg:text-3xl">{{ __('member.hello', ['name' => $member->name]) }}</h2>
                                <p class="mt-2 text-sm">{{ __('member.member_since', ['date' => $member->created_at->format('d.m.Y')]) }}</p>
                            </div>
                            <form action="{{ route('front.member.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="inline-flex h-11 items-center rounded-full border border-colorBlackPearl/15 px-6 text-sm font-semibold text-colorBlackPearl hover:bg-colorBlackPearl/5">
                                    {{ __('member.logout') }}
                                </button>
                            </form>
                        </div>

                        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                            {{-- Bilgilerim --}}
                            <div class="rounded-lg bg-white p-6 shadow-[0_4px_30px_16px] shadow-[#070229]/5 lg:p-8">
                                <h3 class="mb-6 text-xl">{{ __('member.my_info') }}</h3>
                                <form action="{{ route('front.account.update') }}" method="post" class="grid grid-cols-1 gap-y-[22px]">
                                    @csrf
                                    @if($infoErrors->any())
                                        <div class="rounded bg-colorJasper/10 px-4 py-3 text-sm text-colorJasper">
                                            @foreach($infoErrors->all() as $error)<p>{{ $error }}</p>@endforeach
                                        </div>
                                    @endif
                                    <label class="grid gap-2 text-sm">
                                        <span>{{ __('member.name') }}</span>
                                        <input type="text" name="name" value="{{ old('name', $member->name) }}" required maxlength="150" autocomplete="name"
                                               class="{{ $inputClass }} {{ $border($infoErrors, 'name') }}" />
                                    </label>
                                    <label class="grid gap-2 text-sm">
                                        <span>{{ __('member.email') }}</span>
                                        <input type="email" name="email" value="{{ old('email', $member->email) }}" required maxlength="190" autocomplete="email"
                                               class="{{ $inputClass }} {{ $border($infoErrors, 'email') }}" />
                                    </label>
                                    <label class="grid gap-2 text-sm">
                                        <span>{{ __('member.phone') }}</span>
                                        <input type="tel" name="phone" value="{{ old('phone', $member->phone) }}" required maxlength="30" inputmode="tel" autocomplete="tel"
                                               class="{{ $inputClass }} {{ $border($infoErrors, 'phone') }}" />
                                    </label>
                                    <div>
                                        <button type="submit" class="btn btn-primary">{{ __('member.save') }}</button>
                                    </div>
                                </form>
                            </div>

                            {{-- Şifre değiştir --}}
                            <div class="rounded-lg bg-white p-6 shadow-[0_4px_30px_16px] shadow-[#070229]/5 lg:p-8">
                                <h3 class="mb-6 text-xl">{{ __('member.change_password') }}</h3>
                                <form action="{{ route('front.account.password') }}" method="post" class="grid grid-cols-1 gap-y-[22px]">
                                    @csrf
                                    @if($passwordErrors->any())
                                        <div class="rounded bg-colorJasper/10 px-4 py-3 text-sm text-colorJasper">
                                            @foreach($passwordErrors->all() as $error)<p>{{ $error }}</p>@endforeach
                                        </div>
                                    @endif
                                    <label class="grid gap-2 text-sm">
                                        <span>{{ __('member.current_password') }}</span>
                                        <input type="password" name="current_password" required maxlength="255" autocomplete="current-password"
                                               class="{{ $inputClass }} {{ $border($passwordErrors, 'current_password') }}" />
                                    </label>
                                    <label class="grid gap-2 text-sm">
                                        <span>{{ __('member.new_password') }}</span>
                                        <input type="password" name="password" required minlength="8" maxlength="255" autocomplete="new-password"
                                               class="{{ $inputClass }} {{ $border($passwordErrors, 'password') }}" />
                                    </label>
                                    <label class="grid gap-2 text-sm">
                                        <span>{{ __('member.new_password_confirm') }}</span>
                                        <input type="password" name="password_confirmation" required minlength="8" maxlength="255" autocomplete="new-password"
                                               class="{{ $inputClass }} {{ $border($passwordErrors, 'password') }}" />
                                    </label>
                                    <div>
                                        <button type="submit" class="btn btn-primary">{{ __('member.change_password_button') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Siparişlerim (yalnız üyeyken verilenler, son 20) --}}
                        <div id="siparislerim" class="mt-8 {{ $cardClass }}">
                            <h3 class="mb-6 text-xl">{{ __('member.my_orders') }}</h3>
                            @if($orders->isEmpty())
                                <p class="text-sm">{{ __('member.no_orders') }}</p>
                            @else
                                <div class="hidden grid-cols-[minmax(0,1.6fr)_1fr_1fr_1fr] gap-4 border-b border-[#EAEAEA] pb-3 text-sm font-medium text-colorBlackPearl sm:grid">
                                    <span>{{ __('member.order_number') }}</span>
                                    <span>{{ __('member.date') }}</span>
                                    <span>{{ __('member.total') }}</span>
                                    <span>{{ __('member.status') }}</span>
                                </div>
                                <ul class="divide-y divide-[#EAEAEA]">
                                    @foreach($orders as $order)
                                        <li>
                                            <a href="{{ route('front.account.order', ['orderNumber' => $order->order_number]) }}"
                                               class="member-order-row grid grid-cols-2 items-center gap-x-4 gap-y-2 py-4 text-sm transition-colors hover:text-colorPurpleBlue sm:grid-cols-[minmax(0,1.6fr)_1fr_1fr_1fr]">
                                                <span class="col-span-2 break-all font-semibold text-colorBlackPearl sm:col-span-1">{{ $order->order_number }}</span>
                                                <span>{{ $order->created_at->format('d.m.Y') }}</span>
                                                <span class="text-right font-semibold text-colorBlackPearl sm:text-left">{{ number_format($order->total, 2, ',', '.') }} ₺</span>
                                                <span class="col-span-2 sm:col-span-1">
                                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $orderBadge[$order->status] ?? 'bg-gray-100 text-gray-800' }}">{{ __('member.order_status.' . $order->status) }}</span>
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        {{-- Başvurularım (yalnız üyeyken yapılan kurs başvuruları, son 20) --}}
                        <div id="basvurularim" class="mt-8 {{ $cardClass }}">
                            <h3 class="mb-6 text-xl">{{ __('member.my_applications') }}</h3>
                            @if($applications->isEmpty())
                                <p class="text-sm">{{ __('member.no_applications') }}</p>
                            @else
                                <div class="hidden grid-cols-[minmax(0,1.6fr)_1fr_1fr_1fr] gap-4 border-b border-[#EAEAEA] pb-3 text-sm font-medium text-colorBlackPearl sm:grid">
                                    <span>{{ __('member.course') }}</span>
                                    <span>{{ __('member.student') }}</span>
                                    <span>{{ __('member.date') }}</span>
                                    <span>{{ __('member.status') }}</span>
                                </div>
                                <ul class="divide-y divide-[#EAEAEA]">
                                    @foreach($applications as $application)
                                        <li class="member-application-row grid grid-cols-2 items-center gap-x-4 gap-y-2 py-4 text-sm sm:grid-cols-[minmax(0,1.6fr)_1fr_1fr_1fr]">
                                            <span class="col-span-2 break-words font-semibold text-colorBlackPearl sm:col-span-1">{{ $application->course?->getTranslation('title', $locale) ?: '—' }}</span>
                                            <span class="break-words">{{ $application->student_name }}</span>
                                            <span class="text-right sm:text-left">{{ $application->created_at->format('d.m.Y') }}</span>
                                            <span class="col-span-2 sm:col-span-1">
                                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $applicationBadge[$application->status] ?? 'bg-gray-100 text-gray-800' }}">{{ __('member.application_status.' . $application->status) }}</span>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
