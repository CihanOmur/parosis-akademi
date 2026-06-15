<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    private array $newPermissions = [
        'competition',
        'competition_delete',
        'consulting_institution',
        'consulting_institution_delete',
        'certificate',
        'certificate_delete',
    ];

    private array $deprecatedPermissions = [
        'delete',
        'delete_user',
        'students_edit',
        'accounting_edit',
    ];

    public function up(): void
    {
        // 1. Yeni izinleri oluştur (idempotent)
        foreach ($this->newPermissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        // 2. Super admin rollerine tüm yeni izinleri ata
        foreach (['SuperAdmin', 'Admin'] as $roleName) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $role->givePermissionTo($this->newPermissions);
            }
        }

        // 3. Gereksiz izinleri sil
        Permission::whereIn('name', $this->deprecatedPermissions)->delete();

        // 4. Cache temizle
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        // Eski izinleri geri getir
        foreach ($this->deprecatedPermissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        // Yeni izinleri sil
        Permission::whereIn('name', $this->newPermissions)->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};
