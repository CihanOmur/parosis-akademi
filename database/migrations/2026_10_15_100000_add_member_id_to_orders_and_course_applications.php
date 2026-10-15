<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Üyelik Faz 2: üye girişliyken verilen sipariş / kurs başvurusu üyenin hesabına bağlanır.
    // Mevcut (misafir) kayıtlar NULL kalır; üye silinirse kayıt durur, bağı NULL olur.
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $t) {
            $t->foreignId('member_id')->nullable()->after('id')->constrained('members')->nullOnDelete();
        });

        Schema::table('course_applications', function (Blueprint $t) {
            $t->foreignId('member_id')->nullable()->after('id')->constrained('members')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $t) {
            $t->dropConstrainedForeignId('member_id');
        });

        Schema::table('course_applications', function (Blueprint $t) {
            $t->dropConstrainedForeignId('member_id');
        });
    }
};
