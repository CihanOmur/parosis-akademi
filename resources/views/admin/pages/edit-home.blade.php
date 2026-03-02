@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Ana Sayfa</h1>
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

        /* Style controls */
        .style-section { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgb(1 28 26 / 0.08); }
        .style-section-title { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: rgb(84 62 232); margin-bottom: 0.75rem; font-family: Inter, sans-serif; display: flex; align-items: center; gap: 6px; }
        .style-row { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.625rem; }
        .style-label { font-size: 0.8125rem; font-weight: 500; color: rgb(95 93 93); font-family: Poppins, sans-serif; min-width: 55px; flex-shrink: 0; }
        .style-select { flex: 1; padding: 0.5rem 0.75rem; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 8px; font-size: 0.875rem; outline: none; transition: border-color 0.2s; font-family: Poppins, sans-serif; color: rgb(1 28 26); background: white; cursor: pointer; appearance: auto; }
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
        .style-opacity-val { width: 52px; text-align: center; padding: 0.4rem; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 8px; font-size: 0.8125rem; font-family: monospace; outline: none; }
        .style-toggle-group { display: flex; gap: 4px; }
        .style-toggle { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border: 2px solid rgb(1 28 26 / 0.1); border-radius: 8px; background: white; cursor: pointer; transition: all 0.15s; outline: none; padding: 0; }
        .style-toggle svg { width: 16px; height: 16px; }
        .style-toggle:hover { border-color: rgb(84 62 232 / 0.4); }
        .style-toggle.active { border-color: rgb(84 62 232); background: rgb(84 62 232 / 0.08); color: rgb(84 62 232); }
        .style-reset-btn { padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.75rem; font-weight: 500; color: rgb(95 93 93); border: 1px solid rgb(1 28 26 / 0.1); background: white; cursor: pointer; font-family: Poppins, sans-serif; transition: all 0.15s; }
        .style-reset-btn:hover { background: #F5F5F5; }

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
    <div x-data="homeEditor()" x-cloak>

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
                <button type="button" @click="saveAll()" :disabled="saving"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-fuchsia-500 to-purple-500 hover:from-fuchsia-600 hover:to-purple-600 text-white font-semibold rounded-xl text-sm shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg x-show="!saving" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                    <svg x-show="saving" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                    Kaydet
                </button>
            </div>
        </div>

        {{-- Developer Mode Panel --}}
        <div x-show="devMode" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
             style="margin-bottom: 1.25rem; background: #fff; border-radius: 14px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #E5E7EB; overflow: hidden;">

            {{-- Header --}}
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 14px 20px; background: #F9FAFB; border-bottom: 1px solid #E5E7EB;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <svg style="width: 18px; height: 18px; color: #6B7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                    <div>
                        <span style="font-size: 0.9375rem; font-weight: 600; color: #1F2937;">Varsayilan Stiller</span>
                        <span style="font-size: 0.8125rem; color: #9CA3AF; margin-left: 8px;">"Varsayilana Sifirla" degerlerini ayarlayin</span>
                    </div>
                </div>
                <button type="button" @click="saveDefaults()" :disabled="savingDefaults"
                        class="dev-save-btn">
                    <svg x-show="!savingDefaults" style="width: 15px; height: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                    <svg x-show="savingDefaults" style="width: 15px; height: 15px;" class="animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                    Kaydet
                </button>
            </div>

            {{-- Table Header --}}
            <div style="display: grid; grid-template-columns: 220px 1fr 110px 140px 40px; gap: 0; padding: 8px 20px; background: #F9FAFB; border-bottom: 1px solid #E5E7EB; font-size: 0.75rem; font-weight: 600; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.05em;">
                <span>Alan</span>
                <span>Renk</span>
                <span>Boyut</span>
                <span>Hizalama</span>
                <span></span>
            </div>

            {{-- Sections --}}
            <div style="padding: 0;">
                <template x-for="section in devSections" :key="section.title">
                    <div>
                        {{-- Section Header --}}
                        <div style="display: flex; align-items: center; gap: 10px; padding: 10px 20px; background: #F3F4F6; border-bottom: 1px solid #E5E7EB;">
                            <div :style="'width: 4px; height: 16px; border-radius: 2px; background:' + section.color"></div>
                            <span x-text="section.title" style="font-size: 0.8125rem; font-weight: 700; color: #4B5563; text-transform: uppercase; letter-spacing: 0.04em;"></span>
                            <span x-text="section.desc" style="font-size: 0.75rem; color: #9CA3AF; font-weight: 400;"></span>
                        </div>
                        {{-- Field Rows --}}
                        <template x-for="field in section.fields" :key="field.key">
                            <div :class="customDefaults[field.key] ? 'dev-row dev-row-modified' : 'dev-row'">
                                {{-- Label --}}
                                <div>
                                    <div x-text="field.label" style="font-size: 0.875rem; font-weight: 500; color: #1F2937; line-height: 1.2;"></div>
                                    <div x-text="field.desc" x-show="field.desc" style="font-size: 0.6875rem; color: #9CA3AF; line-height: 1.3; margin-top: 1px;"></div>
                                </div>
                                {{-- Color --}}
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <input type="color"
                                           :value="getDevProp(field.key, 'color') || '#011c1a'"
                                           @input="setDevProp(field.key, 'color', $event.target.value)"
                                           class="dev-color-input" />
                                    <input type="text"
                                           :value="getDevProp(field.key, 'color') || '#011c1a'"
                                           @change="setDevProp(field.key, 'color', $event.target.value)"
                                           maxlength="22"
                                           class="dev-text-input" />
                                </div>
                                {{-- Size --}}
                                <select :value="getDevProp(field.key, 'fontSize') || ''"
                                        @change="setDevProp(field.key, 'fontSize', $event.target.value)"
                                        class="dev-select">
                                    <option value="">—</option>
                                    <option value="0.75rem">12px</option>
                                    <option value="0.875rem">14px</option>
                                    <option value="1rem">16px</option>
                                    <option value="1.125rem">18px</option>
                                    <option value="1.25rem">20px</option>
                                    <option value="1.5rem">24px</option>
                                    <option value="1.875rem">30px</option>
                                    <option value="2rem">32px</option>
                                    <option value="2.25rem">36px</option>
                                    <option value="2.5rem">40px</option>
                                    <option value="3rem">48px</option>
                                </select>
                                {{-- Align --}}
                                <div style="display: flex; gap: 6px; width: fit-content;">
                                    <button type="button" @click="setDevProp(field.key, 'textAlign', 'left')"
                                            :class="'dev-align-btn' + (getDevProp(field.key, 'textAlign') === 'left' ? ' active' : '')">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" d="M3 6h18M3 12h12M3 18h15"/></svg>
                                    </button>
                                    <button type="button" @click="setDevProp(field.key, 'textAlign', 'center')"
                                            :class="'dev-align-btn' + (getDevProp(field.key, 'textAlign') === 'center' ? ' active' : '')">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" d="M3 6h18M6 12h12M4.5 18h15"/></svg>
                                    </button>
                                    <button type="button" @click="setDevProp(field.key, 'textAlign', 'right')"
                                            :class="'dev-align-btn' + (getDevProp(field.key, 'textAlign') === 'right' ? ' active' : '')">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" d="M3 6h18M9 12h12M6 18h15"/></svg>
                                    </button>
                                </div>
                                {{-- Reset --}}
                                <div style="text-align: center;">
                                    <button type="button" @click="resetDevField(field.key)"
                                            x-show="customDefaults[field.key]"
                                            class="dev-reset-btn"
                                            title="Orijinal varsayilana don">&#x2715;</button>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>

        {{-- ═════════════ LIVE PREVIEW ═════════════ --}}
        <div class="lp" style="border-radius: 16px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid rgba(226,232,240,0.5); margin-left: -2rem; margin-right: -2rem;">

            {{-- ── Slider (bilgi notu) ── --}}
            <div style="background: #FAF9F6; padding: 40px 0;">
                <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem; text-align: center;">
                    <div style="background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%); border-radius: 16px; padding: 40px; color: white;">
                        <svg style="width: 48px; height: 48px; margin: 0 auto 12px; opacity: 0.6;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                        <p style="font-size: 1.125rem; font-weight: 600; margin: 0;">Hero Slider</p>
                        <p style="font-size: 0.8125rem; opacity: 0.7; margin: 6px 0 0;">Slider yonetimi ayri sayfadan yapilir</p>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Hos Geldiniz</span></div></div>

            {{-- ── Welcome Section ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 70px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                                {{-- Left: Image + Stat --}}
                                <div style="position: relative; z-index: 10;">
                                    <div class="ez ez-img" :class="activeField === 'welcome_image' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('welcome_image', 'Welcome Resmi', 'image')" style="display: inline-block;">
                                        <img :src="fields.welcome_image ? (fields.welcome_image.startsWith('http') ? fields.welcome_image : baseUrl + '/' + fields.welcome_image) : '{{ asset('assets-front/img/images/th-1/welcome-img.png') }}'" alt="" width="482" height="486" style="max-width: 100%; display: block;" />
                                    </div>
                                    <div style="position: absolute; bottom: 60px; left: 40px; z-index: 10; display: inline-flex; align-items: center; gap: 1.25rem; background: white; padding: 1rem 2rem 1rem 1rem; border-radius: 8px; box-shadow: 17px 18px 30px 16px rgba(7,2,41,0.1);">
                                        <div style="display: inline-flex; width: 64px; height: 64px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(223,67,67,0.05);">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="" width="28" height="28" />
                                        </div>
                                        <div>
                                            <div class="ez" :class="activeField === 'welcome_stat_number' && 'ez-active'" data-label="Duzenle" @click="openModal('welcome_stat_number', 'Sayac Numarasi')">
                                                <span :style="getFieldStyle('welcome_stat_number')" x-html="nl2br((fields.welcome_stat_number || '9394') + '+')" style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.75rem; font-weight: 700; line-height: 1.73; color: #DF4343;"></span>
                                            </div>
                                            <div class="ez" :class="activeField === 'welcome_stat_text' && 'ez-active'" data-label="Duzenle" @click="openModal('welcome_stat_text', 'Sayac Metni')">
                                                <span :style="getFieldStyle('welcome_stat_text')" x-html="nl2br(fields.welcome_stat_text || 'Enrolled Learners')" style="color: rgb(95 93 93);"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Right: Text --}}
                                <div>
                                    <div style="margin-bottom: 1.5rem;">
                                        <div class="ez" :class="activeField === 'welcome_label' && 'ez-active'" data-label="Duzenle" @click="openModal('welcome_label', 'Ust Etiket')" style="margin-bottom: 1.25rem;">
                                            <span :style="getFieldStyle('welcome_label')" x-html="nl2br(fields.welcome_label || 'WELCOME TO PAROSIS')" style="display: block; text-transform: uppercase; font-size: 1rem; color: #84994F;"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'welcome_title' && 'ez-active'" data-label="Duzenle" @click="openModal('welcome_title', 'Baslik')">
                                            <h2 :style="getFieldStyle('welcome_title')" x-html="nl2br(fields.welcome_title || 'Digital Online Academy: Your Path to Creative Excellence')"></h2>
                                        </div>
                                    </div>
                                    <div class="ez" :class="activeField === 'welcome_description' && 'ez-active'" data-label="Duzenle" @click="openModal('welcome_description', 'Aciklama', 'textarea')" style="margin-top: 1.75rem;">
                                        <p :style="getFieldStyle('welcome_description')" x-html="nl2br(fields.welcome_description || 'Profesyonel egitmenlerimizle kariyer hedeflerinize ulasmaniz icin en uygun kurslari kesfedin.')" style="color: rgb(95 93 93); line-height: 1.75;"></p>
                                    </div>

                                    {{-- Features list --}}
                                    <ul style="margin-top: 1.5rem; display: flex; flex-direction: column; gap: 1rem; list-style: none; padding: 0;">
                                        <template x-for="(feature, fIdx) in fields.welcome_features" :key="fIdx">
                                            <li style="display: flex; align-items: center; gap: 0.75rem;">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-check.svg') }}" alt="" width="18" height="18" />
                                                <div class="ez" :class="activeField === ('wf_' + fIdx) && 'ez-active'" data-label="Duzenle" @click="openWelcomeFeatureModal(fIdx)" style="flex: 1; cursor: pointer;">
                                                    <span :style="getFieldStyle('wf_' + fIdx)" x-html="nl2br(feature || ('Madde ' + (fIdx+1)))" style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; color: rgb(1 28 26); font-size: 1.0625rem;"></span>
                                                </div>
                                                <button type="button" @click="removeWelcomeFeature(fIdx)" class="del-btn" title="Sil">
                                                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                                </button>
                                            </li>
                                        </template>
                                    </ul>
                                    <button type="button" @click="addWelcomeFeature()" class="add-btn" style="margin-top: 1rem;">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                        Yeni Ozellik Ekle
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Kategoriler</span></div></div>

            {{-- ── Categories Section ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 70px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 2rem; margin-bottom: 3rem;">
                                <div style="max-width: 580px;">
                                    <div class="ez" :class="activeField === 'categories_label' && 'ez-active'" data-label="Duzenle" @click="openModal('categories_label', 'Kategoriler Etiket')" style="margin-bottom: 1.25rem;">
                                        <span :style="getFieldStyle('categories_label')" x-html="nl2br(fields.categories_label || 'COURSE CATEGORIES')" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                    </div>
                                    <div class="ez" :class="activeField === 'categories_title' && 'ez-active'" data-label="Duzenle" @click="openModal('categories_title', 'Kategoriler Baslik')">
                                        <h2 :style="getFieldStyle('categories_title')" x-html="nl2br(fields.categories_title || 'Top Categories You Want to Learn')"></h2>
                                    </div>
                                </div>
                                <div>
                                    <div class="ez" :class="activeField === 'categories_button_text' && 'ez-active'" data-label="Buton Yazisi" @click="openModal('categories_button_text', 'Buton Yazisi')">
                                        <div style="position: relative; display: inline-flex; align-items: center; overflow: hidden; border-radius: 52px; padding: 1rem 70px 1rem 30px; background-color: rgb(84 62 232); color: #fff; font-size: 1rem;">
                                            <span :style="getFieldStyle('categories_button_text')" x-html="nl2br(fields.categories_button_text || 'Find Courses')"></span>
                                            <span style="position: absolute; right: 5px; display: inline-flex; width: 2.75rem; height: 2.75rem; align-items: center; justify-content: center; border-radius: 50%; background: white;">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="" width="13" height="12" />
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ez" :class="activeField === 'categories_button_url' && 'ez-active'" data-label="Buton Linki" @click="openModal('categories_button_url', 'Buton Linki')" style="margin-top: 8px;">
                                        <span style="font-size: 0.75rem; color: #8D8D8D; display: inline-flex; align-items: center; gap: 4px;">
                                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m9.86-4.318a4.5 4.5 0 0 0-1.242-7.244l4.5-4.5a4.5 4.5 0 0 1 6.364 6.364l-1.757 1.757"/></svg>
                                            <span x-html="nl2br(fields.categories_button_url || '{{ route('front.courses') }}')"></span>
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
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Ozellikler</span></div></div>

            {{-- ── Features Section ── --}}
            <div>
                <div style="background: rgb(1 28 26); padding: 90px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2.5rem;">
                            <template x-for="(feat, fIdx) in fields.features" :key="fIdx">
                                <div style="display: flex; align-items: flex-start; gap: 1.25rem; position: relative;">
                                    {{-- Icon --}}
                                    <div class="ez ez-img" :class="activeField === 'feature_icon_' + fIdx && 'ez-active'" :data-label="'Ikon Degistir'" @click="openFeatureIconModal(fIdx)" :style="'display: inline-flex; width: 60px; height: 60px; min-width: 60px; align-items: center; justify-content: center; border-radius: 50%; background: ' + (feat.bg_color || '#FFCD20') + '1a'">
                                        <template x-if="feat.icon">
                                            <img :src="feat.icon.startsWith('http') ? feat.icon : baseUrl + '/' + feat.icon" alt="" width="30" height="30" />
                                        </template>
                                        <template x-if="!feat.icon">
                                            <svg style="width: 30px; height: 30px; color: white; opacity: 0.5;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                                        </template>
                                    </div>
                                    <div style="flex: 1;">
                                        <div class="ez" :class="activeField === 'feat_title_' + fIdx && 'ez-active'" data-label="Baslik" @click="openArrayModal('features', fIdx, 'title', 'Ozellik Basligi')">
                                            <span :style="getFieldStyle('feat_title_' + fIdx)" x-html="nl2br(feat.title || 'Baslik...')" style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; font-size: 1.25rem; color: white; margin-bottom: 0.5rem;"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'feat_desc_' + fIdx && 'ez-active'" data-label="Aciklama" @click="openArrayModal('features', fIdx, 'description', 'Ozellik Aciklamasi', 'textarea')">
                                            <span :style="getFieldStyle('feat_desc_' + fIdx)" x-html="nl2br(feat.description || 'Aciklama...')" style="font-size: 0.875rem; color: rgba(255,255,255,0.8);"></span>
                                        </div>
                                        <div style="margin-top: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                                            <input type="color" x-model="fields.features[fIdx].bg_color" @change="saveAll()" style="width: 28px; height: 28px; border: none; cursor: pointer; border-radius: 6px; padding: 0;" title="Renk Sec" />
                                            <button type="button" @click="removeFeature(fIdx)" class="del-btn" style="margin-left: auto; border-color: rgba(215,59,62,0.4);" title="Sil">
                                                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div style="text-align: center; margin-top: 1.5rem;">
                            <button type="button" @click="addFeature()" class="add-btn" style="border-color: rgba(84,62,232,0.4); color: rgb(255 205 32);">
                                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                Yeni Ozellik Ekle
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Online Kurslar</span></div></div>

            {{-- ── Courses Section ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 50px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="max-width: 480px; margin: 0 auto; text-align: center; margin-bottom: 3rem;">
                                <div class="ez" :class="activeField === 'courses_label' && 'ez-active'" data-label="Duzenle" @click="openModal('courses_label', 'Kurslar Etiket')" style="margin-bottom: 1.25rem;">
                                    <span :style="getFieldStyle('courses_label')" x-html="nl2br(fields.courses_label || 'ONLINE COURSES')" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                </div>
                                <div class="ez" :class="activeField === 'courses_title' && 'ez-active'" data-label="Duzenle" @click="openModal('courses_title', 'Kurslar Baslik')">
                                    <h2 :style="getFieldStyle('courses_title')" x-html="nl2br(fields.courses_title || 'Get Your Course With Us')"></h2>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                                @for($i = 0; $i < 3; $i++)
                                <div style="border-radius: 8px; overflow: hidden; background: #F5F5F5;">
                                    <div style="width: 100%; height: 180px; background: #E8E8E8;"></div>
                                    <div style="padding: 1.5rem;">
                                        <span style="font-size: 0.8125rem; color: rgb(95 93 93);">12 Ders &bull; Egitmen Adi</span>
                                        <p style="margin-top: 1rem; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.125rem; font-weight: 700; color: rgb(1 28 26);">Ornek Kurs Basligi</p>
                                    </div>
                                </div>
                                @endfor
                            </div>
                            <p style="text-align: center; font-size: 0.75rem; color: #8D8D8D; margin-top: 1.5rem; font-style: italic;">Kurslar veritabanindan otomatik cekilir</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Neden Biz</span></div></div>

            {{-- ── Why Choose Us Section ── --}}
            <div>
                <div style="background: white; padding: 70px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <div style="display: grid; grid-template-columns: minmax(0, 0.9fr) 1fr; gap: 2.5rem; align-items: center;">
                            {{-- Left: Text --}}
                            <div>
                                <div style="margin-bottom: 1.5rem;">
                                    <div class="ez" :class="activeField === 'why_label' && 'ez-active'" data-label="Duzenle" @click="openModal('why_label', 'Ust Etiket')" style="margin-bottom: 1.25rem;">
                                        <span :style="getFieldStyle('why_label')" x-html="nl2br(fields.why_label || 'WHY CHOOSE US')" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                    </div>
                                    <div class="ez" :class="activeField === 'why_title' && 'ez-active'" data-label="Duzenle" @click="openModal('why_title', 'Baslik')">
                                        <h2 :style="getFieldStyle('why_title')" x-html="nl2br(fields.why_title || 'Transform Your Best Practice with Our Online Course')"></h2>
                                    </div>
                                </div>
                                <div class="ez" :class="activeField === 'why_description' && 'ez-active'" data-label="Duzenle" @click="openModal('why_description', 'Aciklama', 'textarea')" style="margin-top: 1.75rem;">
                                    <p :style="getFieldStyle('why_description')" x-html="nl2br(fields.why_description || 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.')" style="color: rgb(95 93 93); line-height: 1.75;"></p>
                                </div>

                                {{-- Why items list --}}
                                <ul style="margin-top: 2.5rem; display: flex; flex-direction: column; gap: 2.5rem; list-style: none; padding: 0;">
                                    <template x-for="(item, wIdx) in fields.why_items" :key="wIdx">
                                        <li>
                                            <div style="display: flex; align-items: center; gap: 1.25rem; margin-bottom: 1.25rem;">
                                                <div class="ez ez-img" :class="activeField === 'why_icon_' + wIdx && 'ez-active'" :data-label="'Ikon Degistir'" @click="openWhyIconModal(wIdx)" :style="'display: inline-flex; width: 60px; height: 60px; min-width: 60px; align-items: center; justify-content: center; border-radius: 50%; background: ' + (item.bg_color || '#20B9AB') + '1a'">
                                                    <template x-if="item.icon">
                                                        <img :src="item.icon.startsWith('http') ? item.icon : baseUrl + '/' + item.icon" alt="" width="25" height="25" />
                                                    </template>
                                                    <template x-if="!item.icon">
                                                        <svg style="width: 25px; height: 25px; opacity: 0.5;" :style="'color:' + (item.bg_color || '#20B9AB')" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/></svg>
                                                    </template>
                                                </div>
                                                <div class="ez" :class="activeField === 'why_title_' + wIdx && 'ez-active'" data-label="Baslik" @click="openArrayModal('why_items', wIdx, 'title', 'Madde Basligi')" style="flex: 1;">
                                                    <span :style="getFieldStyle('why_title_' + wIdx)" x-html="nl2br(item.title || 'Baslik...')" style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; font-size: 1.25rem; color: rgb(1 28 26);"></span>
                                                </div>
                                                <div style="display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0;">
                                                    <input type="color" x-model="fields.why_items[wIdx].bg_color" @change="saveAll()" style="width: 28px; height: 28px; border: none; cursor: pointer; border-radius: 6px; padding: 0;" title="Renk Sec" />
                                                    <button type="button" @click="removeWhyItem(wIdx)" class="del-btn" title="Sil">
                                                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="ez" :class="activeField === 'why_desc_' + wIdx && 'ez-active'" data-label="Aciklama" @click="openArrayModal('why_items', wIdx, 'description', 'Madde Aciklamasi', 'textarea')">
                                                <p :style="getFieldStyle('why_desc_' + wIdx)" x-html="nl2br(item.description || 'Aciklama...')" style="color: rgb(95 93 93); line-height: 1.75;"></p>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                                <button type="button" @click="addWhyItem()" class="add-btn" style="margin-top: 1.5rem;">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                    Yeni Madde Ekle
                                </button>
                            </div>

                            {{-- Right: Image + Stat --}}
                            <div style="position: relative;">
                                <div class="ez ez-img" :class="activeField === 'why_image' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('why_image', 'Why Choose Us Resmi', 'image')" style="display: inline-block;">
                                    <img :src="fields.why_image ? (fields.why_image.startsWith('http') ? fields.why_image : baseUrl + '/' + fields.why_image) : '{{ asset('assets-front/img/images/th-1/content-img-1.png') }}'" alt="" width="486" style="max-width: 100%; display: block;" />
                                </div>
                                <div style="position: absolute; bottom: 60px; left: 0; z-index: 10; display: inline-flex; align-items: center; gap: 1.25rem; background: white; padding: 0.5rem 2rem 0.5rem 1rem; border-radius: 8px; box-shadow: 17px 18px 30px 16px rgba(7,2,41,0.1);">
                                    <div style="display: inline-flex; width: 64px; height: 64px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(223,67,67,0.05);">
                                        <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="" width="28" height="28" />
                                    </div>
                                    <div>
                                        <div class="ez" :class="activeField === 'why_stat_number' && 'ez-active'" data-label="Duzenle" @click="openModal('why_stat_number', 'Sayac Numarasi')">
                                            <span :style="getFieldStyle('why_stat_number')" x-html="nl2br((fields.why_stat_number || '69K') + '+')" style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.75rem; font-weight: 700; line-height: 1.73; color: #DF4343;"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'why_stat_text' && 'ez-active'" data-label="Duzenle" @click="openModal('why_stat_text', 'Sayac Metni')">
                                            <span :style="getFieldStyle('why_stat_text')" x-html="nl2br(fields.why_stat_text || 'Satisfied Students')" style="color: rgb(95 93 93);"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Istatistikler</span></div></div>

            {{-- ── Fun-Fact Section ── --}}
            <div>
                <div style="background: white; padding: 40px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <div style="background: rgb(84 62 232); border-radius: 8px; padding: 1.25rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
                                {{-- Left: Image --}}
                                <div class="ez ez-img" :class="activeField === 'funfact_image' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('funfact_image', 'Istatistik Resmi', 'image')" style="display: block; border-radius: 8px; overflow: hidden;">
                                    <img :src="fields.funfact_image ? (fields.funfact_image.startsWith('http') ? fields.funfact_image : baseUrl + '/' + fields.funfact_image) : '{{ asset('assets-front/img/images/th-1/funfact-image.png') }}'" alt="" width="553" height="315" style="max-width: 100%; display: block; margin: 0 auto;" />
                                </div>
                                {{-- Right: Stats --}}
                                <div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem 3rem;">
                                        <template x-for="(item, ffIdx) in fields.funfact_items" :key="ffIdx">
                                            <div style="position: relative;">
                                                <div class="ez" :class="activeField === 'ff_number_' + ffIdx && 'ez-active'" data-label="Sayi" @click="openArrayModal('funfact_items', ffIdx, 'number', 'Istatistik Sayisi')">
                                                    <span :style="getFieldStyle('ff_number_' + ffIdx)" x-html="nl2br((item.number || '0') + '+')" style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 2rem; font-weight: 700; color: white;"></span>
                                                </div>
                                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.25rem;">
                                                    <div class="ez" :class="activeField === 'ff_text_' + ffIdx && 'ez-active'" data-label="Metin" @click="openArrayModal('funfact_items', ffIdx, 'text', 'Istatistik Metni')" style="flex: 1;">
                                                        <span :style="getFieldStyle('ff_text_' + ffIdx)" x-html="nl2br(item.text || 'Metin...')" style="color: rgba(255,255,255,0.8); font-size: 0.875rem;"></span>
                                                    </div>
                                                    <button type="button" @click="removeFunfactItem(ffIdx)" class="del-btn" style="border-color: rgba(255,255,255,0.3); color: rgba(255,255,255,0.7);" title="Sil">
                                                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <div style="margin-top: 1.25rem;">
                                        <button type="button" @click="addFunfactItem()" class="add-btn" style="border-color: rgba(255,255,255,0.3); color: white;">
                                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                            Yeni Istatistik Ekle
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Is Ortaklari</span></div></div>

            {{-- ── Client Logo Section ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 50px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="max-width: 580px; margin: 0 auto; text-align: center; margin-bottom: 2.5rem;">
                                <div class="ez" :class="activeField === 'client_logo_text' && 'ez-active'" data-label="Duzenle" @click="openModal('client_logo_text', 'Is Ortaklari Metni')">
                                    <p :style="getFieldStyle('client_logo_text')" x-html="nl2br(fields.client_logo_text || 'Get in touch with the 250+ companies who Collaboration us')" style="font-size: 1.125rem; color: rgb(1 28 26);"></p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: center; gap: 3rem; flex-wrap: wrap; opacity: 0.5;">
                                @for($i = 0; $i < 5; $i++)
                                <div style="width: 130px; height: 40px; background: #E8E8E8; border-radius: 6px;"></div>
                                @endfor
                            </div>
                            <p style="text-align: center; font-size: 0.75rem; color: #8D8D8D; margin-top: 1.5rem; font-style: italic;">
                                Logolar <a href="{{ route('client-logos.index') }}" style="color: rgb(84 62 232); text-decoration: underline;">Is Ortaklari</a> sayfasindan yonetilir
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section divider ── --}}
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Yorumlar</span></div></div>

            {{-- ── Testimonial Section ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 70px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                                {{-- Left: Text + Slider preview --}}
                                <div>
                                    <div style="margin-bottom: 2.5rem;">
                                        <div class="ez" :class="activeField === 'testimonial_label' && 'ez-active'" data-label="Duzenle" @click="openModal('testimonial_label', 'Yorumlar Etiket')" style="margin-bottom: 1.25rem;">
                                            <span :style="getFieldStyle('testimonial_label')" x-html="nl2br(fields.testimonial_label || 'OUR TESTIMONIAL')" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'testimonial_title' && 'ez-active'" data-label="Duzenle" @click="openModal('testimonial_title', 'Yorumlar Baslik')">
                                            <h2 :style="getFieldStyle('testimonial_title')" x-html="nl2br(fields.testimonial_title || 'What Student Say About Our Online Education Course')"></h2>
                                        </div>
                                    </div>
                                    {{-- Slider preview --}}
                                    <div style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.06);">
                                        <div style="display: flex; gap: 4px; margin-bottom: 1.25rem;">
                                            @for($i = 0; $i < 5; $i++)
                                            <img src="{{ asset('assets-front/img/icons/icon-yellow-star.svg') }}" alt="" width="16" height="15" />
                                            @endfor
                                        </div>
                                        <p style="font-size: 1.125rem; color: rgb(95 93 93); font-style: italic; line-height: 1.75;">"Ornek yorum metni burada gorunur..."</p>
                                        <div style="display: flex; align-items: center; gap: 1rem; margin-top: 2rem;">
                                            <div style="width: 43px; height: 43px; border-radius: 50%; background: #E8E8E8;"></div>
                                            <div>
                                                <span style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; color: rgb(1 28 26);">Kullanici Adi</span><br>
                                                <span style="font-size: 0.875rem; color: rgb(95 93 93);">Rolu</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-size: 0.75rem; color: #8D8D8D; margin-top: 1rem; font-style: italic;">
                                        Yorumlar <a href="{{ route('testimonials.index') }}" style="color: rgb(84 62 232); text-decoration: underline;">Yorumlar</a> sayfasindan yonetilir
                                    </p>
                                </div>

                                {{-- Right: Image + Stat --}}
                                <div style="position: relative;">
                                    <div class="ez ez-img" :class="activeField === 'testimonial_image' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('testimonial_image', 'Yorumlar Resmi', 'image')" style="display: inline-block;">
                                        <img :src="fields.testimonial_image ? (fields.testimonial_image.startsWith('http') ? fields.testimonial_image : baseUrl + '/' + fields.testimonial_image) : '{{ asset('assets-front/img/images/th-1/testimonial-img.png') }}'" alt="" width="437" height="520" style="max-width: 100%; display: block;" />
                                    </div>
                                    <div style="position: absolute; bottom: 48px; left: 40px; z-index: 10; display: inline-flex; align-items: center; gap: 1.25rem; background: white; padding: 0.5rem 2rem 0.5rem 1rem; border-radius: 8px; box-shadow: 17px 18px 30px 16px rgba(7,2,41,0.1);">
                                        <div style="display: inline-flex; width: 64px; height: 64px; align-items: center; justify-content: center; border-radius: 50%; background: rgba(223,67,67,0.05);">
                                            <img src="{{ asset('assets-front/img/icons/icon-red-tomato-graduation-cap-line.svg') }}" alt="" width="28" height="28" />
                                        </div>
                                        <div>
                                            <div class="ez" :class="activeField === 'testimonial_stat_number' && 'ez-active'" data-label="Duzenle" @click="openModal('testimonial_stat_number', 'Sayac Numarasi')">
                                                <span :style="getFieldStyle('testimonial_stat_number')" x-html="nl2br((fields.testimonial_stat_number || '667K') + '+')" style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.75rem; font-weight: 700; line-height: 1.73; color: #DF4343;"></span>
                                            </div>
                                            <div class="ez" :class="activeField === 'testimonial_stat_text' && 'ez-active'" data-label="Duzenle" @click="openModal('testimonial_stat_text', 'Sayac Metni')">
                                                <span :style="getFieldStyle('testimonial_stat_text')" x-html="nl2br(fields.testimonial_stat_text || 'Students worldwide')" style="color: rgb(95 93 93);"></span>
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
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Blog</span></div></div>

            {{-- ── Blog Section ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 50px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="max-width: 480px; margin: 0 auto; text-align: center; margin-bottom: 3rem;">
                                <div class="ez" :class="activeField === 'blog_label' && 'ez-active'" data-label="Duzenle" @click="openModal('blog_label', 'Blog Etiket')" style="margin-bottom: 1.25rem;">
                                    <span :style="getFieldStyle('blog_label')" x-html="nl2br(fields.blog_label || 'OUR NEWS')" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                </div>
                                <div class="ez" :class="activeField === 'blog_title' && 'ez-active'" data-label="Duzenle" @click="openModal('blog_title', 'Blog Baslik')">
                                    <h2 :style="getFieldStyle('blog_title')" x-html="nl2br(fields.blog_title || 'Our New Articles')"></h2>
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
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">CTA</span></div></div>

            {{-- ── CTA Section ── --}}
            <div>
                <div style="background: white; padding: 40px 0;">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                        <div style="position: relative; z-index: 10; overflow: hidden; background: rgb(84 62 232); border-radius: 8px; display: grid; grid-template-columns: 0.8fr 1fr; gap: 56px;">
                            {{-- CTA Image --}}
                            <div style="position: relative; order: 1;">
                                <div class="ez ez-img" :class="activeField === 'cta_image' && 'ez-active'" data-label="Resmi Duzenle" @click="openModal('cta_image', 'CTA Resmi', 'image')" style="height: 100%; display: flex; align-items: flex-end;">
                                    <img :src="fields.cta_image ? (fields.cta_image.startsWith('http') ? fields.cta_image : baseUrl + '/' + fields.cta_image) : '{{ asset('assets-front/img/images/th-1/cta-img.png') }}'"
                                         alt="cta-img" style="max-width: 100%; display: block;" />
                                </div>
                            </div>

                            {{-- CTA Content --}}
                            <div style="order: 2; padding: 48px 24px 48px 0;">
                                <div style="max-width: 530px;">
                                    <div class="ez" :class="activeField === 'cta_label' && 'ez-active'" data-label="Duzenle" @click="openModal('cta_label', 'CTA Etiket')" style="margin-bottom: 1.25rem;">
                                        <span :style="getFieldStyle('cta_label')" x-html="nl2br(fields.cta_label || 'HEMEN BASLAYIN')"
                                              style="display: block; text-transform: uppercase; color: rgb(255 205 32); font-size: 1rem; font-weight: 500;"></span>
                                    </div>
                                    <div class="ez" :class="activeField === 'cta_title' && 'ez-active'" data-label="Duzenle" @click="openModal('cta_title', 'CTA Baslik')">
                                        <h2 :style="getFieldStyle('cta_title')" style="color: white !important; font-size: 1.875rem; line-height: 1.38;"
                                            x-html="nl2br(fields.cta_title || 'Uygun Fiyatli Online Kurslar & Ogrenme Firsatlari')"></h2>
                                    </div>
                                    <div class="ez" :class="activeField === 'cta_description' && 'ez-active'" data-label="Duzenle" @click="openModal('cta_description', 'CTA Aciklama', 'textarea')" style="margin-top: 1.75rem; margin-bottom: 30px;">
                                        <p :style="getFieldStyle('cta_description')" style="color: rgba(255,255,255,0.8); font-size: 1rem; line-height: 1.75;"
                                           x-html="nl2br(fields.cta_description || 'Kariyerinizi bir adim oteye tasiyacak egitimlerle tanismaya hazir misiniz?')"></p>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div class="ez" :class="activeField === 'cta_button_text' && 'ez-active'" data-label="Duzenle" @click="openModal('cta_button_text', 'CTA Buton Yazisi')">
                                            <div style="position: relative; display: inline-flex; align-items: center; overflow: hidden; border-radius: 52px; padding: 1rem 70px 1rem 30px; background-color: rgb(255 205 32); color: rgb(1 28 26); font-size: 1rem; line-height: 1.5rem;">
                                                <span :style="getFieldStyle('cta_button_text')" x-html="nl2br(fields.cta_button_text || 'Ogrenmeye Basla')"></span>
                                                <span style="position: absolute; right: 5px; display: inline-flex; width: 2.75rem; height: 2.75rem; align-items: center; justify-content: center; border-radius: 50%; background: rgb(1 28 26);">
                                                    <img src="{{ asset('assets-front/img/icons/icon-golden-yellow-arrow-right.svg') }}" alt="" width="13" height="12" />
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ez" :class="activeField === 'cta_button_url' && 'ez-active'" data-label="Duzenle" @click="openModal('cta_button_url', 'CTA Buton URL')">
                                            <span style="color: rgba(255,255,255,0.5); font-size: 0.75rem; font-family: monospace; border: 1px dashed rgba(255,255,255,0.3); padding: 4px 10px; border-radius: 6px;"
                                                  x-html="nl2br(fields.cta_button_url || '/kurslar')"></span>
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
                 style="background: white; border-radius: 16px; box-shadow: 0 25px 50px rgba(1,28,26,0.2); width: 100%; max-width: 540px; overflow: hidden; max-height: 90vh; display: flex; flex-direction: column;" @click.stop>
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgb(1 28 26 / 0.06); display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;">
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
                <div style="padding: 1.5rem; overflow-y: auto; flex: 1;">
                    <template x-if="modalType === 'text' || modalType === 'textarea'">
                        <div>
                            <textarea x-model="modalValue" x-ref="modalTextarea" :rows="modalType === 'textarea' ? 4 : 2" :maxlength="modalMaxLength > 0 ? modalMaxLength : undefined" class="modal-input modal-textarea" :class="validationError && 'modal-input-error'" @input="validateField()" style="resize: vertical; min-height: 50px;"></textarea>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 6px; min-height: 20px;">
                                <span x-show="validationError" x-text="validationError" style="font-size: 0.75rem; color: rgb(215 59 62);"></span>
                                <span x-show="modalMaxLength > 0" x-text="(modalValue?.length || 0) + '/' + modalMaxLength" style="font-size: 0.7rem; color: #8D8D8D; margin-left: auto;"></span>
                            </div>
                        </div>
                    </template>

                    {{-- Style Section --}}
                    <div x-show="styleFields.includes(modalField) || modalField.startsWith('wf_') || modalField.startsWith('ff_') || modalField.startsWith('why_title_') || modalField.startsWith('why_desc_') || modalField.startsWith('feat_')" class="style-section">
                        <div class="style-section-title">
                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42"/></svg>
                            Stil Ayarları
                        </div>
                        <div class="style-row">
                            <span class="style-label">Biçim</span>
                            <div class="style-toggle-group">
                                <button type="button" class="style-toggle" :class="getStyleProp('fontWeight') === 'bold' && 'active'" @click="setStyleProp('fontWeight', getStyleProp('fontWeight') === 'bold' ? '' : 'bold')" title="Kalın"><svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h7a4 4 0 0 1 0 8H6V4Zm0 8h8a4 4 0 0 1 0 8H6v-8Z"/></svg></button>
                                <button type="button" class="style-toggle" :class="getStyleProp('fontStyle') === 'italic' && 'active'" @click="setStyleProp('fontStyle', getStyleProp('fontStyle') === 'italic' ? '' : 'italic')" title="Yatık"><svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10 4h4m-2 0 -4 16m-2 0h4"/><line x1="14" y1="4" x2="10" y2="20" stroke-width="2"/></svg></button>
                                <div style="width: 1px; background: rgb(1 28 26 / 0.1); margin: 4px 2px;"></div>
                                <button type="button" class="style-toggle" :class="getStyleProp('textAlign') === 'left' && 'active'" @click="setStyleProp('textAlign', getStyleProp('textAlign') === 'left' ? '' : 'left')" title="Sola Hizala"><svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h10.5M3.75 17.25h16.5"/></svg></button>
                                <button type="button" class="style-toggle" :class="(getStyleProp('textAlign') === 'center' || !getStyleProp('textAlign')) && 'active'" @click="setStyleProp('textAlign', 'center')" title="Ortala"><svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12h10.5M3.75 17.25h16.5"/></svg></button>
                                <button type="button" class="style-toggle" :class="getStyleProp('textAlign') === 'right' && 'active'" @click="setStyleProp('textAlign', getStyleProp('textAlign') === 'right' ? '' : 'right')" title="Sağa Hizala"><svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M6.75 12H20.25M3.75 17.25h16.5"/></svg></button>
                            </div>
                        </div>
                        <div class="style-row">
                            <span class="style-label">Renk</span>
                            <div class="style-color-wrap">
                                <input type="color" class="style-color-input" :value="getStyleProp('color') || getDefaultColor(modalField)" @input="setStyleProp('color', $event.target.value)">
                                <input type="text" class="style-color-hex" :value="getStyleProp('color') || getDefaultColor(modalField)" @input="setStyleProp('color', $event.target.value)" :placeholder="getDefaultColor(modalField)" maxlength="7">
                            </div>
                        </div>
                        <div class="style-row">
                            <span class="style-label">Saydamlık</span>
                            <div class="style-opacity-wrap">
                                <input type="range" class="style-opacity-range" min="0" max="100" step="1" :value="getStyleProp('opacity') !== '' ? getStyleProp('opacity') : 100" @input="setStyleProp('opacity', $event.target.value)">
                                <input type="text" class="style-opacity-val" :value="(getStyleProp('opacity') !== '' ? getStyleProp('opacity') : 100) + '%'" @change="let v = parseInt($event.target.value); if(!isNaN(v)){v=Math.max(0,Math.min(100,v)); setStyleProp('opacity', v);} $event.target.value = (getStyleProp('opacity') !== '' ? getStyleProp('opacity') : 100) + '%'" maxlength="4">
                            </div>
                        </div>
                        <div class="style-row">
                            <span class="style-label">Boyut</span>
                            <select class="style-select" :value="getStyleProp('fontSize') || ''" @change="setStyleProp('fontSize', $event.target.value)">
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
                        <div class="style-row">
                            <span class="style-label">Font</span>
                            <select class="style-select" :value="getStyleProp('fontFamily') || ''" @change="setStyleProp('fontFamily', $event.target.value)">
                                <option value="">Varsayılan (Aeonik Pro)</option>
                                <option value="Poppins, sans-serif">Poppins</option>
                                <option value="'Aeonik Pro TRIAL', sans-serif">Aeonik Pro</option>
                                <option value="Georgia, serif">Georgia (Serif)</option>
                                <option value="'Times New Roman', serif">Times New Roman</option>
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                            </select>
                        </div>
                        <div style="text-align: right; margin-top: 0.5rem;">
                            <button type="button" class="style-reset-btn" @click="resetFieldStyle()">Varsayılana Sıfırla</button>
                        </div>
                    </div>
                </div>
                <div style="padding: 1rem 1.5rem; border-top: 1px solid rgb(1 28 26 / 0.06); display: flex; justify-content: flex-end; gap: 0.75rem; flex-shrink: 0;">
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
    $_wf = $homePageInfo->getTranslation('welcome_features', $selectedLang, false);
    if (!is_array($_wf) || count($_wf) === 0) {
        $_wf = ['Our Expert Trainers', 'Online Remote Learning', 'Easy to follow curriculum', 'Lifetime Access'];
    }
    $_feat = $homePageInfo->getTranslation('features', $selectedLang, false);
    if (!is_array($_feat) || count($_feat) === 0) {
        $_feat = [
            ['title' => 'Educator Support', 'description' => 'Excepteur sint occaecat cupidatat non the proident sunt in culpa', 'icon' => 'assets-front/img/icons/feature-icon-1.svg', 'bg_color' => '#FFCD20'],
            ['title' => 'Top Instructor', 'description' => 'Excepteur sint occaecat cupidatat non the proident sunt in culpa', 'icon' => 'assets-front/img/icons/feature-icon-2.svg', 'bg_color' => '#6FC081'],
            ['title' => 'Award Wining', 'description' => 'Excepteur sint occaecat cupidatat non the proident sunt in culpa', 'icon' => 'assets-front/img/icons/feature-icon-3.svg', 'bg_color' => '#DF4343'],
        ];
    }
    $_whyItems = $homePageInfo->getTranslation('why_items', $selectedLang, false);
    if (!is_array($_whyItems) || count($_whyItems) === 0) {
        $_whyItems = [
            ['title' => 'Face-to-face Teaching', 'description' => 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia for this is a for that an deserunt mollit.', 'icon' => 'assets-front/img/icons/content-icon-1.svg', 'bg_color' => '#20B9AB'],
            ['title' => '24/7 Support Available', 'description' => 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia for this is a for that an deserunt mollit.', 'icon' => 'assets-front/img/icons/content-icon-2.svg', 'bg_color' => '#DF4343'],
        ];
    }
    $_funfactItems = $homePageInfo->getTranslation('funfact_items', $selectedLang, false);
    if (!is_array($_funfactItems) || count($_funfactItems) === 0) {
        $_funfactItems = [
            ['number' => '5923', 'text' => 'Student enrolled'],
            ['number' => '8497', 'text' => 'Classes completed'],
            ['number' => '7554', 'text' => 'Learners report'],
            ['number' => '2755', 'text' => 'Top instructors'],
        ];
    }
@endphp
<script>
function homeEditor() {
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
        devMode: false,
        savingDefaults: false,
        validationError: '',
        modalMaxLength: 0,
        _iconTarget: null,
        _arrayTarget: null,
        baseUrl: @json(url('/')),

        fields: {
            welcome_label: @json(translateAttribute($homePageInfo, 'welcome_label', $selectedLang) ?? ''),
            welcome_title: @json(translateAttribute($homePageInfo, 'welcome_title', $selectedLang) ?? ''),
            welcome_description: @json(translateAttribute($homePageInfo, 'welcome_description', $selectedLang) ?? ''),
            welcome_features: @json($_wf),
            welcome_stat_text: @json(translateAttribute($homePageInfo, 'welcome_stat_text', $selectedLang) ?? ''),
            welcome_image: @json($homePageInfo->welcome_image ?? ''),
            welcome_stat_number: @json($homePageInfo->welcome_stat_number ?? ''),
            categories_label: @json(translateAttribute($homePageInfo, 'categories_label', $selectedLang) ?? ''),
            categories_title: @json(translateAttribute($homePageInfo, 'categories_title', $selectedLang) ?? ''),
            categories_button_text: @json(translateAttribute($homePageInfo, 'categories_button_text', $selectedLang) ?? ''),
            categories_button_url: @json($homePageInfo->categories_button_url ?? ''),
            features: @json($_feat),
            why_label: @json(translateAttribute($homePageInfo, 'why_label', $selectedLang) ?? ''),
            why_title: @json(translateAttribute($homePageInfo, 'why_title', $selectedLang) ?? ''),
            why_description: @json(translateAttribute($homePageInfo, 'why_description', $selectedLang) ?? ''),
            why_items: @json($_whyItems),
            why_image: @json($homePageInfo->why_image ?? ''),
            why_stat_number: @json($homePageInfo->why_stat_number ?? ''),
            why_stat_text: @json(translateAttribute($homePageInfo, 'why_stat_text', $selectedLang) ?? ''),
            funfact_image: @json($homePageInfo->funfact_image ?? ''),
            funfact_items: @json($_funfactItems),
            client_logo_text: @json(translateAttribute($homePageInfo, 'client_logo_text', $selectedLang) ?? ''),
            courses_label: @json(translateAttribute($homePageInfo, 'courses_label', $selectedLang) ?? ''),
            courses_title: @json(translateAttribute($homePageInfo, 'courses_title', $selectedLang) ?? ''),
            blog_label: @json(translateAttribute($homePageInfo, 'blog_label', $selectedLang) ?? ''),
            blog_title: @json(translateAttribute($homePageInfo, 'blog_title', $selectedLang) ?? ''),
            testimonial_label: @json(translateAttribute($homePageInfo, 'testimonial_label', $selectedLang) ?? ''),
            testimonial_title: @json(translateAttribute($homePageInfo, 'testimonial_title', $selectedLang) ?? ''),
            testimonial_image: @json($homePageInfo->testimonial_image ?? ''),
            testimonial_stat_number: @json($homePageInfo->testimonial_stat_number ?? ''),
            testimonial_stat_text: @json(translateAttribute($homePageInfo, 'testimonial_stat_text', $selectedLang) ?? ''),
            cta_label: @json(translateAttribute($ctaInfo, 'cta_label', $selectedLang) ?? ''),
            cta_title: @json(translateAttribute($ctaInfo, 'cta_title', $selectedLang) ?? ''),
            cta_description: @json(translateAttribute($ctaInfo, 'cta_description', $selectedLang) ?? ''),
            cta_button_text: @json(translateAttribute($ctaInfo, 'cta_button_text', $selectedLang) ?? ''),
            cta_button_url: @json($ctaInfo->cta_button_url ?? ''),
            cta_image: @json($ctaInfo->cta_image ?? ''),
        },

        _wfTarget: -1,

        // Welcome features
        addWelcomeFeature() {
            this.fields.welcome_features.push('');
        },
        removeWelcomeFeature(index) {
            this.fields.welcome_features.splice(index, 1);
            this.saveAll();
        },
        openWelcomeFeatureModal(index) {
            this._iconTarget = null;
            this._arrayTarget = null;
            this._wfTarget = index;
            this.modalField = 'wf_' + index;
            this.modalLabel = 'Madde ' + (index + 1);
            this.modalValue = this.fields.welcome_features[index] || '';
            this.modalType = 'text';
            this.activeField = 'wf_' + index;
            this.validationError = '';
            this.modalMaxLength = 150;
            this.modal = true;
            this.$nextTick(() => {
                const input = this.$refs.modalTextarea;
                if (input) input.focus();
            });
        },

        // Features
        addFeature() {
            this.fields.features.push({ title: '', description: '', icon: '', bg_color: '#543EE8' });
        },
        removeFeature(index) {
            this.fields.features.splice(index, 1);
            this.saveAll();
        },
        openFeatureIconModal(index) {
            this._iconTarget = { type: 'feature', index };
            this.modalField = 'feature_icon_' + index;
            this.modalLabel = 'Ozellik Ikonu';
            this.modalValue = this.fields.features[index].icon || '';
            this.modalType = 'image';
            this.activeField = 'feature_icon_' + index;
            this.imgTab = 'upload';
            this.imgDragover = false;
            const val = this.fields.features[index].icon;
            this.imgPreview = val ? (val.startsWith('http') ? val : this.baseUrl + '/' + val) : '';
            this.modal = true;
        },

        // Why items
        addWhyItem() {
            this.fields.why_items.push({ title: '', description: '', icon: '', bg_color: '#20B9AB' });
        },
        removeWhyItem(index) {
            this.fields.why_items.splice(index, 1);
            this.saveAll();
        },
        openWhyIconModal(index) {
            this._iconTarget = { type: 'why', index };
            this.modalField = 'why_icon_' + index;
            this.modalLabel = 'Madde Ikonu';
            this.modalValue = this.fields.why_items[index].icon || '';
            this.modalType = 'image';
            this.activeField = 'why_icon_' + index;
            this.imgTab = 'upload';
            this.imgDragover = false;
            const val = this.fields.why_items[index].icon;
            this.imgPreview = val ? (val.startsWith('http') ? val : this.baseUrl + '/' + val) : '';
            this.modal = true;
        },

        // Fun-fact items
        addFunfactItem() {
            this.fields.funfact_items.push({ number: '', text: '' });
        },
        removeFunfactItem(index) {
            this.fields.funfact_items.splice(index, 1);
            this.saveAll();
        },

        nl2br(str) { return String(str || '').replace(/\n/g, '<br>'); },

        defaults: {
            welcome_label: 'PAROSIS\'E HOS GELDINIZ',
            welcome_title: 'Dijital Online Akademi: Yaratici Mukemmellige Giden Yolunuz',
            welcome_description: 'Profesyonel egitmenlerimizle kariyer hedeflerinize ulasmaniz icin en uygun kurslari kesfedin.',
            welcome_stat_number: '9394',
            welcome_stat_text: 'Kayitli Ogrenci',
            categories_label: 'KURS KATEGORILERI',
            categories_title: 'Ogrenmek Istediginiz En Iyi Kategoriler',
            categories_button_text: 'Kurslari Bul',
            why_label: 'NEDEN BIZ',
            why_title: 'Online Kursumuzla En Iyi Uygulamanizi Donusturun',
            why_description: 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.',
            why_stat_number: '69K',
            why_stat_text: 'Memnun Ogrenci',
            client_logo_text: 'Bizimle is birligi yapan <strong>250+</strong> sirketle tanisin',
            courses_label: 'ONLINE KURSLAR',
            courses_title: 'Kursunuzu Bizimle Alin',
            blog_label: 'HABERLERIMIZ',
            blog_title: 'Yeni Makalelerimiz',
            testimonial_label: 'YORUMLARIMIZ',
            testimonial_title: 'Ogrenciler Online Egitim Kursumuz Hakkinda Ne Diyor',
            testimonial_stat_number: '667K',
            testimonial_stat_text: 'Dunya Genelinde Ogrenci',
            cta_label: 'HEMEN BASLAYIN',
            cta_title: 'Uygun Fiyatli Online Kurslar & Ogrenme Firsatlari',
            cta_description: 'Kariyerinizi bir adim oteye tasiyacak egitimlerle tanismaya hazir misiniz? Hemen kayit olun ve ogrenmeye baslayin.',
            cta_button_text: 'Ogrenmeye Basla',
            cta_button_url: '/kurslar',
        },

        styleFields: [
            'welcome_label', 'welcome_title', 'welcome_description',
            'welcome_stat_number', 'welcome_stat_text',
            'categories_label', 'categories_title', 'categories_button_text',
            'client_logo_text',
            'courses_label', 'courses_title',
            'why_label', 'why_title', 'why_description',
            'why_stat_number', 'why_stat_text',
            'testimonial_label', 'testimonial_title',
            'testimonial_stat_number', 'testimonial_stat_text',
            'blog_label', 'blog_title',
            'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
        ],

        fieldStyles: @php echo json_encode($homePageInfo->field_styles ?? (object)[]); @endphp,

        customDefaults: @php echo json_encode($homePageInfo->default_styles ?? (object)[]); @endphp,

        hardcodedDefaults: {
            welcome_label: { color: '#84994F', fontSize: '', textAlign: '' },
            welcome_title: { color: '#011c1a', fontSize: '', textAlign: '' },
            welcome_description: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            welcome_stat_number: { color: '#DF4343', fontSize: '', textAlign: '' },
            welcome_stat_text: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            categories_label: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            categories_title: { color: '#011c1a', fontSize: '', textAlign: '' },
            categories_button_text: { color: '#ffffff', fontSize: '', textAlign: '' },
            client_logo_text: { color: '#011c1a', fontSize: '', textAlign: '' },
            courses_label: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            courses_title: { color: '#011c1a', fontSize: '', textAlign: '' },
            why_label: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            why_title: { color: '#011c1a', fontSize: '', textAlign: '' },
            why_description: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            why_stat_number: { color: '#DF4343', fontSize: '', textAlign: '' },
            why_stat_text: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            testimonial_label: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            testimonial_title: { color: '#011c1a', fontSize: '', textAlign: '' },
            testimonial_stat_number: { color: '#DF4343', fontSize: '', textAlign: '' },
            testimonial_stat_text: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            blog_label: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            blog_title: { color: '#011c1a', fontSize: '', textAlign: '' },
            cta_label: { color: '#FFCD20', fontSize: '', textAlign: '' },
            cta_title: { color: '#ffffff', fontSize: '', textAlign: '' },
            cta_description: { color: 'rgba(255,255,255,0.8)', fontSize: '', textAlign: '' },
            cta_button_text: { color: '#011c1a', fontSize: '', textAlign: '' },
            feat_title: { color: '#ffffff', fontSize: '', textAlign: '' },
            feat_desc: { color: 'rgba(255,255,255,0.8)', fontSize: '', textAlign: '' },
            ff_number: { color: '#ffffff', fontSize: '', textAlign: '' },
            ff_text: { color: 'rgba(255,255,255,0.8)', fontSize: '', textAlign: '' },
            why_title_item: { color: '#011c1a', fontSize: '', textAlign: '' },
            why_desc_item: { color: '#5f5d5d', fontSize: '', textAlign: '' },
            wf: { color: '#011c1a', fontSize: '', textAlign: '' },
        },

        devSections: [
            {
                title: 'Hos Geldiniz',
                desc: 'Sayfanin en ust kismi — slider alani',
                color: '#84994F',
                fields: [
                    { key: 'welcome_label', label: 'Etiket', desc: 'Ust kucuk yazi (orn: "ONLINE EGITIM")' },
                    { key: 'welcome_title', label: 'Baslik', desc: 'Ana buyuk baslik' },
                    { key: 'welcome_description', label: 'Aciklama', desc: 'Basligin altindaki paragraf' },
                    { key: 'welcome_stat_number', label: 'Sayac Numarasi', desc: 'Istatistik rakami (orn: "200+")' },
                    { key: 'welcome_stat_text', label: 'Sayac Metni', desc: 'Istatistik aciklamasi (orn: "Ogrenci")' },
                ]
            },
            {
                title: 'Kurs Kategorileri',
                desc: 'Kategori kartlarinin ust baslik alani',
                color: '#543EE8',
                fields: [
                    { key: 'categories_label', label: 'Etiket', desc: 'Ust kucuk yazi' },
                    { key: 'categories_title', label: 'Baslik', desc: 'Bolum basligi' },
                    { key: 'categories_button_text', label: 'Buton Yazisi', desc: '"Tumu" butonu' },
                ]
            },
            {
                title: 'Ozellikler',
                desc: 'Koyu arka planli ozellik kartlari',
                color: '#011c1a',
                fields: [
                    { key: 'feat_title', label: 'Basliklar', desc: 'Her ozellik kartinin basligi' },
                    { key: 'feat_desc', label: 'Aciklamalar', desc: 'Her ozellik kartinin aciklamasi' },
                ]
            },
            {
                title: 'Online Kurslar',
                desc: 'Kurs listesi bolumu',
                color: '#543EE8',
                fields: [
                    { key: 'courses_label', label: 'Etiket', desc: 'Ust kucuk yazi' },
                    { key: 'courses_title', label: 'Baslik', desc: 'Bolum basligi' },
                ]
            },
            {
                title: 'Neden Biz',
                desc: 'Avantajlar ve nedenler bolumu',
                color: '#20B9AB',
                fields: [
                    { key: 'why_label', label: 'Etiket', desc: 'Ust kucuk yazi' },
                    { key: 'why_title', label: 'Baslik', desc: 'Bolum basligi' },
                    { key: 'why_description', label: 'Aciklama', desc: 'Baslik altindaki paragraf' },
                    { key: 'why_stat_number', label: 'Sayac Numarasi', desc: 'Istatistik rakami' },
                    { key: 'why_stat_text', label: 'Sayac Metni', desc: 'Istatistik aciklamasi' },
                    { key: 'why_title_item', label: 'Madde Basliklari', desc: 'Her maddenin basligi' },
                    { key: 'why_desc_item', label: 'Madde Aciklamalari', desc: 'Her maddenin aciklamasi' },
                ]
            },
            {
                title: 'Istatistikler (Fun-Fact)',
                desc: 'Resimli sayac bolumu',
                color: '#543EE8',
                fields: [
                    { key: 'ff_number', label: 'Sayilar', desc: 'Buyuk rakamlar (orn: "500+")' },
                    { key: 'ff_text', label: 'Metinler', desc: 'Rakamlarin altindaki aciklama' },
                ]
            },
            {
                title: 'Is Ortaklari',
                desc: 'Logo slider ustu metin',
                color: '#011c1a',
                fields: [
                    { key: 'client_logo_text', label: 'Metin', desc: 'Logolarin ustundeki yazi' },
                ]
            },
            {
                title: 'Yorumlar',
                desc: 'Ogrenci yorumlari / testimonial bolumu',
                color: '#DF4343',
                fields: [
                    { key: 'testimonial_label', label: 'Etiket', desc: 'Ust kucuk yazi' },
                    { key: 'testimonial_title', label: 'Baslik', desc: 'Bolum basligi' },
                    { key: 'testimonial_stat_number', label: 'Sayac Numarasi', desc: 'Istatistik rakami' },
                    { key: 'testimonial_stat_text', label: 'Sayac Metni', desc: 'Istatistik aciklamasi' },
                ]
            },
            {
                title: 'Blog',
                desc: 'Son yazilar bolumu',
                color: '#543EE8',
                fields: [
                    { key: 'blog_label', label: 'Etiket', desc: 'Ust kucuk yazi' },
                    { key: 'blog_title', label: 'Baslik', desc: 'Bolum basligi' },
                ]
            },
            {
                title: 'CTA',
                desc: 'Footer ustundeki aksiyon cagrisi bolumu',
                color: '#FFCD20',
                fields: [
                    { key: 'cta_label', label: 'Etiket', desc: 'Ust kucuk yazi' },
                    { key: 'cta_title', label: 'Baslik', desc: 'Buyuk baslik' },
                    { key: 'cta_description', label: 'Aciklama', desc: 'Baslik altindaki paragraf' },
                    { key: 'cta_button_text', label: 'Buton Yazisi', desc: 'Aksiyon butonu metni' },
                ]
            },
            {
                title: 'Welcome Maddeleri',
                desc: 'Hos geldiniz alanindaki liste maddeleri',
                color: '#84994F',
                fields: [
                    { key: 'wf', label: 'Madde Metni', desc: 'Her bir liste maddesi' },
                ]
            },
        ],

        // Developer panel helpers — customDefaults stores objects: { color, fontSize, textAlign }
        // Legacy flat string values (from old DB data) are normalised on read.
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
            // Force Alpine reactivity
            this.customDefaults = { ...this.customDefaults };
        },

        // Resolve the default for a given field — returns an object { color, fontSize, textAlign }
        _getDefaults(field) {
            // 1. Exact match in custom defaults
            let d = this._normDef(this.customDefaults[field]);
            if (d) return d;
            // 2. Prefix-based fallbacks for array items
            if (field.startsWith('wf_')) d = this._normDef(this.customDefaults['wf']);
            else if (field.startsWith('ff_number_')) d = this._normDef(this.customDefaults['ff_number']);
            else if (field.startsWith('ff_text_')) d = this._normDef(this.customDefaults['ff_text']);
            else if (field.startsWith('why_title_')) d = this._normDef(this.customDefaults['why_title_item']);
            else if (field.startsWith('why_desc_')) d = this._normDef(this.customDefaults['why_desc_item']);
            else if (field.startsWith('feat_title_')) d = this._normDef(this.customDefaults['feat_title']);
            else if (field.startsWith('feat_desc_')) d = this._normDef(this.customDefaults['feat_desc']);
            if (d) return d;
            // 3. Hardcoded defaults
            const hKey = field.startsWith('wf_') ? 'wf'
                       : field.startsWith('ff_number_') ? 'ff_number'
                       : field.startsWith('ff_text_') ? 'ff_text'
                       : field.startsWith('why_title_') ? 'why_title_item'
                       : field.startsWith('why_desc_') ? 'why_desc_item'
                       : field.startsWith('feat_title_') ? 'feat_title'
                       : field.startsWith('feat_desc_') ? 'feat_desc'
                       : field;
            return this.hardcodedDefaults[hKey] || { color: '#011c1a', fontSize: '', textAlign: '' };
        },

        getDefaultColor(field) {
            return this._getDefaults(field).color || '#011c1a';
        },
        getStyleProp(prop) {
            const s = this.fieldStyles[this.modalField] || {};
            return s[prop] !== undefined ? s[prop] : '';
        },
        setStyleProp(prop, value) {
            if (!this.fieldStyles[this.modalField]) this.fieldStyles[this.modalField] = {};
            this.fieldStyles[this.modalField][prop] = value;
        },
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

        openArrayModal(arrayName, index, field, label, type = 'text') {
            this._arrayTarget = { arrayName, index, field };
            this._iconTarget = null;
            this._wfTarget = -1;
            const prefix = arrayName === 'features' ? 'feat' : (arrayName === 'funfact_items' ? 'ff' : 'why');
            const suffix = field === 'title' ? 'title' : (field === 'number' ? 'number' : (field === 'text' ? 'text' : 'desc'));
            this.activeField = prefix + '_' + suffix + '_' + index;
            this.modalField = prefix + '_' + suffix + '_' + index;
            this.modalLabel = label;
            this.modalValue = this.fields[arrayName][index][field] || '';
            this.modalType = type;
            this.validationError = '';
            this.modalMaxLength = type === 'textarea' ? 500 : 200;
            this.modal = true;
            this.$nextTick(() => {
                const input = this.$refs.modalTextarea;
                if (input) input.focus();
            });
        },

        openModal(field, label, type = 'text') {
            this._iconTarget = null;
            this._arrayTarget = null;
            this._wfTarget = -1;
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
                this.imgPreview = val ? (val.startsWith('http') ? val : this.baseUrl + '/' + val) : '';
            }

            this.$nextTick(() => {
                const input = this.$refs.modalTextarea;
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

            // Handle welcome feature targets
            if (this._wfTarget >= 0) {
                this.fields.welcome_features[this._wfTarget] = this.modalValue;
                this._wfTarget = -1;
            // Handle array text/textarea targets (features title/desc, why_items title/desc)
            } else if (this._arrayTarget) {
                const t = this._arrayTarget;
                this.fields[t.arrayName][t.index][t.field] = this.modalValue;
                this._arrayTarget = null;
            // Handle icon targets for features/why items
            } else if (this._iconTarget) {
                const t = this._iconTarget;
                if (t.type === 'feature') {
                    this.fields.features[t.index].icon = this.modalValue;
                } else if (t.type === 'why') {
                    this.fields.why_items[t.index].icon = this.modalValue;
                }
                this._iconTarget = null;
            } else {
                this.fields[this.modalField] = this.modalValue;
            }
            this.modal = false;
            this.activeField = '';
            await this.saveAll();
        },

        getMaxLength(field) {
            const limits = {
                welcome_label: 60, welcome_title: 200, welcome_description: 500,
                welcome_stat_text: 60, welcome_stat_number: 20,
                categories_label: 60, categories_title: 200, categories_button_text: 50, categories_button_url: 500,
                why_label: 60, why_title: 200, why_description: 500,
                why_stat_text: 60, why_stat_number: 20,
                client_logo_text: 200,
                courses_label: 60, courses_title: 200,
                blog_label: 60, blog_title: 200,
                testimonial_label: 60, testimonial_title: 200, testimonial_stat_text: 60, testimonial_stat_number: 20,
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
                formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}');

                const jsonFields = ['welcome_features', 'features', 'why_items', 'funfact_items'];
                for (const [key, value] of Object.entries(this.fields)) {
                    if (jsonFields.includes(key)) {
                        formData.append(key, JSON.stringify(value));
                    } else {
                        formData.append(key, value || '');
                    }
                }

                formData.append('field_styles', JSON.stringify(this.fieldStyles));
                formData.append('default_styles', JSON.stringify(JSON.parse(JSON.stringify(this.customDefaults))));

                const res = await fetch('{{ route('pages.update', ['id' => 'home']) }}', {
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

        async saveDefaults() {
            this.savingDefaults = true;
            try {
                const payload = JSON.parse(JSON.stringify(this.customDefaults));
                const formData = new FormData();
                formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}');
                formData.append('lang', '{{ $selectedLang }}');
                formData.append('default_styles', JSON.stringify(payload));

                const res = await fetch('{{ route('pages.update', ['id' => 'home']) }}', {
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
