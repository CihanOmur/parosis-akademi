<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role\Permission;
use App\Models\Role\Role;
use Illuminate\Http\Request;
use App\Services\ValidationMessageService;

class RoleController extends Controller
{
    /**
     * Modül bazlı izin grupları — index/create/edit view'ları bunu kullanır.
     *
     * Dinamik çalışır: DB'deki TÜM izinleri tarar, modüle göre gruplar.
     * Bilinmeyen bir modül varsa generic fallback (gri kart) ile yine de görünür.
     * Yeni modül eklendiğinde sadece moduleMeta'ya tek satır eklemek yeterli.
     */
    public static function permissionGroups(): array
    {
        $moduleMeta = self::moduleMeta();
        $allPermissions = Permission::orderBy('id')->pluck('name')->toArray();

        $groups = [];
        foreach ($allPermissions as $permName) {
            $isDelete = str_ends_with($permName, '_delete');
            $baseKey  = $isDelete ? substr($permName, 0, -7) : $permName;

            $meta = $moduleMeta[$baseKey] ?? [
                'label' => ucwords(str_replace('_', ' ', $baseKey)),
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>',
                'color' => 'gray',
            ];

            $groupName = $meta['label'];
            if (!isset($groups[$groupName])) {
                $groups[$groupName] = [
                    'icon'  => $meta['icon'],
                    'color' => $meta['color'],
                    'perms' => [],
                ];
            }

            $permLabel = $isDelete
                ? ($meta['deleteLabel'] ?? ($meta['label'] . ' Sil'))
                : ($meta['mainLabel']   ?? ($meta['label'] . ' Yönetimi'));

            $groups[$groupName]['perms'][$permName] = $permLabel;
        }

        return $groups;
    }

    /**
     * Modül adı → görünüm metası. Bir modülün hem ana hem _delete izni varsa,
     * 'mainLabel' ana izin için, 'deleteLabel' _delete izni için kullanılır.
     * Yeni modül eklendiğinde sadece bu diziye ekleme yapılır.
     */
    public static function moduleMeta(): array
    {
        return [
            'user'                   => ['label' => 'Kullanıcı Yönetimi',   'color' => 'blue',    'mainLabel' => 'Kullanıcıları Görüntüle',     'deleteLabel' => 'Kullanıcı Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>'],

            'role'                   => ['label' => 'Rol Yönetimi',         'color' => 'pink',    'mainLabel' => 'Rolleri Görüntüle/Düzenle',   'deleteLabel' => 'Rol Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>'],

            'class'                  => ['label' => 'Sınıf Yönetimi',       'color' => 'emerald', 'mainLabel' => 'Sınıfları Yönet',             'deleteLabel' => 'Sınıf Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>'],

            'student'                => ['label' => 'Öğrenci Yönetimi',     'color' => 'violet',  'mainLabel' => 'Öğrencileri Yönet',           'deleteLabel' => 'Öğrenci Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>'],

            'accounting'             => ['label' => 'Muhasebe',             'color' => 'amber',   'mainLabel' => 'Ödeme & Muhasebe Yönetimi',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>'],

            'certificate'            => ['label' => 'Sertifika',            'color' => 'fuchsia', 'mainLabel' => 'Sertifika Ekle/Düzenle',      'deleteLabel' => 'Sertifika Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"/>'],

            'competition'            => ['label' => 'Yarışma',              'color' => 'purple',  'mainLabel' => 'Yarışma Ekle/Düzenle',        'deleteLabel' => 'Yarışma Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172"/>'],

            'consulting_institution' => ['label' => 'Danışmanlık Kurumları','color' => 'cyan',    'mainLabel' => 'Kurum Ekle/Düzenle',          'deleteLabel' => 'Kurum Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125-1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>'],

            'course'                 => ['label' => 'Kurslar',              'color' => 'lime',    'mainLabel' => 'Kurs + Kategori Yönetimi',    'deleteLabel' => 'Kurs/Kategori Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>'],

            'blog'                   => ['label' => 'Blog',                 'color' => 'rose',    'mainLabel' => 'Blog + Kategori/Etiket Yönetimi', 'deleteLabel' => 'Blog/Kategori/Etiket Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>'],

            'teacher'                => ['label' => 'Eğitmenler',           'color' => 'sky',     'mainLabel' => 'Eğitmen Ekle/Düzenle',        'deleteLabel' => 'Eğitmen Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>'],

            'faq'                    => ['label' => 'SSS',                  'color' => 'yellow',  'mainLabel' => 'SSS Ekle/Düzenle',            'deleteLabel' => 'SSS Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>'],

            'testimonial'            => ['label' => 'Yorumlar',             'color' => 'stone',   'mainLabel' => 'Öğrenci Yorumları Yönetimi',  'deleteLabel' => 'Yorum Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>'],

            'client_logo'            => ['label' => 'İş Ortağı Logoları',   'color' => 'zinc',    'mainLabel' => 'İş Ortağı Logo Yönetimi',     'deleteLabel' => 'Logo Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 21h19.5M2.25 15h19.5M2.25 9h19.5M2.25 3h19.5"/>'],

            'slider'                 => ['label' => 'Slider',               'color' => 'orange',  'mainLabel' => 'Slider + Slide Öğeleri',      'deleteLabel' => 'Slider Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/>'],

            'shop'                   => ['label' => 'Mağaza',               'color' => 'neutral', 'mainLabel' => 'Ürün/Sipariş/Kupon Yönetimi', 'deleteLabel' => 'Mağaza Silme',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/>'],

            'page'                   => ['label' => 'Sayfalar',             'color' => 'slate',   'mainLabel' => 'Statik Sayfaları Düzenle',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>'],

            'menu'                   => ['label' => 'Menü',                 'color' => 'indigo',  'mainLabel' => 'Header/Footer Menü Yönetimi',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>'],

            'language'               => ['label' => 'Dil Yönetimi',         'color' => 'teal',    'mainLabel' => 'Dil Ekle/Düzenle/Sil',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>'],

            'settings'               => ['label' => 'Ayarlar',              'color' => 'gray',    'mainLabel' => 'Genel Ayarlar (Logo, SEO, Mail, Sosyal)',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"/>'],

            'theme'                  => ['label' => 'Tema',                 'color' => 'fuchsia', 'mainLabel' => 'Sidebar Tema Ayarları',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z"/>'],

            'developer'              => ['label' => 'Geliştirici',          'color' => 'red',     'mainLabel' => 'Geliştirici Özellikleri',
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5"/>'],
        ];
    }

    /**
     * Tailwind renk paleti — gruplara atanan renkler.
     */
    public static function colorMap(): array
    {
        return [
            'blue'    => ['bg' => 'bg-blue-100 dark:bg-blue-900/30',       'icon' => 'text-blue-500',    'sel' => 'border-blue-400 dark:border-blue-500 bg-blue-50 dark:bg-blue-900/20',          'check' => 'bg-blue-500 border-blue-500',       'text' => 'text-blue-700 dark:text-blue-300'],
            'emerald' => ['bg' => 'bg-emerald-100 dark:bg-emerald-900/30', 'icon' => 'text-emerald-500', 'sel' => 'border-emerald-400 dark:border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20', 'check' => 'bg-emerald-500 border-emerald-500', 'text' => 'text-emerald-700 dark:text-emerald-300'],
            'violet'  => ['bg' => 'bg-violet-100 dark:bg-violet-900/30',   'icon' => 'text-violet-500',  'sel' => 'border-violet-400 dark:border-violet-500 bg-violet-50 dark:bg-violet-900/20',   'check' => 'bg-violet-500 border-violet-500',   'text' => 'text-violet-700 dark:text-violet-300'],
            'amber'   => ['bg' => 'bg-amber-100 dark:bg-amber-900/30',     'icon' => 'text-amber-500',   'sel' => 'border-amber-400 dark:border-amber-500 bg-amber-50 dark:bg-amber-900/20',       'check' => 'bg-amber-500 border-amber-500',     'text' => 'text-amber-700 dark:text-amber-300'],
            'fuchsia' => ['bg' => 'bg-fuchsia-100 dark:bg-fuchsia-900/30', 'icon' => 'text-fuchsia-500', 'sel' => 'border-fuchsia-400 dark:border-fuchsia-500 bg-fuchsia-50 dark:bg-fuchsia-900/20', 'check' => 'bg-fuchsia-500 border-fuchsia-500', 'text' => 'text-fuchsia-700 dark:text-fuchsia-300'],
            'purple'  => ['bg' => 'bg-purple-100 dark:bg-purple-900/30',   'icon' => 'text-purple-500',  'sel' => 'border-purple-400 dark:border-purple-500 bg-purple-50 dark:bg-purple-900/20',   'check' => 'bg-purple-500 border-purple-500',   'text' => 'text-purple-700 dark:text-purple-300'],
            'cyan'    => ['bg' => 'bg-cyan-100 dark:bg-cyan-900/30',       'icon' => 'text-cyan-500',    'sel' => 'border-cyan-400 dark:border-cyan-500 bg-cyan-50 dark:bg-cyan-900/20',          'check' => 'bg-cyan-500 border-cyan-500',       'text' => 'text-cyan-700 dark:text-cyan-300'],
            'rose'    => ['bg' => 'bg-rose-100 dark:bg-rose-900/30',       'icon' => 'text-rose-500',    'sel' => 'border-rose-400 dark:border-rose-500 bg-rose-50 dark:bg-rose-900/20',          'check' => 'bg-rose-500 border-rose-500',       'text' => 'text-rose-700 dark:text-rose-300'],
            'orange'  => ['bg' => 'bg-orange-100 dark:bg-orange-900/30',   'icon' => 'text-orange-500',  'sel' => 'border-orange-400 dark:border-orange-500 bg-orange-50 dark:bg-orange-900/20',   'check' => 'bg-orange-500 border-orange-500',   'text' => 'text-orange-700 dark:text-orange-300'],
            'slate'   => ['bg' => 'bg-slate-100 dark:bg-slate-700/40',     'icon' => 'text-slate-500',   'sel' => 'border-slate-400 dark:border-slate-500 bg-slate-50 dark:bg-slate-900/30',       'check' => 'bg-slate-500 border-slate-500',     'text' => 'text-slate-700 dark:text-slate-300'],
            'indigo'  => ['bg' => 'bg-indigo-100 dark:bg-indigo-900/30',   'icon' => 'text-indigo-500',  'sel' => 'border-indigo-400 dark:border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20',   'check' => 'bg-indigo-500 border-indigo-500',   'text' => 'text-indigo-700 dark:text-indigo-300'],
            'teal'    => ['bg' => 'bg-teal-100 dark:bg-teal-900/30',       'icon' => 'text-teal-500',    'sel' => 'border-teal-400 dark:border-teal-500 bg-teal-50 dark:bg-teal-900/20',          'check' => 'bg-teal-500 border-teal-500',       'text' => 'text-teal-700 dark:text-teal-300'],
            'gray'    => ['bg' => 'bg-gray-100 dark:bg-gray-800/50',       'icon' => 'text-gray-500',    'sel' => 'border-gray-400 dark:border-gray-500 bg-gray-50 dark:bg-gray-800/30',          'check' => 'bg-gray-500 border-gray-500',       'text' => 'text-gray-700 dark:text-gray-300'],
            'red'     => ['bg' => 'bg-red-100 dark:bg-red-900/30',         'icon' => 'text-red-500',     'sel' => 'border-red-400 dark:border-red-500 bg-red-50 dark:bg-red-900/20',              'check' => 'bg-red-500 border-red-500',         'text' => 'text-red-700 dark:text-red-300'],
            'pink'    => ['bg' => 'bg-pink-100 dark:bg-pink-900/30',       'icon' => 'text-pink-500',    'sel' => 'border-pink-400 dark:border-pink-500 bg-pink-50 dark:bg-pink-900/20',          'check' => 'bg-pink-500 border-pink-500',       'text' => 'text-pink-700 dark:text-pink-300'],
            'lime'    => ['bg' => 'bg-lime-100 dark:bg-lime-900/30',       'icon' => 'text-lime-600',    'sel' => 'border-lime-400 dark:border-lime-500 bg-lime-50 dark:bg-lime-900/20',          'check' => 'bg-lime-500 border-lime-500',       'text' => 'text-lime-700 dark:text-lime-300'],
            'sky'     => ['bg' => 'bg-sky-100 dark:bg-sky-900/30',         'icon' => 'text-sky-500',     'sel' => 'border-sky-400 dark:border-sky-500 bg-sky-50 dark:bg-sky-900/20',              'check' => 'bg-sky-500 border-sky-500',         'text' => 'text-sky-700 dark:text-sky-300'],
            'yellow'  => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30',   'icon' => 'text-yellow-600',  'sel' => 'border-yellow-400 dark:border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20',   'check' => 'bg-yellow-500 border-yellow-500',   'text' => 'text-yellow-700 dark:text-yellow-300'],
            'stone'   => ['bg' => 'bg-stone-100 dark:bg-stone-800/50',     'icon' => 'text-stone-500',   'sel' => 'border-stone-400 dark:border-stone-500 bg-stone-50 dark:bg-stone-900/30',       'check' => 'bg-stone-500 border-stone-500',     'text' => 'text-stone-700 dark:text-stone-300'],
            'zinc'    => ['bg' => 'bg-zinc-100 dark:bg-zinc-800/50',       'icon' => 'text-zinc-500',    'sel' => 'border-zinc-400 dark:border-zinc-500 bg-zinc-50 dark:bg-zinc-900/30',          'check' => 'bg-zinc-500 border-zinc-500',       'text' => 'text-zinc-700 dark:text-zinc-300'],
            'neutral' => ['bg' => 'bg-neutral-100 dark:bg-neutral-800/50', 'icon' => 'text-neutral-500', 'sel' => 'border-neutral-400 dark:border-neutral-500 bg-neutral-50 dark:bg-neutral-900/30','check' => 'bg-neutral-500 border-neutral-500', 'text' => 'text-neutral-700 dark:text-neutral-300'],
        ];
    }

    /** Düz {izin_adı => etiket} haritası — index gibi yerlerde basit etiket çağrıları için */
    private function flatLabels(): array
    {
        $labels = [];
        foreach (self::permissionGroups() as $group) {
            foreach ($group['perms'] as $name => $label) {
                $labels[$name] = $label;
            }
        }
        return $labels;
    }

    public function index()
    {
        $roles = Role::where('is_visible', 1)->with('permissions')->paginate(20);
        return view('admin.roles.index', [
            'roles'             => $roles,
            'permissionLabels'  => $this->flatLabels(),
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', [
            'permissions'      => $permissions,
            'permissionGroups' => self::permissionGroups(),
            'colorMap'         => self::colorMap(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100|unique:roles,name',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ], ValidationMessageService::getMessages('role_store'));

        $role = Role::create(['name' => $request->name, 'is_visible' => 1]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', '"' . $request->name . '" rolü oluşturuldu.');
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        if (!$role->is_visible) {
            return redirect()->route('roles.index')->with('error', 'Bu rol düzenlenemez.');
        }

        $permissions = Permission::all();
        return view('admin.roles.edit', [
            'role'             => $role,
            'permissions'      => $permissions,
            'permissionGroups' => self::permissionGroups(),
            'colorMap'         => self::colorMap(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        if (!$role->is_visible) {
            return redirect()->route('roles.index')->with('error', 'Bu rol güncellenemez.');
        }

        $request->validate([
            'name'          => 'required|string|max:100|unique:roles,name,' . $id,
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ], ValidationMessageService::getMessages('role_update'));

        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', '"' . $request->name . '" rolü güncellendi.');
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);

        if (!$role->is_visible) {
            return redirect()->route('roles.index')->with('error', 'Bu rol silinemez.');
        }

        $roleName = $role->name;
        $role->delete();

        return redirect()->route('roles.index')->with('success', '"' . $roleName . '" rolü silindi.');
    }
}
