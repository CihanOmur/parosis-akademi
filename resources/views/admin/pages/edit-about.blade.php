@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Hakkimizda Sayfasi</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Bolum sekmelerinden duzenleyin</p>
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
        .ez.ez-img:hover { outline: none !important; }
        .ez.ez-img { position: relative; overflow: hidden; }
        .ez.ez-img::before { content: ''; position: absolute; inset: 0; background: rgba(1,28,26,0.55); opacity: 0; transition: opacity 0.2s; z-index: 2; border-radius: inherit; pointer-events: none; }
        .ez.ez-img::after { content: attr(data-label) !important; position: absolute !important; top: 50% !important; left: 50% !important; transform: translate(-50%,-50%) !important; font-size: 0.875rem !important; font-family: Inter, sans-serif; font-weight: 600; background: rgb(255 205 32) !important; color: rgb(1 28 26) !important; padding: 8px 20px !important; border-radius: 8px !important; white-space: nowrap; z-index: 3; opacity: 0; transition: opacity 0.2s; pointer-events: none; }
        .ez.ez-img:hover::before { opacity: 1; }
        .ez.ez-img:hover::after { opacity: 1 !important; }
        .ez.ez-img.ez-active { outline: none !important; }
        .ez.ez-img.ez-active::before { opacity: 1; background: rgba(215,59,62,0.45); }
        .ez.ez-img.ez-active::after { opacity: 1 !important; background: rgb(215 59 62) !important; color: white !important; }
        .toast-msg { position: fixed; bottom: 24px; right: 24px; z-index: 10000; padding: 12px 24px; border-radius: 12px; font-family: Inter, sans-serif; font-size: 0.875rem; font-weight: 500; box-shadow: 0 8px 24px rgba(0,0,0,0.15); transform: translateY(100px); opacity: 0; transition: all 0.3s ease; }
        .toast-msg.show { transform: translateY(0); opacity: 1; }
        .toast-msg.success { background: rgb(84 62 232); color: white; }
        .toast-msg.error { background: rgb(215 59 62); color: white; }
        .upload-drop-zone { border: 2px dashed rgb(84 62 232 / 0.3); border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.2s; }
        .upload-drop-zone:hover,.upload-drop-zone.dragover { border-color: rgb(84 62 232); background: rgb(84 62 232 / 0.04); }
        .modal-input { width: 100%; padding: 0.75rem 1rem; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 10px; font-size: 1rem; outline: none; transition: border-color 0.2s; font-family: Poppins, sans-serif; color: rgb(1 28 26); box-sizing: border-box; }
        .modal-input:focus { border-color: rgb(84 62 232); }
        .modal-input-error,.modal-input-error:focus { border-color: rgb(215 59 62) !important; }
        .modal-textarea { resize: vertical; }
        .modal-apply-btn { padding: 0.6rem 1.5rem; border-radius: 10px; font-size: 0.875rem; font-weight: 600; color: white; border: none; background: rgb(84 62 232); cursor: pointer; font-family: Poppins, sans-serif; box-shadow: 0 4px 12px rgba(84,62,232,0.3); transition: opacity 0.2s; }
        .modal-apply-btn-disabled { opacity: 0.5; cursor: not-allowed !important; }
        .img-tab { padding: 8px 16px; border-radius: 8px; font-size: 0.8125rem; font-weight: 500; border: none; cursor: pointer; transition: all 0.15s; font-family: Poppins, sans-serif; }
        .img-tab.active { background: rgb(84 62 232); color: white; }
        .img-tab:not(.active) { background: #F5F5F5; color: rgb(95 93 93); }
        .img-tab:not(.active):hover { background: #EBEBEB; }
        .add-btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.25rem; border: 2px dashed rgb(84 62 232 / 0.3); border-radius: 10px; background: transparent; color: rgb(84 62 232); font-family: Poppins, sans-serif; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all 0.2s; }
        .add-btn:hover { border-color: rgb(84 62 232); background: rgb(84 62 232 / 0.04); }
        .del-btn { width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgb(215 59 62); cursor: pointer; border: 1px solid rgb(215 59 62 / 0.2); background: white; transition: all 0.2s; flex-shrink: 0; }
        .del-btn:hover { background: rgb(215 59 62 / 0.08); }
        .s2-input { flex: 1; font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; color: rgb(1 28 26); border: none; border-bottom: 1px dashed transparent; outline: none; padding: 4px 0; background: transparent; font-size: 1rem; }
        .s2-input:focus { border-bottom-color: rgb(84 62 232); }
        /* Page tabs */
        .page-tabs {
            display: flex; gap: 4px; padding: 5px; background: #F1F0FB;
            border-radius: 14px; font-family: Inter, sans-serif;
        }
        .page-tab {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 20px; border-radius: 10px; font-size: 0.8125rem;
            font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; color: rgb(95 93 93); background: transparent;
            white-space: nowrap;
        }
        .page-tab svg { width: 16px; height: 16px; }
        .page-tab:hover:not(.page-tab-active) { background: white; color: rgb(1 28 26); }
        .page-tab-active {
            background: white; color: rgb(84 62 232);
            box-shadow: 0 2px 8px rgba(84, 62, 232, 0.1);
        }
        .page-tab-badge {
            font-size: 0.625rem; font-weight: 700; padding: 2px 7px;
            border-radius: 5px; background: rgb(84 62 232 / 0.08);
            color: rgb(84 62 232); letter-spacing: 0.03em;
        }
        .page-tab-active .page-tab-badge { background: rgb(84 62 232); color: white; }
    </style>
@endsection

@section('content')
    <div x-data="aboutEditor()" x-cloak>

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
                <span x-show="!saving">Duzenlemek istediginiz alana tiklayin</span>
                <span x-show="saving" style="color: rgb(84 62 232);">Kaydediliyor...</span>
            </div>
            <button type="button" @click="saveAll()" :disabled="saving"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-fuchsia-500 to-purple-500 hover:from-fuchsia-600 hover:to-purple-600 text-white font-semibold rounded-xl text-sm shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                <svg x-show="!saving" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                <svg x-show="saving" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                Kaydet
            </button>
        </div>

        {{-- ═════════════ TAB NAVIGATION ═════════════ --}}
        <div class="page-tabs mb-5" style="display: inline-flex;">
            {{-- Üst Bölüm --}}
            <button type="button" class="page-tab" :class="pageTab === 'ust' && 'page-tab-active'" @click="pageTab = 'ust'">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                Ust Bolum
                <span class="page-tab-badge">/hakkimizda</span>
            </button>
            {{-- Orta Bölüm --}}
            <button type="button" class="page-tab" :class="pageTab === 'orta' && 'page-tab-active'" @click="pageTab = 'orta'">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46"/></svg>
                Orta Bolum
            </button>
            {{-- Alt Bölüm --}}
            <button type="button" class="page-tab" :class="pageTab === 'alt' && 'page-tab-active'" @click="pageTab = 'alt'">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                Alt Bolum
            </button>
        </div>

        {{-- ═════════════ LIVE PREVIEW PANELS ═════════════ --}}
        <div class="lp" style="border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid rgba(226,232,240,0.5);">

            {{-- ═══════════ ÜST BÖLÜM ═══════════ --}}
            <div x-show="pageTab === 'ust'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

            {{-- ── Breadcrumb ── --}}
            <div>
                <section style="position: relative; z-index: 10; overflow: hidden; background-color: #FAF9F6;">
                    <div style="padding: 60px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="text-align: center;">
                                <div class="ez" :class="activeField === 'breadcrumb_title' && 'ez-active'" data-label="Duzenle" @click="openModal('breadcrumb_title', 'Sayfa Basligi')">
                                    <h1 style="margin-bottom: 1.25rem; text-transform: capitalize; letter-spacing: normal;" x-text="fields.breadcrumb_title || 'Hakkimizda'"></h1>
                                </div>
                                <nav style="font-size: 1rem; font-weight: 500; text-transform: uppercase;">
                                    <ul style="display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 4px; align-items: center;">
                                        <li>
                                            <span class="ez" :class="activeField === 'breadcrumb_home' && 'ez-active'" data-label="Duzenle" @click="openModal('breadcrumb_home', 'Breadcrumb Ana Sayfa')" style="color: rgb(215 59 62);" x-text="fields.breadcrumb_home || 'ANA SAYFA'"></span>
                                        </li>
                                        <li style="color: rgb(95 93 93);">/</li>
                                        <li>
                                            <span class="ez" :class="activeField === 'breadcrumb_current' && 'ez-active'" data-label="Duzenle" @click="openModal('breadcrumb_current', 'Mevcut Sayfa')" style="color: rgb(95 93 93);" x-text="fields.breadcrumb_current || 'HAKKIMIZDA'"></span>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div style="position: absolute; left: -192px; top: 0; z-index: -1; width: 371px; height: 327px; background: #BFC06F; filter: blur(250px);"></div>
                    <div style="position: absolute; right: -144px; bottom: 80px; z-index: -1; width: 371px; height: 327px; background: #AAC3E9; filter: blur(200px);"></div>
                </section>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Neden Biz (1)</span></div></div>

            {{-- ── Section 1 — Neden Biz (1) ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 70px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                                {{-- Left --}}
                                <div>
                                    <div style="margin-bottom: 1.5rem;">
                                        <div class="ez" :class="activeField === 'section1_label' && 'ez-active'" data-label="Duzenle" @click="openModal('section1_label', 'Etiket')" style="margin-bottom: 1.25rem;">
                                            <span x-text="fields.section1_label || 'WHY CHOOSE US'" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'section1_title' && 'ez-active'" data-label="Duzenle" @click="openModal('section1_title', 'Baslik')">
                                            <h2 x-text="fields.section1_title || 'Transform Your Best Practice with Our Online Course'"></h2>
                                        </div>
                                    </div>
                                    <div class="ez" :class="activeField === 'section1_description' && 'ez-active'" data-label="Duzenle" @click="openModal('section1_description', 'Aciklama', 'textarea')" style="margin-top: 1.75rem;">
                                        <p x-text="fields.section1_description || 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.'" style="color: rgb(95 93 93); line-height: 1.75;"></p>
                                    </div>

                                    {{-- Dynamic Features --}}
                                    <div style="margin-top: 2.5rem; display: flex; flex-direction: column; gap: 2.5rem;">
                                        <template x-for="(feature, fIdx) in fields.section1_features" :key="fIdx">
                                            <div style="position: relative;">
                                                <div style="display: flex; align-items: center; gap: 1.25rem; margin-bottom: 1.25rem;">
                                                    <div class="ez ez-img" :class="activeField === ('feature_' + fIdx + '_icon') && 'ez-active'" data-label="Ikon" @click="openFeatureModal(fIdx, 'icon', 'Ozellik ' + (fIdx+1) + ' Ikon', 'image')"
                                                         :style="'display: inline-flex; width: 60px; height: 60px; min-width: 60px; align-items: center; justify-content: center; border-radius: 50%; background: ' + (feature.bg_color || '#42AC98') + '1a'">
                                                        <img :src="feature.icon ? (feature.icon.startsWith('http') ? feature.icon : baseUrl + '/' + feature.icon) : '{{ asset('assets-front/img/icons/content-icon-1.svg') }}'" alt="" width="25" height="25" />
                                                    </div>
                                                    <div class="ez" :class="activeField === ('feature_' + fIdx + '_title') && 'ez-active'" data-label="Duzenle" @click="openFeatureModal(fIdx, 'title', 'Ozellik ' + (fIdx+1) + ' Baslik')" style="flex: 1;">
                                                        <span x-text="feature.title || ('Ozellik ' + (fIdx+1))" style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.25rem; font-weight: 700; color: rgb(1 28 26);"></span>
                                                    </div>
                                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                        <input type="color" :value="feature.bg_color || '#42AC98'" @input="feature.bg_color = $event.target.value" @change="saveAll()" style="width: 28px; height: 28px; border: none; cursor: pointer; border-radius: 6px; padding: 0;" title="Ikon Arka Plan Rengi" />
                                                        <button type="button" @click="removeFeature(fIdx)" class="del-btn" title="Sil">
                                                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="ez" :class="activeField === ('feature_' + fIdx + '_description') && 'ez-active'" data-label="Duzenle" @click="openFeatureModal(fIdx, 'description', 'Ozellik ' + (fIdx+1) + ' Aciklama', 'textarea')">
                                                    <p x-text="feature.description || 'Aciklama ekleyin...'" style="color: rgb(95 93 93); line-height: 1.75;"></p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <button type="button" @click="addFeature()" class="add-btn" style="margin-top: 1.5rem;">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                        Yeni Ozellik Ekle
                                    </button>
                                </div>

                                {{-- Right: Images + Stat --}}
                                <div style="position: relative; z-index: 10;">
                                    <div class="ez ez-img" :class="activeField === 'section1_image1' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('section1_image1', 'Resim 1', 'image')" style="display: inline-block; margin-left: auto;">
                                        <img :src="fields.section1_image1 ? (fields.section1_image1.startsWith('http') ? fields.section1_image1 : baseUrl + '/' + fields.section1_image1) : '{{ asset('assets-front/img/images/th-3/content-img-1.jpg') }}'" alt="" width="456" height="465" style="max-width: 100%; border-radius: 8px; display: block; margin-left: auto;" />
                                    </div>
                                    <div class="ez ez-img" :class="activeField === 'section1_image2' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('section1_image2', 'Resim 2', 'image')" style="display: inline-block; margin-top: -80px;">
                                        <img :src="fields.section1_image2 ? (fields.section1_image2.startsWith('http') ? fields.section1_image2 : baseUrl + '/' + fields.section1_image2) : '{{ asset('assets-front/img/images/th-3/content-img-2.jpg') }}'" alt="" width="355" height="263" style="max-width: 100%; border-radius: 8px; display: block;" />
                                    </div>
                                    <div style="position: absolute; bottom: 30px; right: 0; z-index: 10; display: inline-flex; align-items: center; gap: 1.25rem; background: white; padding: 0.5rem 2rem 0.5rem 1rem; border-radius: 8px; box-shadow: 17px 18px 30px 16px rgba(7,2,41,0.1);">
                                        <div style="display: inline-flex; width: 64px; height: 64px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(223,67,67,0.05);">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="" width="28" height="28" />
                                        </div>
                                        <div>
                                            <div class="ez" :class="activeField === 'section1_stat_number' && 'ez-active'" data-label="Duzenle" @click="openModal('section1_stat_number', 'Istatistik Sayisi')">
                                                <span x-text="fields.section1_stat_number || '69K+'" style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.75rem; font-weight: 700; line-height: 1.73; color: #DF4343;"></span>
                                            </div>
                                            <div class="ez" :class="activeField === 'section1_stat_text' && 'ez-active'" data-label="Duzenle" @click="openModal('section1_stat_text', 'Istatistik Metni')">
                                                <span x-text="fields.section1_stat_text || 'Satisfied Students'" style="color: rgb(95 93 93);"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Kategoriler</span></div></div>

            {{-- ── Kategoriler ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 70px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 2rem; margin-bottom: 3rem;">
                                <div style="max-width: 580px;">
                                    <div class="ez" :class="activeField === 'categories_label' && 'ez-active'" data-label="Duzenle" @click="openModal('categories_label', 'Kategoriler Etiket')" style="margin-bottom: 1.25rem;">
                                        <span x-text="fields.categories_label || 'COURSE CATEGORIES'" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                    </div>
                                    <div class="ez" :class="activeField === 'categories_title' && 'ez-active'" data-label="Duzenle" @click="openModal('categories_title', 'Kategoriler Baslik')">
                                        <h2 x-text="fields.categories_title || 'Top Categories You Want to Learn'"></h2>
                                    </div>
                                </div>
                                <div class="ez" :class="activeField === 'categories_button_text' && 'ez-active'" data-label="Duzenle" @click="openModal('categories_button_text', 'Buton Yazisi')">
                                    <div style="position: relative; display: inline-flex; align-items: center; overflow: hidden; border-radius: 52px; padding: 1rem 70px 1rem 30px; background-color: rgb(84 62 232); color: #fff; font-size: 1rem;">
                                        <span x-text="fields.categories_button_text || 'Find Courses'"></span>
                                        <span style="position: absolute; right: 5px; display: inline-flex; width: 2.75rem; height: 2.75rem; align-items: center; justify-content: center; border-radius: 50%; background: white;">
                                            <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="" width="13" height="12" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem;">
                                @for($i = 1; $i <= 4; $i++)
                                <div style="display: flex; align-items: center; gap: 1.5rem; border-radius: 100px; background: #F5F5F5; padding: 10px;">
                                    <div style="width: 72px; height: 72px; min-width: 72px; border-radius: 50%; background: rgba(84,62,232,0.1); display: flex; align-items: center; justify-content: center;">
                                        <svg style="width: 30px; height: 30px; color: #543EE8;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/></svg>
                                    </div>
                                    <div><span style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; font-size: 1.125rem; color: rgb(1 28 26);">Kategori {{ $i }}</span><br><span style="font-size: 0.875rem; color: rgb(95 93 93);">00 Kurs</span></div>
                                </div>
                                @endfor
                            </div>
                            <p style="text-align: center; font-size: 0.75rem; color: #8D8D8D; margin-top: 1.5rem; font-style: italic;">Kategoriler veritabanindan otomatik cekilir</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Video</span></div></div>

            {{-- ── Video ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 40px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="position: relative; display: flex; align-items: center; justify-content: center;">
                                <div class="ez ez-img" :class="activeField === 'video_image' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('video_image', 'Video Resmi', 'image')" style="width: 100%; border-radius: 40px 0 40px 0; overflow: hidden;">
                                    <img :src="fields.video_image ? (fields.video_image.startsWith('http') ? fields.video_image : baseUrl + '/' + fields.video_image) : '{{ asset('assets-front/img/images/th-2/video-img.jpg') }}'" alt="" style="width: 100%; height: 350px; object-fit: cover; display: block;" />
                                </div>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 5;">
                                    <div class="ez" :class="activeField === 'video_url' && 'ez-active'" data-label="URL Duzenle" @click="openModal('video_url', 'Video URL')"
                                         style="width: 100px; height: 100px; border-radius: 50%; border: 5px solid rgb(255 205 32); display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3); cursor: pointer;">
                                        <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-play.svg') }}" alt="" width="20" height="24" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>{{-- / ÜST BÖLÜM --}}

            {{-- ═══════════ ORTA BÖLÜM ═══════════ --}}
            <div x-show="pageTab === 'orta'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

            {{-- ── Logolar ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 50px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="max-width: 580px; margin: 0 auto; margin-bottom: 2.5rem;">
                                <div class="ez" :class="activeField === 'logos_text' && 'ez-active'" data-label="Duzenle" @click="openModal('logos_text', 'Logolar Metni')">
                                    <p style="text-align: center; font-size: 1.125rem; color: rgb(1 28 26);" x-html="fields.logos_text || 'Get in touch with the <strong>250+</strong> companies who Collaboration us'"></p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: center; gap: 3rem; opacity: 0.4;">
                                @for($i = 0; $i < 5; $i++)
                                <div style="width: 120px; height: 40px; background: #E0E0E0; border-radius: 8px;"></div>
                                @endfor
                            </div>
                            <p style="text-align: center; font-size: 0.75rem; color: #8D8D8D; margin-top: 1rem; font-style: italic;">Logolar veritabanindan otomatik cekilir</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">CTA</span></div></div>

            {{-- ── CTA ── --}}
            <div>
                <div style="position: relative; z-index: 10; overflow: hidden; background: rgb(84 62 232); border-radius: 8px; margin: 1.5rem; display: grid; grid-template-columns: 0.8fr 1fr; gap: 56px;">
                    <div style="position: relative; order: 1;">
                        <div class="ez ez-img" :class="activeField === 'cta_image' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('cta_image', 'CTA Resmi', 'image')" style="height: 100%; display: flex; align-items: flex-end;">
                            <img :src="fields.cta_image ? (fields.cta_image.startsWith('http') ? fields.cta_image : baseUrl + '/' + fields.cta_image) : '{{ asset('assets-front/img/images/th-3/content-img-3.png') }}'" alt="" style="max-width: 100%; display: block;" />
                        </div>
                    </div>
                    <div style="order: 2; padding: 48px 24px 48px 0;">
                        <div style="max-width: 530px;">
                            <div class="ez" :class="activeField === 'cta_label' && 'ez-active'" data-label="Duzenle" @click="openModal('cta_label', 'CTA Etiket')" style="margin-bottom: 1.25rem;">
                                <span x-text="fields.cta_label || 'ONLINE COURSES'" style="display: block; text-transform: uppercase; color: rgb(255 205 32); font-size: 1rem; font-weight: 500;"></span>
                            </div>
                            <div class="ez" :class="activeField === 'cta_title' && 'ez-active'" data-label="Duzenle" @click="openModal('cta_title', 'CTA Baslik')">
                                <h2 x-text="fields.cta_title || 'Find Your Right Learning Path For Your Future'" style="color: white !important; font-size: 1.875rem; line-height: 1.38;"></h2>
                            </div>
                            <div class="ez" :class="activeField === 'cta_description' && 'ez-active'" data-label="Duzenle" @click="openModal('cta_description', 'CTA Aciklama', 'textarea')" style="margin-top: 1.75rem; margin-bottom: 30px;">
                                <p x-text="fields.cta_description || 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.'" style="color: rgba(255,255,255,0.8); font-size: 1rem; line-height: 1.75;"></p>
                            </div>
                            <div class="ez" :class="activeField === 'cta_button_text' && 'ez-active'" data-label="Duzenle" @click="openModal('cta_button_text', 'CTA Buton')">
                                <div style="position: relative; display: inline-flex; align-items: center; overflow: hidden; border-radius: 52px; padding: 1rem 70px 1rem 30px; background-color: rgb(255 205 32); color: rgb(1 28 26); font-size: 1rem;">
                                    <span x-text="fields.cta_button_text || 'Start Learning Today'"></span>
                                    <span style="position: absolute; right: 5px; display: inline-flex; width: 2.75rem; height: 2.75rem; align-items: center; justify-content: center; border-radius: 50%; background: rgb(1 28 26);">
                                        <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-arrow-right.svg') }}" alt="" width="13" height="12" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-4-white.svg') }}" alt="" width="108" height="67" style="position: absolute; bottom: 0; left: 0; z-index: -1;" />
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Neden Biz (2)</span></div></div>

            {{-- ── Section 2 — Neden Biz (2) ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 70px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                                {{-- Left --}}
                                <div>
                                    <div style="margin-bottom: 1.5rem;">
                                        <div class="ez" :class="activeField === 'section2_label' && 'ez-active'" data-label="Duzenle" @click="openModal('section2_label', 'Etiket')" style="margin-bottom: 1.25rem;">
                                            <span x-text="fields.section2_label || 'WHY CHOOSE US'" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'section2_title' && 'ez-active'" data-label="Duzenle" @click="openModal('section2_title', 'Baslik')">
                                            <h2 x-text="fields.section2_title || 'Digital Online Academy: Your Path to Creative Excellence'"></h2>
                                        </div>
                                    </div>
                                    <div class="ez" :class="activeField === 'section2_description' && 'ez-active'" data-label="Duzenle" @click="openModal('section2_description', 'Aciklama', 'textarea')">
                                        <p x-text="fields.section2_description || 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.'" style="color: rgb(95 93 93); line-height: 1.75;"></p>
                                    </div>

                                    {{-- Dynamic Section 2 Features --}}
                                    <div style="margin-top: 1.5rem; margin-bottom: 2.5rem;">
                                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem;">
                                            <template x-for="(item, sIdx) in fields.section2_features" :key="sIdx">
                                                <li style="display: flex; align-items: center; gap: 0.75rem;">
                                                    <svg style="width: 18px; height: 18px; color: rgb(84 62 232); flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                                    <input type="text" x-model="fields.section2_features[sIdx]" @change="saveAll()" class="s2-input" />
                                                    <button type="button" @click="removeSection2Feature(sIdx)" class="del-btn" title="Sil">
                                                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                                    </button>
                                                </li>
                                            </template>
                                        </ul>
                                        <button type="button" @click="addSection2Feature()" class="add-btn" style="margin-top: 1rem; font-size: 0.8125rem; padding: 0.5rem 1rem;">
                                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                            Yeni Madde Ekle
                                        </button>
                                    </div>
                                </div>

                                {{-- Right --}}
                                <div style="position: relative;">
                                    <div class="ez ez-img" :class="activeField === 'section2_image' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('section2_image', 'Resim', 'image')" style="display: inline-block; margin: 0 auto;">
                                        <img :src="fields.section2_image ? (fields.section2_image.startsWith('http') ? fields.section2_image : baseUrl + '/' + fields.section2_image) : '{{ asset('assets-front/img/images/th-3/content-img-4.png') }}'" alt="" width="482" height="486" style="max-width: 100%; display: block;" />
                                    </div>
                                    <div style="position: absolute; bottom: 80px; left: 40px; z-index: 10; display: inline-flex; align-items: center; gap: 1.25rem; background: white; padding: 0.875rem 2rem 0.875rem 1rem; border-radius: 8px; box-shadow: 17px 18px 30px 16px rgba(7,2,41,0.1);">
                                        <div style="display: inline-flex; width: 64px; height: 64px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(223,67,67,0.05);">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tamato-emotion-laugh-line.svg') }}" alt="" width="28" height="28" />
                                        </div>
                                        <div>
                                            <div class="ez" :class="activeField === 'section2_stat_number' && 'ez-active'" data-label="Duzenle" @click="openModal('section2_stat_number', 'Istatistik Sayisi')">
                                                <span x-text="fields.section2_stat_number || '3458+'" style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.75rem; font-weight: 700; line-height: 1; color: #DF4343;"></span>
                                            </div>
                                            <div class="ez" :class="activeField === 'section2_stat_text' && 'ez-active'" data-label="Duzenle" @click="openModal('section2_stat_text', 'Istatistik Metni')" style="margin-top: 0.25rem;">
                                                <span x-text="fields.section2_stat_text || 'Satisfied Students'" style="color: rgb(95 93 93);"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>{{-- / ORTA BÖLÜM --}}

            {{-- ═══════════ ALT BÖLÜM ═══════════ --}}
            <div x-show="pageTab === 'alt'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

            {{-- ── Yorumlar ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 70px 0 50px;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="max-width: 500px; margin: 0 auto; text-align: center; margin-bottom: 3rem;">
                                <div class="ez" :class="activeField === 'testimonial_label' && 'ez-active'" data-label="Duzenle" @click="openModal('testimonial_label', 'Yorumlar Etiket')" style="margin-bottom: 1.25rem;">
                                    <span x-text="fields.testimonial_label || 'OUR TESTIMONIAL'" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                </div>
                                <div class="ez" :class="activeField === 'testimonial_title' && 'ez-active'" data-label="Duzenle" @click="openModal('testimonial_title', 'Yorumlar Baslik')">
                                    <h2 x-text="fields.testimonial_title || 'Student Thinking About Us'"></h2>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                                @php $colors = ['rgba(215,59,62,0.08)', 'rgba(66,172,152,0.08)', 'rgba(84,62,232,0.08)']; @endphp
                                @for($i = 0; $i < 3; $i++)
                                <div style="background: {{ $colors[$i] }}; padding: 30px; border-radius: 8px;">
                                    <div style="display: flex; gap: 2px; margin-bottom: 1rem;">
                                        @for($s = 0; $s < 5; $s++)
                                        <svg style="width:16px;height:16px;color:#FBBF24;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                    <p style="font-size: 1.125rem; color: rgb(1 28 26); font-style: italic;">"Ornek yorum metni..."</p>
                                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-top: 2rem;">
                                        <div style="width: 44px; height: 44px; border-radius: 50%; background: #E0E0E0;"></div>
                                        <div><span style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; color: rgb(1 28 26);">Ogrenci Adi</span><span style="font-size: 0.875rem;">Pozisyon</span></div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                            <p style="text-align: center; font-size: 0.75rem; color: #8D8D8D; margin-top: 1.5rem; font-style: italic;">Yorumlar veritabanindan otomatik cekilir</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">SSS</span></div></div>

            {{-- ── SSS ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 70px 0 50px;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start;">
                                <div style="display: flex; gap: 1.75rem;">
                                    <div class="ez ez-img" :class="activeField === 'faq_image1' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('faq_image1', 'SSS Resim 1', 'image')" style="width: 258px; min-height: 380px; border-radius: 8px; overflow: hidden; background: #F0F0F0;">
                                        <img :src="fields.faq_image1 ? (fields.faq_image1.startsWith('http') ? fields.faq_image1 : baseUrl + '/' + fields.faq_image1) : '{{ asset('assets-front/img/images/th-2/faq-img-1.png') }}'" alt="" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                                        <div class="ez ez-img" :class="activeField === 'faq_image2' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('faq_image2', 'SSS Resim 2', 'image')" style="width: 258px; min-height: 150px; border-radius: 8px; overflow: hidden; background: #F0F0F0;">
                                            <img :src="fields.faq_image2 ? (fields.faq_image2.startsWith('http') ? fields.faq_image2 : baseUrl + '/' + fields.faq_image2) : '{{ asset('assets-front/img/images/th-2/faq-img-2.png') }}'" alt="" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                                        </div>
                                        <div class="ez ez-img" :class="activeField === 'faq_image3' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('faq_image3', 'SSS Resim 3', 'image')" style="width: 258px; min-height: 300px; border-radius: 8px; overflow: hidden; background: #F0F0F0;">
                                            <img :src="fields.faq_image3 ? (fields.faq_image3.startsWith('http') ? fields.faq_image3 : baseUrl + '/' + fields.faq_image3) : '{{ asset('assets-front/img/images/th-2/faq-img-3.png') }}'" alt="" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div style="margin-bottom: 1.5rem;">
                                        <div class="ez" :class="activeField === 'faq_label' && 'ez-active'" data-label="Duzenle" @click="openModal('faq_label', 'SSS Etiket')" style="margin-bottom: 1.25rem;">
                                            <span x-text="fields.faq_label || 'FREQUENTLY ASKED QUESTIONS'" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'faq_title' && 'ez-active'" data-label="Duzenle" @click="openModal('faq_title', 'SSS Baslik')">
                                            <h2 x-text="fields.faq_title || 'Most Popular Questions About Our Online Courses'"></h2>
                                        </div>
                                    </div>
                                    <div style="margin-top: 1.75rem; display: flex; flex-direction: column; gap: 1rem;">
                                        @for($i = 1; $i <= 3; $i++)
                                        <div style="background: #F5F5F5; border-radius: 8px; padding: 1.25rem 1.5rem;">
                                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                                <span style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; color: rgb(1 28 26);">Ornek soru {{ $i }}?</span>
                                                <svg style="width: 13px; height: 7px;" viewBox="0 0 13 7" fill="none"><path d="M1 1l5.5 5L12 1" stroke="rgb(1 28 26)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </div>
                                        </div>
                                        @endfor
                                    </div>
                                    <p style="font-size: 0.75rem; color: #8D8D8D; margin-top: 1rem; font-style: italic;">SSS veritabanindan otomatik cekilir</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Blog</span></div></div>

            {{-- ── Blog ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 70px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="max-width: 450px; margin: 0 auto; text-align: center; margin-bottom: 3rem;">
                                <div class="ez" :class="activeField === 'blog_label' && 'ez-active'" data-label="Duzenle" @click="openModal('blog_label', 'Blog Etiket')" style="margin-bottom: 1.25rem;">
                                    <span x-text="fields.blog_label || 'OUR NEWS'" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                </div>
                                <div class="ez" :class="activeField === 'blog_title' && 'ez-active'" data-label="Duzenle" @click="openModal('blog_title', 'Blog Baslik')">
                                    <h2 x-text="fields.blog_title || 'Our New Articles'"></h2>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                                @for($i = 0; $i < 3; $i++)
                                <div style="border-radius: 8px; overflow: hidden;">
                                    <div style="width: 100%; height: 220px; background: #F0F0F0; border-radius: 10px;"></div>
                                    <div style="margin-top: 1.75rem;">
                                        <span style="font-size: 0.875rem; color: rgb(95 93 93);">01 Oca, 2026</span>
                                        <p style="margin-top: 1rem; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.25rem; font-weight: 700; color: rgb(1 28 26);">Ornek Blog Basligi</p>
                                    </div>
                                </div>
                                @endfor
                            </div>
                            <p style="text-align: center; font-size: 0.75rem; color: #8D8D8D; margin-top: 1.5rem; font-style: italic;">Bloglar veritabanindan otomatik cekilir</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Footer CTA</span></div></div>

            {{-- ── Footer CTA (ContactPageInfo) ── --}}
            <div>
                <div style="position: relative; z-index: 10; overflow: hidden; background: rgb(84 62 232); border-radius: 8px; margin: 1.5rem; display: grid; grid-template-columns: 0.8fr 1fr; gap: 56px;">
                    <div style="position: relative; order: 1;">
                        <div class="ez ez-img" :class="activeField === 'footer_cta_image' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('footer_cta_image', 'Footer CTA Resmi', 'image')" style="height: 100%; display: flex; align-items: flex-end;">
                            <img :src="fields.footer_cta_image ? (fields.footer_cta_image.startsWith('http') ? fields.footer_cta_image : baseUrl + '/' + fields.footer_cta_image) : '{{ asset('assets-front/img/images/th-1/cta-img.png') }}'" alt="" style="max-width: 100%; display: block;" />
                        </div>
                    </div>
                    <div style="order: 2; padding: 48px 24px 48px 0;">
                        <div style="max-width: 530px;">
                            <div class="ez" :class="activeField === 'footer_cta_label' && 'ez-active'" data-label="Duzenle" @click="openModal('footer_cta_label', 'Footer CTA Etiket')" style="margin-bottom: 1.25rem;">
                                <span x-text="fields.footer_cta_label || 'HEMEN BASLAYIN'" style="display: block; text-transform: uppercase; color: rgb(255 205 32); font-size: 1rem; font-weight: 500;"></span>
                            </div>
                            <div class="ez" :class="activeField === 'footer_cta_title' && 'ez-active'" data-label="Duzenle" @click="openModal('footer_cta_title', 'Footer CTA Baslik')">
                                <h2 x-text="fields.footer_cta_title || 'Uygun Fiyatli Online Kurslar & Ogrenme Firsatlari'" style="color: white !important; font-size: 1.875rem; line-height: 1.38;"></h2>
                            </div>
                            <div class="ez" :class="activeField === 'footer_cta_description' && 'ez-active'" data-label="Duzenle" @click="openModal('footer_cta_description', 'Footer CTA Aciklama', 'textarea')" style="margin-top: 1.75rem; margin-bottom: 30px;">
                                <p x-text="fields.footer_cta_description || 'Kariyerinizi bir adim oteye tasiyacak egitimlerle tanismaya hazir misiniz? Hemen kayit olun ve ogrenmeye baslayin.'" style="color: rgba(255,255,255,0.8); font-size: 1rem; line-height: 1.75;"></p>
                            </div>
                            <div class="ez" :class="activeField === 'footer_cta_button_text' && 'ez-active'" data-label="Duzenle" @click="openModal('footer_cta_button_text', 'Footer CTA Buton')">
                                <div style="position: relative; display: inline-flex; align-items: center; overflow: hidden; border-radius: 52px; padding: 1rem 70px 1rem 30px; background-color: rgb(255 205 32); color: rgb(1 28 26); font-size: 1rem;">
                                    <span x-text="fields.footer_cta_button_text || 'Ogrenmeye Basla'"></span>
                                    <span style="position: absolute; right: 5px; display: inline-flex; width: 2.75rem; height: 2.75rem; align-items: center; justify-content: center; border-radius: 50%; background: rgb(1 28 26);">
                                        <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-arrow-right.svg') }}" alt="" width="13" height="12" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('assets-front/img/abstracts/abstract-golden-yellow-dash-2.svg') }}" alt="" width="44" height="37" style="position: absolute; left: 400px; top: 16px; z-index: -1;" />
                    <img src="{{ asset('assets-front/img/abstracts/abstract-dots-4-white.svg') }}" alt="" width="108" height="67" style="position: absolute; bottom: 0; right: 0; z-index: -1;" />
                </div>
                <p style="text-align: center; font-size: 0.75rem; color: #8D8D8D; margin-top: 0.5rem; margin-bottom: 1rem; font-style: italic;">Bu alan tum sayfalarin footer bolumunde goruntulenir</p>
            </div>

            </div>{{-- / ALT BÖLÜM --}}

        </div>

        {{-- ═══════════ EDIT MODAL (text / textarea) ═══════════ --}}
        <template x-teleport="body">
        <div x-show="modal && modalType !== 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;" @keydown.escape.window="closeModal()">
            <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="closeModal()"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
            <div x-show="modal && modalType !== 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                 style="background: white; border-radius: 16px; box-shadow: 0 25px 50px rgba(1,28,26,0.2); width: 100%; max-width: 540px; overflow: hidden;" @click.stop>
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgb(1 28 26 / 0.06); display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 36px; height: 36px; background: rgb(84 62 232); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 18px; height: 18px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                        </div>
                        <h3 x-text="modalLabel" style="font-size: 1.125rem; font-weight: 600; color: rgb(1 28 26); font-family: 'Aeonik Pro TRIAL', sans-serif;"></h3>
                    </div>
                    <button type="button" @click="closeModal()" style="width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgb(95 93 93); cursor: pointer; border: none; background: #F5F5F5;">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div style="padding: 1.5rem;">
                    <template x-if="modalType === 'text'">
                        <div>
                            <input type="text" x-model="modalValue" x-ref="modalInput" :maxlength="modalMaxLength > 0 ? modalMaxLength : undefined" class="modal-input" :class="validationError && 'modal-input-error'" @keydown.enter="applyAndSave()" @input="validateField()">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 6px; min-height: 20px;">
                                <span x-show="validationError" x-text="validationError" style="font-size: 0.75rem; color: rgb(215 59 62);"></span>
                                <span x-show="modalMaxLength > 0" x-text="(modalValue?.length || 0) + '/' + modalMaxLength" style="font-size: 0.7rem; color: #8D8D8D; margin-left: auto;"></span>
                            </div>
                        </div>
                    </template>
                    <template x-if="modalType === 'textarea'">
                        <div>
                            <textarea x-model="modalValue" x-ref="modalTextarea" rows="4" :maxlength="modalMaxLength > 0 ? modalMaxLength : undefined" class="modal-input modal-textarea" :class="validationError && 'modal-input-error'" @input="validateField()"></textarea>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 6px; min-height: 20px;">
                                <span x-show="validationError" x-text="validationError" style="font-size: 0.75rem; color: rgb(215 59 62);"></span>
                                <span x-show="modalMaxLength > 0" x-text="(modalValue?.length || 0) + '/' + modalMaxLength" style="font-size: 0.7rem; color: #8D8D8D; margin-left: auto;"></span>
                            </div>
                        </div>
                    </template>
                </div>
                <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" @click="closeModal()" style="padding: 0.6rem 1.25rem; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif;">Iptal</button>
                    <button type="button" @click="applyAndSave()" :disabled="saving || !!validationError" class="modal-apply-btn" :class="(validationError || saving) && 'modal-apply-btn-disabled'">
                        <span x-show="!saving">Uygula</span>
                        <span x-show="saving">Kaydediliyor...</span>
                    </button>
                </div>
            </div>
            </div>
        </div>
        </template>

        {{-- ═══════════ IMAGE MODAL ═══════════ --}}
        <template x-teleport="body">
        <div x-show="modal && modalType === 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             style="position: fixed; inset: 0; z-index: 9999; padding: 1rem;" @keydown.escape.window="closeModal()">
            <div style="position: absolute; inset: 0; background: rgba(1,28,26,0.4);" @click="closeModal()"></div>
            <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; min-height: 100%;">
            <div x-show="modal && modalType === 'image'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                 style="background: white; border-radius: 16px; box-shadow: 0 25px 50px rgba(1,28,26,0.2); width: 100%; max-width: 580px; overflow: hidden;" @click.stop>
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgb(1 28 26 / 0.06); display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 36px; height: 36px; background: rgb(84 62 232); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 18px; height: 18px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                        </div>
                        <h3 x-text="modalLabel" style="font-size: 1.125rem; font-weight: 600; color: rgb(1 28 26); font-family: 'Aeonik Pro TRIAL', sans-serif;"></h3>
                    </div>
                    <button type="button" @click="closeModal()" style="width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgb(95 93 93); cursor: pointer; border: none; background: #F5F5F5;">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div style="padding: 1rem 1.5rem 0; display: flex; gap: 0.5rem;">
                    <button type="button" class="img-tab" :class="imgTab === 'upload' ? 'active' : ''" @click="imgTab = 'upload'">Dosya Yukle</button>
                    <button type="button" class="img-tab" :class="imgTab === 'url' ? 'active' : ''" @click="imgTab = 'url'">URL Gir</button>
                </div>
                <div style="padding: 1.5rem;">
                    <template x-if="imgPreview">
                        <div style="margin-bottom: 1rem; border-radius: 10px; overflow: hidden; border: 1px solid rgb(1 28 26 / 0.08);">
                            <img :src="imgPreview" style="max-width: 100%; max-height: 200px; display: block; margin: 0 auto;" />
                        </div>
                    </template>
                    <div x-show="imgTab === 'upload'">
                        <div class="upload-drop-zone" :class="imgDragover && 'dragover'" @click="$refs.fileInput.click()" @dragover.prevent="imgDragover = true" @dragleave.prevent="imgDragover = false" @drop.prevent="handleDrop($event)">
                            <input type="file" x-ref="fileInput" accept=".jpg,.jpeg,.png,.gif,.webp,.svg,.ico" style="display: none;" @change="handleFileSelect($event)" />
                            <svg style="width: 2.5rem; height: 2.5rem; color: rgb(84 62 232); opacity: 0.5; margin: 0 auto 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                            <p style="font-size: 0.875rem; color: rgb(95 93 93); margin: 0;">
                                <span x-show="!uploading">Tiklayin veya surukleyip birakin</span>
                                <span x-show="uploading" style="color: rgb(84 62 232);">Yukleniyor...</span>
                            </p>
                            <p style="font-size: 0.75rem; color: #8D8D8D; margin: 0.25rem 0 0;">JPG, PNG, GIF, WEBP, SVG, ICO (max 5MB)</p>
                        </div>
                    </div>
                    <div x-show="imgTab === 'url'">
                        <input type="text" x-model="modalValue" placeholder="https://... veya uploads/pages/..." class="modal-input" @keydown.enter="applyAndSave()" @input="imgPreview = $event.target.value.startsWith('http') ? $event.target.value : ($event.target.value ? baseUrl + '/' + $event.target.value : '')">
                    </div>
                </div>
                <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: space-between; align-items: center;">
                    <button type="button" @click="modalValue = ''; imgPreview = ''" style="padding: 0.6rem 1rem; border-radius: 10px; font-size: 0.8125rem; font-weight: 500; color: rgb(215 59 62); border: 1px solid rgb(215 59 62 / 0.2); background: white; cursor: pointer; font-family: Poppins, sans-serif;">Resmi Kaldir</button>
                    <div style="display: flex; gap: 0.75rem;">
                        <button type="button" @click="closeModal()" style="padding: 0.6rem 1.25rem; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif;">Iptal</button>
                        <button type="button" @click="applyAndSave()" :disabled="saving" class="modal-apply-btn">
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
@php
    // Section 1 features init
    $_s1f = $aboutPageInfo->getTranslation('section1_features', $selectedLang, false);
    if (!is_array($_s1f) || count($_s1f) === 0) {
        $f1 = translateAttribute($aboutPageInfo, 'section1_feature1_title', $selectedLang);
        $f2 = translateAttribute($aboutPageInfo, 'section1_feature2_title', $selectedLang);
        if ($f1 || $f2) {
            $_s1f = [];
            if ($f1) $_s1f[] = ['title' => $f1, 'description' => translateAttribute($aboutPageInfo, 'section1_feature1_description', $selectedLang) ?? '', 'icon' => $aboutPageInfo->section1_feature1_icon ?? '', 'bg_color' => '#42AC98'];
            if ($f2) $_s1f[] = ['title' => $f2, 'description' => translateAttribute($aboutPageInfo, 'section1_feature2_description', $selectedLang) ?? '', 'icon' => $aboutPageInfo->section1_feature2_icon ?? '', 'bg_color' => '#D73B3E'];
        } else {
            $_s1f = [
                ['title' => 'Face-to-face Teaching', 'description' => 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.', 'icon' => '', 'bg_color' => '#42AC98'],
                ['title' => '24/7 Support Available', 'description' => 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.', 'icon' => '', 'bg_color' => '#D73B3E'],
            ];
        }
    }

    // Section 2 features init
    $_s2f = $aboutPageInfo->getTranslation('section2_features', $selectedLang, false);
    if (is_string($_s2f) && $_s2f) {
        $_s2f = array_values(array_filter(array_map('trim', explode("\n", $_s2f))));
    }
    if (!is_array($_s2f) || count($_s2f) === 0) {
        $_s2f = ['Our Expert Trainers', 'Online Remote Learning', 'Easy to follow curriculum', 'Lifetime Access'];
    }
@endphp
<script>
function aboutEditor() {
    return {
        pageTab: 'ust',
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
        editingFeatureIndex: -1,
        editingFeatureField: '',
        baseUrl: @json(url('/')),

        fields: {
            breadcrumb_title: @json(translateAttribute($aboutPageInfo, 'breadcrumb_title', $selectedLang) ?? ''),
            breadcrumb_home: @json(translateAttribute($aboutPageInfo, 'breadcrumb_home', $selectedLang) ?? ''),
            breadcrumb_current: @json(translateAttribute($aboutPageInfo, 'breadcrumb_current', $selectedLang) ?? ''),
            section1_label: @json(translateAttribute($aboutPageInfo, 'section1_label', $selectedLang) ?? ''),
            section1_title: @json(translateAttribute($aboutPageInfo, 'section1_title', $selectedLang) ?? ''),
            section1_description: @json(translateAttribute($aboutPageInfo, 'section1_description', $selectedLang) ?? ''),
            section1_features: @json($_s1f),
            section1_stat_text: @json(translateAttribute($aboutPageInfo, 'section1_stat_text', $selectedLang) ?? ''),
            section1_image1: @json($aboutPageInfo->section1_image1 ?? ''),
            section1_image2: @json($aboutPageInfo->section1_image2 ?? ''),
            section1_stat_number: @json($aboutPageInfo->section1_stat_number ?? ''),
            categories_label: @json(translateAttribute($aboutPageInfo, 'categories_label', $selectedLang) ?? ''),
            categories_title: @json(translateAttribute($aboutPageInfo, 'categories_title', $selectedLang) ?? ''),
            categories_button_text: @json(translateAttribute($aboutPageInfo, 'categories_button_text', $selectedLang) ?? ''),
            video_image: @json($aboutPageInfo->video_image ?? ''),
            video_url: @json($aboutPageInfo->video_url ?? ''),
            logos_text: @json(translateAttribute($aboutPageInfo, 'logos_text', $selectedLang) ?? ''),
            cta_label: @json(translateAttribute($aboutPageInfo, 'cta_label', $selectedLang) ?? ''),
            cta_title: @json(translateAttribute($aboutPageInfo, 'cta_title', $selectedLang) ?? ''),
            cta_description: @json(translateAttribute($aboutPageInfo, 'cta_description', $selectedLang) ?? ''),
            cta_button_text: @json(translateAttribute($aboutPageInfo, 'cta_button_text', $selectedLang) ?? ''),
            cta_image: @json($aboutPageInfo->cta_image ?? ''),
            section2_label: @json(translateAttribute($aboutPageInfo, 'section2_label', $selectedLang) ?? ''),
            section2_title: @json(translateAttribute($aboutPageInfo, 'section2_title', $selectedLang) ?? ''),
            section2_description: @json(translateAttribute($aboutPageInfo, 'section2_description', $selectedLang) ?? ''),
            section2_features: @json($_s2f),
            section2_stat_text: @json(translateAttribute($aboutPageInfo, 'section2_stat_text', $selectedLang) ?? ''),
            section2_image: @json($aboutPageInfo->section2_image ?? ''),
            section2_stat_number: @json($aboutPageInfo->section2_stat_number ?? ''),
            testimonial_label: @json(translateAttribute($aboutPageInfo, 'testimonial_label', $selectedLang) ?? ''),
            testimonial_title: @json(translateAttribute($aboutPageInfo, 'testimonial_title', $selectedLang) ?? ''),
            faq_label: @json(translateAttribute($aboutPageInfo, 'faq_label', $selectedLang) ?? ''),
            faq_title: @json(translateAttribute($aboutPageInfo, 'faq_title', $selectedLang) ?? ''),
            faq_image1: @json($aboutPageInfo->faq_image1 ?? ''),
            faq_image2: @json($aboutPageInfo->faq_image2 ?? ''),
            faq_image3: @json($aboutPageInfo->faq_image3 ?? ''),
            blog_label: @json(translateAttribute($aboutPageInfo, 'blog_label', $selectedLang) ?? ''),
            blog_title: @json(translateAttribute($aboutPageInfo, 'blog_title', $selectedLang) ?? ''),
            footer_cta_label: @json(translateAttribute($footerCtaInfo, 'cta_label', $selectedLang) ?? ''),
            footer_cta_title: @json(translateAttribute($footerCtaInfo, 'cta_title', $selectedLang) ?? ''),
            footer_cta_description: @json(translateAttribute($footerCtaInfo, 'cta_description', $selectedLang) ?? ''),
            footer_cta_button_text: @json(translateAttribute($footerCtaInfo, 'cta_button_text', $selectedLang) ?? ''),
            footer_cta_button_url: @json($footerCtaInfo->cta_button_url ?? ''),
            footer_cta_image: @json($footerCtaInfo->cta_image ?? ''),
        },

        // Section 1 features
        addFeature() {
            this.fields.section1_features.push({ title: '', description: '', icon: '', bg_color: '#42AC98' });
        },
        removeFeature(index) {
            this.fields.section1_features.splice(index, 1);
            this.saveAll();
        },
        openFeatureModal(index, field, label, type = 'text') {
            this.editingFeatureIndex = index;
            this.editingFeatureField = field;
            this.modalField = '';
            this.modalLabel = label;
            this.modalValue = this.fields.section1_features[index][field] || '';
            this.modalType = type;
            this.activeField = 'feature_' + index + '_' + field;
            this.validationError = '';
            this.modalMaxLength = field === 'title' ? 100 : (field === 'description' ? 300 : 0);
            this.modal = true;

            if (type === 'image') {
                this.imgTab = 'upload';
                this.imgDragover = false;
                const val = this.fields.section1_features[index][field];
                this.imgPreview = val ? (val.startsWith('http') ? val : this.baseUrl + '/' + val) : '';
            }

            this.$nextTick(() => {
                const input = this.$refs.modalInput || this.$refs.modalTextarea;
                if (input) input.focus();
            });
        },

        // Section 2 features
        addSection2Feature() {
            this.fields.section2_features.push('');
        },
        removeSection2Feature(index) {
            this.fields.section2_features.splice(index, 1);
            this.saveAll();
        },

        openModal(field, label, type = 'text') {
            this.editingFeatureIndex = -1;
            this.editingFeatureField = '';
            this.modalField = field;
            this.modalLabel = label;
            this.modalValue = this.fields[field] || '';
            this.modalType = type;
            this.activeField = field;
            this.validationError = '';
            this.modalMaxLength = this.getMaxLength(field);
            this.modal = true;

            if (type === 'image') {
                this.imgTab = 'upload';
                this.imgDragover = false;
                const val = this.fields[field];
                this.imgPreview = val ? (val.startsWith('http') ? val : this.baseUrl + '/' + val) : '';
            }

            this.$nextTick(() => {
                const input = this.$refs.modalInput || this.$refs.modalTextarea;
                if (input) input.focus();
            });
        },

        closeModal() {
            this.modal = false;
            this.activeField = '';
            this.editingFeatureIndex = -1;
            this.editingFeatureField = '';
        },

        async applyAndSave() {
            this.validateField();
            if (this.validationError) return;

            if (this.editingFeatureIndex >= 0 && this.editingFeatureField) {
                this.fields.section1_features[this.editingFeatureIndex][this.editingFeatureField] = this.modalValue;
                this.editingFeatureIndex = -1;
                this.editingFeatureField = '';
            } else {
                this.fields[this.modalField] = this.modalValue;
            }
            this.modal = false;
            this.activeField = '';
            await this.saveAll();
        },

        getMaxLength(field) {
            const limits = {
                breadcrumb_title: 150, breadcrumb_home: 30, breadcrumb_current: 30,
                section1_label: 60, section1_title: 200, section1_description: 500,
                section1_stat_text: 60, section1_stat_number: 20,
                categories_label: 60, categories_title: 200, categories_button_text: 50,
                video_url: 500, logos_text: 300,
                cta_label: 60, cta_title: 200, cta_description: 500, cta_button_text: 50,
                section2_label: 60, section2_title: 200, section2_description: 500,
                section2_stat_text: 60, section2_stat_number: 20,
                testimonial_label: 60, testimonial_title: 200,
                faq_label: 80, faq_title: 200,
                blog_label: 60, blog_title: 200,
                footer_cta_label: 60, footer_cta_title: 200, footer_cta_description: 500, footer_cta_button_text: 50, footer_cta_button_url: 500,
            };
            return limits[field] || 0;
        },

        validateField() {
            const val = (this.modalValue || '').trim();
            this.validationError = '';
            const maxLen = this.modalMaxLength;
            if (maxLen > 0 && val.length > maxLen) {
                this.validationError = 'Maksimum ' + maxLen + ' karakter girebilirsiniz.';
            }
        },

        async saveAll() {
            this.saving = true;
            try {
                const formData = new FormData();
                formData.append('lang', '{{ $selectedLang }}');
                formData.append('_token', '{{ csrf_token() }}');

                for (const [key, value] of Object.entries(this.fields)) {
                    if (key === 'section1_features' || key === 'section2_features') {
                        formData.append(key, JSON.stringify(value));
                    } else {
                        formData.append(key, value || '');
                    }
                }

                const res = await fetch('{{ route('pages.update', ['id' => 'about']) }}', {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                    body: formData,
                });

                const data = await res.json();
                if (data.success) this.showToast('Kaydedildi', 'success');
                else this.showToast('Hata olustu', 'error');
            } catch (e) {
                this.showToast('Baglanti hatasi', 'error');
            }
            this.saving = false;
        },

        showToast(msg, type) {
            const el = document.getElementById('toast-msg');
            el.textContent = msg;
            el.className = 'toast-msg ' + type + ' show';
            setTimeout(() => { el.classList.remove('show'); }, 2500);
        },

        handleFileSelect(e) {
            const file = e.target.files[0];
            if (file) this.uploadFile(file);
        },

        handleDrop(e) {
            this.imgDragover = false;
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) this.uploadFile(file);
        },

        async uploadFile(file) {
            if (file.size > 5 * 1024 * 1024) {
                this.showToast('Dosya 5MB\'dan buyuk olamaz', 'error');
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
                    this.showToast('Resim yuklendi', 'success');
                } else {
                    this.showToast('Yukleme hatasi', 'error');
                }
            } catch (e) {
                this.showToast('Yukleme hatasi', 'error');
            }
            this.uploading = false;
        },
    };
}
</script>
@endsection
