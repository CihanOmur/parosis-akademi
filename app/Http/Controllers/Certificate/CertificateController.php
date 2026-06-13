<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Student\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CertificateController extends Controller
{
    public function store(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

        $validated = $this->validateRequest($request);

        $certificate = new Certificate();
        $certificate->student_id = $student->id;
        $certificate->fill($this->extractFillable($validated, $request));

        if ($request->hasFile('file')) {
            $certificate->file_path = $this->saveFile($request->file('file'));
        }

        $certificate->save();

        return redirect()
            ->route('students.certificates', $student->id)
            ->with('success', 'Sertifika başarıyla eklendi.')
    }

    public function update(Request $request, $studentId, $certificateId)
    {
        $student     = Student::findOrFail($studentId);
        $certificate = Certificate::where('student_id', $student->id)->findOrFail($certificateId);

        $validated = $this->validateRequest($request);

        $certificate->fill($this->extractFillable($validated, $request));

        if ($request->hasFile('file')) {
            // Eski dosyayı sil
            if ($certificate->file_path && file_exists(public_path($certificate->file_path))) {
                @unlink(public_path($certificate->file_path));
            }
            $certificate->file_path = $this->saveFile($request->file('file'));
        }

        $certificate->save();

        return redirect()
            ->route('students.certificates', $student->id)
            ->with('success', 'Sertifika güncellendi.')
    }

    public function destroy($studentId, $certificateId)
    {
        $student     = Student::findOrFail($studentId);
        $certificate = Certificate::where('student_id', $student->id)->findOrFail($certificateId);

        if ($certificate->file_path && file_exists(public_path($certificate->file_path))) {
            @unlink(public_path($certificate->file_path));
        }

        $certificate->delete();

        return redirect()
            ->route('students.certificates', $student->id)
            ->with('success', 'Sertifika silindi.')
    }

    public function download($studentId, $certificateId): BinaryFileResponse
    {
        $student     = Student::findOrFail($studentId);
        $certificate = Certificate::where('student_id', $student->id)->findOrFail($certificateId);

        if (!$certificate->file_path) {
            abort(404, 'Sertifika dosyası bulunamadı.');
        }

        $absolute = public_path($certificate->file_path);
        if (!file_exists($absolute)) {
            abort(404, 'Sertifika dosyası diskte yok.');
        }

        $original = $certificate->name . '.' . pathinfo($absolute, PATHINFO_EXTENSION);

        return response()->download($absolute, $original);
    }

    /**
     * Tüm endpoint'lerin paylaştığı validation kuralları.
     * Conditional: danismanlik için consulting_institution_id zorunlu, yarisma için issuer_text zorunlu.
     */
    private function validateRequest(Request $request): array
    {
        $rules = [
            'type'                => 'required|in:kurumsal,danismanlik,yarisma',
            'name'                => 'required|string|max:200',
            'category_id'         => 'nullable|exists:course_categories,id',
            'issue_date'          => 'required|date',
            'certificate_number'  => 'nullable|string|max:100',
            'file'                => 'nullable|file|mimes:pdf,png,jpg,jpeg,webp|max:10240',
            'notes'               => 'nullable|string|max:5000',
        ];

        if ($request->input('type') === Certificate::TYPE_CONSULTING) {
            $rules['consulting_institution_id'] = 'required|exists:consulting_institutions,id';
            $rules['issuer_text']               = 'nullable|string|max:200';
        } elseif ($request->input('type') === Certificate::TYPE_COMPETITION) {
            $rules['issuer_text']               = 'required|string|max:200';
            $rules['consulting_institution_id'] = 'nullable|exists:consulting_institutions,id';
        } else {
            $rules['consulting_institution_id'] = 'nullable|exists:consulting_institutions,id';
            $rules['issuer_text']               = 'nullable|string|max:200';
        }

        return $request->validate($rules);
    }

    /**
     * Sadece ilgili alanları (type'a göre) seç, diğerlerini sıfırla.
     */
    private function extractFillable(array $validated, Request $request): array
    {
        $type = $validated['type'];

        $data = [
            'type'                      => $type,
            'name'                      => $validated['name'],
            'category_id'               => $validated['category_id']        ?? null,
            'issue_date'                => $validated['issue_date'],
            'certificate_number'        => $validated['certificate_number'] ?? null,
            'notes'                     => $validated['notes']              ?? null,
            'consulting_institution_id' => null,
            'issuer_text'               => null,
        ];

        if ($type === Certificate::TYPE_CONSULTING) {
            $data['consulting_institution_id'] = $validated['consulting_institution_id'];
        } elseif ($type === Certificate::TYPE_COMPETITION) {
            $data['issuer_text'] = $validated['issuer_text'];
        }
        // kurumsal: kurum bilgisi runtime'da Setting::get('site_name')'den alınır

        return $data;
    }

    private function saveFile($file): string
    {
        $dir = public_path('uploads/certificates');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);
        return 'uploads/certificates/' . $filename;
    }
}
