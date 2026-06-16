<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'home_page_infos',
        'about_us_page_infos',
        'course_page_infos',
        'teacher_page_infos',
        'blog_page_infos',
        'faq_page_infos',
        'contact_page_infos',
    ];

    public function up(): void
    {
        foreach ($this->tables as $t) {
            Schema::table($t, function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'cta_enabled')) {
                    $table->boolean('cta_enabled')->default(true)->after('id');
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $t) {
            Schema::table($t, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'cta_enabled')) {
                    $table->dropColumn('cta_enabled');
                }
            });
        }
    }
};
