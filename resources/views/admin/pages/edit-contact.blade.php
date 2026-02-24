@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">İletişim Sayfası</h1>
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
        .lp {
            font-family: Poppins, sans-serif;
            font-size: 1rem;
            line-height: 1.75;
            color: rgb(95 93 93);
        }
        .lp h1, .lp h2, .lp h3, .lp h4, .lp h5, .lp h6 {
            font-family: 'Aeonik Pro TRIAL', sans-serif;
            font-weight: 700;
            color: rgb(1 28 26);
        }
        .lp h1 { font-size: 2.25rem; line-height: 1.15; }
        .lp h2 { font-size: 1.875rem; line-height: 1.38; }

        /* Editable zone */
        .ez {
            position: relative;
            cursor: pointer;
            transition: all 0.15s;
            border-radius: 6px;
        }
        .ez:hover {
            outline: 2px dashed rgb(255 205 32);
            outline-offset: 4px;
        }
        .ez:hover::after {
            content: attr(data-label);
            position: absolute;
            top: -24px;
            left: 0;
            font-size: 11px;
            font-family: Inter, sans-serif;
            font-weight: 600;
            color: rgb(1 28 26);
            background: rgb(255 205 32);
            padding: 2px 10px;
            border-radius: 4px;
            white-space: nowrap;
            z-index: 10;
        }

        /* Active (editing) state */
        .ez-active {
            outline: 3px solid rgb(215 59 62) !important;
            outline-offset: 4px;
            background: rgb(215 59 62 / 0.05);
        }
        .ez-active::after {
            content: attr(data-label);
            position: absolute;
            top: -26px;
            left: 0;
            font-size: 11px;
            font-family: Inter, sans-serif;
            font-weight: 600;
            color: white;
            background: rgb(215 59 62);
            padding: 2px 10px;
            border-radius: 4px;
            white-space: nowrap;
            z-index: 10;
        }

        /* Image editable: disable normal .ez hover */
        .ez.ez-img:hover {
            outline: none !important;
        }
        .ez.ez-img {
            position: relative;
            overflow: hidden;
        }
        .ez.ez-img::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(1, 28, 26, 0.55);
            opacity: 0;
            transition: opacity 0.2s;
            z-index: 2;
            border-radius: inherit;
            pointer-events: none;
        }
        .ez.ez-img::after {
            content: attr(data-label) !important;
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            font-size: 0.875rem !important;
            font-family: Inter, sans-serif;
            font-weight: 600;
            background: rgb(255 205 32) !important;
            color: rgb(1 28 26) !important;
            padding: 8px 20px !important;
            border-radius: 8px !important;
            white-space: nowrap;
            z-index: 3;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
        }
        .ez.ez-img:hover::before {
            opacity: 1;
        }
        .ez.ez-img:hover::after {
            opacity: 1 !important;
        }
        .ez.ez-img.ez-active {
            outline: none !important;
        }
        .ez.ez-img.ez-active::before {
            opacity: 1;
            background: rgba(215, 59, 62, 0.45);
        }
        .ez.ez-img.ez-active::after {
            opacity: 1 !important;
            background: rgb(215 59 62) !important;
            color: white !important;
        }

        .lp-placeholder::placeholder {
            color: #5F5D5D;
            opacity: 1;
        }

        /* Toast */
        .toast-msg {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 10000;
            padding: 12px 24px;
            border-radius: 12px;
            font-family: Inter, sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        .toast-msg.show {
            transform: translateY(0);
            opacity: 1;
        }
        .toast-msg.success {
            background: rgb(84 62 232);
            color: white;
        }
        .toast-msg.error {
            background: rgb(215 59 62);
            color: white;
        }

        /* Dynamic list add button */
        .ez-add-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            padding: 10px;
            border: 2px dashed rgb(84 62 232 / 0.25);
            border-radius: 8px;
            background: transparent;
            color: rgb(84 62 232);
            font-size: 0.8125rem;
            font-weight: 600;
            font-family: Poppins, sans-serif;
            cursor: pointer;
            transition: all 0.15s;
        }
        .ez-add-btn:hover {
            border-color: rgb(84 62 232);
            background: rgb(84 62 232 / 0.04);
        }
        .ez-remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgb(215 59 62);
            color: white;
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            line-height: 1;
            opacity: 0;
            transition: opacity 0.15s;
            z-index: 5;
        }
        .ez-list-item:hover .ez-remove-btn {
            opacity: 1;
        }

        /* Image upload area */
        .upload-drop-zone {
            border: 2px dashed rgb(84 62 232 / 0.3);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .upload-drop-zone:hover, .upload-drop-zone.dragover {
            border-color: rgb(84 62 232);
            background: rgb(84 62 232 / 0.04);
        }

        /* Tab buttons for image modal */
        /* Modal input/textarea */
        .modal-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid rgb(1 28 26 / 0.1);
            border-radius: 10px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s;
            font-family: Poppins, sans-serif;
            color: rgb(1 28 26);
            box-sizing: border-box;
        }
        .modal-input:focus { border-color: rgb(84 62 232); }
        .modal-input-error, .modal-input-error:focus { border-color: rgb(215 59 62) !important; }
        .modal-textarea { resize: vertical; }
        .modal-apply-btn {
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            border: none;
            background: rgb(84 62 232);
            cursor: pointer;
            font-family: Poppins, sans-serif;
            box-shadow: 0 4px 12px rgba(84, 62, 232, 0.3);
            transition: opacity 0.2s;
        }
        .modal-apply-btn-disabled { opacity: 0.5; cursor: not-allowed !important; }

        .img-tab { padding: 8px 16px; border-radius: 8px; font-size: 0.8125rem; font-weight: 500; border: none; cursor: pointer; transition: all 0.15s; font-family: Poppins, sans-serif; }
        .img-tab.active { background: rgb(84 62 232); color: white; }
        .img-tab:not(.active) { background: #F5F5F5; color: rgb(95 93 93); }
        .img-tab:not(.active):hover { background: #EBEBEB; }
    </style>
@endsection

@section('content')
    <div x-data="contactEditor()" x-cloak>

        {{-- Language Tabs --}}
        <div class="mb-5">
            @include('admin.components.language-tabs', ['selectedLang' => $selectedLang])
        </div>

        {{-- Kaydet Bar --}}
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

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- LIVE PREVIEW --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <div class="lp" style="border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid rgba(226,232,240,0.5);">

            {{-- ── Breadcrumb ── --}}
            <section style="position: relative; z-index: 10; overflow: hidden; background-color: #FAF9F6;">
                <div style="padding: 60px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <div style="text-align: center;">
                            <div class="ez" :class="activeField === 'title' && 'ez-active'" data-label="Düzenle" @click="openModal('title', 'Sayfa Başlığı')">
                                <h1 style="margin-bottom: 1.25rem; text-transform: capitalize; letter-spacing: normal;"
                                    x-text="fields.title || 'Bizimle Iletisim Kurun'"></h1>
                            </div>
                            <nav style="font-size: 1rem; font-weight: 500; text-transform: uppercase;">
                                <ul style="display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 4px; align-items: center;">
                                    <li>
                                        <span class="ez" :class="activeField === 'breadcrumb_home' && 'ez-active'" data-label="Düzenle" @click="openModal('breadcrumb_home', 'Breadcrumb Ana Sayfa')"
                                              style="color: rgb(215 59 62);" x-text="fields.breadcrumb_home || 'ANA SAYFA'"></span>
                                    </li>
                                    <li style="color: rgb(95 93 93);">/</li>
                                    <li>
                                        <span class="ez" :class="activeField === 'breadcrumb_current' && 'ez-active'" data-label="Düzenle" @click="openModal('breadcrumb_current', 'Breadcrumb Mevcut Sayfa')"
                                              style="color: rgb(95 93 93);" x-text="fields.breadcrumb_current || 'ILETISIM'"></span>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div style="position: absolute; left: -192px; top: 0; z-index: -1; width: 371px; height: 327px; background: #BFC06F; filter: blur(250px);"></div>
                <div style="position: absolute; right: -144px; bottom: 80px; z-index: -1; width: 371px; height: 327px; background: #AAC3E9; filter: blur(200px);"></div>
            </section>

            {{-- ── Contact Info Cards ── --}}
            <div style="background: white;">
                <div style="padding: 70px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <ul style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; list-style: none; padding: 0; margin: 0;">

                            {{-- Phone --}}
                            <li style="border-radius: 8px; background: #F5F5F5; padding: 2.75rem 2.25rem;">
                                <div style="width: 100px; height: 100px; background: rgb(84 62 232); border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                                    <img src="{{ asset('assets-front/img/icons/icon-white-phone-2.svg') }}" alt="" width="43" height="43" />
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                                    <template x-for="(phone, idx) in phones" :key="'phone-'+idx">
                                        <div class="ez ez-list-item" :class="activeField === 'phone_'+idx && 'ez-active'" data-label="Düzenle" @click="openListModal('phones', idx, 'Telefon')" style="position: relative;">
                                            <span x-text="phone"
                                                  style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.5rem; font-weight: 700; line-height: 1; color: rgb(1 28 26);"></span>
                                            <button type="button" class="ez-remove-btn" @click.stop="removeListItem('phones', idx)" title="Kaldır">&times;</button>
                                        </div>
                                    </template>
                                    <button type="button" class="ez-add-btn" @click="addListItem('phones')">
                                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                        Telefon Ekle
                                    </button>
                                </div>
                            </li>

                            {{-- Email --}}
                            <li style="border-radius: 8px; background: #F5F5F5; padding: 2.75rem 2.25rem;">
                                <div style="width: 100px; height: 100px; background: rgb(84 62 232); border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                                    <img src="{{ asset('assets-front/img/icons/icon-white-chat-2.svg') }}" alt="" width="43" height="43" />
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                                    <template x-for="(email, idx) in emails" :key="'email-'+idx">
                                        <div class="ez ez-list-item" :class="activeField === 'email_'+idx && 'ez-active'" data-label="Düzenle" @click="openListModal('emails', idx, 'E-posta')" style="position: relative;">
                                            <span x-text="email"
                                                  style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.5rem; font-weight: 700; line-height: 1; color: rgb(1 28 26);"></span>
                                            <button type="button" class="ez-remove-btn" @click.stop="removeListItem('emails', idx)" title="Kaldır">&times;</button>
                                        </div>
                                    </template>
                                    <button type="button" class="ez-add-btn" @click="addListItem('emails')">
                                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                        E-posta Ekle
                                    </button>
                                </div>
                            </li>

                            {{-- Address --}}
                            <li style="border-radius: 8px; background: #F5F5F5; padding: 2.75rem 2.25rem;">
                                <div style="width: 100px; height: 100px; background: rgb(84 62 232); border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                                    <img src="{{ asset('assets-front/img/icons/icon-white-location-pin.svg') }}" alt="" width="43" height="43" />
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                                    <template x-for="(addr, idx) in addresses" :key="'addr-'+idx">
                                        <div class="ez ez-list-item" :class="activeField === 'address_'+idx && 'ez-active'" data-label="Düzenle" @click="openListModal('addresses', idx, 'Adres')" style="position: relative;">
                                            <span x-text="addr"
                                                  style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.5rem; font-weight: 700; line-height: 1.4; color: rgb(1 28 26); white-space: pre-line;"></span>
                                            <button type="button" class="ez-remove-btn" @click.stop="removeListItem('addresses', idx)" title="Kaldır">&times;</button>
                                        </div>
                                    </template>
                                    <button type="button" class="ez-add-btn" @click="addListItem('addresses')">
                                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                        Adres Ekle
                                    </button>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            {{-- ── Contact Form Section ── --}}
            <div style="background: white; padding-bottom: 176px;">
                <div style="padding-bottom: 70px;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <div style="display: grid; grid-template-columns: 1fr minmax(0, 0.7fr); gap: 90px; align-items: center;">

                            {{-- Image (editable) --}}
                            <div>
                                <div class="ez ez-img" :class="activeField === 'contact_form_image' && 'ez-active'" data-label="Resmi Düzenle" @click="openModal('contact_form_image', 'İletişim Form Resmi', 'image')" style="display: inline-block;">
                                    <img :src="fields.contact_form_image ? (fields.contact_form_image.startsWith('http') ? fields.contact_form_image : '{{ url('/') }}/' + fields.contact_form_image) : '{{ asset('assets-front/img/images/th-1/contact-form-img.jpg') }}'"
                                         alt="contact-form-img" width="619" height="620" style="max-width: 100%; border-radius: 8px; display: block; margin: 0 auto;" />
                                </div>
                            </div>

                            {{-- Form Side --}}
                            <div>
                                <div style="margin-bottom: 40px;">
                                    <div class="ez" :class="activeField === 'subtitle' && 'ez-active'" data-label="Düzenle" @click="openModal('subtitle', 'Alt Başlık')" style="margin-bottom: 1.25rem;">
                                        <span x-text="fields.subtitle || 'ILETISIM'"
                                              style="display: block; text-transform: uppercase; font-size: 1rem; line-height: 1.5rem; color: rgb(95 93 93);"></span>
                                    </div>
                                    <div class="ez" :class="activeField === 'form_title' && 'ez-active'" data-label="Düzenle" @click="openModal('form_title', 'Form Başlığı')">
                                        <h2 x-text="fields.form_title || 'Sorulariniz mi var? Bizimle iletisime gecin'"></h2>
                                    </div>
                                </div>

                                {{-- Description --}}
                                <template x-if="fields.content">
                                    <div class="ez" :class="activeField === 'content' && 'ez-active'" data-label="Düzenle" @click="openModal('content', 'Sayfa Açıklaması', 'textarea')" style="margin-bottom: 2.5rem;">
                                        <p x-text="fields.content" style="color: rgb(95 93 93); line-height: 1.75; font-size: 1rem;"></p>
                                    </div>
                                </template>

                                {{-- Form Description --}}
                                <template x-if="fields.form_description">
                                    <div class="ez" :class="activeField === 'form_description' && 'ez-active'" data-label="Düzenle" @click="openModal('form_description', 'Form Açıklaması', 'textarea')" style="margin-bottom: 2.5rem;">
                                        <p x-text="fields.form_description" style="color: rgb(95 93 93); font-size: 0.875rem; line-height: 1.75;"></p>
                                    </div>
                                </template>

                                {{-- Form mockup (inputs are editable) --}}
                                <div>
                                    <div style="display: grid; grid-template-columns: 1fr; row-gap: 2.5rem;">
                                        <div class="ez" :class="activeField === 'form_name_placeholder' && 'ez-active'" data-label="Düzenle" @click="openModal('form_name_placeholder', 'İsim Alanı Placeholder')">
                                            <div style="width: 100%; border-bottom: 1px solid rgb(1 28 26 / 0.25); padding-bottom: 0.75rem; font-size: 1rem; line-height: 1.5rem; font-family: Poppins, sans-serif; color: #5F5D5D;"
                                                 x-text="fields.form_name_placeholder || 'Ad Soyad'"></div>
                                        </div>
                                        <div class="ez" :class="activeField === 'form_email_placeholder' && 'ez-active'" data-label="Düzenle" @click="openModal('form_email_placeholder', 'E-posta Alanı Placeholder')">
                                            <div style="width: 100%; border-bottom: 1px solid rgb(1 28 26 / 0.25); padding-bottom: 0.75rem; font-size: 1rem; line-height: 1.5rem; font-family: Poppins, sans-serif; color: #5F5D5D;"
                                                 x-text="fields.form_email_placeholder || 'E-posta adresiniz'"></div>
                                        </div>
                                        <div class="ez" :class="activeField === 'form_message_placeholder' && 'ez-active'" data-label="Düzenle" @click="openModal('form_message_placeholder', 'Mesaj Alanı Placeholder')" style="margin-top: 2.5rem;">
                                            <div style="width: 100%; border-bottom: 1px solid rgb(1 28 26 / 0.25); font-size: 1rem; line-height: 1.5rem; font-family: Poppins, sans-serif; color: #5F5D5D;"
                                                 x-text="fields.form_message_placeholder || 'Size nasil yardimci olabiliriz?'"></div>
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 2rem; margin-top: 0.875rem;">
                                        <div class="ez" :class="activeField === 'form_privacy_text' && 'ez-active'" data-label="Düzenle" @click="openModal('form_privacy_text', 'Gizlilik Politikası Metni')">
                                            <label style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.875rem; color: #8D8D8D; cursor: pointer;">
                                                <span style="display: inline-block; width: 1rem; height: 1rem; border-radius: 50%; border: 1px solid rgb(1 28 26 / 0.75);"></span>
                                                <span x-text="fields.form_privacy_text || 'Gizlilik Politikasini kabul ediyorum.'"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ez" :class="activeField === 'form_button_text' && 'ez-active'" data-label="Düzenle" @click="openModal('form_button_text', 'Form Gönder Butonu Yazısı')">
                                        <div style="position: relative; display: inline-flex; align-items: center; overflow: hidden; border-radius: 52px; padding: 1rem 70px 1rem 30px; background-color: rgb(84 62 232); color: #fff; font-size: 1rem; line-height: 1.5rem; margin-top: 10px;">
                                            <span x-text="fields.form_button_text || 'Mesajinizi Gonderin'"></span>
                                            <span style="position: absolute; right: 5px; display: inline-flex; width: 2.75rem; height: 2.75rem; align-items: center; justify-content: center; border-radius: 50%; background: white;">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="" width="13" height="12" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ── CTA Section ── --}}
            <div style="position: relative; z-index: 10; overflow: hidden; background: rgb(84 62 232); border-radius: 8px; margin: 1.5rem; display: grid; grid-template-columns: 0.8fr 1fr; gap: 56px;">
                {{-- CTA Image --}}
                <div style="position: relative; order: 1;">
                    <div class="ez ez-img" :class="activeField === 'cta_image' && 'ez-active'" data-label="Resmi Düzenle" @click="openModal('cta_image', 'CTA Resmi', 'image')" style="height: 100%; display: flex; align-items: flex-end;">
                        <img :src="fields.cta_image ? (fields.cta_image.startsWith('http') ? fields.cta_image : '{{ url('/') }}/' + fields.cta_image) : '{{ asset('assets-front/img/images/th-1/cta-img.png') }}'"
                             alt="cta-img" style="max-width: 100%; display: block;" />
                    </div>
                </div>

                {{-- CTA Content --}}
                <div style="order: 2; padding: 48px 24px 48px 0;">
                    <div style="max-width: 530px;">
                        <div class="ez" :class="activeField === 'cta_label' && 'ez-active'" data-label="Düzenle" @click="openModal('cta_label', 'CTA Etiket')" style="margin-bottom: 1.25rem;">
                            <span x-text="fields.cta_label || 'HEMEN BASLAYIN'"
                                  style="display: block; text-transform: uppercase; color: rgb(255 205 32); font-size: 1rem; font-weight: 500;"></span>
                        </div>
                        <div class="ez" :class="activeField === 'cta_title' && 'ez-active'" data-label="Düzenle" @click="openModal('cta_title', 'CTA Başlık')">
                            <h2 x-text="fields.cta_title || 'Uygun Fiyatli Online Kurslar & Ogrenme Firsatlari'"
                                style="color: white !important; font-size: 1.875rem; line-height: 1.38;"></h2>
                        </div>
                        <div class="ez" :class="activeField === 'cta_description' && 'ez-active'" data-label="Düzenle" @click="openModal('cta_description', 'CTA Açıklama', 'textarea')" style="margin-top: 1.75rem; margin-bottom: 30px;">
                            <p x-text="fields.cta_description || 'Kariyerinizi bir adim oteye tasiyacak egitimlerle tanismaya hazir misiniz? Hemen kayit olun ve ogrenmeye baslayin.'"
                               style="color: rgba(255,255,255,0.8); font-size: 1rem; line-height: 1.75;"></p>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div class="ez" :class="activeField === 'cta_button_text' && 'ez-active'" data-label="Düzenle" @click="openModal('cta_button_text', 'CTA Buton Yazısı')">
                                <div style="position: relative; display: inline-flex; align-items: center; overflow: hidden; border-radius: 52px; padding: 1rem 70px 1rem 30px; background-color: rgb(255 205 32); color: rgb(1 28 26); font-size: 1rem; line-height: 1.5rem;">
                                    <span x-text="fields.cta_button_text || 'Ogrenmeye Basla'"></span>
                                    <span style="position: absolute; right: 5px; display: inline-flex; width: 2.75rem; height: 2.75rem; align-items: center; justify-content: center; border-radius: 50%; background: rgb(1 28 26);">
                                        <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-arrow-right.svg') }}" alt="" width="13" height="12" />
                                    </span>
                                </div>
                            </div>
                            <div class="ez" :class="activeField === 'cta_button_url' && 'ez-active'" data-label="Düzenle" @click="openModal('cta_button_url', 'CTA Buton URL')">
                                <span style="color: rgba(255,255,255,0.5); font-size: 0.75rem; font-family: monospace; border: 1px dashed rgba(255,255,255,0.3); padding: 4px 10px; border-radius: 6px;"
                                      x-text="fields.cta_button_url || '/kurslar'"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Decorative --}}
                <img src="{{ asset('assets-front/img/abstracts/abstract-golden-yellow-dash-2.svg') }}" alt="" width="44" height="37" style="position: absolute; left: 400px; top: 64px; z-index: -1;" />
                <img src="{{ asset('assets-front/img/abstracts/curve-1.svg') }}" alt="" width="155" height="155" style="position: absolute; left: 24px; top: 56px; z-index: 10;" />
                <img src="{{ asset('assets-front/img/abstracts/abstract-dots-4-white.svg') }}" alt="" width="108" height="67" style="position: absolute; bottom: 0; right: 0; z-index: -1;" />
            </div>

        </div>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- EDIT MODAL (text / textarea) --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <template x-teleport="body">
        <div x-show="modal && modalType !== 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;"
             @keydown.escape.window="closeModal()">
            <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="closeModal()"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
            <div x-show="modal && modalType !== 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
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
                </div>

                <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" @click="closeModal()"
                            style="padding: 0.6rem 1.25rem; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif; transition: background 0.2s;"
                            onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='white'">
                        İptal
                    </button>
                    <button type="button" @click="applyAndSave()"
                            :disabled="saving || !!validationError"
                            class="modal-apply-btn" :class="(validationError || saving) && 'modal-apply-btn-disabled'"
                            onmouseover="if(!this.disabled) this.style.opacity='0.9'" onmouseout="if(!this.disabled) this.style.opacity='1'">
                        <span x-show="!saving">Uygula</span>
                        <span x-show="saving">Kaydediliyor...</span>
                    </button>
                </div>
            </div>
            </div>
        </div>
        </template>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- IMAGE MODAL (URL + File Upload) --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <template x-teleport="body">
        <div x-show="modal && modalType === 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;"
             @keydown.escape.window="closeModal()">
            <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="closeModal()"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
            <div x-show="modal && modalType === 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                 style="background: white; border-radius: 16px; box-shadow: 0 25px 50px rgba(1,28,26,0.2); width: 100%; max-width: 580px; overflow: hidden;"
                 @click.stop>

                {{-- Header --}}
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgb(1 28 26 / 0.06); display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 36px; height: 36px; background: rgb(84 62 232); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 18px; height: 18px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/>
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

                {{-- Tabs --}}
                <div style="padding: 1rem 1.5rem 0; display: flex; gap: 0.5rem;">
                    <button type="button" class="img-tab" :class="imgTab === 'upload' ? 'active' : ''" @click="imgTab = 'upload'">Dosya Yükle</button>
                    <button type="button" class="img-tab" :class="imgTab === 'url' ? 'active' : ''" @click="imgTab = 'url'">URL Gir</button>
                </div>

                <div style="padding: 1.5rem;">
                    {{-- Preview --}}
                    <template x-if="imgPreview">
                        <div style="margin-bottom: 1rem; border-radius: 10px; overflow: hidden; border: 1px solid rgb(1 28 26 / 0.08);">
                            <img :src="imgPreview" style="max-width: 100%; max-height: 200px; display: block; margin: 0 auto;" />
                        </div>
                    </template>

                    {{-- Upload Tab --}}
                    <div x-show="imgTab === 'upload'">
                        <div class="upload-drop-zone" :class="imgDragover && 'dragover'"
                             @click="$refs.fileInput.click()"
                             @dragover.prevent="imgDragover = true"
                             @dragleave.prevent="imgDragover = false"
                             @drop.prevent="handleDrop($event)">
                            <input type="file" x-ref="fileInput" accept=".jpg,.jpeg,.png,.gif,.webp,.svg,.ico" style="display: none;" @change="handleFileSelect($event)" />
                            <svg style="width: 2.5rem; height: 2.5rem; color: rgb(84 62 232); opacity: 0.5; margin: 0 auto 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                            </svg>
                            <p style="font-size: 0.875rem; color: rgb(95 93 93); margin: 0;">
                                <span x-show="!uploading">Tıklayın veya sürükleyip bırakın</span>
                                <span x-show="uploading" style="color: rgb(84 62 232);">Yükleniyor...</span>
                            </p>
                            <p style="font-size: 0.75rem; color: #8D8D8D; margin: 0.25rem 0 0;">JPG, PNG, GIF, WEBP, SVG, ICO (max 5MB)</p>
                        </div>
                    </div>

                    {{-- URL Tab --}}
                    <div x-show="imgTab === 'url'">
                        <input type="text" x-model="modalValue" placeholder="https://... veya uploads/pages/..."
                               style="width: 100%; padding: 0.75rem 1rem; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 10px; font-size: 0.9375rem; outline: none; transition: border-color 0.2s; font-family: Poppins, sans-serif; color: rgb(1 28 26);"
                               onfocus="this.style.borderColor='rgb(84 62 232)'" onblur="this.style.borderColor='rgb(1 28 26 / 0.1)'"
                               @keydown.enter="applyAndSave()"
                               @input="imgPreview = $event.target.value.startsWith('http') ? $event.target.value : ($event.target.value ? '{{ url('/') }}/' + $event.target.value : '')">
                    </div>
                </div>

                {{-- Footer --}}
                <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: space-between; align-items: center;">
                    <button type="button" @click="modalValue = ''; imgPreview = ''"
                            style="padding: 0.6rem 1rem; border-radius: 10px; font-size: 0.8125rem; font-weight: 500; color: rgb(215 59 62); border: 1px solid rgb(215 59 62 / 0.2); background: white; cursor: pointer; font-family: Poppins, sans-serif;"
                            onmouseover="this.style.background='rgb(215 59 62 / 0.04)'" onmouseout="this.style.background='white'">
                        Resmi Kaldır
                    </button>
                    <div style="display: flex; gap: 0.75rem;">
                        <button type="button" @click="closeModal()"
                                style="padding: 0.6rem 1.25rem; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif;"
                                onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='white'">
                            İptal
                        </button>
                        <button type="button" @click="applyAndSave()"
                                :disabled="saving"
                                style="padding: 0.6rem 1.5rem; border-radius: 10px; font-size: 0.875rem; font-weight: 600; color: white; border: none; background: rgb(84 62 232); cursor: pointer; font-family: Poppins, sans-serif; box-shadow: 0 4px 12px rgba(84 62 232 / 0.3);"
                                onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                            <span x-show="!saving">Uygula</span>
                            <span x-show="saving">Kaydediliyor...</span>
                        </button>
                    </div>
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
    function contactEditor() {
        return {
            modal: false,
            modalField: '',
            modalLabel: '',
            modalValue: '',
            modalType: 'text',
            activeField: '',
            saving: false,
            imgTab: 'upload',
            imgPreview: '',
            imgDragover: false,
            uploading: false,
            validationError: '',
            modalMaxLength: 0,

            // Dynamic arrays
            phones: @json($contactPageInfo->phones ?? []),
            emails: @json($contactPageInfo->emails ?? []),
            addresses: @json($contactPageInfo->addresses ?? []),

            // List editing state
            listField: '',
            listIndex: -1,

            fields: {
                title: @json(translateAttribute($contactPageInfo, 'title', $selectedLang) ?? ''),
                subtitle: @json(translateAttribute($contactPageInfo, 'subtitle', $selectedLang) ?? ''),
                content: @json(translateAttribute($contactPageInfo, 'description', $selectedLang) ?? ''),
                form_title: @json(translateAttribute($contactPageInfo, 'form_title', $selectedLang) ?? ''),
                form_description: @json(translateAttribute($contactPageInfo, 'form_description', $selectedLang) ?? ''),
                form_name_placeholder: @json(translateAttribute($contactPageInfo, 'form_name_placeholder', $selectedLang) ?? ''),
                form_email_placeholder: @json(translateAttribute($contactPageInfo, 'form_email_placeholder', $selectedLang) ?? ''),
                form_message_placeholder: @json(translateAttribute($contactPageInfo, 'form_message_placeholder', $selectedLang) ?? ''),
                form_privacy_text: @json(translateAttribute($contactPageInfo, 'form_privacy_text', $selectedLang) ?? ''),
                form_button_text: @json(translateAttribute($contactPageInfo, 'form_button_text', $selectedLang) ?? ''),
                contact_form_image: @json($contactPageInfo->contact_form_image ?? ''),
                form_action_url: @json($contactPageInfo->form_action_url ?? ''),
                cta_label: @json(translateAttribute($contactPageInfo, 'cta_label', $selectedLang) ?? ''),
                cta_title: @json(translateAttribute($contactPageInfo, 'cta_title', $selectedLang) ?? ''),
                cta_description: @json(translateAttribute($contactPageInfo, 'cta_description', $selectedLang) ?? ''),
                cta_button_text: @json(translateAttribute($contactPageInfo, 'cta_button_text', $selectedLang) ?? ''),
                cta_button_url: @json($contactPageInfo->cta_button_url ?? ''),
                cta_image: @json($contactPageInfo->cta_image ?? ''),
                breadcrumb_home: @json(translateAttribute($contactPageInfo, 'breadcrumb_home', $selectedLang) ?? ''),
                breadcrumb_current: @json(translateAttribute($contactPageInfo, 'breadcrumb_current', $selectedLang) ?? ''),
            },

            defaults: {
                title: 'Bizimle Iletisim Kurun',
                subtitle: 'ILETISIM',
                form_title: 'Sorulariniz mi var? Bizimle iletisime gecin',
                form_name_placeholder: 'Ad Soyad',
                form_email_placeholder: 'E-posta adresiniz',
                form_message_placeholder: 'Size nasil yardimci olabiliriz?',
                form_privacy_text: 'Gizlilik Politikasini kabul ediyorum.',
                form_button_text: 'Mesajinizi Gonderin',
                cta_label: 'HEMEN BASLAYIN',
                cta_title: 'Uygun Fiyatli Online Kurslar & Ogrenme Firsatlari',
                cta_description: 'Kariyerinizi bir adim oteye tasiyacak egitimlerle tanismaya hazir misiniz? Hemen kayit olun ve ogrenmeye baslayin.',
                cta_button_text: 'Ogrenmeye Basla',
                cta_button_url: '/kurslar',
                breadcrumb_home: 'ANA SAYFA',
                breadcrumb_current: 'ILETISIM',
            },

            openModal(field, label, type = 'text') {
                this.modalField = field;
                this.modalLabel = label;
                this.modalValue = this.fields[field] || this.defaults[field] || '';
                this.modalType = type;
                this.activeField = field;
                this.validationError = '';
                this.listField = '';
                this.listIndex = -1;
                this.modalMaxLength = this.getMaxLength(field);
                this.modal = true;

                if (type === 'image') {
                    this.imgTab = 'upload';
                    this.imgDragover = false;
                    const val = this.fields[field];
                    if (val) {
                        this.imgPreview = val.startsWith('http') ? val : '{{ url('/') }}/' + val;
                    } else {
                        this.imgPreview = '';
                    }
                }

                this.$nextTick(() => {
                    const input = this.$refs.modalInput || this.$refs.modalTextarea;
                    if (input) input.focus();
                });
            },

            closeModal() {
                this.modal = false;
                this.activeField = '';
            },

            async applyAndSave() {
                this.validateField();
                if (this.validationError) return;

                if (this.listField) {
                    if (!this.modalValue.trim()) {
                        // Empty value — remove the item
                        this[this.listField].splice(this.listIndex, 1);
                    } else {
                        this[this.listField][this.listIndex] = this.modalValue;
                    }
                    this.listField = '';
                    this.listIndex = -1;
                } else {
                    this.fields[this.modalField] = this.modalValue;
                }
                this.modal = false;
                this.activeField = '';
                await this.saveAll();
            },

            // ─── Dynamic List Handlers ─────────────────────────────────────

            openListModal(listName, index, label) {
                this.listField = listName;
                this.listIndex = index;
                this.modalField = '';
                this.modalLabel = label + ' ' + (index + 1);
                this.modalValue = this[listName][index];
                this.modalType = listName === 'addresses' ? 'textarea' : 'text';
                this.validationError = '';
                this.modalMaxLength = this.getMaxLength(listName);
                this.activeField = listName.replace('s','') + '_' + index;
                this.modal = true;

                this.$nextTick(() => {
                    const input = listName === 'addresses' ? this.$refs.modalTextarea : this.$refs.modalInput;
                    if (input) input.focus();
                });
            },

            addListItem(listName) {
                const labels = { phones: 'Telefon', emails: 'E-posta', addresses: 'Adres' };
                const idx = this[listName].length;
                this[listName].push('');
                this.$nextTick(() => {
                    this.openListModal(listName, idx, labels[listName]);
                });
            },

            async removeListItem(listName, index) {
                this[listName].splice(index, 1);
                await this.saveAll();
            },

            // ─── Validation ─────────────────────────────────────────────────

            getMaxLength(field) {
                const limits = {
                    phones: 25, emails: 100, addresses: 250,
                    title: 150, subtitle: 100, form_title: 200,
                    form_name_placeholder: 80, form_email_placeholder: 80,
                    form_message_placeholder: 120, form_privacy_text: 200,
                    form_button_text: 50, cta_label: 60, cta_title: 200,
                    cta_button_text: 50, breadcrumb_home: 30, breadcrumb_current: 30,
                };
                return limits[field] || 0;
            },

            validateField() {
                const val = (this.modalValue || '').trim();
                this.validationError = '';

                // Max length check
                const maxLen = this.modalMaxLength;
                if (maxLen > 0 && val.length > maxLen) {
                    this.validationError = 'Maksimum ' + maxLen + ' karakter girebilirsiniz.';
                    return;
                }

                // Type-specific validation
                const field = this.listField || this.modalField;

                if (field === 'phones' && val) {
                    if (!/^[0-9\s\+\-\(\)]+$/.test(val)) {
                        this.validationError = 'Geçerli bir telefon numarası girin (rakam, +, -, boşluk).';
                        return;
                    }
                }

                if (field === 'emails' && val) {
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
                        this.validationError = 'Geçerli bir e-posta adresi girin.';
                        return;
                    }
                }
            },

            async saveAll() {
                this.saving = true;
                try {
                    const formData = new FormData();
                    formData.append('lang', '{{ $selectedLang }}');
                    formData.append('_token', '{{ csrf_token() }}');

                    for (const [key, value] of Object.entries(this.fields)) {
                        formData.append(key, value || '');
                    }

                    // Append dynamic arrays as JSON
                    formData.append('phones', JSON.stringify(this.phones));
                    formData.append('emails', JSON.stringify(this.emails));
                    formData.append('addresses', JSON.stringify(this.addresses));

                    const res = await fetch('{{ route('pages.update', ['id' => 'contact']) }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const data = await res.json();
                    if (data.success) {
                        this.showToast('Kaydedildi', 'success');
                    } else {
                        this.showToast('Hata oluştu', 'error');
                    }
                } catch (e) {
                    this.showToast('Bağlantı hatası', 'error');
                }
                this.saving = false;
            },

            showToast(msg, type) {
                const el = document.getElementById('toast-msg');
                el.textContent = msg;
                el.className = 'toast-msg ' + type + ' show';
                setTimeout(() => { el.classList.remove('show'); }, 2500);
            },

            // ─── Image Upload Handlers ─────────────────────────────────────

            handleFileSelect(e) {
                const file = e.target.files[0];
                if (file) this.uploadFile(file);
            },

            handleDrop(e) {
                this.imgDragover = false;
                const file = e.dataTransfer.files[0];
                const allowed = ['image/jpeg','image/png','image/gif','image/webp','image/svg+xml','image/x-icon'];
                if (file && (file.type.startsWith('image/') || allowed.includes(file.type))) {
                    this.uploadFile(file);
                }
            },

            async uploadFile(file) {
                if (file.size > 5 * 1024 * 1024) {
                    this.showToast('Dosya 5MB\'dan büyük olamaz', 'error');
                    return;
                }

                this.uploading = true;
                try {
                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    const res = await fetch('{{ route('pages.uploadImage') }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const data = await res.json();
                    if (data.success) {
                        this.modalValue = data.path;
                        this.imgPreview = data.url;
                        this.showToast('Resim yüklendi', 'success');
                    } else {
                        this.showToast('Yükleme hatası', 'error');
                    }
                } catch (e) {
                    this.showToast('Yükleme hatası', 'error');
                }
                this.uploading = false;
            },
        };
    }
</script>
@endsection
