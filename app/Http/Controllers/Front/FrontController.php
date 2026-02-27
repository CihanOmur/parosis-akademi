<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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
        return view('front.pages.home', compact('courses', 'blogs', 'activeSlider', 'courseCategories', 'homePageInfo', 'clientLogos'));
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
        $courses = Course::with('categories')->where('is_active', true)->orderBy('sort_order')->paginate(9);
        $categories = CourseCategory::where('is_active', true)
            ->withCount(['courses' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();
        $ctaInfo = $coursePageInfo;
        return view('front.pages.courses', compact('coursePageInfo', 'courses', 'categories', 'ctaInfo'));
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
