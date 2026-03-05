{{-- ═══ TAB 2: ÜRÜN DETAY ═══ --}}
<div x-show="pageTab === 'detay'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

    {{-- Breadcrumb --}}
    <section style="position: relative; z-index: 10; overflow: hidden; background-color: #FAF9F6; margin: 16px 20px 0; border-radius: 12px;">
        <div style="padding: 50px 0;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                <div style="text-align: center;">
                    <div class="ez" :class="activeField === 'detail_title' && 'ez-active'" data-label="Başlık + Stil" @click="openModal('detail_title', 'Detay Sayfa Başlığı', 'textarea')">
                        <h1 :style="getFieldStyle('detail_title', 'margin-bottom: 1.25rem; text-transform: capitalize; letter-spacing: normal; font-size: 2rem;')"
                            x-html="nl2br(fields.detail_title || 'Ürün Detayı')"></h1>
                    </div>
                    <nav style="font-size: 0.9375rem; font-weight: 500; text-transform: uppercase;">
                        <ul style="display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 4px; align-items: center;">
                            <li>
                                <span class="ez" :class="activeField === 'products_breadcrumb_home' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('products_breadcrumb_home', 'Ana Sayfa')"
                                      :style="getFieldStyle('products_breadcrumb_home', 'color: rgb(215 59 62);')" x-text="fields.products_breadcrumb_home || 'ANA SAYFA'"></span>
                            </li>
                            <li style="color: rgb(95 93 93);">/</li>
                            <li>
                                <span class="ez" :class="activeField === 'detail_breadcrumb_products' && 'ez-active'" data-label="Düzenle" @click="openModal('detail_breadcrumb_products', 'Breadcrumb Ürünler')"
                                      :style="getFieldStyle('detail_breadcrumb_products', 'color: rgb(215 59 62);')" x-text="fields.detail_breadcrumb_products || 'ÜRÜNLER'"></span>
                            </li>
                            <li style="color: rgb(95 93 93);">/</li>
                            <li style="color: rgb(95 93 93);">Ürün Adı...</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div style="position: absolute; left: -192px; top: 0; z-index: -1; width: 371px; height: 327px; background: #BFC06F; filter: blur(250px);"></div>
        <div style="position: absolute; right: -144px; bottom: 80px; z-index: -1; width: 371px; height: 327px; background: #AAC3E9; filter: blur(200px);"></div>
    </section>

    {{-- Product Detail Layout --}}
    <div style="background: white; padding: 32px 20px 40px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
                {{-- LEFT: Product image --}}
                <div>
                    @if($products->count() > 0 && $products->first()->image)
                    <div style="border-radius: 12px; overflow: hidden; background: #F5F5F5;">
                        <img src="{{ asset($products->first()->image) }}" alt="" style="width: 100%; height: 380px; object-fit: cover; display: block;" />
                    </div>
                    @else
                    <div style="border-radius: 12px; background: linear-gradient(135deg, #F0F0F0 0%, #E8E8E8 100%); height: 380px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 60px; height: 60px; color: #ccc;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                    </div>
                    @endif
                </div>

                {{-- RIGHT: Product info --}}
                <div>
                    {{-- Discount badge --}}
                    <div class="ez" :class="activeField === 'detail_discount_text' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_discount_text', 'İndirim Etiketi')" style="margin-bottom: 12px;">
                        <span :style="getFieldStyle('detail_discount_text', 'display: inline-block; background: rgb(215 59 62); color: white; padding: 4px 14px; border-radius: 40px; font-size: 0.8125rem; font-weight: 600;')" x-text="fields.detail_discount_text || 'İndirim'"></span>
                    </div>

                    <h2 style="font-size: 1.5rem; margin-bottom: 8px;">{{ $products->count() > 0 ? $products->first()->name : 'Ürün Adı' }}</h2>
                    <p style="font-size: 1.5rem; font-weight: 700; color: rgb(84 62 232); margin-bottom: 20px;">
                        @if($products->count() > 0)
                            {{ number_format($products->first()->effective_price, 2, ',', '.') }} ₺
                        @else
                            99,00 ₺
                        @endif
                    </p>

                    <p style="color: rgb(95 93 93); font-size: 0.9375rem; margin-bottom: 24px;">Ürün açıklaması burada görünecek...</p>

                    {{-- Add to cart button --}}
                    <div class="ez" :class="activeField === 'detail_add_to_cart' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_add_to_cart', 'Sepete Ekle Butonu')" style="margin-bottom: 24px;">
                        <span :style="getFieldStyle('detail_add_to_cart', 'display: inline-block; border-radius: 52px; padding: 14px 36px; background: rgb(84 62 232); color: white; font-size: 1rem; font-weight: 600;')" x-text="fields.detail_add_to_cart || 'Sepete Ekle'"></span>
                    </div>

                    {{-- SKU & Category --}}
                    <div style="display: flex; flex-direction: column; gap: 8px; padding-top: 16px; border-top: 1px solid #eee;">
                        <div style="display: flex; gap: 8px; font-size: 0.875rem;">
                            <div class="ez" :class="activeField === 'detail_sku_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_sku_label', 'SKU Etiketi')">
                                <span :style="getFieldStyle('detail_sku_label', 'font-weight: 600; color: rgb(1 28 26);')" x-text="fields.detail_sku_label || 'SKU:'"></span>
                            </div>
                            <span style="color: rgb(95 93 93);">{{ $products->count() > 0 ? ($products->first()->sku ?? 'PRD-001') : 'PRD-001' }}</span>
                        </div>
                        <div style="display: flex; gap: 8px; font-size: 0.875rem;">
                            <div class="ez" :class="activeField === 'detail_category_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_category_label', 'Kategori Etiketi')">
                                <span :style="getFieldStyle('detail_category_label', 'font-weight: 600; color: rgb(1 28 26);')" x-text="fields.detail_category_label || 'Kategori:'"></span>
                            </div>
                            <span style="color: rgb(84 62 232);">{{ $categories->count() > 0 ? $categories->first()->name : 'Kategori' }}</span>
                        </div>
                    </div>

                    {{-- Trust badges --}}
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-top: 20px;">
                        <div class="ez" :class="activeField === 'detail_trust_1' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_trust_1', 'Güven Rozeti 1')">
                            <div style="text-align: center; background: #FAF9F6; border-radius: 12px; padding: 12px 8px;">
                                <svg style="width: 20px; height: 20px; color: #3B82F6; margin: 0 auto 6px;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                                <span :style="getFieldStyle('detail_trust_1', 'font-size: 0.6875rem; font-weight: 600; color: rgb(95 93 93);')" x-text="fields.detail_trust_1 || 'Hızlı Kargo'"></span>
                            </div>
                        </div>
                        <div class="ez" :class="activeField === 'detail_trust_2' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_trust_2', 'Güven Rozeti 2')">
                            <div style="text-align: center; background: #FAF9F6; border-radius: 12px; padding: 12px 8px;">
                                <svg style="width: 20px; height: 20px; color: #22C55E; margin: 0 auto 6px;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                                <span :style="getFieldStyle('detail_trust_2', 'font-size: 0.6875rem; font-weight: 600; color: rgb(95 93 93);')" x-text="fields.detail_trust_2 || 'Güvenli Ödeme'"></span>
                            </div>
                        </div>
                        <div class="ez" :class="activeField === 'detail_trust_3' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_trust_3', 'Güven Rozeti 3')">
                            <div style="text-align: center; background: #FAF9F6; border-radius: 12px; padding: 12px 8px;">
                                <svg style="width: 20px; height: 20px; color: #F59E0B; margin: 0 auto 6px;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182"/></svg>
                                <span :style="getFieldStyle('detail_trust_3', 'font-size: 0.6875rem; font-weight: 600; color: rgb(95 93 93);')" x-text="fields.detail_trust_3 || 'Kolay İade'"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabs: Description / Features --}}
            <div style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 24px;">
                <div style="display: flex; gap: 24px; margin-bottom: 16px;">
                    <div class="ez" :class="activeField === 'detail_description_tab' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_description_tab', 'Açıklama Sekmesi')">
                        <span :style="getFieldStyle('detail_description_tab', 'font-size: 1rem; font-weight: 700; color: rgb(84 62 232); border-bottom: 2px solid rgb(84 62 232); padding-bottom: 8px;')" x-text="fields.detail_description_tab || 'Açıklama'"></span>
                    </div>
                    <div class="ez" :class="activeField === 'detail_features_tab' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_features_tab', 'Özellikler Sekmesi')">
                        <span :style="getFieldStyle('detail_features_tab', 'font-size: 1rem; font-weight: 500; color: rgb(95 93 93); padding-bottom: 8px;')" x-text="fields.detail_features_tab || 'Özellikler'"></span>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <div style="width: 100%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                    <div style="width: 95%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                    <div style="width: 88%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                    <div style="width: 100%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                    <div style="width: 60%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                </div>
            </div>

            {{-- Related Products --}}
            <div style="margin-top: 48px; text-align: center;">
                <div class="ez" :class="activeField === 'detail_related_subtitle' && 'ez-active'" data-label="Düzenle" @click="openModal('detail_related_subtitle', 'Benzer Ürünler Alt Başlık')">
                    <span :style="getFieldStyle('detail_related_subtitle', 'display: block; text-transform: uppercase; color: rgb(84 62 232); font-size: 0.875rem; font-weight: 500; margin-bottom: 8px;')" x-text="fields.detail_related_subtitle || 'Keşfedin'"></span>
                </div>
                <div class="ez" :class="activeField === 'detail_related_title' && 'ez-active'" data-label="Başlık + Stil" @click="openModal('detail_related_title', 'Benzer Ürünler Başlık')">
                    <h2 :style="getFieldStyle('detail_related_title', 'font-size: 1.5rem; margin-bottom: 24px;')" x-text="fields.detail_related_title || 'Benzer Ürünler'"></h2>
                </div>

                @if($products->count() > 1)
                <ul style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; list-style: none; padding: 0; margin: 0;">
                    @foreach($products->take(3) as $product)
                    <li class="product-card-preview">
                        <div style="position: relative; overflow: hidden; border-radius: 10px;">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-card-img" />
                            @else
                                <div style="width: 100%; height: 200px; background: #F0F0F0; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 40px; height: 40px; color: #ccc;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                                </div>
                            @endif
                            <div style="position: absolute; bottom: 12px; left: 50%; transform: translateX(-50%);">
                                <div class="ez" :class="activeField === 'detail_related_button' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('detail_related_button', 'Benzer Ürün Butonu')">
                                    <span :style="getFieldStyle('detail_related_button', 'display: inline-block; border-radius: 52px; padding: 10px 24px; background: rgb(84 62 232); color: white; font-size: 0.875rem; font-weight: 500;')" x-text="fields.detail_related_button || 'İncele'"></span>
                                </div>
                            </div>
                        </div>
                        <div class="product-card-info">
                            <div class="product-card-title">{{ $product->name }}</div>
                            <div class="product-card-price">{{ number_format($product->effective_price, 2, ',', '.') }} ₺</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <p style="color: #B0B0B0; font-size: 0.875rem; font-style: italic;">Benzer ürünler ürün eklenince görünecek</p>
                @endif
            </div>

        </div>
    </div>

</div>
