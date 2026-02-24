@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Geleceğin Teknolojisine Yön Veren Akademi')

@section('content')
            <!--...::: Hero Section Start :::... -->
            <section class="section-hero">
                <div class="relative z-10 overflow-hidden bg-[url(../img/images/th-1/hero-bg.svg)] bg-cover bg-center bg-no-repeat">
                    <!-- Hero Space -->
                    <div class="grid grid-cols-1 px-5 pt-[210px] md:pt-[235px] lg:px-0 lg:pb-[100px] lg:pl-20 lg:pt-[310px] xxl:pb-[166px] xxxl:pl-32 xxxxl:pl-[250px]">
                        <!-- Hero Content Block -->
                        <div class="lg:max-w-lg xxl:max-w-2xl">
                            <h1 class="mb-[30px]">
                                Best
                                <span class="inline-flex rounded-md bg-colorBrightGold px-2">Online</span>
                                Platform to Learn Everything
                            </h1>
                            <p class="mb-10 max-w-[400px] xl:max-w-[474px]">
                                Excepteur sint occaecat cupidatat non proident sunt in culpa
                                qui officia deserunt mollit.
                            </p>
                            <a href="{{ route('front.courses') }}" class="btn btn-primary is-icon group">Tüm Kursları Görüntüle
                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                </span>
                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                </span>
                            </a>
                        </div>
                        <!-- Hero Content Block -->

                        <!-- Hero Image Block -->
                        <div class="bottom-0 right-20 mt-10 lg:absolute lg:mt-0 xxxxl:right-44">
                            <div class="relative z-10 flex items-end justify-center">
                                <img src="{{ asset('assets-front/img/images/th-1/hero-img-1.png') }}" alt="hero-img-1" width="653" height="740" class="element-move-x z-10 max-w-full -translate-x-[50px] md:max-w-md xl:max-w-lg xxl:max-w-full"/>
                                <div class="jos absolute -bottom-28 left-1/2 -z-10 h-[400px] w-[400px] -translate-x-1/2 rounded-[50%] bg-gradient-to-t from-[#D7E1D8] to-white xl:h-[500px] xl:w-[500px] xxl:h-[706px] xxl:w-[706px]" data-jos_animation="zoom-in-up"></div>
                                <img src="{{ asset('assets-front/img/abstracts/abstract-dots-2.svg') }}" alt="abstract-dots-2" width="49" height="79" class="element-move absolute bottom-[86px] left-24" />
                            </div>
                        </div>
                        <!-- Hero Image Block -->
                    </div>
                    <!-- Hero Space -->

                    <!-- Section Elements -->
                    <img src="{{ asset('assets-front/img/abstracts/abstract-red-plus-1.svg') }}" alt="abstract-red-plus-1" width="46" height="32" class="element-move absolute left-[125px] top-[296px] -z-10" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-1.svg') }}" alt="abstract-dots-1" width="49" height="94" class="element-move absolute right-0 top-52 -z-10" />

                    <img src="{{ asset('assets-front/img/abstracts/element-book-1.svg') }}" alt="element-book-1" width="93" height="73" class="element-move absolute -bottom-40 left-[771px] -z-10" />
                    <img src="{{ asset('assets-front/img/abstracts/element-crown-1.svg') }}" alt="element-crown-1" width="47" height="39" class="absolute bottom-[86px] right-[63px] -z-10" />
                    <!-- Section Elements -->
                </div>
            </section>
            <!--...::: Hero Section Start :::... -->

            <!--...::: Welcome Section Start :::... -->
            <section class="section-welcome">
                <div class="relative z-10">
                    <!-- Section Space -->
                    <div class="section-space-top">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Welcome Area -->
                            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-16 xl:gap-32">
                                <!-- Welcome Left Block -->
                                <div class="jos relative order-2 mx-auto lg:order-1" data-jos_animation="fade-right">
                                    <img src="{{ asset('assets-front/img/images/th-1/welcome-img.png') }}" alt="welcome-img" width="482" height="486" class="max-w-full" />

                                    <!-- Card -->
                                    <div class="jos absolute bottom-24 left-16 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-4 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10 xxl:-left-16 xxxl:-left-28">
                                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="icon-red-tomato-graduation-cap-line." width="28" height="28" />
                                        </div>
                                        <div class="">
                                            <span class="block font-title text-[28px] font-bold leading-[1.73] text-[#DF4343]">9394+</span>
                                            <span>Enrolled Learners</span>
                                        </div>
                                    </div>
                                    <!-- Card -->

                                    <!-- Background Element -->
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-2.svg') }}" alt="abstract-dots-2" class="absolute -left-10 top-1/2 z-20 -translate-y-1/2 rotate-90" />
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-golden-yellow-bg-black-dash-1.svg') }}" alt="abstract-dots-2" width="83" height="74" class="absolute bottom-5 right-0 z-20" />
                                    <!-- Background Element -->
                                </div>
                                <!-- Welcome Left Block -->

                                <!-- Welcome Right Block -->
                                <div class="jos order-1 lg:order-2" data-jos_animation="fade-left">
                                    <!-- Section Block -->
                                    <div class="mb-6">
                                        <span class="mb-5 block uppercase text-[#84994F]">WELCOME TO Corwus</span>
                                        <h2>
                                            Digital Online Academy: Your Path to Creative Excellence
                                        </h2>
                                    </div>
                                    <!-- Section Block -->
                                    <!-- Content Block -->
                                    <div>
                                        <p>
                                            Excepteur sint occaecat cupidatat non proident sunt in
                                            culpa qui officia deserunt mollit.
                                        </p>
                                        <ul class="mt-6 flex list-inside list-image-[url(../img/icons/icon-purple-check.svg)] flex-col gap-y-4 font-title text-colorBlackPearl">
                                            <li>Our Expert Trainers</li>
                                            <li>Online Remote Learning</li>
                                            <li>Easy to follow curriculum</li>
                                            <li>Lifetime Access</li>
                                        </ul>
                                    </div>
                                    <!-- Content Block -->
                                </div>
                                <!-- Welcome Right Block -->
                            </div>
                            <!-- Welcome Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Section Elements -->
                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="absolute bottom-0 right-20 -z-10" />
                    <div class="absolute -bottom-20 left-0 -z-10 h-[383px] w-[531px] -translate-x-1/2 rounded-[50%] bg-colorBrightGold/[23%] blur-3xl"></div>
                    <!-- Section Elements -->
                </div>
            </section>
            <!--...::: Welcome Section End :::... -->

            <!--...::: Course Category Section Start :::... -->
            <section class="section-course-category">
                <!-- Section Space -->
                <div class="section-space">
                    <!-- Section Container  -->
                    <div class="container">
                        <!-- Section Block -->
                        <div class="mb-10 flex flex-wrap items-center justify-between gap-8 lg:mb-[60px]">
                            <div class="jos max-w-xl">
                                <span class="mb-5 block uppercase">COURSE CATEGORIES</span>
                                <h2>Top Categories You Want to Learn</h2>
                            </div>
                            <div class="jos inline-block">
                                <a href="{{ route('front.courses') }}" class="btn btn-primary is-icon group">Find Courses
                                    <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                    </span>
                                    <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                        <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right.svg" width="13" height="12" />
                                    </span>
                                </a>
                            </div>
                        </div>
                        <!-- Section Block -->

                        <!-- Course Category List -->
                        <ul class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            <!-- Course Category Item -->
                            <li class="jos">
                                <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%] bg-[#DE1EF9]/10">
                                        <img src="{{ asset('assets-front/img/icons/category-icon-1.svg') }}" alt="category-icon-1" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">Business</span>
                                        <span class="text-sm">04 Courses</span>
                                    </div>
                                </a>
                            </li>
                            <li class="jos">
                                <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%] bg-[#42AC98]/10">
                                        <img src="{{ asset('assets-front/img/icons/category-icon-2.svg') }}" alt="category-icon-2" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">Marketing</span>
                                        <span class="text-sm">88 Courses</span>
                                    </div>
                                </a>
                            </li>
                            <li class="jos">
                                <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%] bg-[#DF4343]/10">
                                        <img src="{{ asset('assets-front/img/icons/category-icon-3.svg') }}" alt="category-icon-3" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">Design</span>
                                        <span class="text-sm">23 Courses</span>
                                    </div>
                                </a>
                            </li>
                            <li class="jos">
                                <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%] bg-[#543EE4]/10">
                                        <img src="{{ asset('assets-front/img/icons/category-icon-4.svg') }}" alt="category-icon-4" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">Finance</span>
                                        <span class="text-sm">02 Courses</span>
                                    </div>
                                </a>
                            </li>
                            <li class="jos">
                                <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%] bg-[#543EE5]/10">
                                        <img src="{{ asset('assets-front/img/icons/category-icon-5.svg') }}" alt="category-icon-5" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">Lifestyle</span>
                                        <span class="text-sm">29 Courses</span>
                                    </div>
                                </a>
                            </li>
                            <li class="jos">
                                <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%] bg-[#DF4343]/10">
                                        <img src="{{ asset('assets-front/img/icons/category-icon-6.svg') }}" alt="category-icon-6" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">Cyber</span>
                                        <span class="text-sm">15 Courses</span>
                                    </div>
                                </a>
                            </li>
                            <li class="jos">
                                <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%] bg-[#DE1EF9]/10">
                                        <img src="{{ asset('assets-front/img/icons/category-icon-7.svg') }}" alt="category-icon-7" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">Development</span>
                                        <span class="text-sm">28 Courses</span>
                                    </div>
                                </a>
                            </li>
                            <li class="jos">
                                <a href="{{ route('front.courses') }}" class="flex items-center gap-6 rounded-[100px] bg-white p-[10px] transition-all duration-300 hover:shadow-lg">
                                    <div class="inline-flex h-[72px] w-[72px] items-center justify-center rounded-[50%] bg-[#42AC98]/10">
                                        <img src="{{ asset('assets-front/img/icons/category-icon-8.svg') }}" alt="category-icon-8" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-1 block font-title text-xl font-bold text-colorBlackPearl">Photography</span>
                                        <span class="text-sm">03 Courses</span>
                                    </div>
                                </a>
                            </li>
                            <!-- Course Category Item -->
                        </ul>
                        <!-- Course Category List -->
                    </div>
                    <!-- Section Container  -->
                </div>
                <!-- Section Space -->
            </section>
            <!--...::: Course Category Section End :::... -->

            <!--...::: Feature Section Start :::... -->
            <div class="section-feature">
                <!-- Section Background -->
                <div class="relative z-10 bg-colorBlackPearl">
                    <!-- Section Space -->
                    <div class="py-[60px] lg:py-[90px]">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Feature List -->
                            <ul class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
                                <!-- Feature Item -->
                                <li class="jos flex items-start gap-5">
                                    <div class="inline-flex h-[60px] w-[60px] items-center justify-center rounded-[50%] bg-colorBrightGold/10">
                                        <img src="{{ asset('assets-front/img/icons/feature-icon-1.svg') }}" alt="feature-icon-1" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-2 block font-title text-xl font-bold text-white">Educator Support</span>
                                        <span class="text-white/80">Excepteur sint occaecat cupidatat non the proident sunt
                                            in culpa</span>
                                    </div>
                                </li>
                                <!-- Feature Item -->
                                <!-- Feature Item -->
                                <li class="jos flex items-start gap-5">
                                    <div class="inline-flex h-[60px] w-[60px] items-center justify-center rounded-[50%] bg-[#6FC081]/10">
                                        <img src="{{ asset('assets-front/img/icons/feature-icon-2.svg') }}" alt="feature-icon-2" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-2 block font-title text-xl font-bold text-white">Top Instructor</span>
                                        <span class="text-white/80">Excepteur sint occaecat cupidatat non the proident sunt
                                            in culpa</span>
                                    </div>
                                </li>
                                <!-- Feature Item -->
                                <!-- Feature Item -->
                                <li class="jos flex items-start gap-5">
                                    <div class="inline-flex h-[60px] w-[60px] items-center justify-center rounded-[50%] bg-[#DF4343]/10">
                                        <img src="{{ asset('assets-front/img/icons/feature-icon-3.svg') }}" alt="feature-icon-3" width="30" height="30" />
                                    </div>
                                    <div class="flex-1">
                                        <span class="mb-2 block font-title text-xl font-bold text-white">Award Wining</span>
                                        <span class="text-white/80">Excepteur sint occaecat cupidatat non the proident sunt
                                            in culpa</span>
                                    </div>
                                </li>
                                <!-- Feature Item -->
                            </ul>
                            <!-- Feature List -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Background Elements -->
                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-2.svg') }}" alt="abstract-dots-2" width="49" height="79" class="absolute left-[100px] top-1/2 -z-10 hidden -translate-y-1/2 rotate-90 animate-pulse xxxl:inline-block" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-golden-yellow-dash-1.svg') }}" alt="abstract-golden-yellow-dash-1" width="45" height="37" class="absolute bottom-12 right-[100px] -z-10 hidden animate-bounce xxxl:inline-block" />
                    <!-- Background Elements -->
                </div>
                <!-- Section Background -->
            </div>
            <!--...::: Feature Section End :::... -->

            <!--...::: Course Section Start :::... -->
            <section class="section-course">
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 lg:mb-[60px]">
                                <div class="jos mx-auto max-w-md text-center">
                                    <span class="mb-5 block uppercase">ONLINE COURSES</span>
                                    <h2>Get Your Course With Us</h2>
                                </div>
                            </div>
                            <!-- Section Block -->

                            <!-- Course List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden">
                                            <img src="{{ asset('assets-front/img/images/th-1/course-img-1.jpg') }}" alt="course-img-1" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Data Science</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="bg-[#F5F5F5] px-5 py-8">
                                            <!-- Course Meta -->
                                            <div class="flex gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">23 Lessons</span>
                                                </span>
                                                <a href="{{ route('front.courses') }}" class="inline-flex items-center gap-1.5 text-sm hover:underline">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-user-3-line.svg') }}" alt="icon-grey-user-3-line" width="17" height="18" />
                                                    <span class="flex-1">Harrison Stone</span>
                                                </a>
                                            </div>
                                            <!-- Course Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Data Competitive Strategy law and Organization
                                                Course</a>
                                            <!-- Title Link -->
                                            <!-- Review Star -->
                                            <div class="inline-flex gap-x-[10px] text-sm">
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <span>(09 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$674.00</span>
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-graduation-cap-line.svg') }}" alt="icon-grey-graduation-cap-line" width="17" height="17" />
                                                    <span class="flex-1">673 Students</span>
                                                </div>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden">
                                            <img src="{{ asset('assets-front/img/images/th-1/course-img-2.jpg') }}" alt="course-img-2" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Business</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="bg-[#F5F5F5] px-5 py-8">
                                            <!-- Course Meta -->
                                            <div class="flex gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">04 Lessons</span>
                                                </span>
                                                <a href="{{ route('front.courses') }}" class="inline-flex items-center gap-1.5 text-sm hover:underline">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-user-3-line.svg') }}" alt="icon-grey-user-3-line" width="17" height="18" />
                                                    <span class="flex-1">Alexander Wells</span>
                                                </a>
                                            </div>
                                            <!-- Course Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Grow Personal Financial Security Thinking &
                                                Principles</a>
                                            <!-- Title Link -->
                                            <!-- Review Star -->
                                            <div class="inline-flex gap-x-[10px] text-sm">
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <span>(09 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$633.00</span>
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-graduation-cap-line.svg') }}" alt="icon-grey-graduation-cap-line" width="17" height="17" />
                                                    <span class="flex-1">964 Students</span>
                                                </div>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden">
                                            <img src="{{ asset('assets-front/img/images/th-1/course-img-3.jpg') }}" alt="course-img-3" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Design</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="bg-[#F5F5F5] px-5 py-8">
                                            <!-- Course Meta -->
                                            <div class="flex gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">87 Lessons</span>
                                                </span>
                                                <a href="{{ route('front.courses') }}" class="inline-flex items-center gap-1.5 text-sm hover:underline">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-user-3-line.svg') }}" alt="icon-grey-user-3-line" width="17" height="18" />
                                                    <span class="flex-1">John Smith</span>
                                                </a>
                                            </div>
                                            <!-- Course Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">The Complete Guide to Build RESTful API
                                                Application</a>
                                            <!-- Title Link -->
                                            <!-- Review Star -->
                                            <div class="inline-flex gap-x-[10px] text-sm">
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <span>(65 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$383.00</span>
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-graduation-cap-line.svg') }}" alt="icon-grey-graduation-cap-line" width="17" height="17" />
                                                    <span class="flex-1">316 Students</span>
                                                </div>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden">
                                            <img src="{{ asset('assets-front/img/images/th-1/course-img-4.jpg') }}" alt="course-img-4" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Development</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="bg-[#F5F5F5] px-5 py-8">
                                            <!-- Course Meta -->
                                            <div class="flex gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">04 Lessons</span>
                                                </span>
                                                <a href="{{ route('front.courses') }}" class="inline-flex items-center gap-1.5 text-sm hover:underline">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-user-3-line.svg') }}" alt="icon-grey-user-3-line" width="17" height="18" />
                                                    <span class="flex-1">Gabriel Cross</span>
                                                </a>
                                            </div>
                                            <!-- Course Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Exploring Learning Landscapes in Academic Business</a>
                                            <!-- Title Link -->
                                            <!-- Review Star -->
                                            <div class="inline-flex gap-x-[10px] text-sm">
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <span>(94 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$356.00</span>
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-graduation-cap-line.svg') }}" alt="icon-grey-graduation-cap-line" width="17" height="17" />
                                                    <span class="flex-1">352 Students</span>
                                                </div>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden">
                                            <img src="{{ asset('assets-front/img/images/th-1/course-img-5.jpg') }}" alt="course-img-5" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Marketing</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="bg-[#F5F5F5] px-5 py-8">
                                            <!-- Course Meta -->
                                            <div class="flex gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">04 Lessons</span>
                                                </span>
                                                <a href="{{ route('front.courses') }}" class="inline-flex items-center gap-1.5 text-sm hover:underline">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-user-3-line.svg') }}" alt="icon-grey-user-3-line" width="17" height="18" />
                                                    <span class="flex-1">Maxwell Ford</span>
                                                </a>
                                            </div>
                                            <!-- Course Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Voices from the Learning Manage Education Hub</a>
                                            <!-- Title Link -->
                                            <!-- Review Star -->
                                            <div class="inline-flex gap-x-[10px] text-sm">
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <span>(09 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$643.00</span>
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-graduation-cap-line.svg') }}" alt="icon-grey-graduation-cap-line" width="17" height="17" />
                                                    <span class="flex-1">553 Students</span>
                                                </div>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                                <!-- Course Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-md">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden">
                                            <img src="{{ asset('assets-front/img/images/th-1/course-img-6.jpg') }}" alt="course-img-6" width="370" height="270" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.courses') }}" class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl hover:bg-colorBlackPearl hover:text-colorBrightGold">Cyber Security</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="bg-[#F5F5F5] px-5 py-8">
                                            <!-- Course Meta -->
                                            <div class="flex gap-9">
                                                <span class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-book-3-line.svg') }}" alt="icon-grey-book-3-line" width="17" height="17" />
                                                    <span class="flex-1">04 Lessons</span>
                                                </span>
                                                <a href="{{ route('front.courses') }}" class="inline-flex items-center gap-1.5 text-sm hover:underline">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-user-3-line.svg') }}" alt="icon-grey-user-3-line" width="17" height="18" />
                                                    <span class="flex-1">Dominic Chase</span>
                                                </a>
                                            </div>
                                            <!-- Course Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.course.details') }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Starting SEO as your Home Based Business Courses</a>
                                            <!-- Title Link -->
                                            <!-- Review Star -->
                                            <div class="inline-flex gap-x-[10px] text-sm">
                                                <div class="inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <span>(09 Reviews)</span>
                                            </div>
                                            <!-- Review Star -->

                                            <!-- Separator -->
                                            <div class="my-6 h-px w-full bg-[#E9E5DA]"></div>
                                            <!-- Separator -->
                                            <!-- Bottom Text -->
                                            <div class="flex items-center justify-between">
                                                <span class="font-title text-xl font-bold text-colorPurpleBlue">$275.00</span>
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-graduation-cap-line.svg') }}" alt="icon-grey-graduation-cap-line" width="17" height="17" />
                                                    <span class="flex-1">254 Students</span>
                                                </div>
                                            </div>
                                            <!-- Bottom Text -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Course Item -->
                            </ul>
                            <!-- Course List -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Course Section End :::... -->

            <!--...::: Content Section Start :::... -->
            <section class="section-content">
                <!-- Section Background -->
                <div class="relative z-10">
                    <!-- Section Space -->
                    <div class="section-space-top pb-[286px]">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Content Area -->
                            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-[minmax(0,0.9fr)_1fr] xxl:gap-28">
                                <!-- Content Left Block -->
                                <div class="jos" data-jos_animation="fade-right">
                                    <!-- Section Block -->
                                    <div class="mb-6">
                                        <span class="mb-5 block uppercase">WHY CHOOSE US</span>
                                        <h2>
                                            Transform Your Best Practice with Our Online Course
                                        </h2>
                                    </div>
                                    <!-- Section Block -->
                                    <!-- Content -->
                                    <div class="mt-7">
                                        <p>
                                            Excepteur sint occaecat cupidatat non proident sunt in
                                            culpa qui officia deserunt mollit. Excepteur sint
                                            occaecat.
                                        </p>

                                        <ul class="mt-10 flex flex-col gap-y-10">
                                            <li>
                                                <div class="mb-5 flex items-center gap-x-5">
                                                    <div class="inline-flex h-[60px] w-[60px] items-center justify-center rounded-[50%] bg-colorLightSeaGreen/10">
                                                        <img src="{{ asset('assets-front/img/icons/content-icon-1.svg') }}" alt="content-icon-1" width="25" height="25" />
                                                    </div>
                                                    <span class="flex-1 font-title text-xl font-bold text-colorBlackPearl">Face-to-face Teaching</span>
                                                </div>
                                                <p>
                                                    Excepteur sint occaecat cupidatat non proident sunt
                                                    in culpa qui officia for this is a for that an
                                                    deserunt mollit.
                                                </p>
                                            </li>
                                            <li>
                                                <div class="mb-5 flex items-center gap-x-5">
                                                    <div class="inline-flex h-[60px] w-[60px] items-center justify-center rounded-[50%] bg-colorJasper/10">
                                                        <img src="{{ asset('assets-front/img/icons/content-icon-2.svg') }}" alt="content-icon-2" width="25" height="25" />
                                                    </div>
                                                    <span class="flex-1 font-title text-xl font-bold text-colorBlackPearl">24/7 Support Available</span>
                                                </div>
                                                <p>
                                                    Excepteur sint occaecat cupidatat non proident sunt
                                                    in culpa qui officia for this is a for that an
                                                    deserunt mollit.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Content -->
                                </div>
                                <!-- Content Left Block -->

                                <!-- Content Right Block -->
                                <div class="jos relative z-10" data-jos_animation="fade-left">
                                    <img src="{{ asset('assets-front/img/images/th-1/content-img-1.png') }}" alt="content-img-1" width="586" height="585" class="max-w-full pl-5" />

                                    <!-- Card -->
                                    <div class="jos absolute bottom-[60px] left-0 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-2 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10">
                                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="icon-red-tomato-graduation-cap-line." width="28" height="28" />
                                        </div>
                                        <div class="">
                                            <span class="block font-title text-[28px] font-bold leading-[1.73] text-[#DF4343]">69K+</span>
                                            <span>Satisfied Students</span>
                                        </div>
                                    </div>
                                    <!-- Card -->

                                    <!-- Background Shape -->
                                    <div class="absolute left-0 top-0 -z-10 h-96 w-96 rounded-[50%] bg-[#6FC081] blur-[230px]"></div>
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-orange-1.svg') }}" alt="abstract-orange-1" width="70" height="55" class="absolute left-1 top-[133px]" />
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-3.svg') }}" alt="aabstract-dots-3" width="79" height="50" class="absolute -right-5 bottom-[65px]" />
                                    <!-- Background Shape -->
                                </div>
                                <!-- Content Right Block -->
                            </div>
                            <!-- Content Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Background Elements -->
                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-2.svg') }}" alt="abstract-dots-2" width="49" height="79" class="absolute left-28 top-28 -z-10 hidden animate-pulse xl:inline-block" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-3.svg') }}" alt="abstract-dots-3" width="79" height="50" class="absolute bottom-16 right-96 -z-10 hidden animate-pulse xl:inline-block" />
                    <div class="absolute -left-80 top-1/2 -z-10 h-[457px] w-[457px] -translate-y-1/2 rounded-[50%] bg-[#BFC06F] blur-[230px]"></div>
                    <!-- Background Elements -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Client Logo Section Start :::... -->
            <div class="section-client-logo">
                <!-- Section Background -->
                <div class="bg-white">
                    <!-- Fun-fact Area -->
                    <div class="z-10 -mt-44">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="rounded-lg bg-colorPurpleBlue p-5">
                                <div class="grid grid-cols-1 items-center gap-x-28 gap-y-10 lg:grid-cols-2">
                                    <!-- Countdown Left Block -->
                                    <div class="overflow-hidden rounded-lg">
                                        <img src="{{ asset('assets-front/img/images/th-1/funfact-image.png') }}" alt="funfact-image" width="553" height="315" class="mx-auto max-w-full" />
                                    </div>
                                    <!-- Countdown Left Block -->
                                    <!-- Countdown Right Block -->
                                    <div>
                                        <ul class="grid grid-cols-1 gap-x-[120px] gap-y-6 text-center sm:grid-cols-2 lg:gap-y-16 lg:text-left">
                                            <li>
                                                <div class="mb-2 font-title text-4xl font-bold text-white" data-module="countup">
                                                    <span class="start-number" data-countup-number="5923">5923</span>+
                                                </div>
                                                <span class="text-white/80">Student enrolled</span>
                                            </li>
                                            <li>
                                                <div class="mb-2 font-title text-4xl font-bold text-white" data-module="countup">
                                                    <span class="start-number" data-countup-number="8497">8497</span>+
                                                </div>
                                                <span class="text-white/80">Classes completed</span>
                                            </li>
                                            <li>
                                                <div class="mb-2 font-title text-4xl font-bold text-white" data-module="countup">
                                                    <span class="start-number" data-countup-number="7554">7554</span>+
                                                </div>
                                                <span class="text-white/80">Learners report</span>
                                            </li>
                                            <li>
                                                <div class="mb-2 font-title text-4xl font-bold text-white" data-module="countup">
                                                    <span class="start-number" data-countup-number="2755">2755</span>+
                                                </div>
                                                <span class="text-white/80">Top instructors</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Countdown Right Block -->
                                </div>
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Fun-fact Area -->
                    <!-- Section Space -->
                    <div class="section-space pt-[286px]">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="mx-auto mb-10 max-w-xl lg:mb-[60px]">
                                <p class="text-center text-lg text-colorBlackPearl">
                                    Get in touch with the <strong>250+</strong> companies who
                                    Collaboration us
                                </p>
                            </div>

                            <!-- Slider main container -->
                            <div class="swiper client-slider">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper ease-linear">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-1.png') }}" alt="client-logo-1" width="183" height="40" class="mx-auto" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-2.png') }}" alt="client-logo-2" width="136" height="40" class="mx-auto" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-3.png') }}" alt="client-logo-3" width="98" height="40" class="mx-auto" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-4.png') }}" alt="client-logo-4" width="133" height="40" class="mx-auto" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-5.png') }}" alt="client-logo-5" width="130" height="40" class="mx-auto" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-1.png') }}" alt="client-logo-1" width="183" height="40" class="mx-auto" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-2.png') }}" alt="client-logo-2" width="136" height="40" class="mx-auto" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-3.png') }}" alt="client-logo-3" width="98" height="40" class="mx-auto" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-4.png') }}" alt="client-logo-4" width="133" height="40" class="mx-auto" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets-front/img/images/th-1/client-logo-5.png') }}" alt="client-logo-5" width="130" height="40" class="mx-auto" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </div>
            <!--...::: Client Logo Section End :::... -->

            <!--...::: Testimonial Section Start :::... -->
            <section class="section-testimonial">
                <!-- Section Space -->
                <div class="section-space">
                    <!-- Section Container -->
                    <div class="container">
                        <!-- Testimonial Area -->
                        <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-16 xl:gap-32">
                            <!-- Testimonial Left Block -->
                            <div class="jos" data-jos_animation="fade-left">
                                <!-- Section Block -->
                                <div class="mb-10 lg:mb-[60px]">
                                    <span class="mb-5 block uppercase">OUR TESTIMONIAL</span>
                                    <h2>What Student Say About Our Online Education Course</h2>
                                </div>
                                <!-- Section Block -->

                                <!-- Testimonial Slider -->
                                <div class="rounded-lg bg-white p-8">
                                    <div class="swiper testimonial-slider-1">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            <!-- Slide Item -->
                                            <div class="swiper-slide">
                                                <!-- Review Star -->
                                                <div class="mb-5 inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <!-- Review Star -->
                                                <blockquote class="text-lg">
                                                    “ Attending EduVibe School of Business was one of
                                                    the best decisions I've ever made. The curriculum
                                                    was practical and industry-focused, and I was able
                                                    to apply what I learned in the classroom.”
                                                </blockquote>
                                                <div class="mt-8 flex items-center gap-x-4">
                                                    <div class="h-[43px] w-[43px] overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-1/testimonial-avater-1.png') }}" alt="testimonial-avater-1" width="43" height="43" class="h-full w-full object-cover" />
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span class="block font-title text-xl font-bold text-colorBlackPearl">John Smith</span>
                                                        <span class="block text-sm">Science Student</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Slide Item -->
                                            <!-- Slide Item -->
                                            <div class="swiper-slide">
                                                <!-- Review Star -->
                                                <div class="mb-5 inline-flex items-center gap-x-1">
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                    <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                </div>
                                                <!-- Review Star -->
                                                <blockquote class="text-lg">
                                                    “ Attending EduVibe School of Business was one of
                                                    the best decisions I've ever made. The curriculum
                                                    was practical and industry-focused, and I was able
                                                    to apply what I learned in the classroom.”
                                                </blockquote>
                                                <div class="mt-8 flex items-center gap-x-4">
                                                    <div class="h-[43px] w-[43px] overflow-hidden rounded-[50%]">
                                                        <img src="{{ asset('assets-front/img/images/th-1/testimonial-avater-1.png') }}" alt="testimonial-avater-1" width="43" height="43" class="h-full w-full object-cover" />
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span class="block font-title text-xl font-bold text-colorBlackPearl">John Smith</span>
                                                        <span class="block text-sm">Science Student</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Slide Item -->
                                        </div>

                                        <!-- If we need navigation buttons -->
                                        <div class="absolute bottom-0 right-0 z-10 flex items-center gap-x-[18px]">
                                            <div class="slider-button-prev static opacity-100 transition-all">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-long-arrow-left.svg') }}" alt="icon-purple-long-arrow-left" width="28" height="16" />
                                            </div>
                                            <div class="slider-button-next static opacity-100 transition-all">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-long-arrow-right.svg') }}" alt="icon-purple-long-arrow-right" width="28" height="16" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slider -->
                            </div>
                            <!-- Testimonial Left Block -->

                            <!-- Testimonial Right Block -->
                            <div class="jos relative mx-auto" data-jos_animation="fade-right">
                                <img src="{{ asset('assets-front/img/images/th-1/testimonial-img.png') }}" alt="testimonial-img" width="437" height="520" class="max-w-full" />

                                <!-- Card -->
                                <div class="jos absolute bottom-12 left-16 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-2 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10 xxl:-left-16 xxxl:-left-28">
                                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                        <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="icon-red-tomato-graduation-cap-line." width="28" height="28" />
                                    </div>
                                    <div class="">
                                        <span class="block font-title text-[28px] font-bold leading-[1.73] text-[#DF4343]">667K+</span>
                                        <span>Students worldwide</span>
                                    </div>
                                </div>
                                <!-- Card -->

                                <!-- Background Element -->
                                <img src="{{ asset('assets-front/img/abstracts/abstract-dots-3.svg') }}" alt="abstract-dots-2" class="absolute -right-10 top-1/2 z-20 -translate-y-1/2 animate-pulse" />
                                <!-- Background Element -->
                            </div>
                            <!-- Testimonial Right Block -->
                        </div>
                        <!-- Testimonial Area -->
                    </div>
                    <!-- Section Container -->
                </div>
                <!-- Section Space -->
            </section>
            <!--...::: Testimonial Section End :::... -->

            <!--...::: Blog Section Start :::... -->
            <section class="section-blog">
                <!-- Section Background -->
                <div class="relative z-10 overflow-hidden bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 lg:mb-[60px]">
                                <div class="jos mx-auto max-w-md text-center">
                                    <span class="mb-5 block uppercase">OUR NEWS</span>
                                    <h2>Our New Articles</h2>
                                </div>
                            </div>
                            <!-- Section Block -->

                            <!-- Blog List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                <!-- Blog Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-[10px]">
                                            <img src="{{ asset('assets-front/img/images/th-1/blog-img-1.jpg') }}" alt="blog-img-1" width="370" height="334" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.blog') }}" class="absolute bottom-4 left-4 inline-block rounded-[40px] bg-colorPurpleBlue px-3.5 py-3 text-sm leading-none text-white hover:bg-colorBlackPearl">Education</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7">
                                            <!-- Blog Meta -->
                                            <div class="flex gap-9">
                                                <a href="{{ route('front.blog') }}" class="inline-flex items-center gap-1.5 text-sm hover:underline">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-calendar.svg') }}" alt="icon-grey-calendar" width="23" height="23" />
                                                    <span class="flex-1">09 May, 2024</span>
                                                </a>
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-chat.svg') }}" alt="icon-grey-chat" width="23" height="23" />
                                                    <span class="flex-1">32 Comments</span>
                                                </div>
                                            </div>
                                            <!-- Blog Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.blog.details') }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Solutions Your All Problem With Online Courses For
                                                Your Thinking</a>
                                            <!-- Title Link -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Blog Item -->
                                <!-- Blog Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-[10px]">
                                            <img src="{{ asset('assets-front/img/images/th-1/blog-img-2.jpg') }}" alt="blog-img-2" width="370" height="334" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.blog') }}" class="absolute bottom-4 left-4 inline-block rounded-[40px] bg-colorPurpleBlue px-3.5 py-3 text-sm leading-none text-white hover:bg-colorBlackPearl">Business</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7">
                                            <!-- Blog Meta -->
                                            <div class="flex gap-9">
                                                <a href="{{ route('front.blog') }}" class="inline-flex items-center gap-1.5 text-sm hover:underline">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-calendar.svg') }}" alt="icon-grey-calendar" width="23" height="23" />
                                                    <span class="flex-1">09 January, 2024</span>
                                                </a>
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-chat.svg') }}" alt="icon-grey-chat" width="23" height="23" />
                                                    <span class="flex-1">98 Comments</span>
                                                </div>
                                            </div>
                                            <!-- Blog Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.blog.details') }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Exploring Learning Landscapes in All Academic
                                                Calendar For Season</a>
                                            <!-- Title Link -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Blog Item -->
                                <!-- Blog Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group overflow-hidden rounded-lg transition-all duration-300">
                                        <!-- Thumbnail -->
                                        <div class="relative block overflow-hidden rounded-[10px]">
                                            <img src="{{ asset('assets-front/img/images/th-1/blog-img-3.jpg') }}" alt="blog-img-3" width="370" height="334" class="h-auto w-full transition-all duration-300 group-hover:scale-105" />

                                            <a href="{{ route('front.blog') }}" class="absolute bottom-4 left-4 inline-block rounded-[40px] bg-colorPurpleBlue px-3.5 py-3 text-sm leading-none text-white hover:bg-colorBlackPearl">Marketing</a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="mt-7">
                                            <!-- Blog Meta -->
                                            <div class="flex gap-9">
                                                <a href="{{ route('front.blog') }}" class="inline-flex items-center gap-1.5 text-sm hover:underline">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-calendar.svg') }}" alt="icon-grey-calendar" width="23" height="23" />
                                                    <span class="flex-1">03 June, 2024</span>
                                                </a>
                                                <div class="inline-flex items-center gap-1.5 text-sm">
                                                    <img src="{{ asset('assets-front/img/icons/icon-grey-chat.svg') }}" alt="icon-grey-chat" width="23" height="23" />
                                                    <span class="flex-1">04 Comments</span>
                                                </div>
                                            </div>
                                            <!-- Blog Meta -->
                                            <!-- Title Link -->
                                            <a href="{{ route('front.blog.details') }}" class="my-6 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Voices from the Learning Education Hub For Your
                                                Children</a>
                                            <!-- Title Link -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Blog Item -->
                            </ul>
                            <!-- Blog List -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->

                    <!-- Background Elements -->
                    <div class="absolute -left-80 top-1/2 -z-10 h-[457px] w-[457px] -translate-y-1/2 rounded-[50%] bg-[#BFC06F] blur-[230px]"></div>
                    <div class="absolute -right-40 -top-20 -z-10 h-[457px] w-[457px] -translate-y-1/2 rounded-[50%] bg-[#6FC081] blur-[230px]"></div>
                    <!-- Background Elements -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Blog Section End :::... -->

@endsection
