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
                                        <li>{{ e($product->name) }}</li>
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
                            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-6 py-4 text-green-800">
                                {{ session('success') }}
                            </div>
                            @endif

                            <!-- Product Area -->
                            <div class="grid grid-cols-1 items-start gap-10 md:gap-[60px] lg:grid-cols-2 xl:gap-[90px]">
                                <!-- Product Details Left Block: Gallery -->
                                <div class="jos" data-jos_animation="fade-right">
                                    <!-- Main Image -->
                                    @php
                                        $allImages = $product->image ? [$product->image] : [];
                                        foreach ($product->images as $gi) {
                                            $allImages[] = $gi->image;
                                        }
                                        $mainImage = $allImages[0] ?? null;
                                    @endphp

                                    @if($mainImage)
                                        <img id="main-product-image"
                                             src="{{ asset($mainImage) }}"
                                             alt="{{ e($product->name) }}"
                                             width="571" height="599"
                                             class="mx-auto max-w-full rounded-lg object-cover" />
                                    @else
                                        <div id="main-product-image-placeholder" class="flex h-[400px] w-full items-center justify-center rounded-lg bg-gray-100">
                                            <svg class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Gallery Thumbnails -->
                                    @if(count($allImages) > 1)
                                    <div class="mt-4 flex flex-wrap gap-3">
                                        @foreach($allImages as $index => $img)
                                        <button type="button"
                                                onclick="swapMainImage('{{ asset($img) }}')"
                                                class="gallery-thumb h-20 w-20 overflow-hidden rounded-lg border-2 transition-all {{ $index === 0 ? 'border-colorPurpleBlue' : 'border-transparent hover:border-colorPurpleBlue' }}">
                                            <img src="{{ asset($img) }}" alt="{{ e($product->name) }} - {{ $index + 1 }}" class="h-full w-full object-cover" />
                                        </button>
                                        @endforeach
                                    </div>
                                    @endif
                                    <!-- Gallery Thumbnails -->
                                </div>
                                <!-- Product Details Left Block -->

                                <!-- Product Details Right Block -->
                                <div class="jos" data-jos_animation="fade-left">
                                    <!-- Product Name -->
                                    <h1 class="mb-4 font-title text-3xl font-bold text-colorBlackPearl">{{ $product->name }}</h1>

                                    <!-- Price -->
                                    <div class="mb-4">
                                        @if($product->sale_price)
                                            <span id="product-price" class="font-title text-2xl font-bold text-colorPurpleBlue">{{ number_format($product->sale_price, 2, ',', '.') }} ₺</span>
                                            <span id="product-original-price" class="ml-3 font-normal text-lg text-[#868686]/60 line-through">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                                        @else
                                            <span id="product-price" class="font-title text-2xl font-bold text-colorPurpleBlue">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                                            <span id="product-original-price" class="hidden"></span>
                                        @endif
                                    </div>
                                    <!-- Price -->

                                    <!-- Short Description -->
                                    @if($product->short_description)
                                    <div class="mb-6 text-colorCarbonGrey">
                                        {!! nl2br(e($product->short_description)) !!}
                                    </div>
                                    @endif
                                    <!-- Short Description -->

                                    <!-- Variant Selectors -->
                                    @if($product->variants && $product->variants->count() && !empty($attributeMap))
                                    <div id="variant-selector" class="mb-6 space-y-5">
                                        @foreach($attributeMap as $attrId => $attrData)
                                        <div class="variant-group" data-attribute="{{ e($attrData['name']) }}">
                                            <label class="mb-2 block text-sm font-semibold text-colorBlackPearl">{{ e($attrData['name']) }}</label>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($attrData['values'] as $value)
                                                @if(!empty($value['color_code']))
                                                    <!-- Color Swatch -->
                                                    <button type="button"
                                                            onclick="selectVariantValue({{ $attrId }}, {{ $value['id'] }}, this)"
                                                            data-attr-id="{{ $attrId }}"
                                                            data-value-id="{{ $value['id'] }}"
                                                            title="{{ e($value['name']) }}"
                                                            class="variant-btn h-9 w-9 rounded-full border-2 border-transparent ring-2 ring-offset-1 ring-transparent transition-all hover:ring-colorPurpleBlue"
                                                            style="background-color: {{ e($value['color_code']) }};">
                                                    </button>
                                                @else
                                                    <!-- Value Button -->
                                                    <button type="button"
                                                            onclick="selectVariantValue({{ $attrId }}, {{ $value['id'] }}, this)"
                                                            data-attr-id="{{ $attrId }}"
                                                            data-value-id="{{ $value['id'] }}"
                                                            class="variant-btn rounded-lg border border-colorBlackPearl/25 px-4 py-2 text-sm font-medium text-colorBlackPearl transition-all hover:border-colorPurpleBlue hover:bg-colorPurpleBlue hover:text-white">
                                                        {{ e($value['name']) }}
                                                    </button>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    <!-- Variant Selectors -->

                                    <!-- Stock Status -->
                                    <div id="stock-status" class="mb-4 hidden text-sm"></div>

                                    <!-- Add to Cart Form -->
                                    <form action="{{ route('front.cart.add') }}" method="POST" id="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                        <input type="hidden" name="variant_id" id="selected-variant-id" value="" />

                                        <div class="flex flex-wrap gap-4">
                                            <!-- Quantity Block -->
                                            <div class="flex items-center gap-x-4 rounded-[50px] bg-[#FAF9F6] px-6 py-3 text-lg font-medium text-colorBlackPearl">
                                                <button type="button" class="text-xl leading-none" onclick="changeQty(-1)">-</button>
                                                <input type="number" name="quantity" id="qty-input" value="1" min="1"
                                                       class="w-10 bg-transparent text-center outline-none" />
                                                <button type="button" class="text-xl leading-none" onclick="changeQty(1)">+</button>
                                            </div>
                                            <!-- Quantity Block -->

                                            <!-- Add to Cart Button -->
                                            <button type="submit"
                                                    id="add-to-cart-btn"
                                                    @if($product->variants && $product->variants->count()) disabled @endif
                                                    class="btn btn-primary is-icon group disabled:cursor-not-allowed disabled:opacity-50">
                                                Sepete Ekle
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="20" height="20" />
                                                </span>
                                            </button>
                                            <!-- Add to Cart Button -->
                                        </div>
                                    </form>
                                    <!-- Add to Cart Form -->

                                    <!-- Product Meta -->
                                    @php $firstCategory = $product->categories->first(); @endphp
                                    @if($product->sku || $firstCategory)
                                    <table class="mt-10 table-auto text-sm">
                                        <tbody>
                                            @if($product->sku)
                                            <tr>
                                                <td class="pr-6 py-1 font-medium text-colorBlackPearl">SKU:</td>
                                                <td class="py-1 font-normal text-colorCarbonGrey">{{ $product->sku }}</td>
                                            </tr>
                                            @endif
                                            @if($firstCategory)
                                            <tr>
                                                <td class="pr-6 py-1 font-medium text-colorBlackPearl">Kategori:</td>
                                                <td class="py-1 font-normal text-colorCarbonGrey">
                                                    <a href="{{ route('front.products', ['kategori' => $firstCategory->id]) }}" class="hover:text-colorPurpleBlue">{{ $firstCategory->name }}</a>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @endif
                                    <!-- Product Meta -->
                                </div>
                                <!-- Product Details Right Block -->
                            </div>
                            <!-- Product Area -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Space -->
                </div>
            </section>
            <!--...::: Product Detail Section End :::... -->

            <!--...::: Product Description Section Start :::... -->
            @if($product->description)
            <section class="section-tabs">
                <div class="bg-white">
                    <div class="section-space-bottom">
                        <div class="container">
                            <h4 class="mb-4 font-title font-bold text-colorBlackPearl">Ürün Açıklaması</h4>
                            <div class="my-4 h-px w-full bg-colorBlackPearl/25"></div>
                            <div class="rich-text-area">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
            <!--...::: Product Description Section End :::... -->

            <!--...::: Related Products Section Start :::... -->
            @if($relatedProducts && count($relatedProducts))
            <section class="section-course">
                <div class="bg-white pb-64">
                    <div class="section-space-bottom">
                        <div class="container">
                            <!-- Section Block -->
                            <div class="mb-10 lg:mb-[60px]">
                                <div class="jos mx-auto max-w-lg text-center">
                                    <span class="mb-5 block uppercase">İLGİLİ ÜRÜNLER</span>
                                    <h2>Benzer Ürünler</h2>
                                </div>
                            </div>
                            <!-- Section Block -->

                            <!-- Related Product List -->
                            <ul class="grid grid-cols-1 gap-[30px] md:grid-cols-2 xl:grid-cols-4">
                                @foreach($relatedProducts as $related)
                                <li class="jos" data-jos_animation="flip-left">
                                    <div class="group/product overflow-hidden rounded-lg">
                                        <!-- Thumbnail -->
                                        <div class="relative flex justify-center overflow-hidden rounded-lg">
                                            @if($related->image)
                                                <img src="{{ asset($related->image) }}" alt="{{ e($related->name) }}" width="270" height="288" class="h-auto w-full transition-all duration-300 group-hover/product:scale-105" />
                                            @else
                                                <div class="h-[288px] w-full bg-gray-100 flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                                                    </svg>
                                                </div>
                                            @endif

                                            <a href="{{ route('front.product.details', $related->id) }}" class="btn btn-primary is-icon group text-sm absolute -bottom-full group-hover/product:bottom-4 transition-all duration-300">
                                                Detay
                                                <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="16" height="16" />
                                                </span>
                                                <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                                                    <img src="{{ asset('assets-front/img/icons/icon-purple-shopping-cart-line.svg') }}" alt="icon-purple-shopping-cart-line" width="16" height="16" />
                                                </span>
                                            </a>
                                        </div>
                                        <!-- Thumbnail -->
                                        <!-- Content -->
                                        <div class="px-2 py-6 text-center">
                                            <a href="{{ route('front.product.details', $related->id) }}" class="mb-2 block font-title text-lg font-bold text-colorBlackPearl hover:text-colorPurpleBlue">{{ $related->name }}</a>
                                            <span class="block font-title text-lg font-bold text-colorPurpleBlue">
                                                @if($related->sale_price)
                                                    {{ number_format($related->sale_price, 2, ',', '.') }} ₺
                                                    <span class="ml-1 font-normal text-sm text-[#868686]/50 line-through">{{ number_format($related->price, 2, ',', '.') }} ₺</span>
                                                @else
                                                    {{ number_format($related->price, 2, ',', '.') }} ₺
                                                @endif
                                            </span>
                                        </div>
                                        <!-- Content -->
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <!-- Related Product List -->
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

    function swapMainImage(src) {
        var mainImg = document.getElementById('main-product-image');
        if (mainImg) mainImg.src = src;
        var thumbs = document.querySelectorAll('.gallery-thumb');
        thumbs.forEach(function(thumb) {
            var thumbImg = thumb.querySelector('img');
            if (thumbImg && thumbImg.src === src) {
                thumb.classList.add('border-colorPurpleBlue');
                thumb.classList.remove('border-transparent');
            } else {
                thumb.classList.remove('border-colorPurpleBlue');
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
                }
                b.classList.remove('border-colorBlackPearl/25', 'ring-transparent', 'border-transparent');
            } else {
                b.classList.remove('border-colorPurpleBlue', 'bg-colorPurpleBlue', 'text-white', 'ring-colorPurpleBlue');
                if (b.style.backgroundColor) {
                    b.classList.add('border-transparent', 'ring-transparent');
                } else {
                    b.classList.add('border-colorBlackPearl/25', 'ring-transparent');
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
                var mainImg = document.getElementById('main-product-image');
                if (mainImg) mainImg.src = variant.image;
            }

            if (stockStatus) {
                if (variant.stock !== null && variant.stock !== undefined) {
                    if (variant.stock > 0) {
                        stockStatus.textContent = 'Stok: ' + variant.stock + ' adet';
                        stockStatus.className = 'mb-4 text-sm text-green-600';
                    } else {
                        stockStatus.textContent = 'Bu varyant stokta bulunmuyor.';
                        stockStatus.className = 'mb-4 text-sm text-red-600';
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
                stockStatus.textContent = 'Bu kombinasyon mevcut değil.';
                stockStatus.className = 'mb-4 text-sm text-red-500';
                stockStatus.classList.remove('hidden');
            }
        }
    }

    function formatPrice(amount) {
        return parseFloat(amount).toLocaleString('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }
</script>
@endpush
