@php
    $defaults = \App\Http\Controllers\Theme\ThemeController::DEFAULTS;
    $mixDefaults = \App\Http\Controllers\Theme\ThemeController::MIX_DEFAULTS;
    $colorOptional = \App\Http\Controllers\Theme\ThemeController::COLOR_OPTIONAL;

    try {
        $saved = \App\Models\Setting::getGroup(\App\Http\Controllers\Theme\ThemeController::GROUP);
        $saved = array_filter($saved, fn ($v) => $v !== null && $v !== '');
    } catch (\Throwable $e) {
        $saved = [];
    }

    $sb = array_merge($defaults, array_intersect_key($saved, $defaults));
    $sbOptional = array_intersect_key($saved, $colorOptional);
    $sbMixes = array_merge($mixDefaults, array_map('intval', array_intersect_key($saved, $mixDefaults)));
@endphp
<style>
    :root {
        --sb-bg:                  {{ $sb['sidebar_bg'] }};
        --sb-border:              {{ $sb['sidebar_border'] }};
        --sb-section-title:       {{ $sb['section_title_text'] }};
        --sb-divider:             {{ $sb['section_divider'] }};
        --sb-menu-text:           {{ $sb['menu_text'] }};
        --sb-menu-text-active:    {{ $sb['menu_text_active'] }};
        --sb-menu-bg-active:      {{ $sb['menu_bg_active'] }};
        --sb-menu-bg-hover:       {{ $sb['menu_bg_hover'] }};
        --sb-icon-bg:             {{ $sb['icon_bg'] }};
        --sb-icon-text:           {{ $sb['icon_text'] }};
        --sb-icon-bg-active:      {{ $sb['icon_bg_active'] }};
        --sb-icon-text-active:    {{ $sb['icon_text_active'] }};
        --sb-submenu-text:        {{ $sb['submenu_text'] }};
        --sb-submenu-text-active: {{ $sb['submenu_text_active'] }};
        --sb-submenu-bg-active:   {{ $sb['submenu_bg_active'] }};
        --sb-submenu-bg-hover:    {{ $sb['submenu_bg_hover'] }};
        --sb-avatar-from:         {{ $sb['avatar_from'] }};
        --sb-avatar-to:           {{ $sb['avatar_to'] }};

        /* Butonlar */
        --btn-primary-from:       {{ $sb['btn_primary_from'] }};
        --btn-primary-to:         {{ $sb['btn_primary_to'] }};
        --btn-primary-text:       {{ $sb['btn_primary_text'] }};
        --btn-secondary-bg:       {{ $sb['btn_secondary_bg'] }};
        --btn-secondary-text:     {{ $sb['btn_secondary_text'] }};
        --btn-secondary-border:   {{ $sb['btn_secondary_border'] }};
        --btn-danger-bg:          {{ $sb['btn_danger_bg'] }};
        --btn-danger-text:        {{ $sb['btn_danger_text'] }};

        /* Panel renkleri (opsiyonel override — boş ise sidebar paletinden türetilir) */
        --panel-bg-base:          {{ !empty($sbOptional['panel_bg'])    ? $sbOptional['panel_bg']    : 'var(--sb-bg)' }};
        --card-bg-base:           {{ !empty($sbOptional['card_bg'])     ? $sbOptional['card_bg']     : 'var(--sb-bg)' }};
        --card-border-base:       {{ !empty($sbOptional['card_border']) ? $sbOptional['card_border'] : 'var(--sb-border)' }};
        --form-bg-base:           {{ !empty($sbOptional['form_bg'])     ? $sbOptional['form_bg']     : 'var(--sb-bg)' }};
        --hover-bg-base:          {{ !empty($sbOptional['hover_bg'])    ? $sbOptional['hover_bg']    : 'var(--btn-primary-from)' }};
        --badge-bg-base:          {{ !empty($sbOptional['badge_bg'])    ? $sbOptional['badge_bg']    : 'var(--btn-primary-from)' }};

        /* Yoğunluklar (%) */
        --panel-bg-mix:           {{ $sbMixes['panel_bg_mix'] }}%;
        --card-bg-mix:            {{ $sbMixes['card_bg_mix'] }}%;
        --card-border-mix:        {{ $sbMixes['card_border_mix'] }}%;
        --form-bg-mix:            {{ $sbMixes['form_bg_mix'] }}%;
        --hover-bg-mix:           {{ $sbMixes['hover_bg_mix'] }}%;
        --hover-bg-strong-mix:    {{ $sbMixes['hover_bg_strong_mix'] }}%;
        --badge-bg-mix:           {{ $sbMixes['badge_bg_mix'] }}%;
    }

    /* ============================================================
       Sidebar tema override'ları (Tailwind class'larını ezer)
       ============================================================ */

    /* Sidebar arka plan + dış çerçeve */
    aside.sidebar-logo,
    body > aside {
        background-color: var(--sb-bg) !important;
        border-right-color: var(--sb-border) !important;
    }
    body > aside .sidebar-logo,
    body > aside .sidebar-user {
        border-color: var(--sb-border) !important;
    }

    /* Section başlığı (Eğitim, Görünüm) */
    body > aside nav > div > p {
        color: var(--sb-section-title) !important;
    }

    /* Section divider çizgisi */
    body > aside nav > div > div.border-t,
    body > aside nav > div > .mx-3.border-t,
    body > aside nav > div > div.mx-auto.border-t {
        border-color: var(--sb-divider) !important;
    }

    /* ---- Ana menü item'ları ---- */

    /* Aktif menü (bg-fuchsia-50 + text-fuchsia-600) */
    body > aside nav > a.bg-fuchsia-50,
    body > aside nav > div > button.bg-fuchsia-50,
    body > aside nav > a > .bg-fuchsia-50,
    body > aside nav > div > button .bg-fuchsia-50 {
        background-color: var(--sb-menu-bg-active) !important;
    }
    body > aside nav > a.text-fuchsia-600,
    body > aside nav > div > button.text-fuchsia-600 {
        color: var(--sb-menu-text-active) !important;
    }

    /* Normal menü text */
    body > aside nav > a.text-slate-600,
    body > aside nav > div > button.text-slate-600 {
        color: var(--sb-menu-text) !important;
    }

    /* Menü hover */
    body > aside nav > a:hover,
    body > aside nav > div > button:hover {
        background-color: var(--sb-menu-bg-hover) !important;
    }
    /* Aktif menüde hover'ı bozma */
    body > aside nav > a.bg-fuchsia-50:hover,
    body > aside nav > div > button.bg-fuchsia-50:hover {
        background-color: var(--sb-menu-bg-active) !important;
    }

    /* ---- İkonlar ---- */

    /* Normal icon kutusu */
    body > aside nav a > div.bg-slate-100,
    body > aside nav div > button > div.bg-slate-100 {
        background-color: var(--sb-icon-bg) !important;
        color: var(--sb-icon-text) !important;
    }
    body > aside nav a > div.bg-slate-100 svg,
    body > aside nav div > button > div.bg-slate-100 svg {
        color: var(--sb-icon-text) !important;
    }

    /* Aktif icon kutusu */
    body > aside nav a > div.bg-fuchsia-500,
    body > aside nav div > button > div.bg-fuchsia-500 {
        background-color: var(--sb-icon-bg-active) !important;
        color: var(--sb-icon-text-active) !important;
    }
    body > aside nav a > div.bg-fuchsia-500 svg,
    body > aside nav div > button > div.bg-fuchsia-500 svg {
        color: var(--sb-icon-text-active) !important;
    }

    /* ---- Alt menüler (.ml-12 ile başlar) ---- */

    body > aside nav .ml-12 a {
        color: var(--sb-submenu-text) !important;
    }
    body > aside nav .ml-12 a.text-fuchsia-600,
    body > aside nav .ml-12 a.bg-fuchsia-50 {
        color: var(--sb-submenu-text-active) !important;
        background-color: var(--sb-submenu-bg-active) !important;
    }
    body > aside nav .ml-12 a:hover:not(.bg-fuchsia-50) {
        background-color: var(--sb-submenu-bg-hover) !important;
    }

    /* Flyout submenu (collapsed sidebar) */
    body > aside .lg\:group-hover\/kurs\:block a,
    body > aside .lg\:group-hover\/blog\:block a,
    body > aside .lg\:group-hover\/magaza\:block a,
    body > aside .lg\:group-hover\/users\:block a {
        color: var(--sb-submenu-text) !important;
    }
    body > aside [class*="group-hover"] a.bg-fuchsia-50,
    body > aside [class*="group-hover"] a.text-fuchsia-600 {
        color: var(--sb-submenu-text-active) !important;
        background-color: var(--sb-submenu-bg-active) !important;
    }

    /* ---- Avatar gradient (sidebar alt + collapsed logo "C" rozet) ---- */

    body > aside .from-fuchsia-500.to-purple-600 {
        background-image: linear-gradient(to bottom right, var(--sb-avatar-from), var(--sb-avatar-to)) !important;
    }

    /* ---- Gölge renklerini tema rengine bağla (varsayılan fuchsia gölgeyi ezer) ---- */

    /* Aktif menü icon kutusu gölgesi */
    body > aside nav a > div.bg-fuchsia-500.shadow-lg,
    body > aside nav div > button > div.bg-fuchsia-500.shadow-lg {
        --tw-shadow-color: transparent !important;
        box-shadow:
            0 10px 15px -3px color-mix(in srgb, var(--sb-icon-bg-active) 35%, transparent),
            0 4px 6px -4px  color-mix(in srgb, var(--sb-icon-bg-active) 25%, transparent) !important;
    }

    /* Avatar / collapsed "C" rozet gölgesi */
    body > aside .from-fuchsia-500.to-purple-600.shadow-lg,
    body > aside .from-fuchsia-500.to-purple-600.shadow-md {
        --tw-shadow-color: transparent !important;
        box-shadow:
            0 10px 15px -3px color-mix(in srgb, var(--sb-avatar-to) 30%, transparent),
            0 4px 6px -4px  color-mix(in srgb, var(--sb-avatar-to) 20%, transparent) !important;
    }

    /* ============================================================
       Buton Tema (sidebar dışı tüm butonlar)
       ============================================================ */

    /* Ortak buton görünümü (component için) */
    .btn-themed {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 600;
        border-radius: 0.75rem;
        border: 1px solid transparent;
        transition: all 200ms cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }
    .btn-themed:active:not(:disabled) { transform: scale(0.98); }
    .btn-themed:disabled, .btn-themed[aria-disabled="true"] {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .btn-themed--primary {
        background-image: linear-gradient(to right, var(--btn-primary-from), var(--btn-primary-to));
        color: var(--btn-primary-text);
        box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--btn-primary-to) 25%, transparent),
                    0 4px  6px -4px color-mix(in srgb, var(--btn-primary-to) 15%, transparent);
    }
    .btn-themed--primary:hover:not(:disabled) { filter: brightness(1.15); }

    .btn-themed--secondary {
        background-color: var(--btn-secondary-bg);
        color: var(--btn-secondary-text);
        border-color: var(--btn-secondary-border);
    }
    .btn-themed--secondary:hover:not(:disabled) { filter: brightness(0.97); }

    .btn-themed--danger {
        background-color: var(--btn-danger-bg);
        color: var(--btn-danger-text);
        box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--btn-danger-bg) 25%, transparent),
                    0 4px  6px -4px color-mix(in srgb, var(--btn-danger-bg) 15%, transparent);
    }
    .btn-themed--danger:hover:not(:disabled) { filter: brightness(1.1); }

    /* ----------------------------------------------------------------
       Mevcut hardcoded Tailwind buton class'larını yakala
       (sidebar HARİÇ — aside içindekiler kendi temasını kullanır)
       ---------------------------------------------------------------- */

    /* Birincil: gradient fuchsia → purple (Kaydet, Siteyi Gör, vb.) */
    :is(button, a).bg-gradient-to-r.from-fuchsia-500.to-purple-600:not(aside *) {
        background-image: linear-gradient(to right, var(--btn-primary-from), var(--btn-primary-to)) !important;
        color: var(--btn-primary-text) !important;
        --tw-shadow-color: color-mix(in srgb, var(--btn-primary-to) 25%, transparent) !important;
        box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--btn-primary-to) 25%, transparent),
                    0 4px 6px -4px  color-mix(in srgb, var(--btn-primary-to) 15%, transparent) !important;
    }
    :is(button, a).bg-gradient-to-r.from-fuchsia-500.to-purple-600:not(aside *):hover {
        filter: brightness(1.15);
        background-image: linear-gradient(to right, var(--btn-primary-from), var(--btn-primary-to)) !important;
    }

    /* İkincil: slate-100 bg + slate-600/700 text (Vazgeç, İptal) */
    :is(button, a).bg-slate-100:not(aside *):not(.glass *) {
        background-color: var(--btn-secondary-bg) !important;
        color: var(--btn-secondary-text) !important;
    }
    :is(button, a).bg-slate-100:not(aside *):not(.glass *):hover {
        filter: brightness(0.97);
        background-color: var(--btn-secondary-bg) !important;
    }

    /* Tehlike: red-500/600 bg (Sil, Onayla danger modal) */
    :is(button, a).bg-red-500:not(aside *),
    :is(button, a).bg-red-600:not(aside *),
    :is(button, a).bg-gradient-to-r.from-red-500:not(aside *) {
        background-color: var(--btn-danger-bg) !important;
        background-image: none !important;
        color: var(--btn-danger-text) !important;
        --tw-shadow-color: color-mix(in srgb, var(--btn-danger-bg) 25%, transparent) !important;
    }
    :is(button, a).bg-red-500:not(aside *):hover,
    :is(button, a).bg-red-600:not(aside *):hover,
    :is(button, a).bg-gradient-to-r.from-red-500:not(aside *):hover {
        filter: brightness(1.1);
    }

    /* ============================================================
       Panel geneli (sidebar paletinden türetilir)
       Body, navbar, kartlar ve form yüzeyleri sidebar ile uyumlu hale gelir.
       ============================================================ */

    /* Body background */
    body.bg-slate-100 {
        background-color: color-mix(in srgb, var(--panel-bg-base) var(--panel-bg-mix), #f1f5f9) !important;
    }

    /* Topbar (navbar) — body > div içindeki nav */
    body > div > nav.bg-white,
    body > div > nav.dark\:bg-slate-800 {
        background-color: var(--panel-bg-base) !important;
        border-bottom-color: var(--card-border-base) !important;
    }

    /* Footer */
    body > div > footer {
        border-top-color: var(--card-border-base) !important;
    }

    /* Ana içerik kartları */
    main .bg-white.rounded-2xl:not(aside *),
    main .bg-white.rounded-3xl:not(aside *) {
        background-color: color-mix(in srgb, var(--card-bg-base) var(--card-bg-mix), #ffffff) !important;
    }

    /* Kart border'ları */
    main .border-slate-200:not(aside *),
    main .border-slate-200\/50:not(aside *),
    main .border-slate-100:not(aside *) {
        border-color: color-mix(in srgb, var(--card-border-base) var(--card-border-mix), #e2e8f0) !important;
    }

    /* Form yüzeyleri */
    main textarea.bg-slate-50:not(aside *),
    main input.bg-slate-50:not(aside *),
    main select.bg-slate-50:not(aside *) {
        background-color: color-mix(in srgb, var(--form-bg-base) var(--form-bg-mix), #f8fafc) !important;
    }

    /* Ring/border */
    main .ring-slate-200:not(aside *) {
        --tw-ring-color: color-mix(in srgb, var(--card-border-base) var(--card-border-mix), #e2e8f0) !important;
    }

    /* Page banner heading (ana başlıklar) */
    main h1.text-slate-900:not(aside *) {
        color: var(--sb-menu-text-active) !important;
    }

    /* ============================================================
       CTA gradient butonlar (Yeni Kayıt, Yeni Blog Yazısı, ...)
       — from-fuchsia-500 ile başlayan tüm to-* varyantları yakalanır
       ============================================================ */
    :is(button, a).bg-gradient-to-r.from-fuchsia-500:not(aside *) {
        background-image: linear-gradient(to right, var(--btn-primary-from), var(--btn-primary-to)) !important;
        color: var(--btn-primary-text) !important;
        --tw-shadow-color: color-mix(in srgb, var(--btn-primary-to) 25%, transparent) !important;
        box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--btn-primary-to) 25%, transparent),
                    0 4px 6px -4px  color-mix(in srgb, var(--btn-primary-to) 15%, transparent) !important;
    }
    :is(button, a).bg-gradient-to-r.from-fuchsia-500:not(aside *):hover {
        filter: brightness(1.15);
        background-image: linear-gradient(to right, var(--btn-primary-from), var(--btn-primary-to)) !important;
    }

    /* ============================================================
       Toggle'lar (peer-checked:bg-fuchsia-500 / bg-emerald-500)
       ============================================================ */
    .peer:checked ~ .peer-checked\:bg-fuchsia-500:not(aside *),
    .peer:checked ~ .peer-checked\:bg-emerald-500:not(aside *) {
        background-color: var(--btn-primary-from) !important;
    }

    /* ============================================================
       Badge'ler ve label'lar (fuchsia paleti)
       — "1 slayt", "3 aktif", count badge gibi yerler temaya uyar
       ============================================================ */

    /* Hafif badge (bg-fuchsia-50/100) */
    .bg-fuchsia-50:not(aside *),
    .bg-fuchsia-100:not(aside *) {
        background-color: color-mix(in srgb, var(--badge-bg-base) var(--badge-bg-mix), transparent) !important;
    }

    /* Dolu badge / count (bg-fuchsia-500) — peer-checked override'ından sonra normal kullanım */
    span.bg-fuchsia-500:not(aside *),
    div.bg-fuchsia-500:not(aside *) {
        background-color: var(--btn-primary-from) !important;
    }

    /* Fuchsia text renkleri */
    .text-fuchsia-400:not(aside *),
    .text-fuchsia-500:not(aside *),
    .text-fuchsia-600:not(aside *),
    .text-fuchsia-700:not(aside *) {
        color: var(--btn-primary-from) !important;
    }

    /* Fuchsia border'lar (radio kart seçimi, vurgu border'ları) */
    .border-fuchsia-300:not(aside *),
    .border-fuchsia-400:not(aside *),
    .border-fuchsia-500:not(aside *),
    .border-fuchsia-600:not(aside *) {
        border-color: var(--btn-primary-from) !important;
    }

    /* Hover varyantları (link hover, ikon hover, dropdown item) */
    .hover\:text-fuchsia-400:not(aside *):hover,
    .hover\:text-fuchsia-500:not(aside *):hover,
    .hover\:text-fuchsia-600:not(aside *):hover,
    .hover\:text-fuchsia-700:not(aside *):hover {
        color: var(--btn-primary-from) !important;
    }
    /* Hover BG: white base ile karış */
    .hover\:bg-fuchsia-50:not(aside *):hover,
    .hover\:bg-fuchsia-100:not(aside *):hover {
        background-color: color-mix(in srgb, var(--hover-bg-base) var(--hover-bg-mix), #ffffff) !important;
    }
    [class*="hover\:bg-fuchsia-500/"]:not(aside *):hover {
        background-color: color-mix(in srgb, var(--hover-bg-base) var(--hover-bg-strong-mix), #ffffff) !important;
    }
    /* Hover border (image-upload, drop zone) */
    .hover\:border-fuchsia-400:not(aside *):hover,
    .hover\:border-fuchsia-500:not(aside *):hover {
        border-color: var(--btn-primary-from) !important;
    }

    /* ============================================================
       group-hover varyantları (image-upload, kart hover'ları)
       — daha yüksek specificity için .group:hover ön ek ile
       ============================================================ */
    .group:hover .group-hover\:bg-fuchsia-50:not(aside *),
    .group:hover .group-hover\:bg-fuchsia-100:not(aside *) {
        background-color: color-mix(in srgb, var(--hover-bg-base) var(--hover-bg-strong-mix), #ffffff) !important;
    }
    .group:hover .group-hover\:text-fuchsia-400:not(aside *),
    .group:hover .group-hover\:text-fuchsia-500:not(aside *),
    .group:hover .group-hover\:text-fuchsia-600:not(aside *) {
        color: var(--btn-primary-from) !important;
    }

    /* ============================================================
       Sıcak gradient ikon kutuları ve butonlar (fuchsia/purple/amber/orange)
       — SADECE -500/-600 tonları (kart bg overlay'lerindeki -50/-100 hariç)
       — mavi (blue/indigo) ve emerald hariç (translate / görünür için)
       ============================================================ */
    :is(.from-fuchsia-500, .from-fuchsia-600,
        .from-purple-500,  .from-purple-600,
        .from-amber-500,   .from-amber-600,
        .from-orange-500,  .from-orange-600
    ):is(.bg-gradient-to-r, .bg-gradient-to-br, .bg-gradient-to-tr, .bg-gradient-to-bl):not(aside *) {
        background-image: linear-gradient(135deg, var(--btn-primary-from), var(--btn-primary-to)) !important;
        color: var(--btn-primary-text) !important;
    }
    :is(.from-fuchsia-500, .from-fuchsia-600,
        .from-purple-500,  .from-purple-600,
        .from-amber-500,   .from-amber-600,
        .from-orange-500,  .from-orange-600
    ):is(.bg-gradient-to-r, .bg-gradient-to-br):not(aside *):hover {
        filter: brightness(1.1);
    }

    /* Shadow renkleri (shadow-fuchsia-500/25, shadow-amber-500/20 ...) — primary ile uyum */
    :is(.shadow-fuchsia-500, .shadow-fuchsia-600,
        .shadow-purple-500,  .shadow-purple-600,
        .shadow-amber-500,   .shadow-amber-600,
        .shadow-orange-500,  .shadow-orange-600
    ):not(aside *),
    [class*="shadow-fuchsia-500/"]:not(aside *),
    [class*="shadow-purple-500/"]:not(aside *),
    [class*="shadow-amber-500/"]:not(aside *),
    [class*="shadow-orange-500/"]:not(aside *) {
        --tw-shadow-color: color-mix(in srgb, var(--btn-primary-to) 25%, transparent) !important;
    }

    /* ============================================================
       Form elementleri (range slider accent, input focus ring/border)
       — tema sayfası, color picker'lar, slider'lar buradan temalanır
       ============================================================ */
    .accent-fuchsia-500:not(aside *),
    [class*="accent-fuchsia-"]:not(aside *) {
        accent-color: var(--btn-primary-from) !important;
    }
    [class*="focus\:ring-fuchsia-"]:not(aside *):focus {
        --tw-ring-color: color-mix(in srgb, var(--btn-primary-from) 30%, transparent) !important;
    }
    [class*="focus\:border-fuchsia-"]:not(aside *):focus {
        border-color: var(--btn-primary-from) !important;
    }
</style>
