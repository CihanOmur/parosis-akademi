<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Class\LessonClass;
use App\Models\Student\EmergencyContact;
use App\Models\Student\Student;
use App\Models\Student\StudentGuardian;
use App\Models\Student\StudentPayments;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('_clear')) {
            session()->forget('students_filter');
            return redirect()->route('students.index');
        }

        if ($request->has('_rm')) {
            $f = session('students_filter', []);
            match ($request->_rm) {
                'name'   => $f['name'] = '',
                'class'  => $f['class'] = array_values(array_filter((array)($f['class'] ?? []), fn($id) => $id !== (int)$request->_val)),
                'period' => $f['period'] = array_values(array_filter((array)($f['period'] ?? []), fn($p) => $p !== $request->_val)),
                default  => null,
            };
            session(['students_filter' => $f]);
            return redirect()->route('students.index', ['_f' => 1]);
        }

        if ($request->hasAny(['name', 'class', 'period'])) {
            session(['students_filter' => [
                'name'   => $request->input('name', ''),
                'class'  => array_map('intval', (array)$request->input('class', [])),
                'period' => (array)$request->input('period', []),
            ]]);
            return redirect()->route('students.index', ['_f' => 1]);
        }

        if (!$request->has('_f')) {
            session()->forget('students_filter');
        }

        $f               = session('students_filter', []);
        $filterName      = $f['name'] ?? '';
        $selectedClasses = array_values(array_filter(array_map('intval', (array)($f['class'] ?? []))));
        $selectedPeriods = array_values(array_filter((array)($f['period'] ?? [])));

        $students = Student::with('guardians', 'emergencyContact', 'lessonClass')->where('registration_type', 2)->orderBy('full_name', 'asc')
            ->when($filterName,      fn($q) => $q->where('full_name', 'like', '%' . $filterName . '%'))
            ->when($selectedClasses, fn($q) => $q->whereIn('class_id', $selectedClasses))
            ->when($selectedPeriods, fn($q) => $q->whereIn('registiration_term', $selectedPeriods))
            ->paginate(20);
        $normalCount = Student::where('registration_type', 2)->count();
        $preCount    = Student::where('registration_type', 1)->count();
        $classes     = LessonClass::all();

        return view('admin.students.index', compact('students', 'normalCount', 'preCount', 'classes', 'filterName', 'selectedClasses', 'selectedPeriods'));
    }

    public function create()
    {
        $classes = LessonClass::all();
        $education_levels = ['İlkokul', 'Ortaokul', 'Lise', 'Önlisans', 'Lisans', 'Diğer'];
        $jobs = ['İşçi', 'Memur', 'Öğretmen', 'Akademisyen', 'Doktor', 'Esnaf', 'Çiftçi', 'Öğrenci', 'Serbest meslek erbabı', 'Patron / İşveren', 'Diğer'];

        return view('admin.students.create', compact('classes', 'education_levels', 'jobs'));
    }

    public function store(Request $request)
    {
        if ($request->registiration_type == '1') {
            $validated = $request->validate([
                'first_registration_date' => 'nullable|date',
                'registiration_type' => 'required|in:1,2',
                'full_name' => 'required|string|max:200',
                'student_phone' => 'nullable|string|max:200',
                'gender' => 'nullable|in:Erkek,Kadın',
                'birth_date' => 'required|date',
                'school_name' => 'nullable|string|max:200',
                'tc_no' => 'nullable|string|max:11',
                'blood_type' => 'nullable|string|max:3',
                'class_id' => 'nullable|exists:lesson_classes,id',
                'has_allergy' => 'nullable',
                'allergy_detail' => 'required_if:has_allergy,1|max:500',
                'notes' => 'required|string|max:1000',

                'guardian1_full_name' => 'required|string|max:200',
                'guardian1_national_id' => 'nullable|string|max:11',
                'guardian1_relationship' => 'required|string|max:200',
                'guardian1_birth_date' => 'nullable|date',
                'guardian1_education_level' => 'nullable|string|max:200',
                'guardian1_job' => 'nullable|string|max:200',
                'guardian1_phone_1' => 'required|string|max:200',
                'guardian1_phone_2' => 'nullable|string|max:200',
                'guardian1_email' => 'nullable|email|max:200',
                'guardian1_home_address' => 'nullable|string|max:500',
                'guardian1_work_address' => 'nullable|string|max:500',

                'guardian2_active' => 'nullable|in:1,2',
                'guardian2_full_name'  => 'nullable|required_if:guardian2_active,1|string|max:200',
                'guardian2_national_id'  => 'nullable|string|max:11',
                'guardian2_relationship' => 'nullable|required_if:guardian2_active,1|string|max:200',
                'guardian2_birth_date'  => 'nullable|date',
                'guardian2_education_level'  => 'nullable|string|max:200',
                'guardian2_job' => 'nullable|string|max:200',
                'guardian2_phone_1'  => 'nullable|required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_2'  => 'nullable|string|max:200',
                'guardian2_email' => 'nullable|email|max:200',
                'guardian2_home_address'  => 'nullable|string|max:500',
                'guardian2_work_address'  => 'nullable|string|max:500',
            ], ValidationMessageService::getMessages('student_store_pre'));
        } else {
            $validated = $request->validate([
                'registiration_type' => 'required|in:1,2',
                'full_name' => 'required|string|max:200',
                'gender' => 'required|in:Erkek,Kadın',
                'student_phone' => 'nullable|string|max:200',
                'birth_date' => 'required|date',
                'school_name' => 'required|string|max:200',
                'tc_no' => 'required|string|max:11',
                'blood_type' => 'nullable|string|max:3',
                'class_id' => 'required|exists:lesson_classes,id',
                'has_allergy' => 'nullable',
                'allergy_detail' => 'required_if:has_allergy,1|max:500',
                'notes' => 'nullable|string|max:1000',
                'registiration_term' => 'required',

                'guardian1_full_name' => 'required|string|max:200',
                'guardian1_national_id' => 'required|string|max:11',
                'guardian1_relationship' => 'required|string|max:200',
                'guardian1_birth_date' => 'required|date',
                'guardian1_education_level' => 'required|string|max:200',
                'guardian1_job' => 'required|string|max:200',
                'guardian1_phone_1' => 'required|string|max:200',
                'guardian1_phone_2' => 'nullable|string|max:200',
                'guardian1_email' => 'required|email|max:200',
                'guardian1_home_address' => 'required|string|max:500',
                'guardian1_work_address' => 'nullable|string|max:500',

                'guardian2_active' => 'nullable|in:on',
                'guardian2_full_name'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_national_id'  => 'required_if:guardian2_active,1|string|max:11',
                'guardian2_relationship' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_birth_date'  => 'required_if:guardian2_active,1|date',
                'guardian2_education_level'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_job' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_1'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_2'  => 'nullable|string|max:200',
                'guardian2_email' => 'required_if:guardian2_active,1|email|max:200',
                'guardian2_home_address'  => 'required_if:guardian2_active,1|string|max:500',
                'guardian2_work_address'  => 'nullable|string|max:500',
            ], ValidationMessageService::getMessages('student_store_normal'));
        }

        $student = new Student();
        $student->registration_type  = $request->registiration_type;
        $student->full_name = $request->full_name;
        $student->gender = $request->gender;
        $student->birth_date = $request->birth_date;
        $student->school_name = $request->school_name;
        $student->national_id = $request->tc_no;
        $student->blood_type = $request->blood_type;
        $student->notes = $request->notes;
        $student->class_id = $request->class_id;
        $student->has_allergy = $request->has_allergy;
        $student->allergy_detail = $request->allergy_detail;
        $student->student_phone = $request->student_phone;
        $student->registiration_term = implode(',', $request->registiration_term ?? []);
        $student->created_at = $request->first_registration_date ?? now();
        $student->save();

        $studentGuardian1 = new StudentGuardian();
        $studentGuardian1->full_name = $request->guardian1_full_name;
        $studentGuardian1->national_id = $request->guardian1_national_id;
        $studentGuardian1->relationship = $request->guardian1_relationship;
        $studentGuardian1->birth_date = $request->guardian1_birth_date;
        $studentGuardian1->education_level = $request->guardian1_education_level;
        $studentGuardian1->job = $request->guardian1_job;
        $studentGuardian1->phone_1 = $request->guardian1_phone_1;
        $studentGuardian1->phone_2 = $request->guardian1_phone_2;
        $studentGuardian1->email = $request->guardian1_email;
        $studentGuardian1->home_address = $request->guardian1_home_address;
        $studentGuardian1->work_address = $request->guardian1_work_address;
        $studentGuardian1->active = true;
        $studentGuardian1->student_id = $student->id;
        $studentGuardian1->save();

        if ($request->has('guardian2_active') && $request->has('guardian2_active') == 'on') {
            $studentGuardian2 = new StudentGuardian();
            $studentGuardian2->full_name = $request->guardian2_full_name;
            $studentGuardian2->national_id = $request->guardian2_national_id;
            $studentGuardian2->relationship = $request->guardian2_relationship;
            $studentGuardian2->birth_date = $request->guardian2_birth_date;
            $studentGuardian2->education_level = $request->guardian2_education_level;
            $studentGuardian2->job = $request->guardian2_job;
            $studentGuardian2->phone_1 = $request->guardian2_phone_1;
            $studentGuardian2->phone_2 = $request->guardian2_phone_2;
            $studentGuardian2->email = $request->guardian2_email;
            $studentGuardian2->home_address = $request->guardian2_home_address;
            $studentGuardian2->work_address = $request->guardian2_work_address;
            $studentGuardian2->active = true;
            $studentGuardian2->student_id = $student->id;
            $studentGuardian2->save();
        }

        $emergency = new EmergencyContact();
        $emergency->student_id = $student->id;
        $emergency->full_name = $request->emergency_full_name;
        $emergency->relationship = $request->emergency_relationship;
        $emergency->phone = $request->emergency_phone;
        $emergency->address = $request->emergency_address;
        $emergency->save();

        $studentPayment = new StudentPayments();
        $studentPayment->student_id = $student->id;
        $studentPayment->class_id = $student->class_id;
        $studentPayment->registiration_term = implode(',', $request->registiration_term ?? []);
        $studentPayment->save();

        if ($student->registration_type == '2') {
            return view('admin.students-payments.create', [
                'payment' => $studentPayment->load('student', 'installments'),
                'first_create' => true
            ]);
        }
        return redirect()->route('students.index')->with('success', 'Öğrenci başarıyla eklendi.');
    }

    public function edit($id)
    {
        $classes = LessonClass::all();
        $education_levels = ['İlkokul', 'Ortaokul', 'Lise', 'Önlisans', 'Lisans', 'Diğer'];
        $jobs = ['İşçi', 'Memur', 'Öğretmen', 'Akademisyen', 'Doktor', 'Esnaf', 'Çiftçi', 'Öğrenci', 'Serbest meslek erbabı', 'Patron / İşveren', 'Diğer'];

        $student = Student::with(['guardians', 'emergencyContact'])->where('registration_type', '2')->findOrFail($id);
        $normalCount = Student::where('registration_type', 2)->count();
        $preCount = Student::where('registration_type', 1)->count();

        return view('admin.students.edit', compact('student', 'classes', 'education_levels', 'jobs', 'normalCount', 'preCount'));
    }

    public function update(Request $request, $id)
    {
        if ($request->registiration_type == '1') {
            $validated = $request->validate([
                'registiration_type' => 'required|in:1,2',
                'full_name' => 'required|string|max:200',
                'gender' => 'nullable|in:Erkek,Kadın',
                'birth_date' => 'required|date',
                'school_name' => 'nullable|string|max:200',
                'tc_no' => 'nullable|string|max:11',
                'blood_type' => 'nullable|string|max:3',
                'class_id' => 'nullable|exists:lesson_classes,id',
                'has_allergy' => 'nullable',
                'allergy_detail' => 'required_if:has_allergy,1|max:500',
                'notes' => 'required|string|max:1000',
                'student_phone' => 'nullable|string|max:200',

                'guardian1_full_name' => 'required|string|max:200',
                'guardian1_national_id' => 'nullable|string|max:11',
                'guardian1_relationship' => 'required|string|max:200',
                'guardian1_birth_date' => 'nullable|date',
                'guardian1_education_level' => 'nullable|string|max:200',
                'guardian1_job' => 'nullable|string|max:200',
                'guardian1_phone_1' => 'required|string|max:200',
                'guardian1_phone_2' => 'nullable|string|max:200',
                'guardian1_email' => 'nullable|email|max:200',
                'guardian1_home_address' => 'nullable|string|max:500',
                'guardian1_work_address' => 'nullable|string|max:500',

                'guardian2_active' => 'nullable|in:1,2',
                'guardian2_full_name'  => 'nullable|required_if:guardian2_active,1|string|max:200',
                'guardian2_national_id'  => 'nullable|string|max:11',
                'guardian2_relationship' => 'nullable|required_if:guardian2_active,1|string|max:200',
                'guardian2_birth_date'  => 'nullable|date',
                'guardian2_education_level'  => 'nullable|string|max:200',
                'guardian2_job' => 'nullable|string|max:200',
                'guardian2_phone_1'  => 'nullable|required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_2'  => 'nullable|string|max:200',
                'guardian2_email' => 'nullable|email|max:200',
                'guardian2_home_address'  => 'nullable|string|max:500',
                'guardian2_work_address'  => 'nullable|string|max:500',
            ], ValidationMessageService::getMessages('student_update_pre'));
        } else {
            $validated = $request->validate([
                'registiration_type' => 'required|in:1,2',
                'full_name' => 'required|string|max:200',
                'gender' => 'required|in:Erkek,Kadın',
                'birth_date' => 'required|date',
                'school_name' => 'required|string|max:200',
                'tc_no' => 'required|string|max:11',
                'blood_type' => 'nullable|string|max:3',
                'class_id' => 'required|exists:lesson_classes,id',
                'has_allergy' => 'nullable',
                'allergy_detail' => 'required_if:has_allergy,1|max:500',
                'notes' => 'nullable|string|max:1000',
                'student_phone' => 'nullable|string|max:200',
                'registiration_term' => 'required',

                'guardian1_full_name' => 'required|string|max:200',
                'guardian1_national_id' => 'required|string|max:11',
                'guardian1_relationship' => 'required|string|max:200',
                'guardian1_birth_date' => 'required|date',
                'guardian1_education_level' => 'required|string|max:200',
                'guardian1_job' => 'required|string|max:200',
                'guardian1_phone_1' => 'required|string|max:200',
                'guardian1_phone_2' => 'nullable|string|max:200',
                'guardian1_email' => 'required|email|max:200',
                'guardian1_home_address' => 'required|string|max:500',
                'guardian1_work_address' => 'nullable|string|max:500',

                'guardian2_active' => 'nullable|in:1,2',
                'guardian2_full_name'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_national_id'  => 'required_if:guardian2_active,1|string|max:11',
                'guardian2_relationship' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_birth_date'  => 'required_if:guardian2_active,1|date',
                'guardian2_education_level'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_job' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_1'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_2'  => 'nullable|string|max:200',
                'guardian2_email' => 'required_if:guardian2_active,1|email|max:200',
                'guardian2_home_address'  => 'required_if:guardian2_active,1|string|max:500',
                'guardian2_work_address'  => 'nullable|string|max:500',
            ], ValidationMessageService::getMessages('student_update_normal'));
        }

        $student  = Student::where('registration_type', '2')->findOrFail($id);
        $student->registration_type  = $request->registiration_type;
        $student->full_name = $request->full_name;
        $student->gender = $request->gender;
        $student->birth_date = $request->birth_date;
        $student->school_name = $request->school_name;
        $student->national_id = $request->tc_no;
        $student->blood_type = $request->blood_type;
        $student->notes = $request->notes;
        $student->class_id = $request->class_id;
        $student->has_allergy = $request->has_allergy;
        $student->allergy_detail = $request->allergy_detail;
        $student->student_phone = $request->student_phone;
        $student->registiration_term = implode(',', $request->registiration_term ?? []);
        $student->save();

        $studentGuardian1 = StudentGuardian::where('student_id', $student->id)->first();
        if (!$studentGuardian1) {
            $studentGuardian1 = new StudentGuardian();
        }
        $studentGuardian1->full_name = $request->guardian1_full_name;
        $studentGuardian1->national_id = $request->guardian1_national_id;
        $studentGuardian1->relationship = $request->guardian1_relationship;
        $studentGuardian1->birth_date = $request->guardian1_birth_date;
        $studentGuardian1->education_level = $request->guardian1_education_level;
        $studentGuardian1->job = $request->guardian1_job;
        $studentGuardian1->phone_1 = $request->guardian1_phone_1;
        $studentGuardian1->phone_2 = $request->guardian1_phone_2;
        $studentGuardian1->email = $request->guardian1_email;
        $studentGuardian1->home_address = $request->guardian1_home_address;
        $studentGuardian1->work_address = $request->guardian1_work_address;
        $studentGuardian1->student_id = $student->id;
        $studentGuardian1->save();

        $studentGuardian2 = StudentGuardian::where('student_id', $student->id)->skip(1)->first();
        if ($studentGuardian2) {
            if ($request->has('guardian2_active')) {
                $studentGuardian2->full_name = $request->guardian2_full_name;
                $studentGuardian2->national_id = $request->guardian2_national_id;
                $studentGuardian2->relationship = $request->guardian2_relationship;
                $studentGuardian2->birth_date = $request->guardian2_birth_date;
                $studentGuardian2->education_level = $request->guardian2_education_level;
                $studentGuardian2->job = $request->guardian2_job;
                $studentGuardian2->phone_1 = $request->guardian2_phone_1;
                $studentGuardian2->phone_2 = $request->guardian2_phone_2;
                $studentGuardian2->email = $request->guardian2_email;
                $studentGuardian2->home_address = $request->guardian2_home_address;
                $studentGuardian2->work_address = $request->guardian2_work_address;
                $studentGuardian2->active = true;
                $studentGuardian2->student_id = $student->id;
                $studentGuardian2->save();
            } else {
                $studentGuardian2->delete();
            }
        } else {
            if ($request->has('guardian2_active')) {
                $studentGuardian2 = new StudentGuardian();
                $studentGuardian2->full_name = $request->guardian2_full_name;
                $studentGuardian2->national_id = $request->guardian2_national_id;
                $studentGuardian2->relationship = $request->guardian2_relationship;
                $studentGuardian2->birth_date = $request->guardian2_birth_date;
                $studentGuardian2->education_level = $request->guardian2_education_level;
                $studentGuardian2->job = $request->guardian2_job;
                $studentGuardian2->phone_1 = $request->guardian2_phone_1;
                $studentGuardian2->phone_2 = $request->guardian2_phone_2;
                $studentGuardian2->email = $request->guardian2_email;
                $studentGuardian2->home_address = $request->guardian2_home_address;
                $studentGuardian2->work_address = $request->guardian2_work_address;
                $studentGuardian2->active = true;
                $studentGuardian2->student_id = $student->id;
                $studentGuardian2->save();
            }
        }

        $emergency = EmergencyContact::where('student_id', $student->id)->first();
        if (!$emergency) {
            $emergency = new EmergencyContact();
        }
        $emergency->student_id = $student->id;
        $emergency->full_name = $request->emergency_full_name;
        $emergency->relationship = $request->emergency_relationship;
        $emergency->phone = $request->emergency_phone;
        $emergency->address = $request->emergency_address;
        $emergency->save();

        return redirect()->route('students.index')->with('success', 'Öğrenci başarıyla güncellendi.');
    }

    public function changeActivity($id)
    {
        $student = Student::where('registration_type', '2')->findOrFail($id);
        $student->is_active = !$student->is_active;
        $student->save();
        return back()->with('success', 'Öğrenci durumu başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return back()->with('success', 'Öğrenci başarıyla silindi.');
    }
}
