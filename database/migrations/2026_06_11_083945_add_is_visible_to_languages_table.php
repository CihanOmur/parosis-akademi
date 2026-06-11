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
        Schema::table('languages', function (Blueprint $table) {
            // SuperAdmin tarafından müşteriye açılan dil mi? (Admin sadece is_visible=1 olanları görür)
            // Default 0: yeni eklenen / mevcut diller başlangıçta GİZLİ — SuperAdmin tek tek açar.
            $table->boolean('is_visible')->default(0)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('is_visible');
        });
    }
};
