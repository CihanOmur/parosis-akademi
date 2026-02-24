<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->json('phones')->nullable()->after('form_description');
            $table->json('emails')->nullable()->after('phones');
            $table->json('addresses')->nullable()->after('emails');
        });

        // Migrate existing data from old columns to new JSON arrays
        $rows = DB::table('contact_page_infos')->get();
        foreach ($rows as $row) {
            $phones = array_values(array_filter([$row->phone_1, $row->phone_2]));
            $emails = array_values(array_filter([$row->email_1, $row->email_2]));
            $addresses = array_values(array_filter([$row->address_line_1, $row->address_line_2]));

            DB::table('contact_page_infos')->where('id', $row->id)->update([
                'phones' => json_encode($phones),
                'emails' => json_encode($emails),
                'addresses' => json_encode($addresses),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->dropColumn(['phones', 'emails', 'addresses']);
        });
    }
};
