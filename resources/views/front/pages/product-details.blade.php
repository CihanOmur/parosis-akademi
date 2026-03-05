@extends('front.layouts.app')

@section('title', 'Parosis Akademi | ' . e($product->name))

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
                                    Ürün Detayı
                                </h1>
                                <nav class="text-base font-medium uppercase">
                                    <ul class="flex justify-center">
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.home') }}">ANA SAYFA</a>
                                        </li>
                                        <li class="relative has-[a]:text-colorJasper has-[a]:after:text-colorCarbonGrey has-[a]:after:content-['/']">
                                            <a href="{{ route('front.products') }}">ÜRÜNLER</a>
                                        </li>
                                        <li>{{ Str::limit($product->name, 40) }}</li>
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

            <!--...::: Product Detail Section Start :::... -->
            <section class="section-course">
                <div class="bg-white">
                    <!-- Section Space -->
                    <div class="section-space">
                        <!-- Section Container -->
                        <div class="container">

                            @if(session('success'))
                            <div class="mb-8 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-6 py-4 text-green-800">
                                <svg class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('success') }}
                            </div>
                            @endif

                            <!-- Product Area -->
                            @php
                                $allImages = $product->image ? [$product->image] : [];
                                foreach ($product->images as $gi) {
                                    $allImages[] = $gi->image;
                                }
                                $mainImage = $allImages[0] ?? null;
                            @endphp

                            <div class="grid grid-cols-1 items-start gap-10 lg:grid-cols-2 lg:gap-16 xl:gap-20">

                                <!-- ============ LEFT: Gallery ============ -->
                                <div class="jos lg:sticky lg:top-28" data-jos_animation="fade-right">
                                    <div class="relative">
                                        <!-- Sale Badge -->
                                        @if($product->sale_price)
                                        <div class="absolute left-4 top-4 z-10 rounded-full bg-colorJasper px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-white shadow-lg shadow-colorJasper/30">
                                            %{{ round((($product->price - $product->sale_price) / $product->price) * 100) }} İndirim
                                        </div>
                                        @endif

                                        <!-- Main Image -->
                                        @if($mainImage)
                                            <div class="group relative overflow-hidden rounded-2xl bg-[#FAF9F6]">
                                                <img id="main-product-image"
                                                     src="{{ asset($mainImage) }}"
                                                     alt="{{ $product->name }}"
                                                     class="aspect-square w-full object-cover transition-transform duration-500 group-hover:scale-105" />

                                                <!-- Lightbox button -->
                                                <a href="{{ asset($mainImage) }}" data-fslightbox="product-gallery"
                                                   id="lightbox-trigger"
                                                   class="absolute bottom-4 right-4 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-colorBlackPearl shadow-md backdrop-blur-sm transition-all hover:bg-colorPurpleBlue hover:text-white">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        @else
                                            <div class="flex aspect-square w-full items-center justify-center rounded-2xl bg-[#FAF9F6]">
                                                <svg class="h-24 w-24 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Thumbnails -->
                                    @if(count($allImages) > 1)
                                    <div class="mt-4 grid grid-cols-5 gap-3 sm:grid-cols-6 lg:grid-cols-5">
                                        @foreach($allImages as $index => $img)
                                        <button type="button"
                                                onclick="swapMainImage('{{ asset($img) }}')"
                                                class="gallery-thumb group/thumb aspect-square overflow-hidden rounded-xl border-2 transition-all duration-200 {{ $index === 0 ? 'border-colorPurpleBlue ring-2 ring-colorPurpleBlue/20' : 'border-transparent hover:border-colorPurpleBlue/50' }}">
                                            <img src="{{ asset($img) }}"
                                                 alt="{{ $product->name }} - {{ $index + 1 }}"
                                                 class="h-full w-full object-cover transition-transform duration-300 group-hover/thumb:scale-110" />
                                        </button>
                                        @endforeach
                                    </div>

                                    <!-- Hidden lightbox links for gallery -->
                                    @foreach($allImages as $index => $img)
                                        @if($index > 0)
                                        <a href="{{ asset($img) }}" data-fslightbox="product-gallery" class="hidden"></a>
                                        @endif
                                    @endforeach
                                    @endif
                                </div>
                                <!-- ============ LEFT: Gallery END ============ -->

                                <!-- ============ RIGHT: Product Info ============ -->
                                <div class="jos" data-jos_animation="fade-left">
                                    <!-- Categories -->
                                    @if($product->categories->count())
                                    <div class="mb-4 flex flex-wrap gap-2">
                                        @foreach($product->categories as $cat)
                                        <a href="{{ route('front.products', ['kategori' => $cat->id]) }}"
                                           class="inline-flex items-center rounded-full bg-colorPurpleBlue/8 px-3 py-1 text-xs font-semibold text-colorPurpleBlue transition-colors hover:bg-colorPurpleBlue/15">
                                            {{ $cat->name }}
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif

                                    <!-- Product Name -->
                                    <h1 class="mb-5 font-title text-3xl font-bold leading-tight text-colorBlackPearl lg:text-4xl">
                                        {{ $product->name }}
                                    </h1>

                                    <!-- Price Block -->
                                    <div class="mb-6 flex items-baseline gap-3">
                                        @if($product->sale_price)
                                            <span id="product-price" class="font-title text-3xl font-bold text-colorPurpleBlue">
                                                {{ number_format($product->sale_price, 2, ',', '.') }} ₺
                                            </span>
                                            <span id="product-original-price" class="text-lg font-medium text-[#868686]/60 line-through decoration-colorJasper/50">
                                                {{ number_format($product->price, 2, ',', '.') }} ₺
                                            </span>
                                        @else
                                            <span id="product-price" class="font-title text-3xl font-bold text-colorPurpleBlue">
                                                {{ number_format($product->price, 2, ',', '.') }} ₺
                                            </span>
                                            <span id="product-original-price" class="hidden"></span>
                                        @endif
                                    </div>

                                    <!-- Divider -->
                                    <div class="mb-6 h-px w-full bg-colorBlackPearl/8"></div>

                                    <!-- Short Description -->
                                    @if($product->short_description)
                                    <div class="mb-6 text-[15px] leading-relaxed text-colorCarbonGrey">
                                        {!! nl2br(e($product->short_description)) !!}
                                    </div>
                                    @endif

                                    <!-- Variant Selectors -->
                                    @if($product->variants && $product->variants->count() && !empty($attributeMap))
                                    <div id="variant-selector" class="mb-6 space-y-5">
                                        @foreach($attributeMap as $attrId => $attrData)
                                        <div class="variant-group" data-attribute="{{ $attrData['name'] }}">
                                            <label class="mb-3 block text-sm font-bold uppercase tracking-wider text-colorBlackPearl/70">
                                                {{ $attrData['name'] }}
                                            </label>
                                            <div class="flex flex-wrap gap-2.5">
                                                @foreach($attrData['values'] as $value)
                                                @if(!empty($value['color_code']))
                                                    <!-- Color Swatch -->
                                                    <button type="button"
                                                            onclick="selectVariantValue({{ $attrId }}, {{ $value['id'] }}, this)"
                                                            data-attr-id="{{ $attrId }}"
                                                            data-value-id="{{ $value['id'] }}"
                                                            title="{{ $value['name'] }}"
                                                            class="variant-btn group/color relative h-10 w-10 rounded-full border-2 border-gray-200 shadow-sm ring-2 ring-offset-2 ring-transparent transition-all duration-200 hover:ring-colorPurpleBlue/60 hover:scale-110"
                                                            style="background-color: {{ $value['color_code'] }};">
                                                        <span class="pointer-events-none absolute -bottom-7 left-1/2 -translate-x-1/2 whitespace-nowrap rounded bg-colorBlackPearl px-2 py-0.5 text-[10px] font-medium text-white opacity-0 transition-opacity group-hover/color:opacity-100">
                                                            {{ $value['name'] }}
                                                        </span>
                                                    </button>
                                                @else
                                                    <!-- Value Button -->
                                                    <button type="button"
                                                            onclick="selectVariantValue({{ $attrId }}, {{ $value['id'] }}, this)"
                                                            data-attr-id="{{ $attrId }}"
                                                            data-value-id="{{ $value['id'] }}"
                                                            class="variant-btn rounded-xl border-2 border-colorBlackPearl/12 bg-white px-5 py-2.5 text-sm font-semibold text-colorBlackPearl transition-all duration-200 hover:border-colorPurpleBlue hover:text-colorPurpleBlue">
                                                        {{ $value['name'] }}
                                                    </button>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

                                    <!-- Stock Status -->
                                    <div id="stock-status" class="mb-4 hidden">
                                        <div class="inline-flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm font-medium">
                                            <span class="stock-dot h-2 w-2 rounded-full"></span>
                                            <span class="stock-text"></span>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Form -->
                                    <form action="{{ route('front.cart.add') }}" method="POST" id="add-to-cart-form" onsubmit="return addToCartAjax(event)">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                        <input type="hidden" name="variant_id" id="selected-variant-id" value="" />

                                        <div class="flex flex-wrap items-center gap-4">
                                            <!-- Quantity Selector -->
                                            <div class="inline-flex items-center overflow-hidden rounded-full border-2 border-colorBlackPearl/10">
                                                <button type="button" onclick="changeQty(-1)"
                                                        class="flex h-12 w-12 items-center justify-center text-lg font-medium text-colorBlackPearl transition-colors hover:bg-colorPurpleBlue/5 hover:text-colorPurpleBlue">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                                                    </svg>
                                                </button>
                                                <input type="number" name="quantity" id="qty-input" value="1" min="1"
                                                       class="qty-no-spinner h-12 w-14 border-x-2 border-colorBlackPearl/10 bg-transparent text-center text-base font-semibold text-colorBlackPearl outline-none" />
                                                <button type="button" onclick="changeQty(1)"
                                                        class="flex h-12 w-12 items-center justify-center text-lg font-medium text-colorBlackPearl transition-colors hover:bg-colorPurpleBlue/5 hover:text-colorPurpleBlue">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Add to Cart Button -->
                                            <button type="submit"
                                                    id="add-to-cart-btn"
                                                    @if($product->variants && $product->variants->count()) disabled @endif
                                                    class="btn btn-primary is-icon group flex-1 disabled:cursor-not-allowed disabled:opacity-50 sm:flex-none">
                                                Sepete Ekle
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Divider -->
                                    <div class="my-8 h-px w-full bg-colorBlackPearl/8"></div>

                                    <!-- Product Meta -->
                                    @php $firstCategory = $product->categories->first(); @endphp
                                    <div class="space-y-3 text-sm">
                                        @if($product->sku)
                                        <div class="flex items-center gap-3">
                                            <span class="font-semibold text-colorBlackPearl/70">SKU:</span>
                                            <span class="font-mono text-colorCarbonGrey">{{ $product->sku }}</span>
                                        </div>
                                        @endif
                                        @if($firstCategory)
                                        <div class="flex items-center gap-3">
                                            <span class="font-semibold text-colorBlackPearl/70">Kategori:</span>
                                            <a href="{{ route('front.products', ['kategori' => $firstCategory->id]) }}"
                                               class="text-colorPurpleBlue transition-colors hover:underline">
                                                {{ $firstCategory->name }}
                                            </a>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Trust Badges -->
                                    <div class="mt-8 grid grid-cols-3 gap-3">
                                        <div class="flex flex-col items-center gap-2 rounded-xl bg-[#FAF9F6] p-4 text-center">
                                            <svg class="h-6 w-6 text-colorPurpleBlue" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                                            </svg>
                                            <span class="text-[11px] font-semibold leading-tight text-colorBlackPearl/70">Hızlı Kargo</span>
                                        </div>
                                        <div class="flex flex-col items-center gap-2 rounded-xl bg-[#FAF9F6] p-4 text-center">
                                            <svg class="h-6 w-6 text-colorPurpleBlue" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                                            </svg>
                                            <span class="text-[11px] font-semibold leading-tight text-colorBlackPearl/70">Güvenli Ödeme</span>
                                        </div>
                                        <div class="flex flex-col items-center gap-2 rounded-xl bg-[#FAF9F6] p-4 text-center">
                                            <svg class="h-6 w-6 text-colorPurpleBlue" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182"/>
                                            </svg>
                                            <span class="text-[11px] font-semibold leading-tight text-colorBlackPearl/70">Kolay İade</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- ============ RIGHT: Product Info END ============ -->
                            </div>
                            <!-- Product Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Product Detail Section End :::... -->

            <!--...::: Product Tabs Section Start :::... -->
            @php
                $hasDescription = !empty($product->description);
                $hasFeatures = false;
                $featuresData = [];
                if ($product->features) {
                    $decoded = json_decode($product->features, true);
                    if (is_array($decoded) && count($decoded) > 0) {
                        $featuresData = array_filter($decoded, fn($f) => !empty($f['key']));
                        $hasFeatures = count($featuresData) > 0;
                    }
                }
            @endphp

            @if($hasDescription || $hasFeatures)
            <section class="section-tabs">
                <div class="bg-white">
                    <div class="section-space-bottom">
                        <div class="container">
                            <!-- Tab Navigation -->
                            <div class="mb-8 flex gap-1 border-b-2 border-colorBlackPearl/8" id="product-tabs">
                                @if($hasDescription)
                                <button type="button"
                                        onclick="switchTab('description')"
                                        class="product-tab relative px-6 py-4 text-sm font-bold uppercase tracking-wider text-colorBlackPearl/50 transition-colors hover:text-colorBlackPearl active"
                                        data-tab="description">
                                    <span class="flex items-center gap-2">
                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                                        </svg>
                                        Açıklama
                                    </span>
                                    <span class="tab-indicator absolute bottom-[-2px] left-0 h-[2px] w-full bg-colorPurpleBlue transition-all"></span>
                                </button>
                                @endif
                                @if($hasFeatures)
                                <button type="button"
                                        onclick="switchTab('features')"
                                        class="product-tab relative px-6 py-4 text-sm font-bold uppercase tracking-wider text-colorBlackPearl/50 transition-colors hover:text-colorBlackPearl {{ !$hasDescription ? 'active' : '' }}"
                                        data-tab="features">
                                    <span class="flex items-center gap-2">
                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"/>
                                        </svg>
                                        Özellikler
                                    </span>
                                    <span class="tab-indicator absolute bottom-[-2px] left-0 h-[2px] w-full bg-colorPurpleBlue transition-all {{ !$hasDescription ? '' : 'opacity-0' }}"></span>
                                </button>
                                @endif
                            </div>

                            <!-- Tab Panels -->
                            @if($hasDescription)
                            <div id="tab-description" class="tab-panel">
                                <div class="rich-text-area text-base leading-relaxed text-colorCarbonGrey">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>
                            @endif

                            @if($hasFeatures)
                            <div id="tab-features" class="tab-panel {{ $hasDescription ? 'hidden' : '' }}">
                                <div class="overflow-hidden rounded-2xl border border-colorBlackPearl/8">
                                    @foreach($featuresData as $index => $feature)
                                    <div class="flex items-center {{ $index % 2 === 0 ? 'bg-[#FAF9F6]' : 'bg-white' }} {{ $index > 0 ? 'border-t border-colorBlackPearl/6' : '' }}">
                                        <div class="w-2/5 px-6 py-4 text-sm font-bold text-colorBlackPearl sm:w-1/3">
                                            {{ $feature['key'] }}
                                        </div>
                                        <div class="w-3/5 px-6 py-4 text-sm text-colorCarbonGrey sm:w-2/3">
                                            {{ $feature['value'] }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
            @endif
            <!--...::: Product Tabs Section End :::... -->

            <!--...::: Related Products Section Start :::... -->
            @if($relatedProducts && count($relatedProducts))
            <section class="section-course">
                <div class="bg-[#FAF9F6] pb-64">
                    <div class="section-space">
                        <div class="container">
                            <!-- Section Heading -->
                            <div class="mb-10 lg:mb-14">
                                <div class="jos mx-auto max-w-lg text-center">
                                    <span class="mb-4 block text-sm font-semibold uppercase tracking-widest text-colorPurpleBlue">Keşfedin</span>
                                    <h2 class="font-title text-3xl font-bold text-colorBlackPearl lg:text-4xl">Benzer Ürünler</h2>
                                </div>
                            </div>

                            <!-- Related Products Grid -->
                            <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:gap-8 xl:grid-cols-4">
                                @foreach($relatedProducts as $related)
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group/product overflow-hidden rounded-2xl bg-white shadow-sm transition-shadow duration-300 hover:shadow-xl hover:shadow-colorPurpleBlue/5">
                                        <!-- Thumbnail -->
                                        <div class="relative aspect-square overflow-hidden">
                                            @if($related->image)
                                                <img src="{{ asset($related->image) }}"
                                                     alt="{{ $related->name }}"
                                                     class="h-full w-full object-cover transition-transform duration-500 group-hover/product:scale-110" />
                                            @else
                                                <div class="flex h-full w-full items-center justify-center bg-[#FAF9F6]">
                                                    <svg class="h-14 w-14 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                    </svg>
                                                </div>
                                            @endif

                                            <!-- Sale badge -->
                                            @if($related->sale_price)
                                            <span class="absolute left-3 top-3 rounded-full bg-colorJasper px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white">
                                                İndirim
                                            </span>
                                            @endif

                                            <!-- Hover overlay -->
                                            <div class="absolute inset-0 flex items-center justify-center bg-colorBlackPearl/0 transition-all duration-300 group-hover/product:bg-colorBlackPearl/20">
                                                <a href="{{ route('front.product.details', $related->id) }}"
                                                   class="translate-y-4 rounded-full bg-white px-6 py-2.5 text-sm font-bold text-colorPurpleBlue opacity-0 shadow-xl transition-all duration-300 hover:bg-colorPurpleBlue hover:text-white group-hover/product:translate-y-0 group-hover/product:opacity-100">
                                                    İncele
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Content -->
                                        <div class="p-5">
                                            <a href="{{ route('front.product.details', $related->id) }}"
                                               class="mb-2 block font-title text-base font-bold text-colorBlackPearl transition-colors hover:text-colorPurpleBlue line-clamp-2">
                                                {{ $related->name }}
                                            </a>
                                            <div class="flex items-baseline gap-2">
                                                @if($related->sale_price)
                                                    <span class="font-title text-lg font-bold text-colorPurpleBlue">{{ number_format($related->sale_price, 2, ',', '.') }} ₺</span>
                                                    <span class="text-xs font-medium text-[#868686]/50 line-through">{{ number_format($related->price, 2, ',', '.') }} ₺</span>
                                                @else
                                                    <span class="font-title text-lg font-bold text-colorPurpleBlue">{{ number_format($related->price, 2, ',', '.') }} ₺</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            @else
            <div class="pb-64"></div>
            @endif
            <!--...::: Related Products Section End :::... -->

@endsection

@push('scripts')
<script>
    var variantLookup = @json($variantLookup);
    var hasVariants = {{ ($product->variants && $product->variants->count()) ? 'true' : 'false' }};
    var selectedValueIds = {};

    function addToCartAjax(e) {
        e.preventDefault();
        var form = document.getElementById('add-to-cart-form');
        var btn = document.getElementById('add-to-cart-btn');
        var formData = new FormData(form);

        if (btn) {
            btn.disabled = true;
            btn.style.opacity = '0.6';
        }

        fetch(form.action, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.status === 1) {
                // Update sidebar with new item and open it
                if (typeof _sidebarAddItem === 'function') _sidebarAddItem(data);
                if (typeof openCartSidebar === 'function') openCartSidebar();
                // Show success feedback
                if (btn) {
                    var origHTML = btn.innerHTML;
                    btn.innerHTML = '<svg class="h-5 w-5 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg> Eklendi!';
                    setTimeout(function() { btn.innerHTML = origHTML; }, 1500);
                }
            }
        })
        .catch(function() {
            // Fallback: normal form submit
            form.removeAttribute('onsubmit');
            form.submit();
        })
        .finally(function() {
            if (btn) {
                btn.disabled = hasVariants;
                btn.style.opacity = '1';
            }
        });
        return false;
    }

    function swapMainImage(src) {
        var mainImg = document.getElementById('main-product-image');
        if (mainImg) {
            mainImg.style.opacity = '0';
            setTimeout(function() {
                mainImg.src = src;
                mainImg.style.opacity = '1';
            }, 200);
        }
        // Update lightbox trigger
        var lightbox = document.getElementById('lightbox-trigger');
        if (lightbox) lightbox.href = src;

        // Update active thumbnail
        var thumbs = document.querySelectorAll('.gallery-thumb');
        thumbs.forEach(function(thumb) {
            var thumbImg = thumb.querySelector('img');
            if (thumbImg && thumbImg.src === src) {
                thumb.classList.add('border-colorPurpleBlue', 'ring-2', 'ring-colorPurpleBlue/20');
                thumb.classList.remove('border-transparent');
            } else {
                thumb.classList.remove('border-colorPurpleBlue', 'ring-2', 'ring-colorPurpleBlue/20');
                thumb.classList.add('border-transparent');
            }
        });
    }

    function changeQty(delta) {
        var input = document.getElementById('qty-input');
        if (!input) return;
        var val = parseInt(input.value) || 1;
        input.value = Math.max(1, val + delta);
    }

    function selectVariantValue(attrId, valueId, btn) {
        selectedValueIds[attrId] = valueId;

        // Update active state for buttons in same group
        var siblings = btn.parentElement.querySelectorAll('.variant-btn');
        siblings.forEach(function(b) {
            if (parseInt(b.dataset.valueId) === valueId) {
                b.classList.add('border-colorPurpleBlue', 'ring-colorPurpleBlue');
                if (!b.style.backgroundColor) {
                    b.classList.add('bg-colorPurpleBlue', 'text-white');
                    b.classList.remove('border-colorBlackPearl/12');
                } else {
                    b.classList.add('ring-2', 'ring-offset-2');
                }
                b.classList.remove('border-gray-200', 'ring-transparent');
            } else {
                b.classList.remove('border-colorPurpleBlue', 'bg-colorPurpleBlue', 'text-white', 'ring-colorPurpleBlue', 'ring-2', 'ring-offset-2');
                if (b.style.backgroundColor) {
                    b.classList.add('border-gray-200', 'ring-transparent');
                } else {
                    b.classList.add('border-colorBlackPearl/12', 'ring-transparent');
                }
            }
        });

        resolveVariant();
    }

    function resolveVariant() {
        var groups = document.querySelectorAll('.variant-group');
        var totalGroups = groups.length;
        var selectedCount = Object.keys(selectedValueIds).length;

        var addBtn = document.getElementById('add-to-cart-btn');
        var variantInput = document.getElementById('selected-variant-id');
        var stockStatus = document.getElementById('stock-status');

        if (selectedCount < totalGroups) {
            if (addBtn) addBtn.disabled = true;
            if (variantInput) variantInput.value = '';
            if (stockStatus) stockStatus.classList.add('hidden');
            return;
        }

        // Build lookup key: sorted value IDs joined with "_"
        var ids = Object.values(selectedValueIds).sort(function(a, b) { return a - b; });
        var lookupKey = ids.join('_');
        var variant = variantLookup[lookupKey] || null;

        if (variant) {
            if (variantInput) variantInput.value = variant.id;

            var priceEl = document.getElementById('product-price');
            var origPriceEl = document.getElementById('product-original-price');
            if (priceEl) {
                priceEl.textContent = formatPrice(variant.price) + ' ₺';
                if (origPriceEl) origPriceEl.classList.add('hidden');
            }

            if (variant.image) {
                swapMainImage(variant.image);
            }

            if (stockStatus) {
                var dot = stockStatus.querySelector('.stock-dot');
                var text = stockStatus.querySelector('.stock-text');
                if (variant.stock !== null && variant.stock !== undefined) {
                    if (variant.stock > 0) {
                        if (dot) { dot.className = 'stock-dot h-2 w-2 rounded-full bg-green-500'; }
                        stockStatus.querySelector('.stock-dot').parentElement.className = 'inline-flex items-center gap-2 rounded-lg bg-green-50 px-3 py-1.5 text-sm font-medium text-green-700';
                        if (text) text.textContent = 'Stokta: ' + variant.stock + ' adet';
                    } else {
                        if (dot) { dot.className = 'stock-dot h-2 w-2 rounded-full bg-red-500'; }
                        stockStatus.querySelector('.stock-dot').parentElement.className = 'inline-flex items-center gap-2 rounded-lg bg-red-50 px-3 py-1.5 text-sm font-medium text-red-600';
                        if (text) text.textContent = 'Stokta yok';
                    }
                    stockStatus.classList.remove('hidden');
                }
            }

            if (addBtn) {
                addBtn.disabled = (variant.stock !== null && variant.stock !== undefined && variant.stock <= 0);
            }
        } else {
            if (variantInput) variantInput.value = '';
            if (addBtn) addBtn.disabled = true;
            if (stockStatus) {
                var dot = stockStatus.querySelector('.stock-dot');
                var text = stockStatus.querySelector('.stock-text');
                if (dot) { dot.className = 'stock-dot h-2 w-2 rounded-full bg-amber-500'; }
                stockStatus.querySelector('.stock-dot').parentElement.className = 'inline-flex items-center gap-2 rounded-lg bg-amber-50 px-3 py-1.5 text-sm font-medium text-amber-700';
                if (text) text.textContent = 'Bu kombinasyon mevcut değil';
                stockStatus.classList.remove('hidden');
            }
        }
    }

    function formatPrice(amount) {
        return parseFloat(amount).toLocaleString('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Tab switching
    function switchTab(tabName) {
        // Hide all panels
        document.querySelectorAll('.tab-panel').forEach(function(panel) {
            panel.classList.add('hidden');
        });
        // Show selected panel
        var target = document.getElementById('tab-' + tabName);
        if (target) target.classList.remove('hidden');

        // Update tab buttons
        document.querySelectorAll('.product-tab').forEach(function(tab) {
            var indicator = tab.querySelector('.tab-indicator');
            if (tab.dataset.tab === tabName) {
                tab.classList.add('active');
                tab.classList.remove('text-colorBlackPearl/50');
                tab.classList.add('text-colorBlackPearl');
                if (indicator) indicator.classList.remove('opacity-0');
            } else {
                tab.classList.remove('active');
                tab.classList.add('text-colorBlackPearl/50');
                tab.classList.remove('text-colorBlackPearl');
                if (indicator) indicator.classList.add('opacity-0');
            }
        });
    }
</script>

<style>
    #main-product-image {
        transition: opacity 0.2s ease-in-out, transform 0.5s ease;
    }
    .qty-no-spinner::-webkit-outer-spin-button,
    .qty-no-spinner::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .qty-no-spinner {
        -moz-appearance: textfield;
    }
</style>
@endpush
