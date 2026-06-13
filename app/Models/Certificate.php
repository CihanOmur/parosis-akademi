<?php

namespace App\Models;

use App\Models\Courses\CourseCategory;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    // Sertifika türleri
    public const TYPE_CORPORATE   = 'kurumsal';     // Kendi kurumumuz tarafından verilen
    public const TYPE_CONSULTING  = 'danismanlik';  // Danışmanlık verdiğimiz kurum adına
    public const TYPE_COMPETITION = 'yarisma';      // Katılınan yarışma sertifikası

    public const TYPES = [
        self::TYPE_CORPORATE   => 'Kurumsal',
        self::TYPE_CONSULTING  => 'Danışmanlık',
        self::TYPE_COMPETITION => 'Yarışma',
    ];

    protected $fillable = [
        'student_id',
        'type',
        'name',
        'consulting_institution_id',
        'issuer_text',
        'category_id',
        'issue_date',
        'certificate_number',
        'file_path',
        'notes',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function consultingInstitution(): BelongsTo
    {
        return $this->belongsTo(ConsultingInstitution::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    /**
     * Türüne göre "veren kurum" metnini döndür.
     *  - kurumsal     → site_name (Setting)
     *  - danismanlik  → ConsultingInstitution.name
     *  - yarisma      → issuer_text
     */
    public function getIssuerNameAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_CORPORATE   => Setting::get('site_name', config('app.name', 'Parosis Akademi')),
            self::TYPE_CONSULTING  => $this->consultingInstitution?->name ?? '—',
            self::TYPE_COMPETITION => $this->issuer_text ?? '—',
            default                => '—',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }
}
