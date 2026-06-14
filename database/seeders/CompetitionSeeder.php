<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\CompetitionStudent;
use App\Models\Student\Student;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        $competitions = [
            [
                'name'        => 'Robotex Türkiye 2026',
                'organizer'   => 'Robotex Türkiye',
                'location'    => 'İstanbul / Türkiye',
                'start_date'  => '2026-11-06',
                'end_date'    => '2026-11-08',
                'description' => 'Mini Sumo, LineFollower ve FreeStyle kategorilerinde ulusal robotik yarışması.',
            ],
            [
                'name'        => 'FIRST Tech Challenge — İstanbul Bölge',
                'organizer'   => 'FIRST Robotics Competition',
                'location'    => 'İstanbul / Türkiye',
                'start_date'  => '2026-02-21',
                'end_date'    => '2026-02-22',
                'description' => 'Lise düzeyi robotik turnuvası — bölge eleme.',
            ],
            [
                'name'        => 'Tübitak Bilim Olimpiyatları 2026',
                'organizer'   => 'Tübitak',
                'location'    => 'Ankara / Türkiye',
                'start_date'  => '2026-04-15',
                'end_date'    => '2026-04-17',
                'description' => 'Bilgisayar bilimleri ve matematik olimpiyatı ulusal seçme.',
            ],
            [
                'name'        => 'World Robot Olympiad — Almanya',
                'organizer'   => 'WRO Foundation',
                'location'    => 'Berlin / Almanya',
                'start_date'  => '2026-11-19',
                'end_date'    => '2026-11-21',
                'description' => 'Uluslararası robot olimpiyatı, pasaport + vize gerekir.',
            ],
            [
                'name'        => 'Fibonacci Kodlama Şenliği',
                'organizer'   => 'Fibonacci STEM',
                'location'    => 'İzmir / Türkiye',
                'start_date'  => '2025-10-18',
                'end_date'    => '2025-10-18',
                'description' => 'Lise/ortaokul karması algoritma yarışması — tek günlük etkinlik.',
            ],
        ];

        foreach ($competitions as $i => $data) {
            Competition::updateOrCreate(
                ['name' => $data['name']],
                array_merge($data, ['is_active' => true, 'sort_order' => $i])
            );
        }

        $students = Student::where('registration_type', 2)->take(4)->get();
        if ($students->isEmpty()) {
            $this->command?->warn('Aktif öğrenci yok — CompetitionSeeder atlandı.');
            return;
        }

        $allCompetitions = Competition::pluck('id')->all();

        // Atama senaryoları
        $scenarios = [
            // Öğrenci 1 — 3 yarışma, hepsi tamamlanmış, sonuçlar girilmiş
            [
                ['parent_consent_status' => 'teslim_edildi', 'passport_status' => 'kontrol_edildi', 'visa_status' => 'onaylandi',     'payment_status' => 'odendi',  'payment_amount' => 500.00, 'payment_currency' => 'EUR', 'result_rank' => 3,    'result_label' => 'Mini Sumo Bronz',           'result_notes' => 'Çok başarılı bir performans.'],
                ['parent_consent_status' => 'alindi',        'passport_status' => 'var',           'visa_status' => 'gerekli_degil', 'payment_status' => 'odendi',  'payment_amount' => 450.00, 'payment_currency' => 'TRY', 'result_rank' => 5,    'result_label' => 'Yarı Final',                'result_notes' => null],
                ['parent_consent_status' => 'teslim_edildi', 'passport_status' => 'yok',           'visa_status' => 'gerekli_degil', 'payment_status' => 'kismi',   'payment_amount' => 200.00, 'payment_currency' => 'TRY', 'result_rank' => null, 'result_label' => 'Katılım Belgesi',           'result_notes' => null],
            ],
            // Öğrenci 2 — 2 yarışma, biri devam ediyor, biri sonuçlanmış
            [
                ['parent_consent_status' => 'alindi',   'passport_status' => 'yok', 'visa_status' => 'gerekli_degil', 'payment_status' => 'bekliyor', 'payment_amount' => null,    'payment_currency' => 'TRY', 'result_rank' => null, 'result_label' => null,             'result_notes' => null],
                ['parent_consent_status' => 'bekliyor', 'passport_status' => 'var', 'visa_status' => 'basvuruldu',    'payment_status' => 'kismi',    'payment_amount' => 750.00,  'payment_currency' => 'EUR', 'result_rank' => null, 'result_label' => null,             'result_notes' => null],
            ],
            // Öğrenci 3 — 1 yarışma, tam katılım
            [
                ['parent_consent_status' => 'teslim_edildi', 'passport_status' => 'kontrol_edildi', 'visa_status' => 'onaylandi', 'payment_status' => 'odendi', 'payment_amount' => 1200.00, 'payment_currency' => 'EUR', 'result_rank' => 1, 'result_label' => 'Altın Madalya', 'result_notes' => 'Takım kaptanı.'],
            ],
            // Öğrenci 4 — 2 yarışma, henüz statü güncellenmemiş
            [
                ['parent_consent_status' => 'bekliyor', 'passport_status' => 'yok',           'visa_status' => 'gerekli_degil', 'payment_status' => 'bekliyor', 'payment_amount' => null,   'payment_currency' => 'TRY', 'result_rank' => null, 'result_label' => null, 'result_notes' => null],
                ['parent_consent_status' => 'bekliyor', 'passport_status' => 'kontrol_edildi', 'visa_status' => 'reddedildi',    'payment_status' => 'bekliyor', 'payment_amount' => null,   'payment_currency' => 'USD', 'result_rank' => null, 'result_label' => null, 'result_notes' => null],
            ],
        ];

        foreach ($students as $sIndex => $student) {
            $assignments = $scenarios[$sIndex] ?? [];
            // Her senaryoya farklı yarışma seç
            $picks = collect($allCompetitions)->shuffle()->take(count($assignments))->values()->all();

            foreach ($assignments as $i => $entry) {
                CompetitionStudent::updateOrCreate(
                    [
                        'student_id'     => $student->id,
                        'competition_id' => $picks[$i] ?? $allCompetitions[0],
                    ],
                    array_merge($entry, [
                        'joined_at' => now()->subDays(rand(7, 200))->toDateString(),
                    ])
                );
            }
        }
    }
}
