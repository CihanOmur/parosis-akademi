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
     * Sidebar tema renklerinin varsayılan değerleri (siyah-beyaz monokrom palet).
     */
    public const DEFAULTS = [
        // Genel
        'sidebar_bg'              => '#ffffff', // beyaz
        'sidebar_border'          => '#e5e7eb', // gray-200
        'section_title_text'      => '#9ca3af', // gray-400
        'section_divider'         => '#e5e7eb', // gray-200

        // Ana Menü
        'menu_text'               => '#374151', // gray-700
        'menu_text_active'        => '#000000', // siyah
        'menu_bg_active'          => '#f3f4f6', // gray-100
        'menu_bg_hover'           => '#f9fafb', // gray-50

        // İkonlar
        'icon_bg'                 => '#f3f4f6', // gray-100
        'icon_text'               => '#6b7280', // gray-500
        'icon_bg_active'          => '#111827', // gray-900 (neredeyse siyah)
        'icon_text_active'        => '#ffffff', // beyaz

        // Alt Menüler
        'submenu_text'            => '#6b7280', // gray-500
        'submenu_text_active'     => '#000000', // siyah
        'submenu_bg_active'       => '#f3f4f6', // gray-100
        'submenu_bg_hover'        => '#f9fafb', // gray-50

        // Avatar (siyah gradient)
        'avatar_from'             => '#374151', // gray-700
        'avatar_to'               => '#000000', // siyah
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
