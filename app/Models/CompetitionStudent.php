<?php

namespace App\Models;

use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompetitionStudent extends Pivot
{
    protected $table = 'competition_student';

    public $incrementing = true;

    protected $fillable = [
        'student_id',
        'competition_id',
        'competition_category_id',
        'team_name',
        'parent_consent_status',
        'passport_status',
        'passport_valid_6m',
        'visa_status',
        'payment_status',
        'payment_amount',
        'payment_currency',
        'result_rank',
        'result_label',
        'result_notes',
        'result_file',
        'joined_at',
    ];

    protected $casts = [
        'payment_amount'    => 'decimal:2',
        'result_rank'       => 'integer',
        'joined_at'         => 'date',
        'passport_valid_6m' => 'boolean',
    ];

    public const PARENT_CONSENT = [
        'bekliyor'       => 'Alınmadı',
        'alindi'         => 'İmzalı Geldi',
        'teslim_edildi'  => 'Sistemde Yüklü',
    ];

    public const PASSPORT = [
        'yok'             => 'Yok',
        'var'             => 'Var',
        'kontrol_edildi'  => 'Kontrol Edildi',
    ];

    public const VISA = [
        'gerekli_degil'  => 'Muaf',
        'basvuruldu'     => 'Başvuruldu',
        'onaylandi'      => 'Onaylandı',
        'reddedildi'     => 'Reddedildi',
    ];

    public const PAYMENT = [
        'bekliyor' => 'Ödenmedi',
        'kismi'    => 'Kısmi Ödendi',
        'odendi'   => 'Tamamı Ödendi',
    ];

    public const CURRENCIES = ['TRY', 'EUR', 'USD'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CompetitionCategory::class, 'competition_category_id');
    }

    public function getParentConsentLabelAttribute(): string
    {
        return self::PARENT_CONSENT[$this->parent_consent_status] ?? '—';
    }

    public function getPassportLabelAttribute(): string
    {
        return self::PASSPORT[$this->passport_status] ?? '—';
    }

    public function getVisaLabelAttribute(): string
    {
        return self::VISA[$this->visa_status] ?? '—';
    }

    public function getPaymentLabelAttribute(): string
    {
        return self::PAYMENT[$this->payment_status] ?? '—';
    }
}
