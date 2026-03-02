<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_page_infos', function (Blueprint $table) {
            $table->json('field_styles')->nullable()->after('title');
        });

        // Migrate existing title_style data into field_styles
        $rows = DB::table('course_page_infos')->whereNotNull('title_style')->get();
        foreach ($rows as $row) {
            $titleStyle = json_decode($row->title_style, true);
            if ($titleStyle) {
                DB::table('course_page_infos')->where('id', $row->id)->update([
                    'field_styles' => json_encode(['title' => $titleStyle]),
                ]);
            }
        }

        Schema::table('course_page_infos', function (Blueprint $table) {
            $table->dropColumn('title_style');
        });
    }

    public function down(): void
    {
        Schema::table('course_page_infos', function (Blueprint $table) {
            $table->json('title_style')->nullable()->after('title');
        });

        // Migrate field_styles.title back to title_style
        $rows = DB::table('course_page_infos')->whereNotNull('field_styles')->get();
        foreach ($rows as $row) {
            $fieldStyles = json_decode($row->field_styles, true);
            if (isset($fieldStyles['title'])) {
                DB::table('course_page_infos')->where('id', $row->id)->update([
                    'title_style' => json_encode($fieldStyles['title']),
                ]);
            }
        }

        Schema::table('course_page_infos', function (Blueprint $table) {
            $table->dropColumn('field_styles');
        });
    }
};
