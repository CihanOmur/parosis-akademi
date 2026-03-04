@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Footer</h1>
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

        /* Image editable */
        .ez.ez-img:hover { outline: none !important; }
        .ez.ez-img { position: relative; overflow: hidden; }
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
        .ez.ez-img:hover::before { opacity: 1; }
        .ez.ez-img:hover::after { opacity: 1 !important; }
        .ez.ez-img.ez-active { outline: none !important; }
        .ez.ez-img.ez-active::before { opacity: 1; background: rgba(215, 59, 62, 0.45); }
        .ez.ez-img.ez-active::after { opacity: 1 !important; background: rgb(215 59 62) !important; color: white !important; }

        /* Toast */
        .toast-msg {
            position: fixed; bottom: 24px; right: 24px; z-index: 10000;
            padding: 12px 24px; border-radius: 12px; font-family: Inter, sans-serif;
            font-size: 0.875rem; font-weight: 500; box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            transform: translateY(100px); opacity: 0; transition: all 0.3s ease;
        }
        .toast-msg.show { transform: translateY(0); opacity: 1; }
        .toast-msg.success { background: rgb(84 62 232); color: white; }
        .toast-msg.error { background: rgb(215 59 62); color: white; }

        /* Dynamic list */
        .ez-add-btn {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            width: 100%; padding: 10px; border: 2px dashed rgb(84 62 232 / 0.25);
            border-radius: 8px; background: transparent; color: rgb(84 62 232);
            font-size: 0.8125rem; font-weight: 600; font-family: Poppins, sans-serif;
            cursor: pointer; transition: all 0.15s;
        }
        .ez-add-btn:hover { border-color: rgb(84 62 232); background: rgb(84 62 232 / 0.04); }
        .ez-remove-btn {
            position: absolute; top: -8px; right: -8px; width: 22px; height: 22px;
            border-radius: 50%; background: rgb(215 59 62); color: white;
            border: 2px solid white; display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 12px; line-height: 1; opacity: 0; transition: opacity 0.15s; z-index: 5;
        }
        .ez-list-item:hover .ez-remove-btn { opacity: 1; }

        /* Upload area */
        .upload-drop-zone {
            border: 2px dashed rgb(84 62 232 / 0.3); border-radius: 12px;
            padding: 2rem; text-align: center; cursor: pointer; transition: all 0.2s;
        }
        .upload-drop-zone:hover, .upload-drop-zone.dragover {
            border-color: rgb(84 62 232); background: rgb(84 62 232 / 0.04);
        }

        /* Modal */
        .modal-input {
            width: 100%; padding: 0.75rem 1rem; border: 2px solid rgb(1 28 26 / 0.1);
            border-radius: 10px; font-size: 1rem; outline: none; transition: border-color 0.2s;
            font-family: Poppins, sans-serif; color: rgb(1 28 26); box-sizing: border-box;
        }
        .modal-input:focus { border-color: rgb(84 62 232); }
        .modal-input-error, .modal-input-error:focus { border-color: rgb(215 59 62) !important; }
        .modal-textarea { resize: vertical; }
        .modal-apply-btn {
            padding: 0.6rem 1.5rem; border-radius: 10px; font-size: 0.875rem; font-weight: 600;
            color: white; border: none; background: rgb(84 62 232); cursor: pointer;
            font-family: Poppins, sans-serif; box-shadow: 0 4px 12px rgba(84, 62, 232, 0.3);
            transition: opacity 0.2s;
        }
        .modal-apply-btn-disabled { opacity: 0.5; cursor: not-allowed !important; }
        .img-tab { padding: 8px 16px; border-radius: 8px; font-size: 0.8125rem; font-weight: 500; border: none; cursor: pointer; transition: all 0.15s; font-family: Poppins, sans-serif; }
        .img-tab.active { background: rgb(84 62 232); color: white; }
        .img-tab:not(.active) { background: #F5F5F5; color: rgb(95 93 93); }
        .img-tab:not(.active):hover { background: #EBEBEB; }

        /* Social link editor panel */
        .social-panel-input {
            width: 100%; padding: 0.5rem 0.75rem; border: 2px solid rgb(1 28 26 / 0.1);
            border-radius: 8px; font-size: 0.875rem; outline: none; transition: border-color 0.2s;
            font-family: Poppins, sans-serif; color: rgb(1 28 26); box-sizing: border-box;
        }
        .social-panel-input:focus { border-color: rgb(84 62 232); }
    </style>
@endsection

@section('content')
    <div x-data="footerEditor()" x-cloak>

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

            {{-- ── Footer Top ── --}}
            <div style="background: #FAF9F6; padding: 80px 0 60px;">
                <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                    <div style="display: grid; grid-template-columns: 1fr 0.6fr 1fr 1fr; gap: 2.5rem;">

                        {{-- About Widget --}}
                        <div style="max-width: 298px;">
                            {{-- Logo --}}
                            <div class="ez ez-img" :class="activeField === 'logo' && 'ez-active'" data-label="Logo Değiştir"
                                 @click="openModal('logo', 'Footer Logo', 'image')" style="display: inline-block; margin-bottom: 2rem;">
                                <img :src="fields.logo ? (fields.logo.startsWith('http') ? fields.logo : '{{ url('/') }}/' + fields.logo) : '{{ asset('assets-front/img/logo-parosis-akademi.svg') }}'"
                                     alt="logo" width="137" height="33" style="display: block;" />
                            </div>

                            {{-- About text --}}
                            <div class="ez" :class="activeField === 'about_text' && 'ez-active'" data-label="Düzenle"
                                 @click="openModal('about_text', 'Hakkında Metni', 'textarea')" style="margin-bottom: 2rem;">
                                <p x-text="fields.about_text || 'Gelecegin teknolojisine yon veren akademi. Kariyerinizi bir adim oteye tasiyin.'"
                                   style="margin: 0; line-height: 1.75; font-size: 1rem; color: rgb(95 93 93);"></p>
                            </div>

                            {{-- Social Links --}}
                            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                                <template x-for="(social, idx) in socialLinks" :key="'social-'+idx">
                                    <div class="ez ez-list-item" :class="activeField === 'social_'+idx && 'ez-active'" data-label="Düzenle"
                                         @click="openSocialEditModal(idx)" style="position: relative; display: inline-flex; align-items: center;">
                                        <img :src="getSocialIconUrl(social)" :alt="social.name || 'icon'" width="21" height="21" style="display: block;" />
                                        <button type="button" class="ez-remove-btn" @click.stop="removeSocial(idx)" title="Kaldır">&times;</button>
                                    </div>
                                </template>
                                <button type="button" @click="addSocial()"
                                        style="width: 28px; height: 28px; border-radius: 50%; border: 2px dashed rgb(84 62 232 / 0.3); background: transparent; color: rgb(84 62 232); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s; font-size: 18px; line-height: 1;"
                                        onmouseover="this.style.borderColor='rgb(84 62 232)';this.style.background='rgb(84 62 232 / 0.04)'" onmouseout="this.style.borderColor='rgb(84 62 232 / 0.3)';this.style.background='transparent'"
                                        title="Sosyal Medya Ekle">+</button>
                                <template x-if="socialLinks.length === 0">
                                    <span style="font-size: 0.8125rem; color: rgb(95 93 93); opacity: 0.5;">Sosyal medya ekleyin</span>
                                </template>
                            </div>
                        </div>

                        {{-- Nav Widget --}}
                        <div>
                            <div class="ez" :class="activeField === 'links_title' && 'ez-active'" data-label="Düzenle"
                                 @click="openModal('links_title', 'Bağlantılar Başlığı')" style="margin-bottom: 2rem;">
                                <span x-text="fields.links_title || 'Baglantilar'"
                                      style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.25rem; font-weight: 700; color: rgb(1 28 26);"></span>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                <template x-for="(link, idx) in navLinks" :key="'nav-'+idx">
                                    <div class="ez ez-list-item" :class="activeField === 'nav_'+idx && 'ez-active'" data-label="Düzenle"
                                         @click="openNavModal(idx)" style="position: relative;">
                                        <a x-text="getNavLabel(link)" style="color: rgb(95 93 93); text-decoration: none; font-size: 1rem;"></a>
                                        <button type="button" class="ez-remove-btn" @click.stop="removeNav(idx)" title="Kaldır">&times;</button>
                                    </div>
                                </template>
                                <button type="button" class="ez-add-btn" @click="addNav()">
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                    Link Ekle
                                </button>
                            </div>
                        </div>

                        {{-- Contact Widget --}}
                        <div>
                            <div class="ez" :class="activeField === 'contact_title' && 'ez-active'" data-label="Düzenle"
                                 @click="openModal('contact_title', 'İletişim Başlığı')" style="margin-bottom: 2rem;">
                                <span x-text="fields.contact_title || 'Iletisim'"
                                      style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.25rem; font-weight: 700; color: rgb(1 28 26);"></span>
                            </div>
                            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                                <li style="display: inline-flex; gap: 1.5rem; align-items: flex-start;">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-phone-ring.svg') }}" alt="" width="28" height="28" />
                                    <div>
                                        <div class="ez" :class="activeField === 'support_label' && 'ez-active'" data-label="Düzenle"
                                             @click="openModal('support_label', 'Destek Etiketi')">
                                            <span x-text="fields.support_label || '7/24 Destek'" style="display: block; color: rgb(95 93 93); font-size: 1rem;"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'phone_1' && 'ez-active'" data-label="Düzenle"
                                             @click="openModal('phone_1', 'Telefon')">
                                            <span x-text="fields.phone_1 || '+532 321 33 33'"
                                                  style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.25rem; font-weight: 700; color: rgb(1 28 26);"></span>
                                        </div>
                                    </div>
                                </li>
                                <li style="display: inline-flex; gap: 1.5rem; align-items: flex-start;">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-mail-open.svg') }}" alt="" width="28" height="28" />
                                    <div>
                                        <div class="ez" :class="activeField === 'email_label' && 'ez-active'" data-label="Düzenle"
                                             @click="openModal('email_label', 'E-posta Etiketi')">
                                            <span x-text="fields.email_label || 'Mesaj Gonderin'" style="display: block; color: rgb(95 93 93); font-size: 1rem;"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'email_1' && 'ez-active'" data-label="Düzenle"
                                             @click="openModal('email_1', 'E-posta')">
                                            <span x-text="fields.email_1 || 'info@parosisakademi.com'"
                                                  style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.25rem; font-weight: 700; color: rgb(1 28 26);"></span>
                                        </div>
                                    </div>
                                </li>
                                <li style="display: inline-flex; gap: 1.5rem; align-items: flex-start;">
                                    <img src="{{ asset('assets-front/img/icons/icon-purple-location.svg') }}" alt="" width="28" height="28" />
                                    <div>
                                        <div class="ez" :class="activeField === 'address_label' && 'ez-active'" data-label="Düzenle"
                                             @click="openModal('address_label', 'Adres Etiketi')">
                                            <span x-text="fields.address_label || 'Adresimiz'" style="display: block; color: rgb(95 93 93); font-size: 1rem;"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'address_line_1' && 'ez-active'" data-label="Düzenle"
                                             @click="openModal('address_line_1', 'Adres')">
                                            <span x-text="fields.address_line_1 || 'Istanbul, Turkiye'"
                                                  style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.25rem; font-weight: 700; color: rgb(1 28 26);"></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        {{-- Newsletter Widget --}}
                        <div style="max-width: 320px;">
                            <div class="ez" :class="activeField === 'newsletter_title' && 'ez-active'" data-label="Düzenle"
                                 @click="openModal('newsletter_title', 'Bülten Başlığı')" style="margin-bottom: 2rem;">
                                <span x-text="fields.newsletter_title || 'Abone Olun'"
                                      style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.25rem; font-weight: 700; color: rgb(1 28 26);"></span>
                            </div>
                            <div class="ez" :class="activeField === 'newsletter_text' && 'ez-active'" data-label="Düzenle"
                                 @click="openModal('newsletter_text', 'Bülten Metni')">
                                <p x-text="fields.newsletter_text || 'Bultenimize abone olmak icin e-posta adresinizi girin'"
                                   style="margin: 0 0 1rem; color: rgb(95 93 93); font-size: 1rem;"></p>
                            </div>
                            <div style="margin-top: 1rem;">
                                <div class="ez" :class="activeField === 'newsletter_placeholder' && 'ez-active'" data-label="Düzenle"
                                     @click="openModal('newsletter_placeholder', 'Placeholder')">
                                    <div style="width: 100%; border-radius: 50px; border: 1px solid #EBEBEB; background: white; padding: 14px 28px; font-size: 1rem; color: #5F5D5D;"
                                         x-text="fields.newsletter_placeholder || 'E-posta girin'"></div>
                                </div>
                                <div class="ez" :class="activeField === 'newsletter_button' && 'ez-active'" data-label="Düzenle"
                                     @click="openModal('newsletter_button', 'Buton Metni')" style="margin-top: 10px;">
                                    <div style="display: inline-block; padding: 14px 28px; background: rgb(84 62 232); color: white; border-radius: 50px; font-size: 1rem; font-weight: 600;"
                                         x-text="fields.newsletter_button || 'Abone Ol'"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── Footer Bottom (Copyright) ── --}}
            <div style="background: #F5F5F5; padding: 24px 0; text-align: center;">
                <div class="ez" :class="activeField === 'copyright_text' && 'ez-active'" data-label="Düzenle"
                     @click="openModal('copyright_text', 'Copyright Metni')" style="display: inline-block;">
                    <span x-text="fields.copyright_text || 'Copyright {{ date('Y') }} Parosis Akademi | Tum Haklari Saklidir'"
                          style="font-size: 0.875rem; color: rgb(95 93 93);"></span>
                </div>
            </div>

        </div>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- TEXT / TEXTAREA MODAL --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <template x-teleport="body">
        <div x-show="modal && modalType !== 'image' && modalType !== 'social' && modalType !== 'nav'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;"
             @keydown.escape.window="closeModal()">
            <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="closeModal()"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
            <div x-show="modal && modalType !== 'image' && modalType !== 'social' && modalType !== 'nav'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
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
                            style="width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgb(95 93 93); cursor: pointer; border: none; background: #F5F5F5;"
                            onmouseover="this.style.background='#EBEBEB'" onmouseout="this.style.background='#F5F5F5'">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div style="padding: 1.5rem;">
                    <template x-if="modalType === 'text'">
                        <input type="text" x-model="modalValue" x-ref="modalInput" class="modal-input" :class="validationError && 'modal-input-error'"
                               @keydown.enter="applyAndSave()" @input="validateField()">
                    </template>
                    <template x-if="modalType === 'textarea'">
                        <textarea x-model="modalValue" x-ref="modalTextarea" rows="4" class="modal-input modal-textarea" :class="validationError && 'modal-input-error'"
                                  @input="validateField()"></textarea>
                    </template>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 6px; min-height: 20px;">
                        <span x-show="validationError" x-text="validationError" style="font-size: 0.75rem; color: rgb(215 59 62); font-family: Poppins, sans-serif;"></span>
                    </div>
                </div>
                <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" @click="closeModal()"
                            style="padding: 0.6rem 1.25rem; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif;"
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
        {{-- SOCIAL MEDIA EDIT MODAL --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <template x-teleport="body">
        <div x-show="modal && modalType === 'social'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;"
             @keydown.escape.window="closeModal()">
            <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="closeModal()"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
            <div x-show="modal && modalType === 'social'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 style="background: white; border-radius: 16px; box-shadow: 0 25px 50px rgba(1,28,26,0.2); width: 100%; max-width: 480px; overflow: hidden;"
                 @click.stop>
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgb(1 28 26 / 0.06); display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 36px; height: 36px; background: rgb(84 62 232); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 18px; height: 18px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/>
                            </svg>
                        </div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: rgb(1 28 26); font-family: 'Aeonik Pro TRIAL', sans-serif;">Sosyal Medya Düzenle</h3>
                    </div>
                    <button type="button" @click="closeModal()"
                            style="width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgb(95 93 93); cursor: pointer; border: none; background: #F5F5F5;"
                            onmouseover="this.style.background='#EBEBEB'" onmouseout="this.style.background='#F5F5F5'">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    {{-- Icon preview + upload --}}
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 500; color: rgb(95 93 93); margin-bottom: 6px;">İkon</label>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 48px; height: 48px; border-radius: 10px; border: 2px solid rgb(1 28 26 / 0.08); display: flex; align-items: center; justify-content: center; background: #FAFAFA; flex-shrink: 0; overflow: hidden;">
                                <template x-if="socialEditIcon">
                                    <img :src="getSocialIconUrl({icon: socialEditIcon})" style="max-width: 28px; max-height: 28px; display: block;" />
                                </template>
                                <template x-if="!socialEditIcon">
                                    <svg style="width: 20px; height: 20px; color: #ccc;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/>
                                    </svg>
                                </template>
                            </div>
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <button type="button" @click="$refs.socialIconInput.click()"
                                        style="padding: 6px 14px; border-radius: 8px; font-size: 0.8125rem; font-weight: 500; border: 1px solid rgb(84 62 232 / 0.3); background: white; color: rgb(84 62 232); cursor: pointer; font-family: Poppins, sans-serif;"
                                        onmouseover="this.style.background='rgb(84 62 232 / 0.04)'" onmouseout="this.style.background='white'">
                                    <span x-show="!socialIconUploading">Yükle</span>
                                    <span x-show="socialIconUploading">Yükleniyor...</span>
                                </button>
                                <button type="button" x-show="socialEditIcon" @click="socialEditIcon = ''"
                                        style="padding: 6px 14px; border-radius: 8px; font-size: 0.8125rem; font-weight: 500; border: 1px solid rgb(215 59 62 / 0.2); background: white; color: rgb(215 59 62); cursor: pointer; font-family: Poppins, sans-serif;"
                                        onmouseover="this.style.background='rgb(215 59 62 / 0.04)'" onmouseout="this.style.background='white'">
                                    Kaldır
                                </button>
                            </div>
                            <input type="file" x-ref="socialIconInput" accept=".jpg,.jpeg,.png,.gif,.webp,.svg,.ico" style="display: none;" @change="handleSocialIconUpload($event)" />
                        </div>
                    </div>
                    {{-- Name --}}
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 500; color: rgb(95 93 93); margin-bottom: 4px;">Platform Adı</label>
                        <input type="text" x-model="socialEditName" placeholder="Facebook, Twitter, Instagram..." class="modal-input">
                    </div>
                    {{-- URL --}}
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 500; color: rgb(95 93 93); margin-bottom: 4px;">URL</label>
                        <input type="text" x-model="socialEditUrl" placeholder="https://..." class="modal-input" @keydown.enter="applySocialEditAndSave()">
                    </div>
                </div>
                <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" @click="closeModal()"
                            style="padding: 0.6rem 1.25rem; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif;"
                            onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='white'">
                        İptal
                    </button>
                    <button type="button" @click="applySocialEditAndSave()"
                            :disabled="saving"
                            class="modal-apply-btn" :class="saving && 'modal-apply-btn-disabled'">
                        <span x-show="!saving">Uygula</span>
                        <span x-show="saving">Kaydediliyor...</span>
                    </button>
                </div>
            </div>
            </div>
        </div>
        </template>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- NAV LINK MODAL --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <template x-teleport="body">
        <div x-show="modal && modalType === 'nav'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;"
             @keydown.escape.window="closeModal()">
            <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="closeModal()"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
            <div x-show="modal && modalType === 'nav'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 style="background: white; border-radius: 16px; box-shadow: 0 25px 50px rgba(1,28,26,0.2); width: 100%; max-width: 480px; overflow: hidden;"
                 @click.stop>
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgb(1 28 26 / 0.06); display: flex; align-items: center; justify-content: space-between;">
                    <h3 x-text="'Link Düzenle'" style="font-size: 1.125rem; font-weight: 600; color: rgb(1 28 26); font-family: 'Aeonik Pro TRIAL', sans-serif;"></h3>
                    <button type="button" @click="closeModal()"
                            style="width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgb(95 93 93); cursor: pointer; border: none; background: #F5F5F5;"
                            onmouseover="this.style.background='#EBEBEB'" onmouseout="this.style.background='#F5F5F5'">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 500; color: rgb(95 93 93); margin-bottom: 4px;">Etiket</label>
                        <input type="text" x-model="navEditLabel" placeholder="Hakkımızda" class="modal-input" @keydown.enter="applyNavAndSave()">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 500; color: rgb(95 93 93); margin-bottom: 4px;">URL</label>
                        <input type="text" x-model="navEditUrl" placeholder="/hakkimizda veya https://..." class="modal-input" @keydown.enter="applyNavAndSave()">
                    </div>
                </div>
                <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" @click="closeModal()"
                            style="padding: 0.6rem 1.25rem; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif;"
                            onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='white'">
                        İptal
                    </button>
                    <button type="button" @click="applyNavAndSave()"
                            :disabled="saving"
                            class="modal-apply-btn" :class="saving && 'modal-apply-btn-disabled'">
                        <span x-show="!saving">Uygula</span>
                        <span x-show="saving">Kaydediliyor...</span>
                    </button>
                </div>
            </div>
            </div>
        </div>
        </template>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- IMAGE MODAL --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <template x-teleport="body">
        <div x-show="modal && modalType === 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;"
             @keydown.escape.window="closeModal()">
            <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="closeModal()"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
            <div x-show="modal && modalType === 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 style="background: white; border-radius: 16px; box-shadow: 0 25px 50px rgba(1,28,26,0.2); width: 100%; max-width: 580px; overflow: hidden;"
                 @click.stop>
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
                            style="width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgb(95 93 93); cursor: pointer; border: none; background: #F5F5F5;"
                            onmouseover="this.style.background='#EBEBEB'" onmouseout="this.style.background='#F5F5F5'">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div style="padding: 1rem 1.5rem 0; display: flex; gap: 0.5rem;">
                    <button type="button" class="img-tab" :class="imgTab === 'upload' ? 'active' : ''" @click="imgTab = 'upload'">Dosya Yükle</button>
                    <button type="button" class="img-tab" :class="imgTab === 'url' ? 'active' : ''" @click="imgTab = 'url'">URL Gir</button>
                </div>
                <div style="padding: 1.5rem;">
                    <template x-if="imgPreview">
                        <div style="margin-bottom: 1rem; border-radius: 10px; overflow: hidden; border: 1px solid rgb(1 28 26 / 0.08);">
                            <img :src="imgPreview" style="max-width: 100%; max-height: 200px; display: block; margin: 0 auto;" />
                        </div>
                    </template>
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
                            <p style="font-size: 0.75rem; color: #8D8D8D; margin: 0.25rem 0 0;">JPG, PNG, GIF, WEBP, SVG (max 5MB)</p>
                        </div>
                    </div>
                    <div x-show="imgTab === 'url'">
                        <input type="text" x-model="modalValue" placeholder="https://... veya uploads/pages/..." class="modal-input"
                               @keydown.enter="applyAndSave()"
                               @input="imgPreview = $event.target.value.startsWith('http') ? $event.target.value : ($event.target.value ? '{{ url('/') }}/' + $event.target.value : '')">
                    </div>
                </div>
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
                        <button type="button" @click="applyAndSave()" :disabled="saving"
                                class="modal-apply-btn" :class="saving && 'modal-apply-btn-disabled'">
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
    function footerEditor() {
        return {
            modal: false,
            modalField: '',
            modalLabel: '',
            modalValue: '',
            modalType: 'text',
            activeField: '',
            saving: false,
            validationError: '',
            imgTab: 'upload',
            imgPreview: '',
            imgDragover: false,
            uploading: false,

            // Nav link editing
            navEditIndex: -1,
            navEditLabel: '',
            navEditUrl: '',

            // Social link editing
            socialEditIndex: -1,
            socialEditName: '',
            socialEditUrl: '',
            socialEditIcon: '',
            socialIconUploading: false,

            navLinks: @json($footerPageInfo->nav_links ?? []),
            socialLinks: @json($footerPageInfo->social_links ?? []),

            fields: {
                logo: @json($footerPageInfo->logo ?? ''),
                about_text: @json(translateAttribute($footerPageInfo, 'about_text', $selectedLang) ?? ''),
                links_title: @json(translateAttribute($footerPageInfo, 'links_title', $selectedLang) ?? ''),
                contact_title: @json(translateAttribute($footerPageInfo, 'contact_title', $selectedLang) ?? ''),
                newsletter_title: @json(translateAttribute($footerPageInfo, 'newsletter_title', $selectedLang) ?? ''),
                newsletter_text: @json(translateAttribute($footerPageInfo, 'newsletter_text', $selectedLang) ?? ''),
                newsletter_button: @json(translateAttribute($footerPageInfo, 'newsletter_button', $selectedLang) ?? ''),
                newsletter_placeholder: @json(translateAttribute($footerPageInfo, 'newsletter_placeholder', $selectedLang) ?? ''),
                copyright_text: @json(translateAttribute($footerPageInfo, 'copyright_text', $selectedLang) ?? ''),
                support_label: @json(translateAttribute($footerPageInfo, 'support_label', $selectedLang) ?? ''),
                email_label: @json(translateAttribute($footerPageInfo, 'email_label', $selectedLang) ?? ''),
                address_label: @json(translateAttribute($footerPageInfo, 'address_label', $selectedLang) ?? ''),
                phone_1: @json($contactPageInfo->phone_1 ?? ''),
                email_1: @json($contactPageInfo->email_1 ?? ''),
                address_line_1: @json($contactPageInfo->address_line_1 ?? ''),
            },

            getNavLabel(link) {
                if (!link || !link.label) return '';
                if (typeof link.label === 'object') {
                    return link.label['{{ $selectedLang }}'] || link.label['{{ app()->getLocale() }}'] || Object.values(link.label)[0] || '';
                }
                return link.label;
            },

            openModal(field, label, type = 'text') {
                this.modalField = field;
                this.modalLabel = label;
                this.modalValue = this.fields[field] || '';
                this.modalType = type;
                this.activeField = field;
                this.validationError = '';
                this.modal = true;

                if (type === 'image') {
                    this.imgTab = 'upload';
                    this.imgDragover = false;
                    const val = this.fields[field];
                    this.imgPreview = val ? (val.startsWith('http') ? val : '{{ url('/') }}/' + val) : '';
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
                if (this.validationError) return;
                this.fields[this.modalField] = this.modalValue;
                this.modal = false;
                this.activeField = '';
                await this.saveAll();
            },

            // ─── Social Media ─────────────────────────────────────────────
            getSocialIconUrl(social) {
                if (!social || !social.icon) return '';
                if (social.icon.startsWith('http')) return social.icon;
                return '{{ url('/') }}/' + social.icon;
            },

            openSocialEditModal(index) {
                this.socialEditIndex = index;
                const social = this.socialLinks[index];
                this.socialEditName = social?.name || '';
                this.socialEditUrl = social?.url || '';
                this.socialEditIcon = social?.icon || '';
                this.modalType = 'social';
                this.activeField = 'social_' + index;
                this.modal = true;
            },

            async applySocialEditAndSave() {
                const idx = this.socialEditIndex;
                if (idx >= 0 && idx < this.socialLinks.length) {
                    this.socialLinks[idx] = {
                        name: this.socialEditName,
                        url: this.socialEditUrl,
                        icon: this.socialEditIcon,
                    };
                }
                this.modal = false;
                this.activeField = '';
                await this.saveAll();
            },

            addSocial() {
                const idx = this.socialLinks.length;
                this.socialLinks.push({ name: '', url: '', icon: '' });
                this.$nextTick(() => this.openSocialEditModal(idx));
            },

            async removeSocial(index) {
                this.socialLinks.splice(index, 1);
                await this.saveAll();
            },

            async handleSocialIconUpload(e) {
                const file = e.target.files[0];
                if (!file) return;
                if (file.size > 5 * 1024 * 1024) {
                    this.showToast('Dosya 5MB\'dan büyük olamaz', 'error');
                    return;
                }
                this.socialIconUploading = true;
                try {
                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('_token', '{{ csrf_token() }}');
                    const res = await fetch('{{ route('pages.uploadImage') }}', {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                        body: formData,
                    });
                    const data = await res.json();
                    if (data.success) {
                        this.socialEditIcon = data.path;
                        this.showToast('İkon yüklendi', 'success');
                    } else {
                        this.showToast('Yükleme hatası', 'error');
                    }
                } catch (err) {
                    this.showToast('Yükleme hatası', 'error');
                }
                this.socialIconUploading = false;
                e.target.value = '';
            },

            // ─── Nav Links ─────────────────────────────────────────────────
            openNavModal(index) {
                this.navEditIndex = index;
                const link = this.navLinks[index];
                this.navEditLabel = this.getNavLabel(link);
                this.navEditUrl = link?.url || '';
                this.modalType = 'nav';
                this.activeField = 'nav_' + index;
                this.modal = true;
            },

            async applyNavAndSave() {
                const idx = this.navEditIndex;
                if (idx >= 0 && idx < this.navLinks.length) {
                    this.navLinks[idx] = {
                        label: this.navEditLabel,
                        url: this.navEditUrl
                    };
                }
                this.modal = false;
                this.activeField = '';
                await this.saveAll();
            },

            addNav() {
                const idx = this.navLinks.length;
                this.navLinks.push({ label: '', url: '' });
                this.$nextTick(() => this.openNavModal(idx));
            },

            async removeNav(index) {
                this.navLinks.splice(index, 1);
                await this.saveAll();
            },

            // ─── Validation ─────────────────────────────────────────────────
            validateField() {
                this.validationError = '';
            },

            // ─── Save ─────────────────────────────────────────────────────
            async saveAll() {
                this.saving = true;
                try {
                    const formData = new FormData();
                    formData.append('lang', '{{ $selectedLang }}');
                    formData.append('_token', '{{ csrf_token() }}');

                    // All fields
                    for (const [key, value] of Object.entries(this.fields)) {
                        formData.append(key, value || '');
                    }

                    // Nav links & social links as JSON
                    formData.append('nav_links', JSON.stringify(this.navLinks));
                    formData.append('social_links', JSON.stringify(this.socialLinks));

                    const res = await fetch('{{ route('pages.update', ['id' => 'footer']) }}', {
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

            // ─── Image Upload ─────────────────────────────────────────────
            handleFileSelect(e) {
                const file = e.target.files[0];
                if (file) this.uploadFile(file);
            },

            handleDrop(e) {
                this.imgDragover = false;
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
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
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
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
