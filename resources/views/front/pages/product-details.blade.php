@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Ürün Detayı')

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
                                    Product Details
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">HOME</a>
                                        </li>
                                        <li>PRODUCT DETAILS</li>
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

            <!--...::: Product Section Start :::... -->
            <section class="section-course">
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Product Area -->
                            <div class="grid grid-cols-1 items-center gap-10 md:gap-[60px] lg:grid-cols-2 xl:gap-[90px]">
                                <!-- Product Details Left Block -->
                                <div class="jos" data-jos_animation="fade-right">
                                    <img src="{{ asset('assets-front/img/images/th-1/product-details-img.jpg') }}" alt="product-details-img" width="571" height="599" class="mx-auto max-w-full" />
                                </div>
                                <!-- Product Details Left Block -->
                                <!-- Product Details Right Block -->
                                <div class="jos" data-jos_animation="fade-left">
                                    <!-- Review Star -->
                                    <div class="inline-flex gap-x-[10px] text-sm">
                                        <div class="inline-flex items-center gap-x-1">
                                            <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                            <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                            <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                            <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                            <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                        </div>
                                        <span>(04 Reviews)</span>
                                    </div>
                                    <!-- Review Star -->
                                    <h2 class="my-4">Digital Demo Chronicles</h2>
                                    <div class="rich-text-area">
                                        <p>
                                            Lorem ipsum dolor sit amet consectur adipisicing elit,
                                            sed do eiusmod tempor inc idid unt ut labore et dolore
                                            magna aliqua enim ad minim veniam, quis nostrud exerec
                                            tation ullamco laboris nis aliquip commodo consequat
                                            duis aute irure dolor in reprehenderit in voluptate
                                            velit esse cillum dolore eu fugiat nulla pariatur enim
                                            ipsam.
                                        </p>
                                    </div>

                                    <!-- Product Info List -->
                                    <table class="mt-14 table-auto text-sm">
                                        <tbody>
                                            <tr>
                                                <td class="pr-6 font-medium text-colorBlackPearl">
                                                    SKU:
                                                </td>
                                                <td class="font-normal text-colorCarbonGrey">
                                                    RIO493
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pr-6 font-medium text-colorBlackPearl">
                                                    Categories:
                                                </td>
                                                <td class="font-normal text-colorCarbonGrey">
                                                    <a href="{{ route('front.products') }}" class="hover:text-colorPurpleBlue">Book</a>,
                                                    <a href="{{ route('front.products') }}" class="hover:text-colorPurpleBlue">Education</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pr-6 font-medium text-colorBlackPearl">
                                                    Tags:
                                                </td>
                                                <td class="font-normal text-colorCarbonGrey">Book</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Product Info List -->

                                    <div class="mt-12 flex flex-wrap gap-4">
                                        <!-- Increment/Decrement Buttons Block -->
                                        <div class="flex gap-x-6 rounded-[50px] bg-[#FAF9F6] px-6 py-3 text-lg font-medium text-colorBlackPearl">
                                            <button class="text-xl" onclick="incrementBtn()">
                                                +
                                            </button>
                                            <span class="product-value">1</span>
                                            <button class="text-xl" onclick="decrementBtn()">
                                                -
                                            </button>
                                        </div>
                                        <!-- Increment/Decrement Buttons Block -->

                                        <button class="btn btn-primary is-icon group">
                                            Add to Cart
                                            <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                            </span>
                                            <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Product Details Right Block -->
                            </div>
                            <!-- Product Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Product Section End :::... -->

            <!--...::: Product Tabs Section Start :::... -->
            <section class="section-tabs">
                <!-- Section Background -->
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space-bottom">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Tabs Area -->
                            <div class="">
                                <!-- Tab Button Block -->
                                <div class="flex gap-x-8 text-sm font-semibold text-[#aaaaaa]">
                                    <button class="tab-button active" data-tab="description">
                                        Description
                                    </button>
                                    <button class="tab-button" data-tab="review">
                                        Reviews(2)
                                    </button>
                                </div>
                                <!-- Tab Button Block -->

                                <!-- Separator -->
                                <div class="my-4 mb-6 h-px w-full bg-colorBlackPearl/25"></div>
                                <!-- Separator -->

                                <ul>
                                    <li class="tab-content" id="description">
                                        <div class="rich-text-area">
                                            <p>
                                                Lorem ipsum dolor sit amet consectur adipisicing elit,
                                                sed do eiusmod tempor inc idid unt ut labore et dolore
                                                magna aliqua enim ad minim veniam, quis nostrud exerec
                                                tation ullamco laboris nis aliquip commodo consequat
                                                duis aute irure dolor in reprehenderit in voluptate
                                                velit esse cillum dolore eu fugiat nulla pariatur enim
                                                ipsam.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="tab-content hidden" id="review">
                                        <!-- Review List -->
                                        <ul class="gap-y-10 divide-y divide-colorBlackPearl/25">
                                            <!-- Review Item -->
                                            <li class="py-10 last-of-type:pb-0">
                                                <div class="flex flex-wrap items-start gap-x-6">
                                                    <!-- Reviewer Thumbnail -->
                                                    <div class="h-[58px] w-[58px] rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-1/comment-thumbnail-1.jpg') }}" alt="comment-thumbnail-1" width="58" height="58" class="h-full w-full object-cover" />
                                                    </div>
                                                    <!-- Reviewer Thumbnail -->
                                                    <div class="flex-1">
                                                        <div class="mb-3">
                                                            <!-- Review Star -->
                                                            <div class="inline-flex items-center gap-x-1">
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                            </div>
                                                            <!-- Review Star -->
                                                            <div class="flex flex-wrap gap-x-4">
                                                                <!-- Reviewer Name -->
                                                                <h5>John Smith</h5>
                                                                <!-- Reviewer Name -->
                                                                <span class="text-[#aaaaaa]">12 October, 2024</span>
                                                            </div>
                                                        </div>
                                                        <!-- Review Text -->
                                                        <p>
                                                            Consectur adipisicing elit, sed do eiusmod
                                                            tempor inc idid unt ut labore et dolore magna
                                                            aliqua enim ad minim veniam, quis nostrud exerec
                                                            tation ullamco laboris nis aliquip commodo
                                                            consequat duis aute irure dolor in
                                                            reprehenderit.
                                                        </p>
                                                        <!-- Review Text -->
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- Review Item -->
                                            <!-- Review Item -->
                                            <li class="py-10 last-of-type:pb-0">
                                                <div class="flex flex-wrap items-start gap-x-6">
                                                    <!-- Reviewer Thumbnail -->
                                                    <div class="h-[58px] w-[58px] rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-1/comment-thumbnail-2.jpg') }}" alt="comment-thumbnail-1" width="58" height="58" class="h-full w-full object-cover" />
                                                    </div>
                                                    <!-- Reviewer Thumbnail -->
                                                    <div class="flex-1">
                                                        <div class="mb-3">
                                                            <!-- Review Star -->
                                                            <div class="inline-flex items-center gap-x-1">
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                            </div>
                                                            <!-- Review Star -->
                                                            <div class="flex flex-wrap gap-x-4">
                                                                <!-- Reviewer Name -->
                                                                <h5>Franklin Chen</h5>
                                                                <!-- Reviewer Name -->
                                                                <span class="text-[#aaaaaa]">05 October, 2024</span>
                                                            </div>
                                                        </div>
                                                        <!-- Review Text -->
                                                        <p>
                                                            Consectur adipisicing elit, sed do eiusmod
                                                            tempor inc idid unt ut labore et dolore magna
                                                            aliqua enim ad minim veniam, quis nostrud exerec
                                                            tation ullamco laboris nis aliquip commodo
                                                            consequat duis aute irure dolor in
                                                            reprehenderit.
                                                        </p>
                                                        <!-- Review Text -->
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- Review Item -->
                                        </ul>
                                        <!-- Review List -->

                                        <!-- Reviewer Form Block -->
                                        <div class="mt-20">
                                            <!-- Section Block -->
                                            <div>
                                                <h2>Add Your Review</h2>
                                            </div>
                                            <!-- Section Block -->

                                            <!-- User Rating Block -->
                                            <div class="my-6 flex gap-x-2">
                                                <span class="text-sm font-medium text-colorBlackPearl">Your Rating:</span>
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                </div>
                                            </div>
                                            <!-- User Rating Block -->

                                            <!-- Comment Form Block -->
                                            <form action="#" method="post">
                                                <div class="grid grid-cols-1 gap-y-10">
                                                    <!-- Form Group -->
                                                    <div class="grid grid-cols-1 gap-9">
                                                        <!-- Single Input Item -->
                                                        <div class="w-full">
                                                            <input type="text" placeholder="Full name" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                        </div>
                                                        <!-- Single Input Item -->
                                                    </div>
                                                    <!-- Form Group -->
                                                    <!-- Form Group -->
                                                    <div class="grid grid-cols-1 gap-9">
                                                        <!-- Single Input Item -->
                                                        <div class="w-full">
                                                            <input type="email" placeholder="Enter your email" class="w-full border-b border-colorBlackPearl/25 pb-3 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required />
                                                        </div>
                                                        <!-- Single Input Item -->
                                                    </div>
                                                    <!-- Form Group -->
                                                    <!-- Form Group -->
                                                    <div class="mt-10 grid grid-cols-1 gap-9">
                                                        <!-- Single Input Item -->
                                                        <div class="w-full">
                                                            <textarea placeholder="Write your review here..." class="w-full border-b border-colorBlackPearl/25 outline-none transition-all placeholder:text-[#5F5D5D] focus-visible:border-colorBlackPearl focus-visible:text-colorBlackPearl" required></textarea>
                                                        </div>
                                                        <!-- Single Input Item -->
                                                    </div>
                                                    <!-- Form Group -->
                                                </div>
                                                <!-- Form Group -->
                                                <div class="mb-8 grid grid-cols-1 gap-9">
                                                    <!-- Single Input Item -->
                                                    <div class="w-full">
                                                        <label for="check-box" class="mt-3.5 flex items-center gap-x-3 text-sm text-[#8D8D8D]">
                                                            <span class="relative">
                                                                <input type="checkbox" name="check-box" id="check-box" class="peer opacity-0" />
                                                                <span class="absolute left-0 top-1/2 inline-block h-4 w-4 -translate-y-1/2 rounded-[50%] border border-colorBlackPearl/75 peer-checked:bg-colorBlackPearl/75"></span>
                                                            </span>
                                                            I agree to the Privacy Policy.
                                                        </label>
                                                    </div>
                                                    <!-- Single Input Item -->
                                                </div>
                                                <!-- Form Group -->

                                                <button type="submit" class="btn btn-primary is-icon group mt-[10px]">
                                                    Submit Your Review
                                                    <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                    </span>
                                                    <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                                    </span>
                                                </button>
                                            </form>
                                            <!-- Comment Form Block -->
                                        </div>
                                        <!-- Reviewer Form Block -->
                                    </li>
                                </ul>
                            </div>
                            <!-- Tabs Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Product Tabs Section End :::... -->

            <!--...::: Product Section Start :::... -->
            <section class="section-course">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space-bottom">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 lg:mb-[60px]">
                                <div class="jos mx-auto max-w-lg text-center">
                                    <span class="mb-5 block uppercase">RELATED PRODUCTS</span>
                                    <h2>Related With Your Products</h2>
                                </div>
                            </div>
                            <!-- Section Block -->
                            <!-- Product List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                <!-- Product Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group/product overflow-hidden rounded-lg">
                                        <!-- Thumbnail -->
                                        <div class="relative flex justify-center overflow-hidden rounded-lg">
                                            <img src="{{ asset('assets-front/img/images/th-1/product-img-7.jpg') }}" alt="product-img-7" width="370" height="388" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />

                                            <button class="btn btn-primary is-icon group absolute -bottom-full group-hover/product:bottom-8">
                                                Add to Cart
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                            </button>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="px-2 py-8 text-center">
                                            <!-- Title Link -->
                                            <a href="{{ route('front.product.details') }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Demo of Truth</a>
                                            <!-- Title Link -->
                                            <!-- Review Star -->
                                            <div class="mb-4 inline-flex gap-x-[10px] text-sm">
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                </div>
                                                <span>(09 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">$643.00
                                            </span>
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Product Item -->
                                <!-- Product Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group/product overflow-hidden rounded-lg">
                                        <!-- Thumbnail -->
                                        <div class="relative flex justify-center overflow-hidden rounded-lg">
                                            <img src="{{ asset('assets-front/img/images/th-1/product-img-8.jpg') }}" alt="product-img-8" width="370" height="388" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />

                                            <button class="btn btn-primary is-icon group absolute -bottom-full group-hover/product:bottom-8">
                                                Add to Cart
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                            </button>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="px-2 py-8 text-center">
                                            <!-- Title Link -->
                                            <a href="{{ route('front.product.details') }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Final Demo Night</a>
                                            <!-- Title Link -->
                                            <!-- Review Star -->
                                            <div class="mb-4 inline-flex gap-x-[10px] text-sm">
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                </div>
                                                <span>(04 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">$739.00
                                            </span>
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Product Item -->
                                <!-- Product Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group/product overflow-hidden rounded-lg">
                                        <!-- Thumbnail -->
                                        <div class="relative flex justify-center overflow-hidden rounded-lg">
                                            <img src="{{ asset('assets-front/img/images/th-1/product-img-9.jpg') }}" alt="product-img-9" width="370" height="388" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />

                                            <button class="btn btn-primary is-icon group absolute -bottom-full group-hover/product:bottom-8">
                                                Add to Cart
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                            </button>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="px-2 py-8 text-center">
                                            <!-- Title Link -->
                                            <a href="{{ route('front.product.details') }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Haunted Demo Quest</a>
                                            <!-- Title Link -->
                                            <!-- Review Star -->
                                            <div class="mb-4 inline-flex gap-x-[10px] text-sm">
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star-blank.svg') }}" alt="icon-yellow-star-blank" width="16" height="15" />
                                                </div>
                                                <span>(63 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">$754.00
                                            </span>
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Product Item -->
                            </ul>
                            <!-- Product List -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Product Section End :::... -->

@endsection
