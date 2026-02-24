<!--...::: Footer Section Start :::... -->
<footer class="section-footer">
    <div class="-mt-48">
        <!-- Section Container -->
        <div class="container">
            @php $ctaInfo = $ctaInfo ?? \App\Models\Pages\Contact\ContactPageInfo::first(); @endphp
            <!-- CTA Area -->
            <div class="jos relative z-10 grid grid-cols-1 items-end overflow-hidden rounded-lg bg-colorPurpleBlue lg:grid-cols-[0.8fr_1fr] lg:gap-14">
                <!-- CTA Left Block -->
                <div class="relative order-2 lg:order-1">
                    <img src="{{ $ctaInfo?->cta_image ? asset($ctaInfo->cta_image) : asset('assets-front/img/images/th-1/cta-img.png') }}" alt="cta-img" width="507" height="448" class="static bottom-0 left-0 lg:absolute" />
                </div>
                <!-- CTA Left Block -->
                <!-- CTA Right Block -->
                <div class="order-1 px-6 py-12 sm:px-10 lg:order-2 lg:px-0 xl:py-[90px]">
                    <!-- Section Block -->
                    <div class="max-w-[530px]">
                        <div class="jos">
                            <span class="mb-5 block uppercase text-colorBrightGold">{{ $ctaInfo?->getTranslation('cta_label', app()->getLocale()) ?: 'HEMEN BASLAYIN' }}</span>
                            <h2 class="text-white">
                                {{ $ctaInfo?->getTranslation('cta_title', app()->getLocale()) ?: 'Uygun Fiyatli Online Kurslar & Ogrenme Firsatlari' }}
                            </h2>
                        </div>
                        <p class="mb-[30px] mt-7 text-white/80">
                            {{ $ctaInfo?->getTranslation('cta_description', app()->getLocale()) ?: 'Kariyerinizi bir adim oteye tasiyacak egitimlerle tanismaya hazir misiniz? Hemen kayit olun ve ogrenmeye baslayin.' }}
                        </p>
                        <div class="inline-block">
                            <a href="{{ $ctaInfo?->cta_button_url ?: route('front.courses') }}" class="btn btn-secondary is-icon group">{{ $ctaInfo?->getTranslation('cta_button_text', app()->getLocale()) ?: 'Ogrenmeye Basla' }}
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
                <!-- CTA Right Block -->

                <!-- Background Element -->
                <img src="{{ asset('assets-front/img/abstracts/abstract-golden-yellow-dash-2.svg') }}" alt="abstract-golden-yellow-dash-2" width="44" height="37" class="absolute left-[400px] top-16 -z-10" />
                <img src="{{ asset('assets-front/img/abstracts/curve-1.svg') }}" alt="curve-1" width="155" height="155" class="absolute left-6 top-14 z-10 hidden lg:inline-block" />
                <img src="{{ asset('assets-front/img/abstracts/abstract-dots-4-white.svg') }}" alt="abstract-dots-4-white" width="108" height="67" class="absolute bottom-0 right-0 -z-10" />
                <!-- Background Element -->
            </div>
            <!-- CTA Area -->
        </div>
        <!-- Section Container -->
    </div>

    <!-- Footer Top -->
    <div class="relative z-10 overflow-hidden">
        <!-- Section Space -->
        <div class="section-space">
            <!-- Section Container -->
            <div class="container">
                <!-- Footer Area -->
                <div class="grid grid-cols-1 flex-wrap justify-between gap-10 sm:grid-cols-2 lg:flex">
                    <!-- Footer Widget - About -->
                    <div class="max-w-[298px]">
                        <a href="{{ route('front.home') }}" class="">
                            <img src="{{ asset('assets-front/img/logo-parosis-akademi.svg') }}" alt="logo" width="137" height="33" />
                        </a>
                        <p class="mb-8 mt-8">
                            Gelecegin teknolojisine yon veren akademi. Kariyerinizi bir adim oteye tasiyin.
                        </p>
                        <!-- Social Links -->
                        <div class="flex items-center gap-x-6">
                            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="facebook">
                                <img src="{{ asset('assets-front/img/icons/icon-dark-facebook.svg') }}" alt="icon-dark-facebook" width="20" height="20" />
                            </a>
                            <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" aria-label="twitter">
                                <img src="{{ asset('assets-front/img/icons/icon-dark-twitter.svg') }}" alt="icon-dark-twitter" width="21" height="20" />
                            </a>
                            <a href="https://www.dribbble.com" target="_blank" rel="noopener noreferrer" aria-label="dribbble">
                                <img src="{{ asset('assets-front/img/icons/icon-dark-dribbble.svg') }}" alt="icon-dark-dribbble" width="21" height="20" />
                            </a>
                            <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" aria-label="instagram">
                                <img src="{{ asset('assets-front/img/icons/icon-dark-instagram.svg') }}" alt="icon-dark-instagram" width="21" height="20" />
                            </a>
                        </div>
                        <!-- Social Links -->
                    </div>
                    <!-- Footer Widget - About -->

                    <!-- Footer Widget - Nav -->
                    <div>
                        <!-- Footer Title -->
                        <span class="mb-8 block font-title text-xl font-bold text-colorBlackPearl">Baglantilar</span>
                        <!-- Footer Title -->

                        <!-- Footer Nav List -->
                        <ul class="flex flex-col gap-y-3">
                            <li>
                                <a href="{{ route('front.about') }}" class="hover:text-colorBlackPearl hover:underline">Hakkimizda</a>
                            </li>
                            <li>
                                <a href="{{ route('front.courses') }}" class="hover:text-colorBlackPearl hover:underline">Kurslarimiz</a>
                            </li>
                            <li>
                                <a href="#" class="hover:text-colorBlackPearl hover:underline">Fiyatlandirma</a>
                            </li>
                            <li>
                                <a href="{{ route('front.contact') }}" class="hover:text-colorBlackPearl hover:underline">Iletisim</a>
                            </li>
                            <li>
                                <a href="{{ route('front.blog') }}" class="hover:text-colorBlackPearl hover:underline">Haberler</a>
                            </li>
                            <li>
                                <a href="{{ route('front.faq') }}" class="hover:text-colorBlackPearl hover:underline">SSS</a>
                            </li>
                        </ul>
                        <!-- Footer Nav List -->
                    </div>
                    <!-- Footer Widget - Nav -->

                    <!-- Footer Widget - Info -->
                    @php $footerContact = \App\Models\Pages\Contact\ContactPageInfo::first(); @endphp
                    <div>
                        <!-- Footer Title -->
                        <span class="mb-8 block font-title text-xl font-bold text-colorBlackPearl">Iletisim</span>
                        <!-- Footer Title -->

                        <!-- Footer Info List -->
                        <ul class="flex flex-col gap-y-3">
                            <li class="inline-flex gap-x-6">
                                <div class="h-7 w-auto">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-phone-ring.svg') }}" alt="icon-purple-phone-ring" width="28" height="28" />
                                </div>
                                <div class="flex-1">
                                    <span class="block">7/24 Destek</span>
                                    <a href="tel:{{ preg_replace('/\s+/', '', $footerContact?->phone_1 ?? '+5323213333') }}" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">{{ $footerContact?->phone_1 ?? '+532 321 33 33' }}</a>
                                </div>
                            </li>
                            <li class="inline-flex gap-x-6">
                                <div class="h-7 w-auto">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-mail-open.svg') }}" alt="icon-purple-mail-open" width="28" height="28" />
                                </div>
                                <div class="flex-1">
                                    <span class="block">Mesaj Gonderin</span>
                                    <a href="mailto:{{ $footerContact?->email_1 ?? 'info@parosisakademi.com' }}" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">{{ $footerContact?->email_1 ?? 'info@parosisakademi.com' }}</a>
                                </div>
                            </li>
                            <li class="inline-flex gap-x-6">
                                <div class="h-7 w-auto">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-location.svg') }}" alt="icon-purple-location" width="28" height="28" />
                                </div>
                                <div class="flex-1">
                                    <span class="block">Adresimiz</span>
                                    <address class="font-title text-xl not-italic text-colorBlackPearl">
                                        {{ $footerContact?->address_line_1 ?? 'Istanbul, Turkiye' }}
                                    </address>
                                </div>
                            </li>
                        </ul>
                        <!-- Footer Info List -->
                    </div>
                    <!-- Footer Widget - Info -->

                    <!-- Footer Widget - Newsletter -->
                    <div class="md:max-w-80">
                        <!-- Footer Title -->
                        <span class="mb-8 block font-title text-xl font-bold text-colorBlackPearl">Abone Olun</span>
                        <!-- Footer Title -->

                        <p>
                            Bultenimize abone olmak icin e-posta adresinizi girin
                        </p>
                        <form action="#" method="post" class="mt-4 text-sm font-medium">
                            <input type="email" class="w-full rounded-[50px] border border-[#EBEBEB] bg-white px-7 py-3.5 outline-none" placeholder="E-posta girin" />
                            <button type="submit" class="btn btn-primary is-icon group mt-[10px]">
                                Abone Ol
                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                                </span>
                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                                </span>
                            </button>
                        </form>
                    </div>
                    <!-- Footer Widget - Newsletter -->
                </div>
                <!-- Footer Area -->
            </div>
            <!-- Section Container -->
        </div>
        <!-- Section Space -->

        <!-- Background Element -->
        <img src="{{ asset('assets-front/img/abstracts/footer-element-1.svg') }}" alt="footer-element-1" width="119" height="121" class="absolute bottom-40 left-0 -z-10 hidden lg:inline-block" />
        <img src="{{ asset('assets-front/img/abstracts/footer-element-2.svg') }}" alt="footer-element-2" width="101" height="92" class="absolute right-64 top-72 -z-10 hidden lg:inline-block" />
        <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" width="133" height="154" class="absolute -right-9 bottom-0 -z-10 hidden lg:inline-block" />
        <!-- Background Element -->
    </div>
    <!-- Footer Top -->

    <!-- Footer Bottom -->
    <div class="bg-[#F5F5F5] py-6 text-center text-sm">
        Copyright {{ date('Y') }} Parosis Akademi | Tum Haklari Saklidir
    </div>
    <!-- Footer Bottom -->
</footer>
<!--...::: Footer Section End :::... -->
