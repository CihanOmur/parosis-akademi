{{-- ═══ TAB 4: ÖDEME ═══ --}}
<div x-show="pageTab === 'odeme'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

    {{-- Breadcrumb --}}
    <section style="position: relative; z-index: 10; overflow: hidden; background-color: #FAF9F6; margin: 16px 20px 0; border-radius: 12px;">
        <div style="padding: 50px 0;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                <div style="text-align: center;">
                    <div class="ez" :class="activeField === 'checkout_title' && 'ez-active'" data-label="Başlık + Stil" @click="openModal('checkout_title', 'Ödeme Başlığı', 'textarea')">
                        <h1 :style="getFieldStyle('checkout_title', 'margin-bottom: 1.25rem; text-transform: capitalize; letter-spacing: normal; font-size: 2rem;')"
                            x-html="nl2br(fields.checkout_title || 'Ödeme')"></h1>
                    </div>
                    <nav style="font-size: 0.9375rem; font-weight: 500; text-transform: uppercase;">
                        <ul style="display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 4px; align-items: center;">
                            <li>
                                <span style="color: rgb(215 59 62);" x-text="fields.products_breadcrumb_home || 'ANA SAYFA'"></span>
                            </li>
                            <li style="color: rgb(95 93 93);">/</li>
                            <li>
                                <span class="ez" :class="activeField === 'checkout_breadcrumb_cart' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_breadcrumb_cart', 'Breadcrumb Sepet')"
                                      :style="getFieldStyle('checkout_breadcrumb_cart', 'color: rgb(215 59 62);')" x-text="fields.checkout_breadcrumb_cart || 'SEPETİM'"></span>
                            </li>
                            <li style="color: rgb(95 93 93);">/</li>
                            <li>
                                <span class="ez" :class="activeField === 'checkout_breadcrumb_current' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_breadcrumb_current', 'Breadcrumb Ödeme')"
                                      :style="getFieldStyle('checkout_breadcrumb_current', 'color: rgb(95 93 93);')" x-text="fields.checkout_breadcrumb_current || 'ÖDEME'"></span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div style="position: absolute; left: -192px; top: 0; z-index: -1; width: 371px; height: 327px; background: #BFC06F; filter: blur(250px);"></div>
        <div style="position: absolute; right: -144px; bottom: 80px; z-index: -1; width: 371px; height: 327px; background: #AAC3E9; filter: blur(200px);"></div>
    </section>

    {{-- Checkout Layout --}}
    <div style="background: white; padding: 32px 20px 40px;">
        <div style="max-width: 1200px; margin: 0 auto;">

            {{-- Steps --}}
            <div style="display: flex; justify-content: center; gap: 32px; margin-bottom: 40px;">
                <div class="ez" :class="activeField === 'checkout_step_1' && 'ez-active'" data-label="Adım 1" @click="openModal('checkout_step_1', 'Adım 1')">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="width: 28px; height: 28px; border-radius: 50%; background: rgb(84 62 232); color: white; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">1</span>
                        <span :style="getFieldStyle('checkout_step_1', 'font-size: 0.875rem; font-weight: 600; color: rgb(84 62 232);')" x-text="fields.checkout_step_1 || 'Sepet'"></span>
                    </div>
                </div>
                <div style="width: 40px; height: 2px; background: #E5E7EB; align-self: center;"></div>
                <div class="ez" :class="activeField === 'checkout_step_2' && 'ez-active'" data-label="Adım 2" @click="openModal('checkout_step_2', 'Adım 2')">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="width: 28px; height: 28px; border-radius: 50%; background: rgb(84 62 232); color: white; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">2</span>
                        <span :style="getFieldStyle('checkout_step_2', 'font-size: 0.875rem; font-weight: 600; color: rgb(84 62 232);')" x-text="fields.checkout_step_2 || 'Ödeme'"></span>
                    </div>
                </div>
                <div style="width: 40px; height: 2px; background: #E5E7EB; align-self: center;"></div>
                <div class="ez" :class="activeField === 'checkout_step_3' && 'ez-active'" data-label="Adım 3" @click="openModal('checkout_step_3', 'Adım 3')">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="width: 28px; height: 28px; border-radius: 50%; border: 2px solid #E5E7EB; color: #9CA3AF; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">3</span>
                        <span :style="getFieldStyle('checkout_step_3', 'font-size: 0.875rem; font-weight: 600; color: #9CA3AF;')" x-text="fields.checkout_step_3 || 'Onay'"></span>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 40px;">
                {{-- LEFT: Form sections --}}
                <div>
                    {{-- Payment section --}}
                    <div style="border: 1px solid #F3F4F6; border-radius: 20px; padding: 24px; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                            <div style="width: 36px; height: 36px; border-radius: 10px; background: rgba(84,62,232,0.1); display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 18px; height: 18px; color: rgb(84 62 232);" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25h-15a2.25 2.25 0 0 0-2.25 2.25v10.5a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                            </div>
                            <div>
                                <div class="ez" :class="activeField === 'checkout_payment_title' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_payment_title', 'Ödeme Yöntemi Başlığı')">
                                    <h4 :style="getFieldStyle('checkout_payment_title', 'font-size: 1rem; margin: 0;')" x-text="fields.checkout_payment_title || 'Ödeme Yöntemi'"></h4>
                                </div>
                                <div class="ez" :class="activeField === 'checkout_payment_subtitle' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_payment_subtitle', 'Ödeme Alt Başlık')">
                                    <span :style="getFieldStyle('checkout_payment_subtitle', 'font-size: 0.75rem; color: rgb(95 93 93);')" x-text="fields.checkout_payment_subtitle || '256-bit SSL ile korunmaktadır'"></span>
                                </div>
                            </div>
                        </div>
                        {{-- Card form preview --}}
                        <div style="margin-top: 16px;">
                            {{-- 3D Card Preview --}}
                            <div style="max-width: 380px; margin: 0 auto 20px; border-radius: 16px; background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); padding: 28px 24px; color: white; position: relative; overflow: hidden;">
                                <div style="position: absolute; inset: 0; background: linear-gradient(to top right, transparent, rgba(255,255,255,0.04), transparent);"></div>
                                <div style="position: relative;">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                        <div style="width: 42px; height: 30px; border-radius: 5px; background: linear-gradient(135deg, #ffd700, #b8860b); display: flex; align-items: center; justify-content: center;">
                                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px;">
                                                <div style="width: 6px; height: 6px; border-radius: 1px; background: rgba(218,165,32,0.5);"></div>
                                                <div style="width: 6px; height: 6px; border-radius: 1px; background: rgba(218,165,32,0.3);"></div>
                                                <div style="width: 6px; height: 6px; border-radius: 1px; background: rgba(218,165,32,0.5);"></div>
                                                <div style="width: 6px; height: 6px; border-radius: 1px; background: rgba(218,165,32,0.3);"></div>
                                                <div style="width: 6px; height: 6px; border-radius: 1px; background: rgba(218,165,32,0.5);"></div>
                                                <div style="width: 6px; height: 6px; border-radius: 1px; background: rgba(218,165,32,0.3);"></div>
                                            </div>
                                        </div>
                                        <span style="font-size: 1.1rem; font-weight: 700; letter-spacing: 0.1em; opacity: 0.8;">VISA</span>
                                    </div>
                                    <p style="margin-top: 24px; font-family: monospace; font-size: 1.2rem; letter-spacing: 0.15em; opacity: 0.9;">&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;</p>
                                    <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: flex-end;">
                                        <div>
                                            <p class="ez" :class="activeField === 'checkout_card_holder_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_card_holder_label', 'Kart Sahibi Label')" :style="getFieldStyle('checkout_card_holder_label', 'font-size: 9px; text-transform: uppercase; letter-spacing: 0.2em; opacity: 0.5; margin: 0; cursor: pointer;')" x-text="fields.checkout_card_holder_label || 'Kart Sahibi'"></p>
                                            <p class="ez" :class="activeField === 'checkout_card_preview_name' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_card_preview_name', 'Kart Preview İsim')" :style="getFieldStyle('checkout_card_preview_name', 'font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; margin: 4px 0 0; cursor: pointer;')" x-text="fields.checkout_card_preview_name || 'AD SOYAD'"></p>
                                        </div>
                                        <div style="text-align: right;">
                                            <p class="ez" :class="activeField === 'checkout_card_expiry_preview' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_card_expiry_preview', 'Son Kullanma Preview')" :style="getFieldStyle('checkout_card_expiry_preview', 'font-size: 9px; text-transform: uppercase; letter-spacing: 0.2em; opacity: 0.5; margin: 0; cursor: pointer;')" x-text="fields.checkout_card_expiry_preview || 'Son Kullanma'"></p>
                                            <p style="font-size: 12px; font-weight: 600; letter-spacing: 0.1em; margin: 4px 0 0;">&bull;&bull;/&bull;&bull;</p>
                                        </div>
                                    </div>
                                </div>
                                <div style="position: absolute; right: -40px; top: -40px; width: 160px; height: 160px; border-radius: 50%; background: rgba(255,255,255,0.04);"></div>
                                <div style="position: absolute; left: -20px; bottom: -50px; width: 130px; height: 130px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>
                            </div>

                            {{-- Card inputs --}}
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                <div>
                                    <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                        <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25h-15a2.25 2.25 0 0 0-2.25 2.25v10.5a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                                        <span class="ez" :class="activeField === 'checkout_card_number_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_card_number_label', 'Kart Numarası Label')" :style="getFieldStyle('checkout_card_number_label', '')" x-text="fields.checkout_card_number_label || 'Kart Numarası'"></span>
                                    </label>
                                    <div class="ez" :class="activeField === 'checkout_card_number_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_card_number_ph', 'Kart No Placeholder')">
                                        <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-family: monospace; font-size: 0.875rem; letter-spacing: 0.1em; color: #D1D5DB; pointer-events: none;" :placeholder="fields.checkout_card_number_ph || '0000 0000 0000 0000'" />
                                    </div>
                                </div>
                                <div>
                                    <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                        <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                        <span class="ez" :class="activeField === 'checkout_card_name_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_card_name_label', 'Kart İsim Label')" :style="getFieldStyle('checkout_card_name_label', '')" x-text="fields.checkout_card_name_label || 'Kart Üzerindeki İsim'"></span>
                                    </label>
                                    <div class="ez" :class="activeField === 'checkout_card_name_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_card_name_ph', 'Kart İsim Placeholder')">
                                        <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-size: 0.875rem; color: #D1D5DB; pointer-events: none;" :placeholder="fields.checkout_card_name_ph || 'AD SOYAD'" />
                                    </div>
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                                    <div>
                                        <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                            <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                                            <span class="ez" :class="activeField === 'checkout_card_expiry_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_card_expiry_label', 'Son Kullanma Label')" :style="getFieldStyle('checkout_card_expiry_label', '')" x-text="fields.checkout_card_expiry_label || 'Son Kullanma'"></span>
                                        </label>
                                        <div class="ez" :class="activeField === 'checkout_card_expiry_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_card_expiry_ph', 'Son Kullanma Placeholder')">
                                            <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-family: monospace; font-size: 0.875rem; letter-spacing: 0.1em; color: #D1D5DB; pointer-events: none;" :placeholder="fields.checkout_card_expiry_ph || 'AA/YY'" />
                                        </div>
                                    </div>
                                    <div>
                                        <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                            <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                                            <span class="ez" :class="activeField === 'checkout_card_cvv_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_card_cvv_label', 'CVV Label')" :style="getFieldStyle('checkout_card_cvv_label', '')" x-text="fields.checkout_card_cvv_label || 'CVV'"></span>
                                        </label>
                                        <div class="ez" :class="activeField === 'checkout_card_cvv_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_card_cvv_ph', 'CVV Placeholder')">
                                            <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-family: monospace; font-size: 0.875rem; letter-spacing: 0.1em; color: #D1D5DB; pointer-events: none;" :placeholder="fields.checkout_card_cvv_ph || '•••'" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Delivery section --}}
                    <div style="border: 1px solid #F3F4F6; border-radius: 20px; padding: 24px; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                            <div style="width: 36px; height: 36px; border-radius: 10px; background: rgba(16,185,129,0.1); display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 18px; height: 18px; color: #10B981;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            </div>
                            <div>
                                <div class="ez" :class="activeField === 'checkout_delivery_title' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_delivery_title', 'Teslimat Başlığı')">
                                    <h4 :style="getFieldStyle('checkout_delivery_title', 'font-size: 1rem; margin: 0;')" x-text="fields.checkout_delivery_title || 'Teslimat Bilgileri'"></h4>
                                </div>
                                <div class="ez" :class="activeField === 'checkout_delivery_subtitle' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_delivery_subtitle', 'Teslimat Alt Başlık')">
                                    <span :style="getFieldStyle('checkout_delivery_subtitle', 'font-size: 0.75rem; color: rgb(95 93 93);')" x-text="fields.checkout_delivery_subtitle || 'Siparişinizin ulaşacağı adres'"></span>
                                </div>
                            </div>
                        </div>
                        {{-- Delivery form preview --}}
                        <div style="margin-top: 16px; display: flex; flex-direction: column; gap: 12px;">
                            <div>
                                <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                    <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                    <span class="ez" :class="activeField === 'checkout_name_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_name_label', 'Ad Soyad Label')" :style="getFieldStyle('checkout_name_label', '')" x-text="fields.checkout_name_label || 'Ad Soyad'"></span> <span style="color: #F87171;">*</span>
                                </label>
                                <div class="ez" :class="activeField === 'checkout_name_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_name_ph', 'Ad Soyad Placeholder')">
                                    <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-size: 0.875rem; color: #D1D5DB; pointer-events: none;" :placeholder="fields.checkout_name_ph || 'Adınızı ve soyadınızı girin'" />
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                                <div>
                                    <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                        <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                                        <span class="ez" :class="activeField === 'checkout_email_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_email_label', 'E-posta Label')" :style="getFieldStyle('checkout_email_label', '')" x-text="fields.checkout_email_label || 'E-posta'"></span> <span style="color: #F87171;">*</span>
                                    </label>
                                    <div class="ez" :class="activeField === 'checkout_email_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_email_ph', 'E-posta Placeholder')">
                                        <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-size: 0.875rem; color: #D1D5DB; pointer-events: none;" :placeholder="fields.checkout_email_ph || 'ornek@mail.com'" />
                                    </div>
                                </div>
                                <div>
                                    <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                        <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                                        <span class="ez" :class="activeField === 'checkout_phone_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_phone_label', 'Telefon Label')" :style="getFieldStyle('checkout_phone_label', '')" x-text="fields.checkout_phone_label || 'Telefon'"></span>
                                    </label>
                                    <div class="ez" :class="activeField === 'checkout_phone_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_phone_ph', 'Telefon Placeholder')">
                                        <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-size: 0.875rem; color: #D1D5DB; pointer-events: none;" :placeholder="fields.checkout_phone_ph || '05XX XXX XX XX'" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                    <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                                    <span class="ez" :class="activeField === 'checkout_address_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_address_label', 'Adres Label')" :style="getFieldStyle('checkout_address_label', '')" x-text="fields.checkout_address_label || 'Teslimat Adresi'"></span> <span style="color: #F87171;">*</span>
                                </label>
                                <div class="ez" :class="activeField === 'checkout_address_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_address_ph', 'Adres Placeholder')">
                                    <textarea disabled rows="2" style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-size: 0.875rem; color: #D1D5DB; pointer-events: none; resize: none; font-family: inherit;" :placeholder="fields.checkout_address_ph || 'Mahalle, cadde, sokak, bina no, daire no'"></textarea>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                                <div>
                                    <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                        <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/></svg>
                                        <span class="ez" :class="activeField === 'checkout_city_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_city_label', 'Şehir Label')" :style="getFieldStyle('checkout_city_label', '')" x-text="fields.checkout_city_label || 'Şehir'"></span> <span style="color: #F87171;">*</span>
                                    </label>
                                    <div class="ez" :class="activeField === 'checkout_city_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_city_ph', 'Şehir Placeholder')">
                                        <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-size: 0.875rem; color: #D1D5DB; pointer-events: none;" :placeholder="fields.checkout_city_ph || 'İstanbul'" />
                                    </div>
                                </div>
                                <div>
                                    <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                        <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z"/></svg>
                                        <span class="ez" :class="activeField === 'checkout_district_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_district_label', 'İlçe Label')" :style="getFieldStyle('checkout_district_label', '')" x-text="fields.checkout_district_label || 'İlçe'"></span>
                                    </label>
                                    <div class="ez" :class="activeField === 'checkout_district_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_district_ph', 'İlçe Placeholder')">
                                        <input type="text" disabled style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-size: 0.875rem; color: #D1D5DB; pointer-events: none;" :placeholder="fields.checkout_district_ph || 'Kadıköy'" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8125rem; font-weight: 600; color: rgb(1 28 26); margin-bottom: 6px;">
                                    <svg style="width: 14px; height: 14px; color: #9CA3AF;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/></svg>
                                    <span class="ez" :class="activeField === 'checkout_note_label' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_note_label', 'Sipariş Notu Label')" :style="getFieldStyle('checkout_note_label', '')" x-text="fields.checkout_note_label || 'Sipariş Notu'"></span>
                                    <span class="ez" :class="activeField === 'checkout_optional_text' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_optional_text', 'İsteğe Bağlı Metni')" :style="getFieldStyle('checkout_optional_text', 'font-size: 0.6875rem; font-weight: 400; color: #9CA3AF;')" x-text="fields.checkout_optional_text || '(isteğe bağlı)'"></span>
                                </label>
                                <div class="ez" :class="activeField === 'checkout_note_ph' && 'ez-active'" data-label="Placeholder" @click="openModal('checkout_note_ph', 'Not Placeholder')">
                                    <textarea disabled rows="2" style="width: 100%; border-radius: 12px; border: 2px solid #F3F4F6; background: #FAFAFA; padding: 12px 16px; font-size: 0.875rem; color: #D1D5DB; pointer-events: none; resize: none; font-family: inherit;" :placeholder="fields.checkout_note_ph || 'Siparişinizle ilgili notlar...'"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SSL info --}}
                    <div class="ez" :class="activeField === 'checkout_ssl_info' && 'ez-active'" data-label="SSL Bilgi" @click="openModal('checkout_ssl_info', 'SSL Bilgi Metni', 'textarea')">
                        <div style="display: flex; align-items: center; gap: 10px; padding: 14px 16px; background: #F0FDF4; border-radius: 12px; border: 1px solid #BBF7D0;">
                            <svg style="width: 18px; height: 18px; color: #16A34A; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                            <span :style="getFieldStyle('checkout_ssl_info', 'font-size: 0.8125rem; color: #166534;')" x-text="fields.checkout_ssl_info || 'Kart bilgileriniz 256-bit SSL şifreleme ile korunmaktadır.'"></span>
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="ez" :class="activeField === 'checkout_submit_button' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_submit_button', 'Sipariş Butonu')" style="margin-top: 20px;">
                        <span :style="getFieldStyle('checkout_submit_button', 'display: flex; width: 100%; justify-content: center; align-items: center; gap: 8px; border-radius: 16px; padding: 18px; background: rgb(84 62 232); color: white; font-size: 1.05rem; font-weight: 700;')"
                              x-text="fields.checkout_submit_button || 'Siparişi Tamamla'"></span>
                    </div>
                </div>

                {{-- RIGHT: Order Summary --}}
                <div>
                    {{-- Info: Bu alanlar Sepet sekmesinden geliyor --}}
                    <div style="display: flex; align-items: center; gap: 8px; padding: 10px 14px; background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 10px; margin-bottom: 12px;">
                        <svg style="width: 16px; height: 16px; color: #3B82F6; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
                        <span style="font-size: 0.75rem; color: #1E40AF; line-height: 1.3;">Bu bölümdeki yazılar (Ara Toplam, Kargo, Toplam vb.) <strong>Sepet</strong> sekmesinden düzenlenir.</span>
                    </div>
                    <div style="border: 1px solid #F3F4F6; border-radius: 20px; overflow: hidden; position: sticky; top: 24px;">
                        <div style="border-bottom: 1px solid #F3F4F6; background: linear-gradient(to right, #FAF9F6, white); padding: 16px 20px;">
                            <div class="ez" :class="activeField === 'checkout_summary_header' && 'ez-active'" data-label="Düzenle + Stil" @click="openModal('checkout_summary_header', 'Özet Başlığı')">
                                <h4 :style="getFieldStyle('checkout_summary_header', 'font-size: 1.05rem;')" x-text="fields.checkout_summary_header || 'Sipariş Özeti'"></h4>
                            </div>
                        </div>
                        <div style="padding: 20px;">
                            {{-- Demo item --}}
                            <div style="display: flex; gap: 12px; padding-bottom: 16px; border-bottom: 1px solid #F3F4F6; margin-bottom: 16px;">
                                <div style="width: 56px; height: 56px; border-radius: 10px; background: #F5F5F5; flex-shrink: 0; overflow: hidden;">
                                    @if($products->count() > 0 && $products->first()->image)
                                    <img src="{{ asset($products->first()->image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
                                    @endif
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-size: 0.875rem; font-weight: 600; color: rgb(1 28 26);">{{ $products->count() > 0 ? $products->first()->name : 'Ürün Adı' }}</div>
                                    <div style="font-size: 0.75rem; color: rgb(95 93 93);">1 adet</div>
                                </div>
                                <span style="font-weight: 700; font-size: 0.875rem; color: rgb(84 62 232);">99,00 ₺</span>
                            </div>

                            <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 8px;">
                                <span style="color: rgb(95 93 93);" x-text="fields.cart_subtotal || 'Ara Toplam'"></span>
                                <span style="font-weight: 700;">99,00 ₺</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 16px;">
                                <span style="color: rgb(95 93 93);" x-text="fields.cart_shipping || 'Kargo'"></span>
                                <span style="font-size: 0.75rem; font-weight: 700; padding: 2px 10px; border-radius: 50px; background: #DCFCE7; color: #16A34A;" x-text="fields.cart_shipping_free || 'Ücretsiz'"></span>
                            </div>
                            <div style="border-top: 1px dashed #E5E7EB; padding-top: 12px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-weight: 700;" x-text="fields.cart_total || 'Toplam'"></span>
                                    <span style="font-size: 1.375rem; font-weight: 900; color: rgb(84 62 232); font-family: 'Aeonik Pro TRIAL', sans-serif;">99,00 ₺</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
