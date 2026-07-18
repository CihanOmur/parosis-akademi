<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseApplication;
use Illuminate\Http\Request;

class CourseApplicationController extends Controller
{
    // Front: form submit
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => ['nullable', 'integer', 'exists:courses,id'],
            'student_name' => ['required', 'string', 'max:150'],
            'student_age' => ['required', 'integer', 'min:3', 'max:99'],
            'school' => ['required', 'string', 'max:200'],
            'grade' => ['required', 'string', 'max:50'],
            'parent_name' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
        ]);

        $data['status'] = 'pending';
        CourseApplication::create($data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Başvurunuz alındı. En kısa sürede sizinle iletişime geçeceğiz.']);
        }

        return back()->with('success', 'Başvurunuz alındı.');
    }

    // Panel: listeleme
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $courseId = (int) $request->get('course_id', 0);
        $status = $request->get('status', '');

        $query = CourseApplication::with('course')->orderByDesc('created_at');

        if ($q !== '') {
            $like = mb_strtolower($q);
            $query->where(function ($qq) use ($like) {
                $qq->whereRaw('LOWER(student_name) LIKE ?', ["%{$like}%"])
                   ->orWhereRaw('LOWER(parent_name) LIKE ?', ["%{$like}%"])
                   ->orWhere('phone', 'like', "%{$q}%")
                   ->orWhereRaw('LOWER(email) LIKE ?', ["%{$like}%"]);
            });
        }
        if ($courseId > 0) {
            $query->where('course_id', $courseId);
        }
        if (in_array($status, ['pending', 'contacted'], true)) {
            $query->where('status', $status);
        }

        $applications = $query->paginate(20)->withQueryString();
        $courses = Course::orderBy('sort_order')->get(['id', 'title']);

        return view('admin.course-applications.index', compact('applications', 'courses', 'q', 'courseId', 'status'));
    }

    // Panel: iletisime gecildi olarak isaretle
    public function markContacted($id)
    {
        $app = CourseApplication::findOrFail($id);
        $app->update(['status' => 'contacted', 'contacted_at' => now()]);
        return back()->with('success', 'İletişime geçildi olarak işaretlendi.');
    }

    public function destroy($id)
    {
        $app = CourseApplication::findOrFail($id);
        $app->delete();
        return back()->with('success', 'Başvuru silindi.');
    }
}
