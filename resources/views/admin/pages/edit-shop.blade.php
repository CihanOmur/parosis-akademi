@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Mağaza Sayfaları</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Canlı önizleme — düzenlemek için alanlara tıklayın</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('pages.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium
                  text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800
                  border border-slate-200 dark:border-slate-700
                  hover:bg-slate-50 dark:hover:bg-slate-700
                  rounded-xl transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
            </svg>
            Geri
        </a>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets-front/fonts/webfonts/poppins/stylesheet.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-front/fonts/webfonts/aeonik-pro-trial/stylesheet.css') }}" />
    <style>
        .lp { font-family: Poppins, sans-serif; font-size: 1rem; line-height: 1.75; color: rgb(95 93 93); }
        .lp h1,.lp h2,.lp h3,.lp h4,.lp h5,.lp h6 { font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; color: rgb(1 28 26); }
        .lp h1 { font-size: 2.25rem; line-height: 1.15; }
        .lp h2 { font-size: 1.875rem; line-height: 1.38; }

        .ez { position: relative; cursor: pointer; transition: all 0.15s; border-radius: 6px; }
        .ez:hover { outline: 2px dashed rgb(255 205 32); outline-offset: 4px; }
        .ez:hover::after { content: attr(data-label); position: absolute; top: -24px; left: 0; font-size: 11px; font-family: Inter, sans-serif; font-weight: 600; color: rgb(1 28 26); background: rgb(255 205 32); padding: 2px 10px; border-radius: 4px; white-space: nowrap; z-index: 10; }
        .ez-active { outline: 3px solid rgb(215 59 62) !important; outline-offset: 4px; background: rgb(215 59 62 / 0.05); }
        .ez-active::after { content: attr(data-label); position: absolute; top: -26px; left: 0; font-size: 11px; font-family: Inter, sans-serif; font-weight: 600; color: white; background: rgb(215 59 62); padding: 2px 10px; border-radius: 4px; white-space: nowrap; z-index: 10; }

        .toast-msg { position: fixed; bottom: 24px; right: 24px; z-index: 10000; padding: 12px 24px; border-radius: 12px; font-family: Inter, sans-serif; font-size: 0.875rem; font-weight: 500; box-shadow: 0 8px 24px rgba(0,0,0,0.15); transform: translateY(100px); opacity: 0; transition: all 0.3s ease; }
        .toast-msg.show { transform: translateY(0); opacity: 1; }
        .toast-msg.success { background: rgb(84 62 232); color: white; }
        .toast-msg.error { background: rgb(215 59 62); color: white; }

        .modal-input { width: 100%; padding: 0.75rem 1rem; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 10px; font-size: 1rem; outline: none; transition: border-color 0.2s; font-family: Poppins, sans-serif; color: rgb(1 28 26); box-sizing: border-box; }
        .modal-input:focus { border-color: rgb(84 62 232); }
        .modal-input-error,.modal-input-error:focus { border-color: rgb(215 59 62) !important; }
        .modal-textarea { resize: vertical; }
        .modal-apply-btn { padding: 0.6rem 1.5rem; border-radius: 10px; font-size: 0.875rem; font-weight: 600; color: white; border: none; background: rgb(84 62 232); cursor: pointer; font-family: Poppins, sans-serif; box-shadow: 0 4px 12px rgba(84,62,232,0.3); transition: opacity 0.2s; }
        .modal-apply-btn-disabled { opacity: 0.5; cursor: not-allowed !important; }

        .page-tabs { display: flex; gap: 4px; padding: 5px; background: #F1F0FB; border-radius: 14px; font-family: Inter, sans-serif; }
        .page-tab { display: inline-flex; align-items: center; gap: 7px; padding: 10px 20px; border-radius: 10px; font-size: 0.8125rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s; color: rgb(95 93 93); background: transparent; white-space: nowrap; }
        .page-tab svg { width: 16px; height: 16px; }
        .page-tab:hover:not(.page-tab-active) { background: white; color: rgb(1 28 26); }
        .page-tab-active { background: white; color: rgb(84 62 232); box-shadow: 0 2px 8px rgba(84,62,232,0.1); }
        .page-tab-badge { font-size: 0.625rem; font-weight: 700; padding: 2px 7px; border-radius: 5px; background: rgb(84 62 232 / 0.08); color: rgb(84 62 232); letter-spacing: 0.03em; }
        .page-tab-active .page-tab-badge { background: rgb(84 62 232); color: white; }

        .style-section { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgb(1 28 26 / 0.06); }
        .style-section-title { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: rgb(95 93 93); margin-bottom: 0.75rem; font-family: Inter, sans-serif; }
        .style-row { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.625rem; }
        .style-label { min-width: 62px; font-size: 0.8125rem; font-weight: 500; color: rgb(1 28 26); font-family: Poppins, sans-serif; }
        .style-select { flex: 1; padding: 0.5rem 0.75rem; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 8px; font-size: 0.8125rem; outline: none; transition: border-color 0.2s; font-family: Poppins, sans-serif; color: rgb(1 28 26); background: white; cursor: pointer; appearance: auto; }
        .style-select:focus { border-color: rgb(84 62 232); }
        .style-color-wrap { flex: 1; display: flex; align-items: center; gap: 0.5rem; }
        .style-color-input { width: 40px; height: 36px; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 8px; cursor: pointer; padding: 2px; background: white; }
        .style-color-input:focus { border-color: rgb(84 62 232); outline: none; }
        .style-color-hex { flex: 1; padding: 0.5rem 0.75rem; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 8px; font-size: 0.8125rem; outline: none; transition: border-color 0.2s; font-family: monospace; color: rgb(1 28 26); width: 90px; }
        .style-color-hex:focus { border-color: rgb(84 62 232); }
        .style-opacity-wrap { flex: 1; display: flex; align-items: center; gap: 0.5rem; }
        .style-opacity-range { flex: 1; height: 6px; -webkit-appearance: none; appearance: none; background: linear-gradient(to right, transparent, currentColor); border-radius: 3px; outline: none; cursor: pointer; }
        .style-opacity-range::-webkit-slider-thumb { -webkit-appearance: none; width: 18px; height: 18px; border-radius: 50%; background: white; border: 2px solid rgb(84 62 232); cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.15); }
        .style-opacity-range::-moz-range-thumb { width: 18px; height: 18px; border-radius: 50%; background: white; border: 2px solid rgb(84 62 232); cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.15); }
        .style-opacity-val { min-width: 44px; padding: 0.4rem 0.5rem; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 8px; font-size: 0.8125rem; outline: none; text-align: center; font-family: monospace; color: rgb(1 28 26); transition: border-color 0.2s; }
        .style-opacity-val:focus { border-color: rgb(84 62 232); }
        .style-reset-btn { padding: 0.4rem 0.75rem; border-radius: 8px; font-size: 0.75rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif; transition: all 0.15s; white-space: nowrap; }
        .style-reset-btn:hover { background: #F5F5F5; }
        .style-toggle-group { display: flex; gap: 4px; flex: 1; }
        .style-toggle { width: 36px; height: 36px; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; background: white; transition: all 0.15s; padding: 0; }
        .style-toggle svg { width: 16px; height: 16px; color: rgb(1 28 26); }
        .style-toggle:hover { border-color: rgb(84 62 232 / 0.3); }
        .style-toggle.active { background: rgb(84 62 232); border-color: rgb(84 62 232); }
        .style-toggle.active svg { color: white; }

        /* Product card preview */
        .product-card-preview { border-radius: 10px; overflow: hidden; background: white; }
        .product-card-img { width: 100%; height: 200px; object-fit: cover; display: block; }
        .product-card-info { padding: 20px 4px 8px; text-align: center; }
        .product-card-title { font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.125rem; font-weight: 700; color: rgb(1 28 26); line-height: 1.4; margin-bottom: 8px; }
        .product-card-price { font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.125rem; font-weight: 700; color: rgb(84 62 232); }
    </style>
@endsection

@section('content')
    <div x-data="shopEditor()" x-cloak>

        {{-- Language Tabs --}}
        <div class="mb-5">
            @include('admin.components.language-tabs', ['selectedLang' => $selectedLang])
        </div>

        {{-- Save Bar --}}
        <div class="mb-5 flex items-center justify-between bg-white dark:bg-slate-800 rounded-xl px-5 py-3 shadow-sm border border-slate-200/50 dark:border-slate-700/50">
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                </svg>
                <span x-show="!saving">Düzenlemek istediğiniz alana tıklayın</span>
                <span x-show="saving" style="color: rgb(84 62 232);">Kaydediliyor...</span>
            </div>
            <button type="button" @click="saveAll()"
                    :disabled="saving"
                    class="inline-flex items-center gap-2 px-5 py-2.5
                           bg-gradient-to-r from-fuchsia-500 to-purple-500
                           hover:from-fuchsia-600 hover:to-purple-600
                           text-white font-semibold rounded-xl text-sm
                           shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer
                           disabled:opacity-50 disabled:cursor-not-allowed">
                <svg x-show="!saving" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                </svg>
                <svg x-show="saving" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                Kaydet
            </button>
        </div>

        {{-- Page Tabs --}}
        <div class="mb-5">
            <div class="page-tabs" style="display: inline-flex;">
                <button type="button" class="page-tab" :class="pageTab === 'urunler' && 'page-tab-active'" @click="pageTab = 'urunler'">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/></svg>
                    Ürünler
                    <span class="page-tab-badge">/urunler</span>
                </button>
                <button type="button" class="page-tab" :class="pageTab === 'detay' && 'page-tab-active'" @click="pageTab = 'detay'">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                    Ürün Detay
                    <span class="page-tab-badge">/urun-detay</span>
                </button>
                <button type="button" class="page-tab" :class="pageTab === 'sepet' && 'page-tab-active'" @click="pageTab = 'sepet'">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    Sepet
                    <span class="page-tab-badge">/sepet</span>
                </button>
                <button type="button" class="page-tab" :class="pageTab === 'odeme' && 'page-tab-active'" @click="pageTab = 'odeme'">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25h-15a2.25 2.25 0 0 0-2.25 2.25v10.5a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                    Ödeme
                    <span class="page-tab-badge">/odeme</span>
                </button>
            </div>
        </div>

        {{-- LIVE PREVIEW --}}
        <div class="lp" style="border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid rgba(226,232,240,0.5);">

            @include('admin.pages.partials.shop-tab-urunler')
            @include('admin.pages.partials.shop-tab-detay')
            @include('admin.pages.partials.shop-tab-sepet')
            @include('admin.pages.partials.shop-tab-odeme')

        </div>

        {{-- EDIT MODAL --}}
        <template x-teleport="body">
        <div x-show="modal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;"
             @keydown.escape.window="closeModal()">
            <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="closeModal()"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
            <div x-show="modal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                 style="background: white; border-radius: 16px; box-shadow: 0 25px 50px rgba(1,28,26,0.2); width: 100%; max-width: 540px; overflow: hidden;"
                 @click.stop>

                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgb(1 28 26 / 0.06); display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 36px; height: 36px; background: rgb(84 62 232); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 18px; height: 18px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/>
                            </svg>
                        </div>
                        <h3 x-text="modalLabel" style="font-size: 1.125rem; font-weight: 600; color: rgb(1 28 26); font-family: 'Aeonik Pro TRIAL', sans-serif;"></h3>
                    </div>
                    <button type="button" @click="closeModal()"
                            style="width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgb(95 93 93); cursor: pointer; border: none; background: #F5F5F5; transition: background 0.2s;"
                            onmouseover="this.style.background='#EBEBEB'" onmouseout="this.style.background='#F5F5F5'">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div style="padding: 1.5rem;">
                    <template x-if="modalType === 'text'">
                        <div>
                            <input type="text" x-model="modalValue" x-ref="modalInput"
                                   :maxlength="modalMaxLength > 0 ? modalMaxLength : undefined"
                                   class="modal-input" :class="validationError && 'modal-input-error'"
                                   @keydown.enter="applyAndSave()"
                                   @input="validateField()">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 6px; min-height: 20px;">
                                <span x-show="validationError" x-text="validationError" style="font-size: 0.75rem; color: rgb(215 59 62); font-family: Poppins, sans-serif;"></span>
                                <span x-show="modalMaxLength > 0" x-text="(modalValue?.length || 0) + '/' + modalMaxLength" style="font-size: 0.7rem; color: #8D8D8D; font-family: Poppins, sans-serif; margin-left: auto;"></span>
                            </div>
                        </div>
                    </template>
                    <template x-if="modalType === 'textarea'">
                        <div>
                            <textarea x-model="modalValue" x-ref="modalTextarea" rows="4"
                                      :maxlength="modalMaxLength > 0 ? modalMaxLength : undefined"
                                      class="modal-input modal-textarea" :class="validationError && 'modal-input-error'"
                                      @input="validateField()"></textarea>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 6px; min-height: 20px;">
                                <span x-show="validationError" x-text="validationError" style="font-size: 0.75rem; color: rgb(215 59 62); font-family: Poppins, sans-serif;"></span>
                                <span x-show="modalMaxLength > 0" x-text="(modalValue?.length || 0) + '/' + modalMaxLength" style="font-size: 0.7rem; color: #8D8D8D; font-family: Poppins, sans-serif; margin-left: auto;"></span>
                            </div>
                        </div>
                    </template>

                    {{-- Style Section --}}
                    <template x-if="styleFields.includes(modalField)">
                        <div class="style-section">
                            <div class="style-section-title">Stil Ayarları</div>
                            <div class="style-row">
                                <span class="style-label">Biçim</span>
                                <div class="style-toggle-group">
                                    <button type="button" class="style-toggle" :class="getStyleProp('fontWeight') === 'bold' && 'active'" @click="setStyleProp('fontWeight', getStyleProp('fontWeight') === 'bold' ? '' : 'bold')" title="Kalın">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h7a4 4 0 0 1 0 8H6V4Zm0 8h8a4 4 0 0 1 0 8H6v-8Z"/></svg>
                                    </button>
                                    <button type="button" class="style-toggle" :class="getStyleProp('fontStyle') === 'italic' && 'active'" @click="setStyleProp('fontStyle', getStyleProp('fontStyle') === 'italic' ? '' : 'italic')" title="Yatık">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10 4h4m-2 0 -4 16m-2 0h4"/><line x1="14" y1="4" x2="10" y2="20" stroke-width="2"/></svg>
                                    </button>
                                    <div style="width: 1px; background: rgb(1 28 26 / 0.1); margin: 4px 2px;"></div>
                                    <button type="button" class="style-toggle" :class="getStyleProp('textAlign') === 'left' && 'active'" @click="setStyleProp('textAlign', getStyleProp('textAlign') === 'left' ? '' : 'left')" title="Sola">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h10.5M3.75 17.25h16.5"/></svg>
                                    </button>
                                    <button type="button" class="style-toggle" :class="(getStyleProp('textAlign') === 'center' || !getStyleProp('textAlign')) && 'active'" @click="setStyleProp('textAlign', 'center')" title="Ortala">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                                    </button>
                                    <button type="button" class="style-toggle" :class="getStyleProp('textAlign') === 'right' && 'active'" @click="setStyleProp('textAlign', getStyleProp('textAlign') === 'right' ? '' : 'right')" title="Sağa">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12H20.25M3.75 17.25h16.5"/></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="style-row">
                                <span class="style-label">Renk</span>
                                <div class="style-color-wrap">
                                    <input type="color" class="style-color-input" :value="getStyleProp('color') || getDefaultColor(modalField)" @input="setStyleProp('color', $event.target.value)">
                                    <input type="text" class="style-color-hex" :value="getStyleProp('color') || getDefaultColor(modalField)" @input="setStyleProp('color', $event.target.value)" maxlength="7">
                                </div>
                            </div>
                            <div class="style-row">
                                <span class="style-label">Saydamlık</span>
                                <div class="style-opacity-wrap">
                                    <input type="range" class="style-opacity-range" min="0" max="100" step="1" :value="getStyleProp('opacity') !== '' ? getStyleProp('opacity') : 100" @input="setStyleProp('opacity', $event.target.value)">
                                    <input type="text" class="style-opacity-val" :value="(getStyleProp('opacity') !== '' ? getStyleProp('opacity') : 100) + '%'" @change="let v=parseInt($event.target.value);if(!isNaN(v)){v=Math.max(0,Math.min(100,v));setStyleProp('opacity',v);}$event.target.value=(getStyleProp('opacity')!==''?getStyleProp('opacity'):100)+'%'" maxlength="4">
                                </div>
                            </div>
                            <div class="style-row">
                                <span class="style-label">Boyut</span>
                                <select class="style-select" :value="getStyleProp('fontSize') || ''" @change="setStyleProp('fontSize', $event.target.value)">
                                    <option value="">Varsayılan</option>
                                    <option value="0.75rem">12px</option>
                                    <option value="0.875rem">14px</option>
                                    <option value="1rem">16px</option>
                                    <option value="1.25rem">20px</option>
                                    <option value="1.5rem">24px</option>
                                    <option value="1.875rem">30px</option>
                                    <option value="2rem">32px</option>
                                    <option value="2.25rem">36px</option>
                                    <option value="2.5rem">40px</option>
                                    <option value="3rem">48px</option>
                                </select>
                            </div>
                            <div style="text-align: right; margin-top: 0.5rem;">
                                <button type="button" class="style-reset-btn" @click="resetFieldStyle()">Varsayılana Sıfırla</button>
                            </div>
                        </div>
                    </template>
                </div>

                <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" @click="closeModal()"
                            style="padding: 0.6rem 1.25rem; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif;"
                            onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='white'">
                        İptal
                    </button>
                    <button type="button" @click="applyAndSave()"
                            :disabled="saving || !!validationError"
                            class="modal-apply-btn" :class="(validationError || saving) && 'modal-apply-btn-disabled'">
                        <span x-show="!saving">Uygula</span>
                        <span x-show="saving">Kaydediliyor...</span>
                    </button>
                </div>
            </div>
            </div>
        </div>
        </template>

        {{-- Toast --}}
        <div id="toast-msg" class="toast-msg"></div>

    </div>
@endsection

@section('scripts')
<script>
    function shopEditor() {
        return {
            modal: false,
            modalField: '',
            modalLabel: '',
            modalValue: '',
            modalType: 'text',
            activeField: '',
            saving: false,
            pageTab: 'urunler',
            validationError: '',
            modalMaxLength: 0,

            fields: {
                // Ürünler
                products_title: @json(translateAttribute($shopPageInfo, 'products_title', $selectedLang) ?? ''),
                products_breadcrumb_home: @json(translateAttribute($shopPageInfo, 'products_breadcrumb_home', $selectedLang) ?? ''),
                products_breadcrumb_current: @json(translateAttribute($shopPageInfo, 'products_breadcrumb_current', $selectedLang) ?? ''),
                products_search_placeholder: @json(translateAttribute($shopPageInfo, 'products_search_placeholder', $selectedLang) ?? ''),
                products_search_button: @json(translateAttribute($shopPageInfo, 'products_search_button', $selectedLang) ?? ''),
                products_all_text: @json(translateAttribute($shopPageInfo, 'products_all_text', $selectedLang) ?? ''),
                products_add_to_cart: @json(translateAttribute($shopPageInfo, 'products_add_to_cart', $selectedLang) ?? ''),
                products_detail_button: @json(translateAttribute($shopPageInfo, 'products_detail_button', $selectedLang) ?? ''),
                products_empty_text: @json(translateAttribute($shopPageInfo, 'products_empty_text', $selectedLang) ?? ''),
                // Detay
                detail_title: @json(translateAttribute($shopPageInfo, 'detail_title', $selectedLang) ?? ''),
                detail_breadcrumb_products: @json(translateAttribute($shopPageInfo, 'detail_breadcrumb_products', $selectedLang) ?? ''),
                detail_discount_text: @json(translateAttribute($shopPageInfo, 'detail_discount_text', $selectedLang) ?? ''),
                detail_add_to_cart: @json(translateAttribute($shopPageInfo, 'detail_add_to_cart', $selectedLang) ?? ''),
                detail_sku_label: @json(translateAttribute($shopPageInfo, 'detail_sku_label', $selectedLang) ?? ''),
                detail_category_label: @json(translateAttribute($shopPageInfo, 'detail_category_label', $selectedLang) ?? ''),
                detail_description_tab: @json(translateAttribute($shopPageInfo, 'detail_description_tab', $selectedLang) ?? ''),
                detail_features_tab: @json(translateAttribute($shopPageInfo, 'detail_features_tab', $selectedLang) ?? ''),
                detail_related_subtitle: @json(translateAttribute($shopPageInfo, 'detail_related_subtitle', $selectedLang) ?? ''),
                detail_related_title: @json(translateAttribute($shopPageInfo, 'detail_related_title', $selectedLang) ?? ''),
                detail_related_button: @json(translateAttribute($shopPageInfo, 'detail_related_button', $selectedLang) ?? ''),
                detail_trust_1: @json(translateAttribute($shopPageInfo, 'detail_trust_1', $selectedLang) ?? ''),
                detail_trust_2: @json(translateAttribute($shopPageInfo, 'detail_trust_2', $selectedLang) ?? ''),
                detail_trust_3: @json(translateAttribute($shopPageInfo, 'detail_trust_3', $selectedLang) ?? ''),
                // Sepet
                cart_title: @json(translateAttribute($shopPageInfo, 'cart_title', $selectedLang) ?? ''),
                cart_breadcrumb_current: @json(translateAttribute($shopPageInfo, 'cart_breadcrumb_current', $selectedLang) ?? ''),
                cart_empty_title: @json(translateAttribute($shopPageInfo, 'cart_empty_title', $selectedLang) ?? ''),
                cart_empty_description: @json(translateAttribute($shopPageInfo, 'cart_empty_description', $selectedLang) ?? ''),
                cart_empty_button: @json(translateAttribute($shopPageInfo, 'cart_empty_button', $selectedLang) ?? ''),
                cart_items_header: @json(translateAttribute($shopPageInfo, 'cart_items_header', $selectedLang) ?? ''),
                cart_summary_header: @json(translateAttribute($shopPageInfo, 'cart_summary_header', $selectedLang) ?? ''),
                cart_subtotal: @json(translateAttribute($shopPageInfo, 'cart_subtotal', $selectedLang) ?? ''),
                cart_shipping: @json(translateAttribute($shopPageInfo, 'cart_shipping', $selectedLang) ?? ''),
                cart_shipping_free: @json(translateAttribute($shopPageInfo, 'cart_shipping_free', $selectedLang) ?? ''),
                cart_total: @json(translateAttribute($shopPageInfo, 'cart_total', $selectedLang) ?? ''),
                cart_checkout_button: @json(translateAttribute($shopPageInfo, 'cart_checkout_button', $selectedLang) ?? ''),
                cart_continue_shopping: @json(translateAttribute($shopPageInfo, 'cart_continue_shopping', $selectedLang) ?? ''),
                cart_coupon_label: @json(translateAttribute($shopPageInfo, 'cart_coupon_label', $selectedLang) ?? ''),
                cart_coupon_placeholder: @json(translateAttribute($shopPageInfo, 'cart_coupon_placeholder', $selectedLang) ?? ''),
                cart_coupon_apply: @json(translateAttribute($shopPageInfo, 'cart_coupon_apply', $selectedLang) ?? ''),
                cart_coupon_remove: @json(translateAttribute($shopPageInfo, 'cart_coupon_remove', $selectedLang) ?? ''),
                cart_coupon_discount: @json(translateAttribute($shopPageInfo, 'cart_coupon_discount', $selectedLang) ?? ''),
                cart_trust_1: @json(translateAttribute($shopPageInfo, 'cart_trust_1', $selectedLang) ?? ''),
                cart_trust_2: @json(translateAttribute($shopPageInfo, 'cart_trust_2', $selectedLang) ?? ''),
                cart_trust_3: @json(translateAttribute($shopPageInfo, 'cart_trust_3', $selectedLang) ?? ''),
                // Ödeme
                checkout_title: @json(translateAttribute($shopPageInfo, 'checkout_title', $selectedLang) ?? ''),
                checkout_breadcrumb_cart: @json(translateAttribute($shopPageInfo, 'checkout_breadcrumb_cart', $selectedLang) ?? ''),
                checkout_breadcrumb_current: @json(translateAttribute($shopPageInfo, 'checkout_breadcrumb_current', $selectedLang) ?? ''),
                checkout_step_1: @json(translateAttribute($shopPageInfo, 'checkout_step_1', $selectedLang) ?? ''),
                checkout_step_2: @json(translateAttribute($shopPageInfo, 'checkout_step_2', $selectedLang) ?? ''),
                checkout_step_3: @json(translateAttribute($shopPageInfo, 'checkout_step_3', $selectedLang) ?? ''),
                checkout_payment_title: @json(translateAttribute($shopPageInfo, 'checkout_payment_title', $selectedLang) ?? ''),
                checkout_payment_subtitle: @json(translateAttribute($shopPageInfo, 'checkout_payment_subtitle', $selectedLang) ?? ''),
                checkout_delivery_title: @json(translateAttribute($shopPageInfo, 'checkout_delivery_title', $selectedLang) ?? ''),
                checkout_delivery_subtitle: @json(translateAttribute($shopPageInfo, 'checkout_delivery_subtitle', $selectedLang) ?? ''),
                checkout_submit_button: @json(translateAttribute($shopPageInfo, 'checkout_submit_button', $selectedLang) ?? ''),
                checkout_summary_header: @json(translateAttribute($shopPageInfo, 'checkout_summary_header', $selectedLang) ?? ''),
                checkout_ssl_info: @json(translateAttribute($shopPageInfo, 'checkout_ssl_info', $selectedLang) ?? ''),
                // Ödeme Form Label'ları
                checkout_card_number_label: @json(translateAttribute($shopPageInfo, 'checkout_card_number_label', $selectedLang) ?? ''),
                checkout_card_name_label: @json(translateAttribute($shopPageInfo, 'checkout_card_name_label', $selectedLang) ?? ''),
                checkout_card_expiry_label: @json(translateAttribute($shopPageInfo, 'checkout_card_expiry_label', $selectedLang) ?? ''),
                checkout_card_cvv_label: @json(translateAttribute($shopPageInfo, 'checkout_card_cvv_label', $selectedLang) ?? ''),
                checkout_card_holder_label: @json(translateAttribute($shopPageInfo, 'checkout_card_holder_label', $selectedLang) ?? ''),
                checkout_card_expiry_preview: @json(translateAttribute($shopPageInfo, 'checkout_card_expiry_preview', $selectedLang) ?? ''),
                checkout_name_label: @json(translateAttribute($shopPageInfo, 'checkout_name_label', $selectedLang) ?? ''),
                checkout_email_label: @json(translateAttribute($shopPageInfo, 'checkout_email_label', $selectedLang) ?? ''),
                checkout_phone_label: @json(translateAttribute($shopPageInfo, 'checkout_phone_label', $selectedLang) ?? ''),
                checkout_address_label: @json(translateAttribute($shopPageInfo, 'checkout_address_label', $selectedLang) ?? ''),
                checkout_city_label: @json(translateAttribute($shopPageInfo, 'checkout_city_label', $selectedLang) ?? ''),
                checkout_district_label: @json(translateAttribute($shopPageInfo, 'checkout_district_label', $selectedLang) ?? ''),
                checkout_note_label: @json(translateAttribute($shopPageInfo, 'checkout_note_label', $selectedLang) ?? ''),
                // Placeholder'lar
                checkout_card_number_ph: @json(translateAttribute($shopPageInfo, 'checkout_card_number_ph', $selectedLang) ?? ''),
                checkout_card_name_ph: @json(translateAttribute($shopPageInfo, 'checkout_card_name_ph', $selectedLang) ?? ''),
                checkout_card_expiry_ph: @json(translateAttribute($shopPageInfo, 'checkout_card_expiry_ph', $selectedLang) ?? ''),
                checkout_card_cvv_ph: @json(translateAttribute($shopPageInfo, 'checkout_card_cvv_ph', $selectedLang) ?? ''),
                checkout_name_ph: @json(translateAttribute($shopPageInfo, 'checkout_name_ph', $selectedLang) ?? ''),
                checkout_email_ph: @json(translateAttribute($shopPageInfo, 'checkout_email_ph', $selectedLang) ?? ''),
                checkout_phone_ph: @json(translateAttribute($shopPageInfo, 'checkout_phone_ph', $selectedLang) ?? ''),
                checkout_address_ph: @json(translateAttribute($shopPageInfo, 'checkout_address_ph', $selectedLang) ?? ''),
                checkout_city_ph: @json(translateAttribute($shopPageInfo, 'checkout_city_ph', $selectedLang) ?? ''),
                checkout_district_ph: @json(translateAttribute($shopPageInfo, 'checkout_district_ph', $selectedLang) ?? ''),
                checkout_note_ph: @json(translateAttribute($shopPageInfo, 'checkout_note_ph', $selectedLang) ?? ''),
                checkout_card_preview_name: @json(translateAttribute($shopPageInfo, 'checkout_card_preview_name', $selectedLang) ?? ''),
                checkout_optional_text: @json(translateAttribute($shopPageInfo, 'checkout_optional_text', $selectedLang) ?? ''),
            },

            defaults: {
                products_title: 'Ürünlerimiz', products_breadcrumb_home: 'ANA SAYFA', products_breadcrumb_current: 'ÜRÜNLER',
                products_search_placeholder: 'Ürün arayın...', products_search_button: 'Ara', products_all_text: 'Tümü',
                products_add_to_cart: 'Sepete Ekle', products_detail_button: 'Detay', products_empty_text: 'Henüz ürün eklenmemiş.',
                detail_title: 'Ürün Detayı', detail_breadcrumb_products: 'ÜRÜNLER', detail_discount_text: 'İndirim',
                detail_add_to_cart: 'Sepete Ekle', detail_sku_label: 'SKU:', detail_category_label: 'Kategori:',
                detail_description_tab: 'Açıklama', detail_features_tab: 'Özellikler',
                detail_related_subtitle: 'Keşfedin', detail_related_title: 'Benzer Ürünler', detail_related_button: 'İncele',
                detail_trust_1: 'Hızlı Kargo', detail_trust_2: 'Güvenli Ödeme', detail_trust_3: 'Kolay İade',
                cart_title: 'Sepetim', cart_breadcrumb_current: 'SEPETİM',
                cart_empty_title: 'Sepetiniz henüz boş', cart_empty_description: 'Mağazamızdaki ürünlere göz atarak sepetinize ürün ekleyebilirsiniz.', cart_empty_button: 'Ürünlere Göz At',
                cart_items_header: 'Sepetinizdeki Ürünler', cart_summary_header: 'Sipariş Özeti',
                cart_subtotal: 'Ara Toplam', cart_shipping: 'Kargo', cart_shipping_free: 'Ücretsiz', cart_total: 'Toplam',
                cart_checkout_button: 'Ödemeye Geç', cart_continue_shopping: 'Alışverişe Devam Et',
                cart_coupon_label: 'İndirim Kodu', cart_coupon_placeholder: 'Kupon kodunuzu girin', cart_coupon_apply: 'Uygula',
                cart_coupon_remove: 'Kaldır', cart_coupon_discount: 'İndirim',
                cart_trust_1: 'SSL Güvenlik', cart_trust_2: 'Hızlı Kargo', cart_trust_3: 'Kolay İade',
                checkout_title: 'Ödeme', checkout_breadcrumb_cart: 'SEPETİM', checkout_breadcrumb_current: 'ÖDEME',
                checkout_step_1: 'Sepet', checkout_step_2: 'Ödeme', checkout_step_3: 'Onay',
                checkout_payment_title: 'Ödeme Yöntemi', checkout_payment_subtitle: '256-bit SSL ile korunmaktadır',
                checkout_delivery_title: 'Teslimat Bilgileri', checkout_delivery_subtitle: 'Siparişinizin ulaşacağı adres',
                checkout_submit_button: 'Siparişi Tamamla', checkout_summary_header: 'Sipariş Özeti',
                checkout_ssl_info: 'Kart bilgileriniz 256-bit SSL şifreleme ile korunmaktadır.',
                checkout_card_number_label: 'Kart Numarası', checkout_card_name_label: 'Kart Üzerindeki İsim',
                checkout_card_expiry_label: 'Son Kullanma', checkout_card_cvv_label: 'CVV',
                checkout_card_holder_label: 'Kart Sahibi', checkout_card_expiry_preview: 'Son Kullanma',
                checkout_name_label: 'Ad Soyad', checkout_email_label: 'E-posta',
                checkout_phone_label: 'Telefon', checkout_address_label: 'Teslimat Adresi',
                checkout_city_label: 'Şehir', checkout_district_label: 'İlçe',
                checkout_note_label: 'Sipariş Notu',
                checkout_card_number_ph: '0000 0000 0000 0000', checkout_card_name_ph: 'AD SOYAD',
                checkout_card_expiry_ph: 'AA/YY', checkout_card_cvv_ph: '•••',
                checkout_name_ph: 'Adınızı ve soyadınızı girin', checkout_email_ph: 'ornek@mail.com',
                checkout_phone_ph: '05XX XXX XX XX', checkout_address_ph: 'Mahalle, cadde, sokak, bina no, daire no',
                checkout_city_ph: 'İstanbul', checkout_district_ph: 'Kadıköy',
                checkout_note_ph: 'Siparişinizle ilgili notlar...',
                checkout_card_preview_name: 'AD SOYAD', checkout_optional_text: '(isteğe bağlı)',
            },

            styleFields: [
                // Ürünler
                'products_title', 'products_breadcrumb_home', 'products_breadcrumb_current',
                'products_search_button', 'products_all_text', 'products_add_to_cart',
                'products_empty_text',
                // Detay
                'detail_title', 'detail_breadcrumb_products',
                'detail_discount_text', 'detail_add_to_cart',
                'detail_sku_label', 'detail_category_label',
                'detail_trust_1', 'detail_trust_2', 'detail_trust_3',
                'detail_description_tab', 'detail_features_tab',
                'detail_related_subtitle', 'detail_related_title', 'detail_related_button',
                // Sepet
                'cart_title', 'cart_breadcrumb_current', 'cart_items_header', 'cart_summary_header',
                'cart_empty_title', 'cart_empty_description', 'cart_empty_button',
                'cart_continue_shopping',
                'cart_subtotal', 'cart_shipping', 'cart_shipping_free',
                'cart_coupon_label', 'cart_coupon_apply',
                'cart_total', 'cart_checkout_button',
                'cart_trust_1', 'cart_trust_2', 'cart_trust_3',
                // Ödeme
                'checkout_title', 'checkout_breadcrumb_current',
                'checkout_payment_title', 'checkout_delivery_title',
                'checkout_step_1', 'checkout_step_2', 'checkout_step_3',
                'checkout_payment_subtitle', 'checkout_delivery_subtitle',
                'checkout_card_holder_label', 'checkout_card_number_label',
                'checkout_card_name_label', 'checkout_card_expiry_label', 'checkout_card_cvv_label',
                'checkout_card_preview_name', 'checkout_card_expiry_preview',
                'checkout_name_label', 'checkout_email_label', 'checkout_phone_label',
                'checkout_address_label', 'checkout_city_label', 'checkout_district_label',
                'checkout_note_label', 'checkout_optional_text',
                'checkout_ssl_info', 'checkout_submit_button', 'checkout_summary_header',
                'breadcrumb_cart',
            ],

            fieldStyles: @php echo json_encode($shopPageInfo->field_styles ?? (object)[]); @endphp,
            customDefaults: @php echo json_encode($shopPageInfo->default_styles ?? (object)[]); @endphp,

            hardcodedDefaults: {
                products_title: { color: '#011c1a', fontSize: '', textAlign: '' },
                products_breadcrumb_home: { color: '#d73b3e', fontSize: '', textAlign: '' },
                products_breadcrumb_current: { color: '#5f5d5d', fontSize: '', textAlign: '' },
                detail_title: { color: '#011c1a', fontSize: '', textAlign: '' },
                cart_title: { color: '#011c1a', fontSize: '', textAlign: '' },
                checkout_title: { color: '#011c1a', fontSize: '', textAlign: '' },
            },

            _normDef(val) { if (!val) return null; if (typeof val === 'string') return { color: val, fontSize: '', textAlign: '' }; return val; },
            _getDefaults(field) { let d = this._normDef(this.customDefaults[field]); if (d) return d; return this.hardcodedDefaults[field] || { color: '#011c1a', fontSize: '', textAlign: '' }; },
            getDefaultColor(field) { return this._getDefaults(field).color || '#011c1a'; },

            getStyleProp(prop) { const s = this.fieldStyles[this.modalField]; return s ? (s[prop] || '') : ''; },
            setStyleProp(prop, value) { if (!this.fieldStyles[this.modalField]) { this.fieldStyles[this.modalField] = {}; } this.fieldStyles[this.modalField][prop] = value; },
            resetFieldStyle() { const defaults = this._getDefaults(this.modalField); this.fieldStyles[this.modalField] = { color: defaults.color || '#011c1a', fontSize: defaults.fontSize || '', fontFamily: '', fontWeight: '', fontStyle: '', textAlign: defaults.textAlign || '', opacity: '' }; },

            getFieldStyle(field, extraStyle) {
                const s = this.fieldStyles[field] || {};
                let style = extraStyle || '';
                if (s.fontSize) style += ' font-size: ' + s.fontSize + ';';
                if (s.color) style += ' color: ' + s.color + ';';
                if (s.opacity !== '' && s.opacity !== undefined && parseInt(s.opacity) < 100) style += ' opacity: ' + (parseInt(s.opacity) / 100) + ';';
                if (s.fontFamily) style += ' font-family: ' + s.fontFamily + ';';
                if (s.fontWeight) style += ' font-weight: ' + s.fontWeight + ';';
                if (s.fontStyle) style += ' font-style: ' + s.fontStyle + ';';
                if (s.textAlign) style += ' text-align: ' + s.textAlign + ';';
                return style;
            },

            nl2br(str) { return String(str).replace(/\n/g, '<br>'); },

            openModal(field, label, type = 'text') {
                this.modalField = field;
                this.modalLabel = label;
                this.modalValue = this.fields[field] || this.defaults[field] || '';
                this.modalType = type;
                this.activeField = field;
                this.validationError = '';
                this.modalMaxLength = this.getMaxLength(field);
                this.modal = true;
                this.$nextTick(() => { const input = this.$refs.modalInput || this.$refs.modalTextarea; if (input) input.focus(); });
            },

            closeModal() { this.modal = false; this.activeField = ''; },

            async applyAndSave() {
                this.validateField();
                if (this.validationError) return;
                this.fields[this.modalField] = this.modalValue;
                this.modal = false;
                this.activeField = '';
                await this.saveAll();
            },

            getMaxLength(field) {
                const limits = {
                    products_title: 150, products_breadcrumb_home: 30, products_breadcrumb_current: 30,
                    products_search_placeholder: 80, products_search_button: 30, products_all_text: 30,
                    products_add_to_cart: 50, products_detail_button: 50, products_empty_text: 200,
                    detail_title: 150, detail_breadcrumb_products: 30, detail_discount_text: 30,
                    detail_add_to_cart: 50, detail_sku_label: 30, detail_category_label: 30,
                    detail_description_tab: 50, detail_features_tab: 50,
                    detail_related_subtitle: 80, detail_related_title: 100, detail_related_button: 50,
                    detail_trust_1: 50, detail_trust_2: 50, detail_trust_3: 50,
                    cart_title: 100, cart_breadcrumb_current: 30,
                    cart_empty_title: 100, cart_empty_description: 255, cart_empty_button: 50,
                    cart_items_header: 80, cart_summary_header: 80,
                    cart_subtotal: 50, cart_shipping: 50, cart_shipping_free: 30, cart_total: 50,
                    cart_checkout_button: 50, cart_continue_shopping: 80,
                    cart_coupon_label: 50, cart_coupon_placeholder: 80, cart_coupon_apply: 30,
                    cart_coupon_remove: 30, cart_coupon_discount: 50,
                    cart_trust_1: 50, cart_trust_2: 50, cart_trust_3: 50,
                    checkout_title: 100, checkout_breadcrumb_cart: 30, checkout_breadcrumb_current: 30,
                    checkout_step_1: 30, checkout_step_2: 30, checkout_step_3: 30,
                    checkout_payment_title: 100, checkout_payment_subtitle: 150,
                    checkout_delivery_title: 100, checkout_delivery_subtitle: 150,
                    checkout_submit_button: 80, checkout_summary_header: 80, checkout_ssl_info: 255,
                    checkout_card_number_label: 50, checkout_card_name_label: 50,
                    checkout_card_expiry_label: 50, checkout_card_cvv_label: 30,
                    checkout_card_holder_label: 50, checkout_card_expiry_preview: 50,
                    checkout_name_label: 50, checkout_email_label: 50,
                    checkout_phone_label: 50, checkout_address_label: 50,
                    checkout_city_label: 50, checkout_district_label: 50,
                    checkout_note_label: 50,
                    checkout_card_number_ph: 50, checkout_card_name_ph: 50,
                    checkout_card_expiry_ph: 20, checkout_card_cvv_ph: 20,
                    checkout_name_ph: 80, checkout_email_ph: 80,
                    checkout_phone_ph: 50, checkout_address_ph: 100,
                    checkout_city_ph: 50, checkout_district_ph: 50,
                    checkout_note_ph: 100,
                    checkout_card_preview_name: 50, checkout_optional_text: 50,
                };
                return limits[field] || 0;
            },

            validateField() {
                const val = (this.modalValue || '').trim();
                this.validationError = '';
                const maxLen = this.modalMaxLength;
                if (maxLen > 0 && val.length > maxLen) { this.validationError = 'Maksimum ' + maxLen + ' karakter girebilirsiniz.'; }
            },

            async saveAll() {
                this.saving = true;
                try {
                    const formData = new FormData();
                    formData.append('lang', '{{ $selectedLang }}');
                    formData.append('_token', '{{ csrf_token() }}');
                    for (const [key, value] of Object.entries(this.fields)) { formData.append(key, value || ''); }
                    formData.append('field_styles', JSON.stringify(this.fieldStyles));
                    formData.append('default_styles', JSON.stringify(JSON.parse(JSON.stringify(this.customDefaults))));

                    const res = await fetch('{{ route('pages.update', ['id' => 'shop']) }}', {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                        body: formData,
                    });
                    const data = await res.json();
                    if (data.success) { this.showToast('Kaydedildi', 'success'); }
                    else { this.showToast('Hata oluştu', 'error'); }
                } catch (e) { this.showToast('Bağlantı hatası', 'error'); }
                this.saving = false;
            },

            showToast(msg, type) {
                const el = document.getElementById('toast-msg');
                el.textContent = msg;
                el.className = 'toast-msg ' + type + ' show';
                setTimeout(() => { el.classList.remove('show'); }, 2500);
            },
        };
    }
</script>
@endsection
