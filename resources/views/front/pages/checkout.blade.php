@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Sipariş Oluştur')

@section('content')
            <!--...::: Breadcrumb Section Start :::... -->
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden bg-[#FAF9F6]">
                    <!-- Section Space -->
                    <div class="py-[60px] lg:py-[90px]">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="text-center">
                                <h1 class="mb-5 text-4xl capitalize tracking-normal">
                                    Sipariş Oluştur
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">ANA SAYFA</a>
                                        </li>
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.cart') }}">SEPETİM</a>
                                        </li>
                                        <li>SİPARİŞ</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Background Element -->
                    <div class="absolute -left-48 top-0 -z-10 h-[327px] w-[371px] bg-[#BFC06F] blur-[250px]"></div>
                    <div class="absolute -right-36 bottom-20 -z-10 h-[327px] w-[371px] bg-[#AAC3E9] blur-[200px]"></div>
                    <img src="{{ asset('assets-front/img/abstracts/abstract-purple-dash-1.svg') }}" alt="abstract-purple-dash-1" class="absolute left-56 top-1/2 -z-10 hidden -translate-y-1/2 sm:inline-block" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" class="absolute -bottom-14 right-[100px] -z-10 hidden sm:inline-block" />
                    <!-- Background Element -->
                </div>
            </section>
            <!--...::: Breadcrumb Section End :::... -->

            <!--...::: Checkout Section Start :::... -->
            <section class="section-checkout">
                <div class="bg-white pb-64">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">

                            @if(session('success'))
                            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-6 py-4 text-green-800">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-6 py-4 text-red-800">
                                <p class="mb-2 font-semibold">Lütfen aşağıdaki hataları düzeltin:</p>
                                <ul class="list-inside list-disc space-y-1 text-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- Checkout Area -->
                            <form action="{{ route('front.checkout.process') }}" method="POST">
                                @csrf

                                <div class="grid grid-cols-1 gap-10 lg:grid-cols-[1fr_1.6fr] lg:items-start lg:gap-16">

                                    <!-- Left: Order Summary -->
                                    <div>
                                        <h4 class="mb-6 font-title font-bold text-colorBlackPearl">Sipariş Özeti</h4>

                                        <!-- Cart Items List -->
                                        <div class="divide-y divide-colorBlackPearl/10 rounded-lg border border-colorBlackPearl/15">
                                            @foreach($cart as $key => $item)
                                            <div class="flex items-start gap-4 px-5 py-4">
                                                <!-- Thumbnail -->
                                                @if(!empty($item['image']))
                                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" width="64" height="50" class="h-12 w-16 rounded-lg object-cover flex-shrink-0" />
                                                @else
                                                    <div class="h-12 w-16 flex-shrink-0 rounded-lg bg-gray-100 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <!-- Item Details -->
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-semibold text-colorBlackPearl leading-snug">{{ $item['name'] }}</p>
                                                    @if(!empty($item['variant_info']))
                                                        <p class="mt-0.5 text-sm text-colorCarbonGrey">{{ $item['variant_info'] }}</p>
                                                    @endif
                                                    <p class="mt-1 text-sm text-colorCarbonGrey">{{ $item['quantity'] }} adet &times; {{ number_format($item['price'], 2, ',', '.') }} ₺</p>
                                                </div>
                                                <!-- Line Total -->
                                                <span class="flex-shrink-0 font-semibold text-colorPurpleBlue">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} ₺</span>
                                            </div>
                                            @endforeach
                                        </div>
                                        <!-- Cart Items List -->

                                        <!-- Order Total -->
                                        <div class="mt-4 flex items-center justify-between rounded-lg border border-colorBlackPearl/15 px-5 py-4">
                                            <span class="font-bold text-colorBlackPearl">Toplam</span>
                                            <span class="font-title text-xl font-bold text-colorPurpleBlue">{{ number_format($subtotal, 2, ',', '.') }} ₺</span>
                                        </div>
                                        <!-- Order Total -->
                                    </div>
                                    <!-- Left: Order Summary -->

                                    <!-- Right: Customer Form -->
                                    <div>
                                        <h4 class="mb-6 font-title font-bold text-colorBlackPearl">Teslimat Bilgileri</h4>

                                        <div class="space-y-7">
                                            <!-- Customer Name -->
                                            <div>
                                                <label class="mb-1.5 block text-sm font-medium text-colorBlackPearl" for="customer_name">
                                                    Ad Soyad <span class="text-colorJasper">*</span>
                                                </label>
                                                <input type="text"
                                                       id="customer_name"
                                                       name="customer_name"
                                                       value="{{ old('customer_name') }}"
                                                       required
                                                       class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl @error('customer_name') border-red-400 @enderror"
                                                       placeholder="Adınızı ve soyadınızı girin" />
                                                @error('customer_name')
                                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Email & Phone Row -->
                                            <div class="grid grid-cols-1 gap-7 sm:grid-cols-2">
                                                <!-- Email -->
                                                <div>
                                                    <label class="mb-1.5 block text-sm font-medium text-colorBlackPearl" for="customer_email">
                                                        E-posta <span class="text-colorJasper">*</span>
                                                    </label>
                                                    <input type="email"
                                                           id="customer_email"
                                                           name="customer_email"
                                                           value="{{ old('customer_email') }}"
                                                           required
                                                           class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl @error('customer_email') border-red-400 @enderror"
                                                           placeholder="ornek@mail.com" />
                                                    @error('customer_email')
                                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- Phone -->
                                                <div>
                                                    <label class="mb-1.5 block text-sm font-medium text-colorBlackPearl" for="customer_phone">
                                                        Telefon
                                                    </label>
                                                    <input type="tel"
                                                           id="customer_phone"
                                                           name="customer_phone"
                                                           value="{{ old('customer_phone') }}"
                                                           class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl @error('customer_phone') border-red-400 @enderror"
                                                           placeholder="05XX XXX XX XX" />
                                                    @error('customer_phone')
                                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Shipping Address -->
                                            <div>
                                                <label class="mb-1.5 block text-sm font-medium text-colorBlackPearl" for="shipping_address">
                                                    Teslimat Adresi <span class="text-colorJasper">*</span>
                                                </label>
                                                <textarea id="shipping_address"
                                                          name="shipping_address"
                                                          rows="3"
                                                          required
                                                          class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl @error('shipping_address') border-red-400 @enderror"
                                                          placeholder="Mahalle, cadde, sokak, bina no, daire no">{{ old('shipping_address') }}</textarea>
                                                @error('shipping_address')
                                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- City & District Row -->
                                            <div class="grid grid-cols-1 gap-7 sm:grid-cols-2">
                                                <!-- City -->
                                                <div>
                                                    <label class="mb-1.5 block text-sm font-medium text-colorBlackPearl" for="shipping_city">
                                                        Şehir <span class="text-colorJasper">*</span>
                                                    </label>
                                                    <input type="text"
                                                           id="shipping_city"
                                                           name="shipping_city"
                                                           value="{{ old('shipping_city') }}"
                                                           required
                                                           class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl @error('shipping_city') border-red-400 @enderror"
                                                           placeholder="İstanbul" />
                                                    @error('shipping_city')
                                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- District -->
                                                <div>
                                                    <label class="mb-1.5 block text-sm font-medium text-colorBlackPearl" for="shipping_district">
                                                        İlçe
                                                    </label>
                                                    <input type="text"
                                                           id="shipping_district"
                                                           name="shipping_district"
                                                           value="{{ old('shipping_district') }}"
                                                           class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl @error('shipping_district') border-red-400 @enderror"
                                                           placeholder="Kadıköy" />
                                                    @error('shipping_district')
                                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Customer Note -->
                                            <div>
                                                <label class="mb-1.5 block text-sm font-medium text-colorBlackPearl" for="customer_note">
                                                    Sipariş Notu
                                                </label>
                                                <textarea id="customer_note"
                                                          name="customer_note"
                                                          rows="3"
                                                          class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl @error('customer_note') border-red-400 @enderror"
                                                          placeholder="Siparişinizle ilgili eklemek istediğiniz not (isteğe bağlı)">{{ old('customer_note') }}</textarea>
                                                @error('customer_note')
                                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="pt-2">
                                                <button type="submit" class="btn btn-primary is-icon group w-full justify-center">
                                                    Siparişi Tamamla
                                                    <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                    </span>
                                                    <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                    </span>
                                                </button>
                                            </div>
                                            <!-- Submit Button -->
                                        </div>
                                    </div>
                                    <!-- Right: Customer Form -->

                                </div>
                            </form>
                            <!-- Checkout Area -->

                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Checkout Section End :::... -->

@endsection
