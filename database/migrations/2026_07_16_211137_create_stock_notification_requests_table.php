<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_notification_requests', function (Blueprint $t) {
            $t->id();
            $t->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $t->string('email');
            $t->text('note')->nullable();
            $t->timestamp('notified_at')->nullable();
            $t->timestamps();
            $t->index(['product_id', 'notified_at']);
        });
    }
    public function down(): void { Schema::dropIfExists('stock_notification_requests'); }
};
