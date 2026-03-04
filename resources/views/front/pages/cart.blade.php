@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Sepetim')

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
                                    Sepetim
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">ANA SAYFA</a>
                                        </li>
                                        <li>SEPETİM</li>
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

            <!--...::: Cart Section Start :::... -->
            <section class="section-cart">
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

                            @if(session('error'))
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-6 py-4 text-red-800">
                                {{ session('error') }}
                            </div>
                            @endif

                            @if(empty($cart))
                            <!-- Empty Cart State -->
                            <div class="flex flex-col items-center justify-center py-24 text-center">
                                <svg class="mb-6 h-24 w-24 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                <h3 class="mb-3 font-title text-2xl font-bold text-colorBlackPearl">Sepetiniz boş</h3>
                                <p class="mb-8 text-colorCarbonGrey">Henüz sepetinize ürün eklemediniz.</p>
                                <a href="{{ route('front.products') }}" class="btn btn-primary is-icon group">
                                    Ürünlere Göz At
                                    <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                    </span>
                                    <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                    </span>
                                </a>
                            </div>
                            <!-- Empty Cart State -->
                            @else
                            <!-- Cart Table -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full overflow-scroll border border-[#f8f8f8] text-left">
                                    <thead class="border-b border-[#f8f8f8]">
                                        <tr class="text-colorBlackPearl">
                                            <th class="px-8 py-5">Ürün</th>
                                            <th class="px-8 py-5">Birim Fiyat</th>
                                            <th class="px-8 py-5">Miktar</th>
                                            <th class="px-8 py-5">Toplam</th>
                                            <th class="px-8 py-5"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-[#f8f8f8]">
                                        @foreach($cart as $key => $item)
                                        <tr>
                                            <!-- Product Name + Image -->
                                            <td class="px-8 py-5">
                                                <div class="flex min-w-60 items-center gap-x-4">
                                                    @if(!empty($item['image']))
                                                        <img src="{{ asset($item['image']) }}" alt="{{ e($item['name']) }}" width="87" height="65" class="h-16 w-[87px] rounded-lg object-cover" />
                                                    @else
                                                        <div class="h-16 w-[87px] rounded-lg bg-gray-100 flex items-center justify-center">
                                                            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <a href="{{ route('front.product.details', $item['product_id']) }}" class="block font-bold text-colorBlackPearl hover:text-colorPurpleBlue">{{ e($item['name']) }}</a>
                                                        @if(!empty($item['variant_info']))
                                                            <span class="mt-1 block text-sm text-colorCarbonGrey">{{ e($item['variant_info']) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Unit Price -->
                                            <td class="px-8 py-5 text-colorBlackPearl">{{ number_format($item['price'], 2, ',', '.') }} ₺</td>
                                            <!-- Quantity Update Form -->
                                            <td class="px-8 py-5">
                                                <form action="{{ route('front.cart.update') }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    <input type="hidden" name="key" value="{{ e($key) }}" />
                                                    <div class="flex min-w-32 items-center justify-between gap-x-3 rounded-[50px] bg-[#FAF9F6] px-4 py-2 text-lg font-medium text-colorBlackPearl">
                                                        <button type="button" class="text-xl leading-none" onclick="changeCartQty(this, -1)">-</button>
                                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                               class="w-10 bg-transparent text-center outline-none text-base"
                                                               onchange="this.form.submit()" />
                                                        <button type="button" class="text-xl leading-none" onclick="changeCartQty(this, 1)">+</button>
                                                    </div>
                                                </form>
                                            </td>
                                            <!-- Row Total -->
                                            <td class="px-8 py-5 font-semibold text-colorPurpleBlue">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} ₺</td>
                                            <!-- Remove Button -->
                                            <td class="px-8 py-5">
                                                <form action="{{ route('front.cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="key" value="{{ e($key) }}" />
                                                    <button type="submit" class="text-2xl font-normal text-colorJasper hover:text-red-700 transition-colors" title="Kaldır">
                                                        &times;
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Table -->

                            <!-- Cart Summary -->
                            <div class="mt-10 flex justify-end">
                                <div class="w-full max-w-sm">
                                    <h4 class="mb-4 font-title font-bold text-colorBlackPearl">Sipariş Özeti</h4>
                                    <table class="w-full table-auto rounded-lg border border-colorBlackPearl/25">
                                        <tbody class="divide-y divide-colorBlackPearl/25">
                                            <tr class="divide-x divide-colorBlackPearl/25">
                                                <td class="px-6 py-3 font-bold text-colorBlackPearl">Ara Toplam</td>
                                                <td class="px-6 py-3">{{ number_format($total, 2, ',', '.') }} ₺</td>
                                            </tr>
                                            <tr class="divide-x divide-colorBlackPearl/25">
                                                <td class="px-6 py-3 font-bold text-colorBlackPearl">Toplam</td>
                                                <td class="px-6 py-3 font-bold text-colorPurpleBlue">{{ number_format($total, 2, ',', '.') }} ₺</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('front.checkout') }}" class="btn btn-primary is-icon group mt-6 w-full justify-center">
                                        Ödemeye Geç
                                        <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                            <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                        </span>
                                        <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                            <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                        </span>
                                    </a>
                                    <a href="{{ route('front.products') }}" class="mt-3 block text-center text-sm text-colorCarbonGrey hover:text-colorPurpleBlue">
                                        Alışverişe Devam Et
                                    </a>
                                </div>
                            </div>
                            <!-- Cart Summary -->
                            @endif

                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Cart Section End :::... -->

@endsection

@push('scripts')
<script>
    function changeCartQty(btn, delta) {
        var container = btn.closest('div');
        var input = container.querySelector('input[name="quantity"]');
        if (!input) return;
        var val = parseInt(input.value) || 1;
        val = Math.max(1, val + delta);
        input.value = val;
        // Auto-submit the parent form
        var form = btn.closest('form');
        if (form) form.submit();
    }
</script>
@endpush
