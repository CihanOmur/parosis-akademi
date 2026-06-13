<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\ConsultingInstitution;
use App\Models\Courses\CourseCategory;
use App\Models\Student\Student;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::where('registration_type', 2)->take(4)->get();
        if ($students->isEmpty()) {
            $this->command?->warn('Aktif öğrenci yok — CertificateSeeder atlandı.');
            return;
        }

        $institutions = ConsultingInstitution::where('is_active', true)->pluck('id')->all();
        $categories   = CourseCategory::pluck('id')->all();

        $samples = [
            // Kurumsal (kendi kurumumuz tarafından verilen)
            [
                'type' => Certificate::TYPE_CORPORATE,
                'name' => 'Robotik Eğitimi Tamamlama Belgesi',
                'certificate_number' => 'PA-2025-0042',
                'issue_date' => '2025-04-15',
                'notes' => 'Yıllık programı eksiksiz tamamladı, projesi sergilendi.',
            ],
            [
                'type' => Certificate::TYPE_CORPORATE,
                'name' => 'Python Giriş Sertifikası',
                'certificate_number' => 'PA-2024-0117',
                'issue_date' => '2024-12-20',
                'notes' => null,
            ],
            // Danışmanlık
            [
                'type' => Certificate::TYPE_CONSULTING,
                'name' => 'STEM Mentorluk Programı Katılım Belgesi',
                'consulting_institution_id' => 'rand',
                'certificate_number' => null,
                'issue_date' => '2025-06-10',
                'notes' => 'Sınıfta gönüllü asistan rolü üstlendi.',
            ],
            [
                'type' => Certificate::TYPE_CONSULTING,
                'name' => 'Üstün Başarı Belgesi',
                'consulting_institution_id' => 'rand',
                'certificate_number' => 'TBM-A-0991',
                'issue_date' => '2025-03-02',
                'notes' => null,
            ],
            // Yarışma
            [
                'type' => Certificate::TYPE_COMPETITION,
                'name' => 'Robotex Türkiye 2025 — Mini Sumo 3.lük',
                'issuer_text' => 'Robotex Türkiye',
                'certificate_number' => 'RTX-2025-MS-031',
                'issue_date' => '2025-11-08',
                'notes' => '3. sıra, finallerde 2 maç farkıyla yarı finale taşındı.',
            ],
            [
                'type' => Certificate::TYPE_COMPETITION,
                'name' => 'FRC Bursa Bölgesi Katılım Sertifikası',
                'issuer_text' => 'FIRST Robotics Competition',
                'certificate_number' => null,
                'issue_date' => '2025-02-28',
                'notes' => 'Takımın programcı rolünde görev aldı.',
            ],
            [
                'type' => Certificate::TYPE_COMPETITION,
                'name' => 'Fibonacci Kodlama Şenliği Katılım',
                'issuer_text' => 'Fibonacci STEM Festivali',
                'certificate_number' => 'FIB-2024-2271',
                'issue_date' => '2024-10-18',
                'notes' => null,
            ],
        ];

        foreach ($students as $studentIndex => $student) {
            // Her öğrenciye 3-4 farklı sertifika ata (deterministic, seed olmadan da tekrar üretilebilir)
            $assigned = collect($samples)->shuffle()->take(3 + ($studentIndex % 2));

            foreach ($assigned as $i => $sample) {
                $data = collect($sample)->except(['consulting_institution_id'])->toArray();
                $data['student_id'] = $student->id;
                $data['category_id'] = $categories[array_rand($categories)] ?? null;

                if (($sample['consulting_institution_id'] ?? null) === 'rand' && $institutions) {
                    $data['consulting_institution_id'] = $institutions[array_rand($institutions)];
                }

                Certificate::updateOrCreate(
                    [
                        'student_id' => $student->id,
                        'name'       => $sample['name'],
                    ],
                    $data
                );
            }
        }
    }
}
