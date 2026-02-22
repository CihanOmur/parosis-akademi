<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role\Permission;
use App\Models\Role\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /** İzin açıklamaları */
    private array $permissionLabels = [
        'user'          => 'Kullanıcıları Görüntüle',
        'user_delete'   => 'Kullanıcı Sil',
        'class'         => 'Sınıfları Yönet',
        'class_delete'  => 'Sınıf Sil',
        'student'       => 'Öğrencileri Yönet',
        'student_delete'=> 'Öğrenci Sil',
        'accounting'    => 'Muhasebe & Ödemeler',
    ];

    public function index()
    {
        $roles = Role::where('is_visible', 1)->with('permissions')->paginate(20);
        return view('admin.roles.index', [
            'roles'             => $roles,
            'permissionLabels'  => $this->permissionLabels,
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', [
            'permissions'       => $permissions,
            'permissionLabels'  => $this->permissionLabels,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100|unique:roles,name',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ], [
            'name.required' => 'Rol adı zorunludur.',
            'name.unique'   => 'Bu rol adı zaten kullanılıyor.',
        ]);

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
            'role'              => $role,
            'permissions'       => $permissions,
            'permissionLabels'  => $this->permissionLabels,
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
        ], [
            'name.required' => 'Rol adı zorunludur.',
            'name.unique'   => 'Bu rol adı zaten kullanılıyor.',
        ]);

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
