@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Ödeme')

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

            <!--...::: Checkout Section Start :::... -->
            <section class="section-checkout">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Checkout Area -->
                            <div class="grid grid-cols-1 items-center gap-10 md:grid-cols-[0.5fr_1fr] lg:grid-cols-[0.3fr_1fr]">
                                <div class="flex flex-col items-start justify-start divide-y divide-[#ededed] rounded-lg border border-[#ededed]">
                                    <button class="tab-button active w-full px-5 py-3 text-start font-bold" data-tab="order">
                                        Order
                                    </button>
                                    <button class="tab-button w-full px-5 py-3 text-start font-bold" data-tab="account">
                                        Edit Account
                                    </button>
                                    <button class="tab-button w-full px-5 py-3 text-start font-bold" data-tab="password">
                                        Password
                                    </button>
                                    <button class="tab-button w-full px-5 py-3 text-start font-bold" data-tab="address">
                                        Address
                                    </button>
                                </div>

                                <ul>
                                    <li class="tab-content" id="order">
                                        <h5 class="mb-5">Order History</h5>
                                        <!-- Order List -->
                                        <ul class="grid grid-cols-1 gap-y-6">
                                            <!-- Order Item -->
                                            <li class="rounded-lg border">
                                                <div class="flex flex-col justify-between gap-x-5 gap-y-2 px-4 py-2 sm:flex-row sm:items-center">
                                                    <div>
                                                        <span class="block text-base font-bold text-colorBlackPearl">Order# 260847</span>
                                                        <div>Date Added: <span>1 Aug 2024</span></div>
                                                    </div>
                                                    <span class="font-semibold text-blue-800">Processing</span>
                                                </div>
                                                <div class="border-t bg-[#f8f8f8] px-4 py-3">
                                                    <div class="flex items-center gap-5">
                                                        <div class="h-[65] w-[87px] rounded-[10px]">
                                                            <img src="{{ asset('assets-front/img/images/th-1/product-add-cart-thumb-1.jpg') }}" alt="product-add-cart-thumb-1" width="87" height="65" />
                                                        </div>
                                                        <span class="flex-1 font-bold text-colorBlackPearl">34 book demo</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- Order Item -->
                                            <!-- Order Item -->
                                            <li class="rounded-lg border">
                                                <div class="flex flex-col justify-between gap-x-5 gap-y-2 px-4 py-2 sm:flex-row sm:items-center">
                                                    <div>
                                                        <span class="block text-base font-bold text-colorBlackPearl">Order# 211572</span>
                                                        <div>Date Added: <span>20 July 2024</span></div>
                                                    </div>
                                                    <span class="font-semibold text-green-800">Delivered</span>
                                                </div>
                                                <div class="border-t bg-[#f8f8f8] px-4 py-3">
                                                    <div class="flex items-center gap-5">
                                                        <div class="h-[65] w-[87px] rounded-[10px]">
                                                            <img src="{{ asset('assets-front/img/images/th-1/product-add-cart-thumb-2.jpg') }}" alt="product-add-cart-thumb-2" width="87" height="65" />
                                                        </div>
                                                        <span class="flex-1 font-bold text-colorBlackPearl">34 book demo</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- Order Item -->
                                            <!-- Order Item -->
                                            <li class="rounded-lg border">
                                                <div class="flex flex-col justify-between gap-x-5 gap-y-2 px-4 py-2 sm:flex-row sm:items-center">
                                                    <div>
                                                        <span class="block text-base font-bold text-colorBlackPearl">Order# 47584</span>
                                                        <div>Date Added: <span>03 March 2024</span></div>
                                                    </div>
                                                    <span class="font-semibold text-orange-800">Refund</span>
                                                </div>
                                                <div class="border-t bg-[#f8f8f8] px-4 py-3">
                                                    <div class="flex items-center gap-5">
                                                        <div class="h-[65] w-[87px] rounded-[10px]">
                                                            <img src="{{ asset('assets-front/img/images/th-1/product-add-cart-thumb-3.jpg') }}" alt="product-add-cart-thumb-3" width="87" height="65" />
                                                        </div>
                                                        <span class="flex-1 font-bold text-colorBlackPearl">Digital demo book</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- Order Item -->
                                        </ul>
                                        <!-- Order List -->
                                    </li>
                                    <li class="tab-content hidden" id="account">
                                        <h5 class="mb-5">My Account Information</h5>

                                        <!-- Account Information -->
                                        <form action="#" method="post">
                                            <div class="mb-8 grid grid-cols-1 gap-y-10">
                                                <!-- Form Group -->
                                                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2">
                                                    <!-- Single Input Item -->
                                                    <div class="w-full">
                                                        <input type="text" placeholder="First name" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                    </div>
                                                    <!-- Single Input Item -->
                                                    <!-- Single Input Item -->
                                                    <div class="w-full">
                                                        <input type="text" placeholder="Last name" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                    </div>
                                                    <!-- Single Input Item -->
                                                </div>
                                                <!-- Form Group -->
                                                <!-- Form Group -->
                                                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2">
                                                    <!-- Single Input Item -->
                                                    <div class="w-full">
                                                        <input type="tel" placeholder="Enter Mobile Number" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                    </div>
                                                    <!-- Single Input Item -->
                                                    <!-- Single Input Item -->
                                                    <div class="w-full">
                                                        <input type="email" placeholder="Enter Email" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                    </div>
                                                    <!-- Single Input Item -->
                                                </div>
                                                <!-- Form Group -->
                                            </div>

                                            <button type="submit" class="btn btn-primary is-icon group mt-[10px]">
                                                Update Information
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                </span>
                                            </button>
                                        </form>
                                        <!-- Account Information -->
                                    </li>
                                    <li class="tab-content hidden" id="password">
                                        <h5 class="mb-5">Change Password</h5>

                                        <!-- Change Password -->
                                        <form action="#" method="post">
                                            <div class="mb-8 grid grid-cols-1 gap-y-10">
                                                <!-- Form Group -->
                                                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2">
                                                    <!-- Single Input Item -->
                                                    <div class="w-full">
                                                        <input type="password" placeholder="Old Password" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                    </div>
                                                    <!-- Single Input Item -->
                                                    <!-- Single Input Item -->
                                                    <div class="w-full">
                                                        <input type="password" placeholder="New Password" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                    </div>
                                                    <!-- Single Input Item -->
                                                    <!-- Single Input Item -->
                                                    <div class="w-full">
                                                        <input type="password" placeholder="Password Confirm" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                    </div>
                                                    <!-- Single Input Item -->
                                                </div>
                                                <!-- Form Group -->
                                            </div>

                                            <button type="submit" class="btn btn-primary is-icon group mt-[10px]">
                                                Update Password
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                </span>
                                            </button>
                                        </form>
                                        <!-- Change Password -->
                                    </li>
                                    <li class="tab-content hidden" id="address">
                                        <h5 class="mb-5">Address Book</h5>

                                        <address class="mb-5 border px-3 py-5 not-italic">
                                            Cecilia Chapman 711-2880 Nulla St. Mankato Mississippi
                                            96522 (257) 563-7401
                                        </address>

                                        <!-- Update Address -->
                                        <form action="#" method="post">
                                            <div class="mb-8 grid grid-cols-1 gap-y-10">
                                                <!-- Form Group -->
                                                <div class="grid grid-cols-1 gap-10">
                                                    <!-- Single Input Item -->
                                                    <div class="w-full">
                                                        <input type="text" placeholder="Update your address" class="w-full border border-colorBlackPearl/25 p-3 px-5 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                    </div>
                                                    <!-- Single Input Item -->
                                                </div>
                                                <!-- Form Group -->
                                            </div>

                                            <button type="submit" class="btn btn-primary is-icon group mt-[10px]">
                                                Update Address
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                </span>
                                            </button>
                                        </form>
                                        <!-- Update Address -->
                                    </li>
                                </ul>
                            </div>
                            <!-- Checkout Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Checkout Section End :::... -->

@endsection
