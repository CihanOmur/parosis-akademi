@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Kurs Detayı')

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
                                    Course Details
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">HOME</a>
                                        </li>
                                        <li>Course Details</li>
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
            <section class="section-course">
                <div class="bg-white pb-44">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">
                            <!-- Blog Details Area -->
                            <div class="grid grid-cols-1 gap-x-[30px] gap-y-10 lg:grid-cols-[1fr_minmax(0,360px)]">
                                <!-- Blog Details Right Block -->
                                <div class="jos">
                                    <!-- Blog Details Right Block -->
                                    <img src="{{ asset('assets-front/img/images/th-1/course-details-hero-img.jpg') }}" alt="course-details-hero-img" width="783" height="479" class="max-w-full" />
                                    <!-- Blog Details Content Block -->
                                    <div class="rich-text-area mt-11">
                                        <h2>
                                            Starting SEO as your Home Based Business Online Courses
                                        </h2>
                                        <p>
                                            Lorem ipsum dolor sit amet consectur adipisicing elit,
                                            sed do eiusmod tempor inc idid unt ut labore et dolore
                                            magna aliqua enim ad minim veniam, quis nostrud exerec
                                            tation ullamco laboris nis aliquip commodo consequat
                                            duis aute irure dolor in reprehenderit in voluptate
                                            velit esse cillum dolore eu fugiat nulla pariatur enim
                                            ipsam.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet consectur adipisicing elit,
                                            sed do eiusmod tempor inc idid unt ut labore et dolore
                                            magna aliqua enim ad minim veniam, quis nostrud exerec
                                            tation ullamco laboris nis aliquip commodo consequat
                                            duis aute irure dolor in reprehenderit in voluptate
                                            velit esse cillum dolore eu fugiat nulla pariatur enim
                                            ipsam.
                                        </p>

                                        <h5>What You'll Learn?</h5>
                                        <ul class="mb-10 mt-6 flex list-inside list-image-[url(../img/icons/icon-purple-check.svg)] flex-col gap-y-4 font-title text-colorBlackPearl">
                                            <li>
                                                Tempus imperdiet nulla malesuada pellentesque elit
                                                eget gravida cum sociis
                                            </li>
                                            <li>
                                                Neque sodales ut etiam sit amet nisl purus non tellus
                                                orci ac auctor
                                            </li>
                                            <li>
                                                Tristique nulla aliquet enim tortor at auctor urna.
                                                Sit amet aliquam id diam maer
                                            </li>
                                            <li>
                                                Tempus imperdiet nulla malesuada pellentesque elit
                                                eget gravida cum sociis
                                            </li>
                                        </ul>

                                        <img src="{{ asset('assets-front/img/images/th-1/course-details-inner-img.jpg') }}" alt="course-details-inner-img" width="783" height="353" class="max-w-full rounded-lg py-2" />
                                    </div>

                                    <h5>Why choose you this course?</h5>
                                    <ul class="mb-10 mt-6 flex list-inside list-image-[url(../img/icons/icon-purple-check.svg)] flex-col gap-y-4 font-title text-colorBlackPearl">
                                        <li>
                                            Tempus imperdiet nulla malesuada pellentesque elit eget
                                            gravida cum sociis
                                        </li>
                                        <li>
                                            Neque sodales ut etiam sit amet nisl purus non tellus
                                            orci ac auctor
                                        </li>
                                        <li>
                                            Tristique nulla aliquet enim tortor at auctor urna. Sit
                                            amet aliquam id diam maer
                                        </li>
                                        <li>
                                            Tempus imperdiet nulla malesuada pellentesque elit eget
                                            gravida cum sociis
                                        </li>
                                    </ul>
                                </div>
                                <!-- Blog Details Content Block -->

                                <!-- Aside Bar -->
                                <aside class="jos">
                                    <!-- Sidebar List -->
                                    <ul class="grid grid-cols-1 gap-y-9">
                                        <!-- Sidebar Item -->
                                        <li class="rounded-lg bg-[#f5f5f5] px-[30px] py-6">
                                            <h5 class="mb-7">Course Information:</h5>
                                            <!-- Course Information List -->
                                            <ul class="divide-y divide-[#E9E5DA]">
                                                <!-- Course Information Item -->
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]">Price:</span>
                                                    <span class="font-bold text-colorPurpleBlue">$30</span>
                                                </li>
                                                <!-- Course Information Item -->
                                                <!-- Course Information Item -->
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]">Instructor:</span>
                                                    <span class="font-normal">Laura Martinez</span>
                                                </li>
                                                <!-- Course Information Item -->
                                                <!-- Course Information Item -->
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]">Certifications:</span>
                                                    <span class="font-normal">Yes</span>
                                                </li>
                                                <!-- Course Information Item -->
                                                <!-- Course Information Item -->
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]">Lessons:</span>
                                                    <span class="font-normal">17</span>
                                                </li>
                                                <!-- Course Information Item -->
                                                <!-- Course Information Item -->
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]">Duration:</span>
                                                    <span class="font-normal">15 weeks</span>
                                                </li>
                                                <!-- Course Information Item -->
                                                <!-- Course Information Item -->
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]">Language:</span>
                                                    <span class="font-normal">English</span>
                                                </li>
                                                <!-- Course Information Item -->
                                                <!-- Course Information Item -->
                                                <li class="flex items-center justify-between gap-x-5 py-4 first-of-type:pt-0 last-of-type:pb-0">
                                                    <span class="font-semibold text-[#4E5450]">Students:</span>
                                                    <span class="font-normal">646</span>
                                                </li>
                                                <!-- Course Information Item -->
                                            </ul>
                                            <!-- Course Information List -->
                                        </li>
                                        <!-- Sidebar Item -->
                                        <!-- Sidebar Item -->
                                        <li class="rounded-lg bg-[#f5f5f5] px-[30px] py-6">
                                            <h5 class="mb-7">Contact Us</h5>
                                            <!-- COntact Info List -->
                                            <ul class="flex flex-col gap-y-3">
                                                <li class="inline-flex gap-x-6">
                                                    <div class="h-7 w-auto">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-phone-ring.svg') }}" alt="icon-purple-phone-ring" width="28" height="28" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="block">24/7 Support</span>
                                                        <a href="tel:++5323213333" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">+532 321 33 33</a>
                                                    </div>
                                                </li>
                                                <li class="inline-flex gap-x-6">
                                                    <div class="h-7 w-auto">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-mail-open.svg') }}" alt="icon-purple-mail-open" width="28" height="28" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="block">Send Message</span>
                                                        <a href="mailto:yourmail@email.com" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">yourmail@email.com</a>
                                                    </div>
                                                </li>
                                                <li class="inline-flex gap-x-6">
                                                    <div class="h-7 w-auto">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-location.svg') }}" alt="icon-purple-location" width="28" height="28" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="block">Our Locati0n</span>
                                                        <address class="font-title text-xl not-italic text-colorBlackPearl">
                                                            32/Jenin, London
                                                        </address>
                                                    </div>
                                                </li>
                                            </ul>
                                            <!-- COntact Info List -->
                                        </li>
                                        <!-- Sidebar Item -->
                                    </ul>
                                    <!-- Sidebar List -->
                                </aside>
                                <!-- Aside Bar -->
                            </div>
                            <!-- Blog Details Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Course Section End :::... -->
@endsection
