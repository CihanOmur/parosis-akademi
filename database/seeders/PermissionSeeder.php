<?php

namespace Database\Seeders;

use App\Models\Role\Permission;
use App\Models\Role\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Tüm izinleri oluşturur ve rollere atar.
     */
    public function run(): void
    {
        // İzin tanımlamaları
        $permissions = [
            'user'          => 'Kullanıcıları görüntüle',
            'user_delete'   => 'Kullanıcı sil',
            'class'         => 'Sınıfları yönet',
            'class_delete'  => 'Sınıf sil',
            'student'       => 'Öğrencileri yönet',
            'student_delete'=> 'Öğrenci sil',
            'accounting'    => 'Muhasebe / Ödeme yönetimi',
        ];

        // İzinleri oluştur (zaten varsa geç)
        foreach (array_keys($permissions) as $permName) {
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'web']);
        }

        // Rol-İzin atamaları
        $rolePermissions = [
            'SuperAdmin' => array_keys($permissions),
            'Admin'      => array_keys($permissions),
            'Kordinatör' => ['student', 'student_delete', 'accounting'],
            'Eğitmen'    => ['class'],
        ];

        foreach ($rolePermissions as $roleName => $perms) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $role->syncPermissions($perms);
            }
        }
    }
}
