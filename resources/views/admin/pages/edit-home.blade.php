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
            <button type="button" @click="saveAll()" :disabled="saving"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-fuchsia-500 to-purple-500 hover:from-fuchsia-600 hover:to-purple-600 text-white font-semibold rounded-xl text-sm shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                <svg x-show="!saving" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                <svg x-show="saving" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                Kaydet
            </button>
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
                                                <span x-text="(fields.welcome_stat_number || '9394') + '+'" style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.75rem; font-weight: 700; line-height: 1.73; color: #DF4343;"></span>
                                            </div>
                                            <div class="ez" :class="activeField === 'welcome_stat_text' && 'ez-active'" data-label="Duzenle" @click="openModal('welcome_stat_text', 'Sayac Metni')">
                                                <span x-text="fields.welcome_stat_text || 'Enrolled Learners'" style="color: rgb(95 93 93);"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Right: Text --}}
                                <div>
                                    <div style="margin-bottom: 1.5rem;">
                                        <div class="ez" :class="activeField === 'welcome_label' && 'ez-active'" data-label="Duzenle" @click="openModal('welcome_label', 'Ust Etiket')" style="margin-bottom: 1.25rem;">
                                            <span x-text="fields.welcome_label || 'WELCOME TO PAROSIS'" style="display: block; text-transform: uppercase; font-size: 1rem; color: #84994F;"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'welcome_title' && 'ez-active'" data-label="Duzenle" @click="openModal('welcome_title', 'Baslik')">
                                            <h2 x-text="fields.welcome_title || 'Digital Online Academy: Your Path to Creative Excellence'"></h2>
                                        </div>
                                    </div>
                                    <div class="ez" :class="activeField === 'welcome_description' && 'ez-active'" data-label="Duzenle" @click="openModal('welcome_description', 'Aciklama', 'textarea')" style="margin-top: 1.75rem;">
                                        <p x-text="fields.welcome_description || 'Profesyonel egitmenlerimizle kariyer hedeflerinize ulasmaniz icin en uygun kurslari kesfedin.'" style="color: rgb(95 93 93); line-height: 1.75;"></p>
                                    </div>

                                    {{-- Features list --}}
                                    <ul style="margin-top: 1.5rem; display: flex; flex-direction: column; gap: 1rem; list-style: none; padding: 0;">
                                        <template x-for="(feature, fIdx) in fields.welcome_features" :key="fIdx">
                                            <li style="display: flex; align-items: center; gap: 0.75rem;">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-check.svg') }}" alt="" width="18" height="18" />
                                                <input type="text" x-model="fields.welcome_features[fIdx]" @change="saveAll()" class="s2-input" style="font-size: 1.0625rem;" />
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
                                        <span x-text="fields.categories_label || 'COURSE CATEGORIES'" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                    </div>
                                    <div class="ez" :class="activeField === 'categories_title' && 'ez-active'" data-label="Duzenle" @click="openModal('categories_title', 'Kategoriler Baslik')">
                                        <h2 x-text="fields.categories_title || 'Top Categories You Want to Learn'"></h2>
                                    </div>
                                </div>
                                <div>
                                    <div class="ez" :class="activeField === 'categories_button_text' && 'ez-active'" data-label="Buton Yazisi" @click="openModal('categories_button_text', 'Buton Yazisi')">
                                        <div style="position: relative; display: inline-flex; align-items: center; overflow: hidden; border-radius: 52px; padding: 1rem 70px 1rem 30px; background-color: rgb(84 62 232); color: #fff; font-size: 1rem;">
                                            <span x-text="fields.categories_button_text || 'Find Courses'"></span>
                                            <span style="position: absolute; right: 5px; display: inline-flex; width: 2.75rem; height: 2.75rem; align-items: center; justify-content: center; border-radius: 50%; background: white;">
                                                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="" width="13" height="12" />
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ez" :class="activeField === 'categories_button_url' && 'ez-active'" data-label="Buton Linki" @click="openModal('categories_button_url', 'Buton Linki')" style="margin-top: 8px;">
                                        <span style="font-size: 0.75rem; color: #8D8D8D; display: inline-flex; align-items: center; gap: 4px;">
                                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m9.86-4.318a4.5 4.5 0 0 0-1.242-7.244l4.5-4.5a4.5 4.5 0 0 1 6.364 6.364l-1.757 1.757"/></svg>
                                            <span x-text="fields.categories_button_url || '{{ route('front.courses') }}'"></span>
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
                                            <span x-text="feat.title || 'Baslik...'" style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; font-size: 1.25rem; color: white; margin-bottom: 0.5rem;"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'feat_desc_' + fIdx && 'ez-active'" data-label="Aciklama" @click="openArrayModal('features', fIdx, 'description', 'Ozellik Aciklamasi', 'textarea')">
                                            <span x-text="feat.description || 'Aciklama...'" style="font-size: 0.875rem; color: rgba(255,255,255,0.8);"></span>
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
                                    <span x-text="fields.courses_label || 'ONLINE COURSES'" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                </div>
                                <div class="ez" :class="activeField === 'courses_title' && 'ez-active'" data-label="Duzenle" @click="openModal('courses_title', 'Kurslar Baslik')">
                                    <h2 x-text="fields.courses_title || 'Get Your Course With Us'"></h2>
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
                                        <span x-text="fields.why_label || 'WHY CHOOSE US'" style="display: block; text-transform: uppercase; font-size: 1rem; color: rgb(95 93 93);"></span>
                                    </div>
                                    <div class="ez" :class="activeField === 'why_title' && 'ez-active'" data-label="Duzenle" @click="openModal('why_title', 'Baslik')">
                                        <h2 x-text="fields.why_title || 'Transform Your Best Practice with Our Online Course'"></h2>
                                    </div>
                                </div>
                                <div class="ez" :class="activeField === 'why_description' && 'ez-active'" data-label="Duzenle" @click="openModal('why_description', 'Aciklama', 'textarea')" style="margin-top: 1.75rem;">
                                    <p x-text="fields.why_description || 'Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.'" style="color: rgb(95 93 93); line-height: 1.75;"></p>
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
                                                    <span x-text="item.title || 'Baslik...'" style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-weight: 700; font-size: 1.25rem; color: rgb(1 28 26);"></span>
                                                </div>
                                                <div style="display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0;">
                                                    <input type="color" x-model="fields.why_items[wIdx].bg_color" @change="saveAll()" style="width: 28px; height: 28px; border: none; cursor: pointer; border-radius: 6px; padding: 0;" title="Renk Sec" />
                                                    <button type="button" @click="removeWhyItem(wIdx)" class="del-btn" title="Sil">
                                                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="ez" :class="activeField === 'why_desc_' + wIdx && 'ez-active'" data-label="Aciklama" @click="openArrayModal('why_items', wIdx, 'description', 'Madde Aciklamasi', 'textarea')">
                                                <p x-text="item.description || 'Aciklama...'" style="color: rgb(95 93 93); line-height: 1.75;"></p>
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
                                            <span x-text="(fields.why_stat_number || '69K') + '+'" style="display: block; font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 1.75rem; font-weight: 700; line-height: 1.73; color: #DF4343;"></span>
                                        </div>
                                        <div class="ez" :class="activeField === 'why_stat_text' && 'ez-active'" data-label="Duzenle" @click="openModal('why_stat_text', 'Sayac Metni')">
                                            <span x-text="fields.why_stat_text || 'Satisfied Students'" style="color: rgb(95 93 93);"></span>
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
                                                    <span x-text="(item.number || '0') + '+'" style="font-family: 'Aeonik Pro TRIAL', sans-serif; font-size: 2rem; font-weight: 700; color: white;"></span>
                                                </div>
                                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.25rem;">
                                                    <div class="ez" :class="activeField === 'ff_text_' + ffIdx && 'ez-active'" data-label="Metin" @click="openArrayModal('funfact_items', ffIdx, 'text', 'Istatistik Metni')" style="flex: 1;">
                                                        <span x-text="item.text || 'Metin...'" style="color: rgba(255,255,255,0.8); font-size: 0.875rem;"></span>
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
                                    <p x-text="fields.client_logo_text || 'Get in touch with the 250+ companies who Collaboration us'" style="font-size: 1.125rem; color: rgb(1 28 26);"></p>
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
            <div style="padding: 2rem 1.25rem;"><div style="border-top: 2px dashed #E5E7EB; margin: 0 auto; max-width: 1200px; position: relative;"><span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 16px; font-size: 0.75rem; font-weight: 700; color: #A0A0A0; text-transform: uppercase; letter-spacing: 0.05em; font-family: Inter, sans-serif;">Blog</span></div></div>

            {{-- ── Blog Section ── --}}
            <div>
                <div style="background: white;">
                    <div style="padding: 50px 0;">
                        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
                            <div style="max-width: 480px; margin: 0 auto; text-align: center; margin-bottom: 3rem;">
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
        },

        // Welcome features
        addWelcomeFeature() {
            this.fields.welcome_features.push('');
        },
        removeWelcomeFeature(index) {
            this.fields.welcome_features.splice(index, 1);
            this.saveAll();
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

        openArrayModal(arrayName, index, field, label, type = 'text') {
            this._arrayTarget = { arrayName, index, field };
            this._iconTarget = null;
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
                const input = this.$refs.modalInput || this.$refs.modalTextarea;
                if (input) input.focus();
            });
        },

        openModal(field, label, type = 'text') {
            this._iconTarget = null;
            this._arrayTarget = null;
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
        },

        async applyAndSave() {
            this.validateField();
            if (this.validationError) return;

            // Handle array text/textarea targets (features title/desc, why_items title/desc)
            if (this._arrayTarget) {
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

                const jsonFields = ['welcome_features', 'features', 'why_items', 'funfact_items'];
                for (const [key, value] of Object.entries(this.fields)) {
                    if (jsonFields.includes(key)) {
                        formData.append(key, JSON.stringify(value));
                    } else {
                        formData.append(key, value || '');
                    }
                }

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
