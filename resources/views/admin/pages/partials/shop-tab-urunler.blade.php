{{-- ═══ TAB 1: ÜRÜNLER ═══ --}}
<div x-show="pageTab === 'urunler'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

    {{-- Breadcrumb --}}
    <section style="position: relative; z-index: 10; overflow: hidden; background-color: #FAF9F6; margin: 16px 20px 0; border-radius: 12px;">
        <div style="padding: 50px 0;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                <div style="text-align: center;">
                    <div class="ez" :class="activeField === 'products_title' && 'ez-active'" data-label="Başlık + Stil" @click="openModal('products_title', 'Sayfa Başlığı', 'textarea')">
                        <h1 :style="getFieldStyle('products_title', 'margin-bottom: 1.25rem; text-transform: capitalize; letter-spacing: normal; font-size: 2rem;')"
                            x-html="nl2br(fields.products_title || 'Ürünlerimiz')"></h1>
                    </div>
                    <nav style="font-size: 0.9375rem; font-weight: 500; text-transform: uppercase;">
                        <ul style="display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 4px; align-items: center;">
                            <li>
                                <span class="ez" :class="activeField === 'products_breadcrumb_home' && 'ez-active'" data-label="Düzenle" @click="openModal('products_breadcrumb_home', 'Breadcrumb Ana Sayfa')"
                                      :style="getFieldStyle('products_breadcrumb_home', 'color: rgb(215 59 62);')" x-text="fields.products_breadcrumb_home || 'ANA SAYFA'"></span>
                            </li>
                            <li style="color: rgb(95 93 93);">/</li>
                            <li>
                                <span class="ez" :class="activeField === 'products_breadcrumb_current' && 'ez-active'" data-label="Düzenle" @click="openModal('products_breadcrumb_current', 'Breadcrumb Ürünler')"
                                      :style="getFieldStyle('products_breadcrumb_current', 'color: rgb(95 93 93);')" x-text="fields.products_breadcrumb_current || 'ÜRÜNLER'"></span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div style="position: absolute; left: -192px; top: 0; z-index: -1; width: 371px; height: 327px; background: #BFC06F; filter: blur(250px);"></div>
        <div style="position: absolute; right: -144px; bottom: 80px; z-index: -1; width: 371px; height: 327px; background: #AAC3E9; filter: blur(200px);"></div>
    </section>

    {{-- Filters Row --}}
    <div style="background: white; padding: 28px 20px 0;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 24px;">
            {{-- Category Pills --}}
            <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                <div class="ez" :class="activeField === 'products_all_text' && 'ez-active'" data-label="Tümü Etiketi" @click="openModal('products_all_text', 'Tümü Etiketi')">
                    <span :style="getFieldStyle('products_all_text', 'display: inline-block; border-radius: 50px; padding: 10px 20px; font-size: 0.875rem; font-weight: 500; background: rgb(84 62 232); color: white; line-height: 1;')"
                          x-text="fields.products_all_text || 'Tümü'"></span>
                </div>
                @foreach($categories as $cat)
                <span style="display: inline-block; border-radius: 50px; padding: 10px 20px; font-size: 0.875rem; font-weight: 500; background: #F5F5F5; color: rgb(1 28 26); line-height: 1;">{{ $cat->name }}</span>
                @endforeach
            </div>
            {{-- Search --}}
            <div style="width: 380px; position: relative; display: flex; align-items: center;">
                <div class="ez" :class="activeField === 'products_search_placeholder' && 'ez-active'" data-label="Placeholder" @click="openModal('products_search_placeholder', 'Arama Placeholder')" style="flex: 1;">
                    <input type="text" disabled style="width: 100%; border-radius: 50px; border: 1px solid #E0E0E0; padding: 14px 140px 14px 32px; font-size: 0.875rem; font-weight: 500; outline: none; pointer-events: none; color: rgba(0,0,0,0.35); background: #fff;" :placeholder="fields.products_search_placeholder || 'Ürün arayın...'">
                </div>
                <div class="ez" :class="activeField === 'products_search_button' && 'ez-active'" data-label="Buton" @click="openModal('products_search_button', 'Arama Butonu')" style="position: absolute; right: 5px; top: 5px; bottom: 5px;">
                    <span :style="getFieldStyle('products_search_button', 'display: inline-flex; align-items: center; justify-content: center; gap: 8px; border-radius: 50px; background: rgb(84 62 232); padding: 0 24px; height: 100%; font-size: 0.875rem; color: white; white-space: nowrap;')">
                        <span x-text="fields.products_search_button || 'Ara'"></span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Product Grid --}}
    <div style="background: white; padding: 28px 20px 36px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            @if($products->count() > 0)
            <ul style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; list-style: none; padding: 0; margin: 0;">
                @foreach($products as $product)
                <li class="product-card-preview">
                    <div style="position: relative; overflow: hidden; border-radius: 10px;">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-card-img" />
                        @else
                            <div style="width: 100%; height: 200px; background: #F0F0F0; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 40px; height: 40px; color: #ccc;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                            </div>
                        @endif
                        {{-- Add to cart button --}}
                        <div style="position: absolute; bottom: 12px; left: 50%; transform: translateX(-50%);">
                            <div class="ez" :class="activeField === 'products_add_to_cart' && 'ez-active'" data-label="Buton" @click="openModal('products_add_to_cart', 'Sepete Ekle Butonu')">
                                <span :style="getFieldStyle('products_add_to_cart', 'display: inline-block; border-radius: 52px; padding: 12px 28px; background: rgb(84 62 232); color: white; font-size: 0.9375rem; font-weight: 500; white-space: nowrap;')" x-text="fields.products_add_to_cart || 'Sepete Ekle'"></span>
                            </div>
                        </div>
                    </div>
                    <div class="product-card-info">
                        <div class="product-card-title">{{ $product->name }}</div>
                        <div class="product-card-price">
                            @if($product->sale_price)
                                {{ number_format($product->sale_price, 2, ',', '.') }} ₺
                                <span style="margin-left: 8px; font-weight: 400; color: #868686; opacity: 0.5; text-decoration: line-through;">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                            @else
                                {{ number_format($product->price, 2, ',', '.') }} ₺
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div style="text-align: center; margin-top: 1.25rem;">
                <span style="font-size: 0.75rem; color: #B0B0B0; font-family: Inter, sans-serif; font-style: italic;">Ürün kartları önizleme amaçlıdır — içerik Ürün Yönetimi'nden düzenlenir</span>
            </div>
            @else
            <div style="text-align: center; padding: 3rem 0;">
                <div class="ez" :class="activeField === 'products_empty_text' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('products_empty_text', 'Boş Durum Mesajı')">
                    <p :style="getFieldStyle('products_empty_text', 'color: #8D8D8D; font-size: 0.875rem;')" x-text="fields.products_empty_text || 'Henüz ürün eklenmemiş.'"></p>
                </div>
            </div>
            @endif
        </div>
    </div>

</div>
