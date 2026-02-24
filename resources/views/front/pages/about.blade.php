@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Hakkımızda')

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
                                    About Us
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">HOME</a>
                                        </li>
                                        <li>ABOUT US</li>
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

            <!--...::: Content Section Start :::... -->
            <section class="section-content">
                <!-- Section Background -->
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Content Area -->
                            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 xxl:gap-44">
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
                                <div class="relative z-10">
                                    <img src="{{ asset('assets-front/img/images/th-3/content-img-1.jpg') }}" alt="content-img-1" width="456" height="465" class="jos ml-auto max-w-full rounded-lg" />
                                    <img src="{{ asset('assets-front/img/images/th-3/content-img-2.jpg') }}" alt="content-img-1" width="355" height="263" class="jos -mt-[106px] max-w-full rounded-lg" />

                                    <!-- Card -->
                                    <div class="jos absolute bottom-[30px] right-0 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-2 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10" data-jos_animation="fade-right">
                                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="icon-red-tomato-graduation-cap-line." width="28" height="28" />
                                        </div>
                                        <div class="">
                                            <span class="block font-title text-[28px] font-bold leading-[1.73] text-[#DF4343]">69K+</span>
                                            <span>Satisfied Students</span>
                                        </div>
                                    </div>
                                    <!-- Card -->

                                    <!-- Background Element -->
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-1.svg') }}" alt="abstract-dots-1" width="49" height="94" class="absolute left-0 top-1/2 -translate-y-1/2 animate-pulse" />
                                    <!-- Background Element -->

                                    <!-- Background Shape -->
                                    <div class="absolute left-0 top-1/2 -z-10 h-96 w-96 -translate-y-1/2 rounded-[50%] bg-[#6FC081] blur-[230px]"></div>
                                    <!-- Background Shape -->
                                </div>
                                <!-- Content Right Block -->
                            </div>
                            <!-- Content Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Course Category Section Start :::... -->
            <section class="section-course-category">
                <div class="relative z-10 lg:pb-[248px]">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container  -->
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 flex flex-wrap items-center justify-between gap-8 lg:mb-[60px]">
                                <div class="jos max-w-xl">
                                    <span class="mb-5 block uppercase">COURSE CATEGORIES</span>
                                    <h2>Top Categories You Want to Learn</h2>
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

                    <!-- Background Element -->
                    <div class="absolute left-[360px] top-60 -z-10 h-[383px] w-[531px] bg-colorBrightGold/25 blur-[250px]"></div>
                    <!-- Background Element -->
                </div>
            </section>
            <!--...::: Course Category Section End :::... -->

            <!--...::: Video Section Start :::... -->
            <div class="section-video">
                <div class="relative z-20 lg:-mt-[248px]">
                    <div class="bg-transparent">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="jos relative flex items-center justify-center">
                                <img src="{{ asset('assets-front/img/images/th-2/video-img.jpg') }}" alt="video-img" width="1170" height="500" class="h-96 w-full rounded-bl-[80px] rounded-tr-[80px] object-cover md:h-auto md:max-w-full" />

                                <a data-fslightbox="gallery" href="https://www.youtube.com/watch?v=3nQNiWdeH2Q" class="absolute inline-flex h-20 w-20 items-center justify-center rounded-[50%] border-[5px] border-colorBrightGold bg-transparent lg:h-[120px] lg:w-[120px]" aria-label="video-play">
                                    <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-play.svg') }}" alt="icon-golden-yellow-play" width="20" height="24" />
                                </a>

                                <!-- Background Element -->
                                <img src="{{ asset('assets-front/img/abstracts/abstract-orange-plus-1.svg') }}" alt="abstract-orange-plus-1" width="75" height="98" class="absolute bottom-0 left-0 z-10" />
                                <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="absolute -right-20 -top-20 -z-10" />

                                <!-- Background Element -->
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                </div>
                <!-- Section Space -->
                <!-- Section Space -->
            </div>
            <!--...::: Video Section End :::... -->

            <!--...::: Client Logo Section Start :::... -->
            <div class="section-client-logo">
                <!-- Section Background -->
                <div class="bg-white lg:-mt-[248px] lg:pt-[248px]">
                    <!-- Section Space -->
                    <div class="section-space">
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

            <!--...::: Content Section Start :::... -->
            <section class="section-content">
                <!-- Section Background -->
                <div class="relative z-10 overflow-hidden bg-colorPurpleBlue">
                    <!-- Section Container -->
                    <div class="container">
                        <!-- Content Area -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-x-28">
                            <!-- Content Left Block -->
                            <div class="relative z-10 order-2 lg:order-1">
                                <img src="{{ asset('assets-front/img/images/th-3/content-img-3.png') }}" alt="content-img-3" width="399" height="543" class="bottom-0 mx-auto max-w-full lg:absolute lg:left-1/2 lg:-translate-x-1/2" />
                                <img src="{{ asset('assets-front/img/abstracts/abstract-dots-4-white.svg') }}" alt="abstract-dots-4-white" width="108" height="67" class="absolute left-0 top-56 -z-10 inline-block" />
                                <div class="absolute bottom-0 left-1/2 -z-10 inline-block h-[470px] w-[470px] -translate-x-1/2 translate-y-1/4 rounded-[50%] bg-white/10 xl:h-[537px] xl:w-[537px]"></div>
                            </div>
                            <!-- Content Left Block -->
                            <!-- Content Right Block -->
                            <div class="order-1 px-6 py-[70px] sm:px-10 lg:order-2 lg:px-0 lg:py-[150px]">
                                <!-- Section Block -->
                                <div class="max-w-[530px]">
                                    <div class="jos">
                                        <span class="mb-5 block uppercase text-colorBrightGold">ONLINE COURSES</span>
                                        <h2 class="text-white">
                                            Find Your Right Learning Path For Your Future
                                        </h2>
                                    </div>
                                    <p class="mb-[30px] mt-7 text-white/80">
                                        Excepteur sint occaecat cupidatat non proident sunt in
                                        culpa qui officia deserunt mollit.
                                    </p>
                                    <div class="inline-block">
                                        <a href="{{ route('front.courses') }}" class="btn btn-secondary is-icon group">Start Learning Today
                                            <span class="btn-icon bg-colorBlackPearl group-hover:right-0 group-hover:translate-x-full">
                                                <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-arrow-right.svg') }}" alt="icon-golden-yellow-arrow-right" width="13" height="12" />
                                            </span>
                                            <span class="btn-icon bg-colorBlackPearl group-hover:left-[5px] group-hover:translate-x-0">
                                                <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-arrow-right.svg') }}" alt="icon-golden-yellow-arrow-right" width="13" height="12" />
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Section Block -->
                            </div>
                            <!-- Content Right Block -->
                        </div>
                        <!-- Content Area -->
                    </div>
                    <!-- Section Container -->
                    <!-- Background Element -->
                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="absolute -top-[77px] left-36 -z-10 rotate-180" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="absolute -bottom-[77px] right-36 -z-10" />
                    <!-- Background Element -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Content Section Start :::... -->
            <section class="section-content">
                <!-- Section Background -->
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Content Area -->
                            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2 lg:gap-16 xl:gap-32">
                                <!-- Content Left Block -->
                                <div class="jos" data-jos_animation="fade-left">
                                    <!-- Section Block -->
                                    <div class="mb-6">
                                        <span class="mb-5 block uppercase">WHY CHOOSE Corwus</span>
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
                                        <ul class="mb-10 mt-6 flex list-inside list-image-[url(../img/icons/icon-purple-check.svg)] flex-col gap-y-4 font-title text-colorBlackPearl">
                                            <li>Our Expert Trainers</li>
                                            <li>Online Remote Learning</li>
                                            <li>Easy to follow curriculum</li>
                                            <li>Lifetime Access</li>
                                        </ul>
                                    </div>
                                    <!-- Content Block -->
                                </div>
                                <!-- Content Left Block -->

                                <!-- Content Right Block -->
                                <div class="jos relative mx-auto" data-jos_animation="fade-right">
                                    <img src="{{ asset('assets-front/img/images/th-3/content-img-4.png') }}" alt="content-img-4" width="482" height="486" class="max-w-full" />
                                    <!-- Card -->
                                    <div class="jos absolute bottom-20 left-16 z-10 inline-flex items-center gap-5 rounded-lg bg-white py-3.5 pl-4 pr-8 shadow-[17px_18px_30px_16px] shadow-[#070229]/10 xxl:-left-16 xxxl:-left-28">
                                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#DF4343]/5">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tamato-emotion-laugh-line.svg') }}" alt="icon-red-tamato-emotion-laugh-line" width="28" height="28" />
                                        </div>
                                        <div>
                                            <span class="block font-title text-[28px] font-bold leading-none text-[#DF4343]">3458+</span>
                                            <span>Satisfied Students</span>
                                        </div>
                                    </div>
                                    <!-- Card -->
                                    <!-- Background Element -->
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-3.svg') }}" alt="abstract-dots-2" class="absolute -left-14 top-1/2 z-20 hidden -translate-y-1/2 animate-pulse lg:inline-block" />
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-golden-yellow-bg-black-dash-1.svg') }}" alt="abstract-dots-2" class="absolute bottom-0 right-0 z-20 hidden lg:inline-block" />
                                    <!-- Background Element -->
                                </div>
                                <!-- Content Right Block -->
                            </div>
                            <!-- Content Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Testimonial Section Start :::... -->
            <section class="section-testimonial">
                <!-- Section Background -->
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space-bottom">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 lg:mb-[60px]">
                                <div class="jos mx-auto max-w-lg text-center">
                                    <span class="mb-5 block uppercase">OUR TESTIMONIAL</span>
                                    <h2>Student Thinking About Us</h2>
                                </div>
                            </div>
                            <!-- Section Block -->
                        </div>
                        <!-- Section Container -->
                        <div class="relative md:-mx-[140px]">
                            <!-- Slider main container -->
                            <div class="swiper testimonial-slider-3">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        <div class="bg-colorJasper/10 p-[30px]">
                                            <!-- Review Star -->
                                            <div class="inline-flex items-center gap-x-1">
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                            </div>
                                            <!-- Review Star -->
                                            <blockquote class="mt-4 text-lg">
                                                " Attending EduVibe School of Business was one of the
                                                best decisions I've ever made. The curriculum was
                                                practical and industry-focused, and I was able to
                                                apply what I learned in the classroom."
                                            </blockquote>

                                            <div class="mt-8 flex items-center gap-x-4">
                                                <div class="h-11 w-11 overflow-hidden rounded-[50%]">
                                                    <img src="{{ asset('assets-front/img/images/th-3/testimonial-img-1.jpg') }}" alt="testimonial-img-1" width="43" height="43" class="h-full w-full object-cover" />
                                                </div>
                                                <div>
                                                    <span class="block font-title text-xl font-bold text-colorBlackPearl">Isaac Ramirez</span>
                                                    <span class="text-sm">Science Student</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="bg-colorLightSeaGreen/10 p-[30px]">
                                            <!-- Review Star -->
                                            <div class="inline-flex items-center gap-x-1">
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                            </div>
                                            <!-- Review Star -->
                                            <blockquote class="mt-4 text-lg">
                                                " Attending EduVibe School of Business was one of the
                                                best decisions I've ever made. The curriculum was
                                                practical and industry-focused, and I was able to
                                                apply what I learned in the classroom."
                                            </blockquote>

                                            <div class="mt-8 flex items-center gap-x-4">
                                                <div class="h-11 w-11 overflow-hidden rounded-[50%]">
                                                    <img src="{{ asset('assets-front/img/images/th-3/testimonial-img-2.jpg') }}" alt="testimonial-img-2" width="43" height="43" class="h-full w-full object-cover" />
                                                </div>
                                                <div>
                                                    <span class="block font-title text-xl font-bold text-colorBlackPearl">Franklin Chen</span>
                                                    <span class="text-sm">Art Student</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="bg-colorPurpleBlue/10 p-[30px]">
                                            <!-- Review Star -->
                                            <div class="inline-flex items-center gap-x-1">
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                            </div>
                                            <!-- Review Star -->
                                            <blockquote class="mt-4 text-lg">
                                                " Attending EduVibe School of Business was one of the
                                                best decisions I've ever made. The curriculum was
                                                practical and industry-focused, and I was able to
                                                apply what I learned in the classroom."
                                            </blockquote>

                                            <div class="mt-8 flex items-center gap-x-4">
                                                <div class="h-11 w-11 overflow-hidden rounded-[50%]">
                                                    <img src="{{ asset('assets-front/img/images/th-3/testimonial-img-3.jpg') }}" alt="testimonial-img-3" width="43" height="43" class="h-full w-full object-cover" />
                                                </div>
                                                <div>
                                                    <span class="block font-title text-xl font-bold text-colorBlackPearl">James Parker</span>
                                                    <span class="text-sm">Math Student</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="bg-colorHotPurple/10 p-[30px]">
                                            <!-- Review Star -->
                                            <div class="inline-flex items-center gap-x-1">
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                            </div>
                                            <!-- Review Star -->
                                            <blockquote class="mt-4 text-lg">
                                                " Attending EduVibe School of Business was one of the
                                                best decisions I've ever made. The curriculum was
                                                practical and industry-focused, and I was able to
                                                apply what I learned in the classroom."
                                            </blockquote>

                                            <div class="mt-8 flex items-center gap-x-4">
                                                <div class="h-11 w-11 overflow-hidden rounded-[50%]">
                                                    <img src="{{ asset('assets-front/img/images/th-3/testimonial-img-4.jpg') }}" alt="testimonial-img-4" width="43" height="43" class="h-full w-full object-cover" />
                                                </div>
                                                <div>
                                                    <span class="block font-title text-xl font-bold text-colorBlackPearl">Charles Morgan</span>
                                                    <span class="text-sm">Globe Student</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="bg-colorJasper/10 p-[30px]">
                                            <!-- Review Star -->
                                            <div class="inline-flex items-center gap-x-1">
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                            </div>
                                            <!-- Review Star -->
                                            <blockquote class="mt-4 text-lg">
                                                " Attending EduVibe School of Business was one of the
                                                best decisions I've ever made. The curriculum was
                                                practical and industry-focused, and I was able to
                                                apply what I learned in the classroom."
                                            </blockquote>

                                            <div class="mt-8 flex items-center gap-x-4">
                                                <div class="h-11 w-11 overflow-hidden rounded-[50%]">
                                                    <img src="{{ asset('assets-front/img/images/th-3/testimonial-img-1.jpg') }}" alt="testimonial-img-1" width="43" height="43" class="h-full w-full object-cover" />
                                                </div>
                                                <div>
                                                    <span class="block font-title text-xl font-bold text-colorBlackPearl">Isaac Ramirez</span>
                                                    <span class="text-sm">Science Student</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="bg-colorLightSeaGreen/10 p-[30px]">
                                            <!-- Review Star -->
                                            <div class="inline-flex items-center gap-x-1">
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                                <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="icon-yellow-star" width="16" height="15" />
                                            </div>
                                            <!-- Review Star -->
                                            <blockquote class="mt-4 text-lg">
                                                " Attending EduVibe School of Business was one of the
                                                best decisions I've ever made. The curriculum was
                                                practical and industry-focused, and I was able to
                                                apply what I learned in the classroom."
                                            </blockquote>

                                            <div class="mt-8 flex items-center gap-x-4">
                                                <div class="h-11 w-11 overflow-hidden rounded-[50%]">
                                                    <img src="{{ asset('assets-front/img/images/th-3/testimonial-img-2.jpg') }}" alt="testimonial-img-2" width="43" height="43" class="h-full w-full object-cover" />
                                                </div>
                                                <div>
                                                    <span class="block font-title text-xl font-bold text-colorBlackPearl">Franklin Chen</span>
                                                    <span class="text-sm">Art Student</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination static mt-14"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Section Space -->
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Testimonial Section End :::... -->

            <!--...::: FAQ Section Start :::... -->
            <section class="section-faq">
                <div class="relative z-20 overflow-hidden bg-white">
                    <!-- Section Space -->
                    <div class="section-space-bottom">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Faq Area -->
                            <div class="grid grid-cols-1 gap-y-10 lg:grid-cols-[1fr_minmax(0,0.9fr)] lg:gap-x-20 xl:gap-x-28">
                                <!-- FAQ Left Block -->
                                <div class="relative z-10 order-2 mx-auto lg:order-1">
                                    <div class="flex items-start gap-7">
                                        <img src="{{ asset('assets-front/img/images/th-2/faq-img-1.png') }}" alt="faq-img-1" width="258" height="440" class="jos max-w-full" />
                                        <div class="hidden md:inline-block">
                                            <img src="{{ asset('assets-front/img/images/th-2/faq-img-2.png') }}" alt="faq-img-2" width="258" height="172" class="jos mb-6 max-w-full xl:mb-14" />
                                            <img src="{{ asset('assets-front/img/images/th-2/faq-img-3.png') }}" alt="faq-img-3" width="258" height="371" class="jos max-w-full" />
                                        </div>
                                    </div>
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="jos absolute bottom-10 left-14 -z-10 hidden rotate-180 sm:inline-block lg:bottom-36 xl:bottom-10" />
                                    <img src="{{ asset('assets-front/img/abstracts/abstract-orange-plus-1.svg') }}" alt="abstract-element-regular" width="75" height="98" class="jos absolute right-14 top-40 hidden rotate-180 xl:inline-block" />
                                </div>
                                <!-- FAQ Left Block -->
                                <!-- FAQ Right Block -->
                                <div class="jos order-1 lg:order-2" data-jos_animation="fade-right">
                                    <!-- Section Block -->
                                    <div class="mb-6">
                                        <span class="mb-5 block uppercase">FREQUENTLY ASKED QUESTIONS</span>
                                        <h2>Most Popular Questions About Our Online Courses</h2>
                                    </div>
                                    <!-- Section Block -->

                                    <!-- Accordion List -->
                                    <ul class="mt-7 grid grid-cols-1 gap-y-4">
                                        <!-- Accordion Item -->
                                        <li class="accordion-item active rounded-lg bg-white px-6 py-5">
                                            <!-- Accordion Header -->
                                            <div class="accordion-header flex items-center justify-between gap-6 font-title text-lg font-bold text-colorBlackPearl">
                                                <button class="flex-1 text-left">
                                                    How can I start with your online class?
                                                </button>
                                                <div class="accordion-icon">
                                                    <img src="{{ asset('assets-front/img/icons/icon-dark-arrow-solid-down.svg') }}" alt="icon-dark-arrow-solid-down" width="13" height="7" />
                                                </div>
                                            </div>
                                            <!-- Accordion Header -->
                                            <!-- Accordion Body -->
                                            <div class="accordion-body">
                                                <p class="pt-5">
                                                    Excepteur sint occaecat cupidatat non proident sunta
                                                    in culpa qui officia for this is a for that tempor.
                                                </p>
                                            </div>
                                            <!-- Accordion Body -->
                                        </li>
                                        <!-- Accordion Item -->
                                        <!-- Accordion Item -->
                                        <li class="accordion-item rounded-lg bg-white px-6 py-5">
                                            <!-- Accordion Header -->
                                            <div class="accordion-header flex items-center justify-between gap-6 font-title text-lg font-bold text-colorBlackPearl">
                                                <button class="flex-1 text-left">
                                                    How can I Kayıt Ol to your website to learn?
                                                </button>
                                                <div class="accordion-icon">
                                                    <img src="{{ asset('assets-front/img/icons/icon-dark-arrow-solid-down.svg') }}" alt="icon-dark-arrow-solid-down" width="13" height="7" />
                                                </div>
                                            </div>
                                            <!-- Accordion Header -->
                                            <!-- Accordion Body -->
                                            <div class="accordion-body">
                                                <p class="pt-5">
                                                    Excepteur sint occaecat cupidatat non proident sunta
                                                    in culpa qui officia for this is a for that tempor.
                                                </p>
                                            </div>
                                            <!-- Accordion Body -->
                                        </li>
                                        <!-- Accordion Item -->
                                        <!-- Accordion Item -->
                                        <li class="accordion-item rounded-lg bg-white px-6 py-5">
                                            <!-- Accordion Header -->
                                            <div class="accordion-header flex items-center justify-between gap-6 font-title text-lg font-bold text-colorBlackPearl">
                                                <button class="flex-1 text-left">
                                                    Can i get lifetime access for your any courses?
                                                </button>
                                                <div class="accordion-icon">
                                                    <img src="{{ asset('assets-front/img/icons/icon-dark-arrow-solid-down.svg') }}" alt="icon-dark-arrow-solid-down" width="13" height="7" />
                                                </div>
                                            </div>
                                            <!-- Accordion Header -->
                                            <!-- Accordion Body -->
                                            <div class="accordion-body">
                                                <p class="pt-5">
                                                    Excepteur sint occaecat cupidatat non proident sunta
                                                    in culpa qui officia for this is a for that tempor.
                                                </p>
                                            </div>
                                            <!-- Accordion Body -->
                                        </li>
                                        <!-- Accordion Item -->
                                        <!-- Accordion Item -->
                                        <li class="accordion-item rounded-lg bg-white px-6 py-5">
                                            <!-- Accordion Header -->
                                            <div class="accordion-header flex items-center justify-between gap-6 font-title text-lg font-bold text-colorBlackPearl">
                                                <button class="flex-1 text-left">
                                                    How can I contact a school directly?
                                                </button>
                                                <div class="accordion-icon">
                                                    <img src="{{ asset('assets-front/img/icons/icon-dark-arrow-solid-down.svg') }}" alt="icon-dark-arrow-solid-down" width="13" height="7" />
                                                </div>
                                            </div>
                                            <!-- Accordion Header -->
                                            <!-- Accordion Body -->
                                            <div class="accordion-body">
                                                <p class="pt-5">
                                                    Excepteur sint occaecat cupidatat non proident sunta
                                                    in culpa qui officia for this is a for that tempor.
                                                </p>
                                            </div>
                                            <!-- Accordion Body -->
                                        </li>
                                        <!-- Accordion Item -->
                                    </ul>
                                    <!-- Accordion List -->
                                </div>
                                <!-- FAQ Right Block -->
                            </div>
                            <!-- Faq Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: FAQ Section End :::... -->

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
                </div>
                <!-- Section Background -->
            </section>
            <!--...::: Blog Section End :::... -->
@endsection
