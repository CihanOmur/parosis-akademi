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
        Schema::table('competitions', function (Blueprint $table) {
            $table->string('country', 100)->nullable()->after('organizer');
            $table->string('city', 100)->nullable()->after('country');
            $table->date('internal_deadline')->nullable()->after('end_date');
            $table->string('website_url', 500)->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn(['country', 'city', 'internal_deadline', 'website_url']);
        });
    }
};
