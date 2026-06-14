<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('competition_student', function (Blueprint $table) {
            $table->foreignId('competition_category_id')->nullable()->after('competition_id')
                  ->constrained('competition_categories')->nullOnDelete();
            $table->string('team_name', 200)->nullable()->after('competition_category_id');
            $table->boolean('passport_valid_6m')->default(false)->after('parent_consent_status');
            $table->string('result_file', 255)->nullable()->after('result_notes');
        });
    }

    public function down(): void
    {
        Schema::table('competition_student', function (Blueprint $table) {
            $table->dropForeign(['competition_category_id']);
            $table->dropColumn(['competition_category_id', 'team_name', 'passport_valid_6m', 'result_file']);
        });
    }
};
