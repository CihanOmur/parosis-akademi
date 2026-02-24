<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('is_default');
        });

        // Mevcut kayıtlara sıralı değer ata
        $languages = DB::table('languages')->orderByDesc('is_default')->orderBy('locale')->get();
        foreach ($languages as $i => $lang) {
            DB::table('languages')->where('id', $lang->id)->update(['sort_order' => $i]);
        }
    }

    public function down(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
