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
     * Yeni bir modül izni eklenince sadece buraya tek satır eklenir.
     */
    public static function permissionGroups(): array
    {
        return [
            'Kullanıcı Yönetimi' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>',
                'color' => 'blue',
                'perms' => ['user' => 'Kullanıcıları Görüntüle', 'user_delete' => 'Kullanıcı Sil'],
            ],
            'Sınıf Yönetimi' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>',
                'color' => 'emerald',
                'perms' => ['class' => 'Sınıfları Yönet', 'class_delete' => 'Sınıf Sil'],
            ],
            'Öğrenci Yönetimi' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>',
                'color' => 'violet',
                'perms' => ['student' => 'Öğrencileri Yönet', 'student_delete' => 'Öğrenci Sil'],
            ],
            'Muhasebe' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>',
                'color' => 'amber',
                'perms' => ['accounting' => 'Ödeme & Muhasebe Yönetimi'],
            ],
            'Sertifika' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"/>',
                'color' => 'fuchsia',
                'perms' => ['certificate' => 'Sertifika Ekle/Düzenle', 'certificate_delete' => 'Sertifika Sil'],
            ],
            'Yarışma' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172"/>',
                'color' => 'purple',
                'perms' => ['competition' => 'Yarışma Ekle/Düzenle', 'competition_delete' => 'Yarışma Sil'],
            ],
            'Danışmanlık Kurumları' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>',
                'color' => 'cyan',
                'perms' => ['consulting_institution' => 'Kurum Ekle/Düzenle', 'consulting_institution_delete' => 'Kurum Sil'],
            ],
            'İçerik (Kurs, Blog, Eğitmen)' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>',
                'color' => 'rose',
                'perms' => ['content' => 'İçerikleri Yönet (Kurs/Blog/Eğitmen/SSS/Slider...)', 'content_delete' => 'İçerik Sil'],
            ],
            'Mağaza' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/>',
                'color' => 'orange',
                'perms' => ['shop' => 'Ürün/Sipariş/Kupon Yönetimi', 'shop_delete' => 'Mağaza Silme'],
            ],
            'Sayfalar' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>',
                'color' => 'slate',
                'perms' => ['page' => 'Statik Sayfaları Düzenle (Hakkımızda, İletişim...)'],
            ],
            'Menü' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>',
                'color' => 'indigo',
                'perms' => ['menu' => 'Header/Footer Menü Yönetimi'],
            ],
            'Dil Yönetimi' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>',
                'color' => 'teal',
                'perms' => ['language' => 'Dil Ekle/Düzenle/Sil'],
            ],
            'Ayarlar & Tema' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"/>',
                'color' => 'gray',
                'perms' => ['settings' => 'Genel Ayarlar + Tema'],
            ],
            'Geliştirici' => [
                'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5"/>',
                'color' => 'red',
                'perms' => ['developer' => 'Geliştirici Özellikleri (Validation, Dil Silme...)'],
            ],
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
