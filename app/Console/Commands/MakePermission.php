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

        $role = new Permission();
        $role->name = $name;
        $role->save();


        $this->info("Rol başarıyla oluşturuldu: {$name}");
    }
}
