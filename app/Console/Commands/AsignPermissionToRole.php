<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AsignPermissionToRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:a-p-r {name : Permission adı} {role : Role adı}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');       // Zorunlu parametre
        $roleName = $this->argument('role');    // Zorunlu parametre

        $permission = \App\Models\Role\Permission::where('name', $name)->first();
        if (!$permission) {
            $this->error("Böyle bir permission bulunamadı: {$name}");
            return;
        }

        $role = \App\Models\Role\Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error("Böyle bir role bulunamadı: {$roleName}");
            return;
        }
        if ($role->permissions->contains($permission->id)) {
            $this->error("{$name} adlı permission zaten {$roleName} adlı role atanmış.");
            return;
        }
        $role->permissions()->attach($permission->id);

        $this->info("{$name} adlı permission, {$roleName} adlı role başarıyla atandı.");
    }
}
