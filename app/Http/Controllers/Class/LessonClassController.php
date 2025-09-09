<?php

namespace App\Http\Controllers\Class;

use App\Http\Controllers\Controller;
use App\Models\Class\LessonClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonClassController extends Controller
{
    public function index()
    {
        $dayNames = [
            'Monday'    => 'Pazartesi',
            'Tuesday'   => 'Salı',
            'Wednesday' => 'Çarşamba',
            'Thursday'  => 'Perşembe',
            'Friday'    => 'Cuma',
            'Saturday'  => 'Cumartesi',
            'Sunday'    => 'Pazar',
        ];
        $classes = LessonClass::get();
        return view('admin.class.index', [
            'classes' => $classes,
            'dayNames' => $dayNames
        ]);
    }
    public function create()
    {
        $days = [
            'Monday' => 'Pazartesi',
            'Tuesday' => 'Salı',
            'Wednesday' => 'Çarşamba',
            'Thursday' => 'Perşembe',
            'Friday' => 'Cuma',
            'Saturday' => 'Cumartesi',
            'Sunday' => 'Pazar',
        ];

        $times = [];
        $start = Carbon::createFromTime(7, 0);
        $end = Carbon::createFromTime(21, 0);
        while ($start <= $end) {
            $times[$start->format('H:i')] = $start->format('H:i');
            $start->addMinutes(30);
        }

        return view('admin.class.create', [
            'days' => $days,
            'times' => $times
        ]);
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'day'          => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    if ($value < '07:00' || $value > '21:00') {
                        $fail('Saat 07:00 ile 21:00 arasında olmalı.');
                    }
                }
            ],
            'price'        => 'required|numeric|min:0',
            'quota'        => 'required|integer|min:1',
            'teacher_name' => 'required|string|max:255',
        ]);
        LessonClass::create($validated);
        return redirect()->route('class.index')->with(['success' => 'Sınıf oluşturuldu']);
    }
    public function edit($id)
    {
        $lessonClass = LessonClass::findOrFail($id);
        $days = [
            'Monday' => 'Pazartesi',
            'Tuesday' => 'Salı',
            'Wednesday' => 'Çarşamba',
            'Thursday' => 'Perşembe',
            'Friday' => 'Cuma',
            'Saturday' => 'Cumartesi',
            'Sunday' => 'Pazar',
        ];

        // 07:00 - 21:00 arası 30 dk slotlar
        $times = [];
        $start = Carbon::createFromTime(7, 0);
        $end = Carbon::createFromTime(21, 0);
        while ($start <= $end) {
            $times[$start->format('H:i')] = $start->format('H:i');
            $start->addMinutes(30);
        }
        return view('admin.class.edit', [
            'days' => $days,
            'times' => $times,
            'lessonClass' => $lessonClass
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'day'          => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    if ($value < '07:00' || $value > '21:00') {
                        $fail('Saat 07:00 ile 21:00 arasında olmalı.');
                    }
                }
            ],
            'price'        => 'required|numeric|min:0',
            'quota'        => 'required|integer|min:1',
            'teacher_name' => 'required|string|max:255',
        ]);
        $lessonClass = LessonClass::findOrFail($id);
        $lessonClass->update($validated);
        return redirect()->route('class.index')->with(['success' => 'Sınıf Düzenlendi']);
    }
    public function delete($id)
    {
        $lessonClass = LessonClass::findOrFail($id);
        $lessonClass->delete();
        return redirect()->route('class.index')->with(['success' => 'Sınıf silindi']);
    }
}
