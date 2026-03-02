@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Eğitmenler Sayfası</h1>
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

        /* Upload */
        .upload-drop-zone {
            border: 2px dashed rgb(84 62 232 / 0.3); border-radius: 12px; padding: 2rem;
            text-align: center; cursor: pointer; transition: all 0.2s;
        }
        .upload-drop-zone:hover, .upload-drop-zone.dragover {
            border-color: rgb(84 62 232); background: rgb(84 62 232 / 0.04);
        }

        /* Modal input/textarea */
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
            font-family: Poppins, sans-serif; box-shadow: 0 4px 12px rgba(84, 62, 232, 0.3); transition: opacity 0.2s;
        }
        .modal-apply-btn-disabled { opacity: 0.5; cursor: not-allowed !important; }

        .img-tab { padding: 8px 16px; border-radius: 8px; font-size: 0.8125rem; font-weight: 500; border: none; cursor: pointer; transition: all 0.15s; font-family: Poppins, sans-serif; }
        .img-tab.active { background: rgb(84 62 232); color: white; }
        .img-tab:not(.active) { background: #F5F5F5; color: rgb(95 93 93); }
        .img-tab:not(.active):hover { background: #EBEBEB; }

        /* Teacher card preview */
        .teacher-card-preview { border-radius: 8px; overflow: hidden; }
        .teacher-card-preview img { width: 100%; height: 220px; object-fit: cover; }
        .teacher-card-info { padding: 16px 0 0; }
        .teacher-card-info span { display: block; font-size: 0.875rem; margin-bottom: 4px; color: rgb(95 93 93); }
        .teacher-card-info strong { font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.125rem; font-weight: 700; color: rgb(1 28 26); }

        /* Style controls */
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

        /* Developer panel */
        .dev-row { display: grid; grid-template-columns: 220px 1fr 110px 140px 40px; gap: 0; align-items: center; padding: 10px 20px; border-bottom: 1px solid #F3F4F6; transition: background 0.15s; }
        .dev-row:hover { background: #F3F4F6; }
        .dev-row-modified { background: #FFFBEB; }
        .dev-row-modified:hover { background: #FDE68A40; }
        .dev-reset-btn { width: 28px; height: 28px; border-radius: 6px; border: 1px solid #FECACA; background: #FEF2F2; color: #DC2626; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; transition: all 0.15s; }
        .dev-reset-btn:hover { background: #FEE2E2; border-color: #F87171; }
        .dev-color-input { width: 32px; height: 32px; border: 2px solid #D1D5DB; cursor: pointer; border-radius: 6px; padding: 2px; flex-shrink: 0; transition: border-color 0.15s; }
        .dev-color-input:hover { border-color: #F59E0B; }
        .dev-text-input { width: 90px; font-size: 0.8125rem; color: #374151; font-family: ui-monospace, monospace; background: #F9FAFB; border: 1.5px solid #E5E7EB; border-radius: 6px; padding: 5px 8px; outline: none; transition: all 0.15s; }
        .dev-text-input:hover { border-color: #D1D5DB; }
        .dev-text-input:focus { border-color: #F59E0B; background: #fff; box-shadow: 0 0 0 2px rgba(245,158,11,0.15); }
        .dev-select { font-size: 0.8125rem; padding: 5px 6px; border: 1.5px solid #E5E7EB; border-radius: 6px; background: #F9FAFB; color: #374151; cursor: pointer; outline: none; width: 90px; transition: all 0.15s; }
        .dev-select:hover { border-color: #D1D5DB; }
        .dev-select:focus { border-color: #F59E0B; background: #fff; box-shadow: 0 0 0 2px rgba(245,158,11,0.15); }
        .dev-align-btn { width: 38px; height: 36px; display: flex; align-items: center; justify-content: center; border: 1.5px solid #D1D5DB; border-radius: 8px; cursor: pointer; background: #F9FAFB; color: #9CA3AF; transition: all 0.15s; }
        .dev-align-btn:hover { border-color: #F59E0B; color: #6B7280; background: #FFFBEB; }
        .dev-align-btn.active { background: #FEF3C7; border-color: #F59E0B; color: #92400E; }
        .dev-save-btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: #F59E0B; color: white; font-weight: 600; border-radius: 8px; font-size: 0.8125rem; border: none; cursor: pointer; transition: all 0.15s; }
        .dev-save-btn:hover { background: #D97706; box-shadow: 0 2px 8px rgba(217,119,6,0.3); }
        .dev-save-btn:disabled { opacity: 0.5; cursor: not-allowed; }
    </style>
@endsection

@section('content')
    <div x-data="teachersEditor()" x-cloak>

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
            <div class="flex items-center gap-2">
                <button type="button" @click="devMode = !devMode" :class="devMode && 'ring-2 ring-amber-400'"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 hover:bg-slate-50 transition-all duration-200 cursor-pointer"
                        :style="devMode ? 'background: #FEF3C7; border-color: #F59E0B;' : ''"
                        title="Gelistirici Modu">
                    <svg class="w-5 h-5" :style="devMode ? 'color: #D97706;' : 'color: #94A3B8;'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </button>
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
        </div>

        @include('admin.pages.partials.dev-panel')

        {{-- LIVE PREVIEW --}}
        <div class="lp" style="border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid rgba(226,232,240,0.5);">

            {{-- Breadcrumb --}}
            <section style="position: relative; z-index: 10; overflow: hidden; background-color: #FAF9F6;">
                <div style="padding: 60px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <div style="text-align: center;">
                            <div class="ez" :class="activeField === 'title' && 'ez-active'" data-label="Başlık + Stil" @click="openModal('title', 'Sayfa Başlığı', 'textarea')">
                                <h1 :style="getFieldStyle('title', 'margin-bottom: 1.25rem; text-transform: capitalize; letter-spacing: normal;')"
                                    x-html="nl2br(fields.title || 'Eğitmenlerimiz')"></h1>
                            </div>
                            <nav style="font-size: 1rem; font-weight: 500; text-transform: uppercase;">
                                <ul style="display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 4px; align-items: center;">
                                    <li>
                                        <span class="ez" :class="activeField === 'breadcrumb_home' && 'ez-active'" data-label="Düzenle" @click="openModal('breadcrumb_home', 'Breadcrumb Ana Sayfa')"
                                              :style="getFieldStyle('breadcrumb_home', 'color: rgb(215 59 62);')" x-text="fields.breadcrumb_home || 'ANA SAYFA'"></span>
                                    </li>
                                    <li style="color: rgb(95 93 93);">/</li>
                                    <li>
                                        <span class="ez" :class="activeField === 'breadcrumb_current' && 'ez-active'" data-label="Düzenle" @click="openModal('breadcrumb_current', 'Breadcrumb Mevcut Sayfa')"
                                              :style="getFieldStyle('breadcrumb_current', 'color: rgb(95 93 93);')" x-text="fields.breadcrumb_current || 'EĞİTMENLER'"></span>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div style="position: absolute; left: -192px; top: 0; z-index: -1; width: 371px; height: 327px; background: #BFC06F; filter: blur(250px);"></div>
                <div style="position: absolute; right: -144px; bottom: 80px; z-index: -1; width: 371px; height: 327px; background: #AAC3E9; filter: blur(200px);"></div>
            </section>

            {{-- Teachers Grid Section --}}
            <div style="background: white;">
                <div style="padding: 70px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">

                        {{-- Teachers Grid (read-only preview) --}}
                        @if($teachers->count() > 0)
                        <ul style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; list-style: none; padding: 0; margin: 0;">
                            @foreach($teachers as $teacher)
                            <li class="teacher-card-preview">
                                <div style="position: relative; overflow: hidden; border-radius: 8px;">
                                    @if($teacher->image)
                                        <img src="{{ asset($teacher->image) }}" alt="{{ $teacher->name }}" />
                                    @else
                                        <div style="width: 100%; height: 220px; background: #F5F5F5; display: flex; align-items: center; justify-content: center;">
                                            <svg style="width: 48px; height: 48px; color: #ccc;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="teacher-card-info">
                                    <span>{{ $teacher->title }}</span>
                                    <strong>{{ $teacher->name }}</strong>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <div style="text-align: center; margin-top: 1.5rem;">
                            <a href="{{ route('teachers.index') }}" style="font-size: 0.8125rem; color: rgb(84 62 232); text-decoration: none; font-weight: 600; border: 1px dashed rgb(84 62 232 / 0.4); padding: 6px 16px; border-radius: 8px;">
                                Eğitmenleri Düzenle &rarr;
                            </a>
                        </div>
                        @else
                        <div style="text-align: center; padding: 3rem 0; color: #8D8D8D; font-size: 0.875rem;">
                            Henüz eğitmen eklenmemiş.
                            <a href="{{ route('teachers.index') }}" style="color: rgb(84 62 232); text-decoration: underline; margin-left: 4px;">Eğitmen Yönetimi'ne git</a>
                        </div>
                        @endif

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
                            <span :style="getFieldStyle('cta_label', 'display: block; text-transform: uppercase; color: rgb(255 205 32); font-size: 1rem; font-weight: 500;')"
                                  x-text="fields.cta_label || 'HEMEN BASLAYIN'"></span>
                        </div>
                        <div class="ez" :class="activeField === 'cta_title' && 'ez-active'" data-label="Düzenle" @click="openModal('cta_title', 'CTA Başlık', 'textarea')">
                            <h2 :style="getFieldStyle('cta_title', 'color: white !important; font-size: 1.875rem; line-height: 1.38;')"
                                x-html="nl2br(fields.cta_title || 'Eğitim yolculuğunuza bugün başlayın')"></h2>
                        </div>
                        <div class="ez" :class="activeField === 'cta_description' && 'ez-active'" data-label="Düzenle" @click="openModal('cta_description', 'CTA Açıklama', 'textarea')" style="margin-top: 1.75rem; margin-bottom: 30px;">
                            <p :style="getFieldStyle('cta_description', 'color: rgba(255,255,255,0.8); font-size: 1rem; line-height: 1.75;')"
                               x-html="nl2br(fields.cta_description || 'Uzman eğitmenlerimizle hedeflerinize ulaşın.')"></p>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div class="ez" :class="activeField === 'cta_button_text' && 'ez-active'" data-label="Düzenle" @click="openModal('cta_button_text', 'CTA Buton Yazısı')">
                                <div style="position: relative; display: inline-flex; align-items: center; overflow: hidden; border-radius: 52px; padding: 1rem 70px 1rem 30px; background-color: rgb(255 205 32); color: rgb(1 28 26); font-size: 1rem; line-height: 1.5rem;">
                                    <span x-text="fields.cta_button_text || 'Hemen Kaydol'"></span>
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

        {{-- EDIT MODAL (text / textarea) --}}
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
                    {{-- Style Section (only for stylable fields) --}}
                    <template x-if="styleFields.includes(modalField)">
                        <div class="style-section">
                            <div class="style-section-title">
                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42"/>
                                </svg>
                                Stil Ayarları
                            </div>

                            {{-- Bold / Italic / Alignment --}}
                            <div class="style-row">
                                <span class="style-label">Biçim</span>
                                <div class="style-toggle-group">
                                    {{-- Bold --}}
                                    <button type="button" class="style-toggle" :class="getStyleProp('fontWeight') === 'bold' && 'active'"
                                            @click="setStyleProp('fontWeight', getStyleProp('fontWeight') === 'bold' ? '' : 'bold')" title="Kalın">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h7a4 4 0 0 1 0 8H6V4Zm0 8h8a4 4 0 0 1 0 8H6v-8Z"/></svg>
                                    </button>
                                    {{-- Italic --}}
                                    <button type="button" class="style-toggle" :class="getStyleProp('fontStyle') === 'italic' && 'active'"
                                            @click="setStyleProp('fontStyle', getStyleProp('fontStyle') === 'italic' ? '' : 'italic')" title="Yatık">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10 4h4m-2 0 -4 16m-2 0h4"/><line x1="14" y1="4" x2="10" y2="20" stroke-width="2"/></svg>
                                    </button>
                                    <div style="width: 1px; background: rgb(1 28 26 / 0.1); margin: 4px 2px;"></div>
                                    {{-- Align Left --}}
                                    <button type="button" class="style-toggle" :class="getStyleProp('textAlign') === 'left' && 'active'"
                                            @click="setStyleProp('textAlign', getStyleProp('textAlign') === 'left' ? '' : 'left')" title="Sola Hizala">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h10.5M3.75 17.25h16.5"/></svg>
                                    </button>
                                    {{-- Align Center --}}
                                    <button type="button" class="style-toggle" :class="(getStyleProp('textAlign') === 'center' || !getStyleProp('textAlign')) && 'active'"
                                            @click="setStyleProp('textAlign', 'center')" title="Ortala">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg>
                                    </button>
                                    {{-- Align Right --}}
                                    <button type="button" class="style-toggle" :class="getStyleProp('textAlign') === 'right' && 'active'"
                                            @click="setStyleProp('textAlign', getStyleProp('textAlign') === 'right' ? '' : 'right')" title="Sağa Hizala">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12H20.25M3.75 17.25h16.5"/></svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Color --}}
                            <div class="style-row">
                                <span class="style-label">Renk</span>
                                <div class="style-color-wrap">
                                    <input type="color" class="style-color-input"
                                           :value="getStyleProp('color') || getDefaultColor(modalField)"
                                           @input="setStyleProp('color', $event.target.value)">
                                    <input type="text" class="style-color-hex"
                                           :value="getStyleProp('color') || getDefaultColor(modalField)"
                                           @input="setStyleProp('color', $event.target.value)"
                                           :placeholder="getDefaultColor(modalField)" maxlength="7">
                                </div>
                            </div>

                            {{-- Opacity --}}
                            <div class="style-row">
                                <span class="style-label">Saydamlık</span>
                                <div class="style-opacity-wrap">
                                    <input type="range" class="style-opacity-range" min="0" max="100" step="1"
                                           :value="getStyleProp('opacity') !== '' ? getStyleProp('opacity') : 100"
                                           @input="setStyleProp('opacity', $event.target.value)">
                                    <input type="text" class="style-opacity-val"
                                           :value="(getStyleProp('opacity') !== '' ? getStyleProp('opacity') : 100) + '%'"
                                           @change="let v = parseInt($event.target.value); if(!isNaN(v)){v=Math.max(0,Math.min(100,v)); setStyleProp('opacity', v);} $event.target.value = (getStyleProp('opacity') !== '' ? getStyleProp('opacity') : 100) + '%'"
                                           maxlength="4">
                                </div>
                            </div>

                            {{-- Font Size --}}
                            <div class="style-row">
                                <span class="style-label">Boyut</span>
                                <select class="style-select" :value="getStyleProp('fontSize') || ''"
                                        @change="setStyleProp('fontSize', $event.target.value)">
                                    <option value="">Varsayılan</option>
                                    <option value="1.25rem">20px - Küçük</option>
                                    <option value="1.5rem">24px - Orta</option>
                                    <option value="1.875rem">30px - Normal</option>
                                    <option value="2rem">32px - Büyük</option>
                                    <option value="2.25rem">36px - Daha Büyük</option>
                                    <option value="2.5rem">40px - Çok Büyük</option>
                                    <option value="3rem">48px - Ekstra Büyük</option>
                                </select>
                            </div>

                            {{-- Font Family --}}
                            <div class="style-row">
                                <span class="style-label">Font</span>
                                <select class="style-select" :value="getStyleProp('fontFamily') || ''"
                                        @change="setStyleProp('fontFamily', $event.target.value)">
                                    <option value="">Varsayılan (Aeonik Pro)</option>
                                    <option value="Poppins, sans-serif" style="font-family: Poppins, sans-serif;">Poppins</option>
                                    <option value="'Aeonik Pro TRIAL', sans-serif" style="font-family: 'Aeonik Pro TRIAL', sans-serif;">Aeonik Pro</option>
                                    <option value="Georgia, serif" style="font-family: Georgia, serif;">Georgia (Serif)</option>
                                    <option value="'Times New Roman', serif" style="font-family: 'Times New Roman', serif;">Times New Roman</option>
                                    <option value="Arial, sans-serif" style="font-family: Arial, sans-serif;">Arial</option>
                                    <option value="Verdana, sans-serif" style="font-family: Verdana, sans-serif;">Verdana</option>
                                </select>
                            </div>

                            {{-- Reset Button --}}
                            <div style="text-align: right; margin-top: 0.5rem;">
                                <button type="button" class="style-reset-btn"
                                        @click="resetFieldStyle()">
                                    Varsayılana Sıfırla
                                </button>
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

        {{-- IMAGE MODAL --}}
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
                            <p style="font-size: 0.75rem; color: #8D8D8D; margin: 0.25rem 0 0;">JPG, PNG, GIF, WEBP, SVG, ICO (max 5MB)</p>
                        </div>
                    </div>

                    <div x-show="imgTab === 'url'">
                        <input type="text" x-model="modalValue" placeholder="https://... veya uploads/pages/..."
                               style="width: 100%; padding: 0.75rem 1rem; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 10px; font-size: 0.9375rem; outline: none; transition: border-color 0.2s; font-family: Poppins, sans-serif; color: rgb(1 28 26);"
                               onfocus="this.style.borderColor='rgb(84 62 232)'" onblur="this.style.borderColor='rgb(1 28 26 / 0.1)'"
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
    function teachersEditor() {
        return {
            modal: false,
            modalField: '',
            modalLabel: '',
            modalValue: '',
            modalType: 'text',
            activeField: '',
            saving: false,
            devMode: false,
            savingDefaults: false,
            imgTab: 'upload',
            imgPreview: '',
            imgDragover: false,
            uploading: false,
            validationError: '',
            modalMaxLength: 0,

            fields: {
                title: @json(translateAttribute($teacherPageInfo, 'title', $selectedLang) ?? ''),
                subtitle: @json(translateAttribute($teacherPageInfo, 'subtitle', $selectedLang) ?? ''),
                cta_label: @json(translateAttribute($teacherPageInfo, 'cta_label', $selectedLang) ?? ''),
                cta_title: @json(translateAttribute($teacherPageInfo, 'cta_title', $selectedLang) ?? ''),
                cta_description: @json(translateAttribute($teacherPageInfo, 'cta_description', $selectedLang) ?? ''),
                cta_button_text: @json(translateAttribute($teacherPageInfo, 'cta_button_text', $selectedLang) ?? ''),
                cta_button_url: @json($teacherPageInfo->cta_button_url ?? ''),
                cta_image: @json($teacherPageInfo->cta_image ?? ''),
                breadcrumb_home: @json(translateAttribute($teacherPageInfo, 'breadcrumb_home', $selectedLang) ?? ''),
                breadcrumb_current: @json(translateAttribute($teacherPageInfo, 'breadcrumb_current', $selectedLang) ?? ''),
                detail_breadcrumb_current: @json(translateAttribute($teacherPageInfo, 'detail_breadcrumb_current', $selectedLang) ?? ''),
            },

            defaults: {
                title: 'Eğitmenlerimiz',
                subtitle: 'EĞİTMENLER',
                cta_label: 'HEMEN BASLAYIN',
                cta_title: 'Eğitim yolculuğunuza bugün başlayın',
                cta_description: 'Uzman eğitmenlerimizle hedeflerinize ulaşın.',
                cta_button_text: 'Hemen Kaydol',
                breadcrumb_home: 'ANA SAYFA',
                breadcrumb_current: 'EĞİTMENLER',
                detail_breadcrumb_current: 'EĞİTMEN DETAY',
            },

            styleFields: [
                'title', 'subtitle', 'breadcrumb_home', 'breadcrumb_current',
                'detail_breadcrumb_current',
                'cta_label', 'cta_title', 'cta_description',
            ],

            fieldStyles: @php echo json_encode($teacherPageInfo->field_styles ?? (object)[]); @endphp,

            customDefaults: @php echo json_encode($teacherPageInfo->default_styles ?? (object)[]); @endphp,

            hardcodedDefaults: {
                title: { color: '#011c1a', fontSize: '', textAlign: '' },
                subtitle: { color: '#5f5d5d', fontSize: '', textAlign: '' },
                breadcrumb_home: { color: '#d73b3e', fontSize: '', textAlign: '' },
                breadcrumb_current: { color: '#5f5d5d', fontSize: '', textAlign: '' },
                detail_breadcrumb_current: { color: '#011c1a', fontSize: '', textAlign: '' },
                cta_label: { color: '#ffcd20', fontSize: '', textAlign: '' },
                cta_title: { color: '#ffffff', fontSize: '', textAlign: '' },
                cta_description: { color: '#ffffffcc', fontSize: '', textAlign: '' },
            },

            devSections: [
                {
                    title: 'Breadcrumb',
                    desc: 'Sayfa ust kismi — baslik ve yol gosterici',
                    color: '#d73b3e',
                    fields: [
                        { key: 'title', label: 'Sayfa Basligi', desc: 'Sayfanin buyuk basligi' },
                        { key: 'subtitle', label: 'Alt Baslik', desc: 'Breadcrumb ustu kucuk yazi' },
                        { key: 'breadcrumb_home', label: 'Ana Sayfa Linki', desc: 'Breadcrumb "Ana Sayfa" yazisi' },
                        { key: 'breadcrumb_current', label: 'Mevcut Sayfa', desc: 'Breadcrumb "Egitmenler" yazisi' },
                        { key: 'detail_breadcrumb_current', label: 'Detay Sayfasi', desc: 'Egitmen detay breadcrumb yazisi' },
                    ]
                },
                {
                    title: 'CTA',
                    desc: 'Sayfanin altindaki aksiyon cagrisi bolumu',
                    color: '#ffcd20',
                    fields: [
                        { key: 'cta_label', label: 'Etiket', desc: 'Ust kucuk yazi' },
                        { key: 'cta_title', label: 'Baslik', desc: 'Buyuk baslik' },
                        { key: 'cta_description', label: 'Aciklama', desc: 'Baslik altindaki paragraf' },
                    ]
                },
            ],

            // Developer panel helpers
            _normDef(val) {
                if (!val) return null;
                if (typeof val === 'string') return { color: val, fontSize: '', textAlign: '' };
                return val;
            },
            getDevProp(key, prop) {
                const d = this._normDef(this.customDefaults[key]);
                if (d && d[prop]) return d[prop];
                const h = this.hardcodedDefaults[key];
                return h ? h[prop] || '' : '';
            },
            setDevProp(key, prop, value) {
                const existing = this._normDef(this.customDefaults[key]) || { ...(this.hardcodedDefaults[key] || { color: '#011c1a', fontSize: '', textAlign: '' }) };
                existing[prop] = value;
                this.customDefaults = { ...this.customDefaults, [key]: { ...existing } };
            },
            resetDevField(key) {
                delete this.customDefaults[key];
                this.customDefaults = { ...this.customDefaults };
            },
            _getDefaults(field) {
                let d = this._normDef(this.customDefaults[field]);
                if (d) return d;
                return this.hardcodedDefaults[field] || { color: '#011c1a', fontSize: '', textAlign: '' };
            },

            getDefaultColor(field) { return this._getDefaults(field).color || '#011c1a'; },
            getStyleProp(prop) { const s = this.fieldStyles[this.modalField]; return s ? (s[prop] || '') : ''; },
            setStyleProp(prop, value) { if (!this.fieldStyles[this.modalField]) { this.fieldStyles[this.modalField] = {}; } this.fieldStyles[this.modalField][prop] = value; },
            resetFieldStyle() {
                const defaults = this._getDefaults(this.modalField);
                this.fieldStyles[this.modalField] = {
                    color: defaults.color || '#011c1a',
                    fontSize: defaults.fontSize || '',
                    fontFamily: '',
                    fontWeight: '',
                    fontStyle: '',
                    textAlign: defaults.textAlign || '',
                    opacity: '',
                };
            },
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

                this.fields[this.modalField] = this.modalValue;
                this.modal = false;
                this.activeField = '';
                await this.saveAll();
            },

            getMaxLength(field) {
                const limits = {
                    title: 150, subtitle: 100,
                    cta_label: 60, cta_title: 200,
                    cta_button_text: 50, breadcrumb_home: 30, breadcrumb_current: 30,
                    detail_breadcrumb_current: 50,
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
                        formData.append(key, value || '');
                    }

                    formData.append('field_styles', JSON.stringify(this.fieldStyles));
                    formData.append('default_styles', JSON.stringify(JSON.parse(JSON.stringify(this.customDefaults))));

                    const res = await fetch('{{ route('pages.update', ['id' => 'teachers']) }}', {
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

            async saveDefaults() {
                this.savingDefaults = true;
                try {
                    const payload = JSON.parse(JSON.stringify(this.customDefaults));
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('lang', '{{ $selectedLang }}');
                    formData.append('default_styles', JSON.stringify(payload));

                    const res = await fetch('{{ route('pages.update', ['id' => 'teachers']) }}', {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                        body: formData,
                    });

                    if (!res.ok) {
                        this.showToast('Sunucu hatasi: ' + res.status, 'error');
                        this.savingDefaults = false;
                        return;
                    }

                    const data = await res.json();
                    if (data.success) this.showToast('Varsayilanlar kaydedildi', 'success');
                    else this.showToast('Hata: ' + (data.message || 'Bilinmeyen'), 'error');
                } catch (e) {
                    this.showToast('Baglanti hatasi: ' + e.message, 'error');
                }
                this.savingDefaults = false;
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
