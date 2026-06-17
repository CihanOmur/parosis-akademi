<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    private array $newPermissions = [
        'blog', 'blog_delete',
        'course', 'course_delete',
        'faq', 'faq_delete',
        'teacher', 'teacher_delete',
        'testimonial', 'testimonial_delete',
        'client_logo', 'client_logo_delete',
        'slider', 'slider_delete',
        'role', 'role_delete',
        'theme',
    ];

    private array $deprecatedPermissions = [
        'content',
        'content_delete',
    ];

    private array $contentRoleMigration = [
        'blog', 'course', 'faq', 'teacher', 'testimonial', 'client_logo', 'slider',
    ];

    private array $contentDeleteRoleMigration = [
        'blog_delete', 'course_delete', 'faq_delete', 'teacher_delete',
        'testimonial_delete', 'client_logo_delete', 'slider_delete',
    ];

    public function up(): void
    {
        foreach ($this->newPermissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        $roles = Role::all();
        foreach ($roles as $role) {
            $hasContent = $role->hasPermissionTo('content');
            $hasContentDelete = $role->hasPermissionTo('content_delete');
            $hasUser = $role->hasPermissionTo('user');
            $hasUserDelete = $role->hasPermissionTo('user_delete');
            $hasSettings = $role->hasPermissionTo('settings');

            if ($hasContent) {
                $role->givePermissionTo($this->contentRoleMigration);
            }
            if ($hasContentDelete) {
                $role->givePermissionTo($this->contentDeleteRoleMigration);
            }
            if ($hasUser) {
                $role->givePermissionTo('role');
            }
            if ($hasUserDelete) {
                $role->givePermissionTo('role_delete');
            }
            if ($hasSettings) {
                $role->givePermissionTo('theme');
            }
        }

        Permission::whereIn('name', $this->deprecatedPermissions)->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        foreach ($this->deprecatedPermissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        Permission::whereIn('name', $this->newPermissions)->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};
