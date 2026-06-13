<?php

namespace Database\Seeders;

use App\Models\ConsultingInstitution;
use Illuminate\Database\Seeder;

class ConsultingInstitutionSeeder extends Seeder
{
    public function run(): void
    {
        $institutions = [
            [
                'name'          => 'Robotik Akademi Eğitim Vakfı',
                'contact_email' => 'info@robotikakademi.org',
                'contact_phone' => '+90 212 555 11 22',
                'notes'         => 'STEM ve robotik eğitimleri kapsamında uzun vadeli danışmanlık.',
            ],
            [
                'name'          => 'Tübitak Bilim Merkezi',
                'contact_email' => 'iletisim@tubitak.gov.tr',
                'contact_phone' => '+90 312 467 00 00',
                'notes'         => 'Ulusal yarışmalar ve bilim okulları için danışmanlık.',
            ],
            [
                'name'          => 'Maker Faire İstanbul',
                'contact_email' => 'partner@makerfaire.com.tr',
                'contact_phone' => '+90 216 444 33 22',
                'notes'         => 'Yıllık maker etkinlikleri ve mentorluk hizmetleri.',
            ],
            [
                'name'          => 'Bahçeşehir Koleji STEM Birimi',
                'contact_email' => 'stem@bahcesehir.k12.tr',
                'contact_phone' => '+90 212 666 77 88',
                'notes'         => 'Lise düzeyinde robotik müfredat danışmanlığı.',
            ],
            [
                'name'          => 'Microsoft Türkiye Eğitim',
                'contact_email' => 'edu-tr@microsoft.com',
                'contact_phone' => '+90 212 888 99 00',
                'notes'         => 'MakeCode ve yapay zeka modülleri için içerik danışmanlığı.',
            ],
        ];

        foreach ($institutions as $index => $data) {
            ConsultingInstitution::updateOrCreate(
                ['name' => $data['name']],
                array_merge($data, [
                    'is_active'  => true,
                    'sort_order' => $index + 1,
                ])
            );
        }
    }
}
