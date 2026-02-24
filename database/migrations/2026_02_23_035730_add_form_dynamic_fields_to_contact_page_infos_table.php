<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->json('form_name_placeholder')->nullable();
            $table->json('form_email_placeholder')->nullable();
            $table->json('form_message_placeholder')->nullable();
            $table->json('form_privacy_text')->nullable();
            $table->json('form_button_text')->nullable();
            $table->string('contact_form_image')->nullable();
            $table->string('form_action_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->dropColumn([
                'form_name_placeholder',
                'form_email_placeholder',
                'form_message_placeholder',
                'form_privacy_text',
                'form_button_text',
                'contact_form_image',
                'form_action_url',
            ]);
        });
    }
};
