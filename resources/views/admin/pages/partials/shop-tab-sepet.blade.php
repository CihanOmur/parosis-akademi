{{-- ═══ TAB 3: SEPET ═══ --}}
<div x-show="pageTab === 'sepet'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

    {{-- Breadcrumb --}}
    <section style="position: relative; z-index: 10; overflow: hidden; background-color: #FAF9F6; margin: 16px 20px 0; border-radius: 12px;">
        <div style="padding: 50px 0;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                <div style="text-align: center;">
                    <div class="ez" :class="activeField === 'cart_title' && 'ez-active'" data-label="Başlık + Stil" @click="openModal('cart_title', 'Sepet Başlığı', 'textarea')">
                        <h1 :style="getFieldStyle('cart_title', 'margin-bottom: 1.25rem; text-transform: capitalize; letter-spacing: normal; font-size: 2rem;')"
                            x-html="nl2br(fields.cart_title || 'Sepetim')"></h1>
                    </div>
                    <nav style="font-size: 0.9375rem; font-weight: 500; text-transform: uppercase;">
                        <ul style="display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 4px; align-items: center;">
                            <li>
                                <span :style="getFieldStyle('products_breadcrumb_home', 'color: rgb(215 59 62);')" x-text="fields.products_breadcrumb_home || 'ANA SAYFA'"></span>
                            </li>
                            <li style="color: rgb(95 93 93);">/</li>
                            <li>
                                <span class="ez" :class="activeField === 'cart_breadcrumb_current' && 'ez-active'" data-label="Düzenle" @click="openModal('cart_breadcrumb_current', 'Breadcrumb Sepet')"
                                      :style="getFieldStyle('cart_breadcrumb_current', 'color: rgb(95 93 93);')" x-text="fields.cart_breadcrumb_current || 'SEPETİM'"></span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div style="position: absolute; left: -192px; top: 0; z-index: -1; width: 371px; height: 327px; background: #BFC06F; filter: blur(250px);"></div>
        <div style="position: absolute; right: -144px; bottom: 80px; z-index: -1; width: 371px; height: 327px; background: #AAC3E9; filter: blur(200px);"></div>
    </section>

    {{-- Cart Layout --}}
    <div style="background: white; padding: 32px 20px 40px;">
        <div style="max-width: 1200px; margin: 0 auto;">

            {{-- Empty State --}}
            <div style="text-align: center; padding: 32px 0; margin-bottom: 32px; border: 2px dashed #E5E7EB; border-radius: 16px; background: #FAFAFA;">
                <div style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: #9CA3AF; margin-bottom: 16px;">Boş Sepet Görünümü</div>
                <div style="margin-bottom: 20px;">
                    <div style="width: 80px; height: 80px; margin: 0 auto; border-radius: 50%; background: linear-gradient(135deg, #FAF9F6, #F0F0F0); display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 40px; height: 40px; color: rgba(0,0,0,0.1);" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/></svg>
                    </div>
                </div>
                <div class="ez" :class="activeField === 'cart_empty_title' && 'ez-active'" data-label="Düzenle" @click="openModal('cart_empty_title', 'Boş Sepet Başlık')">
                    <h3 :style="getFieldStyle('cart_empty_title', 'font-size: 1.25rem; margin-bottom: 8px;')" x-text="fields.cart_empty_title || 'Sepetiniz henüz boş'"></h3>
                </div>
                <div class="ez" :class="activeField === 'cart_empty_description' && 'ez-active'" data-label="Düzenle" @click="openModal('cart_empty_description', 'Boş Sepet Açıklama', 'textarea')">
                    <p :style="getFieldStyle('cart_empty_description', 'color: rgba(95,93,93,0.7); max-width: 360px; margin: 0 auto 20px; font-size: 0.9375rem;')" x-text="fields.cart_empty_description || 'Mağazamızdaki ürünlere göz atarak sepetinize ürün ekleyebilirsiniz.'"></p>
                </div>
                <div class="ez" :class="activeField === 'cart_empty_button' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_empty_button', 'Boş Sepet Butonu')">
                    <span :style="getFieldStyle('cart_empty_button', 'display: inline-block; border-radius: 16px; padding: 14px 28px; background: rgb(84 62 232); color: white; font-size: 0.875rem; font-weight: 700;')" x-text="fields.cart_empty_button || 'Ürünlere Göz At'"></span>
                </div>
            </div>

            {{-- Cart with items --}}
            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px;">
                {{-- LEFT: Cart Items --}}
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                        <div class="ez" :class="activeField === 'cart_items_header' && 'ez-active'" data-label="Düzenle" @click="openModal('cart_items_header', 'Ürünler Başlığı')">
                            <h3 :style="getFieldStyle('cart_items_header', 'font-size: 1.125rem;')" x-text="fields.cart_items_header || 'Sepetinizdeki Ürünler'"></h3>
                        </div>
                        <span style="font-size: 0.75rem; font-weight: 700; padding: 4px 12px; border-radius: 50px; background: rgba(84,62,232,0.1); color: rgb(84 62 232);">2 ürün</span>
                    </div>

                    {{-- Demo cart item --}}
                    <div style="border: 1px solid #F3F4F6; border-radius: 20px; padding: 20px; display: flex; gap: 16px; margin-bottom: 12px;">
                        <div style="width: 100px; height: 100px; border-radius: 14px; background: #F5F5F5; flex-shrink: 0; overflow: hidden;">
                            @if($products->count() > 0 && $products->first()->image)
                            <img src="{{ asset($products->first()->image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
                            @endif
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 700; color: rgb(1 28 26); font-family: 'Aeonik Pro TRIAL', sans-serif;">{{ $products->count() > 0 ? $products->first()->name : 'Ürün Adı' }}</div>
                            <div style="font-size: 0.8125rem; color: rgb(95 93 93); margin-top: 4px;">1 x 99,00 ₺</div>
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 12px;">
                                <div style="display: inline-flex; border: 2px solid #F3F4F6; border-radius: 14px; overflow: hidden;">
                                    <span style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #999;">−</span>
                                    <span style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: 700; color: rgb(1 28 26); border-left: 2px solid #F3F4F6; border-right: 2px solid #F3F4F6;">1</span>
                                    <span style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #999;">+</span>
                                </div>
                                <span style="font-weight: 800; font-size: 1.125rem; color: rgb(84 62 232); font-family: 'Aeonik Pro TRIAL', sans-serif;">99,00 ₺</span>
                            </div>
                        </div>
                    </div>

                    {{-- Continue shopping --}}
                    <div class="ez" :class="activeField === 'cart_continue_shopping' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_continue_shopping', 'Alışverişe Devam')" style="margin-top: 20px;">
                        <span :style="getFieldStyle('cart_continue_shopping', 'display: inline-flex; align-items: center; gap: 8px; font-size: 0.875rem; font-weight: 600; color: rgba(95,93,93,0.6);')">
                            <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            <span x-text="fields.cart_continue_shopping || 'Alışverişe Devam Et'"></span>
                        </span>
                    </div>
                </div>

                {{-- RIGHT: Order Summary --}}
                <div>
                    <div style="border: 1px solid #F3F4F6; border-radius: 20px; overflow: hidden;">
                        <div style="border-bottom: 1px solid #F3F4F6; background: linear-gradient(to right, #FAF9F6, white); padding: 16px 20px;">
                            <div class="ez" :class="activeField === 'cart_summary_header' && 'ez-active'" data-label="Düzenle" @click="openModal('cart_summary_header', 'Özet Başlığı')">
                                <h4 :style="getFieldStyle('cart_summary_header', 'font-size: 1.05rem;')" x-text="fields.cart_summary_header || 'Sipariş Özeti'"></h4>
                            </div>
                        </div>
                        <div style="padding: 20px;">
                            {{-- Subtotal --}}
                            <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 12px;">
                                <div class="ez" :class="activeField === 'cart_subtotal' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_subtotal', 'Ara Toplam')">
                                    <span :style="getFieldStyle('cart_subtotal', 'color: rgb(95 93 93);')" x-text="fields.cart_subtotal || 'Ara Toplam'"></span>
                                </div>
                                <span style="font-weight: 700; color: rgb(1 28 26);">99,00 ₺</span>
                            </div>
                            {{-- Shipping --}}
                            <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 16px;">
                                <div class="ez" :class="activeField === 'cart_shipping' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_shipping', 'Kargo')">
                                    <span :style="getFieldStyle('cart_shipping', 'color: rgb(95 93 93);')" x-text="fields.cart_shipping || 'Kargo'"></span>
                                </div>
                                <div class="ez" :class="activeField === 'cart_shipping_free' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_shipping_free', 'Ücretsiz Kargo')">
                                    <span :style="getFieldStyle('cart_shipping_free', 'font-size: 0.75rem; font-weight: 700; padding: 2px 10px; border-radius: 50px; background: #DCFCE7; color: #16A34A;')" x-text="fields.cart_shipping_free || 'Ücretsiz'"></span>
                                </div>
                            </div>

                            <div style="border-top: 1px dashed #E5E7EB; padding-top: 12px; margin-bottom: 12px;"></div>

                            {{-- Coupon --}}
                            <div style="margin-bottom: 12px;">
                                <div class="ez" :class="activeField === 'cart_coupon_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_coupon_label', 'Kupon Etiket')">
                                    <span :style="getFieldStyle('cart_coupon_label', 'font-size: 0.75rem; font-weight: 600; color: rgba(95,93,93,0.7);')" x-text="fields.cart_coupon_label || 'İndirim Kodu'"></span>
                                </div>
                                <div style="display: flex; gap: 8px; margin-top: 6px;">
                                    <div class="ez" :class="activeField === 'cart_coupon_placeholder' && 'ez-active'" data-label="Düzenle" @click="openModal('cart_coupon_placeholder', 'Kupon Placeholder')" style="flex: 1;">
                                        <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 10px 14px; font-size: 0.875rem; pointer-events: none; color: #ccc;" :placeholder="fields.cart_coupon_placeholder || 'Kupon kodunuzu girin'">
                                    </div>
                                    <div class="ez" :class="activeField === 'cart_coupon_apply' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_coupon_apply', 'Uygula Butonu')">
                                        <span :style="getFieldStyle('cart_coupon_apply', 'display: inline-block; border-radius: 12px; padding: 10px 16px; background: rgb(1 28 26); color: white; font-size: 0.75rem; font-weight: 700;')" x-text="fields.cart_coupon_apply || 'Uygula'"></span>
                                    </div>
                                </div>
                            </div>

                            <div style="border-top: 1px dashed #E5E7EB; padding-top: 12px; margin-bottom: 16px;"></div>

                            {{-- Total --}}
                            <div style="background: linear-gradient(to right, rgba(84,62,232,0.05), rgba(99,102,241,0.05)); border-radius: 14px; padding: 14px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div class="ez" :class="activeField === 'cart_total' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_total', 'Toplam')">
                                        <span :style="getFieldStyle('cart_total', 'font-size: 0.875rem; font-weight: 700; color: rgb(1 28 26);')" x-text="fields.cart_total || 'Toplam'"></span>
                                    </div>
                                    <span style="font-size: 1.5rem; font-weight: 900; color: rgb(84 62 232); font-family: 'Aeonik Pro TRIAL', sans-serif;">99,00 ₺</span>
                                </div>
                            </div>

                            {{-- Checkout button --}}
                            <div class="ez" :class="activeField === 'cart_checkout_button' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_checkout_button', 'Ödeme Butonu')" style="margin-top: 16px;">
                                <span :style="getFieldStyle('cart_checkout_button', 'display: flex; width: 100%; justify-content: center; align-items: center; gap: 8px; border-radius: 16px; padding: 16px; background: rgb(84 62 232); color: white; font-size: 1rem; font-weight: 700;')" x-text="fields.cart_checkout_button || 'Ödemeye Geç'"></span>
                            </div>

                            {{-- Trust badges --}}
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-top: 16px;">
                                <div class="ez" :class="activeField === 'cart_trust_1' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_trust_1', 'Güven Rozeti 1')">
                                    <div style="text-align: center; background: #FAF9F6; border-radius: 12px; padding: 10px 6px;">
                                        <svg style="width: 16px; height: 16px; color: #22C55E; margin: 0 auto 4px;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                                        <span :style="getFieldStyle('cart_trust_1', 'font-size: 0.625rem; font-weight: 600; color: rgb(95 93 93);')" x-text="fields.cart_trust_1 || 'SSL Güvenlik'"></span>
                                    </div>
                                </div>
                                <div class="ez" :class="activeField === 'cart_trust_2' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_trust_2', 'Güven Rozeti 2')">
                                    <div style="text-align: center; background: #FAF9F6; border-radius: 12px; padding: 10px 6px;">
                                        <svg style="width: 16px; height: 16px; color: #3B82F6; margin: 0 auto 4px;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                                        <span :style="getFieldStyle('cart_trust_2', 'font-size: 0.625rem; font-weight: 600; color: rgb(95 93 93);')" x-text="fields.cart_trust_2 || 'Hızlı Kargo'"></span>
                                    </div>
                                </div>
                                <div class="ez" :class="activeField === 'cart_trust_3' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('cart_trust_3', 'Güven Rozeti 3')">
                                    <div style="text-align: center; background: #FAF9F6; border-radius: 12px; padding: 10px 6px;">
                                        <svg style="width: 16px; height: 16px; color: #F59E0B; margin: 0 auto 4px;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182"/></svg>
                                        <span :style="getFieldStyle('cart_trust_3', 'font-size: 0.625rem; font-weight: 600; color: rgb(95 93 93);')" x-text="fields.cart_trust_3 || 'Kolay İade'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
