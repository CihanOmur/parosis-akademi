@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Ürünler')

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
                                    Our Products
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">HOME</a>
                                        </li>
                                        <li>OUR PRODUCTS</li>
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
            <div class="section-product">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Product List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                <!-- Product Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group/product overflow-hidden rounded-lg">
                                        <!-- Thumbnail -->
                                        <div class="relative flex justify-center overflow-hidden rounded-lg">
                                            <img src="{{ asset('assets-front/img/images/th-1/product-img-1.jpg') }}" alt="product-img-1" width="370" height="388" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />

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
                                            <a href="{{ route('front.product.details') }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Secret Demo Files</a>
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
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">$178.00</span>
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
                                            <img src="{{ asset('assets-front/img/images/th-1/product-img-2.jpg') }}" alt="product-img-2" width="370" height="388" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />

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
                                            <a href="{{ route('front.product.details') }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Demo of Dreams</a>
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
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">$178.00</span>
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
                                            <img src="{{ asset('assets-front/img/images/th-1/product-img-3.jpg') }}" alt="product-img-3" width="370" height="388" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />

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
                                            <a href="{{ route('front.product.details') }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Demo in Darkness</a>
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
                                                <span>(23 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">$754.00
                                                <span class="ml-2 font-normal text-[#868686]/50 line-through">$854.00</span>
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
                                            <img src="{{ asset('assets-front/img/images/th-1/product-img-4.jpg') }}" alt="product-img-4" width="370" height="388" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />

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
                                            <a href="{{ route('front.product.details') }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Demo of Deception</a>
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
                                                <span>(42 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">$642.00
                                                <span class="ml-2 font-normal text-[#868686]/50 line-through">$854.00</span>
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
                                            <img src="{{ asset('assets-front/img/images/th-1/product-img-5.jpg') }}" alt="product-img-5" width="370" height="388" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />

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
                                            <a href="{{ route('front.product.details') }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Digital Demo Chronicles</a>
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
                                                <span>(17 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">$404.00
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
                                            <img src="{{ asset('assets-front/img/images/th-1/product-img-6.jpg') }}" alt="product-img-6" width="370" height="388" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />

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
                                            <a href="{{ route('front.product.details') }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Mystic Demo Magic</a>
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
                                                <span>(06 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">$754.00
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

                            <!-- Pagination -->
                            <nav class="mt-[72px] flex flex-wrap justify-center gap-2.5">
                                <a href="{{ route('front.products') }}" class="inline-flex h-12 w-12 items-center justify-center rounded-[50%] bg-[#F5F5F5] font-bold text-colorBlackPearl hover:bg-colorPurpleBlue hover:text-white">01</a>
                                <a href="{{ route('front.products') }}" class="inline-flex h-12 w-12 items-center justify-center rounded-[50%] bg-[#F5F5F5] font-bold text-colorBlackPearl hover:bg-colorPurpleBlue hover:text-white">02</a>
                                <a href="{{ route('front.products') }}" class="group inline-flex h-12 w-12 items-center justify-center rounded-[50%] bg-[#F5F5F5] font-bold text-colorBlackPearl hover:bg-colorPurpleBlue hover:text-white">
                                    <img src="{{ asset('assets-front/img/icons/icon-dark-arrow-solid-down.svg') }}" alt="icon-dark-arrow-solid-down" class="-rotate-90 opacity-100 group-hover:opacity-0" />
                                    <img src="{{ asset('assets-front/img/icons/icon-dark-arrow-solid-down.svg') }}" alt="icon-dark-arrow-solid-down" class="absolute -rotate-90 opacity-0 invert group-hover:opacity-100" />
                                </a>
                            </nav>
                            <!-- Pagination -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </div>
            <!--...::: Product Section End :::... -->

@endsection
