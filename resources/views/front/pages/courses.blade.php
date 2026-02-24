@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Kurslarımız')

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
                                    Our Courses
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">HOME</a>
                                        </li>
                                        <li>OUR COURSES</li>
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

            <!--...::: Course Section Start :::... -->
            <div class="section-course">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Course Top -->
                            <div class="mb-8 flex flex-wrap items-center justify-center gap-x-10 gap-y-5 md:mb-10 md:justify-between">
                                <!-- Left Block -->
                                <div class="order-2 md:order-1">showing 1-6 of 15 Result</div>
                                <!-- Left Block -->
                                <!-- Right Block -->
                                <div class="order-1 w-full md:order-2 md:w-[436px]">
                                    <!-- Search Form -->
                                    <form action="#" method="get" class="w-full">
                                        <div class="relative flex items-center">
                                            <input type="search" placeholder="Kursunuzu arayın" class="w-full rounded-[50px] border px-8 py-3.5 pr-36 text-sm font-medium outline-none placeholder:text-colorBlackPearl/55" />
                                            <button type="submit" class="absolute bottom-[5px] right-0 top-[5px] mr-[5px] inline-flex items-center justify-center gap-x-2.5 rounded-[50px] bg-colorPurpleBlue px-6 text-center text-sm text-white hover:bg-colorBlackPearl">
                                                Search
                                                <img src="{{ asset('assets-front/img/icons/icon-white-search-line.svg') }}" alt="icon-white-search-line" width="16" height="16" />
                                            </button>
                                        </div>
                                    </form>
                                    <!-- Search Form -->
                                </div>
                                <!-- Right Block -->
                            </div>
                            <!-- Course Top -->

                            <!-- Course List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            <img src="{{ asset('assets-front/img/images/th-4/course-img-1.jpg') }}" alt="course-img-1" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">English</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">54 Lessons</span>
                                                </span>

                                                <!-- Review Star -->
                                                <div class="inline-flex gap-x-[10px] text-sm leading-none">
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    </div>
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <span>4.5</span>
                                                        <span>(28)</span>
                                                    </div>
                                                </div>
                                                <!-- Review Star -->
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Web Design for Beginners: Real World Coding in HTML &
                                                CSS</a>
                                            <!-- Title Link -->

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-graduation-cap-line.svg') }}" alt="icon-grey-graduation-cap-line" width="17" height="17" />
                                                    <span class="flex-1">673 Students</span>
                                                </div>
                                                </div>
                                                <!-- Instructor Block -->
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$395.00</span>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            <img src="{{ asset('assets-front/img/images/th-4/course-img-2.jpg') }}" alt="course-img-2" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Python</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">09 Lessons</span>
                                                </span>

                                                <!-- Review Star -->
                                                <div class="inline-flex gap-x-[10px] text-sm leading-none">
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    </div>
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <span>3.4</span>
                                                        <span>(28)</span>
                                                    </div>
                                                </div>
                                                <!-- Review Star -->
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Complete Python Bootcamp From Zero to Hero in
                                                Python</a>
                                            <!-- Title Link -->

                                            <p class="line-clamp-2">
                                                Excepteur sint occaecat cupidatat non proident sunt in
                                                culpa qui officia...
                                            </p>

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    <div class="h-7 w-7 overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-3/course-instructor-thumb-2.jpg') }}" alt="course-instructor-thumb-2" width="28" height="28" class="h-full w-full object-cover" />
                                                    </div>
                                                    <a href="{{ route('front.courses') }}" class="text-sm hover:underline">Laura Martinez</a>
                                                </div>
                                                <!-- Instructor Block -->
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$538.00</span>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            <img src="{{ asset('assets-front/img/images/th-4/course-img-3.jpg') }}" alt="course-img-3" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Business</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">23 Lessons</span>
                                                </span>

                                                <!-- Review Star -->
                                                <div class="inline-flex gap-x-[10px] text-sm leading-none">
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    </div>
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <span>4.7</span>
                                                        <span>(34)</span>
                                                    </div>
                                                </div>
                                                <!-- Review Star -->
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Starting SEO as your Home Based Business Courses</a>
                                            <!-- Title Link -->

                                            <p class="line-clamp-2">
                                                Excepteur sint occaecat cupidatat non proident sunt in
                                                culpa qui officia...
                                            </p>

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    <div class="h-7 w-7 overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-3/course-instructor-thumb-3.jpg') }}" alt="course-instructor-thumb-3" width="28" height="28" class="h-full w-full object-cover" />
                                                    </div>
                                                    <a href="{{ route('front.courses') }}" class="text-sm hover:underline">Jennifer Brown</a>
                                                </div>
                                                <!-- Instructor Block -->
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$642.00</span>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            <img src="{{ asset('assets-front/img/images/th-4/course-img-4.jpg') }}" alt="course-img-4" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Photography</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">27 Lessons</span>
                                                </span>

                                                <!-- Review Star -->
                                                <div class="inline-flex gap-x-[10px] text-sm leading-none">
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    </div>
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <span>4.4</span>
                                                        <span>(43)</span>
                                                    </div>
                                                </div>
                                                <!-- Review Star -->
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Photography Masterclass: A Complete Guide to
                                                Photography</a>
                                            <!-- Title Link -->

                                            <p class="line-clamp-2">
                                                Excepteur sint occaecat cupidatat non proident sunt in
                                                culpa qui officia...
                                            </p>

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    <div class="h-7 w-7 overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-3/course-instructor-thumb-4.jpg') }}" alt="course-instructor-thumb-4" width="28" height="28" class="h-full w-full object-cover" />
                                                    </div>
                                                    <a href="{{ route('front.courses') }}" class="text-sm hover:underline">William Smith</a>
                                                </div>
                                                <!-- Instructor Block -->
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$642.00</span>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            <img src="{{ asset('assets-front/img/images/th-4/course-img-5.jpg') }}" alt="course-img-5" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Drawing</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">04 Lessons</span>
                                                </span>

                                                <!-- Review Star -->
                                                <div class="inline-flex gap-x-[10px] text-sm leading-none">
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    </div>
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <span>2.4</span>
                                                        <span>(67)</span>
                                                    </div>
                                                </div>
                                                <!-- Review Star -->
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">The Ultimate Drawing Course Beginner to Advanced</a>
                                            <!-- Title Link -->

                                            <p class="line-clamp-2">
                                                Excepteur sint occaecat cupidatat non proident sunt in
                                                culpa qui officia...
                                            </p>

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    <div class="h-7 w-7 overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-3/course-instructor-thumb-5.jpg') }}" alt="course-instructor-thumb-5" width="28" height="28" class="h-full w-full object-cover" />
                                                    </div>
                                                    <a href="{{ route('front.courses') }}" class="text-sm hover:underline">James Harris</a>
                                                </div>
                                                <!-- Instructor Block -->
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$275.00</span>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            <img src="{{ asset('assets-front/img/images/th-4/course-img-6.jpg') }}" alt="course-img-6" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Design</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">67 Lessons</span>
                                                </span>

                                                <!-- Review Star -->
                                                <div class="inline-flex gap-x-[10px] text-sm leading-none">
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    </div>
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <span>4.7</span>
                                                        <span>(21)</span>
                                                    </div>
                                                </div>
                                                <!-- Review Star -->
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">The Ultimate Drawing Course Beginner to Advanced</a>
                                            <!-- Title Link -->

                                            <p class="line-clamp-2">
                                                Excepteur sint occaecat cupidatat non proident sunt in
                                                culpa qui officia...
                                            </p>

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    <div class="h-7 w-7 overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-3/course-instructor-thumb-6.jpg') }}" alt="course-instructor-thumb-6.jpg" width="28" height="28" class="h-full w-full object-cover" />
                                                    </div>
                                                    <a href="{{ route('front.courses') }}" class="text-sm hover:underline">David Wilson</a>
                                                </div>
                                                <!-- Instructor Block -->
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$753.00</span>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            <img src="{{ asset('assets-front/img/images/th-4/course-img-7.jpg') }}" alt="course-img-7" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Development</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">87 Lessons</span>
                                                </span>

                                                <!-- Review Star -->
                                                <div class="inline-flex gap-x-[10px] text-sm leading-none">
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    </div>
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <span>4.2</span>
                                                        <span>(12)</span>
                                                    </div>
                                                </div>
                                                <!-- Review Star -->
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">App Development By Building 100 Projects in 100
                                                Days</a>
                                            <!-- Title Link -->

                                            <p class="line-clamp-2">
                                                Excepteur sint occaecat cupidatat non proident sunt in
                                                culpa qui officia...
                                            </p>

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    <div class="h-7 w-7 overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-3/course-instructor-thumb-4.jpg') }}" alt="course-instructor-thumb-4.jpg" width="28" height="28" class="h-full w-full object-cover" />
                                                    </div>
                                                    <a href="{{ route('front.courses') }}" class="text-sm hover:underline">William Smith</a>
                                                </div>
                                                <!-- Instructor Block -->
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$275.00</span>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            <img src="{{ asset('assets-front/img/images/th-4/course-img-8.jpg') }}" alt="course-img-8" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">English</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">45 Lessons</span>
                                                </span>

                                                <!-- Review Star -->
                                                <div class="inline-flex gap-x-[10px] text-sm leading-none">
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    </div>
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <span>2.4</span>
                                                        <span>(89)</span>
                                                    </div>
                                                </div>
                                                <!-- Review Star -->
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Learn English Fluently With Our Popular Course</a>
                                            <!-- Title Link -->

                                            <p class="line-clamp-2">
                                                Excepteur sint occaecat cupidatat non proident sunt in
                                                culpa qui officia...
                                            </p>

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    <div class="h-7 w-7 overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-3/course-instructor-thumb-5.jpg') }}" alt="course-instructor-thumb-5.jpg" width="28" height="28" class="h-full w-full object-cover" />
                                                    </div>
                                                    <a href="{{ route('front.courses') }}" class="text-sm hover:underline">James Harris</a>
                                                </div>
                                                <!-- Instructor Block -->
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$275.00</span>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg bg-[#f5f5f5] transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-tl-lg rounded-tr-lg">
                                            <img src="{{ asset('assets-front/img/images/th-4/course-img-9.jpg') }}" alt="course-img-9" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Photoshop</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7 px-4 pb-6">
                                            <!-- Course Meta -->
                                            <div class="flex justify-between gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">67 Lessons</span>
                                                </span>

                                                <!-- Review Star -->
                                                <div class="inline-flex gap-x-[10px] text-sm leading-none">
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    </div>
                                                    <div class="inline-flex items-center gap-x-1">
                                                        <span>4.7</span>
                                                        <span>(21)</span>
                                                    </div>
                                                </div>
                                                <!-- Review Star -->
                                            </div>
                                            <!-- Course Meta -->

                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="mb-3 mt-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Learn Photoshop - UI/UX Design Essential Training</a>
                                            <!-- Title Link -->

                                            <p class="line-clamp-2">
                                                Excepteur sint occaecat cupidatat non proident sunt in
                                                culpa qui officia...
                                            </p>

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <!-- Instructor Block -->
                                                <div class="flex items-center gap-x-3">
                                                    <div class="h-7 w-7 overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-3/course-instructor-thumb-6.jpg') }}" alt="course-instructor-thumb-6.jpg" width="28" height="28" class="h-full w-full object-cover" />
                                                    </div>
                                                    <a href="{{ route('front.courses') }}" class="text-sm hover:underline">David Wilson</a>
                                                </div>
                                                <!-- Instructor Block -->
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$753.00</span>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                            </ul>
                            <!-- Course List -->

                            <!-- Pagination -->
                            <nav class="mt-[72px] flex flex-wrap justify-center gap-2.5">
                                <a href="{{ route('front.courses') }}" class="inline-flex h-12 w-12 items-center justify-center rounded-[50%] bg-[#F5F5F5] font-bold text-colorBlackPearl hover:bg-colorPurpleBlue hover:text-white">01</a>
                                <a href="{{ route('front.courses') }}" class="inline-flex h-12 w-12 items-center justify-center rounded-[50%] bg-[#F5F5F5] font-bold text-colorBlackPearl hover:bg-colorPurpleBlue hover:text-white">02</a>
                                <a href="{{ route('front.courses') }}" class="group inline-flex h-12 w-12 items-center justify-center rounded-[50%] bg-[#F5F5F5] font-bold text-colorBlackPearl hover:bg-colorPurpleBlue hover:text-white">
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
            <!--...::: Course Section End :::... -->
@endsection
