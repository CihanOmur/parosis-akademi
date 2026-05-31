@php
    $defaults = \App\Http\Controllers\Theme\ThemeController::DEFAULTS;
    try {
        $saved = \App\Models\Setting::getGroup(\App\Http\Controllers\Theme\ThemeController::GROUP);
        $saved = array_filter($saved, fn ($v) => !empty($v));
    } catch (\Throwable $e) {
        $saved = [];
    }
    $sb = array_merge($defaults, $saved);
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
</style>
