<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->json('label')->nullable();
            $table->string('url')->default('#');
            $table->string('target', 10)->default('_self');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('menu_items')->onDelete('cascade');
        });

        // Mevcut nav_items JSON verisini yeni tabloya migrate et
        $navbarPageInfo = \App\Models\Pages\Navbar\NavbarPageInfo::first();
        if ($navbarPageInfo && !empty($navbarPageInfo->nav_items)) {
            $this->migrateItems($navbarPageInfo->nav_items);
        }
    }

    private function migrateItems(array $items, ?int $parentId = null): void
    {
        foreach ($items as $index => $item) {
            $menuItem = \App\Models\MenuItem::create([
                'parent_id'  => $parentId,
                'label'      => $item['label'] ?? [],
                'url'        => $item['url'] ?? '#',
                'target'     => '_self',
                'sort_order' => $index,
                'is_active'  => true,
            ]);

            if (!empty($item['children'])) {
                $this->migrateItems($item['children'], $menuItem->id);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
