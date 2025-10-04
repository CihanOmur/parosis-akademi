<?php

namespace App\Console\Commands;

use App\Models\Role\Permission;
use Illuminate\Console\Command;

class MakePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-permission {name : Permission adı}';

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

        $existingPermission = Permission::where('name', $name)->first();
        if ($existingPermission) {
            $this->error("Bu isimde zaten bir permission var: {$name}");
            return;
        }
        $permission = new Permission();
        $permission->name = $name;
        $permission->save();

        $this->info("Permission başarıyla oluşturuldu: {$name}");
    }
}
