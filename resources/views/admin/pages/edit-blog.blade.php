@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Blog Sayfası</h1>
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

        /* Blog card preview */
        .blog-card-preview { border-radius: 10px; overflow: hidden; background: white; pointer-events: none; }
        .blog-card-preview .blog-card-img { width: 100%; height: 200px; object-fit: cover; display: block; }
        .blog-card-info { padding: 20px 4px 8px; }
        .blog-card-meta { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
        .blog-card-category { display: inline-block; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; padding: 5px 14px; border-radius: 40px; background: rgb(84 62 232); color: white; }
        .blog-card-date { font-size: 0.8125rem; color: rgb(95 93 93); display: inline-flex; align-items: center; gap: 4px; }
        .blog-card-title { font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.125rem; font-weight: 700; color: rgb(1 28 26); line-height: 1.4; margin-top: 12px; }

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

        /* Sidebar widget – actual frontend style */
        .sw { border-radius: 8px; background: #f5f5f5; padding: 20px 24px; }
        .sw-title {
            font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.05rem; font-weight: 700;
            color: rgb(1 28 26); margin-bottom: 18px;
        }
        .sw-search-input {
            width: 100%; border-radius: 6px; border: 1px solid #D7D7D7; padding: 10px 14px;
            font-size: 0.8125rem; color: #999; background: white; outline: none;
        }
        .sw-cat-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 7px 0; border-bottom: 1px solid #E9E5DA; font-size: 0.875rem;
        }
        .sw-cat-row:last-child { border-bottom: none; }
        .sw-cat-name { font-weight: 600; color: #4E5450; }
        .sw-cat-count { color: #999; font-size: 0.8125rem; }
        .sw-popular-row { display: flex; gap: 12px; align-items: center; margin-bottom: 12px; }
        .sw-popular-row:last-child { margin-bottom: 0; }
        .sw-popular-thumb { width: 70px; height: 56px; border-radius: 4px; background: #E8E8E8; flex-shrink: 0; overflow: hidden; }
        .sw-popular-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .sw-popular-title { font-size: 0.8125rem; font-weight: 500; color: rgb(1 28 26); line-height: 1.35; }
        .sw-popular-date { font-size: 0.75rem; color: rgb(84 62 232); margin-top: 3px; }
        .sw-tag { display: inline-block; border-radius: 50px; background: rgb(84 62 232 / 0.07); padding: 6px 16px; font-size: 0.8125rem; color: rgb(84 62 232); line-height: 1; }
        .sw-contact-row { display: flex; gap: 16px; align-items: flex-start; margin-bottom: 14px; }
        .sw-contact-row:last-child { margin-bottom: 0; }
        .sw-contact-icon {
            width: 28px; height: 28px; flex-shrink: 0; display: flex;
            align-items: center; justify-content: center;
        }
        .sw-contact-label { font-size: 0.8125rem; color: rgb(95 93 93); display: block; }
        .sw-contact-value {
            font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.05rem;
            font-weight: 700; color: rgb(1 28 26); display: block; margin-top: 2px;
        }

        /* Style controls */
        .style-section {
            margin-top: 1rem; padding-top: 1rem;
            border-top: 1px solid rgb(1 28 26 / 0.06);
        }
        .style-section-title {
            font-size: 0.75rem; font-weight: 600; text-transform: uppercase;
            letter-spacing: 0.05em; color: rgb(95 93 93); margin-bottom: 0.75rem;
            font-family: Inter, sans-serif;
        }
        .style-row {
            display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.625rem;
        }
        .style-label {
            min-width: 62px; font-size: 0.8125rem; font-weight: 500;
            color: rgb(1 28 26); font-family: Poppins, sans-serif;
        }
        .style-select {
            flex: 1; padding: 0.5rem 0.75rem; border: 2px solid rgb(1 28 26 / 0.1);
            border-radius: 8px; font-size: 0.8125rem; outline: none;
            transition: border-color 0.2s; font-family: Poppins, sans-serif;
            color: rgb(1 28 26); background: white;
            cursor: pointer; appearance: auto;
        }
        .style-select:focus { border-color: rgb(84 62 232); }
        .style-color-wrap {
            flex: 1; display: flex; align-items: center; gap: 0.5rem;
        }
        .style-color-input {
            width: 40px; height: 36px; border: 2px solid rgb(1 28 26 / 0.1);
            border-radius: 8px; cursor: pointer; padding: 2px; background: white;
        }
        .style-color-input:focus { border-color: rgb(84 62 232); outline: none; }
        .style-color-hex {
            flex: 1; padding: 0.5rem 0.75rem; border: 2px solid rgb(1 28 26 / 0.1);
            border-radius: 8px; font-size: 0.8125rem; outline: none; transition: border-color 0.2s;
            font-family: monospace; color: rgb(1 28 26); width: 90px;
        }
        .style-color-hex:focus { border-color: rgb(84 62 232); }
        .style-opacity-wrap {
            flex: 1; display: flex; align-items: center; gap: 0.5rem;
        }
        .style-opacity-range {
            flex: 1; height: 6px; -webkit-appearance: none; appearance: none;
            background: linear-gradient(to right, transparent, currentColor);
            border-radius: 3px; outline: none; cursor: pointer;
        }
        .style-opacity-range::-webkit-slider-thumb {
            -webkit-appearance: none; width: 18px; height: 18px; border-radius: 50%;
            background: white; border: 2px solid rgb(84 62 232); cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.15);
        }
        .style-opacity-range::-moz-range-thumb {
            width: 18px; height: 18px; border-radius: 50%;
            background: white; border: 2px solid rgb(84 62 232); cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.15);
        }
        .style-opacity-val {
            min-width: 44px; padding: 0.4rem 0.5rem; border: 2px solid rgb(1 28 26 / 0.1);
            border-radius: 8px; font-size: 0.8125rem; outline: none; text-align: center;
            font-family: monospace; color: rgb(1 28 26); transition: border-color 0.2s;
        }
        .style-opacity-val:focus { border-color: rgb(84 62 232); }
        .style-reset-btn {
            padding: 0.4rem 0.75rem; border-radius: 8px; font-size: 0.75rem; font-weight: 500;
            color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white;
            cursor: pointer; font-family: Poppins, sans-serif; transition: all 0.15s; white-space: nowrap;
        }
        .style-reset-btn:hover { background: #F5F5F5; }
        .style-toggle-group { display: flex; gap: 4px; flex: 1; }
        .style-toggle {
            width: 36px; height: 36px; border: 2px solid rgb(1 28 26 / 0.1);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            cursor: pointer; background: white; transition: all 0.15s; padding: 0;
        }
        .style-toggle svg { width: 16px; height: 16px; color: rgb(1 28 26); }
        .style-toggle:hover { border-color: rgb(84 62 232 / 0.3); }
        .style-toggle.active {
            background: rgb(84 62 232); border-color: rgb(84 62 232);
        }
        .style-toggle.active svg { color: white; }

        /* Dev panel */
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
    <div x-data="blogEditor()" x-cloak>

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
                <button type="button" @click="devMode = !devMode"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl border-2 transition-all duration-200 cursor-pointer"
                        :class="devMode ? 'bg-amber-500 border-amber-500 text-white' : 'bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-400 hover:border-amber-400 hover:text-amber-500'"
                        title="Developer Mode">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
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

        {{-- Developer Mode Panel --}}
        @include('admin.pages.partials.dev-panel')

        {{-- Page Tabs --}}
        <div class="mb-5">
            <div class="page-tabs" style="display: inline-flex;">
                <button type="button" class="page-tab" :class="pageTab === 'liste' && 'page-tab-active'" @click="pageTab = 'liste'">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5"/></svg>
                    Blog Listesi
                    <span class="page-tab-badge">/blog</span>
                </button>
                <button type="button" class="page-tab" :class="pageTab === 'detay' && 'page-tab-active'" @click="pageTab = 'detay'">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                    Blog Detayı
                    <span class="page-tab-badge">/blog-detay/{id}</span>
                </button>
                <button type="button" class="page-tab" :class="pageTab === 'cta' && 'page-tab-active'" @click="pageTab = 'cta'">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46"/></svg>
                    CTA
                </button>
            </div>
        </div>

        {{-- ━━━━━━━━━━━ LIVE PREVIEW ━━━━━━━━━━━ --}}
        <div class="lp" style="border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid rgba(226,232,240,0.5);">

            {{-- ═══ TAB 1: LİSTE ═══ --}}
            <div x-show="pageTab === 'liste'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

            {{-- Breadcrumb --}}
            <section style="position: relative; z-index: 10; overflow: hidden; background-color: #FAF9F6; margin: 16px 20px 0; border-radius: 12px;">
                <div style="padding: 50px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <div style="text-align: center;">
                            <div class="ez" :class="activeField === 'title' && 'ez-active'" data-label="Başlık + Stil" @click="openModal('title', 'Sayfa Başlığı', 'textarea')">
                                <h1 :style="getFieldStyle('title', 'margin-bottom: 1.25rem; text-transform: capitalize; letter-spacing: normal; font-size: 2rem;')"
                                    x-html="nl2br(fields.title || 'Blog')"></h1>
                            </div>
                            <nav style="font-size: 0.9375rem; font-weight: 500; text-transform: uppercase;">
                                <ul style="display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 4px; align-items: center;">
                                    <li>
                                        <span class="ez" :class="activeField === 'breadcrumb_home' && 'ez-active'" data-label="Düzenle" @click="openModal('breadcrumb_home', 'Breadcrumb Ana Sayfa')"
                                              :style="getFieldStyle('breadcrumb_home', 'color: rgb(215 59 62);')" x-text="fields.breadcrumb_home || 'ANA SAYFA'"></span>
                                    </li>
                                    <li style="color: rgb(95 93 93);">/</li>
                                    <li>
                                        <span class="ez" :class="activeField === 'breadcrumb_current' && 'ez-active'" data-label="Düzenle" @click="openModal('breadcrumb_current', 'Breadcrumb Mevcut')"
                                              :style="getFieldStyle('breadcrumb_current', 'color: rgb(95 93 93);')" x-text="fields.breadcrumb_current || 'BLOG'"></span>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div style="position: absolute; left: -192px; top: 0; z-index: -1; width: 371px; height: 327px; background: #BFC06F; filter: blur(250px);"></div>
                <div style="position: absolute; right: -144px; bottom: 80px; z-index: -1; width: 371px; height: 327px; background: #AAC3E9; filter: blur(200px);"></div>
            </section>

            {{-- Blog Grid (read-only) --}}
            <div style="background: white; padding: 28px 20px 36px;">
                <div style="max-width: 1200px; margin: 0 auto;">
                    @if($blogs->count() > 0)
                    <ul style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; list-style: none; padding: 0; margin: 0;">
                        @foreach($blogs as $blog)
                        <li class="blog-card-preview">
                            <div style="position: relative; overflow: hidden; border-radius: 10px;">
                                @if($blog->image)
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="blog-card-img" />
                                @else
                                    <div style="width: 100%; height: 200px; background: #F0F0F0; display: flex; align-items: center; justify-content: center;">
                                        <svg style="width: 40px; height: 40px; color: #ccc;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                                    </div>
                                @endif
                                @if($blog->categories->count())
                                <span class="blog-card-category" style="position: absolute; bottom: 10px; left: 10px;">{{ $blog->categories->first()->name }}</span>
                                @endif
                            </div>
                            <div class="blog-card-info">
                                <div class="blog-card-meta">
                                    @if($blog->published_at)
                                    <span class="blog-card-date">
                                        <svg style="width:14px;height:14px;opacity:0.5;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                                        {{ $blog->published_at->format('d M Y') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="blog-card-title">{{ $blog->getTranslation('title', app()->getLocale()) }}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div style="text-align: center; margin-top: 1.25rem;">
                        <span style="font-size: 0.75rem; color: #B0B0B0; font-family: Inter, sans-serif; font-style: italic;">Blog kartları önizleme amaçlıdır — içerik Blog Yönetimi'nden düzenlenir</span>
                    </div>
                    @else
                    <div style="text-align: center; padding: 3rem 0; color: #8D8D8D; font-size: 0.875rem;">
                        Henüz blog yazısı eklenmemiş.
                        <a href="{{ route('blogs.index') }}" style="color: rgb(84 62 232); text-decoration: underline; margin-left: 4px;">Blog Yönetimi'ne git</a>
                    </div>
                    @endif
                </div>
            </div>

            </div>

            {{-- ═══ TAB 2: DETAY ═══ --}}
            <div x-show="pageTab === 'detay'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

            {{-- Detail Breadcrumb --}}
            <section style="position: relative; z-index: 10; overflow: hidden; background-color: #FAF9F6; margin: 16px 20px 0; border-radius: 12px;">
                <div style="padding: 40px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <div style="text-align: center;">
                            <div class="ez" :class="activeField === 'detail_breadcrumb_current' && 'ez-active'" data-label="Başlık + Stil" @click="openModal('detail_breadcrumb_current', 'Detay Sayfa Başlığı', 'textarea')">
                                <h1 :style="getFieldStyle('detail_breadcrumb_current', 'margin-bottom: 1rem; text-transform: capitalize; letter-spacing: normal; font-size: 2rem;')"
                                    x-html="nl2br(fields.detail_breadcrumb_current || 'Blog Detayı')"></h1>
                            </div>
                            <nav style="font-size: 0.9375rem; font-weight: 500; text-transform: uppercase;">
                                <ul style="display: flex; justify-content: center; list-style: none; padding: 0; margin: 0; gap: 4px; align-items: center;">
                                    <li>
                                        <span class="ez" :class="activeField === 'breadcrumb_home' && 'ez-active'" data-label="Düzenle" @click="openModal('breadcrumb_home', 'Breadcrumb Ana Sayfa')"
                                              :style="getFieldStyle('breadcrumb_home', 'color: rgb(215 59 62);')" x-text="fields.breadcrumb_home || 'ANA SAYFA'"></span>
                                    </li>
                                    <li style="color: rgb(95 93 93);">/</li>
                                    <li>
                                        <span class="ez" :class="activeField === 'breadcrumb_current' && 'ez-active'" data-label="Düzenle" @click="openModal('breadcrumb_current', 'Breadcrumb Mevcut')"
                                              :style="getFieldStyle('breadcrumb_current', 'color: rgb(215 59 62);')" x-text="fields.breadcrumb_current || 'BLOG'"></span>
                                    </li>
                                    <li style="color: rgb(95 93 93);">/</li>
                                    <li style="color: rgb(95 93 93);">Blog Yazı Başlığı...</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div style="position: absolute; left: -192px; top: 0; z-index: -1; width: 371px; height: 327px; background: #BFC06F; filter: blur(250px);"></div>
                <div style="position: absolute; right: -144px; bottom: 80px; z-index: -1; width: 371px; height: 327px; background: #AAC3E9; filter: blur(200px);"></div>
            </section>

            {{-- Blog Detail: Content + Sidebar (2-column like actual page) --}}
            <div style="background: white; padding: 32px 20px 40px;">
                <div style="max-width: 1200px; margin: 0 auto;">
                    <div style="display: grid; grid-template-columns: 1fr minmax(0, 340px); gap: 30px;">

                        {{-- LEFT: Blog content preview (read-only from DB) --}}
                        <div>
                            @if($blogs->count() > 0)
                                @php $previewBlog = $blogs->first(); @endphp
                                @if($previewBlog->image)
                                <div style="width: 100%; height: 260px; border-radius: 10px; overflow: hidden;">
                                    <img src="{{ asset($previewBlog->image) }}" alt="{{ $previewBlog->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                                </div>
                                @else
                                <div style="width: 100%; height: 220px; border-radius: 10px; background: linear-gradient(135deg, #F0F0F0 0%, #E8E8E8 100%); display: flex; align-items: center; justify-content: center;">
                                    <div style="text-align: center; color: #BBB;">
                                        <svg style="width: 40px; height: 40px; margin: 0 auto 8px;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                                        <span style="font-size: 0.8125rem; font-family: Inter, sans-serif;">Blog Görseli</span>
                                    </div>
                                </div>
                                @endif
                                <div style="margin-top: 28px;">
                                    <h2 style="font-size: 1.5rem; line-height: 1.35; margin-bottom: 16px;">{{ $previewBlog->getTranslation('title', app()->getLocale()) }}</h2>
                                    <div style="display: flex; gap: 16px; margin-bottom: 20px;">
                                        @if($previewBlog->published_at)
                                        <div style="display: flex; align-items: center; gap: 4px; color: #999; font-size: 0.8125rem;">
                                            <svg style="width:14px;height:14px;opacity:0.5;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                                            {{ $previewBlog->published_at->format('d M Y') }}
                                        </div>
                                        @endif
                                        @if($previewBlog->categories->count())
                                        <div style="color: rgb(84 62 232); font-size: 0.8125rem; font-weight: 500;">{{ $previewBlog->categories->pluck('name')->join(', ') }}</div>
                                        @endif
                                    </div>
                                    @if($previewBlog->getTranslation('short_description', app()->getLocale()))
                                    <p style="color: rgb(95 93 93); font-size: 0.9375rem; line-height: 1.75; margin-bottom: 16px;">{{ Str::limit($previewBlog->getTranslation('short_description', app()->getLocale()), 200) }}</p>
                                    @endif
                                    <div style="display: flex; flex-direction: column; gap: 10px;">
                                        <div style="width: 100%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                                        <div style="width: 95%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                                        <div style="width: 88%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                                        <div style="width: 100%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                                        <div style="width: 60%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                                    </div>
                                </div>
                            @else
                                <div style="width: 100%; height: 220px; border-radius: 10px; background: linear-gradient(135deg, #F0F0F0 0%, #E8E8E8 100%); display: flex; align-items: center; justify-content: center;">
                                    <div style="text-align: center; color: #BBB;">
                                        <svg style="width: 40px; height: 40px; margin: 0 auto 8px;" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                                        <span style="font-size: 0.8125rem; font-family: Inter, sans-serif;">Blog Görseli</span>
                                    </div>
                                </div>
                                <div style="margin-top: 28px;">
                                    <div style="width: 70%; height: 20px; border-radius: 4px; background: #E8E8E8; margin-bottom: 16px;"></div>
                                    <div style="display: flex; flex-direction: column; gap: 10px;">
                                        <div style="width: 100%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                                        <div style="width: 95%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                                        <div style="width: 88%; height: 10px; border-radius: 3px; background: #F0F0F0;"></div>
                                    </div>
                                </div>
                            @endif
                            <div style="margin-top: 20px; text-align: center;">
                                <span style="font-size: 0.75rem; color: #B0B0B0; font-family: Inter, sans-serif; font-style: italic;">Blog içeriği önizleme amaçlıdır — içerik Blog Yönetimi'nden düzenlenir</span>
                            </div>
                        </div>

                        {{-- RIGHT: Editable sidebar widgets (mirrors actual frontend) --}}
                        <aside>
                            <div style="display: flex; flex-direction: column; gap: 20px;">

                                {{-- Search Widget --}}
                                <div class="sw">
                                    <div class="ez" :class="activeField === 'sidebar_search_title' && 'ez-active'" data-label="Başlığı Düzenle" @click="openModal('sidebar_search_title', 'Arama Başlığı')">
                                        <h5 class="sw-title" :style="getFieldStyle('sidebar_search_title')" x-text="fields.sidebar_search_title || 'Ara'"></h5>
                                    </div>
                                    <div class="ez" :class="activeField === 'sidebar_search_placeholder' && 'ez-active'" data-label="Placeholder Düzenle" @click="openModal('sidebar_search_placeholder', 'Arama Placeholder')">
                                        <input type="text" class="sw-search-input" :placeholder="fields.sidebar_search_placeholder || 'Ara...'" disabled style="pointer-events: none;" />
                                    </div>
                                </div>

                                {{-- Categories Widget --}}
                                <div class="sw">
                                    <div class="ez" :class="activeField === 'sidebar_categories_title' && 'ez-active'" data-label="Başlığı Düzenle" @click="openModal('sidebar_categories_title', 'Kategoriler Başlığı')">
                                        <h5 class="sw-title" :style="getFieldStyle('sidebar_categories_title')" x-text="fields.sidebar_categories_title || 'Kategoriler'"></h5>
                                    </div>
                                    <div>
                                        @if($categories->count() > 0)
                                            @foreach($categories->take(4) as $cat)
                                            <div class="sw-cat-row"><span class="sw-cat-name">{{ $cat->name }}</span><span class="sw-cat-count">{{ $cat->blogs_count }}</span></div>
                                            @endforeach
                                        @else
                                            <div class="sw-cat-row"><span class="sw-cat-name" style="color: #BBB;">Kategori eklenince görünecek</span></div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Popular Posts Widget --}}
                                <div class="sw">
                                    <div class="ez" :class="activeField === 'sidebar_popular_title' && 'ez-active'" data-label="Başlığı Düzenle" @click="openModal('sidebar_popular_title', 'Popüler Yazılar Başlığı')">
                                        <h5 class="sw-title" :style="getFieldStyle('sidebar_popular_title')" x-text="fields.sidebar_popular_title || 'Popüler Yazılar'"></h5>
                                    </div>
                                    @foreach($blogs->take(2) as $preview)
                                    <div class="sw-popular-row">
                                        <div class="sw-popular-thumb">
                                            @if($preview->image)
                                            <img src="{{ asset($preview->image) }}" alt="" />
                                            @endif
                                        </div>
                                        <div>
                                            <div class="sw-popular-title">{{ Str::limit($preview->getTranslation('title', app()->getLocale()), 40) }}</div>
                                            @if($preview->published_at)
                                            <div class="sw-popular-date">{{ $preview->published_at->format('d M Y') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($blogs->count() === 0)
                                    <div class="sw-popular-row">
                                        <div class="sw-popular-thumb"></div>
                                        <div><div class="sw-popular-title" style="color: #BBB;">Blog eklenince görünecek</div></div>
                                    </div>
                                    @endif
                                </div>

                                {{-- Contact Widget --}}
                                <div class="sw">
                                    <div class="ez" :class="activeField === 'sidebar_contact_title' && 'ez-active'" data-label="Başlığı Düzenle" @click="openModal('sidebar_contact_title', 'İletişim Başlığı')">
                                        <h5 class="sw-title" :style="getFieldStyle('sidebar_contact_title')" x-text="fields.sidebar_contact_title || 'İletişim'"></h5>
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 14px;">
                                        {{-- Phone --}}
                                        <div class="sw-contact-row">
                                            <div class="sw-contact-icon">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-phone-ring.svg') }}" alt="phone" width="28" height="28" />
                                            </div>
                                            <div style="flex: 1;">
                                                <div class="ez" :class="activeField === 'sidebar_contact_phone_label' && 'ez-active'" data-label="Düzenle" @click="openModal('sidebar_contact_phone_label', 'Telefon Etiketi')">
                                                    <span class="sw-contact-label" :style="getFieldStyle('sidebar_contact_phone_label')" x-text="fields.sidebar_contact_phone_label || '7/24 Destek'"></span>
                                                </div>
                                                <div class="ez" :class="activeField === 'sidebar_contact_phone' && 'ez-active'" data-label="Düzenle" @click="openModal('sidebar_contact_phone', 'Telefon Numarası')">
                                                    <span class="sw-contact-value" :style="getFieldStyle('sidebar_contact_phone')" x-text="fields.sidebar_contact_phone || '+90 555 123 4567'"></span>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Email --}}
                                        <div class="sw-contact-row">
                                            <div class="sw-contact-icon">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-mail-open.svg') }}" alt="email" width="28" height="28" />
                                            </div>
                                            <div style="flex: 1;">
                                                <div class="ez" :class="activeField === 'sidebar_contact_email_label' && 'ez-active'" data-label="Düzenle" @click="openModal('sidebar_contact_email_label', 'E-posta Etiketi')">
                                                    <span class="sw-contact-label" :style="getFieldStyle('sidebar_contact_email_label')" x-text="fields.sidebar_contact_email_label || 'Mesaj Gönderin'"></span>
                                                </div>
                                                <div class="ez" :class="activeField === 'sidebar_contact_email' && 'ez-active'" data-label="Düzenle" @click="openModal('sidebar_contact_email', 'E-posta Adresi')">
                                                    <span class="sw-contact-value" :style="getFieldStyle('sidebar_contact_email')" x-text="fields.sidebar_contact_email || 'info@example.com'"></span>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Address --}}
                                        <div class="sw-contact-row">
                                            <div class="sw-contact-icon">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-location.svg') }}" alt="location" width="28" height="28" />
                                            </div>
                                            <div style="flex: 1;">
                                                <div class="ez" :class="activeField === 'sidebar_contact_address_label' && 'ez-active'" data-label="Düzenle" @click="openModal('sidebar_contact_address_label', 'Adres Etiketi')">
                                                    <span class="sw-contact-label" :style="getFieldStyle('sidebar_contact_address_label')" x-text="fields.sidebar_contact_address_label || 'Adresimiz'"></span>
                                                </div>
                                                <div class="ez" :class="activeField === 'sidebar_contact_address' && 'ez-active'" data-label="Düzenle" @click="openModal('sidebar_contact_address', 'Adres', 'textarea')">
                                                    <span class="sw-contact-value" style="font-size: 0.95rem;" :style="getFieldStyle('sidebar_contact_address')" x-html="nl2br(fields.sidebar_contact_address || 'İstanbul, Türkiye')"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tags Widget --}}
                                <div class="sw">
                                    <div class="ez" :class="activeField === 'sidebar_tags_title' && 'ez-active'" data-label="Başlığı Düzenle" @click="openModal('sidebar_tags_title', 'Etiketler Başlığı')">
                                        <h5 class="sw-title" :style="getFieldStyle('sidebar_tags_title')" x-text="fields.sidebar_tags_title || 'Etiketler'"></h5>
                                    </div>
                                    <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                        @if($tags->count() > 0)
                                            @foreach($tags->take(6) as $tag)
                                            <span class="sw-tag">{{ $tag->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="sw-tag" style="opacity: 0.4;">Etiket eklenince görünecek</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </aside>

                    </div>
                </div>
            </div>

            </div>

            {{-- ═══ TAB 3: CTA ═══ --}}
            <div x-show="pageTab === 'cta'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

            <div style="padding: 16px 20px 20px; background: white;">
                <div style="position: relative; z-index: 10; overflow: hidden; background: rgb(84 62 232); border-radius: 16px; display: grid; grid-template-columns: 0.8fr 1fr; gap: 56px;">
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
                                          x-text="fields.cta_button_url || '/blog'"></span>
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
    function blogEditor() {
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
            pageTab: 'liste',
            validationError: '',
            modalMaxLength: 0,

            fields: {
                title: @json(translateAttribute($blogPageInfo, 'title', $selectedLang) ?? ''),
                breadcrumb_home: @json(translateAttribute($blogPageInfo, 'breadcrumb_home', $selectedLang) ?? ''),
                breadcrumb_current: @json(translateAttribute($blogPageInfo, 'breadcrumb_current', $selectedLang) ?? ''),
                detail_breadcrumb_current: @json(translateAttribute($blogPageInfo, 'detail_breadcrumb_current', $selectedLang) ?? ''),
                sidebar_search_title: @json(translateAttribute($blogPageInfo, 'sidebar_search_title', $selectedLang) ?? ''),
                sidebar_search_placeholder: @json(translateAttribute($blogPageInfo, 'sidebar_search_placeholder', $selectedLang) ?? ''),
                sidebar_categories_title: @json(translateAttribute($blogPageInfo, 'sidebar_categories_title', $selectedLang) ?? ''),
                sidebar_popular_title: @json(translateAttribute($blogPageInfo, 'sidebar_popular_title', $selectedLang) ?? ''),
                sidebar_contact_title: @json(translateAttribute($blogPageInfo, 'sidebar_contact_title', $selectedLang) ?? ''),
                sidebar_tags_title: @json(translateAttribute($blogPageInfo, 'sidebar_tags_title', $selectedLang) ?? ''),
                sidebar_contact_phone_label: @json(translateAttribute($blogPageInfo, 'sidebar_contact_phone_label', $selectedLang) ?? ''),
                sidebar_contact_phone: @json(translateAttribute($blogPageInfo, 'sidebar_contact_phone', $selectedLang) ?? ''),
                sidebar_contact_email_label: @json(translateAttribute($blogPageInfo, 'sidebar_contact_email_label', $selectedLang) ?? ''),
                sidebar_contact_email: @json(translateAttribute($blogPageInfo, 'sidebar_contact_email', $selectedLang) ?? ''),
                sidebar_contact_address_label: @json(translateAttribute($blogPageInfo, 'sidebar_contact_address_label', $selectedLang) ?? ''),
                sidebar_contact_address: @json(translateAttribute($blogPageInfo, 'sidebar_contact_address', $selectedLang) ?? ''),
                cta_label: @json(translateAttribute($blogPageInfo, 'cta_label', $selectedLang) ?? ''),
                cta_title: @json(translateAttribute($blogPageInfo, 'cta_title', $selectedLang) ?? ''),
                cta_description: @json(translateAttribute($blogPageInfo, 'cta_description', $selectedLang) ?? ''),
                cta_button_text: @json(translateAttribute($blogPageInfo, 'cta_button_text', $selectedLang) ?? ''),
                cta_button_url: @json($blogPageInfo->cta_button_url ?? ''),
                cta_image: @json($blogPageInfo->cta_image ?? ''),
            },

            defaults: {
                title: 'Blog',
                breadcrumb_home: 'ANA SAYFA',
                breadcrumb_current: 'BLOG',
                detail_breadcrumb_current: 'BLOG DETAY',
                sidebar_search_title: 'Search Here',
                sidebar_search_placeholder: 'Ara...',
                sidebar_categories_title: 'Categories',
                sidebar_popular_title: 'Popular News',
                sidebar_contact_title: 'Contact Us',
                sidebar_tags_title: 'Popular Tags',
                sidebar_contact_phone_label: 'Telefon',
                sidebar_contact_phone: '+90 555 123 4567',
                sidebar_contact_email_label: 'E-posta',
                sidebar_contact_email: 'info@example.com',
                sidebar_contact_address_label: 'Adres',
                sidebar_contact_address: 'İstanbul, Türkiye',
                cta_label: 'HEMEN BASLAYIN',
                cta_title: 'Eğitim yolculuğunuza bugün başlayın',
                cta_description: 'Uzman eğitmenlerimizle hedeflerinize ulaşın.',
                cta_button_text: 'Hemen Kaydol',
            },

            styleFields: [
                'title', 'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
                'sidebar_search_title', 'sidebar_categories_title',
                'sidebar_popular_title', 'sidebar_contact_title', 'sidebar_tags_title',
                'sidebar_contact_phone_label', 'sidebar_contact_phone',
                'sidebar_contact_email_label', 'sidebar_contact_email',
                'sidebar_contact_address_label', 'sidebar_contact_address',
                'cta_label', 'cta_title', 'cta_description',
            ],

            fieldStyles: @php echo json_encode($blogPageInfo->field_styles ?? (object)[]); @endphp,

            customDefaults: @php echo json_encode($blogPageInfo->default_styles ?? (object)[]); @endphp,

            hardcodedDefaults: {
                title:                       { color: '#011c1a', fontSize: '', textAlign: '' },
                breadcrumb_home:             { color: '#d73b3e', fontSize: '', textAlign: '' },
                breadcrumb_current:          { color: '#5f5d5d', fontSize: '', textAlign: '' },
                detail_breadcrumb_current:   { color: '#011c1a', fontSize: '', textAlign: '' },
                sidebar_search_title:        { color: '#011c1a', fontSize: '', textAlign: '' },
                sidebar_categories_title:    { color: '#011c1a', fontSize: '', textAlign: '' },
                sidebar_popular_title:       { color: '#011c1a', fontSize: '', textAlign: '' },
                sidebar_contact_title:       { color: '#011c1a', fontSize: '', textAlign: '' },
                sidebar_tags_title:          { color: '#011c1a', fontSize: '', textAlign: '' },
                sidebar_contact_phone_label: { color: '#5f5d5d', fontSize: '', textAlign: '' },
                sidebar_contact_phone:       { color: '#011c1a', fontSize: '', textAlign: '' },
                sidebar_contact_email_label: { color: '#5f5d5d', fontSize: '', textAlign: '' },
                sidebar_contact_email:       { color: '#011c1a', fontSize: '', textAlign: '' },
                sidebar_contact_address_label: { color: '#5f5d5d', fontSize: '', textAlign: '' },
                sidebar_contact_address:     { color: '#011c1a', fontSize: '', textAlign: '' },
                cta_label:                   { color: '#ffcd20', fontSize: '', textAlign: '' },
                cta_title:                   { color: '#ffffff', fontSize: '', textAlign: '' },
                cta_description:             { color: '#ffffffcc', fontSize: '', textAlign: '' },
            },

            devSections: [
                {
                    title: 'Breadcrumb',
                    desc: 'Sayfa basligi & breadcrumb alanlari',
                    color: '#6366F1',
                    fields: [
                        { key: 'title', label: 'Sayfa Basligi', desc: 'Blog sayfasi buyuk baslik' },
                        { key: 'breadcrumb_home', label: 'Ana Sayfa Linki', desc: 'Breadcrumb "Ana Sayfa" yazisi' },
                        { key: 'breadcrumb_current', label: 'Mevcut Sayfa', desc: 'Breadcrumb "Blog" yazisi' },
                        { key: 'detail_breadcrumb_current', label: 'Detay Sayfasi', desc: 'Breadcrumb "Blog Detay" yazisi' },
                    ],
                },
                {
                    title: 'Sidebar',
                    desc: 'Sidebar widget basliklari',
                    color: '#8B5CF6',
                    fields: [
                        { key: 'sidebar_search_title', label: 'Arama Basligi', desc: 'Sidebar arama widget basligi' },
                        { key: 'sidebar_categories_title', label: 'Kategoriler Basligi', desc: 'Sidebar kategoriler widget basligi' },
                        { key: 'sidebar_popular_title', label: 'Populer Basligi', desc: 'Sidebar populer yazilar widget basligi' },
                        { key: 'sidebar_contact_title', label: 'Iletisim Basligi', desc: 'Sidebar iletisim widget basligi' },
                        { key: 'sidebar_tags_title', label: 'Etiketler Basligi', desc: 'Sidebar etiketler widget basligi' },
                    ],
                },
                {
                    title: 'Sidebar Iletisim',
                    desc: 'Sidebar iletisim bilgileri',
                    color: '#EC4899',
                    fields: [
                        { key: 'sidebar_contact_phone_label', label: 'Telefon Etiketi', desc: 'Telefon ust yazi' },
                        { key: 'sidebar_contact_phone', label: 'Telefon Degeri', desc: 'Telefon numarasi' },
                        { key: 'sidebar_contact_email_label', label: 'E-posta Etiketi', desc: 'E-posta ust yazi' },
                        { key: 'sidebar_contact_email', label: 'E-posta Degeri', desc: 'E-posta adresi' },
                        { key: 'sidebar_contact_address_label', label: 'Adres Etiketi', desc: 'Adres ust yazi' },
                        { key: 'sidebar_contact_address', label: 'Adres Degeri', desc: 'Adres bilgisi' },
                    ],
                },
                {
                    title: 'CTA',
                    desc: 'Call-to-Action bolumu',
                    color: '#F59E0B',
                    fields: [
                        { key: 'cta_label', label: 'CTA Etiketi', desc: 'Ust kucuk yazi' },
                        { key: 'cta_title', label: 'CTA Basligi', desc: 'Buyuk baslik' },
                        { key: 'cta_description', label: 'CTA Aciklama', desc: 'Alt aciklama metni' },
                    ],
                },
            ],

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

            getDefaultColor(field) {
                return this._getDefaults(field).color || '#011c1a';
            },

            getStyleProp(prop) {
                const s = this.fieldStyles[this.modalField];
                return s ? (s[prop] || '') : '';
            },

            setStyleProp(prop, value) {
                if (!this.fieldStyles[this.modalField]) {
                    this.fieldStyles[this.modalField] = {};
                }
                this.fieldStyles[this.modalField][prop] = value;
            },

            resetFieldStyle() {
                const defaults = this._getDefaults(this.modalField);
                this.fieldStyles[this.modalField] = {
                    color: defaults.color || '#011c1a',
                    fontSize: defaults.fontSize || '',
                    fontFamily: '', fontWeight: '', fontStyle: '',
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

            nl2br(str) {
                return String(str).replace(/\n/g, '<br>');
            },

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
                    title: 150,
                    breadcrumb_home: 30, breadcrumb_current: 30,
                    detail_breadcrumb_current: 50,
                    sidebar_search_title: 80, sidebar_search_placeholder: 80,
                    sidebar_categories_title: 80,
                    sidebar_popular_title: 80, sidebar_contact_title: 80,
                    sidebar_tags_title: 80,
                    sidebar_contact_phone_label: 50, sidebar_contact_phone: 50,
                    sidebar_contact_email_label: 50, sidebar_contact_email: 100,
                    sidebar_contact_address_label: 50, sidebar_contact_address: 255,
                    cta_label: 60, cta_title: 200,
                    cta_button_text: 50,
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

                    // Field styles
                    formData.append('field_styles', JSON.stringify(this.fieldStyles));
                    formData.append('default_styles', JSON.stringify(JSON.parse(JSON.stringify(this.customDefaults))));

                    const res = await fetch('{{ route('pages.update', ['id' => 'blog']) }}', {
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

                    const res = await fetch('{{ route('pages.update', ['id' => 'blog']) }}', {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                        body: formData,
                    });
                    const data = await res.json();
                    if (data.success) {
                        this.showToast('Varsayilanlar kaydedildi', 'success');
                    } else {
                        this.showToast('Hata olustu', 'error');
                    }
                } catch (e) {
                    this.showToast('Baglanti hatasi', 'error');
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
