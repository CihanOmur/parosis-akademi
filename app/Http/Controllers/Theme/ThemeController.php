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
     * Sidebar tema renklerinin varsayılan değerleri.
     * Mevcut Tailwind class'larının hex karşılıkları.
     */
    public const DEFAULTS = [
        // Genel
        'sidebar_bg'              => '#ffffff', // bg-white
        'sidebar_border'          => '#e2e8f0', // slate-200
        'section_title_text'      => '#94a3b8', // slate-400
        'section_divider'         => '#e2e8f0', // slate-200

        // Ana Menü
        'menu_text'               => '#475569', // slate-600
        'menu_text_active'        => '#c026d3', // fuchsia-600
        'menu_bg_active'          => '#fdf4ff', // fuchsia-50
        'menu_bg_hover'           => '#f1f5f9', // slate-100

        // İkonlar
        'icon_bg'                 => '#f1f5f9', // slate-100
        'icon_text'               => '#64748b', // slate-500
        'icon_bg_active'          => '#d946ef', // fuchsia-500
        'icon_text_active'        => '#ffffff', // white

        // Alt Menüler
        'submenu_text'            => '#64748b', // slate-500
        'submenu_text_active'     => '#c026d3', // fuchsia-600
        'submenu_bg_active'       => '#fdf4ff', // fuchsia-50
        'submenu_bg_hover'        => '#f8fafc', // slate-50

        // Avatar
        'avatar_from'             => '#d946ef', // fuchsia-500
        'avatar_to'               => '#9333ea', // purple-600
    ];

    /**
     * Form için label'lar (5 grup).
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
    ];

    public function edit()
    {
        $saved   = Setting::getGroup(self::GROUP);
        $colors  = array_merge(self::DEFAULTS, array_filter($saved, fn ($v) => !empty($v)));
        $groups  = self::GROUPS;

        return view('admin.theme.edit', compact('colors', 'groups'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'colors'   => 'required|array',
            'colors.*' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
        ], [
            'colors.*.regex' => 'Her renk #RRGGBB formatında geçerli bir hex olmalı.',
        ]);

        // Sadece tanımlı key'leri kabul et
        $clean = array_intersect_key($validated['colors'], self::DEFAULTS);
        $clean = array_map('strtolower', $clean);

        Setting::saveGroup(self::GROUP, $clean);

        return redirect()->route('theme.edit')->with(['success' => 'Tema renkleri kaydedildi.']);
    }

    public function reset()
    {
        Setting::where('group', self::GROUP)->delete();

        // Cache temizliği
        Cache::forget('settings.group.' . self::GROUP);
        foreach (array_keys(self::DEFAULTS) as $key) {
            Cache::forget("setting." . self::GROUP . ".{$key}");
        }

        return redirect()->route('theme.edit')->with(['success' => 'Tema varsayılana sıfırlandı.']);
    }
}
