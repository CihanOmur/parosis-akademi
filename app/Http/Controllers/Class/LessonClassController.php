<?php

namespace App\Http\Controllers\Class;

use App\Http\Controllers\Controller;
use App\Models\Class\LessonClass;
use App\Models\Class\LessonClassDays;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonClassController extends Controller
{
    public function index()
    {

        $classes = LessonClass::with(['teacher', 'days'])->get();
        return view('admin.class.index', [
            'classes' => $classes,
        ]);
    }
    public function create()
    {
        $days = [
            'Pazartesi' => 'Pazartesi',
            'Salı' => 'Salı',
            'Çarşamba' => 'Çarşamba',
            'Perşembe' => 'Perşembe',
            'Cuma' => 'Cuma',
            'Cumartesi' => 'Cumartesi',
            'Pazar' => 'Pazar',
        ];

        $times = [];
        $start = Carbon::createFromTime(7, 0);
        $end = Carbon::createFromTime(21, 0);
        while ($start <= $end) {
            $times[$start->format('H:i:s')] = $start->format('H:i:s');
            $start->addMinutes(30);
        }
        $teachers = User::role('Eğitmen')->get();

        return view('admin.class.create', [
            'days' => $days,
            'times' => $times,
            'teachers' => $teachers
        ]);
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quota'       => 'required|integer|min:1',
            'teacher_id'  => 'required|exists:users,id',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'course_time' => 'required|string|max:255',
            'day_data' => 'required|array',
            'day_data.*.day' => 'required|in:Pazartesi,Salı,Çarşamba,Perşembe,Cuma,Cumartesi,Pazar',
            'day_data.*.start_time' => [
                'required',
                'date_format:H:i:s',
                function ($attribute, $value, $fail) {
                    if ($value < '07:00:00' || $value > '21:00:00') {
                        $fail('Saat 07:00 ile 21:00 arasında olmalı.');
                    }
                }
            ],
            'day_data.*.end_time' => [
                'required',
                'date_format:H:i:s',
                function ($attribute, $value, $fail) {
                    if ($value < '07:00:00' || $value > '21:00:00') {
                        $fail('Saat 07:00 ile 21:00 arasında olmalı.');
                    }
                }
            ],
        ], [
            'name.required'       => 'Kurs adı zorunludur.',
            'name.string'         => 'Kurs adı geçerli bir metin olmalıdır.',
            'name.max'            => 'Kurs adı en fazla 255 karakter olabilir.',

            'day_data.required' => 'En az bir gün seçmelisiniz.',
            'day_data.array'    => 'Gün alanı birden fazla seçim yapılabilecek şekilde olmalıdır.',
            'day_data.*.day.required' => 'Seçilen gün boş olamaz.',
            'day_data.*.day.in'       => 'Geçerli bir gün seçmelisiniz. (Pazartesi - Pazar)',
            'day_data.*.start_time.required' => 'Başlangıç saati alanı zorunludur.',
            'day_data.*.start_time.date_format' => 'Saat formatı geçersiz. (örn: 14:30)',
            'day_data.*.end_time.required' => 'Bitiş saati alanı zorunludur.',
            'day_data.*.end_time.date_format' => 'Saat formatı geçersiz. (örn: 14:30)',

            'quota.required'      => 'Kontenjan zorunludur.',
            'quota.integer'       => 'Kontenjan sayısal olmalıdır.',
            'quota.min'           => 'Kontenjan en az 1 olmalıdır.',

            'teacher_id.required' => 'Öğretmen seçimi zorunludur.',
            'teacher_id.exists'   => 'Seçilen öğretmen sistemde bulunamadı.',

            'start_date.required' => 'Başlangıç tarihi zorunludur.',
            'start_date.date'     => 'Başlangıç tarihi geçerli bir tarih olmalıdır.',

            'end_date.required'   => 'Bitiş tarihi zorunludur.',
            'end_date.date'       => 'Bitiş tarihi geçerli bir tarih olmalıdır.',
            'end_date.after_or_equal' => 'Bitiş tarihi, başlangıç tarihinden önce olamaz.',

            'course_time.required' => 'Kurs süresi zorunludur.',
            'course_time.string'   => 'Kurs süresi metin olmalıdır.',
            'course_time.max'      => 'Kurs süresi en fazla 255 karakter olabilir.',
        ]);
        $lessonClass = new LessonClass();
        $lessonClass->name        = $validated['name'];
        $lessonClass->time        = '00:00:00';
        $lessonClass->end_time    = '00:00:00';
        $lessonClass->price       = '0.00';
        $lessonClass->quota       = $validated['quota'];
        $lessonClass->teacher_id  = $validated['teacher_id'];
        $lessonClass->start_date  = $validated['start_date'];
        $lessonClass->end_date    = $validated['end_date'];
        $lessonClass->course_time = $validated['course_time'];
        $lessonClass->save();

        foreach ($validated['day_data'] as $day) {
            $newLessonClassDay = new LessonClassDays();
            $newLessonClassDay->lesson_class_id = $lessonClass->id;
            $newLessonClassDay->day = $day['day'];
            $newLessonClassDay->start_time = $day['start_time'];
            $newLessonClassDay->end_time = $day['end_time'];
            $newLessonClassDay->save();
        }

        return redirect()->route('class.index')->with(['success' => 'Sınıf oluşturuldu']);
    }
    public function edit($id)
    {
        $lessonClass = LessonClass::with(['teacher', 'days'])->findOrFail($id);
        $days = [
            'Pazartesi' => 'Pazartesi',
            'Salı' => 'Salı',
            'Çarşamba' => 'Çarşamba',
            'Perşembe' => 'Perşembe',
            'Cuma' => 'Cuma',
            'Cumartesi' => 'Cumartesi',
            'Pazar' => 'Pazar',
        ];

        // 07:00 - 21:00 arası 30 dk slotlar
        $times = [];
        $start = Carbon::createFromTime(7, 0);
        $end = Carbon::createFromTime(21, 0);

        while ($start <= $end) {
            $times[$start->format('H:i:s')] = $start->format('H:i:s');
            $start->addMinutes(30);
        }
        $teachers = User::role('Eğitmen')->get();

        return view('admin.class.edit', [
            'days' => $days,
            'times' => $times,
            'lessonClass' => $lessonClass,
            'teachers' => $teachers
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quota'       => 'required|integer|min:1',
            'teacher_id'  => 'required|exists:users,id',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'course_time' => 'required|string|max:255',
            'day_data' => 'required|array',
            'day_data.*.day' => 'required|in:Pazartesi,Salı,Çarşamba,Perşembe,Cuma,Cumartesi,Pazar',
            'day_data.*.start_time' => [
                'required',
                'date_format:H:i:s',
                function ($attribute, $value, $fail) {
                    if ($value < '07:00:00' || $value > '21:00:00') {
                        $fail('Saat 07:00 ile 21:00 arasında olmalı.');
                    }
                }
            ],
            'day_data.*.end_time' => [
                'required',
                'date_format:H:i:s',
                function ($attribute, $value, $fail) {
                    if ($value < '07:00:00' || $value > '21:00:00') {
                        $fail('Saat 07:00 ile 21:00 arasında olmalı.');
                    }
                }
            ],
        ], [
            'name.required'       => 'Kurs adı zorunludur.',
            'name.string'         => 'Kurs adı geçerli bir metin olmalıdır.',
            'name.max'            => 'Kurs adı en fazla 255 karakter olabilir.',

            'day_data.required' => 'En az bir gün seçmelisiniz.',
            'day_data.array'    => 'Gün alanı birden fazla seçim yapılabilecek şekilde olmalıdır.',
            'day_data.*.day.required' => 'Seçilen gün boş olamaz.',
            'day_data.*.day.in'       => 'Geçerli bir gün seçmelisiniz. (Pazartesi - Pazar)',
            'day_data.*.start_time.required' => 'Başlangıç saati alanı zorunludur.',
            'day_data.*.start_time.date_format' => 'Saat formatı geçersiz. (örn: 14:30)',
            'day_data.*.end_time.required' => 'Bitiş saati alanı zorunludur.',
            'day_data.*.end_time.date_format' => 'Saat formatı geçersiz. (örn: 14:30)',


            'quota.required'      => 'Kontenjan zorunludur.',
            'quota.integer'       => 'Kontenjan sayısal olmalıdır.',
            'quota.min'           => 'Kontenjan en az 1 olmalıdır.',

            'teacher_id.required' => 'Öğretmen seçimi zorunludur.',
            'teacher_id.exists'   => 'Seçilen öğretmen sistemde bulunamadı.',

            'course_time.required' => 'Kurs süresi zorunludur.',
            'course_time.string'   => 'Kurs süresi metin olmalıdır.',
            'course_time.max'      => 'Kurs süresi en fazla 255 karakter olabilir.',
        ]);
        $lessonClass = LessonClass::findOrFail($id);

        $lessonClass->name        = $validated['name'];
        $lessonClass->day         = '';
        $lessonClass->time        = '00:00:00';
        $lessonClass->end_time    = '00:00:00';
        $lessonClass->price       = '0.00';
        $lessonClass->quota       = $validated['quota'];
        $lessonClass->teacher_id  = $validated['teacher_id'];
        $lessonClass->start_date  = $validated['start_date'];
        $lessonClass->end_date    = $validated['end_date'];
        $lessonClass->course_time = $validated['course_time'];
        $lessonClass->save();

        // Eski günleri sil
        LessonClassDays::where('lesson_class_id', $lessonClass->id)->delete();
        // Yeni günleri ekle
        foreach ($validated['day_data'] as $day) {
            $newLessonClassDay = new LessonClassDays();
            $newLessonClassDay->lesson_class_id = $lessonClass->id;
            $newLessonClassDay->day = $day['day'];
            $newLessonClassDay->start_time = $day['start_time'];
            $newLessonClassDay->end_time = $day['end_time'];
            $newLessonClassDay->save();
        }

        return redirect()->route('class.index')->with(['success' => 'Sınıf Düzenlendi']);
    }
    public function delete($id)
    {
        $lessonClass = LessonClass::findOrFail($id);
        $lessonClass->delete();
        return redirect()->route('class.index')->with(['success' => 'Sınıf silindi']);
    }
}
