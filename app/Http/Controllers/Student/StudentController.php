<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Class\LessonClass;
use App\Models\Student\EmergencyContact;
use App\Models\Student\Student;
use App\Models\Student\StudentGuardian;
use App\Models\StudentPayments;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('guardians', 'emergencyContact', 'lessonClass')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classes = LessonClass::all();
        $education_levels = ['İlköğretim', 'Ortaöğretim', 'Önlisans', 'Lisans', 'Diğer'];
        $jobs = ['İşçi', 'Memur', 'Öğretmen', 'Akademisyen', 'Doktor', 'Esnaf', 'Çiftçi', 'Öğrenci', 'Serbest meslek erbabı', 'Patron / İşveren', 'Diğer'];

        return view('admin.students.create', compact('classes', 'education_levels', 'jobs'));
    }

    public function store(Request $request)
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
            ], [
                // Genel
                'registiration_type.required' => 'Kayıt türü seçilmelidir.',
                'registiration_type.in' => 'Kayıt türü yalnızca 1 veya 2 olabilir.',
                'full_name.required' => 'Öğrencinin adı soyadı zorunludur.',
                'full_name.max' => 'Öğrencinin adı soyadı en fazla 200 karakter olabilir.',
                'gender.required' => 'Cinsiyet seçilmelidir.',
                'birth_date.required' => 'Doğum tarihi girilmelidir.',
                'school_name.required' => 'Okul adı zorunludur.',
                'school_name.max' => 'Okul adı en fazla 200 karakter olabilir.',
                'tc_no.required' => 'TC Kimlik Numarası zorunludur.',
                'tc_no.max' => 'TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'blood_type.required' => 'Kan grubu zorunludur.',
                'blood_type.max' => 'Kan grubu en fazla 3 karakter olabilir.',
                'class_id.required' => 'Sınıf seçilmelidir.',
                'class_id.exists' => 'Seçilen sınıf mevcut değil.',
                'allergy_detail.required_if' => 'Alerji bilgisi seçildiyse detay alanı zorunludur.',
                'allergy_detail.max' => 'Alerji detayı en fazla 500 karakter olabilir.',
                'notes.max' => 'Notlar en fazla 1000 karakter olabilir.',

                // Veli 1
                'guardian1_full_name.required' => '1. velinin adı soyadı zorunludur.',
                'guardian1_full_name.max' => '1. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian1_national_id.required' => '1. velinin TC Kimlik Numarası zorunludur.',
                'guardian1_national_id.max' => '1. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian1_relationship.required' => '1. velinin öğrenci ile yakınlığı belirtilmelidir.',
                'guardian1_relationship.max' => '1. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian1_birth_date.required' => '1. velinin doğum tarihi girilmelidir.',
                'guardian1_education_level.required' => '1. velinin eğitim durumu zorunludur.',
                'guardian1_education_level.max' => '1. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian1_job.required' => '1. velinin mesleği girilmelidir.',
                'guardian1_job.max' => '1. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian1_phone_1.required' => '1. velinin birinci telefon numarası girilmelidir.',
                'guardian1_phone_1.max' => '1. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_phone_2.required' => '1. velinin ikinci telefon numarası girilmelidir.',
                'guardian1_phone_2.max' => '1. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_email.required' => '1. velinin e-posta adresi girilmelidir.',
                'guardian1_email.email' => '1. velinin e-posta adresi geçerli olmalıdır.',
                'guardian1_email.max' => '1. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian1_home_address.required' => '1. velinin ev adresi girilmelidir.',
                'guardian1_home_address.max' => '1. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian1_work_address.required' => '1. velinin iş adresi girilmelidir.',
                'guardian1_work_address.max' => '1. velinin iş adresi en fazla 500 karakter olabilir.',

                // Veli 2
                'guardian2_full_name.required_if' => '2. veli aktif seçildiğinde adı soyadı zorunludur.',
                'guardian2_full_name.max' => '2. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian2_national_id.required_if' => '2. veli aktif seçildiğinde TC Kimlik Numarası zorunludur.',
                'guardian2_national_id.max' => '2. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian2_relationship.required_if' => '2. veli aktif seçildiğinde öğrenci ile yakınlık girilmelidir.',
                'guardian2_relationship.max' => '2. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian2_birth_date.required_if' => '2. veli aktif seçildiğinde doğum tarihi girilmelidir.',
                'guardian2_education_level.required_if' => '2. veli aktif seçildiğinde eğitim durumu girilmelidir.',
                'guardian2_education_level.max' => '2. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian2_job.required_if' => '2. veli aktif seçildiğinde mesleği girilmelidir.',
                'guardian2_job.max' => '2. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian2_phone_1.required_if' => '2. veli aktif seçildiğinde birinci telefon numarası zorunludur.',
                'guardian2_phone_1.max' => '2. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_phone_2.required_if' => '2. veli aktif seçildiğinde ikinci telefon numarası zorunludur.',
                'guardian2_phone_2.max' => '2. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_email.required_if' => '2. veli aktif seçildiğinde e-posta adresi zorunludur.',
                'guardian2_email.email' => '2. velinin e-posta adresi geçerli olmalıdır.',
                'guardian2_email.max' => '2. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian2_home_address.required_if' => '2. veli aktif seçildiğinde ev adresi zorunludur.',
                'guardian2_home_address.max' => '2. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian2_work_address.required_if' => '2. veli aktif seçildiğinde iş adresi zorunludur.',
                'guardian2_work_address.max' => '2. velinin iş adresi en fazla 500 karakter olabilir.',
            ]);
        } else {
            $validated = $request->validate([
                'registiration_type' => 'required|in:1,2',
                'full_name' => 'required|string|max:200',
                'gender' => 'required|in:Erkek,Kadın',
                'birth_date' => 'required|date',
                'school_name' => 'required|string|max:200',
                'tc_no' => 'required|string|max:11',
                'blood_type' => 'required|string|max:3',
                'class_id' => 'required|exists:lesson_classes,id',
                'has_allergy' => 'nullable',
                'allergy_detail' => 'required_if:has_allergy,1|max:500',
                'notes' => 'nullable|string|max:1000',

                'guardian1_full_name' => 'required|string|max:200',
                'guardian1_national_id' => 'required|string|max:11',
                'guardian1_relationship' => 'required|string|max:200',
                'guardian1_birth_date' => 'required|date',
                'guardian1_education_level' => 'required|string|max:200',
                'guardian1_job' => 'required|string|max:200',
                'guardian1_phone_1' => 'required|string|max:200',
                'guardian1_phone_2' => 'required|string|max:200',
                'guardian1_email' => 'required|email|max:200',
                'guardian1_home_address' => 'required|string|max:500',
                'guardian1_work_address' => 'required|string|max:500',

                'guardian2_active' => 'nullable|in:on',
                'guardian2_full_name'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_national_id'  => 'required_if:guardian2_active,1|string|max:11',
                'guardian2_relationship' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_birth_date'  => 'required_if:guardian2_active,1|date',
                'guardian2_education_level'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_job' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_1'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_2'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_email' => 'required_if:guardian2_active,1|email|max:200',
                'guardian2_home_address'  => 'required_if:guardian2_active,1|string|max:500',
                'guardian2_work_address'  => 'required_if:guardian2_active,1|string|max:500',
            ], [
                // Genel
                'registiration_type.required' => 'Kayıt türü seçilmelidir.',
                'registiration_type.in' => 'Kayıt türü yalnızca 1 veya 2 olabilir.',
                'full_name.required' => 'Öğrencinin adı soyadı zorunludur.',
                'full_name.max' => 'Öğrencinin adı soyadı en fazla 200 karakter olabilir.',
                'gender.required' => 'Cinsiyet seçilmelidir.',
                'birth_date.required' => 'Doğum tarihi girilmelidir.',
                'school_name.required' => 'Okul adı zorunludur.',
                'school_name.max' => 'Okul adı en fazla 200 karakter olabilir.',
                'tc_no.required' => 'TC Kimlik Numarası zorunludur.',
                'tc_no.max' => 'TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'blood_type.required' => 'Kan grubu zorunludur.',
                'blood_type.max' => 'Kan grubu en fazla 3 karakter olabilir.',
                'class_id.required' => 'Sınıf seçilmelidir.',
                'class_id.exists' => 'Seçilen sınıf mevcut değil.',
                'allergy_detail.required_if' => 'Alerji bilgisi seçildiyse detay alanı zorunludur.',
                'allergy_detail.max' => 'Alerji detayı en fazla 500 karakter olabilir.',
                'notes.max' => 'Notlar en fazla 1000 karakter olabilir.',

                // Veli 1
                'guardian1_full_name.required' => '1. velinin adı soyadı zorunludur.',
                'guardian1_full_name.max' => '1. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian1_national_id.required' => '1. velinin TC Kimlik Numarası zorunludur.',
                'guardian1_national_id.max' => '1. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian1_relationship.required' => '1. velinin öğrenci ile yakınlığı belirtilmelidir.',
                'guardian1_relationship.max' => '1. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian1_birth_date.required' => '1. velinin doğum tarihi girilmelidir.',
                'guardian1_education_level.required' => '1. velinin eğitim durumu zorunludur.',
                'guardian1_education_level.max' => '1. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian1_job.required' => '1. velinin mesleği girilmelidir.',
                'guardian1_job.max' => '1. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian1_phone_1.required' => '1. velinin birinci telefon numarası girilmelidir.',
                'guardian1_phone_1.max' => '1. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_phone_2.required' => '1. velinin ikinci telefon numarası girilmelidir.',
                'guardian1_phone_2.max' => '1. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_email.required' => '1. velinin e-posta adresi girilmelidir.',
                'guardian1_email.email' => '1. velinin e-posta adresi geçerli olmalıdır.',
                'guardian1_email.max' => '1. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian1_home_address.required' => '1. velinin ev adresi girilmelidir.',
                'guardian1_home_address.max' => '1. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian1_work_address.required' => '1. velinin iş adresi girilmelidir.',
                'guardian1_work_address.max' => '1. velinin iş adresi en fazla 500 karakter olabilir.',

                // Veli 2
                'guardian2_full_name.required_if' => '2. veli aktif seçildiğinde adı soyadı zorunludur.',
                'guardian2_full_name.max' => '2. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian2_national_id.required_if' => '2. veli aktif seçildiğinde TC Kimlik Numarası zorunludur.',
                'guardian2_national_id.max' => '2. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian2_relationship.required_if' => '2. veli aktif seçildiğinde öğrenci ile yakınlık girilmelidir.',
                'guardian2_relationship.max' => '2. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian2_birth_date.required_if' => '2. veli aktif seçildiğinde doğum tarihi girilmelidir.',
                'guardian2_education_level.required_if' => '2. veli aktif seçildiğinde eğitim durumu girilmelidir.',
                'guardian2_education_level.max' => '2. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian2_job.required_if' => '2. veli aktif seçildiğinde mesleği girilmelidir.',
                'guardian2_job.max' => '2. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian2_phone_1.required_if' => '2. veli aktif seçildiğinde birinci telefon numarası zorunludur.',
                'guardian2_phone_1.max' => '2. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_phone_2.required_if' => '2. veli aktif seçildiğinde ikinci telefon numarası zorunludur.',
                'guardian2_phone_2.max' => '2. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_email.required_if' => '2. veli aktif seçildiğinde e-posta adresi zorunludur.',
                'guardian2_email.email' => '2. velinin e-posta adresi geçerli olmalıdır.',
                'guardian2_email.max' => '2. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian2_home_address.required_if' => '2. veli aktif seçildiğinde ev adresi zorunludur.',
                'guardian2_home_address.max' => '2. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian2_work_address.required_if' => '2. veli aktif seçildiğinde iş adresi zorunludur.',
                'guardian2_work_address.max' => '2. velinin iş adresi en fazla 500 karakter olabilir.',
            ]);
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
        $studentPayment->save();

        if ($student->registration_type == '2') {
            return redirect()->route('students.payment', ['id' => $studentPayment->id]);
        }
        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    public function edit($id)
    {
        $classes = LessonClass::all();
        $education_levels = ['İlköğretim', 'Ortaöğretim', 'Önlisans', 'Lisans', 'Diğer'];
        $jobs = ['İşçi', 'Memur', 'Öğretmen', 'Akademisyen', 'Doktor', 'Esnaf', 'Çiftçi', 'Öğrenci', 'Serbest meslek erbabı', 'Patron / İşveren', 'Diğer'];

        $student = Student::with(['guardians', 'emergencyContact'])->findOrFail($id);


        return view('admin.students.edit', compact('student', 'classes', 'education_levels', 'jobs'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
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
            ], [
                // Genel
                'registiration_type.required' => 'Kayıt türü seçilmelidir.',
                'registiration_type.in' => 'Kayıt türü yalnızca 1 veya 2 olabilir.',
                'full_name.required' => 'Öğrencinin adı soyadı zorunludur.',
                'full_name.max' => 'Öğrencinin adı soyadı en fazla 200 karakter olabilir.',
                'gender.required' => 'Cinsiyet seçilmelidir.',
                'birth_date.required' => 'Doğum tarihi girilmelidir.',
                'school_name.required' => 'Okul adı zorunludur.',
                'school_name.max' => 'Okul adı en fazla 200 karakter olabilir.',
                'tc_no.required' => 'TC Kimlik Numarası zorunludur.',
                'tc_no.max' => 'TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'blood_type.required' => 'Kan grubu zorunludur.',
                'blood_type.max' => 'Kan grubu en fazla 3 karakter olabilir.',
                'class_id.required' => 'Sınıf seçilmelidir.',
                'class_id.exists' => 'Seçilen sınıf mevcut değil.',
                'allergy_detail.required_if' => 'Alerji bilgisi seçildiyse detay alanı zorunludur.',
                'allergy_detail.max' => 'Alerji detayı en fazla 500 karakter olabilir.',
                'notes.max' => 'Notlar en fazla 1000 karakter olabilir.',

                // Veli 1
                'guardian1_full_name.required' => '1. velinin adı soyadı zorunludur.',
                'guardian1_full_name.max' => '1. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian1_national_id.required' => '1. velinin TC Kimlik Numarası zorunludur.',
                'guardian1_national_id.max' => '1. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian1_relationship.required' => '1. velinin öğrenci ile yakınlığı belirtilmelidir.',
                'guardian1_relationship.max' => '1. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian1_birth_date.required' => '1. velinin doğum tarihi girilmelidir.',
                'guardian1_education_level.required' => '1. velinin eğitim durumu zorunludur.',
                'guardian1_education_level.max' => '1. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian1_job.required' => '1. velinin mesleği girilmelidir.',
                'guardian1_job.max' => '1. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian1_phone_1.required' => '1. velinin birinci telefon numarası girilmelidir.',
                'guardian1_phone_1.max' => '1. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_phone_2.required' => '1. velinin ikinci telefon numarası girilmelidir.',
                'guardian1_phone_2.max' => '1. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_email.required' => '1. velinin e-posta adresi girilmelidir.',
                'guardian1_email.email' => '1. velinin e-posta adresi geçerli olmalıdır.',
                'guardian1_email.max' => '1. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian1_home_address.required' => '1. velinin ev adresi girilmelidir.',
                'guardian1_home_address.max' => '1. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian1_work_address.required' => '1. velinin iş adresi girilmelidir.',
                'guardian1_work_address.max' => '1. velinin iş adresi en fazla 500 karakter olabilir.',

                // Veli 2
                'guardian2_full_name.required_if' => '2. veli aktif seçildiğinde adı soyadı zorunludur.',
                'guardian2_full_name.max' => '2. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian2_national_id.required_if' => '2. veli aktif seçildiğinde TC Kimlik Numarası zorunludur.',
                'guardian2_national_id.max' => '2. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian2_relationship.required_if' => '2. veli aktif seçildiğinde öğrenci ile yakınlık girilmelidir.',
                'guardian2_relationship.max' => '2. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian2_birth_date.required_if' => '2. veli aktif seçildiğinde doğum tarihi girilmelidir.',
                'guardian2_education_level.required_if' => '2. veli aktif seçildiğinde eğitim durumu girilmelidir.',
                'guardian2_education_level.max' => '2. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian2_job.required_if' => '2. veli aktif seçildiğinde mesleği girilmelidir.',
                'guardian2_job.max' => '2. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian2_phone_1.required_if' => '2. veli aktif seçildiğinde birinci telefon numarası zorunludur.',
                'guardian2_phone_1.max' => '2. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_phone_2.required_if' => '2. veli aktif seçildiğinde ikinci telefon numarası zorunludur.',
                'guardian2_phone_2.max' => '2. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_email.required_if' => '2. veli aktif seçildiğinde e-posta adresi zorunludur.',
                'guardian2_email.email' => '2. velinin e-posta adresi geçerli olmalıdır.',
                'guardian2_email.max' => '2. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian2_home_address.required_if' => '2. veli aktif seçildiğinde ev adresi zorunludur.',
                'guardian2_home_address.max' => '2. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian2_work_address.required_if' => '2. veli aktif seçildiğinde iş adresi zorunludur.',
                'guardian2_work_address.max' => '2. velinin iş adresi en fazla 500 karakter olabilir.',
            ]);
        } else {
            $validated = $request->validate([
                'registiration_type' => 'required|in:1,2',
                'full_name' => 'required|string|max:200',
                'gender' => 'required|in:Erkek,Kadın',
                'birth_date' => 'required|date',
                'school_name' => 'required|string|max:200',
                'tc_no' => 'required|string|max:11',
                'blood_type' => 'required|string|max:3',
                'class_id' => 'required|exists:lesson_classes,id',
                'has_allergy' => 'nullable',
                'allergy_detail' => 'required_if:has_allergy,1|max:500',
                'notes' => 'nullable|string|max:1000',

                'guardian1_full_name' => 'required|string|max:200',
                'guardian1_national_id' => 'required|string|max:11',
                'guardian1_relationship' => 'required|string|max:200',
                'guardian1_birth_date' => 'required|date',
                'guardian1_education_level' => 'required|string|max:200',
                'guardian1_job' => 'required|string|max:200',
                'guardian1_phone_1' => 'required|string|max:200',
                'guardian1_phone_2' => 'required|string|max:200',
                'guardian1_email' => 'required|email|max:200',
                'guardian1_home_address' => 'required|string|max:500',
                'guardian1_work_address' => 'required|string|max:500',

                'guardian2_active' => 'nullable|in:1,2',
                'guardian2_full_name'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_national_id'  => 'required_if:guardian2_active,1|string|max:11',
                'guardian2_relationship' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_birth_date'  => 'required_if:guardian2_active,1|date',
                'guardian2_education_level'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_job' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_1'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_2'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_email' => 'required_if:guardian2_active,1|email|max:200',
                'guardian2_home_address'  => 'required_if:guardian2_active,1|string|max:500',
                'guardian2_work_address'  => 'required_if:guardian2_active,1|string|max:500',
            ], [
                // Genel
                'registiration_type.required' => 'Kayıt türü seçilmelidir.',
                'registiration_type.in' => 'Kayıt türü yalnızca 1 veya 2 olabilir.',
                'full_name.required' => 'Öğrencinin adı soyadı zorunludur.',
                'full_name.max' => 'Öğrencinin adı soyadı en fazla 200 karakter olabilir.',
                'gender.required' => 'Cinsiyet seçilmelidir.',
                'birth_date.required' => 'Doğum tarihi girilmelidir.',
                'school_name.required' => 'Okul adı zorunludur.',
                'school_name.max' => 'Okul adı en fazla 200 karakter olabilir.',
                'tc_no.required' => 'TC Kimlik Numarası zorunludur.',
                'tc_no.max' => 'TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'blood_type.required' => 'Kan grubu zorunludur.',
                'blood_type.max' => 'Kan grubu en fazla 3 karakter olabilir.',
                'class_id.required' => 'Sınıf seçilmelidir.',
                'class_id.exists' => 'Seçilen sınıf mevcut değil.',
                'allergy_detail.required_if' => 'Alerji bilgisi seçildiyse detay alanı zorunludur.',
                'allergy_detail.max' => 'Alerji detayı en fazla 500 karakter olabilir.',
                'notes.max' => 'Notlar en fazla 1000 karakter olabilir.',

                // Veli 1
                'guardian1_full_name.required' => '1. velinin adı soyadı zorunludur.',
                'guardian1_full_name.max' => '1. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian1_national_id.required' => '1. velinin TC Kimlik Numarası zorunludur.',
                'guardian1_national_id.max' => '1. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian1_relationship.required' => '1. velinin öğrenci ile yakınlığı belirtilmelidir.',
                'guardian1_relationship.max' => '1. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian1_birth_date.required' => '1. velinin doğum tarihi girilmelidir.',
                'guardian1_education_level.required' => '1. velinin eğitim durumu zorunludur.',
                'guardian1_education_level.max' => '1. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian1_job.required' => '1. velinin mesleği girilmelidir.',
                'guardian1_job.max' => '1. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian1_phone_1.required' => '1. velinin birinci telefon numarası girilmelidir.',
                'guardian1_phone_1.max' => '1. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_phone_2.required' => '1. velinin ikinci telefon numarası girilmelidir.',
                'guardian1_phone_2.max' => '1. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_email.required' => '1. velinin e-posta adresi girilmelidir.',
                'guardian1_email.email' => '1. velinin e-posta adresi geçerli olmalıdır.',
                'guardian1_email.max' => '1. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian1_home_address.required' => '1. velinin ev adresi girilmelidir.',
                'guardian1_home_address.max' => '1. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian1_work_address.required' => '1. velinin iş adresi girilmelidir.',
                'guardian1_work_address.max' => '1. velinin iş adresi en fazla 500 karakter olabilir.',

                // Veli 2
                'guardian2_full_name.required_if' => '2. veli aktif seçildiğinde adı soyadı zorunludur.',
                'guardian2_full_name.max' => '2. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian2_national_id.required_if' => '2. veli aktif seçildiğinde TC Kimlik Numarası zorunludur.',
                'guardian2_national_id.max' => '2. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian2_relationship.required_if' => '2. veli aktif seçildiğinde öğrenci ile yakınlık girilmelidir.',
                'guardian2_relationship.max' => '2. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian2_birth_date.required_if' => '2. veli aktif seçildiğinde doğum tarihi girilmelidir.',
                'guardian2_education_level.required_if' => '2. veli aktif seçildiğinde eğitim durumu girilmelidir.',
                'guardian2_education_level.max' => '2. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian2_job.required_if' => '2. veli aktif seçildiğinde mesleği girilmelidir.',
                'guardian2_job.max' => '2. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian2_phone_1.required_if' => '2. veli aktif seçildiğinde birinci telefon numarası zorunludur.',
                'guardian2_phone_1.max' => '2. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_phone_2.required_if' => '2. veli aktif seçildiğinde ikinci telefon numarası zorunludur.',
                'guardian2_phone_2.max' => '2. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_email.required_if' => '2. veli aktif seçildiğinde e-posta adresi zorunludur.',
                'guardian2_email.email' => '2. velinin e-posta adresi geçerli olmalıdır.',
                'guardian2_email.max' => '2. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian2_home_address.required_if' => '2. veli aktif seçildiğinde ev adresi zorunludur.',
                'guardian2_home_address.max' => '2. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian2_work_address.required_if' => '2. veli aktif seçildiğinde iş adresi zorunludur.',
                'guardian2_work_address.max' => '2. velinin iş adresi en fazla 500 karakter olabilir.',
            ]);
        }
        $student  = Student::findOrFail($id);
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

        dd($emergency);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }
    public function reCreate($id)
    {
        $classes = LessonClass::all();
        $education_levels = ['İlköğretim', 'Ortaöğretim', 'Önlisans', 'Lisans', 'Diğer'];
        $jobs = ['İşçi', 'Memur', 'Öğretmen', 'Akademisyen', 'Doktor', 'Esnaf', 'Çiftçi', 'Öğrenci', 'Serbest meslek erbabı', 'Patron / İşveren', 'Diğer'];

        $student = Student::with(['guardians', 'emergencyContact'])->findOrFail($id);


        return view('admin.students.re-create', compact('student', 'classes', 'education_levels', 'jobs'));
    }
    public function reCreateUpdate(Request $request, $id)
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
            ], [
                // Genel
                'registiration_type.required' => 'Kayıt türü seçilmelidir.',
                'registiration_type.in' => 'Kayıt türü yalnızca 1 veya 2 olabilir.',
                'full_name.required' => 'Öğrencinin adı soyadı zorunludur.',
                'full_name.max' => 'Öğrencinin adı soyadı en fazla 200 karakter olabilir.',
                'gender.required' => 'Cinsiyet seçilmelidir.',
                'birth_date.required' => 'Doğum tarihi girilmelidir.',
                'school_name.required' => 'Okul adı zorunludur.',
                'school_name.max' => 'Okul adı en fazla 200 karakter olabilir.',
                'tc_no.required' => 'TC Kimlik Numarası zorunludur.',
                'tc_no.max' => 'TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'blood_type.required' => 'Kan grubu zorunludur.',
                'blood_type.max' => 'Kan grubu en fazla 3 karakter olabilir.',
                'class_id.required' => 'Sınıf seçilmelidir.',
                'class_id.exists' => 'Seçilen sınıf mevcut değil.',
                'allergy_detail.required_if' => 'Alerji bilgisi seçildiyse detay alanı zorunludur.',
                'allergy_detail.max' => 'Alerji detayı en fazla 500 karakter olabilir.',
                'notes.max' => 'Notlar en fazla 1000 karakter olabilir.',

                // Veli 1
                'guardian1_full_name.required' => '1. velinin adı soyadı zorunludur.',
                'guardian1_full_name.max' => '1. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian1_national_id.required' => '1. velinin TC Kimlik Numarası zorunludur.',
                'guardian1_national_id.max' => '1. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian1_relationship.required' => '1. velinin öğrenci ile yakınlığı belirtilmelidir.',
                'guardian1_relationship.max' => '1. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian1_birth_date.required' => '1. velinin doğum tarihi girilmelidir.',
                'guardian1_education_level.required' => '1. velinin eğitim durumu zorunludur.',
                'guardian1_education_level.max' => '1. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian1_job.required' => '1. velinin mesleği girilmelidir.',
                'guardian1_job.max' => '1. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian1_phone_1.required' => '1. velinin birinci telefon numarası girilmelidir.',
                'guardian1_phone_1.max' => '1. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_phone_2.required' => '1. velinin ikinci telefon numarası girilmelidir.',
                'guardian1_phone_2.max' => '1. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_email.required' => '1. velinin e-posta adresi girilmelidir.',
                'guardian1_email.email' => '1. velinin e-posta adresi geçerli olmalıdır.',
                'guardian1_email.max' => '1. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian1_home_address.required' => '1. velinin ev adresi girilmelidir.',
                'guardian1_home_address.max' => '1. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian1_work_address.required' => '1. velinin iş adresi girilmelidir.',
                'guardian1_work_address.max' => '1. velinin iş adresi en fazla 500 karakter olabilir.',

                // Veli 2
                'guardian2_full_name.required_if' => '2. veli aktif seçildiğinde adı soyadı zorunludur.',
                'guardian2_full_name.max' => '2. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian2_national_id.required_if' => '2. veli aktif seçildiğinde TC Kimlik Numarası zorunludur.',
                'guardian2_national_id.max' => '2. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian2_relationship.required_if' => '2. veli aktif seçildiğinde öğrenci ile yakınlık girilmelidir.',
                'guardian2_relationship.max' => '2. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian2_birth_date.required_if' => '2. veli aktif seçildiğinde doğum tarihi girilmelidir.',
                'guardian2_education_level.required_if' => '2. veli aktif seçildiğinde eğitim durumu girilmelidir.',
                'guardian2_education_level.max' => '2. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian2_job.required_if' => '2. veli aktif seçildiğinde mesleği girilmelidir.',
                'guardian2_job.max' => '2. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian2_phone_1.required_if' => '2. veli aktif seçildiğinde birinci telefon numarası zorunludur.',
                'guardian2_phone_1.max' => '2. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_phone_2.required_if' => '2. veli aktif seçildiğinde ikinci telefon numarası zorunludur.',
                'guardian2_phone_2.max' => '2. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_email.required_if' => '2. veli aktif seçildiğinde e-posta adresi zorunludur.',
                'guardian2_email.email' => '2. velinin e-posta adresi geçerli olmalıdır.',
                'guardian2_email.max' => '2. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian2_home_address.required_if' => '2. veli aktif seçildiğinde ev adresi zorunludur.',
                'guardian2_home_address.max' => '2. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian2_work_address.required_if' => '2. veli aktif seçildiğinde iş adresi zorunludur.',
                'guardian2_work_address.max' => '2. velinin iş adresi en fazla 500 karakter olabilir.',
            ]);
        } else {
            $validated = $request->validate([
                'registiration_type' => 'required|in:1,2',
                'full_name' => 'required|string|max:200',
                'gender' => 'required|in:Erkek,Kadın',
                'birth_date' => 'required|date',
                'school_name' => 'required|string|max:200',
                'tc_no' => 'required|string|max:11',
                'blood_type' => 'required|string|max:3',
                'class_id' => 'required|exists:lesson_classes,id',
                'has_allergy' => 'nullable',
                'allergy_detail' => 'required_if:has_allergy,1|max:500',
                'notes' => 'nullable|string|max:1000',

                'guardian1_full_name' => 'required|string|max:200',
                'guardian1_national_id' => 'required|string|max:11',
                'guardian1_relationship' => 'required|string|max:200',
                'guardian1_birth_date' => 'required|date',
                'guardian1_education_level' => 'required|string|max:200',
                'guardian1_job' => 'required|string|max:200',
                'guardian1_phone_1' => 'required|string|max:200',
                'guardian1_phone_2' => 'required|string|max:200',
                'guardian1_email' => 'required|email|max:200',
                'guardian1_home_address' => 'required|string|max:500',
                'guardian1_work_address' => 'required|string|max:500',

                'guardian2_active' => 'nullable|in:1,2',
                'guardian2_full_name'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_national_id'  => 'required_if:guardian2_active,1|string|max:11',
                'guardian2_relationship' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_birth_date'  => 'required_if:guardian2_active,1|date',
                'guardian2_education_level'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_job' => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_1'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_phone_2'  => 'required_if:guardian2_active,1|string|max:200',
                'guardian2_email' => 'required_if:guardian2_active,1|email|max:200',
                'guardian2_home_address'  => 'required_if:guardian2_active,1|string|max:500',
                'guardian2_work_address'  => 'required_if:guardian2_active,1|string|max:500',
            ], [
                // Genel
                'registiration_type.required' => 'Kayıt türü seçilmelidir.',
                'registiration_type.in' => 'Kayıt türü yalnızca 1 veya 2 olabilir.',
                'full_name.required' => 'Öğrencinin adı soyadı zorunludur.',
                'full_name.max' => 'Öğrencinin adı soyadı en fazla 200 karakter olabilir.',
                'gender.required' => 'Cinsiyet seçilmelidir.',
                'birth_date.required' => 'Doğum tarihi girilmelidir.',
                'school_name.required' => 'Okul adı zorunludur.',
                'school_name.max' => 'Okul adı en fazla 200 karakter olabilir.',
                'tc_no.required' => 'TC Kimlik Numarası zorunludur.',
                'tc_no.max' => 'TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'blood_type.required' => 'Kan grubu zorunludur.',
                'blood_type.max' => 'Kan grubu en fazla 3 karakter olabilir.',
                'class_id.required' => 'Sınıf seçilmelidir.',
                'class_id.exists' => 'Seçilen sınıf mevcut değil.',
                'allergy_detail.required_if' => 'Alerji bilgisi seçildiyse detay alanı zorunludur.',
                'allergy_detail.max' => 'Alerji detayı en fazla 500 karakter olabilir.',
                'notes.max' => 'Notlar en fazla 1000 karakter olabilir.',

                // Veli 1
                'guardian1_full_name.required' => '1. velinin adı soyadı zorunludur.',
                'guardian1_full_name.max' => '1. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian1_national_id.required' => '1. velinin TC Kimlik Numarası zorunludur.',
                'guardian1_national_id.max' => '1. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian1_relationship.required' => '1. velinin öğrenci ile yakınlığı belirtilmelidir.',
                'guardian1_relationship.max' => '1. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian1_birth_date.required' => '1. velinin doğum tarihi girilmelidir.',
                'guardian1_education_level.required' => '1. velinin eğitim durumu zorunludur.',
                'guardian1_education_level.max' => '1. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian1_job.required' => '1. velinin mesleği girilmelidir.',
                'guardian1_job.max' => '1. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian1_phone_1.required' => '1. velinin birinci telefon numarası girilmelidir.',
                'guardian1_phone_1.max' => '1. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_phone_2.required' => '1. velinin ikinci telefon numarası girilmelidir.',
                'guardian1_phone_2.max' => '1. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian1_email.required' => '1. velinin e-posta adresi girilmelidir.',
                'guardian1_email.email' => '1. velinin e-posta adresi geçerli olmalıdır.',
                'guardian1_email.max' => '1. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian1_home_address.required' => '1. velinin ev adresi girilmelidir.',
                'guardian1_home_address.max' => '1. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian1_work_address.required' => '1. velinin iş adresi girilmelidir.',
                'guardian1_work_address.max' => '1. velinin iş adresi en fazla 500 karakter olabilir.',

                // Veli 2
                'guardian2_full_name.required_if' => '2. veli aktif seçildiğinde adı soyadı zorunludur.',
                'guardian2_full_name.max' => '2. velinin adı soyadı en fazla 200 karakter olabilir.',
                'guardian2_national_id.required_if' => '2. veli aktif seçildiğinde TC Kimlik Numarası zorunludur.',
                'guardian2_national_id.max' => '2. velinin TC Kimlik Numarası en fazla 11 karakter olabilir.',
                'guardian2_relationship.required_if' => '2. veli aktif seçildiğinde öğrenci ile yakınlık girilmelidir.',
                'guardian2_relationship.max' => '2. velinin öğrenci ile yakınlığı en fazla 200 karakter olabilir.',
                'guardian2_birth_date.required_if' => '2. veli aktif seçildiğinde doğum tarihi girilmelidir.',
                'guardian2_education_level.required_if' => '2. veli aktif seçildiğinde eğitim durumu girilmelidir.',
                'guardian2_education_level.max' => '2. velinin eğitim durumu en fazla 200 karakter olabilir.',
                'guardian2_job.required_if' => '2. veli aktif seçildiğinde mesleği girilmelidir.',
                'guardian2_job.max' => '2. velinin mesleği en fazla 200 karakter olabilir.',
                'guardian2_phone_1.required_if' => '2. veli aktif seçildiğinde birinci telefon numarası zorunludur.',
                'guardian2_phone_1.max' => '2. velinin birinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_phone_2.required_if' => '2. veli aktif seçildiğinde ikinci telefon numarası zorunludur.',
                'guardian2_phone_2.max' => '2. velinin ikinci telefon numarası en fazla 200 karakter olabilir.',
                'guardian2_email.required_if' => '2. veli aktif seçildiğinde e-posta adresi zorunludur.',
                'guardian2_email.email' => '2. velinin e-posta adresi geçerli olmalıdır.',
                'guardian2_email.max' => '2. velinin e-posta adresi en fazla 200 karakter olabilir.',
                'guardian2_home_address.required_if' => '2. veli aktif seçildiğinde ev adresi zorunludur.',
                'guardian2_home_address.max' => '2. velinin ev adresi en fazla 500 karakter olabilir.',
                'guardian2_work_address.required_if' => '2. veli aktif seçildiğinde iş adresi zorunludur.',
                'guardian2_work_address.max' => '2. velinin iş adresi en fazla 500 karakter olabilir.',
            ]);
        }
        $student  = Student::findOrFail($id);
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

        $studentPayment = new StudentPayments();
        $studentPayment->student_id = $student->id;
        $studentPayment->class_id = $student->class_id;
        $studentPayment->save();

        if ($student->registration_type == '2') {
            return redirect()->route('students.payment', ['id' => $studentPayment->id]);
        }
        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    public function payment(Request $request, $id)
    {

        $payment = StudentPayments::with(['installments'])->findOrFail($id);

        return  view('admin.students-payments.create', [
            'payment' => $payment
        ]);
    }
    public function paymentUpdate(Request $request, $id)
    {
        $payment = StudentPayments::with('installments')->findOrFail($id);

        if ($request->isMethod('post')) {
            $payment->update([
                'installment_count' => $request->installments ? count($request->installments) : 0,
                'total_price'       => $request->total_payment,
                'total_payed_price' => collect($request->installments)->sum(fn($i) => $i['payed_price'] ?? 0),
                'start_date'        => $request->start_date,
            ]);

            $payment->installments()->delete();
            if ($request->has('installments')) {
                foreach ($request->installments as $index => $inst) {
                    $payment->installments()->create([
                        'student_payment_id' => $payment->id,
                        'student_id'        => $payment->student_id,
                        'order'             => $index + 1,
                        'payment_date'      => $inst['payment_date'] ?? null,
                        'installment_price' => $inst['installment_price'] ?? 0,
                        'payed_price'       => $inst['payed_price'] ?? 0,
                        'payment_type'      => $inst['payment_type'] ?? 'Nakit',
                        'payyed_date'       => $inst['payyed_date'] ?? null,
                    ]);
                }
            }

            return redirect()->route('students.edit', ['id' => $payment->student_id])->with('success', 'Ödeme ve taksitler başarıyla güncellendi.');
        }

        return view('admin.students-payments.create', compact('payment'));
    }

    public function allPayments($id)
    {
        $student = Student::findOrFail($id);
        $payments = StudentPayments::with(['installments', 'class'])->where('student_id', $student->id)->orderBy('created_at', 'ASC')->get();
        return view('admin.students-payments.payments', [
            'student' => $student,
            'payments' => $payments
        ]);
    }

    public function downloadRegistrationForm(Request $request)
    {
        $student = Student::with(['guardians', 'emergencyContact', 'lessonClass'])->findOrFail($request->student_id);

        $pdf = Pdf::loadView('admin.students.registration_form', compact('student'))->setOptions(['defaultFont' => 'DejaVu Sans'])->setPaper('a4', 'portrait');
        return $pdf->download('registration_form_' . $student->id . '.pdf');
    }

    public function downloadContract(Request $request)
    {
        $student = Student::with(['guardians', 'emergencyContact', 'lessonClass', 'payments'])->findOrFail($request->student_id);

        $pdf = Pdf::loadView('admin.students.contract', compact('student'))->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ])->setPaper('a4', 'portrait');
        return $pdf->download('contract_' . $student->id . '.pdf');
    }
    public function downloadPayment(Request $request)
    {
        $student = Student::with(['guardians'])->findOrFail($request->student_id);
        $payment = StudentPayments::with(['installments'])->findOrFail($request->payment_id);

        $pdf = Pdf::loadView('admin.students.payment_contract', [
            'student' => $student,
            'payment' => $payment
        ])->setOptions(['defaultFont' => 'DejaVu Sans'])->setPaper('a4', 'portrait');
        return $pdf->download('payment_contract_' . $student->id . '.pdf');
    }
}
