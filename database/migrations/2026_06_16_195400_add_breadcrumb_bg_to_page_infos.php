<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
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
                if (!Schema::hasColumn($table->getTable(), 'breadcrumb_bg_color')) {
                    $table->string('breadcrumb_bg_color', 20)->nullable()->after('id');
                }
                if (!Schema::hasColumn($table->getTable(), 'breadcrumb_bg_image')) {
                    $table->string('breadcrumb_bg_image', 500)->nullable()->after('breadcrumb_bg_color');
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $t) {
            Schema::table($t, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'breadcrumb_bg_color')) {
                    $table->dropColumn('breadcrumb_bg_color');
                }
                if (Schema::hasColumn($table->getTable(), 'breadcrumb_bg_image')) {
                    $table->dropColumn('breadcrumb_bg_image');
                }
            });
        }
    }
};
