@extends('front.layouts.app')

@section('title', 'Parosis Akademi | Ürünler')

@section('content')
@php
    $fieldStyles = $shopInfo?->field_styles ?? [];
    $fs = function($field) use ($fieldStyles) {
        $s = $fieldStyles[$field] ?? [];
        $style = '';
        if (!empty($s['fontSize'])) $style .= 'font-size:'.$s['fontSize'].';';
        if (!empty($s['color'])) $style .= 'color:'.$s['color'].';';
        if (isset($s['opacity']) && $s['opacity'] !== '' && intval($s['opacity']) < 100) $style .= 'opacity:'.round(intval($s['opacity']) / 100, 2).';';
        if (!empty($s['fontFamily'])) $style .= 'font-family:'.$s['fontFamily'].';';
        if (!empty($s['fontWeight'])) $style .= 'font-weight:'.$s['fontWeight'].';';
        if (!empty($s['fontStyle'])) $style .= 'font-style:'.$s['fontStyle'].';';
        if (!empty($s['textAlign'])) $style .= 'text-align:'.$s['textAlign'].';';
        return $style;
    };
@endphp
            <!--...::: Breadcrumb Section Start :::... -->
            <section class="section-breadcrum">
                <div class="relative z-10 overflow-hidden bg-[#FAF9F6]">
                    <!-- Section Space -->
                    <div class="py-[60px] lg:py-[90px]">
                        <!-- Section Container -->
                        <div class="container">
                            <div class="text-center">
                                <h1 class="mb-5 text-4xl capitalize tracking-normal" @if($fs('products_title')) style="{{ $fs('products_title') }}" @endif>
                                    {{ $shopInfo->products_title ?? 'Ürünlerimiz' }}
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}" @if($fs('products_breadcrumb_home')) style="{{ $fs('products_breadcrumb_home') }}" @endif>{{ $shopInfo->products_breadcrumb_home ?? 'ANA SAYFA' }}</a>
                                        </li>
                                        <li @if($fs('products_breadcrumb_current')) style="{{ $fs('products_breadcrumb_current') }}" @endif>{{ $shopInfo->products_breadcrumb_current ?? 'ÜRÜNLER' }}</li>
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
            <!--...::: Breadcrumb Section End :::... -->

            <!--...::: Product Section Start :::... -->
            <div class="section-product">
                <div class="bg-white pb-64">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">

                            @if(session('success'))
                            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-6 py-4 text-green-800">
                                {{ session('success') }}
                            </div>
                            @endif

                            <!-- Filters Row -->
                            <div class="mb-8 flex flex-wrap items-center justify-between gap-6">
                                <!-- Category Pills -->
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('front.products') }}"
                                       class="inline-block rounded-full px-4 py-2 text-sm font-medium transition-colors {{ !$categoryId ? 'bg-colorPurpleBlue text-white' : 'bg-[#F5F5F5] text-colorBlackPearl hover:bg-colorPurpleBlue hover:text-white' }}">
                                        <span @if($fs('products_all_text')) style="{{ $fs('products_all_text') }}" @endif>{{ $shopInfo->products_all_text ?? 'Tümü' }}</span> <span class="ml-1 opacity-70">({{ $products->total() }})</span>
                                    </a>
                                    @foreach($categories as $category)
                                    <a href="{{ route('front.products', ['category' => $category->id]) }}"
                                       class="inline-block rounded-full px-4 py-2 text-sm font-medium transition-colors {{ $categoryId == $category->id ? 'bg-colorPurpleBlue text-white' : 'bg-[#F5F5F5] text-colorBlackPearl hover:bg-colorPurpleBlue hover:text-white' }}">
                                        {{ $category->name }}
                                        @if(isset($category->products_count))
                                        <span class="ml-1 opacity-70">({{ $category->products_count }})</span>
                                        @endif
                                    </a>
                                    @endforeach
                                </div>

                                <!-- Search Form -->
                                <form action="{{ route('front.products') }}" method="get" class="w-full md:w-[380px]">
                                    @if($categoryId)
                                    <input type="hidden" name="category" value="{{ $categoryId }}" />
                                    @endif
                                    <div class="relative flex items-center">
                                        <input type="search" name="q" value="{{ $search ?? '' }}" placeholder="{{ $shopInfo->products_search_placeholder ?? 'Ürün arayın...' }}" class="w-full rounded-[50px] border px-8 py-3.5 pr-36 text-sm font-medium outline-none placeholder:text-colorBlackPearl/55" />
                                        <button type="submit" class="absolute bottom-[5px] right-0 top-[5px] mr-[5px] inline-flex items-center justify-center gap-x-2.5 rounded-[50px] bg-colorPurpleBlue px-6 text-center text-sm text-white hover:bg-colorBlackPearl">
                                            <span @if($fs('products_search_button')) style="{{ $fs('products_search_button') }}" @endif>{{ $shopInfo->products_search_button ?? 'Ara' }}</span>
                                            <img src="{{ asset('assets-front/img/icons/icon-white-search-line.svg') }}" alt="icon-white-search-line" width="16" height="16" />
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- Filters Row -->

                            <!-- Product List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-3">
                                @forelse($products as $product)
                                <!-- Product Item -->
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group/product overflow-hidden rounded-lg">
                                        <!-- Thumbnail -->
                                        <div class="relative flex justify-center overflow-hidden rounded-lg" style="aspect-ratio: 370/388;">
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="370" height="388" class="h-full w-full object-cover transition-all duration-300 group-hover/product:scale-105" />
                                            @else
                                                <div class="h-full w-full bg-gray-100 flex items-center justify-center">
                                                    <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                    </svg>
                                                </div>
                                            @endif

                                            @if($product->category)
                                                <span class="absolute left-3 top-3 inline-block rounded-[40px] bg-colorBrightGold px-3.5 py-1.5 text-sm leading-none text-colorBlackPearl">{{ $product->category->name }}</span>
                                            @endif

                                            @if(!$product->variants_count)
                                            <form action="{{ route('front.cart.add') }}" method="POST" class="absolute -bottom-full group-hover/product:bottom-8 transition-all duration-300 add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                                <input type="hidden" name="quantity" value="1" />
                                                <button type="submit" class="btn btn-primary is-icon group" @if($fs('products_add_to_cart')) style="{{ $fs('products_add_to_cart') }}" @endif>
                                                    {{ $shopInfo->products_add_to_cart ?? 'Sepete Ekle' }}
                                                    <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                    </span>
                                                    <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                        <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                    </span>
                                                </button>
                                            </form>
                                            @else
                                            <a href="{{ route('front.product.details', $product->id) }}" class="btn btn-primary is-icon group absolute -bottom-full group-hover/product:bottom-8 transition-all duration-300">
                                                {{ $shopInfo->products_detail_button ?? 'Detay' }}
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                            </a>
                                            @endif
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="px-2 py-8 text-center">
                                            <!-- Title Link -->
                                            <a href="{{ route('front.product.details', $product->id) }}" class="mb-3 block font-title text-xl font-bold text-colorBlackPearl hover:text-colorPurpleBlue">{{ $product->name }}</a>
                                            <!-- Title Link -->
                                            <!-- Price -->
                                            <span class="block font-title text-xl font-bold text-colorPurpleBlue">
                                                @if($product->sale_price)
                                                    {{ number_format($product->sale_price, 2, ',', '.') }} ₺
                                                    <span class="ml-2 font-normal text-[#868686]/50 line-through">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                                                @else
                                                    {{ number_format($product->price, 2, ',', '.') }} ₺
                                                @endif
                                            </span>
                                            <!-- Price -->
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                <!-- Product Item -->
                                @empty
                                <li class="col-span-3 py-16 text-center text-slate-500">
                                    @if($search)
                                        "<strong>{{ $search }}</strong>" için ürün bulunamadı.
                                    @else
                                        <span @if($fs('products_empty_text')) style="{{ $fs('products_empty_text') }}" @endif>{{ $shopInfo->products_empty_text ?? 'Henüz ürün eklenmemiş.' }}</span>
                                    @endif
                                </li>
                                @endforelse
                            </ul>
                            <!-- Product List -->

                            <!-- Pagination -->
                            @if($products->hasPages())
                            <div class="mt-[72px]">
                                {{ $products->links() }}
                            </div>
                            @endif
                            <!-- Pagination -->

                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </div>
            <!--...::: Product Section End :::... -->

@endsection

@push('scripts')
<script>
document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var btn = form.querySelector('button[type="submit"]');
        var origHTML = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<svg class="h-5 w-5 animate-spin mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(new FormData(form))
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.status) {
                // Update sidebar with new item and open it
                if (typeof _sidebarAddItem === 'function') _sidebarAddItem(data);
                if (typeof openCartSidebar === 'function') openCartSidebar();
                // Show success feedback on button
                btn.innerHTML = '<svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg> Eklendi!';
                setTimeout(function() {
                    btn.innerHTML = origHTML;
                    btn.disabled = false;
                }, 1500);
            }
        })
        .catch(function() {
            btn.innerHTML = origHTML;
            btn.disabled = false;
        });
    });
});
</script>
@endpush
