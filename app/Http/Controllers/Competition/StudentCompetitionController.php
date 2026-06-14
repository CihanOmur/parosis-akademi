<?php

namespace App\Http\Controllers\Competition;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Competition;
use App\Models\CompetitionStudent;
use App\Models\Student\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentCompetitionController extends Controller
{
    /**
     * Öğrenci profilinden tek yarışmaya tek atama.
     */
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
            'competition_category_id' => 'nullable|exists:competition_categories,id',
            'team_name'               => 'nullable|string|max:200',
        ]);

        CompetitionStudent::create([
            'student_id'              => $student->id,
            'competition_id'          => $validated['competition_id'],
            'competition_category_id' => $validated['competition_category_id'] ?? null,
            'team_name'               => $validated['team_name'] ?? null,
            'joined_at'               => now()->toDateString(),
        ]);

        return redirect()->route('students.competitions', $student->id)
            ->with('success', 'Öğrenci yarışmaya eklendi.');
    }

    /**
     * Yarışma sayfasından çoklu öğrenci atama (toplu).
     */
    public function attachMultiple(Request $request, $competitionId)
    {
        $competition = Competition::findOrFail($competitionId);

        $validated = $request->validate([
            'student_ids'             => 'required|array|min:1',
            'student_ids.*'           => 'integer|exists:students,id',
            'competition_category_id' => 'nullable|exists:competition_categories,id',
            'team_name'               => 'nullable|string|max:200',
        ]);

        $existing = CompetitionStudent::where('competition_id', $competition->id)
            ->whereIn('student_id', $validated['student_ids'])
            ->pluck('student_id')
            ->toArray();

        $created = 0;
        foreach ($validated['student_ids'] as $sid) {
            if (in_array($sid, $existing)) continue;
            CompetitionStudent::create([
                'student_id'              => $sid,
                'competition_id'          => $competition->id,
                'competition_category_id' => $validated['competition_category_id'] ?? null,
                'team_name'               => $validated['team_name'] ?? null,
                'joined_at'               => now()->toDateString(),
            ]);
            $created++;
        }

        $msg = $created . ' öğrenci atandı.';
        if (count($existing)) $msg .= ' (' . count($existing) . ' öğrenci zaten kayıtlıydı, atlandı.)';

        return redirect()->route('competitions.show', $competition->id)->with('success', $msg);
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
            'competition_category_id' => ['nullable', 'exists:competition_categories,id'],
            'team_name'               => ['nullable', 'string', 'max:200'],
            'parent_consent_status'   => ['required', 'in:' . implode(',', array_keys(CompetitionStudent::PARENT_CONSENT))],
            'passport_valid_6m'       => ['nullable', 'boolean'],
            'visa_status'             => ['required', 'in:' . implode(',', array_keys(CompetitionStudent::VISA))],
            'payment_status'          => ['required', 'in:' . implode(',', array_keys(CompetitionStudent::PAYMENT))],
            'payment_amount'          => ['nullable', 'numeric', 'min:0', 'max:9999999.99'],
            'payment_currency'        => ['nullable', 'in:' . implode(',', CompetitionStudent::CURRENCIES)],
            'joined_at'               => ['nullable', 'date'],
        ]);

        $validated['passport_valid_6m'] = $request->boolean('passport_valid_6m');
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
            'result_file'    => ['nullable', 'file', 'mimes:pdf,png,jpg,jpeg,webp', 'max:10240'],
        ]);

        $entry->result_rank  = $validated['result_rank']  ?? null;
        $entry->result_label = $validated['result_label'] ?? null;
        $entry->result_notes = $validated['result_notes'] ?? null;

        if ($request->hasFile('result_file')) {
            if ($entry->result_file && file_exists(public_path($entry->result_file))) {
                @unlink(public_path($entry->result_file));
            }
            $entry->result_file = $this->saveResultFile($request->file('result_file'));
        }

        $entry->save();

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

    public function downloadResultFile($studentId, $entryId)
    {
        $student = Student::findOrFail($studentId);
        $entry = CompetitionStudent::where('student_id', $student->id)->findOrFail($entryId);

        if (!$entry->result_file || !file_exists(public_path($entry->result_file))) {
            abort(404, 'Sertifika/madalya dosyası bulunamadı.');
        }

        $abs = public_path($entry->result_file);
        $original = ($entry->competition->name ?? 'sertifika') . '.' . pathinfo($abs, PATHINFO_EXTENSION);
        return response()->download($abs, $original);
    }

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
            // Sertifika dosyasını yarışma sonuç dosyasından kopyala (opsiyonel)
            'file_path'    => $entry->result_file,
        ]);

        return redirect()->route('students.competitions', $student->id)
            ->with('success', 'Yarışma sonucundan sertifika oluşturuldu.');
    }

    private function saveResultFile($file): string
    {
        $dir = public_path('uploads/competition-results');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);
        return 'uploads/competition-results/' . $filename;
    }

    private function hasMatchingCertificate(Student $student, CompetitionStudent $entry): bool
    {
        return $student->certificates()
            ->where('type', Certificate::TYPE_COMPETITION)
            ->where('name', 'like', $entry->competition->name . '%')
            ->exists();
    }
}
