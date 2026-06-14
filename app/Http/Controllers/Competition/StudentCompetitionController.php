<?php

namespace App\Http\Controllers\Competition;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Competition;
use App\Models\CompetitionStudent;
use App\Models\Student\Student;
use Illuminate\Http\Request;

class StudentCompetitionController extends Controller
{
    public function attach(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

        $validated = $request->validate([
            'competition_id' => [
                'required',
                'exists:competitions,id',
                function ($attr, $value, $fail) use ($student) {
                    if ($student->competitions()->where('competitions.id', $value)->exists()) {
                        $fail('Öğrenci zaten bu yarışmaya atanmış.');
                    }
                },
            ],
        ]);

        CompetitionStudent::create([
            'student_id'     => $student->id,
            'competition_id' => $validated['competition_id'],
            'joined_at'      => now()->toDateString(),
        ]);

        return redirect()->route('students.competitions', $student->id)
            ->with('success', 'Öğrenci yarışmaya eklendi.');
    }

    public function detach($studentId, $entryId)
    {
        $student = Student::findOrFail($studentId);
        $entry = CompetitionStudent::where('student_id', $student->id)->findOrFail($entryId);
        $entry->delete();

        return redirect()->route('students.competitions', $student->id)
            ->with('success', 'Öğrenci yarışmadan çıkartıldı.');
    }

    public function updateStatuses(Request $request, $studentId, $entryId)
    {
        $student = Student::findOrFail($studentId);
        $entry = CompetitionStudent::where('student_id', $student->id)->findOrFail($entryId);

        $validated = $request->validate([
            'parent_consent_status' => ['required', 'in:' . implode(',', array_keys(CompetitionStudent::PARENT_CONSENT))],
            'passport_status'       => ['required', 'in:' . implode(',', array_keys(CompetitionStudent::PASSPORT))],
            'visa_status'           => ['required', 'in:' . implode(',', array_keys(CompetitionStudent::VISA))],
            'payment_status'        => ['required', 'in:' . implode(',', array_keys(CompetitionStudent::PAYMENT))],
            'payment_amount'        => ['nullable', 'numeric', 'min:0', 'max:9999999.99'],
            'payment_currency'      => ['nullable', 'in:' . implode(',', CompetitionStudent::CURRENCIES)],
            'joined_at'             => ['nullable', 'date'],
        ]);

        $entry->fill($validated)->save();

        return redirect()->route('students.competitions', $student->id)
            ->with('success', 'Statü bilgileri güncellendi.');
    }

    public function updateResult(Request $request, $studentId, $entryId)
    {
        $student = Student::findOrFail($studentId);
        $entry = CompetitionStudent::where('student_id', $student->id)->findOrFail($entryId);

        $validated = $request->validate([
            'result_rank'    => ['nullable', 'integer', 'min:1', 'max:9999'],
            'result_label'   => ['nullable', 'string', 'max:100'],
            'result_notes'   => ['nullable', 'string', 'max:5000'],
        ]);

        $entry->fill($validated)->save();

        $hasResult = $entry->result_rank || $entry->result_label;
        $suggestCertificate = $hasResult && !$this->hasMatchingCertificate($student, $entry);

        return redirect()->route('students.competitions', $student->id)
            ->with('success', 'Sonuç bilgileri kaydedildi.')
            ->with('suggestCertificate', $suggestCertificate ? [
                'entry_id'     => $entry->id,
                'competition'  => $entry->competition->name,
                'organizer'    => $entry->competition->organizer,
                'result_label' => $entry->result_label,
                'result_rank'  => $entry->result_rank,
            ] : null);
    }

    /**
     * Yarışma sonucunu sertifika olarak otomatik oluştur.
     * Sadece "yarisma" tipi sertifika eklenir, issuer_text = competition.organizer ya da name.
     */
    public function createCertificateFromResult(Request $request, $studentId, $entryId)
    {
        $student = Student::findOrFail($studentId);
        $entry = CompetitionStudent::with('competition')
            ->where('student_id', $student->id)
            ->findOrFail($entryId);

        if (!$entry->result_rank && !$entry->result_label) {
            return back()->with('error', 'Önce yarışma sonucu girilmelidir.');
        }

        if ($this->hasMatchingCertificate($student, $entry)) {
            return back()->with('error', 'Bu yarışma için zaten sertifika eklenmiş.');
        }

        $name = $entry->competition->name;
        if ($entry->result_rank) {
            $name .= ' — ' . $entry->result_rank . '.lik';
        } elseif ($entry->result_label) {
            $name .= ' — ' . $entry->result_label;
        }

        Certificate::create([
            'student_id'   => $student->id,
            'type'         => Certificate::TYPE_COMPETITION,
            'name'         => $name,
            'issuer_text'  => $entry->competition->organizer ?: $entry->competition->name,
            'issue_date'   => $entry->competition->end_date ?: ($entry->competition->start_date ?: now()->toDateString()),
            'notes'        => $entry->result_notes,
        ]);

        return redirect()->route('students.competitions', $student->id)
            ->with('success', 'Yarışma sonucundan sertifika oluşturuldu.');
    }

    private function hasMatchingCertificate(Student $student, CompetitionStudent $entry): bool
    {
        return $student->certificates()
            ->where('type', Certificate::TYPE_COMPETITION)
            ->where('name', 'like', $entry->competition->name . '%')
            ->exists();
    }
}
