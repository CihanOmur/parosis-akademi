{{-- Üyelik sayfalarının başlık şeridi — $title, $current --}}
<section class="section-breadcrum">
    <div class="relative z-10 overflow-hidden" style="background-color: #FAF9F6;">
        <div class="py-[60px] lg:py-[90px]">
            <div class="container">
                <div class="text-center">
                    <h1 class="mb-5 text-4xl capitalize tracking-normal">{{ $title }}</h1>
                    <nav class="text-base font-medium uppercase">
                        <ul class="flex justify-center">
                            <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                <a href="{{ route('front.home') }}">ANA SAYFA</a>
                            </li>
                            <li>{{ $current }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="absolute -left-48 top-0 -z-10 h-[327px] w-[371px] bg-[#BFC06F] blur-[250px]"></div>
        <div class="absolute -right-36 bottom-20 -z-10 h-[327px] w-[371px] bg-[#AAC3E9] blur-[200px]"></div>
        <img src="{{ asset('assets-front/img/abstracts/abstract-purple-dash-1.svg') }}" alt="abstract-purple-dash-1" class="absolute left-56 top-1/2 -z-10 hidden -translate-y-1/2 sm:inline-block" />
        <img src="{{ asset('assets-front/img/abstracts/abstract-element-regular.svg') }}" alt="abstract-element-regular" class="absolute -bottom-14 right-[100px] -z-10 hidden sm:inline-block" />
    </div>
</section>
