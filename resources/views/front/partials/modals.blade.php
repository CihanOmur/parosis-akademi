<!-- Sign In Block -->
<div class="signin-block fixed left-1/2 top-1/2 z-50 hidden -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white px-6 py-[30px] sm:px-[75px] lg:py-10 xl:py-[60px]">
    <button class="absolute right-5 top-5 inline-flex h-8 w-8 items-center justify-center bg-colorJasper text-2xl text-white" onclick="hideElement()">
        &times;
    </button>
    <img src="{{ asset('assets-front/img/logo-small.png') }}" alt="logo" width="117" height="28" class="mx-auto" />
    <div class="my-7 text-center">
        <h2 class="mb-3">Giriş Yap</h2>
        <p>
            Hesabınız yok mu?
            <button class="signup-text-btn text-colorPurpleBlue" onclick="signupTextBtn()">
                Kayıt Ol
            </button>
        </p>
    </div>
    <form action="#" method="post" class="grid w-80 grid-cols-1 gap-y-[22px] sm:w-[374px]">
        <input type="text" placeholder="Kullanıcı adınızı girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <input type="password" placeholder="Şifrenizi girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <label for="check-box-signin" class="mt-3.5 flex items-center gap-x-3 text-sm text-[#8D8D8D]">
            <span class="relative">
                <input type="checkbox" name="check-box-signin" id="check-box-signin" class="peer opacity-0" />
                <span class="absolute left-0 top-1/2 inline-block h-4 w-4 -translate-y-1/2 rounded-[50%] border border-colorBlackPearl/75 peer-checked:bg-colorBlackPearl/75"></span>
            </span>
            Beni hatırla
        </label>
        <div>
            <button type="submit" class="btn btn-primary is-icon group">
                Giriş Yap
                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                </span>
                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                </span>
            </button>
        </div>
    </form>
    <span class="mb-7 mt-8 block text-center">Veya şununla giriş yapın</span>
    <div class="flex justify-center gap-2.5">
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-colorJasper/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-google.svg') }}" alt="icon-origin-google" width="24" height="24" />
        </button>
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#1977F3]/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-facebook.svg') }}" alt="icon-origin-facebook" width="24" height="24" />
        </button>
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#0077B5]/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-linkedin.svg') }}" alt="icon-origin-linkedin" width="24" height="24" />
        </button>
    </div>
</div>
<!-- Sign In Block -->

<!-- Sign Up Block -->
<div class="signup-block fixed left-1/2 top-1/2 z-50 hidden -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white px-6 py-[30px] sm:px-[75px] lg:py-10 xl:py-[60px]">
    <button class="absolute right-5 top-5 inline-flex h-8 w-8 items-center justify-center bg-colorJasper text-2xl text-white" onclick="hideElement()">
        &times;
    </button>
    <img src="{{ asset('assets-front/img/logo-small.png') }}" alt="logo" width="117" height="28" class="mx-auto" />
    <div class="my-7 text-center">
        <h2 class="mb-3">Kayıt Ol</h2>
        <p>
            Zaten hesabınız var mı?
            <button class="text-colorPurpleBlue" onclick="signinTextBtn()">
                Giriş Yap
            </button>
        </p>
    </div>
    <form action="#" method="post" class="grid w-80 grid-cols-1 gap-y-[22px] sm:w-[374px]">
        <input type="text" placeholder="Adınızı girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <input type="text" placeholder="Kullanıcı adı girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <input type="email" placeholder="E-posta girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <input type="password" placeholder="Şifre girin" class="w-full rounded border border-[#D7D7D7] px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue" />
        <label for="check-box-signup" class="mt-3.5 flex items-center gap-x-3 text-sm text-[#8D8D8D]">
            <span class="relative">
                <input type="checkbox" name="check-box-signup" id="check-box-signup" class="peer opacity-0" />
                <span class="absolute left-0 top-1/2 inline-block h-4 w-4 -translate-y-1/2 rounded-[50%] border border-colorBlackPearl/75 peer-checked:bg-colorBlackPearl/75"></span>
            </span>
            <strong class="font-medium text-colorBlackPearl/65">Gizlilik Politikası</strong>'nı kabul ediyorum
        </label>
        <div>
            <button type="submit" class="btn btn-primary is-icon group">
                Kayıt Ol
                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                </span>
                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                    <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
                </span>
            </button>
        </div>
    </form>
    <span class="mb-7 mt-8 block text-center">Veya şununla kayıt olun</span>
    <div class="flex justify-center gap-2.5">
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-colorJasper/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-google.svg') }}" alt="icon-origin-google" width="24" height="24" />
        </button>
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#1977F3]/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-facebook.svg') }}" alt="icon-origin-facebook" width="24" height="24" />
        </button>
        <button class="inline-flex h-16 w-16 items-center justify-center rounded-[50%] bg-[#0077B5]/10">
            <img src="{{ asset('assets-front/img/icons/icon-origin-linkedin.svg') }}" alt="icon-origin-linkedin" width="24" height="24" />
        </button>
    </div>
</div>
<!-- Sign Up Block -->

<!-- Offcanvas - Add to cart block -->
<div class="menu-add-to-cart fixed right-0 top-0 z-50 flex h-full w-80 translate-x-full flex-col overflow-y-clip bg-white px-6 py-2 transition-all duration-300 sm:w-96">
    <div>
        <button class="absolute right-0 top-0 inline-flex h-8 w-8 items-center justify-center bg-colorJasper text-2xl text-white" onclick="hideElement()">
            &times;
        </button>
        <h5 class="flex items-center gap-x-2 leading-none">
            <img src="{{ asset('assets-front/img/icons/icon-grey-bag.svg') }}" alt="icon-grey-bag" />
            Sepetim
        </h5>
    </div>
    <ul class="mt-10 grid grid-cols-1 gap-y-5 overflow-y-auto">
        <li class="flex items-center gap-x-4">
            <a href="{{ route('front.product.details') }}" class="h-[65] w-[87px] rounded-[10px]">
                <img src="{{ asset('assets-front/img/images/th-1/product-add-cart-thumb-1.jpg') }}" alt="product-add-cart-thumb-1" width="87" height="65" />
            </a>
            <div class="flex-1">
                <div class="flex items-center justify-between gap-x-2">
                    <div class="text-sm font-medium leading-none text-[#263238]">
                        1 x <span class="text-colorPurpleBlue">$20</span>
                    </div>
                    <button class="text-2xl leading-none text-colorBlackPearl hover:text-colorJasper">&times;</button>
                </div>
                <a href="{{ route('front.product.details') }}" class="font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">34 book demo</a>
            </div>
        </li>
        <li class="flex items-center gap-x-4">
            <a href="{{ route('front.product.details') }}" class="h-[65] w-[87px] rounded-[10px]">
                <img src="{{ asset('assets-front/img/images/th-1/product-add-cart-thumb-2.jpg') }}" alt="product-add-cart-thumb-2" width="87" height="65" />
            </a>
            <div class="flex-1">
                <div class="flex items-center justify-between gap-x-2">
                    <div class="text-sm font-medium leading-none text-[#263238]">
                        1 x <span class="text-colorPurpleBlue">$32</span>
                    </div>
                    <button class="text-2xl leading-none text-colorBlackPearl hover:text-colorJasper">&times;</button>
                </div>
                <a href="{{ route('front.product.details') }}" class="font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">53 book demo</a>
            </div>
        </li>
        <li class="flex items-center gap-x-4">
            <a href="{{ route('front.product.details') }}" class="h-[65] w-[87px] rounded-[10px]">
                <img src="{{ asset('assets-front/img/images/th-1/product-add-cart-thumb-3.jpg') }}" alt="product-add-cart-thumb-3" width="87" height="65" />
            </a>
            <div class="flex-1">
                <div class="flex items-center justify-between gap-x-2">
                    <div class="text-sm font-medium leading-none text-[#263238]">
                        1 x <span class="text-colorPurpleBlue">$98</span>
                    </div>
                    <button class="text-2xl leading-none text-colorBlackPearl hover:text-colorJasper">&times;</button>
                </div>
                <a href="{{ route('front.product.details') }}" class="font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">Degital demo book</a>
            </div>
        </li>
    </ul>
    <div class="sticky bottom-0 mt-auto border-t border-colorBlackPearl/10 bg-white px-6 py-5">
        <div class="flex justify-between font-title text-xl font-bold leading-none text-colorBlackPearl">
            Toplam: <span>$150</span>
        </div>
        <a href="{{ route('front.checkout') }}" class="btn btn-primary mt-6 block border-2 border-colorPurpleBlue font-medium hover:bg-white hover:text-colorPurpleBlue">Ödeme Yap</a>
    </div>
</div>
<!-- Offcanvas - Add to cart block -->

<!-- Offcanvas - Info -->
<div class="menu-info fixed right-0 top-0 z-50 flex h-full w-80 translate-x-full flex-col overflow-y-clip bg-white px-6 py-2 transition-all duration-300 sm:w-96">
    <div>
        <button class="absolute right-0 top-0 inline-flex h-8 w-8 items-center justify-center bg-colorJasper text-2xl text-white" onclick="hideElement()">
            &times;
        </button>
        <a href="{{ route('front.home') }}"><img src="{{ asset('assets-front/img/logo-parosis-akademi.svg') }}" alt="logo" width="137" height="33" /></a>
    </div>
    <div class="mt-10">
        <ul class="grid grid-cols-1 gap-y-10">
            <li>
                <h4 class="mb-3">Bizi Takip Edin:</h4>
                <div class="flex items-center gap-x-3.5">
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
            </li>
            <li>
                <h4 class="mb-3">Bize Ulaşın:</h4>
                <ul class="flex flex-col gap-y-3">
                    <li class="inline-flex gap-x-6">
                        <div class="h-7 w-auto">
                            <img src="{{ asset('assets-front/img/icons/icon-purple-phone-ring.svg') }}" alt="icon-purple-phone-ring" width="28" height="28" />
                        </div>
                        <div class="flex-1">
                            <span class="block">7/24 Destek</span>
                            <a href="tel:+5323213333" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">+532 321 33 33</a>
                        </div>
                    </li>
                    <li class="inline-flex gap-x-6">
                        <div class="h-7 w-auto">
                            <img src="{{ asset('assets-front/img/icons/icon-purple-mail-open.svg') }}" alt="icon-purple-mail-open" width="28" height="28" />
                        </div>
                        <div class="flex-1">
                            <span class="block">Mesaj Gönderin</span>
                            <a href="mailto:info@parosisakademi.com" class="font-title text-lg text-colorBlackPearl hover:underline md:text-xl">info@parosisakademi.com</a>
                        </div>
                    </li>
                    <li class="inline-flex gap-x-6">
                        <div class="h-7 w-auto">
                            <img src="{{ asset('assets-front/img/icons/icon-purple-location.svg') }}" alt="icon-purple-location" width="28" height="28" />
                        </div>
                        <div class="flex-1">
                            <span class="block">Adresimiz</span>
                            <address class="font-title text-xl not-italic text-colorBlackPearl">
                                Istanbul, Turkiye
                            </address>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <h4 class="mb-3">Abone Olun:</h4>
                <form action="#" method="post" class="relative mt-4 text-sm font-medium">
                    <input type="email" class="w-full rounded-[50px] border border-colorPurpleBlue bg-white px-7 py-2.5 outline-none" placeholder="E-posta girin" />
                    <button type="submit" class="mt-4 inline-flex h-11 items-center justify-center gap-x-6 rounded-[50px] border border-colorPurpleBlue bg-colorPurpleBlue px-7 text-white hover:bg-[#4533bb]">
                        Abone Ol
                        <img src="{{ asset('assets-front/img/icons/icon-white-arrow-right.svg') }}" alt="icon-white-arrow-right" width="24" height="16" />
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
<!-- Offcanvas - Info -->
