<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Faq\Faq;
use App\Models\Pages\Contact\ContactPageInfo;
use App\Models\Blogs\Blog;
use App\Models\Blogs\BlogCategory;
use App\Models\Blogs\BlogTag;
use App\Models\Courses\Course;
use App\Models\Courses\CourseCategory;
use App\Models\Pages\Blog\BlogPageInfo;
use App\Models\Pages\Course\CoursePageInfo;
use App\Models\Pages\Faq\FaqPageInfo;
use App\Models\Pages\AboutUs\AboutUsPageInfo;
use App\Models\Pages\Teacher\TeacherPageInfo;
use App\Models\ClientLogo\ClientLogo;
use App\Models\Testimonial\Testimonial;
use App\Models\Teacher\Teacher;
use App\Models\Slider\Slider;
use App\Models\Pages\Home\HomePageInfo;

class FrontController extends Controller
{
    public function home()
    {
        $courses = Course::with('categories')->where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $blogs = Blog::with('categories')->where('is_active', true)->orderByDesc('published_at')->take(3)->get();
        $activeSlider = Slider::where('is_active', true)->with('activeItems')->first();
        $courseCategories = CourseCategory::where('is_active', true)
            ->withCount(['courses' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();
        $homePageInfo = HomePageInfo::first();
        $clientLogos = ClientLogo::where('is_active', true)->orderBy('sort_order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('sort_order')->get();
        return view('front.pages.home', compact('courses', 'blogs', 'activeSlider', 'courseCategories', 'homePageInfo', 'clientLogos', 'testimonials'));
    }

    public function about()
    {
        $aboutPageInfo = AboutUsPageInfo::first();
        $blogs = Blog::with('categories')->where('is_active', true)->orderByDesc('published_at')->take(3)->get();
        $clientLogos = ClientLogo::where('is_active', true)->orderBy('sort_order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('sort_order')->get();
        $courseCategories = CourseCategory::where('is_active', true)
            ->withCount(['courses' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->take(4)->get();
        return view('front.pages.about', compact('aboutPageInfo', 'blogs', 'clientLogos', 'testimonials', 'courseCategories', 'faqs'));
    }

    public function courses()
    {
        $coursePageInfo = CoursePageInfo::first();
        $query = Course::with('categories')->where('is_active', true);

        $search = trim(request('q', ''));
        if ($search) {
            $lower = mb_strtolower($search);
            $query->where(function ($q) use ($lower) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$lower}%"])
                  ->orWhereRaw('LOWER(short_description) LIKE ?', ["%{$lower}%"]);
            });
        }

        $courses = $query->orderBy('sort_order')->paginate(9)->appends(['q' => $search]);
        $categories = CourseCategory::where('is_active', true)
            ->withCount(['courses' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();
        $ctaInfo = $coursePageInfo;
        return view('front.pages.courses', compact('coursePageInfo', 'courses', 'categories', 'ctaInfo', 'search'));
    }

    public function search()
    {
        $search = trim(request('q', ''));

        $courses = collect();
        $blogs = collect();
        $teachers = collect();

        if (mb_strlen($search) >= 2) {
            $lower = mb_strtolower($search);

            $courses = Course::with('categories')
                ->where('is_active', true)
                ->where(function ($q) use ($lower) {
                    $q->whereRaw('LOWER(title) LIKE ?', ["%{$lower}%"])
                      ->orWhereRaw('LOWER(short_description) LIKE ?', ["%{$lower}%"]);
                })
                ->orderBy('sort_order')
                ->take(12)
                ->get();

            $blogs = Blog::with('categories')
                ->where('is_active', true)
                ->where(function ($q) use ($lower) {
                    $q->whereRaw('LOWER(title) LIKE ?', ["%{$lower}%"])
                      ->orWhereRaw('LOWER(short_description) LIKE ?', ["%{$lower}%"]);
                })
                ->orderByDesc('published_at')
                ->take(6)
                ->get();

            $teachers = Teacher::where('is_active', true)
                ->where(function ($q) use ($lower) {
                    $q->whereRaw('LOWER(name) LIKE ?', ["%{$lower}%"])
                      ->orWhereRaw('LOWER(title) LIKE ?', ["%{$lower}%"]);
                })
                ->orderBy('sort_order')
                ->take(6)
                ->get();
        }

        return view('front.pages.search', compact('search', 'courses', 'blogs', 'teachers'));
    }

    public function searchSuggest()
    {
        $search = trim(request('q', ''));
        $locale = app()->getLocale();

        if (mb_strlen($search) < 2) {
            return response()->json(['results' => []]);
        }

        $lower = mb_strtolower($search);

        $courses = Course::where('is_active', true)
            ->where(function ($q) use ($lower) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$lower}%"])
                  ->orWhereRaw('LOWER(short_description) LIKE ?', ["%{$lower}%"]);
            })
            ->orderBy('sort_order')
            ->take(4)
            ->get()
            ->map(fn($c) => [
                'type'  => 'course',
                'label' => $c->getTranslation('title', $locale),
                'desc'  => Str::limit($c->getTranslation('short_description', $locale), 60),
                'url'   => route('front.course.details', $c->id),
                'image' => $c->image ? asset($c->image) : null,
            ]);

        $blogs = Blog::where('is_active', true)
            ->where(function ($q) use ($lower) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$lower}%"])
                  ->orWhereRaw('LOWER(short_description) LIKE ?', ["%{$lower}%"]);
            })
            ->orderByDesc('published_at')
            ->take(3)
            ->get()
            ->map(fn($b) => [
                'type'  => 'blog',
                'label' => $b->getTranslation('title', $locale),
                'desc'  => Str::limit($b->getTranslation('short_description', $locale), 60),
                'url'   => route('front.blog.details', $b->id),
                'image' => $b->image ? asset($b->image) : null,
            ]);

        $teachers = Teacher::where('is_active', true)
            ->where(function ($q) use ($lower) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$lower}%"])
                  ->orWhereRaw('LOWER(title) LIKE ?', ["%{$lower}%"]);
            })
            ->orderBy('sort_order')
            ->take(2)
            ->get()
            ->map(fn($t) => [
                'type'  => 'teacher',
                'label' => $t->getTranslation('name', $locale),
                'desc'  => $t->getTranslation('title', $locale),
                'url'   => route('front.teacher.details', $t->id),
                'image' => $t->image ? asset($t->image) : null,
            ]);

        return response()->json([
            'results' => $courses->concat($blogs)->concat($teachers)->values(),
            'total'   => $courses->count() + $blogs->count() + $teachers->count(),
            'allUrl'  => route('front.search', ['q' => $search]),
        ]);
    }

    public function courseDetails($id)
    {
        $coursePageInfo = CoursePageInfo::first();
        $course = Course::with('categories')->findOrFail($id);
        $ctaInfo = $coursePageInfo;
        return view('front.pages.course-details', compact('coursePageInfo', 'course', 'ctaInfo'));
    }

    public function teachers()
    {
        $teacherPageInfo = TeacherPageInfo::first();
        $teachers = Teacher::where('is_active', true)->orderBy('sort_order')->get();
        $ctaInfo = $teacherPageInfo;
        return view('front.pages.teachers', compact('teacherPageInfo', 'teachers', 'ctaInfo'));
    }

    public function teacherDetails($id)
    {
        $teacherPageInfo = TeacherPageInfo::first();
        $teacher = Teacher::findOrFail($id);
        $ctaInfo = $teacherPageInfo;
        return view('front.pages.teacher-details', compact('teacherPageInfo', 'teacher', 'ctaInfo'));
    }

    public function blog()
    {
        $blogPageInfo = BlogPageInfo::first();
        $blogs = Blog::with(['categories', 'blogTags'])->where('is_active', true)->orderBy('sort_order')->get();
        $ctaInfo = $blogPageInfo;
        return view('front.pages.blog', compact('blogPageInfo', 'blogs', 'ctaInfo'));
    }

    public function blogDetails($id)
    {
        $blogPageInfo = BlogPageInfo::first();
        $blog = Blog::with(['categories', 'blogTags'])->findOrFail($id);

        // Popular blogs (latest 3, excluding current)
        $popularBlogs = Blog::with(['categories', 'blogTags'])
            ->where('is_active', true)
            ->where('id', '!=', $id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        // Categories with blog counts
        $categories = BlogCategory::where('is_active', true)
            ->withCount(['blogs' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();

        // All active tags
        $tags = BlogTag::where('is_active', true)->orderBy('sort_order')->get();

        $ctaInfo = $blogPageInfo;
        return view('front.pages.blog-details', compact('blogPageInfo', 'blog', 'popularBlogs', 'categories', 'tags', 'ctaInfo'));
    }

    public function contact()
    {
        $contactInfo = ContactPageInfo::first();
        return view('front.pages.contact', compact('contactInfo'));
    }

    public function faq()
    {
        $faqPageInfo = FaqPageInfo::first();
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
        $ctaInfo = $faqPageInfo;
        return view('front.pages.faq', compact('faqPageInfo', 'faqs', 'ctaInfo'));
    }

    public function products()
    {
        return view('front.pages.products');
    }

    public function productDetails()
    {
        return view('front.pages.product-details');
    }

    public function cart()
    {
        return view('front.pages.cart');
    }

    public function checkout()
    {
        return view('front.pages.checkout');
    }
}
