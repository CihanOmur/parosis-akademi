<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ThemeController extends Controller
{
    public const GROUP = 'sidebar_theme';

    /**
     * Zorunlu renkler — sidebar paleti + butonlar.
     */
    public const DEFAULTS = [
        // Genel
        'sidebar_bg'              => '#ffffff',
        'sidebar_border'          => '#e5e7eb',
        'section_title_text'      => '#9ca3af',
        'section_divider'         => '#e5e7eb',

        // Ana Menü
        'menu_text'               => '#374151',
        'menu_text_active'        => '#000000',
        'menu_bg_active'          => '#f3f4f6',
        'menu_bg_hover'           => '#f9fafb',

        // İkonlar
        'icon_bg'                 => '#f3f4f6',
        'icon_text'               => '#6b7280',
        'icon_bg_active'          => '#111827',
        'icon_text_active'        => '#ffffff',

        // Alt Menüler
        'submenu_text'            => '#6b7280',
        'submenu_text_active'     => '#000000',
        'submenu_bg_active'       => '#f3f4f6',
        'submenu_bg_hover'        => '#f9fafb',

        // Avatar
        'avatar_from'             => '#374151',
        'avatar_to'               => '#000000',

        // Butonlar
        'btn_primary_from'        => '#374151',
        'btn_primary_to'          => '#000000',
        'btn_primary_text'        => '#ffffff',
        'btn_secondary_bg'        => '#f3f4f6',
        'btn_secondary_text'      => '#374151',
        'btn_secondary_border'    => '#e5e7eb',
        'btn_danger_bg'           => '#dc2626',
        'btn_danger_text'         => '#ffffff',
    ];

    /**
     * Opsiyonel panel renkleri — boş bırakılırsa sidebar paletinden otomatik türetilir.
     * (CSS'te var(--panel-bg-color, var(--sb-bg)) ile fallback olur.)
     */
    public const COLOR_OPTIONAL = [
        'panel_bg'                => '', // Body arka planı (boş = sidebar_bg'den türet)
        'card_bg'                 => '', // Kart arka planı (boş = sidebar_bg'den türet)
        'card_border'             => '', // Kart kenarlık (boş = sidebar_border'dan türet)
        'form_bg'                 => '', // Form input arka planı
        'hover_bg'                => '', // Hover arka plan (link/menu)
        'badge_bg'                => '', // Badge arka planı
    ];

    /**
     * Karışım yoğunlukları (%). Renk override yoksa sidebar paletiyle bu yüzdeden karıştırılır.
     */
    public const MIX_DEFAULTS = [
        'panel_bg_mix'            => 35, // body bg yoğunluğu
        'card_bg_mix'             => 12, // kart bg yoğunluğu
        'card_border_mix'         => 60, // kart border yoğunluğu
        'form_bg_mix'             => 8,  // form input bg
        'hover_bg_mix'            => 22, // link/menu hover
        'hover_bg_strong_mix'     => 26, // bg-fuchsia-500/X hover
        'badge_bg_mix'            => 10, // badge tint
    ];

    /**
     * Form grupları + label'lar.
     */
    public const GROUPS = [
        'Genel' => [
            'sidebar_bg'              => 'Sidebar Arka Plan',
            'sidebar_border'          => 'Sidebar Dış Çerçeve',
            'section_title_text'      => 'Bölüm Başlığı Yazı',
            'section_divider'         => 'Bölüm Ayraç Çizgisi',
        ],
        'Ana Menü' => [
            'menu_text'               => 'Menü Yazısı (Normal)',
            'menu_text_active'        => 'Menü Yazısı (Aktif)',
            'menu_bg_active'          => 'Menü Arka Plan (Aktif)',
            'menu_bg_hover'           => 'Menü Arka Plan (Hover)',
        ],
        'İkonlar' => [
            'icon_bg'                 => 'İkon Kutusu (Normal)',
            'icon_text'               => 'İkon Rengi (Normal)',
            'icon_bg_active'          => 'İkon Kutusu (Aktif)',
            'icon_text_active'        => 'İkon Rengi (Aktif)',
        ],
        'Alt Menüler' => [
            'submenu_text'            => 'Alt Menü Yazısı (Normal)',
            'submenu_text_active'     => 'Alt Menü Yazısı (Aktif)',
            'submenu_bg_active'       => 'Alt Menü Arka Plan (Aktif)',
            'submenu_bg_hover'        => 'Alt Menü Hover',
        ],
        'Avatar' => [
            'avatar_from'             => 'Avatar Gradient (Başlangıç)',
            'avatar_to'               => 'Avatar Gradient (Bitiş)',
        ],
        'Butonlar' => [
            'btn_primary_from'        => 'Birincil (Kaydet) Gradient Başlangıç',
            'btn_primary_to'          => 'Birincil (Kaydet) Gradient Bitiş',
            'btn_primary_text'        => 'Birincil Yazı Rengi',
            'btn_secondary_bg'        => 'İkincil (Vazgeç) Arka Plan',
            'btn_secondary_text'      => 'İkincil Yazı Rengi',
            'btn_secondary_border'    => 'İkincil Çerçeve',
            'btn_danger_bg'           => 'Tehlike (Sil) Arka Plan',
            'btn_danger_text'         => 'Tehlike Yazı Rengi',
        ],
    ];

    /**
     * Panel renkleri (opsiyonel) — boş = sidebar paletinden türet.
     */
    public const PANEL_COLOR_GROUP = [
        'panel_bg'                => 'Panel Arka Planı (boş = otomatik)',
        'card_bg'                 => 'Kart Arka Planı (boş = otomatik)',
        'card_border'             => 'Kart Kenarlık (boş = otomatik)',
        'form_bg'                 => 'Form Alanı Arka Planı (boş = otomatik)',
        'hover_bg'                => 'Hover Arka Planı (boş = otomatik)',
        'badge_bg'                => 'Badge Arka Planı (boş = otomatik)',
    ];

    /**
     * Panel yoğunluk slider'ları.
     */
    public const PANEL_MIX_GROUP = [
        'panel_bg_mix'            => ['label' => 'Panel BG Yoğunluğu', 'min' => 0, 'max' => 100, 'step' => 1],
        'card_bg_mix'             => ['label' => 'Kart BG Yoğunluğu',  'min' => 0, 'max' => 50,  'step' => 1],
        'card_border_mix'         => ['label' => 'Kart Kenarlık Yoğunluğu', 'min' => 0, 'max' => 100, 'step' => 1],
        'form_bg_mix'             => ['label' => 'Form BG Yoğunluğu',  'min' => 0, 'max' => 30,  'step' => 1],
        'hover_bg_mix'            => ['label' => 'Hover Yoğunluğu',    'min' => 0, 'max' => 60,  'step' => 1],
        'hover_bg_strong_mix'     => ['label' => 'Hover (Yoğun) Yoğunluğu', 'min' => 0, 'max' => 70, 'step' => 1],
        'badge_bg_mix'            => ['label' => 'Badge Yoğunluğu',    'min' => 0, 'max' => 50,  'step' => 1],
    ];

    public function edit()
    {
        $saved = Setting::getGroup(self::GROUP);
        $savedFiltered = array_filter($saved, fn ($v) => $v !== null && $v !== '');

        $colors = array_merge(
            self::DEFAULTS,
            self::COLOR_OPTIONAL,
            array_intersect_key($savedFiltered, array_merge(self::DEFAULTS, self::COLOR_OPTIONAL))
        );

        $mixes = array_merge(
            self::MIX_DEFAULTS,
            array_map('intval', array_intersect_key($savedFiltered, self::MIX_DEFAULTS))
        );

        return view('admin.theme.edit', [
            'colors'           => $colors,
            'mixes'            => $mixes,
            'groups'           => self::GROUPS,
            'panelColorGroup'  => self::PANEL_COLOR_GROUP,
            'panelMixGroup'    => self::PANEL_MIX_GROUP,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'colors'   => 'required|array',
            'colors.*' => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'mixes'    => 'nullable|array',
            'mixes.*'  => ['nullable', 'integer', 'min:0', 'max:100'],
        ], [
            'colors.*.regex' => 'Her renk #RRGGBB formatında geçerli bir hex olmalı.',
            'mixes.*.integer' => 'Yoğunluk değeri tam sayı olmalı.',
        ]);

        // Tanımlı renk anahtarlarını filtrele
        $validKeys = array_merge(self::DEFAULTS, self::COLOR_OPTIONAL);
        $colors = array_intersect_key($validated['colors'], $validKeys);
        $colors = array_map(fn ($v) => is_string($v) ? strtolower($v) : $v, $colors);

        // Yoğunlukları filtrele
        $mixes = array_intersect_key($validated['mixes'] ?? [], self::MIX_DEFAULTS);

        Setting::saveGroup(self::GROUP, array_merge($colors, $mixes));

        return redirect()->route('theme.edit')->with(['success' => 'Tema ayarları kaydedildi.']);
    }

    public function reset()
    {
        Setting::where('group', self::GROUP)->delete();

        Cache::forget('settings.group.' . self::GROUP);
        foreach (array_keys(array_merge(self::DEFAULTS, self::COLOR_OPTIONAL, self::MIX_DEFAULTS)) as $key) {
            Cache::forget("setting." . self::GROUP . ".{$key}");
        }

        return redirect()->route('theme.edit')->with(['success' => 'Tema varsayılana sıfırlandı.']);
    }
}
