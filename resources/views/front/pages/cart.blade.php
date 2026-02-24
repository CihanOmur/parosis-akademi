@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Sepet')

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
                                    Checkout
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">HOME</a>
                                        </li>
                                        <li>Checkout</li>
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
            <!--...::: Breadcrumb Section Start :::... -->

            <!--...::: Cart Section Start :::... -->
            <section class="section-cart">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="overflow-x-auto">
                                <table class="min-w-full overflow-scroll border border-[#f8f8f8] px-8 py-5 text-left">
                                    <thead class="border-b border-[#f8f8f8]">
                                        <tr class="text-colorBlackPearl">
                                            <th class="px-8 py-5">Product Name</th>
                                            <th class="px-8 py-5">Price</th>
                                            <th class="px-8 py-5">Quantity</th>
                                            <th class="px-8 py-5">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-[#f8f8f8]">
                                        <tr>
                                            <td class="flex min-w-80 items-center gap-x-4 px-8 py-5 font-bold">
                                                <button class="text-2xl font-normal text-colorJasper">
                                                    &times;
                                                </button>
                                                <img src="{{ asset('assets-front/img/images/th-1/product-add-cart-thumb-1.jpg') }}" alt="product-add-cart-thumb-2" width="87" height="65" />
                                                <a href="{{ route('front.product.details') }}" class="hover:text-colorBlackPearl">53 book demo</a>
                                            </td>
                                            <td class="px-8 py-5">$20</td>
                                            <td class="max-w-40 px-8 py-5">
                                                <!-- Increment/Decrement Buttons Block -->
                                                <div class="flex min-w-32 justify-between gap-x-6 rounded-[50px] bg-[#FAF9F6] px-6 py-3 text-lg font-medium text-colorBlackPearl">
                                                    <button class="text-xl" onclick="incrementBtn()">
                                                        +
                                                    </button>
                                                    <span class="product-value">1</span>
                                                    <button class="text-xl" onclick="decrementBtn()">
                                                        -
                                                    </button>
                                                </div>
                                                <!-- Increment/Decrement Buttons Block -->
                                            </td>
                                            <td class="px-8 py-5">$20</td>
                                        </tr>
                                        <tr>
                                            <td class="flex min-w-80 items-center gap-x-4 px-8 py-5 font-bold">
                                                <button class="text-2xl font-normal text-colorJasper">
                                                    &times;
                                                </button>
                                                <img src="{{ asset('assets-front/img/images/th-1/product-add-cart-thumb-2.jpg') }}" alt="product-add-cart-thumb-2" width="87" height="65" />
                                                <a href="{{ route('front.product.details') }}" class="hover:text-colorBlackPearl">34 book demo</a>
                                            </td>
                                            <td class="px-8 py-5">$32</td>
                                            <td class="max-w-40 px-8 py-5">
                                                <!-- Increment/Decrement Buttons Block -->
                                                <div class="flex min-w-32 justify-between gap-x-6 rounded-[50px] bg-[#FAF9F6] px-6 py-3 text-lg font-medium text-colorBlackPearl">
                                                    <button class="text-xl" onclick="incrementBtn()">
                                                        +
                                                    </button>
                                                    <span class="product-value">1</span>
                                                    <button class="text-xl" onclick="decrementBtn()">
                                                        -
                                                    </button>
                                                </div>
                                                <!-- Increment/Decrement Buttons Block -->
                                            </td>
                                            <td class="px-8 py-5">$32</td>
                                        </tr>
                                        <tr>
                                            <td class="flex min-w-80 items-center gap-x-4 px-8 py-5 font-bold">
                                                <button class="text-2xl font-normal text-colorJasper">
                                                    &times;
                                                </button>
                                                <img src="{{ asset('assets-front/img/images/th-1/product-add-cart-thumb-3.jpg') }}" alt="product-add-cart-thumb-3" width="87" height="65" />
                                                <a href="{{ route('front.product.details') }}" class="hover:text-colorBlackPearl">Degital demo book</a>
                                            </td>
                                            <td class="px-8 py-5">$98</td>
                                            <td class="max-w-40 px-8 py-5">
                                                <!-- Increment/Decrement Buttons Block -->
                                                <div class="flex min-w-32 justify-between gap-x-6 rounded-[50px] bg-[#FAF9F6] px-6 py-3 text-lg font-medium text-colorBlackPearl">
                                                    <button class="text-xl" onclick="incrementBtn()">
                                                        +
                                                    </button>
                                                    <span class="product-value">1</span>
                                                    <button class="text-xl" onclick="decrementBtn()">
                                                        -
                                                    </button>
                                                </div>
                                                <!-- Increment/Decrement Buttons Block -->
                                            </td>
                                            <td class="px-8 py-5">$98</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-10 grid grid-cols-1 gap-x-12 gap-y-10 md:grid-cols-2 lg:gap-x-20">
                                <form action="#" method="post" class="max-w-[430px]">
                                    <input type="text" class="w-full rounded-lg border border-colorBlackPearl/25 px-6 py-3" placeholder="Coupon code..." required />
                                    <button type="submit" class="btn btn-primary is-icon group mt-6">
                                        Update price
                                        <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                            <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                        </span>
                                        <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                            <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                        </span>
                                    </button>
                                </form>

                                <div class="">
                                    <h4>Cart Totals</h4>
                                    <table class="mt-6 w-full table-auto rounded-lg border border-colorBlackPearl/25">
                                        <tbody class="divide-y divide-colorBlackPearl/25">
                                            <tr class="divide-x divide-colorBlackPearl/25">
                                                <td class="px-6 py-3 font-bold text-colorBlackPearl">
                                                    Subtotal
                                                </td>
                                                <td class="px-6 py-3">$210.90</td>
                                            </tr>
                                            <tr class="divide-x divide-colorBlackPearl/25">
                                                <td class="px-6 py-3 font-bold text-colorBlackPearl">
                                                    Delivery Charge
                                                </td>
                                                <td class="px-6 py-3">$30.00</td>
                                            </tr>
                                            <tr class="divide-x divide-colorBlackPearl/25">
                                                <td class="px-6 py-3 font-bold text-colorBlackPearl">
                                                    Order Total
                                                </td>
                                                <td class="px-6 py-3">$240.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('front.checkout') }}" class="btn btn-primary is-icon group mt-6">
                                        Process Checkout
                                        <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                            <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                        </span>
                                        <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                            <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Cart Section End :::... -->

@endsection
