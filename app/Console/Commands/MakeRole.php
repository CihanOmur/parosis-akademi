<?php

namespace App\Console\Commands;

use App\Models\Role\Role;
use Illuminate\Console\Command;

class MakeRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-role {name : Rol adı} {--is_visible=1 : Rol görünürlük durumu (1 veya 0)}';


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
        $isVisible = $this->option('is_visible'); // Opsiyon

        // Örnek: Role Model'ine kayıt
        $role = new Role();
        $role->name = $name;
        $role->is_visible = $isVisible;
        $role->save();

        $this->info("Rol başarıyla oluşturuldu: {$name}, is_visible: {$isVisible}");
    }
}
