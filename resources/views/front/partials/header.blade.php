<!--...::: Header Start :::... -->
<div class="{{ ($headerStyle ?? 'inner') === 'home' ? 'absolute left-0 top-0 z-20 w-full' : 'relative z-20' }}">
    <!-- Header Top Area -->
    <div class="{{ ($headerStyle ?? 'inner') === 'home' ? 'bg-transparent' : 'bg-[#fbfbfb]' }} py-4">
        <div class="container-expand">
            <div class="flex items-center gap-x-6 lg:gap-x-10 xl:gap-x-[76px]">
                <!-- Header Logo -->
                <a href="{{ route('front.home') }}" class="inline-flex">
                    <img src="{{ asset('assets-front/img/logo-parosis-akademi.svg') }}" alt="logo" width="137" height="33" />
                </a>
                <!-- Header Right Block -->
                <div class="flex flex-1 items-center justify-end gap-x-4 lg:gap-x-9">
                    <!-- Category & Search Block-->
                    <div class="relative hidden w-full flex-1 rounded-[50px] border bg-white py-3.5 pr-8 text-sm font-medium md:flex xl:pr-36">
                        <div class="flex w-full divide-[#B8B8B8] lg:divide-x">
                            <!-- Search Form Block -->
                            <form action="#" method="get" class="w-full flex-1 px-8">
                                <input type="search" placeholder="Kursunuzu arayın" class="w-full bg-transparent outline-none placeholder:text-colorBlackPearl/55" />
                                <button type="submit" class="absolute bottom-[5px] right-0 top-[5px] mr-[5px] inline-flex items-center justify-center gap-x-2.5 rounded-[50px] bg-colorPurpleBlue px-6 text-center text-sm text-white hover:bg-colorBlackPearl">
                                    <span class="hidden xl:inline-block">Ara</span>
                                    <img src="{{ asset('assets-front/img/icons/icon-white-search-line.svg') }}" alt="icon-white-search-line" width="16" height="16" />
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Category & Search Block-->

                    <!-- Social Links -->
                    <div class="hidden items-center gap-x-3.5 xl:flex">
                        <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="facebook">
                            <img src="{{ asset('assets-front/img/icons/icon-dark-facebook.svg') }}" alt="icon-dark-facebook" width="20" height="20" class="h-auto w-[17px]" />
                        </a>
                        <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" aria-label="twitter">
                            <img src="{{ asset('assets-front/img/icons/icon-dark-twitter.svg') }}" alt="icon-dark-twitter" width="21" height="20" class="h-auto w-[17px]" />
                        </a>
                        <a href="https://www.dribbble.com" target="_blank" rel="noopener noreferrer" aria-label="dribbble">
                            <img src="{{ asset('assets-front/img/icons/icon-dark-dribbble.svg') }}" alt="icon-dark-dribbble" width="21" height="20" class="h-auto w-[17px]" />
                        </a>
                        <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" aria-label="instagram">
                            <img src="{{ asset('assets-front/img/icons/icon-dark-instagram.svg') }}" alt="icon-dark-instagram" width="21" height="20" class="h-auto w-[17px]" />
                        </a>
                    </div>

                    <!-- User Event -->
                    <div class="flex items-center gap-x-2.5">
                        <button class="hidden h-10 rounded-[50Px] bg-colorBrightGold px-6 text-sm font-medium leading-none text-colorBlackPearl hover:shadow sm:inline-block" onclick="signupBtn()">
                            Kayıt Ol
                        </button>
                        <button class="h-10 rounded-[50Px] bg-gradient-to-t from-[#D7E1D8] to-white px-6 text-sm font-medium leading-none text-colorBlackPearl hover:shadow" onclick="signinBtn()">
                            Giriş Yap
                        </button>
                        <!-- Responsive Offcanvas Menu Button -->
                        <div class="site-header inline-block lg:hidden">
                            <button id="openBtn" class="hamburger-menu mobile-menu-trigger">
                                <span class="bg-colorBlackPearl before:bg-colorBlackPearl after:bg-colorBlackPearl"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Top Area -->

    <!-- Header Bottom Area -->
    <header class="site-header bg-white py-0 shadow-[0_4px_30px_16px] shadow-[#070229]/5 {{ ($headerStyle ?? 'inner') === 'home' ? 'z-50' : '' }}">
        <div class="container-expand">
            <div class="flex justify-between text-sm font-medium leading-none text-[#263238]">
                <!-- Header Navigation -->
                <div class="menu-block-wrapper">
                    <div class="menu-overlay"></div>
                    <nav class="menu-block" id="append-menu-header">
                        <div class="mobile-menu-head">
                            <div class="go-back">
                                <img src="{{ asset('assets-front/img/icons/icon-small-dark-chevron-arrow-down.svg') }}" alt="icon-small-dark-chevron-arrow-down" width="9" height="5" class="-rotate-90" />
                            </div>
                            <div class="current-menu-title"></div>
                            <div class="mobile-menu-close">&times;</div>
                        </div>
                        <ul class="site-menu-main">
                            <li class="nav-item nav-item-has-children">
                                <a href="{{ route('front.home') }}" class="nav-link-item drop-trigger rounded-none border border-transparent text-colorBlackPearl">Ana Sayfa</a>
                            </li>
                            <li class="nav-item nav-item-has-children">
                                <a href="#" class="nav-link-item drop-trigger rounded-none border border-transparent text-colorBlackPearl">Kurslar
                                    <img src="{{ asset('assets-front/img/icons/icon-small-dark-chevron-arrow-down.svg') }}" alt="icon-small-dark-chevron-arrow-down" width="9" height="5" class="-rotate-90 lg:rotate-0" />
                                </a>
                                <ul class="sub-menu" id="submenu-2">
                                    <li class="sub-menu--item">
                                        <a href="{{ route('front.courses') }}">Kurslarımız</a>
                                    </li>
                                    <li class="sub-menu--item">
                                        <a href="{{ route('front.course.details') }}">Kurs Detayı</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-has-children">
                                <a href="#" class="nav-link-item drop-trigger rounded-none border border-transparent text-colorBlackPearl">Sayfalar
                                    <img src="{{ asset('assets-front/img/icons/icon-small-dark-chevron-arrow-down.svg') }}" alt="icon-small-dark-chevron-arrow-down" width="9" height="5" class="-rotate-90 lg:rotate-0" />
                                </a>
                                <ul class="sub-menu" id="submenu-3">
                                    <li class="sub-menu--item nav-item-has-children">
                                        <a href="#" data-menu-get="h3" class="drop-trigger">Ürünler
                                            <img src="{{ asset('assets-front/img/icons/icon-small-dark-chevron-arrow-down.svg') }}" alt="icon-small-dark-chevron-arrow-down" width="9" height="5" class="-rotate-90" />
                                        </a>
                                        <ul class="sub-menu shape-none" id="submenu-4">
                                            <li class="sub-menu--item">
                                                <a href="{{ route('front.products') }}">Ürünler</a>
                                            </li>
                                            <li class="sub-menu--item">
                                                <a href="{{ route('front.product.details') }}">Ürün Detayı</a>
                                            </li>
                                            <li class="sub-menu--item">
                                                <a href="{{ route('front.cart') }}">Sepet</a>
                                            </li>
                                            <li class="sub-menu--item">
                                                <a href="{{ route('front.checkout') }}">Ödeme</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="sub-menu--item nav-item-has-children">
                                        <a href="#" data-menu-get="h3" class="drop-trigger">Eğitmenler
                                            <img src="{{ asset('assets-front/img/icons/icon-small-dark-chevron-arrow-down.svg') }}" alt="icon-small-dark-chevron-arrow-down" width="9" height="5" class="-rotate-90" />
                                        </a>
                                        <ul class="sub-menu shape-none" id="submenu-5">
                                            <li class="sub-menu--item">
                                                <a href="{{ route('front.teachers') }}">Eğitmenler</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="sub-menu--item">
                                        <a href="{{ route('front.faq') }}" data-menu-get="h3" class="drop-trigger">SSS</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-has-children">
                                <a href="#" class="nav-link-item drop-trigger rounded-none border border-transparent text-colorBlackPearl">Haberler
                                    <img src="{{ asset('assets-front/img/icons/icon-small-dark-chevron-arrow-down.svg') }}" alt="icon-small-dark-chevron-arrow-down" width="9" height="5" class="-rotate-90 lg:rotate-0" />
                                </a>
                                <ul class="sub-menu" id="submenu-6">
                                    <li class="sub-menu--item">
                                        <a href="{{ route('front.blog') }}">Blog</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('front.about') }}" class="nav-link-item rounded-none border border-transparent text-colorBlackPearl">Hakkımızda</a>
                            </li>
                            <li class="nav-link-item drop-trigger rounded-none border border-transparent text-colorBlackPearl">
                                <a href="{{ route('front.contact') }}" class="nav-link-item">İletişim</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Header Navigation -->

                <!-- Right Block -->
                <div class="flex flex-1 flex-row items-center justify-between gap-x-9 gap-y-3 py-5 lg:justify-end lg:py-0">
                    <div class="flex flex-col gap-x-4 sm:flex-row sm:items-center">
                        <a href="tel:+5323213333" class="text-sm text-[#263238]">+532 321 33 33</a>
                        <div class="h-[5px] w-[5px] flex-1 rounded-[50%] bg-[#263238]/30"></div>
                        <a href="mailto:info@parosisakademi.com" class="text-sm text-[#263238]">info@parosisakademi.com</a>
                    </div>
                    <div class="flex items-center justify-between gap-x-5">
                        <!-- Cart Button -->
                        <button class="relative" onclick="sideAddToCartBtn()">
                            <img src="{{ asset('assets-front/img/icons/icon-grey-bag.svg') }}" alt="icon-grey-bag" width="21" height="21" />
                            <span class="absolute left-2 top-full inline-flex h-[18px] min-w-[18px] -translate-y-3 items-center justify-center rounded-[50%] bg-colorPurpleBlue text-sm font-normal leading-none text-white">3</span>
                        </button>
                        <!-- Side Info Button -->
                        <button onclick="sideInfoBtn()">
                            <img src="{{ asset('assets-front/img/icons/icon-grey-menu-3-line.svg') }}" alt="icon-grey-menu-3-line" width="20" height="20" />
                        </button>
                    </div>
                </div>
                <!-- Right Block -->
            </div>
        </div>
    </header>
    <!-- Header Bottom Area -->
</div>
<!--...::: Header End :::... -->
