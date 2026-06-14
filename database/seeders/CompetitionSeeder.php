<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\CompetitionCategory;
use App\Models\CompetitionStudent;
use App\Models\Student\Student;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Kategoriler (havuz)
        $categoryNames = [
            'Mini Sumo',
            'Çizgi İzleyen',
            'Serbest Robot',
            'Drone',
            'Algoritma',
            'Bilim Olimpiyatı',
        ];
        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[$name] = CompetitionCategory::firstOrCreate(['name' => $name]);
        }

        // 2) Yarışmalar + bağlı kategoriler
        $competitions = [
            [
                'data' => [
                    'name'              => 'Robotex Türkiye 2026',
                    'organizer'         => 'Robotex Türkiye',
                    'country'           => 'Türkiye',
                    'city'              => 'İstanbul',
                    'location'          => 'İstanbul / Türkiye',
                    'start_date'        => '2026-11-06',
                    'end_date'          => '2026-11-08',
                    'internal_deadline' => '2026-10-15',
                    'description'       => 'Mini Sumo, LineFollower ve FreeStyle kategorilerinde ulusal robotik yarışması.',
                    'website_url'       => 'https://robotex.io/tr',
                ],
                'categories' => ['Mini Sumo', 'Çizgi İzleyen', 'Serbest Robot'],
            ],
            [
                'data' => [
                    'name'              => 'FIRST Tech Challenge — İstanbul Bölge',
                    'organizer'         => 'FIRST Robotics Competition',
                    'country'           => 'Türkiye',
                    'city'              => 'İstanbul',
                    'location'          => 'İstanbul / Türkiye',
                    'start_date'        => '2026-02-21',
                    'end_date'          => '2026-02-22',
                    'internal_deadline' => '2026-01-30',
                    'description'       => 'Lise düzeyi robotik turnuvası — bölge eleme.',
                    'website_url'       => 'https://www.firstinspires.org/robotics/ftc',
                ],
                'categories' => ['Serbest Robot'],
            ],
            [
                'data' => [
                    'name'              => 'Tübitak Bilim Olimpiyatları 2026',
                    'organizer'         => 'Tübitak',
                    'country'           => 'Türkiye',
                    'city'              => 'Ankara',
                    'location'          => 'Ankara / Türkiye',
                    'start_date'        => '2026-04-15',
                    'end_date'          => '2026-04-17',
                    'internal_deadline' => '2026-03-01',
                    'description'       => 'Bilgisayar bilimleri ve matematik olimpiyatı ulusal seçme.',
                    'website_url'       => null,
                ],
                'categories' => ['Algoritma', 'Bilim Olimpiyatı'],
            ],
            [
                'data' => [
                    'name'              => 'World Robot Olympiad — Almanya',
                    'organizer'         => 'WRO Foundation',
                    'country'           => 'Almanya',
                    'city'              => 'Berlin',
                    'location'          => 'Berlin / Almanya',
                    'start_date'        => '2026-11-19',
                    'end_date'          => '2026-11-21',
                    'internal_deadline' => '2026-09-01',
                    'description'       => 'Uluslararası robot olimpiyatı, pasaport + vize gerekir.',
                    'website_url'       => 'https://wro-association.org',
                ],
                'categories' => ['Mini Sumo', 'Çizgi İzleyen', 'Drone'],
            ],
            [
                'data' => [
                    'name'              => 'Fibonacci Kodlama Şenliği',
                    'organizer'         => 'Fibonacci STEM',
                    'country'           => 'Türkiye',
                    'city'              => 'İzmir',
                    'location'          => 'İzmir / Türkiye',
                    'start_date'        => '2025-10-18',
                    'end_date'          => '2025-10-18',
                    'internal_deadline' => '2025-09-30',
                    'description'       => 'Lise/ortaokul karması algoritma yarışması — tek günlük etkinlik.',
                    'website_url'       => null,
                ],
                'categories' => ['Algoritma'],
            ],
        ];

        foreach ($competitions as $i => $cdata) {
            $comp = Competition::updateOrCreate(
                ['name' => $cdata['data']['name']],
                array_merge($cdata['data'], ['is_active' => true, 'sort_order' => $i])
            );

            $catIds = collect($cdata['categories'])->map(fn($n) => $categories[$n]->id)->all();
            $comp->categories()->sync($catIds);
        }

        // 3) Öğrenci atamaları (takım + kategori + pasaport dahil)
        $students = Student::where('registration_type', 2)->take(4)->get();
        if ($students->isEmpty()) {
            $this->command?->warn('Aktif öğrenci yok — CompetitionSeeder atlandı.');
            return;
        }

        $allCompetitions = Competition::with('categories')->get();

        $scenarios = [
            // Öğrenci 1 — 3 yarışma, tamamlanmış, sonuçlar girilmiş
            [
                ['team' => 'Robokids Alpha',  'cat' => 'Mini Sumo',       'parent_consent_status' => 'teslim_edildi', 'passport_valid_6m' => true,  'visa_status' => 'onaylandi',     'payment_status' => 'odendi',  'payment_amount' => 500.00, 'payment_currency' => 'EUR', 'result_rank' => 3,    'result_label' => 'Mini Sumo Bronz',    'result_notes' => 'Çok başarılı bir performans.'],
                ['team' => null,              'cat' => 'Algoritma',       'parent_consent_status' => 'alindi',        'passport_valid_6m' => false, 'visa_status' => 'gerekli_degil', 'payment_status' => 'odendi',  'payment_amount' => 450.00, 'payment_currency' => 'TRY', 'result_rank' => 5,    'result_label' => 'Yarı Final',         'result_notes' => null],
                ['team' => 'Code Wizards',    'cat' => 'Çizgi İzleyen',   'parent_consent_status' => 'teslim_edildi', 'passport_valid_6m' => false, 'visa_status' => 'gerekli_degil', 'payment_status' => 'kismi',   'payment_amount' => 200.00, 'payment_currency' => 'TRY', 'result_rank' => null, 'result_label' => 'Katılım Belgesi',    'result_notes' => null],
            ],
            // Öğrenci 2 — 2 yarışma, biri devam ediyor
            [
                ['team' => null,              'cat' => 'Algoritma',       'parent_consent_status' => 'alindi',   'passport_valid_6m' => false, 'visa_status' => 'gerekli_degil', 'payment_status' => 'bekliyor', 'payment_amount' => null,    'payment_currency' => 'TRY', 'result_rank' => null, 'result_label' => null, 'result_notes' => null],
                ['team' => 'Drone Masters',   'cat' => 'Drone',           'parent_consent_status' => 'bekliyor', 'passport_valid_6m' => true,  'visa_status' => 'basvuruldu',    'payment_status' => 'kismi',    'payment_amount' => 750.00,  'payment_currency' => 'EUR', 'result_rank' => null, 'result_label' => null, 'result_notes' => null],
            ],
            // Öğrenci 3 — 1 yarışma, dünya 1.si
            [
                ['team' => 'Türk Yıldızları', 'cat' => 'Mini Sumo',       'parent_consent_status' => 'teslim_edildi', 'passport_valid_6m' => true, 'visa_status' => 'onaylandi', 'payment_status' => 'odendi', 'payment_amount' => 1200.00, 'payment_currency' => 'EUR', 'result_rank' => 1, 'result_label' => 'Altın Madalya — Dünya 1.si', 'result_notes' => 'Takım kaptanı.'],
            ],
            // Öğrenci 4 — 2 yarışma, statüler henüz tamamlanmamış
            [
                ['team' => null,             'cat' => 'Bilim Olimpiyatı', 'parent_consent_status' => 'bekliyor', 'passport_valid_6m' => false, 'visa_status' => 'gerekli_degil', 'payment_status' => 'bekliyor', 'payment_amount' => null,   'payment_currency' => 'TRY', 'result_rank' => null, 'result_label' => null, 'result_notes' => null],
                ['team' => 'STEM Star',      'cat' => 'Çizgi İzleyen',    'parent_consent_status' => 'bekliyor', 'passport_valid_6m' => true,  'visa_status' => 'reddedildi',    'payment_status' => 'bekliyor', 'payment_amount' => null,   'payment_currency' => 'USD', 'result_rank' => null, 'result_label' => null, 'result_notes' => null],
            ],
        ];

        foreach ($students as $sIndex => $student) {
            $assignments = $scenarios[$sIndex] ?? [];
            $picks = $allCompetitions->shuffle()->take(count($assignments))->values();

            foreach ($assignments as $i => $entry) {
                $comp = $picks[$i] ?? $allCompetitions->first();
                // Yarışmaya bağlı kategoriden bul (varsa)
                $catId = null;
                $matchCat = $comp->categories->firstWhere('name', $entry['cat']);
                if ($matchCat) {
                    $catId = $matchCat->id;
                } elseif ($comp->categories->isNotEmpty()) {
                    $catId = $comp->categories->random()->id;
                }

                CompetitionStudent::updateOrCreate(
                    [
                        'student_id'     => $student->id,
                        'competition_id' => $comp->id,
                    ],
                    [
                        'competition_category_id' => $catId,
                        'team_name'               => $entry['team'],
                        'parent_consent_status'   => $entry['parent_consent_status'],
                        'passport_valid_6m'       => $entry['passport_valid_6m'],
                        'visa_status'             => $entry['visa_status'],
                        'payment_status'          => $entry['payment_status'],
                        'payment_amount'          => $entry['payment_amount'],
                        'payment_currency'        => $entry['payment_currency'],
                        'result_rank'             => $entry['result_rank'],
                        'result_label'            => $entry['result_label'],
                        'result_notes'            => $entry['result_notes'],
                        'joined_at'               => now()->subDays(rand(7, 200))->toDateString(),
                    ]
                );
            }
        }
    }
}
